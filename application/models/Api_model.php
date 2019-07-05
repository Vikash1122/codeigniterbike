<?php
class Api_model extends CI_Model
{
    public function array_flatten($array = null)
    {
        $result = array();
        if (!is_array($array)) {
            $array = func_get_args();
        } //!is_array($array)
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } //is_array($value)
            else {
                $result = array_merge($result, array(
                    $key => $value
                ));
            }
        } //$array as $key => $value
        return $result;
    }
    public function insertOtp($mobile)
    {
        $otp = rand(1000, 9999);
        $res = $this->db->select('*')->where('mobile_number', $mobile)->get('user_otp')->result();
        if (empty($res)) {
            $this->db->set('mobile_number', $mobile)->set('otp', $otp)->insert('user_otp');
            return $otp;
        } //empty($res)
        else {
            $this->db->set('otp', $otp)->where('mobile_number', $mobile)->update('user_otp');
            return $otp;
        }
    }
    public function getOtp($mobile)
    {
        $res = $this->db->select('*')->where('mobile_number', $mobile)->get('user_otp')->result();
        if (!empty($res)) {
            return $res[0]->otp;
        } //!empty($res)
    }
    public function getUserExist($mobile, $email = null, $password = null, $for = null)
    {
        if ($for === 'corporate') {
            $this->db->select("*,concat('" . base_url() . "uploads/corporate/',image) as image_url");
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $res = $this->db->get('corporate_clients')->result();
        } //$for === 'corporate'
        else {
            $this->db->select("*,concat('" . base_url() . "uploads/users/',user_image) as image_url");
            if ($email == '' && $password == '') {
                $this->db->where('user_mobile', $mobile);
                $this->db->or_where('user_id', $mobile);
            } //$email == '' && $password == ''
            else {
                $this->db->where('user_email', $email);
                $this->db->where('password', $password);
            }
            $res = $this->db->get('users')->result();
        }
        return $res;
    }
    public function getUserData($mobile, $for = null)
    {
        if ($for === 'corporate') {
            $this->db->select("*,status as user_status,concat('" . base_url() . "uploads/corporate/',image) as image_url");
            $this->db->where('id', $mobile);
            return $this->db->get('corporate_clients')->result();
        } //$for === 'corporate'
        else {
            return $this->db->select("*,concat('" . base_url() . "uploads/users/',user_image) as image_url")->where('user_mobile', $mobile)->or_where('user_id', $mobile)->get('users')->result();
        }
    }
    public function addUserData($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    public function updateUser($data, $user_id)
    {
        $this->db->where('user_id', $user_id)->update('users', $data);
        return $this->db->where('user_id', $user_id)->get('users')->result();
    }
    public function addToken($user_id, $token, $for = null)
    {
        if ($for != null) {
            $table = "corporate_tokens";
        } //$for != null
        else {
            $table = "access_tokens";
        }
        $res = $this->db->select('*')->where('user_id', $user_id)->get($table)->result();
        if (empty($res)) {
            $this->db->set('token', $token)->set('user_id', $user_id)->insert($table);
        } //empty($res)
        else {
            $this->db->set('token', $token)->where('user_id', $user_id)->update($table);
        }
    }
    public function getToken($user_id, $token, $for = null)
    {
        if ($for != null) {
            $table = "corporate_tokens";
        } //$for != null
        else {
            $table = "access_tokens";
        }
        return $this->db->select('*')->where('user_id', $user_id)->where('token', $token)->get($table)->result();
    }
    public function addBike($data)
    {
        $this->db->insert('bikes', $data);
        return true;
    }
    public function getBike($bike_id = null)
    {
        if ($bike_id != null) {
            return $this->db->where('bike_id', $bike_id)->get('bikes')->result();
        } //$bike_id != null
        else {
            return $this->db->get('bikes')->result();
        }
    }
    public function swagbikeDashboard($user_id, $latitude = null, $longitude = null, $start_date = null, $end_date = null)
    {
        $data = array();
        $bike_ids = array();
        if ($start_date === null) {
            $rented_bike = $this->db->select('bike_id')->where('status!=', '3')->get('bike_rented')->result_array();
        } //$start_date !== null
        else {
            $rented_bike = $this->db->select('bike_id')->where('Date(start_date)<=', date('Y-m-d', strtotime($start_date)))->where('Date(end_date)>=', date('Y-m-d', strtotime($start_date)))->where('status!=', '3')->get('bike_rented')->result_array();            
            // $rented_bike = $this->db->select('bike_id')->where('status!=', '3')->get('bike_rented')->result_array();
            $corp_bike = $this->db->select('bike_id')->where('Date(lease_end)>=', date('Y-m-d', strtotime($start_date)))->get('corporate_orders')->result_array();            
            if(!empty($corp_bike)){
               
            foreach ($corp_bike as $key2 => $value2) {
            $bike_ids[] = explode(',', $value2['bike_id']);
                   }
                   $bike_ids=array_unique($this->array_flatten($bike_ids));
               }
        }
        
        foreach ($rented_bike as $keys => $values) {
            $bike_ids[] = $values['bike_id'];
        } //$rented_bike as $keys => $values   
        $this->db->select('*');
        if (!empty($bike_ids)) {
            $this->db->where_not_in('id', $bike_ids);
        } //!empty($bike_ids)
        if ($start_date !== null) {
            $this->db->where('rent_type', 'lease');
        } //$start_date !== null
        else {
            $this->db->where('rent_type', 'instant');
        }
        $result = $this->db->get('bike_details')->result_array();          
        foreach ($result as $key => $value) {
            $fbikes_res = $this->db->select('bike_id')->where('user_id', $user_id)->where('bike_id', $value['id'])->where('status', '1')->get('favourite_bikes')->row();
            if ($fbikes_res) {
                if ($value['id'] == $fbikes_res->bike_id) {
                    $result[$key]['favourite'] = 'true';
                } //$value['id'] == $fbikes_res->bike_id
            } //$fbikes_res
            else {
                $result[$key]['favourite'] = 'false';
            }
            if ($start_date !== null) {            
            $result[$key]['hour_consumed'] = abs((strtotime($end_date) - strtotime($start_date))/3600);
            $result[$key]['base_price']      = $result[$key]['hourly_price'] * abs((strtotime($end_date) - strtotime($start_date))/3600);
            $result[$key]['net_price']       = $result[$key]['hourly_price']* abs((strtotime($end_date) - strtotime($start_date))/3600) + $result[$key]['hourly_price'] * abs((strtotime($end_date) - strtotime($start_date))/3600) * 0.18;
              }
            $result[$key]['bike_images'] = $this->db->select("image_name,concat('" . base_url() . "uploads/bikes/',image_name) as image_url")->where('bike_id', $value['id'])->get('bike_images')->result();
        } //$result as $key => $value
        $res = array();
        // if($fav!=null){        
        // foreach ($result as $key1 => $value1) {
        //     if($value1['favourite']=='true')
        //        {
        //         $res[]=$value1;
        //        }
        //      }
        //   return $res;          
        //       }


        foreach ($result as $key2 => $value2) {
            $bikeres = bike_location($value2['vehicle_no'], 20, $latitude, $longitude);
            if (!empty($bikeres)) {
                $result[$key2]['lat']      = $bikeres['lat'];
                $result[$key2]['long']     = $bikeres['long'];
                $result[$key2]['location'] = $bikeres['location'];
                $result[$key2]['distance'] = $bikeres['distance'];
            } //!empty($bikeres)
            else {
                unset($result[$key2]);
            }
        } //$result as $key2 => $value2        
        $result                = array_values($result);
        $data['recent_bikes']  = $result;
        $data['wallet']        = 500;
        $data['popular_bikes'] = array();
        $data['offers']        = $this->db->select("name,concat('" . base_url() . "uploads/banners/',name) as image_url")->where('status', '2')->get('banners')->result();
        return $data;
    }
    public function addCard($data)
    {
        $this->db->insert('saved_cards', $data);
        return true;
    }
    public function deleteCard($user_id, $card_id)
    {
        $this->db->where('user_id', $user_id)->where('card_id', $card_id)->delete('saved_cards');
        return true;
    }
    public function getCard($user_id)
    {
        return $this->db->where('user_id', $user_id)->get('saved_cards')->result();
    }
    public function addBikeDetails($data, $img_data, $rc_data, $ins_data, $poll_data, $bike_id = null)
    {
        if ($bike_id != null) {
            $this->db->where('id', $bike_id)->update('bike_details', $data);
            if (!empty($img_data['name'])) {
                $img_data['bike_id'] = $bike_id;
                $this->db->where('bike_id', $bike_id)->delete('bike_images');
                foreach ($img_data['name'] as $value) {
                    $this->db->set('image_name', $value)->set('bike_id', $bike_id)->insert('bike_images');
                } //$img_data['name'] as $value
            } //!empty($img_data)
            if (!empty($rc_data)) {
                $rc_data['bike_id'] = $bike_id;
                $this->db->where('bike_id', $bike_id)->update('bike_rc', $rc_data);
            } //!empty($rc_data)
            if (!empty($ins_data)) {
                $ins_data['bike_id'] = $bike_id;
                $this->db->where('bike_id', $bike_id)->update('bike_insurance', $ins_data);
            } //!empty($ins_data)
            if (!empty($poll_data)) {
                $poll_data['bike_id'] = $bike_id;
                $this->db->where('bike_id', $bike_id)->update('bike_pollution', $poll_data);
            } //!empty($poll_data)
        } //$bike_id != null
        else {
            $this->db->insert('bike_details', $data);
            $bike_id = $this->db->insert_id();
            if ($bike_id) {
                $img_data['bike_id']  = $bike_id;
                $rc_data['bike_id']   = $bike_id;
                $ins_data['bike_id']  = $bike_id;
                $poll_data['bike_id'] = $bike_id;
                foreach ($img_data['name'] as $value) {
                    $this->db->set('image_name', $value)->set('bike_id', $bike_id)->insert('bike_images');
                } //$img_data['name'] as $value
                $this->db->insert('bike_rc', $rc_data);
                $this->db->insert('bike_insurance', $ins_data);
                $this->db->insert('bike_pollution', $poll_data);
            } //$bike_id
        }
        return true;
    }
    public function updateBikeDetails($id, $data)
    {
        $this->db->where('id', $id)->update('bike_details', $data);
        return true;
    }
    public function bikeCategory()
    {
        return $this->db->get('bike_category')->result();
    }
    public function addBikeLocation($data)
    {
        $this->db->insert('bike_locations', $data);
        return true;
    }
    public function addBikeFeedback($data)
    {
        $this->db->insert('bike_feedback', $data);
        return true;
    }
    public function addRentBike($data, $rent_id = null, $status,$for=null)
    {
        if($for==='lease'){
            $data1 = array(
                'bike_id' => $data['bike_id'],
                'user_id' => $data['user_id'],
                'payment_method' => $data['payment_method'],
                'status' => '1',
                'start_date'=>date("Y-m-d H:i:s",strtotime($data['start_date'])),
                'end_date'=>date("Y-m-d H:i:s",strtotime($data['end_date'])),
            );  
            $this->db->insert('bike_rented', $data1);
            $order_id=$this->db->insert_id();      
             $data2 = array(                
            'order_id' => $order_id,
            'method' => $data['payment_method'],
            'status' => '1',
            'amount' => $data['amount'],
            'order_type' =>$data['order_type']
            );
            $this->db->insert('payment',$data2);         
        
        }
        else{
        if ($status === '1') {
            $this->db->insert('bike_rented', $data);
        } //$status === '1'
        else {
            if ($status === '3') {
                $this->db->set('status', $status)->set('end_date', date("Y-m-d H:i:s"))->where('id', $rent_id)->update('bike_rented');
            } //$status === '3'
            if ($status === '2') {
                $this->db->set('status', $status)->set('start_date', date("Y-m-d H:i:s"))->where('id', $rent_id)->update('bike_rented');
            } //$status === '2'
            else {
                $this->db->set('status', $status)->where('id', $rent_id)->update('bike_rented');
            }
        }
      }
        return true;
    }
    public function addFavourite($data)
    {
        $res = $this->db->where('user_id', $data['user_id'])->where('bike_id', $data['bike_id'])->get('favourite_bikes')->result();
        if (empty($res)) {
            $this->db->insert('favourite_bikes', $data);
        } //empty($res)
        else {
            $this->db->set('status', $data['status'])->where('user_id', $data['user_id'])->where('bike_id', $data['bike_id'])->update('favourite_bikes');
        }
        return true;
    }
    public function getFavourite($user_id)
    {
        return $this->db->where('user_id', $user_id)->where('status', '1')->get('favourite_bikes')->result();
    }
    public function addBikeService($data)
    {
        $this->db->insert('bike_service', $data);
        return true;
    }
    public function getUsers($limit = 4, $offset = 1, $status = null, $name = null, $dl_no = null)
    {
        $user_ids = array();
        if ($status != null) {
            $user_res = $this->db->select('bd.rent_type as rent_type,bike_rented.user_id as user_id')->where('status', '3')->join('bike_details as bd', 'bd.id=bike_rented.bike_id', 'left')->where('bd.rent_type', $status)->get('bike_rented')->result_array();
            if (!empty($user_res)) {
                foreach ($user_res as $key => $value) {
                    $user_ids[] = $value['user_id'];
                } //$user_res as $key => $value
            } //!empty($user_res)
            else {
                $user_ids = array(
                    '0'
                );
            }
        } //$status != null
        $this->db->select("*,concat(user_firstname,' ',user_lastname) as user_name,concat('" . base_url() . "uploads/users/',user_image) as image_url")->where('user_role', 'customer');
        if ($name != null) {
            $this->db->like('user_firstname', $name)->or_like('user_lastname', $name);
        } //$name != null
        if ($dl_no != null) {
            $this->db->like('dl_no', $dl_no);
        } //$dl_no != null
        if ($status != null) {
            $this->db->where_in('user_id', $user_ids);
        } //$status != null
        $res = $this->db->order_by('created_at','desc')->get('users')->result();
        // else{
        // $res=$this->db->select("*,concat(user_firstname,' ',user_lastname) as user_name,concat('".base_url()."uploads/users/',user_image) as image_url")->where('user_role','customer')->get('users')->result();
        //   }
        foreach ($res as $key1 => $value1) {
            $res[$key1]->total_trip = $this->db->where('status', '3')->where('user_id', $value1->user_id)->get('bike_rented')->num_rows();
        } //$res as $key1 => $value1
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getAllBikes($limit = null, $offset = null, $type, $mode = null, $cc_id = null, $corder = null, $cat = null, $mname = null, $brand = null, $color = null, $name = null, $modelyear = null, $engine = null)
    {
        if ($type === 'lease') {
            if ($mode === 'edit') {
                $order_res  = $this->db->select('bike_id')->where('cc_id!=', $cc_id)->where('lease_end>=CURDATE()')->get('corporate_orders')->result_array();
                $order_res1 = $this->db->select('bike_id,price')->where('cc_id', $cc_id)->where('lease_end>=CURDATE()')->get('corporate_orders')->result_array();
            } //$mode === 'edit'
            elseif ($corder != null) {
                $order_res = $this->db->select('bike_id')->where('id', $corder)->get('corporate_orders')->result_array();
            } //$corder != null
            else {
                $order_res = $this->db->select('bike_id')->where('lease_end>=CURDATE()')->get('corporate_orders')->result_array();
            }
            foreach ($order_res as $key1 => $value1) {
                $bike_id[] = explode(',', $value1['bike_id']);
            } //$order_res as $key1 => $value1
            if ($mode === 'edit') {
                $edit_data = explode(',', $order_res1[0]['bike_id']);
            } //$mode === 'edit'
            if (!empty($bike_id)) {
                $bike_ids = array_unique($this->array_flatten($bike_id));
                $this->db->select('*')->where_not_in('id', $bike_ids)->where('rent_type', $type);
                if ($cat != null) {
                    $this->db->where('category', $cat);
                } //$cat != null
                if ($mname != null) {
                    $this->db->where('model_name', $mname);
                } //$mname != null
                if ($brand != null) {
                    $this->db->where('brand', $brand);
                } //$brand != null
                if ($color != null) {
                    $this->db->where('color', $color);
                } //$color != null
                if ($name != null) {
                    $this->db->like('name', $name);
                } //$name != null
                if ($modelyear != null) {
                    $this->db->where('model_year', $modelyear);
                } //$modelyear != null
                if ($engine != null) {
                    $this->db->where('enigne', $engine);
                } //$engine != null
                $result = $this->db->get('bike_details')->result_array();
            } //!empty($bike_id)
            else {
                $result = $this->db->select('*')->where('rent_type', $type)->get('bike_details')->result_array();
            }
        } //$type === 'lease'
        else {
            $this->db->select('*')->where('rent_type', $type);
            if ($cat != null) {
                $this->db->where('category', $cat);
            } //$cat != null
            if ($mname != null) {
                $this->db->where('model_name', $mname);
            } //$mname != null
            if ($brand != null) {
                $this->db->where('brand', $brand);
            } //$brand != null
            if ($color != null) {
                $this->db->where('color', $color);
            } //$color != null
            if ($name != null) {
                $this->db->like('name', $name);
            } //$name != null
            if ($modelyear != null) {
                $this->db->where('model_year', $modelyear);
            } //$modelyear != null
            if ($engine != null) {
                $this->db->where('enigne', $engine);
            } //$engine != null
            $result = $this->db->get('bike_details')->result_array();
        }
        foreach ($result as $key => $value) {
            $img_res                    = $this->db->select("image_name,concat('" . base_url() . "uploads/bikes/',image_name) as image_url")->where('bike_id', $value['id'])->limit('1')->get('bike_images')->row_array();
            $result[$key]['bike_image'] = $img_res['image_url'];
            $result[$key]['total_trip'] = $this->db->where('status', '3')->where('bike_id', $value['id'])->get('bike_rented')->num_rows();
            if ($mode === 'edit') {
                if (in_array($value['id'], $edit_data)) {
                    $result[$key]['selected'] = 'true';
                } //in_array($value['id'], $edit_data)
                else {
                    $result[$key]['selected'] = 'false';
                }
            } //$mode === 'edit'
        } //$result as $key => $value
        if ($limit != null) {
            $newoffset = ($offset - 1) * $limit;
            $res1      = array_slice($result, $newoffset, $limit);
            return $data = array(
                'data' => $res1,
                'count' => count($result)
            );
        } //$limit != null
        else {
            if ($mode === 'edit') {
                return $data = array(
                    'data' => $result,
                    'count' => count($result),
                    'price' => $order_res1[0]['price']
                );
            } //$mode === 'edit'
            return $data = array(
                'data' => $result,
                'count' => count($result)
            );
        }
    }
    public function getBrands($limit = null, $offset = null)
    {
        if ($limit == null) {
            $res = $this->db->select('*')->get('bike_brands')->result();
            return $data = array(
                'data' => $res
            );
        } //$limit == null
        $res       = $this->db->select('*')->get('bike_brands')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getCategory($limit = null, $offset = null, $brand = null, $type = null)
    {
        if ($brand != null) {
            $res = $this->db->select('DISTINCT(category) as name')->where('rent_type', $type)->where('brand', $brand)->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$brand != null
        if ($limit == null) {
            $res = $this->db->select('*')->get('bike_category')->result();
            return $data = array(
                'data' => $res
            );
        } //$limit == null
        $res       = $this->db->select('*')->get('bike_category')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getModels($brand = null, $limit = null, $offset = null, $category = null, $type = null)
    {
        if ($category != null) {
            $res = $this->db->select('DISTINCT(model_name) as name')->where('rent_type', $type)->where('category', $category)->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$category != null
        if ($brand != null) {
            $res = $this->db->select('DISTINCT(model_name)')->where_in('brand', explode(',', $brand))->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$brand != null
        $res       = $this->db->select('*')->get('bike_models')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getYear($model = null, $limit = null, $offset = null, $type = null)
    {
        if ($model != null) {
            $res = $this->db->select('DISTINCT(model_year) as name')->where('rent_type', $type)->where_in('model_name', explode(',', $model))->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$model != null
        $res       = $this->db->select('*')->get('bike_year')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getColor($model = null, $limit = null, $offset = null, $model_year = null, $type = null)
    {
        if ($model != null) {
            $res = $this->db->select('DISTINCT(color)')->where('rent_type', $type)->where_in('model_name', explode(',', $model))->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$model != null
        if ($model_year != null) {
            $res = $this->db->select('DISTINCT(color) as name')->where_in('model_year', explode(',', $model_year))->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$model_year != null
        $res       = $this->db->select('*')->get('bike_color')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getEngine($model_color = null, $type)
    {
        if ($model_color != null) {
            $res = $this->db->select('DISTINCT(engine) as name')->where('rent_type', $type)->where_in('color', explode(',', $model_color))->get('bike_details')->result();
            return $data = array(
                'data' => $res
            );
        } //$model_color != null
    }
    public function getBikeLocation($limit = null, $offset = null)
    {
        if ($limit == null) {
            $res = $this->db->get('bike_locations')->result();
            return $data = array(
                'data' => $res
            );
        } //$limit == null
        $res       = $this->db->select('*')->get('bike_locations')->result();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function addCsv($name = null, $table, $latitude = null, $longitude = null)
    {
        if ($name == null) {
            $fp = fopen($_FILES['userfile']['tmp_name'], 'r') or die("can't open file");
            $c = 0;
            while ($csv_line = fgetcsv($fp, 1024)) {
                $c++;
                $insert_csv = array();
                if ($c !== 1) {
                    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                        if ($table == 'bike_locations') {
                            $insert_csv['name']      = $csv_line[0];
                            $insert_csv['latitude']  = $csv_line[1];
                            $insert_csv['longitude'] = $csv_line[2];
                        } //$table == 'bike_locations'
                        else {
                            $insert_csv['name'] = $csv_line[0];
                        }
                    } //$i = 0, $j = count($csv_line); $i < $j; $i++
                    $this->db->insert($table, $insert_csv);
                } //$c !== 1
            } //$csv_line = fgetcsv($fp, 1024)
            fclose($fp) or die("can't close file");
            //$data['success']="success";
            return true;
        } //$name == null
        else {
            if ($table == 'bike_locations') {
                $data = array(
                    'name' => $name,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                );
            } //$table == 'bike_locations'
            else {
                $data = array(
                    'name' => $name
                );
            }
            $this->db->insert($table, array(
                'name' => $name
            ));
            return true;
        }
    }
    public function getActiveRide($user_id, $status, $status1 = null)
    {
        $bike_res = $this->db->where('user_id', $user_id)->where('status', $status)->or_where('status', $status1)->limit('1')->get('bike_rented')->row();
        if (!empty($bike_res)) {
            $result               = $this->db->select('*')->where('id', $bike_res->bike_id)->get('bike_details')->row_array();
            $img_res              = $this->db->select("image_name,concat('" . base_url() . "uploads/bikes/',image_name) as image_url")->where('bike_id', $bike_res->bike_id)->limit('1')->get('bike_images')->row_array();
            $result['rent_id']    = $bike_res->id;
            $result['status']     = $bike_res->status;
            $result['bike_image'] = $img_res['image_url'];
            $bike_loc_data        = bike_location($result['vehicle_no']);
            $result['lat']        = $bike_loc_data['lat'];
            $result['long']       = $bike_loc_data['long'];
            $result['location']   = $bike_loc_data['location'];
            return $result;
        } //!empty($bike_res)
    }
    public function getCompletedRide($user_id, $status)
    {
        $bike_res = $this->db->where('user_id', $user_id)->where('status', $status)->get('bike_rented')->result_array();
        if (!empty($bike_res)) {
            $bike_id = array();
            foreach ($bike_res as $key => $value) {
                $bike_ids[]   = $value['bike_id'];
                $rent_ids[]   = $value['id'];
                $start_date[] = $value['start_date'];
                $end_date[]   = $value['end_date'];
                if ($value['payment_method'] === '1') {
                    $payment_method[] = 'Swag Wallet';
                } //$value['payment_method'] === '1'
                elseif ($value['payment_method'] === '2') {
                    $payment_method[] = 'Paytm';
                } //$value['payment_method'] === '2'
                else {
                    $payment_method[] = 'Card';
                }
            } //$bike_res as $key => $value
            $result = $this->db->select('*')->where_in('id', $bike_ids)->get('bike_details')->result_array();
            foreach ($result as $key1 => $value1) {
                $img_res                          = $this->db->select("image_name,concat('" . base_url() . "uploads/bikes/',image_name) as image_url")->where('bike_id', $value1['id'])->limit('1')->get('bike_images')->row_array();
                $result[$key1]['rent_id']         = $rent_ids[$key1];
                $result[$key1]['start_date']      = date('d-m-Y h:i a', strtotime($start_date[$key1]));
                $result[$key1]['end_date']        = date('d-m-Y h:i a', strtotime($end_date[$key1]));
                $result[$key1]['status']          = '3';
                $result[$key1]['minute_price']    = round($result[$key1]['hourly_price'] / 60, 2);
                $result[$key1]['minute_consumed'] = round(abs(strtotime($end_date[$key1]) - strtotime($start_date[$key1])) / 60, 2);
                $result[$key1]['base_price']      = $result[$key1]['hourly_price'] / 60 * round(abs(strtotime($end_date[$key1]) - strtotime($start_date[$key1])) / 60, 2);
                $result[$key1]['net_price']       = $result[$key1]['hourly_price'] / 60 * round(abs(strtotime($end_date[$key1]) - strtotime($start_date[$key1])) / 60, 2) + $result[$key1]['hourly_price'] / 60 * round(abs(strtotime($end_date[$key1]) - strtotime($start_date[$key1])) / 60, 2) * 0.18;
                $result[$key1]['payment_method']  = $payment_method[$key1];
                $result[$key1]['bike_image']      = $img_res['image_url'];
                $bike_loc_data                    = bike_location($result[$key1]['vehicle_no']);
                $result[$key1]['lat']             = $bike_loc_data['lat'];
                $result[$key1]['long']            = $bike_loc_data['long'];
                $result[$key1]['location']        = $bike_loc_data['location'];
            } //$result as $key1 => $value1
            return $result;
        } //!empty($bike_res)
    }
    public function ruuningBanners($banner_id)
    {
        $this->db->set('status', '1')->update('banners');
        $this->db->set('status', '2')->where_in('id', explode(',', $banner_id))->update('banners');
        return true;
    }
    public function addCoupon($data)
    {
        $this->db->insert('coupons', $data);
        return true;
    }
    public function getCoupons($limit = null, $offset = null)
    {
        if ($limit == null) {
            $res = $this->db->get('coupons')->result();
            return $data = array(
                'data' => $res
            );
        } //$limit == null
        $res = $this->db->select('*,(CASE WHEN end_date<CURDATE() THEN  "Expired" ELSE "Active" END) as status')->get('coupons')->result_array();
        foreach ($res as $key => $value) {
            $res[$key]['available'] = $value['total_coupon'] - ($this->db->select('*')->where('coupon_id', $value['id'])->get('coupon_usage')->num_rows());
        } //$res as $key => $value
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getCouponUsage($limit = null, $offset = null)
    {
        if ($limit == null) {
            $res = $this->db->get('coupons')->result();
            return $data = array(
                'data' => $res
            );
        } //$limit == null
        $res = $this->db->select('*')->get('coupon_usage')->result_array();
        foreach ($res as $key => $value) {
            $user_res                = $this->db->select('*')->where('user_id', $value['user_id'])->get('users')->row_array();
            $res[$key]['user_name']  = $user_res['user_firstname'] . ' ' . $user_res['user_lastname'];
            $res[$key]['user_email'] = $user_res['user_email'];
        } //$res as $key => $value
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getBikeService($id, $limit, $offset)
    {
        $res       = $this->db->select('*')->where('bike_id', $id)->get('bike_service')->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getWalletUsers($limit, $offset)
    {
        $res = $this->db->select("*,concat(user_firstname,' ',user_lastname) as user_name,concat('" . base_url() . "uploads/users/',user_image) as image_url")->where('user_role', 'customer')->get('users')->result_array();
        foreach ($res as $key => $value) {
            $res1                 = $this->db->select('SUM(amount) as bal')->where('transaction_type', 'cr')->where('user_id', $value['user_id'])->get('wallet')->row_array();
            $res2                 = $this->db->select('SUM(amount) as bal')->where('transaction_type', 'dr')->where('user_id', $value['user_id'])->get('wallet')->row_array();
            $res[$key]['balance'] = $res1['bal'] - $res2['bal'];
        } //$res as $key => $value
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getWalletHistory($limit, $offset, $cust_id)
    {
        $res  = $this->db->select('*')->where('user_id', $cust_id)->get('wallet')->result_array();
        $res4 = $this->db->select('SUM(amount) as bal')->where('transaction_type', 'cr')->where('user_id', $cust_id)->get('wallet')->row_array();
        $res2 = $this->db->select('SUM(amount) as bal')->where('transaction_type', 'dr')->where('user_id', $cust_id)->get('wallet')->row_array();
        $res4['bal'] - $res2['bal'];
        $res3      = $this->db->select("*,concat(user_firstname,' ',user_lastname) as user_name")->where('user_id', $cust_id)->where('user_role', 'customer')->get('users')->row_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res),
            'balance' => $res4['bal'] - $res2['bal'],
            'user_lastname' => $res3['user_name']
        );
    }
    public function ongoingOrders($limit, $offset, $rent_type, $order_id = null, $date = null)
    {
        $dates = explode('-', $date);
        $this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date,(case when TIMESTAMPDIFF(hour,start_date,curdate())='0'  then concat(TIMESTAMPDIFF(minute,start_date,curdate()),' minute') when DATEDIFF(curdate(),start_date)='0'  then concat(TIMESTAMPDIFF(hour,start_date,curdate()),' hour') else concat((TIMESTAMPDIFF(day,start_date,curdate())),' days') end) as duration,(case when bike_details.rent_type='instant' then concat('Rs. ',(TIMESTAMPDIFF(minute,start_date,curdate()))*hourly_price/60) else concat('Rs. ',(TIMESTAMPDIFF(hour,start_date,end_date)*hourly_price))end) as price")->from("bike_rented")->join("bike_details", "bike_details.id=bike_rented.bike_id", "left")->join("users", "bike_rented.user_id=users.user_id", "left");
        if ($rent_type !== '') {
            $this->db->where('bike_details.rent_type', $rent_type);
        } //$rent_type !== ''
        if ($order_id != null) {
            $order_id = (int) filter_var($order_id, FILTER_SANITIZE_NUMBER_INT);
            $this->db->where('bike_rented.id', $order_id);
        } //$order_id != null
        if ($date != null) {
            $this->db->where('bike_rented.start_date >=', date('Y-m-d', strtotime($dates[0])));
            $this->db->where('bike_rented.start_date<=', date('Y-m-d', strtotime($dates[1])));
        } //$date != null
        $res       = $this->db->where('bike_rented.status', '2')->get()->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function activeOrders($limit, $offset, $rent_type, $order_id = null, $date = null)
    {
        $dates = explode('-', $date);
        $this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.create_at,'%d/%m/%Y %h:%i %p') as activate_at")->from("bike_rented")->join("bike_details", "bike_details.id=bike_rented.bike_id", "left")->join("users", "bike_rented.user_id=users.user_id", "left");
        if ($rent_type !== '') {
            $this->db->where('bike_details.rent_type', $rent_type);
        } //$rent_type !== ''
        if ($order_id != null) {
            $order_id = (int) filter_var($order_id, FILTER_SANITIZE_NUMBER_INT);
            $this->db->where('bike_rented.id', $order_id);
        } //$order_id != null
        if ($date != null) {
            $this->db->where('bike_rented.create_at >=', date('Y-m-d', strtotime($dates[0])));
            $this->db->where('bike_rented.create_at<=', date('Y-m-d', strtotime($dates[1])));
        } //$date != null
        $this->db->where('bike_rented.status', '1');
        $res       = $this->db->get()->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function completeOrders($limit, $offset, $rent_type, $order_id = null, $date = null)
    {
        $dates = explode('-', $date);
        $this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date,(case  when TIMESTAMPDIFF(hour,start_date,end_date)=0  then concat(TIMESTAMPDIFF(minute,start_date,end_date),' minute') when TIMESTAMPDIFF(day,start_date,end_date)=0  then concat(TIMESTAMPDIFF(hour,start_date,end_date),' hour') else concat((TIMESTAMPDIFF(day,start_date,end_date)),' days') end) as duration,(case when bike_details.rent_type='instant' then concat('Rs. ',(TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60) else concat('Rs. ',(TIMESTAMPDIFF(hour,start_date,end_date)*hourly_price)) end) as price")->from("bike_rented")->join("bike_details", "bike_details.id=bike_rented.bike_id", "left")->join("users", "bike_rented.user_id=users.user_id", "left");
        if ($rent_type !== '') {
            $this->db->where('bike_details.rent_type', $rent_type);
        } //$rent_type !== ''
        if ($order_id != null) {
            $order_id = (int) filter_var($order_id, FILTER_SANITIZE_NUMBER_INT);
            $this->db->where('bike_rented.id', $order_id);
        } //$order_id != null
        if ($date != null) {
            $this->db->where('bike_rented.start_date >=', date('Y-m-d', strtotime($dates[0])));
            $this->db->where('bike_rented.start_date<=', date('Y-m-d', strtotime($dates[1])));
        } //$date != null
        $res       = $this->db->where_not_in('bike_rented.status', array(
            '1',
            '2'
        ))->get()->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function allOrders($limit, $offset, $bike_id = null, $user_id)
    {
        $this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date,(TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60 as price,(case when bike_rented.status=3 then 'Complete' else 'Complete' end) as status,users.user_mobile as user_contact")->from("bike_rented")->join("bike_details", "bike_details.id=bike_rented.bike_id", "left")->join("users", "bike_rented.user_id=users.user_id", "left");
        if ($bike_id != null) {
            $res1 = $this->db->where('bike_rented.status', '3')->where('bike_rented.bike_id', $bike_id)->get()->result_array();
        } //$bike_id != null
        else {
            $res1 = $this->db->where('bike_rented.status', '3')->where('bike_rented.user_id', $user_id)->get()->result_array();
        }
        $this->db->select("cancel_bike_orders.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(cancel_bike_orders.booking_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(cancel_bike_orders.cancel_date,'%d/%m/%Y %h:%i %p') as end_date,(TIMESTAMPDIFF(minute,booking_date,cancel_date))*hourly_price/60 as price,users.user_mobile as user_contact,(case when bike_details.rent_type='instant'  then 'Cancel' else 'Cancel' end) as status")->from("cancel_bike_orders")->join("bike_details", "bike_details.id=cancel_bike_orders.bike_id", "left")->join("users", "cancel_bike_orders.user_id=users.user_id", "left");
        if ($bike_id != null) {
            $res2 = $this->db->where('cancel_bike_orders.bike_id', $bike_id)->get()->result_array();
        } //$bike_id != null
        else {
            $res2 = $this->db->where('cancel_bike_orders.user_id', $user_id)->get()->result_array();
        }
        $res       = array_merge($res1, $res2);
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function cancelOrders($limit, $offset, $rent_type, $order_id = null, $date = null)
    {
        $dates = explode('-', $date);
        $this->db->select("cancel_bike_orders.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(cancel_bike_orders.booking_date,'%d/%m/%Y %h:%i %p') as booking_date,DATE_FORMAT(cancel_bike_orders.cancel_date,'%d/%m/%Y %h:%i %p') as cancel_date,cancel_bike_orders.reason as reason")->from("cancel_bike_orders")->join("bike_details", "bike_details.id=cancel_bike_orders.bike_id", "left")->join("users", "cancel_bike_orders.user_id=users.user_id", "left");
        if ($rent_type !== '') {
            $this->db->where('bike_details.rent_type', $rent_type);
        } //$rent_type !== ''
        if ($order_id != null) {
            $order_id = (int) filter_var($order_id, FILTER_SANITIZE_NUMBER_INT);
            $this->db->where('cancel_bike_orders.id', $order_id);
        } //$order_id != null
        if ($date != null) {
            $this->db->where('cancel_bike_orders.cancel_date >=', date('Y-m-d', strtotime($dates[0])));
            $this->db->where('cancel_bike_orders.cancel_date<=', date('Y-m-d', strtotime($dates[1])));
        } //$date != null
        $res       = $this->db->get()->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function cancelOrder($rent_id, $reason)
    {
        $res  = $this->db->where('id', $rent_id)->get('bike_rented')->row_array();
        $data = array(
            'user_id' => $res['user_id'],
            'bike_id' => $res['bike_id'],
            'booking_date' => $res['start_date'],
            'reason' => $reason
        );
        $this->db->insert('cancel_bike_orders', $data);
        $this->db->where('id', $rent_id)->delete('bike_rented');
        return true;
    }
    public function deleteData($table, $id,$status)
    {
        if ($table === 'users') {
            $this->db->set('user_status',$status)->where('user_id', $id)->update($table);
        } //$table === 'users'
        elseif ($table === 'banners') {
            $this->db->where_in('id', explode(',',$id))->delete($table);
        } //$table === 'banners'
        else {
            $this->db->where('id', $id)->delete($table);
        }
        return true;
    }

    public function addPayment($data)
    {
      $this->db->insert('payment',$data);       
      return true;
    }
    
    public function addWallet($data)
    {
      $this->db->insert('wallet',$data);       
      return true;
    }
    public function redeemCoupon($data)
    {
      $this->db->insert('coupon_usage',$data);       
      return true;
    }

    public function unredeemCoupon($data)
    {
      $this->db->where('coupon_id',$data['coupon_id'])->where('user_id',$data['user_id'])->where('order_id',$data['order_id'])->delete('coupon_usage');       
      return true;
    }
}
