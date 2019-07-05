<?php 
//print_r($bikeIds);die();
 //echo $bikeIds;die();
   $brand_res=$this->db->select('DISTINCT(name)')->get('bike_brands')->result();
   $category_res=$this->db->select('DISTINCT(name)')->get('bike_category')->result();
   $color_res=$this->db->select('DISTINCT(name)')->get('bike_color')->result();
   $model_res=$this->db->select('DISTINCT(name)')->get('bike_models')->result();
   $year_res=$this->db->select('DISTINCT(name)')->get('bike_year')->result();
   $location_res=$this->db->select('DISTINCT(name)')->get('bike_locations')->result();
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
      <style>
      a {
    color: #333;
 }
         .container{
    margin-top:20px;
}
.image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   padding: 0;
   font-size: 20px;
   cursor: pointer;
   opacity: 0;
   filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
 .multisel-native-select {
  position: relative;
}
.multiselect{
   text-align: left;;
}
 .multisel-native-select select {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px -1px -1px -3px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important;
  left: 50%;
  top: 30px;
}
 .multisel-container {
  position: absolute;
  list-style-type: none;
  margin: 0;
  padding: 0;
}
 .multisel-container .input-group {
  margin: 5px;
}
 .multiselect-container li {
  padding-left: 4px 18px;

}
 .multisel-container li .multisel-all label {
  font-weight: 700;
}
 .multisel-container li a {
  padding: 0;
}
 .multisel-container li a label {
  margin: 0;
  height: 100%;
  cursor: pointer;
  font-weight: 400;
  padding: 3px 20px 3px 40px;
}
 .multisel-container li a label input[type=checkbox] {
  margin-bottom: 5px;
}
 .multisel-container li a label.radio {
  margin: 0;
}
 .multisel-container li a label.checkbox {
  margin: 0;
}
 .multisel-container li.multisel-group label {
  margin: 0;
  padding: 3px 20px 3px 20px;
  height: 100%;
  font-weight: 700;
}
 .multisel-container li.multisel-group-clickable label {
  cursor: pointer;
}
 .btn-group .btn-group .multisel.btn {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
 .form-inline .multisel-container label.checkbox {
  padding: 3px 20px 3px 40px;
}
 .form-inline .multisel-container label.radio {
  padding: 3px 20px 3px 40px;
}
 .form-inline .multiselect-container li a label.checkbox input[type=checkbox] {
  margin-left: -20px;
  margin-right: 0;
}
 .form-inline .multisel-container li a label.radio input[type=radio] {
  margin-left: -20px;
  margin-right: 0;
}


      </style>
   </head>
   <body>
      <div class="container-scroller">
         <?php include 'nev-1.php';?>
         <ul class="navbar-nav mr-lg-2">
            <li class="nav-item d-none d-lg-block">
               <h4 class="mb-0">Add Vehicle</h4>
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
                                 <button  data-toggle="modal" data-target="#exampleModal-3" class="btn btn-primary">Bulk Upload</button>  
                                 <button  data-toggle="modal" data-target="#exampleModal-4" class="btn btn-primary">Images Upload</button>
                                 
                          </div>
                        </div>
                     </div>
                    
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
                                             <option value="instant">Instant</option>
                                             <option value="lease">Lease</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Brand</label>
                                          <select class="js-example-basic-single w-100" name="brand">
                                             <?php foreach($brand_res as $value){?>
                                             <option value="<?=$value->name?>"><?=$value->name;?></option>
                                             <?php }?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Category</label>
                                          <select class="js-example-basic-single w-100" name="category">
                                             <?php foreach($category_res as $value){?>
                                             <option value="<?=$value->name?>"><?=$value->name;?></option>
                                             <?php }?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Model Name</label>
                                          <select class="js-example-basic-single w-100" name="model_name">
                                             <?php foreach($model_res as $value){?>
                                             <option value="<?=$value->name?>"><?=$value->name;?></option>
                                             <?php }?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Model Year</label>
                                          <select class="js-example-basic-single w-100" name="model_year">
                                             <?php foreach($year_res as $value){?>
                                             <option value="<?=$value->name?>"><?=$value->name;?></option>
                                             <?php }?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Color</label>
                                          <select class="js-example-basic-single w-100" name="color">
                                             <?php foreach($color_res as $value){?>
                                             <option value="<?=$value->name?>"><?=$value->name;?></option>
                                             <?php }?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Vehicle No.</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="vehicle_no" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Transmission Type</label>
                                          <select class="js-example-basic-single w-100" name="transmission_type">
                                             <option value="both">Both</option>
                                             <option value="manual">Manual</option>
                                             <option value="automatic">Automatic</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Fuel Type</label>
                                          <select class="js-example-basic-single w-100" name="fuel_type" >
                                             <option value="petrol">Petrol</option>
                                             <option value="electric">Electric</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Key Type</label>
                                          <select class="js-example-basic-single w-100" name="key_type" >
                                             <option value="keyless">Keyless</option>
                                             <option value="withkey">With Key</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Fuel Capacity</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="fuel_capacity" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Mileage</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="mileage" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Engine</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="engine" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Purchase Cost</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="purchase_cost" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>RTO Cost</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="rto_cost" required="required">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Insurance Cost</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="insurance_cost" required="required">
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
                                             <input type="text" style="max-width:50%;" class="form-control form-control-md" placeholder="" name="hourly_price" required="required">
                                          </div>
                                          <div class="form-group col-md-6" id="monthly_price">
                                             <label>Monthly Price</label>
                                             <input type="text" style="max-width:50%;" class="form-control form-control-md" placeholder="" name="monthly_price" required="required">
                                          </div>
                                       </div>
                                       <div class="form-group ">
                                          <label>Description</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="description" required="required">
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
                     <input type="file" class="dropify"  name="rcfile[]" />
                     </div>
                     </div>
                     <div class="col-md-4">
                     <div class="form-group">
                     <label>Insurance</label>
                     <input type="file" class="dropify" name="insfile[]" />
                     </div>
                     <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                     <label>Issue Date</label>
                     <input type="text" class="form-control form-control-md birthday" name="ins_issue_date" value="" /> 
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                     <label>Expiry Date</label>
                     <input type="text" class="form-control form-control-md birthday" name="ins_exp_date" value="" /> 
                     </div>
                     </div>
                     </div>
                     </div>
                     <div class="col-md-4">
                     <div class="form-group">
                     <label>Polution</label>
                     <input type="file" class="dropify"  id="userfile" name="pfile[]" />
                     </div>
                     <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                     <label>Issue Date</label>
                     <input type="text" class="form-control form-control-md birthday" name="p_issue_date" value="" /> 
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                     <label>Expiry Date</label>
                     <input type="text" class="form-control form-control-md birthday" name="p_exp_date" value="" /> 
                     </div>
                     </div>
                     </div>
                     </div>
                     <div class="col-lg-12 grid-margin">
                     <label>Vehicle Image</label>
                     <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple="">
                     <div class="row" id="image_preview"></div>
                     <!-- <div action="http://www.urbanui.com/file-upload" class="dropzone d-flex align-items-center w-100" id="my-awesome-dropzone"></div> -->
                     </div>
                     </div>
                     <div class="col-md-12 text-center">
                     <button type="button" class="btn btn-dark btn-sm">Cancel</button>
                     <button type="submit" class="btn btn-primary btn-sm">Save</button>
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
      <div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="display: none;">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add Model Name </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
            <div class="modal-body">
         <form action="<?php print site_url();?>Admin/addCsvFile" method="post" enctype="multipart/form-data"  id="myform1">
            <div class="clearfix">
               
            </div>
            <div class="form-group">
               <label>Upload Csv file </label>
                   
                     <input type="file" class="dropify" name="csv_upload" required>
            </div>
            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                  <button type="button" class="btn btn-light btn-sm"><a href="<?php print site_url();?>uploads/csvfile/sample-csv.csv"><i class="fa fa-file-csv"></i>Download</a></button>
                  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
               </div>
         </form>
            </div>
               
            </div>
         </div>
      </div>
      <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="display: none;">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add Images </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
            <div class="modal-body">
         <form action="<?php print site_url();?>Admin/imageUpload" method="post" enctype="multipart/form-data"  id="myform1">
            <div class="clearfix">
               
            </div>
            <div class="form_control_new">  
               <div class="label_head"></div>
                  <!-- <select class="multiselect form-control form-control1" name="bike_ids[]"  id="staff_type" multiple >
                        <option value="">Select Bike</option>
                              <?php if(isset($bikeIds) && !empty($bikeIds)) {
                                 foreach($bikeIds as $bike) { ?>
                                    <option value="<?php echo $bike['id']; ?>"><?php echo $bike['id']; ?></option>
                                 <?php } } ?>
                  </select> --> 
                <!--   <div class="form-group">
                     <label>Category</label>
                     <select style="width:100%;" class="js-example-basic-single w-100" id="category" name="category" >
                        <option value="">12</option>
                         <option value="">12</option>
                          <option value="">12</option>
                     </select>
                  </div>  -->
                  <div class="form-group">
                  <select class="w-100 m-t-30" name="bike_ids[]" id="multisel" multiple="multiple">
                    <?php if(isset($bikeIds) && !empty($bikeIds)) {
                                 foreach($bikeIds as $bike) { ?>
                                    <option value="<?php echo $bike['id']; ?>"><?php echo $bike['id']; ?></option>
                                 <?php } } ?>
                  </select>                     
               </div>
               </div>
            <div class="form-group">
               <label>Upload Images </label>
                   
               <div class="input-group image-preview">
                <!-- <input type="text" class="form-control image-preview-filename" disabled="disabled"> --> <!-- don't give a name === doesn't send on POST/GET -->
                <!-- <span class="input-group-btn"> -->
                    <!-- image-preview-clear button -->
                    <!-- <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button> -->
                    <!-- image-preview-input -->
                    <!-- <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span> -->
                        <!-- <span class="image-preview-input-title">Browse</span> -->
                        <input type="file" name="files[]" multiple="multiple"/> <!-- rename it -->
                    </div>
                </span>
            </div>
            </div>
            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
               </div>
         </form>
            </div>
               
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
         alert(res.message);
         window.location.reload(true);
         }
         }
         })
         }); 

     // $(document).on('click', '#close-preview', function(){ 
       //$('.image-preview').popover('hide');
       // Hover befor close the preview
      // $('.image-preview').hover(
           // function () {
           //    $('.image-preview').popover('show');
           // }, 
           //  function () {
           //    $('.image-preview').popover('hide');
           // }
   //     );    
   // });

   // $(function() {
   //     // Create the close button
   //     var closebtn = $('<button/>', {
   //         type:"button",
   //         text: 'x',
   //         id: 'close-preview',
   //         style: 'font-size: initial;',
   //     });
   //     closebtn.attr("class","close pull-right");
   //    /// Set the popover default content
   //     $('.image-preview').popover({
   //         trigger:'manual',
   //         html:true,
   //         title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
   //         content: "There's no image",
   //         placement:'bottom'
   //     });
   //     // Clear event
   //     $('.image-preview-clear').click(function(){
   //         $('.image-preview').attr("data-content","").popover('hide');
   //         $('.image-preview-filename').val("");
   //         $('.image-preview-clear').hide();
   //         $('.image-preview-input input:file').val("");
   //         $(".image-preview-input-title").text("Browse"); 
   //     }); 
   //     //Create the preview image
   //     $(".image-preview-input input:file").change(function (){     
   //         var img = $('<img/>', {
   //             id: 'dynamic',
   //             width:250,
   //             height:200
   //         });      
   //         var file = this.files[0];
   //         alert(file);
   //         var reader = new FileReader();
   //         // Set preview image into the popover data-content
   //         reader.onload = function (e) {
   //             $(".image-preview-input-title").text("Change");
   //             $(".image-preview-clear").show();
   //             $(".image-preview-filename").val(file.name);            
   //             img.attr('src', e.target.result);
   //             //$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
   //         }        
   //         reader.readAsDataURL(file);
   //     });  
   // });  
         
         
         
      </script>
   
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
      <script>
         $(document).ready(function () {
           $('#multisel').multiselect({
             buttonWidth: '100%',
             includeSelectAllOption: true,
             nonSelectedText: 'Select an Option' });

         });

         function getSelectedValues() {
           var selectedVal = $("#multisel").val();
           for (var i = 0; i < selectedVal.length; i++) {if (window.CP.shouldStopExecution(0)) break;
             function innerFunc(i) {
               setTimeout(function () {
                 location.href = selectedVal[i];
               }, i * 2000);
             }
             innerFunc(i);
           }window.CP.exitedLoop(0);
         }
      </script>
   </body>
</html>