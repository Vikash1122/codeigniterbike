<?php
class Corporate_model extends CI_Model
{
    public function addClient($data)
    {
        $this->db->insert('corporate_clients', $data['client_data']);
        $client_id                       = $this->db->insert_id();
        $data['cl_image_data']['cc_id']  = $client_id;
        $data['insurance_data']['cc_id'] = $client_id;
        $data['tax_data']['cc_id']       = $client_id;
        $data['check_data']['cc_id']     = $client_id;
        $data2                           = array(
            '0' => $data['cl_image_data'],
            '1' => $data['insurance_data'],
            '2' => $data['tax_data'],
            '3' => $data['check_data']
        );
        foreach ($data['key_person_data'] as $key => $value) {
            $data['key_person_data'][$key]['cc_id'] = $client_id;
        } //$data['key_person_data'] as $key => $value
        $this->db->insert_batch('corporate_key_person', $data['key_person_data']);
        $this->db->insert_batch('corporate_client_documents', $data2);
        return true;
    }
    public function corporateOrder($data, $cc_id)
    {
        $data['lease_start'] = date("Y-m-d H:i:s", strtotime($data['lease_start']));
        $data['lease_end']   = date("Y-m-d H:i:s", strtotime($data['lease_end']));
        unset($data['user_id']);
        if ($cc_id) {
            unset($data['order_id']);
            $this->db->where('lease_end>=CURDATE()')->where('cc_id', $data['cc_id'])->update('corporate_orders', $data);
        } //$cc_id
        else {
            $this->db->insert('corporate_orders', $data);
        }
        return true;
    }
    public function getOrders($limit, $offset, $cc_id)
    {
        $res       = $this->db->select('id,DATE_FORMAT(lease_start, "%d/%m/%Y") AS lease_start,DATE_FORMAT(lease_end, "%d/%m/%Y") AS lease_end,price,concat(DATEDIFF(lease_end,lease_start)," Days") as duration,bike_id')->where('cc_id', $cc_id)->get('corporate_orders')->result_array();
        $newoffset = ($offset - 1) * $limit;
        $res1      = array_slice($res, $newoffset, $limit);
        return $data = array(
            'data' => $res1,
            'count' => count($res)
        );
    }
    public function getCorporate($limit, $offset, $cc_id = null,$for=null, $order_id ='', $daterange = null, $status = null, $client_name = null)
    {
        $dates = explode('-', $daterange);
        if ($cc_id !== null) { 
            if ($client_name !== null) {
            $corporate_res = $this->db->select('id,client_name,CONCAT_WS(",",address1,address2,city,country) location')->where('id', $cc_id)->like('client_name', $client_name)->or_like('address1', $client_name)->or_like('address2', $client_name)->or_like('city', $client_name)->or_like('country', $client_name)->get('corporate_clients')->result_array();
           }  
           else{
           	$corporate_res = $this->db->select('id,client_name,CONCAT_WS(",",address1,address2,city,country) location')->where('id', $cc_id)->get('corporate_clients')->result_array();
           }     	
            
        } //$cc_id !== null
         //$client_name !== null
        else {
            $corporate_res = $this->db->select('id,client_name,CONCAT_WS(",",address1,address2,city,country) location')->get('corporate_clients')->result_array();
        }
       
        foreach ($corporate_res as $key1 => $value1) {
            if ($cc_id === null) {
                $res1 = $this->db->select('id,lease_start,lease_end,price,concat(DATEDIFF(lease_end,lease_start)," Days") as duration,bike_id')->where('lease_end>=CURDATE()')->where('cc_id', $value1['id'])->get('corporate_orders')->result_array();
            } //$cc_id === null
            else {
                $this->db->select('id,lease_start,lease_end,price,concat(DATEDIFF(lease_end,lease_start)," Days") as duration,bike_id');
                if ($order_id !== '' && $order_id !== null) {                	
                    $this->db->where('id', $order_id);
                } //$order_id !== ''
                if ($daterange !== null && $daterange !== '') {
                    $this->db->where('lease_start >=', date('Y-m-d', strtotime($dates[0])));
                    $this->db->where('lease_start<=', date('Y-m-d', strtotime($dates[1])));
                } //$daterange != null
                if ($status === 'complete') {
                    $this->db->where('lease_end<=CURDATE()');
                } //$status === 'complete'
                if ($status === 'active') {
                    $this->db->where('lease_end>=CURDATE()');
                } //$status === 'active'
                $res1 = $this->db->where('cc_id', $value1['id'])->get('corporate_orders')->result_array();
            }
            if (!empty($res1[0])) {
                $corporate_res[$key1]['tbikes']      = count(explode(',', $res1[0]['bike_id']));
                $corporate_res[$key1]['price']       = $res1[0]['price'];
                $corporate_res[$key1]['lease_start'] = date('Y-m-d', strtotime($res1[0]['lease_start']));
                $corporate_res[$key1]['lease_end']   = date('Y-m-d', strtotime($res1[0]['lease_end']));
                $corporate_res[$key1]['duration']    = $res1[0]['duration'];
                $corporate_res[$key1]['order_id']    = $res1[0]['id'];
            } //!empty($res1[0])
            else {
                $corporate_res[$key1]['tbikes']      = '';
                $corporate_res[$key1]['price']       = '';
                $corporate_res[$key1]['lease_start'] = '';
                $corporate_res[$key1]['lease_end']   = '';
                $corporate_res[$key1]['duration']    = '';
            }
        } //$corporate_res as $key1 => $value1
        $newoffset = ($offset - 1) * $limit;
        $res2      = array_slice($corporate_res, $newoffset, $limit);
        return $data = array(
            'data' => $res2,
            'count' => count($corporate_res)
        );
    }
}