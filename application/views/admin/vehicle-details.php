<?php $bike_res=$this->db->where('id',$_GET['id'])->get('bike_details')->row_array();
$bike_image=$this->db->select("image_name,concat('".base_url()."uploads/bikes/',image_name) as image_url")->where('bike_id',$_GET['id'])->get('bike_images')->result_array();
$bike_rc=$this->db->select("name,concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_rc')->row_array();
$bike_insurance=$this->db->select("*,concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_insurance')->row_array();
$bike_pollution=$this->db->select("*,concat('".base_url()."uploads/bikes/',name) as image_url")->where('bike_id',$_GET['id'])->get('bike_pollution')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
    <link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
    <style>
   
    .imgHeight{
        height: 265.52px;
    }

    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Vehicle Details</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
            <div class="container-fluid page-body-wrapper">
            <?php include 'menu.php';?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border-bottom text-center pb-4">
                                        <div class="owl-carousel owl-theme full-width">
                                        <?php foreach ($bike_image as $key => $value) {?>
                                         
                                            <div class="item">
                                                <img src="<?=$value['image_url']?>" alt="image" style="height: 145.31px;"/>
                                            </div>
                                             
                                       <?php }?>
                                        </div>
                                        <div class="mb-3">
                                            <h3 class="text-center"><?=$bike_res['brand'].' '.$bike_res['model_name']?></h3>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 mr-2 text-muted"><?=$bike_res['engine']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Category </span>
                                            <span class="float-right text-muted"><?=$bike_res['category']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Model Year</span>
                                            <span class="float-right text-muted"><?=$bike_res['model_year']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Color</span>
                                            <span class="float-right text-muted"><?=$bike_res['color']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Transmission Type</span>
                                            <span class="float-right text-muted"><?=$bike_res['transmission_type']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Fuel Type  </span>
                                            <span class="float-right text-muted"><?=$bike_res['fuel_type']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Fuel tank capacity </span>
                                            <span class="float-right text-muted"><?=$bike_res['fuel_capacity']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Key Type</span>
                                            <span class="float-right text-muted"><?=$bike_res['key_type']?></span>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary mr-1" href="editVehicle?id=<?php echo $_GET['id'];?>">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 grid-margin grid-margin-md-0 ">
							<div class="card">
								<div class="card-body">
                                    <h4 class="card-title">Order Details <span class="float-right"><label class="badge badge-primary"></label></span></h4>
									<div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>User Name</th>
                                                    <th>Start Date Time</th>
                                                    <th>End Date Time</th>
                                                    <th>Status</th>
                                                    <th>Rating</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bike_order">
                                                
                                                
                                            </tbody>
                                        </table>
                                        <nav class="pt-3" id="order_page">
                                        </nav>
                                    </div>
								</div>
							</div>
						</div>
                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Document</h4>
                                    <div id="lightgallery" class="row lightGallery">
                                    <?php if(!empty($bike_rc)){if($bike_rc['name']){?>
                                        <a href="<?=$bike_rc['image_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">RC </span>
                                            </p>
                                            <img src="<?=$bike_rc['image_url']?>" class="imgHeight">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Rto Cost </span>
                                                <span class="float-right text-muted"><?='Rs.'.$bike_res['rto_cost']?></span>
                                            </p>
                                        </a>
                                        <?php }} else{ echo "No Rc Found";}?>
                                        <?php if(!empty($bike_insurance)){ if($bike_insurance['name']){?>
                                        <a href="<?=$bike_insurance['image_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Insurance </span>
                                            </p>
                                            <img src="<?=$bike_insurance['image_url']?>" class="imgHeight">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Insurance Cost </span>
                                                <span class="float-right text-muted"><?='Rs.'.$bike_res['insurance_cost']?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date("d/m/Y",strtotime($bike_insurance['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date("d/m/Y",strtotime($bike_insurance['expiry_date']))?></span>
                                            </p>
                                             
                                        </a>
                                        <?php } } else{ echo ", No Insurance Found";}?>
                                        <?php if(!empty($bike_pollution)){ if($bike_pollution['name']){?>
                                        <a href="<?=$bike_pollution['image_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Polution </span>
                                            </p>
                                            <img src="<?=$bike_pollution['image_url']?>" class="imgHeight">
                                           <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date("d/m/Y",strtotime($bike_pollution['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date("d/m/Y",strtotime($bike_pollution['expiry_date']))?></span>
                                            </p>

                                        </a>
                                        <?php }} else{ echo ", No Polution Found";}?>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bike Service <button data-toggle="modal" data-target="#exampleModal-2" class="btn btn-primary mr-1 btn-sm float-right">Add</button></h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service Date</th>
                                                    <th>location</th>
                                                    <th>Current Km</th>
                                                    <th>Next Due Date</th>
                                                    <th>Next Due Km</th>
                                                    <th>Discription</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bike_service">
                                                
                                               
                                            </tbody>
                                        </table>
                                        <nav class="pt-3" id="bike_page">
                                         
                                        </nav>
                                    </div>
                                    
                                </div>
                            </div>
						</div>

                    </div>
                </div>
                <div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Order Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4 class="card-title">Order No. <strong>546454</strong></h4>
                                    <table class="table table-border">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Active</td>
                                                <td>12/02/2019</td>
                                                <td>12:20 PM</td>
                                            </tr>
                                            <tr>
                                                <td>Active</td>
                                                <td>12/02/2019</td>
                                                <td>12:20 PM</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
               <!--  <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog  model-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Add Service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div id="mainDiv"></div>
                                <form class="forms-sample" method="post" id="serviceForm" action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service Date</label>
                                                <input type="text" class="form-control form-control-md" name="date" value="" autocomplete="off" /> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Km</label>
                                                <input type="text" class="form-control form-control-md" value="" name="current_km"  /> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>location</label>
                                                <input type="text" class="form-control form-control-md" value="" name="location" /> 
                                            </div>
                                        </div>
                                        <input type="hidden" name="bike_id" value="<?=$_GET['id']?>">
                                        <div class="col-md-12 mb-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="Due_Date">
                                                Next Due Date
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="Due_Km">
                                                Next Due Km
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 Due_Date box">
                                            <div class="form-group">
                                                <label>Next Due Date</label>
                                                <input type="text" class="form-control form-control-md"  name="next_due_date" >
                                            </div>
                                        </div>
                                        <div class="col-md-6 Due_Km box">
                                            <div class="form-group">
                                                <label>Next Due Km</label>
                                                <input type="text" class="form-control form-control-md" placeholder="" name="next_due_km" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Discription</label>
                                                <input type="text" class="form-control form-control-md" placeholder="" name="description" >
                                            </div>
                                        </div>
                                   
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button></form>
                            </div>
                        </div>
                    </div>
                </div> -->
            <?php include 'footer.php';?>
            </div>
        </div>
    </div>
    <?php include 'script.php';?>

    <script src="js/profile-demo.js"></script>
    <script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="js/light-gallery.js"></script>
    <script src="js/owl-carousel.js"></script>
    <script src="js/dropify.js"></script>
    <script type="text/javascript" src="js/daterangepicker.min.js"></script>

       <script> 
           $(function() {
            $('input[name="next_due_date"],input[name="date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                
                });                
            });

            // $(document).ready(function(){
            //     $('input[type="radio"]').click(function(){
            //         var inputValue = $(this).attr("value");
            //         var targetBox = $("." + inputValue);
            //         $(".box").not(targetBox).hide();
            //         $(targetBox).show();
            //     });
            // });

             ajax(); 
             order();            
              function ajax(page=1,perpage=10){ 
               $('#bike_service').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'bike_id':<?=$_GET['id']?>,'page':page,'perpage':perpage},
                    method:'get',
                    url:'/swagbike/api/cud/get_bike_service',
                    success:function(res){                 
                    
                    if($.trim(res.count)!=='0'){ 
                     $.each(res.data, function( key, value ) {
                        $('#bike_service').append('<tr> <td>'+moment(value.date).format('D/MM/Y')+'</td><td><p class="mb-2">'+value.location+'</p></td><td>'+value.current_km+'</td><td>'+moment(value.next_due_date).format('D/MM/Y')+'</td><td>'+value.next_due_km+'</td><td>'+value.description+'</td></tr>');
                          });
                      pagination('#bike_page',res,page,'ajax',perpage,perpage);
                        }
                        else{
                          $('#bike_service').append('<tr><td colspan="6">No Data Found!!!</td></tr>')  
                        }
                      }
                    })

               }

                function order(page=1,perpage=10){ 
               $('#bike_order').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'bike_id':<?=$_GET['id']?>,'page':page,'perpage':perpage},
                    method:'get',
                    url:'/swagbike/api/cud/get_all_orders',
                    success:function(res){                 
                    
                    if($.trim(res.count)!=='0'){ 
                        $('.badge').text(res.count);
                     $.each(res.data, function( key, value ) {
                        if(value.status==='Cancel')
                        {
                            var color='red';
                            var nom='cord_00';
                        }
                        else{
                            color='green';
                            nom='ord_00';
                        }
                        $('#bike_order').append('<tr> <td>'+nom+value.order_id+' </td><td> <p class="mb-2">'+value.user_name+'</p><p class="mb-0 text-muted text-small">'+value.user_contact+'</p></td><td>'+value.start_date+'</td><td>'+value.end_date+'</td><td style="color:'+color+'">'+value.status+'</td><td><strong>4.5*</strong></td><td>Rs <strong>'+value.price+'</strong></td></tr>');
                          });
                      pagination('#order_page',res,page,'ajax',perpage,perpage);
                        }
                        else{
                          $('#bike_order').append('<tr><td colspan="7">No Data Found!!!</td></tr>')  
                        }
                      }
                    })

               }

               $('#serviceForm').on('submit',function(){
               event.preventDefault();               
               var formdata = new FormData($(this)[0]) ;
               console.log(formdata); 
                formdata.append("user_id",user.user_id);

                $.ajax({
                    headers: {
                    'access_token':sessionStorage.getItem('access_token'),  
                    },
                    data:formdata,
                    method:'post',                     
                    contentType: false,
                    processData: false, 
                    url:'/swagbike/api/cud/bike_service',
                    success:function(res){
                    console.log(res);
                    if($.trim(res.status)=='true'){                                
                    alert(res.message);
                    window.location.reload(true);
                    }
                    else{
                        $('#mainDiv').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '+res.message+'</div>');                       
                     }
                    }
               })  
         })
       </script>
</body>

</html>