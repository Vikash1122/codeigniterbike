<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
class Login extends REST_Controller {

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
            $static_token='8f3a07f4b8575c447078a203ff97d21806384458f8cfb3e4def94773dfc6077f62588383408be7c2'; 
            $header=$this->input->request_headers();             
              if(array_key_exists('access_token',$header)){                
		         if($static_token!=$header['access_token']){
			     	$data=array();
			     	$data['message']="invalid access_token";
			     	$data['status']="false";
			        $this->response($data,400);
			        exit();
			     }		       
		    }
		    else{		    	 
		    	$data['message']="access_token is required";
		     	$data['status']="false";
		     	$this->response($data,401);		      
		        exit();
		      }		  
		        
        }
    public function login_post()
    {
    	$email=$this->post('email');
    	$password=$this->post('password');
    	$mobile='';
    	$exist=$this->Api_model->getUserExist($mobile,$email,$password);
    	if($exist)
    	{
    	  $generated_token=bin2hex(openssl_random_pseudo_bytes('40'));
    	  $userid=$exist[0]->user_id;
		  $status=$exist[0]->user_status;
		 if($userid && $status=='0'){
		 $this->Api_model->addToken($userid,$generated_token);                 
         $data=array('user'=>$exist[0],'status'=>'true','access_token'=>$generated_token);
         $this->response($data,200);
			exit();          
		 }
		 elseif ($userid && $status=='1') {
		 	$data=array('message'=>'user is deactivated','status'=>'false');
		 	$this->response($data,400);
			exit();
		 }
		 else{         
         $this->Api_model->addToken($userid,$generated_token);        
         $data=array('user'=>$exist[0],'status'=>'true','access_token'=>$generated_token);
         $this->response($data,200);
         exit();    		
    	 }
    	}
    	else{
    		    $data['message']="no data found";
		     	$data['status']="false";		     	
		        $this->response($data,200);
		        exit();	
    	}
    }
	
	public function corporate_login_post()
    {
    	$email=$this->post('email');
    	$password=$this->post('password');
    	$mobile='';
    	$exist=$this->Api_model->getUserExist($mobile,$email,$password,'corporate');
    	if($exist)
    	{
    	  $generated_token=bin2hex(openssl_random_pseudo_bytes('40'));
    	  $userid=$exist[0]->id;
		  $status=$exist[0]->status;
		 if($userid && $status=='0'){
		 	$this->session->set_userdata('client_id', $userid);
		 $this->Api_model->addToken($userid,$generated_token,'corporate');                 
         $data=array('user'=>$exist[0],'status'=>'true','access_token'=>$generated_token);
         $this->response($data,200);
			exit();          
		 }
		 elseif ($userid && $status=='1') {
		 	$data=array('message'=>'user is deactivated','status'=>'false');
		 	$this->response($data,400);
			exit();
		 }
		 else{
		 $this->session->set_userdata('client_id', $userid);         
         $this->Api_model->addToken($userid,$generated_token,'corporate');        
         $data=array('user'=>$exist[0],'status'=>'true','access_token'=>$generated_token);
         $this->response($data,200);
         exit();    		
    	 }
    	}
    	else{
    		    $data['message']="no data found";
		     	$data['status']="false";		     	
		        $this->response($data,200);
		        exit();	
    	}
    }
	public function sendOtp_post()
	{		
	  if(array_key_exists('mobile_number', $this->post())){		
		if(preg_match('/^[0-9]{9,10}+$/', $this->post('mobile_number')) == true){
			$mobile=$this->post('country_code').$this->post('mobile_number');
			$otp= $this->Api_model->insertOtp($mobile);
			$message='Your otp is '.$otp;
			//$this->send_sms->sendSms($mobile,$message);       
			$data=array('otp'=>$otp,'status'=>'true');
			echo json_encode($data);
			exit();
	     }
	     else{
				$data['message']="invalid mobile_number";
				$data['status']="false";		     	
				$this->response($data,403);
				exit();		      
		    }	  
	    }
	     else{
		    	$data['message']="mobile_number is required";
		     	$data['status']="false";		     	
		        $this->response($data,400);
		        exit();		      
		    }	   

	}	
	public function verify_post()
	{
		$userOtp=$this->post('otp');
		$mobile_number=$this->post('country_code').$this->post('mobile_number');
		$fcm_token=$this->post('fcm_token');
		$device_type=$this->post('device_type');
		$role=$this->post('role');
		$fname=$this->post('fname');
		$lname=$this->post('lname');
		$email=$this->post('email');
		$password=$this->post('password');
		$target_dir = str_replace('/application', '', APPPATH)."uploads/users/";
	    $data1=array('user_firstname'=>$fname,'user_lastname'=>$lname,'device_type'=>$device_type,'user_role'=>$role,'user_email'=>$email,'user_mobile'=>$mobile_number,'password'=>$password,'fcm_token'=>$fcm_token,'device_type'=>$device_type);
		if(array_key_exists('mobile_number', $this->post())){		
		 if(preg_match('/^[0-9]{9,10}+$/', $this->post('mobile_number')) == false){
			$data['message']="invalid mobile_number";
			$data['status']="false";
			$this->response($data,403);
			exit();
		}
	     }
	    else{
	    	$data['message']="mobile_number is required";
			$data['status']="false";
			$this->response($data,400);
			exit();
	    }
		if(array_key_exists('role', $this->post())){
		 if($role=='')
		{
			$data['message']="invalid role";
			$data['status']="false";
			$this->response($data,403);
			exit();
		}
	   }
	   else{
	   	   $data['message']="role is required";
			$data['status']="false";
			$this->response($data,403);
			exit();
	   }
		if(array_key_exists('otp', $this->post())){
		 if($userOtp=='')
		{
			$data['message']="invalid otp";
			$data['status']="false";
			$this->response($data,403);
			exit();
		}
	   }
	   else{
            $data['message']="otp is required";
			$data['status']="false";
			$this->response($data,400);
			exit();
	   }
	    $otp=$this->Api_model->getOtp($mobile_number);		
		$generated_token=bin2hex(openssl_random_pseudo_bytes('40'));				
		if($userOtp==$otp)
		{
		  $user_res=$this->Api_model->getUserExist($mobile_number);
		  if($user_res){		  
		  $userid=$user_res[0]->user_id;
		  $status=$user_res[0]->user_status;
		 if($userid && $status=='0'){
		 $this->Api_model->addToken($userid,$generated_token);
		  if(isset($_FILES['file'])){
	        $temp = explode(".", $_FILES["file"]["name"]);
	        $file = reset($temp).'_'.rand().'.'.end($temp);
			$target_file =$target_dir.basename($file);		
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
			 $data1['user_image']=$file;
	         
	         }
	        }
	         else{
	         	$data1['user_image']='';
	         }
		 $this->Api_model->updateUser($data1,$userid);		
         $res= $this->Api_model->getUserData($mobile_number);        
         $data=array('message'=>'successfully registered!!!','user'=>$res[0],'status'=>'true','access_token'=>$generated_token);
         $this->response($data,200);
			exit();          
		 }
		 elseif ($userid && $status=='1') {
		 	$data=array('message'=>'user is deactivated','status'=>'false');
		 	$this->response($data,400);
			exit();
		 }
		 }
		 else{	
		  if(isset($_FILES['file'])){
	        $temp = explode(".", $_FILES["file"]["name"]);
	        $file = reset($temp).'_'.rand().'.'.end($temp);
			$target_file =$target_dir.basename($file);		
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
			 $data1['user_image']=$file;
	         
	         }
	        }
	         else{
	         	$data1['user_image']='';
	         }
			 $userid= $this->Api_model->addUserData($data1);
	         $this->Api_model->addToken($userid,$generated_token);	
	         $res= $this->Api_model->getUserData($mobile_number);
	         $data=array('message'=>'successfully registered!!!','user'=>$res[0],'status'=>'true','access_token'=>$generated_token);
	         $this->response($data,200);
	         exit();
				
		 }
		}
		else{
			$data['message']="otp does not match";
			$data['status']="false";
			$this->response($data,400);
			exit();
		}
		
		
	}

	public function change_password_post()
	{
		    $res=$this->db->where('email',$this->post('email'))->get('corporate_clients')->row_array();
		    if(empty($res))
		    {
		    $data['message']="Sorry!! No account found of this email id";
			$data['status']="false";
			$this->response($data,200);
			exit();
		    }
		    $res1=$this->db->where('user_id',$res['id'])->get('corporate_tokens')->row_array();
		    
		    $config = array();
			$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com' ;
            $config['smtp_user'] = 'info@swagbikes.in';
            $config['smtp_pass'] = 'swa123**';
            $config['smtp_port'] = 465;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('info@swagbikes.in', 'Swagbike');
			$this->email->to($this->post('email'));

			$this->email->subject('Swagbike Corporate');
			$this->email->message('Please click on link to reset password, link:http://13.233.239.210/swagbike/corporate/forgotPassword?user_id='.$res1['user_id'].'&token='.$res1['token'].'');
            $this->email->send();
            $data['message']="Reset password link has been sent to your registered email id";
			$data['status']="true";
			$this->response($data,200);
			exit();
	}

	public function update_password_post()
	{
		$res=$this->db->where('user_id',$this->post('user_id'))->where('token',$this->post('token'))->get('corporate_tokens')->row_array();
		if(empty($res))
		    {
		    $data['message']="Invalid link or token";
			$data['status']="false";
			$this->response($data,200);
			exit();
		    }

		if(($this->post('newpassword')==='') || ($this->post('cnfpass')===''))
		{
			$data['message']="all fields are required";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		if(strlen($this->post('newpassword'))<=5)
		{
			$data['message']="password length should be more than 5 character!!";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		if($this->post('newpassword')!==$this->post('cnfpass'))
		{
			$data['message']="both password should be same!!";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		else{
			$this->db->set('password',$this->post('newpassword'))->where('id',$this->post('user_id'))->update('corporate_clients');
			$data['message']="Password updated successfully click to go login page!!";
			$data['status']="true";
			$this->response($data,200);
			exit();
		}
	}
	

	public function update_users_password_post(){
        //print_r($this->post());die;
		$res=$this->db->where('user_id',$this->post('user_id'))->where('token',$this->post('token'))->get('access_tokens')->row_array();
        //print_r($res);die;

		if(empty($res))
		    {
		    $data['message']="Invalid link or token";
			$data['status']="false";
			$this->response($data,200);
			exit();
		    }

		if(($this->post('newpassword')==='') || ($this->post('cnfpass')===''))
		{
			$data['message']="all fields are required";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		if(strlen($this->post('newpassword'))<=5)
		{
			$data['message']="password length should be more than 5 character!!";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		if($this->post('newpassword')!==$this->post('cnfpass'))
		{
			$data['message']="both password should be same!!";
			$data['status']="false";
			$this->response($data,200);
			exit();
		}
		else{
			$this->db->set('password',$this->post('newpassword'))->where('user_id',$this->post('user_id'))->update('users');
			$data['message']="Password updated successfully click to go login page!!";
			$data['status']="true";
			$this->response($data,200);
			exit();
		}

	}
	
}
