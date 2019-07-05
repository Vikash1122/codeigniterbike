<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
class Corporate extends REST_Controller {

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
	public function __construct()
        {
            parent::__construct(); 
            $header=$this->input->request_headers();            
            if($this->input->method(true)=='GET'||$this->input->method(true)=='DELETE')
            {
            $method='get';
            }           
            else{
            	$method='post';
            }

            if(array_key_exists('access_token',$header)){            
              if(array_key_exists('user_id',$this->$method())){  
                if(!is_numeric($this->$method('user_id'))) {
	                $data=array();
			     	$data['message']="invalid user_id";
			     	$data['status']="false";
			        $this->response($data,401);
			        exit();
                }     
                $res=$this->Api_model->getToken($this->$method('user_id'),$header['access_token'],$this->$method('for'));             
			     if(!empty($res)){
			     	$user_res=$this->Api_model->getUserData($this->$method('user_id'),$this->$method('for'));
			     	if(!empty($user_res)){		  
			        $status=$user_res[0]->user_status;
			        if($status=='1')
			        {
			        $data=array();
			     	$data['message']="user is deactivated";
			     	$data['status']="false";
			        $this->response($data,401);
			        exit();
			        }
			        }
			        else{
			     	$data=array();
			     	$data['message']="user not exist";
			     	$data['status']="false";
			        $this->response($data,404);
			        exit();
			        }
			      }
			      else{
			      	$data=array();
			     	$data['message']="invalid access_token";
			     	$data['status']="false";
			        $this->response($data,401);
			        exit();
			      }
		     }
		    else{
                $data=array();
		     	$data['message']="user_id is required";
		     	$data['status']="false";
		        $this->response($data,401);
		        exit();
		      }
		    }
		    else{
		    	$data=array();
		     	$data['message']="access_token is required";
		     	$data['status']="false";
		        $this->response($data,401);
		        exit();
		    }	    
        }

  public function upload($files,$target_dir)
  {
	  if(isset($files['name'])){
		 $count=count($files['name']);
		 $data1=array();
		for($j=0;$j<$count; $j++){
			$temp = explode(".", $files["name"][$j]);
		    $file = reset($temp).'_'.strtotime('now').'.'.end($temp);
			$target_file =$target_dir.basename($file);		
		    if(move_uploaded_file($files["tmp_name"][$j],$target_file)){
			 $data1[] =$file;
			}
	    }	
	     return $data1;
	  }
  }

