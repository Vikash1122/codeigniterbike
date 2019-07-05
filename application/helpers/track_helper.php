<?php
$CI =& get_instance();
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return round(($miles * 1.609344),0);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}
function all_bike_location($v_no=null)
{
$str = file_get_contents('http://13.127.144.213/webservice?token=getLiveData&user=Acumentrack6612&pass=Acumen@123&format=json');
$json = json_decode($str, true);
$res1=$json["root"]["VehicleData"];
$data=array();   
// $curl = curl_init();       
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://13.127.144.213/webservice?token=getLiveData&user=Acumentrack6612&pass=Acumen@123&format=json",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",         
//   CURLOPT_HTTPHEADER => array(
//     "accept: application/json",            
//     "content-type: application/json"
//   ),
// ));

//$response = curl_exec($curl);
//$err = curl_error($curl);

//curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
    
//     $res=json_decode($response,true);

// $res1=$res["root"]["VehicleData "];
// }

foreach ($res1 as $key=>  $value) {            
$distance= distance( '23.1002517','72.5051933', $value['Latitude'], $value['Longitude'], 'K');
// if($distance<=10)
// {
if(($v_no!==null))
{
 if($v_no===$value['Vehicle_No']){
$data[]= array('lat'=>(float)$value['Latitude'],'lng'=>(float)$value['Longitude'],'location'=>$value['Location'],'vehicle_no'=>$value['Vehicle_No'],'status'=>$value['Status'],'distance'=>$distance.' Km');
   }
   // else{
   //  $data1=array();
   // }
//$data[]=$data1;

}
else{
$data[]= array('lat'=>(float)$value['Latitude'],'lng'=>(float)$value['Longitude'],'location'=>$value['Location'],'vehicle_no'=>$value['Vehicle_No'],'status'=>$value['Status'],'distance'=>$distance.' Km');
}

//}
}

return $data;
}
function bike_location($vehicle_no,$dist=null,$lat=null,$long=null){

// $curl = curl_init();       
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://13.127.144.213/webservice?token=getLiveData&user=Acumentrack6612&pass=Acumen@123&vehicle_no=$vehicle_no&format=json",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",         
//   CURLOPT_HTTPHEADER => array(
//     "accept: application/json",            
//     "content-type: application/json"
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);
//$res1=$json["root"]["VehicleData "];    
  // $res=json_decode($response,true);
   $str = file_get_contents("http://13.127.144.213/webservice?token=getLiveData&user=Acumentrack6612&pass=Acumen@123&vehicle_no=$vehicle_no&format=json");

  $res = json_decode($str, true);
   if(isset($res["root"]["VehicleData"])){
   $res1=$res["root"]["VehicleData"][0];
   if($dist!=null){
   $distance= distance( $lat,$long, $res1['Latitude'], $res1['Longitude'], 'K');
    if($distance<=$dist)
    {
    
    $data= array('lat'=>$res1['Latitude'],'long'=>$res1['Longitude'],'distance'=>$distance.' Km','location'=>$res1['Location']);

    }
    else{
      $data=array();
    }
   }
   else{
   $data=array('lat'=>$res1['Latitude'],'long'=>$res1['Longitude'],'location'=>$res1['Location']);
    }
    if(!empty($data)){
   return $data;
}

}


 }



 