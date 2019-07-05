<?php 
$brand_res=$this->db->select('DISTINCT(name)')->get('bike_brands')->result();
$category_res=$this->db->select('DISTINCT(name)')->get('bike_category')->result();
$bike_image=$this->db->select("image_name,concat('".base_url()."uploads/bikes/',image_name) as image_url")->where('bike_id',$_GET['id'])->get('bike_images')->result_array();
$color_res=$this->db->select('DISTINCT(name)')->get('bike_color')->result();
$model_res=$this->db->select('DISTINCT(name)')->get('bike_models')->result();
$year_res=$this->db->select('DISTINCT(name)')->get('bike_year')->result();
$location_res=$this->db->select('DISTINCT(name)')->get('bike_locations')->result();
$bike_details=$this->db->where('id',$_GET['id'])->get('bike_details')->row_array();
$bike_rc=$this->db->select(",concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_rc')->row_array();
$bike_insurance=$this->db->select("*,concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_insurance')->row_array();
$bike_pollution=$this->db->select("*,concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_pollution')->row_array();
// echo "<pre>";
// print_r($bike_details);
// die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Swag Bike</title>
<?php include 'css.php';?>
<link href="css/new-style.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
<div class="container-scroller">
<?php include 'nev-1.php';?>
<ul class="navbar-nav mr-lg-2">
<li class="nav-item d-none d-lg-block">
<h4 class="mb-0">Edit Vehicle</h4>
</li>
</ul>
<?php include 'nev-2.php';?>
<div class="container-fluid page-body-wrapper">                   
<?php include 'menu.php';?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<form class="forms-sample" action="#" method="post" enctype="multipart/form-data"  id="myform">
<!-- onsubmit="return saveData('myform')" -->
<div class="row">
<div class="col-md-12">
<h4 class="card-title">Basic Information</h4>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Type</label>
<select class="js-example-basic-single w-100" name="rent_type" id="rent_type">
    <option value="instant" <?php if($bike_details['rent_type']=='instant'){echo "selected='selected'";} ?>>Instant</option>
    <option value="lease" <?php if($bike_details['rent_type']=='lease'){echo "selected='selected'";} ?>>Lease</option>                                                                    
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Brand</label>
<select class="js-example-basic-single w-100" name="brand">
<?php foreach($brand_res as $value){?>
    <option value="<?=$value->name?>" <?php if($bike_details['brand']==$value->name){echo "selected='selected'";} ?>><?=$value->name;?></option>
    <?php }?>
   
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Category</label>
<select class="js-example-basic-single w-100" name="category">
    <?php foreach($category_res as $value){?>
    <option value="<?=$value->name?>"  <?php if($bike_details['category']==$value->name){echo "selected='selected'";} ?>><?=$value->name;?></option>
    <?php }?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<input type="hidden" name="bike_id" value="<?php echo $_GET['id']?>">
<label>Model Name</label>
<select class="js-example-basic-single w-100" name="model_name">
    <?php foreach($model_res as $value){?>
    <option value="<?=$value->name?>" <?php if($bike_details['model_name']==$value->name){echo "selected='selected'";} ?>><?=$value->name;?></option>
    <?php }?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Model Year</label>
<select class="js-example-basic-single w-100" name="model_year">
    <?php foreach($year_res as $value){?>
    <option value="<?=$value->name?>" <?php if($bike_details['model_year']==$value->name){echo "selected='selected'";} ?>><?=$value->name;?></option>
    <?php }?>
</select>
</div>
</div>                                                        
<div class="col-md-3">
<div class="form-group">
<label>Color</label>
<select class="js-example-basic-single w-100" name="color">
   <?php foreach($color_res as $value){?>
    <option value="<?=$value->name?>" <?php if($bike_details['color']==strtolower($value->name)){echo "selected='selected'";} ?>><?=$value->name;?></option>
    <?php }?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Vehicle No.</label>
<input type="text" class="form-control form-control-md" placeholder="" name="vehicle_no" required="required" value="<?php echo $bike_details['vehicle_no']?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Transmission Type</label>
<select class="js-example-basic-single w-100" name="transmission_type">
    <option value="both" <?php if($bike_details['transmission_type']=='both'){echo "selected='selected'";} ?>>Both</option>
    <option value="manual" <?php if($bike_details['transmission_type']=='manual'){echo "selected='selected'";} ?>>Manual</option>
    <option value="automatic" <?php if($bike_details['transmission_type']=='automatic'){echo "selected='selected'";} ?>>Automatic</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Fuel Type</label>
<select class="js-example-basic-single w-100" name="fuel_type" >
    <option value="petrol" <?php if($bike_details['fuel_type']=='petrol'){echo "selected='selected'";} ?>>Petrol</option>
    <option value="electric" <?php if($bike_details['fuel_type']=='electric'){echo "selected='selected'";} ?>>Electric</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Key Type</label>
<select class="js-example-basic-single w-100" name="key_type" >
    <option value="keyless" <?php if($bike_details['key_type']=='keyless'){echo "selected='selected'";} ?>>Keyless</option>
    <option value="withkey" <?php if($bike_details['key_type']=='withkey'){echo "selected='selected'";} ?>>With Key</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Fuel Capacity</label>
<input type="text" class="form-control form-control-md" placeholder="" name="fuel_capacity" required="required" value="<?php echo $bike_details['fuel_capacity']?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Mileage</label>
<input type="text" class="form-control form-control-md" placeholder="" name="mileage" required="required" value="<?php echo $bike_details['mileage']?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Engine</label>
<input type="text" class="form-control form-control-md" placeholder="" name="engine" required="required" value="<?php echo $bike_details['engine']?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Purchase Cost</label>
<input type="text" class="form-control form-control-md" placeholder="" name="purchase_cost" required="required" value="<?php echo $bike_details['purchase_cost']?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>RTO Cost</label>
<input type="text" class="form-control form-control-md" placeholder="" name="rto_cost" required="required" value="<?php echo $bike_details['rto_cost']?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Insurance Cost</label>
<input type="text" class="form-control form-control-md" placeholder="" name="insurance_cost" required="required" value="<?php echo $bike_details['insurance_cost']?>">
</div>
</div>
<div class="clearfix"></div>

<div class="col-md-12">
<h4 class="card-title">Price</h4>
<div class="form-group">
<!--  <div class="form-check">
    <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
    Hourly
    </label>
</div>
<div class="form-check">
    <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
    Monthly
    </label>
</div> -->
</div>
<div class="clearfix"></div>
<div class="row">
<div class="form-group col-md-6" id="hourly_price">
<label>Hourly Price</label>
<input type="text" style="max-width:50%;" class="form-control form-control-md" placeholder="" name="hourly_price" required="required" value="<?php echo $bike_details['hourly_price']?>">
</div>
<div class="form-group col-md-6" id="monthly_price" >
<label>Monthly Price</label>
<input type="text" style="max-width:50%;" class="form-control form-control-md" placeholder="" name="monthly_price" required="required" value="<?php echo $bike_details['monthly_price']?>">
</div>
</div>
<div class="form-group ">
<label>Description</label>
<input type="text" class="form-control form-control-md" placeholder="" name="description" required="required" value="<?php echo $bike_details['description']?>">
</div>
</div>

</div>                                             
</div>
</div>
</div>
<div class="col-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">

<div class="row">
<div class="col-md-12">
<h4 class="card-title">Upload Document <!-- <button type="button" class="btn btn-primary btn-sm float-right">Add More</button> --></h4>
</div>
<!--  <div class="col-lg-12 grid-margin stretch-card">
<p>Vehicle Image</p>
</div> -->
<div class="col-lg-12 grid-margin stretch-card">
<!-- <div action="../api/cud/add_bike_detail" class="dropzone d-flex align-items-center w-100" id="my-awesome-dropzone" method="post" enctype="multipart-formdata"></div> -->

</div>

<div class="col-md-4">
<div class="form-group">
<label>RC</label>
<input type="file" class="dropify"  name="rcfile[]" data-default-file="<?php echo $bike_rc['image_url']?>"/>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Insurance</label>
<input type="file" class="dropify" name="insfile[]" data-default-file="<?php echo $bike_insurance['image_url']?>"/>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label>Issue Date</label>
        <input type="text" class="form-control form-control-md birthday" name="ins_issue_date" value="<?php echo date("m/d/Y",strtotime($bike_insurance['issue_date']))?>" /> 
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Expiry Date</label>
        <input type="text" class="form-control form-control-md birthday" name="ins_exp_date" value="<?php echo date("m/d/Y",strtotime($bike_insurance['expiry_date']))?>" /> 
    </div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Polution</label>
<input type="file" class="dropify"  id="userfile" name="pfile[]" data-default-file="<?php echo $bike_pollution['image_url']?>"/>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label>Issue Date</label>
        <input type="text" class="form-control form-control-md birthday" name="p_issue_date" value="<?php echo date("m/d/Y",strtotime($bike_pollution['issue_date']))?>"/> 
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Expiry Date</label>
        <input type="text" class="form-control form-control-md birthday" name="p_exp_date" value="<?php echo date("m/d/Y",strtotime($bike_pollution['expiry_date']))?>" /> 
    </div>
</div>
</div>
</div>
<div class="col-lg-12 grid-margin">
<label>Vehicle Image</label>
<input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple="">

<div class="row" id="image_preview"><?php foreach($bike_image as $val){?><div class='col-md-3 pclass"+i+"'>  <img style='width:100%;' src='<?php echo $val['image_url']?>'></div><?php }?></div>
<!-- <div action="http://www.urbanui.com/file-upload" class="dropzone d-flex align-items-center w-100" id="my-awesome-dropzone"></div> -->
</div>
</div>
<div class="col-md-12 text-center">
<button type="button" class="btn btn-dark btn-sm">Cancel</button>
<button type="submit" class="btn btn-primary btn-sm">Update</button>
</div>

</form>
</div>
</div>
</div>


</div>
</div>
<?php include 'footer.php';?>
</div>
</div>
</div>
<?php include 'script.php';?>

<script src="js/file-upload.js"></script>
<!-- <script src="js/iCheck.js"></script> -->
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>


<script src="js/form-addons.js"></script>
<script src="js/x-editable.js"></script>
<script src="js/dropify.js"></script> 
<script src="js/dropify-multiple.js"></script>
<script src="js/jquery-file-upload.js"></script>
<script src="js/formpickers.js"></script>
<script src="js/form-repeater.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script> 
$('#monthly_price').hide();
$('#rent_type').on('change',function(){   
if($(this).val()==='instant')
{
  $('#monthly_price').hide();
   $('#hourly_price').show();
}
else{
    $('#hourly_price').hide();
    $('#monthly_price').show();
}
})

$(function() {
$('.birthday').daterangepicker({
singleDatePicker: true,
showDropdowns: true,
minYear: 1901,

}, 
function(start, end, label) {
var years = moment().diff(start, 'years');
//alert("You are " + years + " years old!");
});
});
function preview_images() 
{
$('#image_preview').html('');
var total_file=document.getElementById("images").files.length;
for(var i=0;i<total_file;i++)
{
//<a href='#' onclick='removeDiv("+i+")'></a>
$('#image_preview').append("<div class='col-md-3 pclass"+i+"'>  <img style='width:100%;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
}
}
$('#images').on("change",preview_images);

$('form#myform').submit(function(){
event.preventDefault();               
var formdata = new FormData($(this)[0]) ;
formdata.append("user_id",user.user_id);        
formdata.append("pfile[]",$('input[name="pfile[]"]')[0].files[0]);
formdata.append("insfile[]",$('input[name="insfile[]"]')[0].files[0]);
formdata.append("rcfile[]",$('input[name="rcfile[]"]')[0].files[0]);
if($('#rent_type').val()==='lease')
{
    var vehicletype='leaseVehicle';
}
else{
    vehicletype='instantVehicle';
}
$.ajax({
headers: {
'access_token':sessionStorage.getItem('access_token'),  
},

data:formdata,
method:'post', 
enctype: 'multipart/form-data',   
contentType: false,
processData: false, 
url:'/swagbike/api/cud/add_bike_details',
success:function(res){
console.log(res);
if($.trim(res.status)=='true'){                                
alert('bike details has been updated successfully!!');
window.location.href = '/swagbike/admin/'+vehicletype+'';
}
}
})
});      



</script>
</body>

</html>