  public function add_client_post()
  {
  	$corporate_dir = str_replace('/application', '', APPPATH)."uploads/corporate/";  	
  	$client_data=array('client_name'=>$this->post('client_name'),'address1'=>$this->post('address1'),'address2'=>$this->post('address2'),'city'=>$this->post('country'),'email'=>$this->post('email'),'landline'=>$this->post('landline'),'mobile'=>$this->post('mobile'),'website'=>$this->post('website'),'buiseness_type'=>$this->post('buiseness_type'),'trade_license'=>$this->post('trade_license'),'tax_reg_no'=>$this->post('tax_reg_no'),'payment_terms'=>$this->post('payment_terms'),'bank_name'=>$this->post('bank'),'ifsc_code'=>$this->post('ifsc_code'),'account_no'=>$this->post('account_no'),'holder_name'=>$this->post('holder_name'));	
		foreach ($client_data as $key=> $value) {
			if(!array_key_exists($key,$this->post())){
			$data=array('message'=>$key.' is required','status'=>'false');
			$this->response($data,200);
			exit();
		       }
		       elseif(empty($this->post($key))){
		       	$data=array('message'=>$key.' is invalid','status'=>'false');
				$this->response($data,200);
				exit();

		       }
		}
		foreach ($this->post('group-a') as $key1 => $value1) {			
  		$key_person_data[]=array('department'=>$value1['department'],'name'=>$value1['name'],'designation'=>$value1['designation'],'contact'=>$value1['contact'],'email'=>$value1['email']);
  		 foreach ($key_person_data[$key1] as $key2=> $value2) {  		 	
			if(!array_key_exists($key2,$value1)){
			$data=array('message'=>$key2.' is required','status'=>'false');
			$this->response($data,200);
			exit();
		       }
		       elseif($value2===''){		    
		       	$data=array('message'=>$key2.' is invalid','status'=>'false');
				$this->response($data,200);
				exit();

		       }	
  	       }
  	   	    
		}

		if(!empty($_FILES['cl'])&& !empty($_FILES['insurance']) && !empty($_FILES['tax_certificate']) &&!empty($_FILES['cancel_check']))
		{
		$cl_image=$this->upload($_FILES['cl'],$corporate_dir);
  	    $insurance_image=$this->upload($_FILES['insurance'],$corporate_dir);
  	    $tax_certificate=$this->upload($_FILES['tax_certificate'],$corporate_dir);
  	    $cancel_check=$this->upload($_FILES['cancel_check'],$corporate_dir);
  	    $cl_image_data=array('name'=>$cl_image[0],'issue_date'=>date("Y-m-d H:i:s",strtotime($this->post('cl_issue_date'))),'expiry_date'=>date("Y-m-d H:i:s",strtotime($this->post('cl_exp_date'))),'doc_type'=>'1');
		$insurance_data=array('name'=>$insurance_image[0],'issue_date'=>date("Y-m-d H:i:s",strtotime($this->post('ins_issue_date'))),'expiry_date'=>date("Y-m-d H:i:s",strtotime($this->post('ins_exp_date'))),'doc_type'=>'3');
		$tax_data=array('name'=>$tax_certificate[0],'issue_date'=>date("Y-m-d H:i:s",strtotime($this->post('tc_issue_date'))),'expiry_date'=>date("Y-m-d H:i:s",strtotime($this->post('tc_exp_date'))),'doc_type'=>'2');	
		$check_data=array('name'=>$cancel_check[0],'doc_type'=>'4','issue_date'=>null,'expiry_date'=>null);
		$maindata=array();
		$maindata['client_data']=$client_data;
		$maindata['cl_image_data']=$cl_image_data;
		$maindata['insurance_data']=$insurance_data;
		$maindata['tax_data']=$tax_data;
		$maindata['check_data']=$check_data;
		$maindata['key_person_data']=$key_person_data;
		 $res=$this->Corporate_model->addClient($maindata);
		}
		else{
            $data=array('message'=>'please select all documents','status'=>'false');
			$this->response($data,200);
		}
		
		if($res)
		{   
			$config = array();
			$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com' ;
            $config['smtp_user'] = 'info@swagbikes.in';
            $config['smtp_pass'] = 'swa123**';
            $config['smtp_port'] = 465;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('info@swagbikes.in', 'Swagbike');
			$this->email->to($this->post("email"));

			$this->email->subject('Swagbike Corporate');
			$this->email->message('Yor login details are, user_name:'.$this->post("email").',password:12345,login_url:http://192.168.1.82/swagbike/corporate/login');
            $this->email->send();
			$data=array('message'=>'data has been added successfully','status'=>'true');
			$this->response($data,200);
		}
		else{
			$data=array('message'=>'Sorry! data could not be added','status'=>'false');
			$this->response($data,500);
		}	
	    
  }
  public function corporate_order_post()
  {
   	 $res=$this->Corporate_model->corporateOrder($this->post(),$this->post('order_id'));
		if($res)
		{
			$data=array('message'=>'order has been created successfully','status'=>'true');
			$this->response($data,200);
		}
		else{
			$data=array('message'=>'Sorry! data could not be added','status'=>'false');
			$this->response($data,500);
		}	
  }
  public function get_orders_get()
  {
  	$res=$this->Corporate_model->getOrders($this->get('perpage'),$this->get('page'),$this->get('cc_id'));
		if($res)
		{
			$res['status']='true';
			$this->response($res,200);
		}
		else{
			$data=array('message'=>'no data found','status'=>'false');
			$this->response($data,200);
		}
  }

  public function get_corporate_get()
  {
  	$res=$this->Corporate_model->getCorporate($this->get('perpage'),$this->get('page'),$this->get('cc_id'),$this->get('for'),$this->get('order_id'),$this->get('daterange'),$this->get('status'),$this->get('client_name'));  
		if($res)
		{
			$res['status']='true';
			$this->response($res,200);
		}
		else{
			$data=array('message'=>'no data found','status'=>'false');
			$this->response($data,200);
		}
  }



}