<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');
class Cud extends REST_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $header = $this->input->request_headers();
        if ($this->input->method(true) == 'GET' || $this->input->method(true) == 'DELETE') {
            $method = 'get';
        } //$this->input->method(true) == 'GET' || $this->input->method(true) == 'DELETE'
        else {
            $method = 'post';
        }
        if (array_key_exists('access_token', $header)) {
            if (array_key_exists('user_id', $this->$method())) {
                if (!is_numeric($this->$method('user_id'))) {
                    $data            = array();
                    $data['message'] = "invalid user_id";
                    $data['status']  = "false";
                    $this->response($data, 401);
                    exit();
                } //!is_numeric($this->$method('user_id'))
                $res = $this->Api_model->getToken($this->$method('user_id'), $header['access_token']);
                if (!empty($res)) {
                    $user_res = $this->Api_model->getUserData($this->$method('user_id'));
                    if (!empty($user_res)) {
                        $status = $user_res[0]->user_status;
                        if ($status == '1') {
                            $data            = array();
                            $data['message'] = "user is deactivated";
                            $data['status']  = "false";
                            $this->response($data, 401);
                            exit();
                        } //$status == '1'
                    } //!empty($user_res)
                    else {
                        $data            = array();
                        $data['message'] = "user not exist";
                        $data['status']  = "false";
                        $this->response($data, 404);
                        exit();
                    }
                } //!empty($res)
                else {
                    $data            = array();
                    $data['message'] = "invalid access_token";
                    $data['status']  = "false";
                    $this->response($data, 401);
                    exit();
                }
            } //array_key_exists('user_id', $this->$method())
            else {
                $data            = array();
                $data['message'] = "user_id is required";
                $data['status']  = "false";
                $this->response($data, 401);
                exit();
            }
        } //array_key_exists('access_token', $header)
        else {
            $data            = array();
            $data['message'] = "access_token is required";
            $data['status']  = "false";
            $this->response($data, 401);
            exit();
        }
    }
    public function add_bike_post()
    {
        $id    = $this->post('bike_id');
        $lat   = $this->post('latitude');
        $long  = $this->post('longitude');
        $data1 = array(
            'bike_id' => $id,
            'latitude' => $lat,
            'longitude' => $long
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->post())
            elseif (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->post($key))
        } //$data1 as $key => $value
        $res = $this->Api_model->addBike($data1);
        if ($res) {
            $data = array(
                'message' => 'Bike added successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry bike could not be added',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function get_bike_get()
    {
        $res = $this->Api_model->getBike();
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'data' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function update_user_post()
    {
        $fname      = $this->post('fname');
        $lname      = $this->post('lname');
        $gender     = $this->post('gender');
        $user_id    = $this->post('user_id');
        $dl_no      = $this->post('dl_no');
        $data1      = array(
            'user_firstname' => $fname,
            'user_lastname' => $lname,
            'gender' => $gender,
            'dl_no',
            $dl_no
        );
        $data2      = array(
            'fname' => $fname,
            'lname' => $lname,
            'gender' => $gender
        );
        $target_dir = str_replace('/application', '', APPPATH) . "uploads/users/";
        foreach ($data2 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->post())
            elseif (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->post($key))
        } //$data2 as $key => $value
        if (isset($_FILES['file']) && isset($_FILES['dl_front']) && isset($_FILES['dl_back'])) {
            $temp         = explode(".", $_FILES["file"]["name"]);
            $file         = reset($temp) . '_' . rand() . '.' . end($temp);
            $target_file  = $target_dir . basename($file);
            $temp1        = explode(".", $_FILES["dl_front"]["name"]);
            $file1        = reset($temp1) . '_' . rand() . '.' . end($temp1);
            $target_file1 = $target_dir . basename($file1);
            $temp2        = explode(".", $_FILES["dl_back"]["name"]);
            $file2        = reset($temp2) . '_' . rand() . '.' . end($temp2);
            $target_file2 = $target_dir . basename($file2);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $data1['user_image'] = $file;
            } //move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)
            if (move_uploaded_file($_FILES["dl_front"]["tmp_name"], $target_file1)) {
                $data1['user_dlfront'] = $file1;
            } //move_uploaded_file($_FILES["dl_front"]["tmp_name"], $target_file1)
            if (move_uploaded_file($_FILES["dl_back"]["tmp_name"], $target_file2)) {
                $data1['user_dlback'] = $file2;
            } //move_uploaded_file($_FILES["dl_back"]["tmp_name"], $target_file2)
        } //isset($_FILES['file']) && isset($_FILES['dl_front']) && isset($_FILES['dl_back'])
        else {
            $data = array(
                'message' => 'please choose all files',
                'status' => 'false'
            );
            $this->response($data, 500);
            exit();
        }
        $res = $this->Api_model->updateUser($data1, $user_id);
        if ($res) {
            $data = array(
                'message' => 'user updated successfully',
                'user' => $res[0],
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'error',
                'status' => 'false'
            );
            $this->response($data, 500);
        }
    }
    public function swagbike_dashboard_get()
    {
        $res = $this->Api_model->swagbikeDashboard($this->get('user_id'), $this->get('latitude'), $this->get('longitude'), $this->get('start_date'), $this->get('end_date'));
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'data' => array(),
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function add_card_post()
    {
        $card_name   = $this->post('card_name');
        $bank_name   = $this->post('bank_name');
        $card_no     = $this->post('card_no');
        $card_type   = $this->post('card_type');
        $card_access = $this->post('card_access');
        $card_expire = $this->post('card_expire');
        $data1       = array(
            'user_id' => $this->post('user_id'),
            'card_name' => $card_name,
            'bank_name' => $bank_name,
            'card_no' => $card_no,
            'card_type' => $card_type,
            'card_access' => $card_access,
            'card_expire' => $card_expire
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->post())
            elseif (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->post($key))
        } //$data1 as $key => $value
        $res = $this->Api_model->addCard($data1);
        if ($res) {
            $data = array(
                'message' => 'card added successfully',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry! this card could not be added',
                'status' => 'false'
            );
            $this->response($data, 500);
        }
    }
    public function delete_card_post()
    {
        if (array_key_exists('card_id', $this->post())) {
            if ($userOtp == '') {
                $data['message'] = "invalid card_id";
                $data['status']  = "false";
                $this->response($data, 403);
                exit();
            } //$userOtp == ''
        } //array_key_exists('card_id', $this->post())
        else {
            $data['message'] = "card_id is required";
            $data['status']  = "false";
            $this->response($data, 400);
            exit();
        }
        $res = $this->Api_model->deleteCard($this->post('user_id'), $this->post('card_id'));
        if ($res) {
            $data = array(
                'message' => 'card deleted successfully',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry! this card could not be deleted',
                'status' => 'false'
            );
            $this->response($data, 500);
        }
    }
    public function upload($files, $target_dir)
    {
        if (isset($files['name'])) {
            $count = count($files['name']);
            $data1 = array();
            for ($j = 0; $j < $count; $j++) {
                $temp        = explode(".", $files["name"][$j]);
                $file        = reset($temp) . '_' . strtotime('now') . '.' . end($temp);
                $target_file = $target_dir . basename($file);
                if (move_uploaded_file($files["tmp_name"][$j], $target_file)) {
                    $data1[] = $file;
                } //move_uploaded_file($files["tmp_name"][$j], $target_file)
            } //$j = 0; $j < $count; $j++
            return $data1;
        } //isset($files['name'])
    }
    public function add_bike_details_post()
    {
        $bike_dir          = str_replace('/application', '', APPPATH) . "uploads/bikes/";
        $name              = $this->post('brand') . ' ' . $this->post('model_name');
        $description       = $this->post('description');
        $category          = $this->post('category');
        $brand             = $this->post('brand');
        $model_name        = $this->post('model_name');
        $model_year        = $this->post('model_year');
        $vehicle_no        = $this->post('vehicle_no');
        $fuel_type         = $this->post('fuel_type');
        $fuel_capacity     = $this->post('fuel_capacity');
        $mileage           = $this->post('mileage');
        $engine            = $this->post('engine');
        $transmission_type = $this->post('transmission_type');
        $hourly_price      = $this->post('hourly_price');
        $monthly_price     = $this->post('monthly_price');
        $color             = $this->post('color');
        $purchase_cost     = $this->post('purchase_cost');
        $rto_cost          = $this->post('rto_cost');
        $insurance_cost    = $this->post('insurance_cost');
        $key_type          = $this->post('key_type');
        $rent_type         = $this->post('rent_type');
        $p_issue_date      = date("Y-m-d H:i:s", strtotime($this->post('p_issue_date')));
        $p_exp_date        = date("Y-m-d H:i:s", strtotime($this->post('p_exp_date')));
        $ins_issue_date    = date("Y-m-d H:i:s", strtotime($this->post('ins_issue_date')));
        $ins_exp_date      = date("Y-m-d H:i:s", strtotime($this->post('ins_exp_date')));
        $data1             = array(
            'color' => $color,
            'rent_type' => $rent_type,
            'description' => $description,
            'category' => $category,
            'brand' => $brand,
            'model_name' => $model_name,
            'model_year' => $model_year,
            'vehicle_no' => $vehicle_no,
            'fuel_type' => $fuel_type,
            'fuel_capacity' => $fuel_capacity,
            'mileage' => $mileage,
            'engine' => $engine,
            'transmission_type' => $transmission_type,
            'hourly_price' => $hourly_price,
            'monthly_price' => $monthly_price,
            'purchase_cost' => $purchase_cost,
            'rto_cost' => $rto_cost,
            'insurance_cost' => $insurance_cost,
            'key_type' => $key_type
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->post())
            elseif (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->post($key))
        } //$data1 as $key => $value
        if ($this->post('bike_id')) {
            $bike_image_data     = array();
            $bike_rc_data        = array();
            $bike_insurance_data = array();
            $bike_pollution_data = array();
            if (!empty($_FILES['images'])) {
                $bike_image      = $this->upload($_FILES['images'], $bike_dir);
                $bike_image_data = array(
                    'name' => $bike_image
                );
            } //!empty($_FILES['images'])
            if (!empty($_FILES['rcfile'])) {
                $bike_rc      = $this->upload($_FILES['rcfile'], $bike_dir);
                $bike_rc_data = array(
                    'name' => $bike_rc[0]
                );
            } //!empty($_FILES['rcfile'])
            if (!empty($_FILES['insfile'])) {
                $bike_insurance      = $this->upload($_FILES['insfile'], $bike_dir);
                $bike_insurance_data = array(
                    'name' => $bike_insurance[0],
                    'issue_date' => $ins_issue_date,
                    'expiry_date' => $ins_exp_date
                );
            } //!empty($_FILES['insfile'])
            if (!empty($_FILES['pfile'])) {
                $bike_pollution      = $this->upload($_FILES['pfile'], $bike_dir);
                $bike_pollution_data = array(
                    'name' => $bike_pollution[0],
                    'issue_date' => $p_issue_date,
                    'expiry_date' => $p_exp_date
                );
            } //!empty($_FILES['pfile'])
            $data1['name'] = $name;
            $res           = $this->Api_model->addBikeDetails($data1, $bike_image_data, $bike_rc_data, $bike_insurance_data, $bike_pollution_data, $this->post('bike_id'));
        } //$this->post('bike_id')
        else {
            if (!empty($_FILES['images']) && !empty($_FILES['rcfile']) && !empty($_FILES['insfile']) && !empty($_FILES['pfile'])) {
                $bike_image          = $this->upload($_FILES['images'], $bike_dir);
                $bike_rc             = $this->upload($_FILES['rcfile'], $bike_dir);
                $bike_insurance      = $this->upload($_FILES['insfile'], $bike_dir);
                $bike_pollution      = $this->upload($_FILES['pfile'], $bike_dir);
                $bike_pollution_data = array(
                    'name' => $bike_pollution[0],
                    'issue_date' => $p_issue_date,
                    'expiry_date' => $p_exp_date
                );
                $bike_insurance_data = array(
                    'name' => $bike_insurance[0],
                    'issue_date' => $ins_issue_date,
                    'expiry_date' => $ins_exp_date
                );
                $bike_rc_data        = array(
                    'name' => $bike_rc[0]
                );
                $bike_image_data     = array(
                    'name' => $bike_image
                );
                $data1['name']       = $name;
                $res                 = $this->Api_model->addBikeDetails($data1, $bike_image_data, $bike_rc_data, $bike_insurance_data, $bike_pollution_data);
            } //!empty($_FILES['images']) && !empty($_FILES['rcfile']) && !empty($_FILES['insfile']) && !empty($_FILES['pfile'])
            else {
                $data = array(
                    'message' => 'please select vehicle image',
                    'status' => 'false'
                );
                $this->response($data, 200);
            }
        }
        if ($res) {
            $data = array(
                'message' => 'bike details added successfully',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry! bike details could not be added',
                'status' => 'false'
            );
            $this->response($data, 500);
        }
    }
    public function update_bike_details_post()
    {
        $name              = $this->post('name');
        $bike_id           = $this->post('bike_id');
        $description       = $this->post('description');
        $category          = $this->post('category');
        $brand             = $this->post('brand');
        $model_name        = $this->post('model_name');
        $model_year        = $this->post('model_year');
        $location          = $this->post('location');
        $fuel_type         = $this->post('fuel_type');
        $fuel_capacity     = $this->post('fuel_capacity');
        $mileage           = $this->post('mileage');
        $engine            = $this->post('engine');
        $transmission_type = $this->post('transmission_type');
        $hourly_price      = $this->post('hourly_price');
        $monthly_price     = $this->post('monthly_price');
        if (!$hourly_price) {
            $rent_type = 'lease';
        } //!$hourly_price
        else {
            $rent_type = 'instant';
        }
        $data1 = array(
            'user_id' => $this->post('user_id'),
            'bike_id' => $bike_id,
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'brand' => $brand,
            'model_name' => $model_name,
            'model_year' => $model_year,
            'location' => $location,
            'fuel_type' => $fuel_type,
            'fuel_capacity' => $fuel_capacity,
            'mileage' => $mileage,
            'engine' => $engine,
            'transmission_type' => $transmission_type,
            'hourly_price' => $hourly_price,
            'monthly_price' => $monthly_price,
            'rent_type' => $rent_type
        );
        if (!array_key_exists('bike_id', $this->post())) {
            $data = array(
                'message' => 'bike_id is required',
                'status' => 'false'
            );
            $this->response($data, 400);
            exit();
        } //!array_key_exists('bike_id', $this->post())
        foreach ($this->post() as $key => $value) {
            if (!array_key_exists($key, $data1)) {
                $data = array(
                    'message' => $key . ' is irrelevant field',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $data1)
            if (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->post($key))
        } //$this->post() as $key => $value
        $data3 = $this->post();
        unset($data3['user_id']);
        unset($data3['bike_id']);
        if (empty($data3)) {
            $data = array(
                'message' => 'please select at least one feild to update',
                'status' => 'false'
            );
            $this->response($data, 403);
            exit();
        } //empty($data3)
        $res = $this->Api_model->updateBikeDetails($bike_id, $data3);
        if ($res) {
            $data = array(
                'message' => 'bike details updated successfully',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry! bike details could not be updated',
                'status' => 'false'
            );
            $this->response($data, 500);
        }
    }
    public function get_bike_category_get()
    {
        $res = $this->Api_model->bikeCategory();
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function add_bike_location_post()
    {
        $name  = $this->input->post('name');
        $lat   = $this->input->post('latitude');
        $long  = $this->input->post('longitude');
        $data1 = array(
            'name' => $name,
            'latitude' => $lat,
            'longitude' => $long
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value
        $res = $this->Api_model->addBikeLocation($data1);
        if ($res) {
            $data = array(
                'message' => 'location added successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry location could not be added',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function add_bike_feedback_post()
    {
        $bike_id  = $this->input->post('bike_id');
        $rating   = $this->input->post('rating');
        $feedback = $this->input->post('feedback');
        $data1    = array(
            'bike_id' => $bike_id,
            'user_id' => $this->post('user_id'),
            'rating' => $rating,
            'feedback' => $feedback
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value
        $res = $this->Api_model->addBikeFeedback($data1);
        if ($res) {
            $data = array(
                'message' => 'bike_feedback added successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry bike_feedback could not be added',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function add_rent_bike_post()
    {
        $bike_id        = $this->input->post('bike_id');
        $status         = $this->input->post('status');
        $payment_method = $this->input->post('payment_method');
        $user_id        = $this->input->post('user_id');
        if($this->post('order_type')==='lease')
        {
        	 $data1 = array(
                'bike_id' => $bike_id,
                'user_id' => $user_id,
                'payment_method' => $payment_method,                
                'start_date' => $this->post('start_date'),
                'end_date' => $this->post('end_date'),
                'amount' => $this->post('amount'),
                'order_type' => 'lease'
            );           
        }
        elseif ($status === '1') {
            $data1 = array(
                'bike_id' => $bike_id,
                'user_id' => $user_id,
                'payment_method' => $payment_method,
                'status' => $status
            );
        } //$status == '1'
        else {
            $data1 = array(
                'rent_id' => $this->post('rent_id'),
                'status' => $status
            );
        }
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value
        $dl = $this->db->select('dl_no,user_dlfront,user_dlback')->where('user_id', $user_id)->get('users')->row_array();
        if (!empty($dl)) {
            if (!$dl['dl_no'] && !$dl['user_dlfront'] && !$dl['user_dlback']) {
                $data = array(
                    'message' => 'Please upload dl first',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!$dl['dl_no'] && !$dl['user_dlfront'] && !$dl['user_dlback']
        } //!empty($dl)        
        $res = $this->Api_model->addRentBike($data1, $this->post('rent_id'), $this->post('status'),$this->post('order_type'));
        if ($res) {
            $data = array(
                'message' => 'rent_bike added successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry rent_bike could not be added',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function add_to_favourite_post()
    {
        $bike_id = $this->input->post('bike_id');
        $status  = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $data1   = array(
            'bike_id' => $bike_id,
            'user_id' => $user_id,
            'status' => $status
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value
        $res = $this->Api_model->addFavourite($data1);
        if ($res) {
            $data = array(
                'message' => 'this bike has been added to your favourite list successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry this bike could not be added in your favourite list',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function get_favourite_get()
    {
        $res = $this->Api_model->getFavourite($this->get('user_id'));
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_savedcard_get()
    {
        $res = $this->Api_model->getCard($this->get('user_id'));
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function bike_service_post()
    {
        $bike_id       = $this->post('bike_id');
        $description   = $this->post('description');
        $location      = $this->post('location');
        $current_km    = $this->post('current_km');
        $date          = date('Y-m-d', strtotime($this->post('date')));
        $next_due_km   = $this->post('next_due_km');
        $next_due_date = date('Y-m-d', strtotime($this->post('next_due_date')));
        $data1         = array(
            'bike_id' => $bike_id,
            'current_km' => $current_km,
            'location' => $location,
            'date' => $date,
            'next_due_date' => $next_due_date,
            'next_due_km' => $next_due_km,
            'description' => $description
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 200);
                exit();
            } //!array_key_exists($key, $this->post())
            if (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 200);
                exit();
            } //empty($this->post($key))
            if (array_key_exists($key, $this->post())) {
                if (($key === 'current_km') || ($key === 'next_due_km')) {
                    if (!filter_var($this->post($key), FILTER_VALIDATE_INT)) {
                        $data = array(
                            'message' => $key . ' is invalid,use numbers only',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //!filter_var($this->post($key), FILTER_VALIDATE_INT)
                    if ($current_km >= $next_due_km) {
                        $data = array(
                            'message' => 'next_due_km should be greater than from current_km',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //$current_km >= $next_due_km
                } //($key === 'current_km') || ($key === 'next_due_km')
                elseif ($key === 'next_due_date') {
                    if ($date >= $next_due_date) {
                        $data = array(
                            'message' => $key . ' should be greater than from current servicing date',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //$date >= $next_due_date
                } //$key === 'next_due_date'
                    elseif ($key === 'description') {
                    if (!preg_match('/[A-Za-z]/', $this->post($key))) {
                        $data = array(
                            'message' => $key . ' is invalid,use string only',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //!preg_match('/[A-Za-z]/', $this->post($key))
                } //$key === 'description'
            } //array_key_exists($key, $this->post())
        } //$data1 as $key => $value
        $res = $this->Api_model->addBikeService($data1);
        if ($res) {
            $data = array(
                'message' => 'this bike service has been added successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
            exit();
        } //$res
        else {
            $data = array(
                'message' => 'Sorry this bike service could not be added',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        }
    }
    public function get_users_get()
    {
        $res = $this->Api_model->getUsers($this->get('perpage'), $this->get('page'), $this->get('status'), $this->get('name'), $this->get('dl_no'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_allbikes_get()
    {
        $res = $this->Api_model->getAllBikes($this->get('perpage'), $this->get('page'), $this->get('vehicle_type'), $this->get('mode'), $this->get('cc_id'), $this->get('c_order'), $this->get('category'), $this->get('model_name'), $this->get('brand'), $this->get('color'), $this->get('name'), $this->get('model_year'), $this->get('engine'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_brand_get()
    {
        $res = $this->Api_model->getBrands($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_category_get()
    {
        $res = $this->Api_model->getCategory($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_model_get()
    {
        $res = $this->Api_model->getModels($this->get('brand'), $this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_modelyear_get()
    {
        $res = $this->Api_model->getYear($this->get('model'), $this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_colors_get()
    {
        $res = $this->Api_model->getColor($this->get('model'), $this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_bike_location_get()
    {
        $res = $this->Api_model->getBikeLocation($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function add_csv_post()
    {
        $res = $this->Api_model->addCsv($this->post('name'), $this->post('table'), $this->post('latitude'), $this->post('longitude'));
        if ($res) {
            $data = array(
                'message' => 'data has been added successfully!!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! data could not been added',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_dependent_get()
    {
        if (array_key_exists('brand', $this->input->get())) {
            $res = $this->Api_model->getCategory(null, null, $this->get('brand'), $this->get('rent_type'));
        } //array_key_exists('brand', $this->input->get())
        if (array_key_exists('category', $this->input->get())) {
            $res = $this->Api_model->getModels(null, null, null, $this->get('category'), $this->get('rent_type'));
        } //array_key_exists('category', $this->input->get())
        if (array_key_exists('model', $this->input->get())) {
            $res = $this->Api_model->getYear($this->get('model'), null, null, $this->get('rent_type'));
        } //array_key_exists('model', $this->input->get())
        if (array_key_exists('modelyear', $this->input->get())) {
            $res = $this->Api_model->getColor(null, null, null, $this->get('modelyear'), $this->get('rent_type'));
        } //array_key_exists('modelyear', $this->input->get())
        if (array_key_exists('modelcolor', $this->input->get())) {
            $res = $this->Api_model->getEngine($this->get('modelcolor'), $this->get('rent_type'));
        } //array_key_exists('modelcolor', $this->input->get())
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_active_ride_get()
    {
        $res = $this->Api_model->getActiveRide($this->get('user_id'), '1', '2');
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_ongoing_ride_get()
    {
        $res = $this->Api_model->getActiveRide($this->get('user_id'), '2');
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_completed_ride_get()
    {
        $res = $this->Api_model->getCompletedRide($this->get('user_id'), '3');
        if ($res) {
            $data = array(
                'data' => $res,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function addBanner_post()
    {
        $target_dir = str_replace('/application', '', APPPATH) . "uploads/banners/";
        if (isset($_FILES['file'])) {
            $temp        = explode(".", $_FILES["file"]["name"]);
            $file        = reset($temp) . '_' . rand() . '.' . end($temp);
            $target_file = $target_dir . basename($file);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $data1['name'] = $file;
            } //move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)
            $this->db->insert('banners', $data1);
        } //isset($_FILES['file'])
    }
    public function running_banner_post()
    {
        $res = $this->Api_model->ruuningBanners($this->post('banner_id'));
        if ($res) {
            $data = array(
                'message' => 'banner has been added in running list successfully!!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! data could not been added',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function add_coupon_post()
    {
        $code          = $this->input->post('code');
        $total_coupon  = $this->input->post('total_coupon');
        $per_use       = $this->input->post('per_use');
        $coupon_value  = $this->input->post('coupon_value');
        $detail        = $this->input->post('detail');
        $validity      = $this->input->post('validity');
        $criteria      = $this->input->post('criteria');
        $next_due_date = $this->input->post('next_due_date');
        $data1         = array(
            'code' => $code,
            'coupon_value' => $coupon_value,
            'total_coupon' => $total_coupon,
            'per_use' => $per_use,
            'detail' => $detail,
            'criteria' => $criteria            
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 200);               
                exit();
            } //!array_key_exists($key, $this->post())
            if (empty($this->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 200);
                exit();
            } //empty($this->post($key))
            if (array_key_exists($key, $this->post())) {
                if ($key === 'code') {
                    if (!preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $this->post($key))) {
                        $data = array(
                            'message' => $key . ' is invalid,use string and numbers both',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //!preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $this->post($key))
                } //$key === 'code'
                elseif (($key === 'per_use') || ($key === 'total_coupon')) {
                    if (!filter_var($this->post($key), FILTER_VALIDATE_INT)) {
                        $data = array(
                            'message' => $key . ' is invalid',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //!filter_var($this->post($key), FILTER_VALIDATE_INT)
                } //($key === 'per_use') || ($key === 'total_coupon')
                    elseif ($key === 'detail') {
                    if (!preg_match('/[A-Za-z]/', $this->post($key))) {
                        $data = array(
                            'message' => $key . ' is invalid',
                            'status' => 'false'
                        );
                        $this->response($data, 200);
                        exit();
                    } //!preg_match('/[A-Za-z]/', $this->post($key))
                } //$key === 'detail'
            } //array_key_exists($key, $this->post())
        } //$data1 as $key => $value
        $validity            = explode('-', $this->post('validity'));
        $data1['start_date'] = date('Y-m-d', strtotime($validity[0]));
        $data1['end_date']   = date('Y-m-d', strtotime($validity[1]));
        $res                 = $this->Api_model->addCoupon($data1);
        if ($res) {
            $data = array(
                'message' => 'coupon has been added  successfully!!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! coupon could not been added',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_coupons_get()
    {
        $res = $this->Api_model->getCoupons($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_orders_get()
    {
        if ($this->get('status') == 'active') {
            $res = $this->Api_model->activeOrders($this->get('perpage'), $this->get('page'), $this->get('rent_type'), $this->get('order_id'), $this->get('daterange'));
        } //$this->get('status') == 'active'
        if ($this->get('status') == 'ongoing') {
            $res = $this->Api_model->ongoingOrders($this->get('perpage'), $this->get('page'), $this->get('rent_type'), $this->get('order_id'), $this->get('daterange'));
        } //$this->get('status') == 'ongoing'
        if ($this->get('status') == 'complete') {
            $res = $this->Api_model->completeOrders($this->get('perpage'), $this->get('page'), $this->get('rent_type'), $this->get('order_id'), $this->get('daterange'));
        } //$this->get('status') == 'complete'
        if ($this->get('status') == 'cancel') {
            $res = $this->Api_model->cancelOrders($this->get('perpage'), $this->get('page'), $this->get('rent_type'), $this->get('order_id'), $this->get('daterange'));
        } //$this->get('status') == 'cancel'
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_all_orders_get()
    {
        if ($this->get('bike_id')) {
            $res = $this->Api_model->allOrders($this->get('perpage'), $this->get('page'), $this->get('bike_id'), '');
        } //$this->get('bike_id')
        else {
            $res = $this->Api_model->allOrders($this->get('perpage'), $this->get('page'), '', $this->get('cust_id'));
        }
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_wallet_users_get()
    {
        $res = $this->Api_model->getWalletUsers($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_wallet_history_get()
    {
        $res = $this->Api_model->getWalletHistory($this->get('perpage'), $this->get('page'), $this->get('customer_id'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_coupon_usage_get()
    {
        $res = $this->Api_model->getCouponUsage($this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_bike_service_get()
    {
        $res = $this->Api_model->getBikeService($this->get('bike_id'), $this->get('perpage'), $this->get('page'));
        if ($res) {
            $res['status'] = 'true';
            $this->response($res, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function delete_data_post()
    {
        $res = $this->Api_model->deleteData($this->post('table'), $this->post('id'),$this->post('status'));
        if ($res) {
            $data = array(
                'message' => 'data has been deleted successfully!!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! data could not been deleted',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function get_locations_get()
    {
        $like = $this->get('like');
        if (!$like) {
            $data = array(
                'message' => 'like is not valid string',
                'status' => 'false'
            );
            $this->response($data, 200);
            exit();
        } //!$like
        $result = array_filter(all_bike_location(), function($item) use ($like)
        {
            if (stripos($item['location'], $like) !== false) {
                return true;
            } //stripos($item['location'], $like) !== false
            return false;
        });
        $result = array_values($result);
        if (!empty($result)) {
            $data = array(
                'data' => $result,
                'status' => 'true'
            );
            $this->response($data, 200);
        } //!empty($result)
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function cancel_order_post()
    {
        $rent_id = $this->post('rent_id');
        $reason  = $this->post('reason');
        if (!$rent_id) {
            $data = array(
                'message' => 'rent_id is not valid',
                'status' => 'false'
            );
            $this->response($data, 400);
            exit();
        } //!$rent_id
        if (!$reason) {
            $data = array(
                'message' => 'reason is not valid',
                'status' => 'false'
            );
            $this->response($data, 400);
            exit();
        } //!$reason
        $res = $this->Api_model->cancelOrder($rent_id, $reason);
        if ($res) {
            $data = array(
                'message' => 'ride cancelled successfully!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'no data found',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
    public function send_invoice_post()
    {
        $encodedData = str_replace(' ', '+', $this->post('filedata'));
        $data1       = base64_decode($encodedData);
        $file        = fopen('uploads/invoice.pdf', 'w');
        fwrite($file, $data1);
        fclose($file);
        $config              = array();
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'info@swagbikes.in';
        $config['smtp_pass'] = 'swa123**';
        $config['smtp_port'] = 465;
        $config['mailtype']  = 'html';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('info@swagbikes.in', 'Swagbike');
        $this->email->to('faisal@teastallstudio.com');
        if(!$this->post('for')){
        $this->email->subject('Swagbike Corporate Invoice');
           }
        else{
        $this->email->subject('Swagbike Invoice'); 	
           }
        $this->email->message('Please find your invoice below for order_id=' . $this->post('order_id') . '');
        $this->email->attach('uploads/invoice.pdf');
        $this->email->send();
        unlink('uploads/invoice.pdf');
        $data = array(
            'message' => 'Invoice has been sent successfully',
            'status' => 'true'
        );
        $this->response($data, 200);
    }
    
    public function redeem_coupon_post()
    {
    	$coupon_id = $this->input->post('coupon_id');
    	$order_id = $this->input->post('order_id');
    	$criteria = $this->input->post('criteria');
    	$net_price = $this->input->post('net_price');
        $user_id  = $this->input->post('user_id');        
        $data1   = array(
            'coupon_id' => $coupon_id,
            'order_id' => $order_id,
            'criteria' => $criteria,
            'net_price' => $net_price         
        );
        $data2   = array(
            'coupon_id' => $coupon_id,
            'order_id' => $order_id,
            'user_id' => $user_id          
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value
        
       $coupon_res=$this->db->where('id',$coupon_id)->where('end_date>=curdate()')->where('criteria',$criteria)->get('coupons')->row_array();
       if(empty($coupon_res))
       {
       	$data = array(
                    'message' =>'coupon is invalid or expired',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
       }
       $total_coupon_usage=$this->db->where('coupon_id',$coupon_id)->get('coupon_usage')->num_rows();
       $single_user_usage=$this->db->where('user_id',$user_id)->where('coupon_id',$coupon_id)->get('coupon_usage')->num_rows();

       if($coupon_res['total_coupon']===$total_coupon_usage)
       {
       	       	$data = array(
                    'message' =>'total coupon limit exceeded',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
       }

       if($single_user_usage===$coupon_res['per_use'])
       {
       	       	$data = array(
                    'message' =>'coupon peruser limit exceeded',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
       }
       
        $res = $this->Api_model->redeemCoupon($data2);
        $redeem_value=$net_price*($coupon_res['coupon_value']/100);
        $final_price=$net_price-$redeem_value;
        if ($res) {
            $data = array(
                'data' => array('redeem_value'=>$redeem_value,'final_price'=>$final_price),
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! coupon redeem could be done',
                'status' => 'false'
            );
            $this->response($data, 200);
        }    
    }

    public function unredeem_coupon_post()
    {
    	$coupon_id = $this->input->post('coupon_id');
    	$order_id = $this->input->post('order_id');    	
        $user_id  = $this->input->post('user_id');      
        $data1   = array(
            'coupon_id' => $coupon_id,
            'order_id' => $order_id,
            'user_id' => $user_id          
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value

        $res = $this->Api_model->unredeemCoupon($data1);        
        if ($res) {
            $data = array(
                'data' =>'restore coupon successfully!!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! coupon could be restored',
                'status' => 'false'
            );
            $this->response($data, 200);
        }   
        
    }

    public function add_payment_post()
    {
    	$order_id = $this->input->post('order_id');
        $status  = $this->input->post('status');
        $pay_method = $this->input->post('method');
        $order_type = $this->input->post('order_type');
        $amount = $this->input->post('amount');
        $data1   = array(
            'order_id' => $order_id,
            'method' => $pay_method,
            'status' => $status,
            'amount' => $amount,
            'order_type' => $order_type
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value

        $res = $this->Api_model->addPayment($data1);
        if ($res) {
            $data = array(
                'message' => 'payment has successfully done!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! payment could not be done',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }

    public function add_wallet_post()
    {
    	$user_id = $this->input->post('user_id');
        $amount = $this->input->post('amount');
        $data1   = array(            
            'amount' => $amount            
        );
        $data2   = array(            
            'amount' => $amount, 
            'transaction_type' => 'cr',
            'transaction_for' => 'none',
            'user_id'=>$user_id           
        );
        foreach ($data1 as $key => $value) {
            if (!array_key_exists($key, $this->input->post())) {
                $data = array(
                    'message' => $key . ' is required',
                    'status' => 'false'
                );
                $this->response($data, 400);
                exit();
            } //!array_key_exists($key, $this->input->post())
            elseif (empty($this->input->post($key))) {
                $data = array(
                    'message' => $key . ' is invalid',
                    'status' => 'false'
                );
                $this->response($data, 403);
                exit();
            } //empty($this->input->post($key))
        } //$data1 as $key => $value

        $res = $this->Api_model->addWallet($data2);
        if ($res) {
            $data = array(
                'message' => 'amount has been added successfully in wallet!!',
                'status' => 'true'
            );
            $this->response($data, 200);
        } //$res
        else {
            $data = array(
                'message' => 'Sorry!! amount could not added in wallet',
                'status' => 'false'
            );
            $this->response($data, 200);
        }
    }
}