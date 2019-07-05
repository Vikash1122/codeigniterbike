<?php 
$corporate_res=$this->db->select('*,CONCAT_WS(",",address1,address2,city,country) location')->where('id',$_GET['ccid'])->get('corporate_clients')->row_array();
$key_persons=$this->db->select('*')->where('cc_id',$_GET['ccid'])->get('corporate_key_person')->result_array();
$document_res=$this->db->select("*, concat('".base_url()."uploads/corporate/',name) as doc_url")->where('cc_id',$_GET['ccid'])->get('corporate_client_documents')->result_array();
foreach ($document_res as $key => $value) {
    if($value['doc_type']==='1')
    {
       $document_res1['commercial']=$value; 
    }
    if($value['doc_type']==='2')
    {
       $document_res1['tax']=$value; 
    }
    if($value['doc_type']==='3')
    {
       $document_res1['insurance']=$value; 
    }
    if($value['doc_type']==='4')
    {
       $document_res1['check']=$value; 
    }
}

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
    .box{
        display:none;
    }
    figcaption { text-align: center;  overflow-wrap: break-word;}
    figcaption {
  background-color: #ef1750;
  padding: 1rem;  
  transition: opacity 1s ease; 
  color:white;
  font-weight: bold;
}
img{
        width: 300px;
    height: 250px;
}

    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Corporate Lease Details</h4>
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
                                  
                                      <figcaption ><?=$corporate_res['client_name']?></figcaption>
                                      <br>
                                        <div class="mb-3">
                                          
                                            <p class="text-muted mb-0"><?=$corporate_res['email']?></p>
                                            <p class="text-muted mb-0"><?=$corporate_res['mobile']?></p>
                                            <p class="text-muted mb-0"><?=$corporate_res['landline']?></p>
                                            <p class="mt-4 card-text">
                                            <?=$corporate_res['location']?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Bank Name </span>
                                            <span class="float-right text-muted"><?=$corporate_res['bank_name']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">IFSC Code</span>
                                            <span class="float-right text-muted"><?=$corporate_res['ifsc_code']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Acount No.</span>
                                            <span class="float-right text-muted"><?=$corporate_res['account_no']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Holder Name</span>
                                            <span class="float-right text-muted"><?=$corporate_res['holder_name']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Payment Terms</span>
                                            <span class="float-right text-muted"><?=$corporate_res['payment_terms']?></span>
                                        </p>
                                    </div>
                                    <!-- <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary mr-1">Edit</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 grid-margin grid-margin-md-0 ">
							<div class="card">
								<div class="card-body">
                                    <h4 class="card-title">Order Details <span class="float-right"><label class="badge badge-primary" id="lblName"></label></span></h4>
									<div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>No Of Vehicle</th>
                                                    <th>Start Date </th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
                                                    <th>Total Price</th>
                                                     <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody id="order_list">
                                                
                                                
                                            </tbody>
                                        </table>
                                        <nav class="pt-3">
                                            <ul class="pagination pagination-rounded float-right">
                                                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
                                            </ul>
                                        </nav>
                                    </div>
								</div>
							</div>
							<div class="card mt-4">
								<div class="card-body">
                                    <h4 class="card-title">Key Persons To Contact </h4>
                                    <?php foreach ($key_persons as $key1 => $value1) {
                                      ?>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Department</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['department']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Name</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['name']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Designation</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['designation']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Contact No</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['contact']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Email</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['email']?></p>
                                        </div>
                                    </div>
                                  <hr>
                                    <?php }?>
								</div>
							</div>
						</div>
                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Document</h4>
                                    <div id="lightgallery" class="row lightGallery">
                                        <a href="<?=$document_res1['commercial']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Commercial License </span>
                                            </p>
                                            <img src="<?=$document_res1['commercial']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['commercial']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['commercial']['expiry_date']))?></span>
                                            </p>
                                        </a>
                                       <a href="<?=$document_res1['tax']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">TAX Registration Certificate </span>
                                            </p>
                                            <img src="<?=$document_res1['tax']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['tax']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['tax']['expiry_date']))?>
                                            </p>
                                        </a>
                                        <a href="<?=$document_res1['insurance']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Insurance </span>
                                            </p>
                                            <img src="<?=$document_res1['insurance']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['insurance']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['insurance']['expiry_date']))?></span>
                                            </p>
                                        </a>
                                        <a href="<?=$document_res1['check']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Cancel Check </span>
                                            </p>
                                            <img src="<?=$document_res1['check']['doc_url']?>">
                                        </a>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                            <img class="img-sm rounded-circle" src="images/faces/face5.jpg" alt="profile">
                                            <div class="ml-3">
                                                <h6 class="mb-1">Brand Model name</h6>
                                                <small class="text-muted mb-0">DL-214 822144 </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                            <img class="img-sm rounded-circle" src="images/faces/face5.jpg" alt="profile">
                                            <div class="ml-3">
                                                <h6 class="mb-1">Brand Model name</h6>
                                                <small class="text-muted mb-0">DL-214 822144 </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                            <img class="img-sm rounded-circle" src="images/faces/face5.jpg" alt="profile">
                                            <div class="ml-3">
                                                <h6 class="mb-1">Brand Model name</h6>
                                                <small class="text-muted mb-0">DL-214 822144 </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                            <img class="img-sm rounded-circle" src="images/faces/face5.jpg" alt="profile">
                                            <div class="ml-3">
                                                <h6 class="mb-1">Brand Model name</h6>
                                                <small class="text-muted mb-0">DL-214 822144 </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-3 border-bottom">
                                            <img class="img-sm rounded-circle" src="images/faces/face5.jpg" alt="profile">
                                            <div class="ml-3">
                                                <h6 class="mb-1">Brand Model name</h6>
                                                <small class="text-muted mb-0">DL-214 822144 </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog  model-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Add Service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="forms-sample">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service Date</label>
                                                <input type="text" class="form-control form-control-md" name="birthday" value="" /> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Km</label>
                                                <input type="text" class="form-control form-control-md" value="" /> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>location</label>
                                                <input type="text" class="form-control form-control-md" value="" /> 
                                            </div>
                                        </div>
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
                                                <label>Date</label>
                                                <input type="text" class="form-control form-control-md"  name="birthday">
                                            </div>
                                        </div>
                                        <div class="col-md-6 Due_Km box">
                                            <div class="form-group">
                                                <label>Km</label>
                                                <input type="text" class="form-control form-control-md" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Discription</label>
                                                <input type="text" class="form-control form-control-md" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>RC</label>
                                                <input type="file" class="dropify" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
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
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                
                }, 
                function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    alert("You are " + years + " years old!");
                });
            });
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });

               ajax();             
              function ajax(page=1,perpage=5){                
              $('#order_list').html('');     
              
                var now =moment().format('DD/MM/YYYY');

     
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'cc_id':<?=$_GET['ccid']?>},
                    method:'get',
                    url:'/swagbike/api/corporate/get_orders',
                    success:function(res){                 

                    if(($.trim(res.data.length))!==0){ 
                         $('#lblName').text(res.count);
                     $.each(res.data, function( key, value ) {
                        var bike_id=value.bike_id;
                        console.log( moment().format('DD/MM/YYYY'));
                                            if (now > value.lease_end) {
                                           var status='Running';
                                           var invoice='N/a';
                                            } else {
                                            var status='Completed';
                                             invoice='<a href="corporateInvoice?order_id='+value.id+'" class="btn btn-sm btn-primary mr-1">invoice</a>';
                                            }   
                      var count_bike=bike_id.split(",");
                        $('#order_list').append('<tr> <td>'+value.id+'</td><td><a href="availableVehicle?corder_id='+value.id+'"> '+count_bike.length+'</a></td><td>'+value.lease_start+'</td><td>'+value.lease_end+'</td><td><a>'+status+'</a></td><td>Rs <strong>'+value.price+'</strong></td><td>'+invoice+'</td></tr>');
                          });   
                       pagination('.pt-3',res,page,'ajax',perpage,perpage);
                     }                
                  }

                })
 
                           

                       
               }
       </script>
</body>

</html>