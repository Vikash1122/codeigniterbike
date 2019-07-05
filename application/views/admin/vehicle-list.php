<?php
$brand_res=$this->db->select('DISTINCT(name)')->get('bike_brands')->result();
 //$category_res=$this->db->select('DISTINCT(category)')->where('brand',$_REQUEST['brand'])->get('bike_details')->result();
// $color_res=$this->db->get('bike_color')->result();
// $model_res=$this->db->get('bike_models')->result();
// $year_res=$this->db->get('bike_year')->result();
// $url= $_SERVER['REQUEST_URI'];
// $lastWord = substr($url, strrpos($url, '/') + 1);
// if($lastWord==='leaseVehicle')
// {
//    $rent_type='lease';
// }
// else{
//     $rent_type='instant'; 
// }
// $engine_res=$this->db->select('DISTINCT(engine)')->where('rent_type',$rent_type)->get('bike_details')->result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link href="css/new-style.css">
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
                    <h4 class="mb-0">Vehicle List </h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">
                    <div class="theme-setting-wrapper">
                        <div onclick="javascript:location.href='addVehicle'" id="settings-trigger"><i class="mdi mdi-plus"></i></div>
                    </div>
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                    <!-- <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <button class="btn btn-primary">Bulk Upload</button>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="forms-sample" action="#" method="post" id="filterForm">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4 ">
                                                            <button data-toggle="modal" data-target="#exampleModal-3" class="btn btn-primary float-right mr-2">Bulk Upload</button>  
                                 <button  data-toggle="modal" data-target="#exampleModal-4" class="btn btn-primary float-right mr-2">Images Upload</button>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Brand</label>
                                                                <select class="js-example-basic-single w-100" name="brand" onChange="getState(this.value,'brand','category');" id="brand">
                                                                <option value="">Select</option>
                                                                    <?php foreach($brand_res as $value){?>
                                          <option value="<?=$value->name?>"><?=$value->name;?></option>
                                                 <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select class="js-example-basic-single w-100" id="category" name="category" onChange="getState(this.value,'category','model');" >
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Model</label>
                                                                <select class="js-example-basic-single w-100" id="model" name="model" onChange="getState(this.value,'model','modelyear');">
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Model Year</label>
                                                                <select class="js-example-basic-single w-100" id="modelyear" name="modelyear" onChange="getState(this.value,'modelyear','modelcolor');">
                                                                    <option value="">Select</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Color</label>
                                                                <select class="js-example-basic-single w-100" id="modelcolor" name="modelcolor" onChange="getState(this.value,'modelcolor','engine');">
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Engine</label>
                                                                <select class="js-example-basic-single w-100" id="engine" name="engine">
                                                                    <option value="">Select</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                     <!--    <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Rating</label>
                                                                <select class="js-example-basic-single w-100">
                                                                    <option value="AL">1</option>
                                                                    <option value="WY">2</option>
                                                                    <option value="WY">3</option>
                                                                    <option value="WY">4</option>
                                                                    <option value="WY">5</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Or By Name</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="" name="name" id="name">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <?php if($this->session->flashdata('msg')): ?>
                                                    <p><?php echo $this->session->flashdata('msg'); ?></p>
                                             <?php endif; ?>
                                            <div class="card-body">
                                                <h4 class="card-title">All Vehicle 
                                                    <select style="max-width:120px;" class="form-control float-right  ml-2" id="records">
                                                        <option value="10">10 Records</option>
                                                        <option value="20">20 Records</option>
                                                        <option value="30">30 Records</option>
                                                        <option value="40">40 Records</option>
                                                    </select>
                                                </h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Category</th>
                                                                <th>Vehicle No.</th>
                                                                <th>Rating</th>
                                                                <th>Total Trip</th>
                                                                <th>Price</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="vehicle_list">
                                                            
                                                           
                                                        </tbody>
                                                    </table>
                                                    <nav class="pt-3">
                                                       
                                                    </nav>
                                                </div>
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
                   
                     <input type="file" class="dropify" name="csv_upload">
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
                  <select class="w-100 m-t-30" id="multisel" multiple="multiple">
                    <option value="">Option 1</option>
                    <option value="">Option 2</option>
                    <option value="">Option 3</option>
                    <option value="">Option 4</option>
                  </select>                     
               </div>
               </div>
            <div class="form-group">
               <label>Upload Images </label>
                   
                  <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
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
        <script src="js/iCheck.js"></script>
        <script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>

        <script src="js/formpickers.js"></script>
        <script src="js/form-addons.js"></script>
        <script src="js/x-editable.js"></script>
        <script src="js/dropify.js"></script>
        <script src="js/dropzone.js"></script>
        <script src="js/jquery-file-upload.js"></script>
        <script src="js/formpickers.js"></script>
        <script src="js/form-repeater.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
            var path=window.location.origin+window.location.pathname;
               path=path.split('admin/');
               //var base_path=path[0];
              
            $(function() {
                $('input[name="birthday"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                }, function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    alert("You are " + years + " years old!");
                });
            });
            $('#example-css1').barrating({
                theme: 'css-stars',
                showSelectedRating: false
            });

            ajax();             
              function ajax(page=1,perpage=10,maindata=''){ 
              var vehicle='';  
               if(path[1]==='instantVehicle'){
                vehicle='instant';            
              }   
              else{
                vehicle='lease';
              }          
              $('#vehicle_list').html('');
              if(maindata!==''){
                var cat=$('#category').val();
               var mod= $('#model').val();
                var bran=$('#brand').val();
                var colo=$('#modelcolor').val();
                var name=$('#name').val();
                var year=$('#modelyear').val();
                var engine=$('#engine').val();
                data1={'user_id':user.user_id,'page':page,'perpage':perpage,'vehicle_type':vehicle,'category':cat,'model_name':mod,'brand':bran,'color':colo,'name':name,'model_year':year,'engine':engine};
              }
              else{
                data1={'user_id':user.user_id,'page':page,'perpage':perpage,'vehicle_type':vehicle};
              }
                         
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:data1,
                    method:'get',
                    url:'/swagbike/api/cud/get_allbikes',
                    success:function(res){                 

                    if(($.trim(res.data.length))!==0){ 
                   
                    // $('#all_reviews').text(res.all_reviews);
                    // $('#total_deals').text(res.count);
                     result=res;
                     var org_name='';
                      var i = 1;
                     $.each(res.data, function( key, value ) {
                        if(value.rent_type==='instant'){
                            var price=value.hourly_price;
                        }
                        else{
                            price=value.monthly_price;
                        }
                       
                        $('#vehicle_list').append('<tr> <td class="py-1"> <img src="'+value.bike_image+'" alt="image"/> </td><td class="border-top-0"> <p class="font-weight-medium text-dark mb-0">'+value.brand+' '+value.model_name+'</p><p class="text-muted mb-0">'+value.engine+'</p></td><td>'+value.category+'</td><td>'+value.vehicle_no+'</td><td> <label class="badge badge-success"><strong>4.5*<strong></strong></strong></label> </td><td>'+value.total_trip+'</td><td>'+price+'</td><td> <div class="template-demo"> <a href="vehicleDetails?id='+value.id+'" class="btn btn-primary btn-sm">View</a>  <a type="button" class="btn btn-primary btn-sm" href="editVehicle?id='+value.id+'"><i class="mdi mdi-grease-pencil"></i></a> </div></td></tr>');
                          });
                   //  $('#org_name').text(res.org_name); 

                       pagination('.pt-3',res,page,'ajax',perpage,perpage);
                     }                
                  }

                })
 
                           

                       
               }

