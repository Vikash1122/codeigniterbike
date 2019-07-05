<?php $user_res=$this->db->select("*,concat('".base_url()."uploads/users/',user_image) as image_url,concat('".base_url()."uploads/users/',user_dlfront) as dlfront_url,concat('".base_url()."uploads/users/',user_dlback) as dlback_url")->where('user_id',$_GET['id'])->get('users')->row_array();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">User Details</h4>
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
                                        <img src="<?=$user_res['image_url']?>" alt="profile" class="img-lg rounded-circle mb-3" />
                                        <div class="mb-3">
                                            <h3 class="text-center"><?=$user_res['user_firstname'].' '.$user_res['user_lastname']?></h3>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 mr-2 text-muted"><?=$user_res['user_id']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Email ID </span>
                                            <span class="float-right text-muted"><?=$user_res['user_email']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Phone No.</span>
                                            <span class="float-right text-muted"><?=$user_res['user_mobile']?></span>
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
                                    <h4 class="card-title">Order Details <span class="float-right"><label class="badge badge-primary">0</label></span></h4>
									<div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Bike Name</th>
                                            <th>Start Date Time</th>
                                            <th>End Date Time</th>
                                            <th>Status</th>                                            
                                            <th>Rating</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user_order">
                                     
                                    </tbody>
                                </table>
                                <nav class="pt-3">
                                   
                                </nav>
                            </div>
								</div>
							</div>
						</div>
                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title">Document</h4>
                                <?php if($user_res['user_dlfront']!==''&&$user_res['user_dlfront']!==null){?>
                                <div id="lightgallery" class="row lightGallery">
                                    <a href="<?=$user_res['dlfront_url']?>" class="image-tile"><img src="<?=$user_res['dlfront_url']?>" style="height: 265.5px;"></a>
                                    <a href="<?=$user_res['dlback_url']?>" class="image-tile"><img src="<?=$user_res['dlback_url']?>"  style="height: 265.5px;"></a>
                                </div>
                                <?php } else{ echo "No Document Found!!!";}?>
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
            <?php include 'footer.php';?>
            </div>
        </div>
    </div>
    <?php include 'script.php';?>

    <script src="js/profile-demo.js"></script>
    <script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="js/light-gallery.js"></script>
      
      <script type="text/javascript">
      order();
         function order(page=1,perpage=10){
                $('#user_order').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'cust_id':'<?=$_GET["id"]?>'},
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
                            var price='0'
                        }
                        else{
                            color='green';
                            nom='ord_00';
                            price=value.price;
                        }
                        $('#user_order').append('<tr> <td>'+nom+value.order_id+' </td><td> <p class="mb-2">'+value.user_name+'</p><p class="mb-0 text-muted text-small">'+value.user_contact+'</p></td><td>'+value.start_date+'</td><td>'+value.end_date+'</td><td style="color:'+color+'">'+value.status+'</td><td><strong>4.5*</strong></td><td>Rs <strong>'+price+'</strong></td></tr>');
                          });
                      pagination('.pt-3',res,page,'ajax',perpage,perpage);
                        }
                        else{
                          $('#bike_order').append('<tr><td colspan="7">No Data Found!!!</td></tr>')  
                        }
                      }
                    })

               }
      </script> 
</body>

</html>