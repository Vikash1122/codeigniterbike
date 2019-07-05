<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bike extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function add_bike()
	{		
		$id=$this->input->get('bike_id');		
		$lat=$this->input->get('latitude');
		$long=$this->input->get('longitude');
		$status=$this->input->get('status');		
		$data1=array('bike_id'=>$id,'latitude'=>$lat,'longitude'=>$long,'status'=>strtoupper($status));
		foreach ($data1 as $key=> $value) {
			if(!array_key_exists($key,$this->input->get())){
			$data=array('message'=>$key.' is required','status'=>'false');
			echo json_encode($data);
			exit();
		       }
		       elseif(empty($this->input->get($key))){
		       	$data=array('message'=>$key.' is invalid','status'=>'false');
				echo json_encode($data);
				exit();

		       }
		}
		$state=strtoupper($status);		
		if($state==='WAITING' || $state==='ONRIDE' || $state==='PAUSED' || $state==='END')
		{
		$res=$this->Api_model->addBike($data1);
	     }
	     else{
	     $data=array('message'=>'status is incorrect','status'=>'false');
				echo json_encode($data);
				exit();	
	     }
		if($res)
  	    {  		
  		$data=array('message'=>'Bike added successfully!!','status'=>'true');  	
  		echo json_encode($data);
  		exit();
  	    }
  	    else
  	    {
  		$data=array('message'=>'Sorry bike could not be added','status'=>'false');
  		echo json_encode($data);
  		exit();
  	    }
	}

	public function get_bike()
	{
		$res=$this->Api_model->getBike($this->input->get('bike_id'));
		if($res)
		{
         $data=array('data'=>$res,'status'=>'true');  	
  		 echo json_encode($data);
  		 exit();
		}
		else{
         $data=array('data'=>'no data found','status'=>'false');  	
  		 echo json_encode($data,200);
  		 exit();
		}
	}
	
	// public function get_data()
	// {
	// 	$latitude='28.4782';
	// 	$longitude='77.0898';
	// 	$distance='concat(round((3956 * 2 * ASIN(SQRT( POWER(SIN(('.$latitude.'- latitude) *  pi()/180 / 2), 2) +COS( latitude * pi()/180) * COS(latitude * pi()/180) * POWER(SIN(('.$longitude.'- longitude) * pi()/180 / 2), 2) ))),1)," Km") as distance';
	//      $loc_res=$this->db->select('bike_details.*,bike_locations.name as location,bike_category.name as category,'.$distance)
	//              ->join('bike_details','bike_details.location=bike_locations.id','left')
	//              ->join('bike_category','bike_details.category=bike_category.id','left')
	// 	         ->having('distance <=2')		         
	// 	         ->order_by('distance')
	// 	         ->get('bike_locations')->result();
	// 	         print_r($loc_res);


	// }
}