$('select#records').on('change', function() {
     ajax(1,this.value);  
});

$('#filterForm').on('submit',function()
{
    event.preventDefault();               
var formdata = new FormData($(this).serializeArray()) ;
var data= new FormData($(this)[0]) ;
ajax(1,10,data);
})

function getState(val,param,div) {
     if(path[1]==='instantVehicle'){
               var rent_type='instant';            
              }   
              else{
                rent_type='lease';
              }    
    if((param==='brand') || (param==='category'))
     {
        $('#model').html('<option value="">Select</option>');  
        $('#modelyear').html('<option value="">Select</option>'); 
        $('#modelcolor').html('<option value="">Select</option>');
        $('#engine').html('<option value="">Select</option>');
     } 
     if(param==='model')
     {
        $('#modelyear').html('<option value="">Select</option>'); 
        $('#modelcolor').html('<option value="">Select</option>');
        $('#engine').html('<option value="">Select</option>');
     }
     if(param==='modelyear')
     {
        $('#modelcolor').html('<option value="">Select</option>');
        $('#engine').html('<option value="">Select</option>');
     } 
     if(param==='modelcolor')
     {
        $('#engine').html('<option value="">Select</option>');
     } 
    if(val!==''){
     let str = '{"'+param +'": "'+val+'", "user_id": "'+user.user_id+'","rent_type": "'+rent_type+'"}';     
     var data = jQuery.parseJSON(str);
     $("#"+div+'').html('<option value="">Select</option>');  
     
    $.ajax({
                headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
    type: "GET",
    url: '/swagbike/api/cud/get_dependent',
    data:data,
    success: function(res){        
         if(($.trim(res.data.length))!==0){ 
        $.each(res.data, function( key, value ) {
                 $("#"+div+'').append('<option value="'+value.name+'">'+value.name+'</option>');
                       });
       
                }

         }
    });
}
}
        </script>
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