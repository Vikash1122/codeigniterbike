<?php 
$this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.create_at,'%d/%m/%Y %h:%i %p') as booking_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date,(case when DATEDIFF(end_date,start_date)='0'  then concat(TIMESTAMPDIFF(hour,start_date,end_date),' hour') when TIMESTAMPDIFF(hour,start_date,end_date)='0'  then concat(TIMESTAMPDIFF(minute,start_date,end_date),' minute') else concat((TIMESTAMPDIFF(day,start_date,end_date)),' days') end) as duration, concat('Rs. ',(TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60) as price,concat('Rs. ',round(((TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60)+((TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60)*0.18,1)) as netprice,image_name,concat('".base_url()."uploads/bikes/',bike_images.image_name) as image_url,users.user_image,concat('".base_url()."uploads/users/',users.user_image) as image_url1,users.user_id,bike_details.hourly_price,bike_details.category,bike_details.vehicle_no,bike_rented.status")
       ->from("bike_rented")
       ->join("bike_details","bike_details.id=bike_rented.bike_id","left")
       ->join("bike_images","bike_images.bike_id=bike_rented.bike_id","left")
       ->join("users","bike_rented.user_id=users.user_id","left");     
      $res=$this->db->where('bike_rented.id',$_GET['order_id'])->get()->row_array();     
      $loc_data=bike_location($res['vehicle_no']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Order Details</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
            <div class="container-fluid page-body-wrapper">
            <?php include 'menu.php';?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border-bottom text-center pb-4">
                                    <?php if(!$res['user_image']){?>
                                        <img src="images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3" />
                                        <?php } else{?>
                                        <img src="<?=$res['image_url1']?>" alt="profile" class="img-lg rounded-circle mb-3" />
                                        <?php }?>
                                        <div class="mb-3">
                                            <h3 class="text-center"><?=$res['user_name']?></h3>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 mr-2 text-muted"><?=$res['user_id']?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Booking Time</span>
                                            <span class="float-right text-muted"><?=$res['booking_date']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Activate Time</span>
                                            <span class="float-right text-muted"><?=$res['booking_date']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Ongoing Time</span>
                                            <span class="float-right text-muted"><?=$res['start_date']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">End Time</span>
                                            <span class="float-right text-muted"><?=$res['end_date']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Duration</span>
                                            <span class="float-right text-muted"><?=$res['duration']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Price</span>
                                            <span class="float-right text-muted"> <strong>Rs <?=$res['hourly_price']?> / Hour</strong></span>
                                        </p>
                                        <input type="hidden" name="" id="lat" value="<?=$loc_data['lat']?>">
                                        <input type="hidden" name="" id="long" value="<?=$loc_data['long']?>">
                                        <p class="clearfix">
                                            <span class="float-left">Total Price</span>
                                            <span class="float-right text-muted"><strong><?=$res['price']?></strong></span>
                                        </p>
                                         <p class="clearfix">
                                            <span class="float-left">Net Price (with GST(18%))</span>
                                            <span class="float-right text-muted"><strong><?=$res['netprice'];?></strong></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Status</span>
                                            <?php if($res['status']=='3'){?>
                                            <span class="float-right text-success">Complete</span><?php } elseif ($res['status']=='4') {?>
                                            <span class="float-right text-danger">Cancel</span>
                                            <?php }?>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin grid-margin-md-0 ">
							<div class="card">
								<div class="card-body">
                                    <h4 class="card-title">Order ID : <strong>ord_00<?=$_GET['order_id']?></strong></h4>
									<div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="pt-1 pl-0">Bike Name</th>
                                                    <th class="pt-1">Bike Type</th>
                                                    <th class="pt-1">Vehicle No.</th>
                                                    <th class="pt-1">Order Type</th>
                                                    <th class="pt-1">Rating</th>
                                                     <th class="pt-1">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1 pl-0">
                                                        <div class="d-flex align-items-center">
                                                        <?php if(!$res['image_name']){?>
                                                            <img src="images/faces/face1.jpg" alt="profile"/>
                                                            <?php } else{?>
                                                             <img src="<?=$res['image_url']?>" alt="profile"/>
                                                             <?php }?>
                                                            <div class="ml-3">
                                                                <p class="mb-2"><?=$res['bike_name']?></p>
                                                                <p class="mb-0 text-muted text-small"><?=$res['engine']?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?=$res['category']?></td>
                                                    <td><?=$res['vehicle_no']?></td>
                                                    <td><?=$res['rent_type']?></td>
                                                   
                                                    <td><label class="badge badge-success"><strong>4.5*<strong></label></td>
                                                     <td><a href="invoice?order_id=<?=$_GET["order_id"]?>" class="btn btn-sm btn-primary mr-1">invoice</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
								</div>
							</div>
							<div class="card mt-4">
								<div class="card-body">
                                    <h6 class="card-title">Travel Map</h6>
                                    <div class="map-container">
                                        <div id="map-with-marker" class="google-map"></div>
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
    <?php include 'script.php';?>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnT63XUjqjPgXZ0lFTU_pdpfUX7swzTTM&amp;callback=initMap"></script>
    <script src="js/gmap.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    lat=parseFloat($('#lat').val());
    long=parseFloat($('#long').val());
    console.log(lat);
       initMap(lat,long);
})
    
       </script>
</body>

</html>