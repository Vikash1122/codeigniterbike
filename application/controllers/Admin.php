<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function index()
	{
		$this->load->view('admin/dashboard.php');
	}
	public function userList()
	{
		$this->load->view('admin/user-list.php');
	}
	public function swagWallet()
	{
		$this->load->view('admin/wallet.php');
	}
	public function leaseVehicle()
	{
		$this->load->view('admin/vehicle-list.php');
	}
	public function instantVehicle()
	{
	  $this->load->view('admin/vehicle-list.php');
	}
	public function setting()
	{
		$this->load->view('admin/satting.php');
	}
	public function addVehicle()
	{
		$bike_id = $this->db
           ->select('GROUP_CONCAT(bike_id SEPARATOR ",") as bike_id')
           ->get('bike_images')->row_array();

        $ids = explode(',',$bike_id['bike_id']);
        $bikeIds = $this->db
           ->select('id')
           ->where_not_in('id',$ids)
           ->get('bike_details')->result_array();
         //print_r($bikeIds); die();
           $data['bikeIds']= $bikeIds;
		$this->load->view('admin/add-vehicle.php',$data);
	}
	public function completeOrders()
	{
		$this->load->view('admin/complete-order.php');
	}

	public function cancelOrders()
	{
		$this->load->view('admin/cancel-order.php');
	}

	public function activeOrders()
	{
		$this->load->view('admin/order-list1.php');
	}
	public function ongoingOrders()
	{
		$this->load->view('admin/order-list.php');
	}	
	public function corporateLease()
	{
		$this->load->view('admin/corporate-lease.php');
	}
	public function corporateLeaseDetail()
	{
		$this->load->view('admin/corporate-lease-details.php');
	}
	public function corporateClient()
	{
		$this->load->view('admin/add-corporate-client.php');
	}
	
	public function availableVehicle()
	{
		$this->load->view('admin/lease-vehicle.php');
	}
	public function vehicleDetails()
	{
		$this->load->view('admin/vehicle-details.php');
	}
	public function bannerList()
	{
		$this->load->view('admin/banner-list.php');
	}
	public function addBanner()
	{
		$this->load->view('admin/add-banner.php');
	}

	public function couponList()
	{
		$this->load->view('admin/coupon-list.php');		
	}

	public function addCoupon()
	{
		$this->load->view('admin/add-coupon.php');		
	}
	public function couponUsers()
	{
		$this->load->view('admin/coupon-user-list.php');		
	}

	public function userDetail()
	{
		$this->load->view('admin/user-details.php');
	}

	public function bikeMap()
	{
		$this->load->view('admin/bike-map.php');
	}
	public function getbikelocation()
	{
		$v_no= $this->input->get('vehicle_no');
		if($v_no!==''){
			
			if(!empty(all_bike_location($v_no)[0])){
				$data=array('status'=>'true','data'=>all_bike_location($v_no));

           echo json_encode($data,true);
                }
                else{
                	$data=array('status'=>'false','data'=>array());
                	echo json_encode($data,true);;
                }
		}
		else{
			$data=array('status'=>'true','data'=>all_bike_location());
		echo json_encode($data,true);
	      }
	}

	public function completeOrderDetails()
	{
		$this->load->view('admin/order-details.php');
	}
	public function cancelOrderDetails()
	{
		$this->load->view('admin/cancel-order-details.php');
	}
	public function ongoingOrderDetails()
	{
		$this->load->view('admin/ongoing-order-details.php');
	}
	public function activeOrderDetails()
	{
		$this->load->view('admin/active-order-details.php');
	}
	public function editVehicle()
	{
		$this->load->view('admin/edit-vehicle.php');
	}

	public function walletHistory()
	{
		$this->load->view('admin/wallet_history.php');
	}

	public function corporateInvoice()
	{
		$this->load->view('admin/invoice-1.php');
	}

	public function invoice()
	{
		$this->load->view('admin/invoice.php');
	}
	public function addCsvFile()
	{
			$count=0;
				$filename=$_FILES["csv_upload"]["tmp_name"];
				print_r($filename);die;
				$ins_data = array();
				if($_FILES["csv_upload"]["size"] > 0){
					$file = fopen($filename, "r");
					while (($csv_line = fgetcsv($file,4096)) !== FALSE)	{
						$count++;
						if($count == 1){
							continue;
						}
							if($csv_line[0]) { $ins_data['rent_type'] = $csv_line[0]; }
							if($csv_line[1]) { $ins_data['brand'] = $csv_line[1]; }
							if($csv_line[2]) { $ins_data['category'] = $csv_line[2]; }
							if($csv_line[3]) { $ins_data['model_name'] = $csv_line[3]; }
							if($csv_line[4]) { $ins_data['model_year'] = $csv_line[4]; }
							if($csv_line[5]) { $ins_data['color'] = $csv_line[5]; }
							if($csv_line[6]) { $ins_data['vehicle_no'] = $csv_line[6]; }
							if($csv_line[7]) { $ins_data['transmission_type'] = $csv_line[7]; }
							if($csv_line[8]) { $ins_data['fuel_type'] = $csv_line[8]; }
							if($csv_line[9]) { $ins_data['key_type'] = $csv_line[9]; }
							if($csv_line[10]) { $ins_data['fuel_capacity'] = $csv_line[10]; }
							if($csv_line[11]) { $ins_data['mileage'] = $csv_line[11]; }
							if($csv_line[12]) { $ins_data['engine'] = $csv_line[12]; }
							if($csv_line[13]) { $ins_data['purchase_cost'] = $csv_line[13]; }
							if($csv_line[14]) { $ins_data['rto_cost'] = $csv_line[14]; }
							if($csv_line[15]) { $ins_data['insurance_cost'] = $csv_line[15]; }
							if($csv_line[16]) { $ins_data['hourly_price'] = $csv_line[16]; }
							if($csv_line[17]) { $ins_data['description'] = $csv_line[17]; }

							$ins_data['name'] = $ins_data['brand']." ".$ins_data['model_name'];
							$res = $this->db->insert('bike_details', $ins_data);
					}
						$this->session->set_flashdata('msg','Bulk Uploaded Successfully');
	 					 // $this->load->view('admin/vehicle-list.php');
						redirect('Admin/instantVehicle');
	
				}else{
					$this->session->set_flashdata('msg','No Data Found In CSV File');
	 					 // $this->load->view('admin/vehicle-list.php');
						redirect('Admin/instantVehicle');
				}
				fclose($file);
	}
	public function imageUpload(){
		//$bike_id = array_map(null, $_POST["bike_ids"]); 
		//$bike_dir = str_replace('/application', '', APPPATH) . "uploads/bikes/";
		//$targetDir = base_url()."upload/bikes/";
			$targetDir =$_SERVER['DOCUMENT_ROOT'].'/swagbike/uploads/bikes/';
			//print_r($targetDir);die;
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $files = $_FILES;
        $count = count($_FILES['files']['name']);
        for($i=0; $i<$count; $i++) {
                $_FILES['file_name']['name']= $files['files']['name'][$i];
                $_FILES['file_name']['type']= $files['files']['type'][$i];
                $_FILES['file_name']['tmp_name']= $files['files']['tmp_name'][$i];
                $_FILES['file_name']['error']= $files['files']['error'][$i];
                $_FILES['file_name']['size']= $files['files']['size'][$i];
                $images[] = $_FILES['file_name']['name'];
               
                $targetFilePath = $targetDir.$_FILES['file_name']['name'];
                // print_r($targetFilePath); 
                move_uploaded_file($_FILES['file_name']['tmp_name'],$targetFilePath);
               // move_uploaded_file($_FILES['file_name']['tmp_name'][$i],$bike_dir.$_FILES['files']['name'][$i]);
        } //die;         
            $data1 = array('image'=>$images);
            $dt = array_merge($_POST,$data1);
           // echo "<pre>"; print_r($dt); echo"</pre>"; die();
            foreach($dt['bike_ids'] as $bike_id){
            	
            	foreach($dt['image'] as $k=>$img){
            		$insert = array(
            			'bike_id'=>$bike_id,
            			'image_name'=>$img
            		);
            		$res = $this->db->insert('bike_images', $insert);
            	}
            }
	        if($res){
	        	$this->session->set_flashdata('msg','Bulk Image Upload Successfully!');
		 					 // $this->load->view('admin/vehicle-list.php');
							redirect('Admin/instantVehicle');
			}else{
				$this->session->set_flashdata('msg','Bulk Image Upload Failed!');
		 					 // $this->load->view('admin/vehicle-list.php');
							redirect('Admin/instantVehicle');
			}
            
        }   

}