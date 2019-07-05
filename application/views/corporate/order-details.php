<?php 
$res=$this->db->select('id,DATE_FORMAT(lease_start, "%d/%m/%Y") AS lease_start,DATE_FORMAT(lease_end, "%d/%m/%Y") AS lease_end,price,concat(DATEDIFF(lease_end,lease_start)," Days") as duration,bike_id,(CASE  WHEN lease_end < CURDATE()  THEN "Complete" WHEN lease_start=CURDATE() OR lease_end > CURDATE() THEN "Active" End) as state')->where('cc_id',base64_decode($_GET['id']))->get('corporate_orders')->row_array();
$bike_res=$this->db->select('name,model_name,vehicle_no,engine')->where_in('id',explode(',',$res['bike_id']))->get('bike_details')->result_array();
 $this->load->helper('track');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swagbike Corporate Admin</title>
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
                        <div class="col-md-12 grid-margin grid-margin-md-0 ">
							<div class="card">
								<div class="card-body">
                                    <h4 class="card-title">Order ID : <strong>Ord_00<?=$res['id']?></strong></h4>
									<div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="pt-1 pl-0">Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Duration</th>
                                                    <th>No of Bike</th>
                                                    <th>Total Amount</th>
                                                    <th>Status</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1 pl-0">
                                                       <?=$res['lease_start']?>
                                                    </td>
                                                    <td><?=$res['lease_end']?></td>
                                                    <td><?=$res['duration']?></td>
                                                    <td><?=count(explode(',',$res['bike_id']));?></td>
                                                    <td>Rs <b><?=$res['price']?></b></td>
                                                    <td><span class="text-success"><?=$res['state']?></span></td>
                                                    <td><span class="text-success"><?if($res['state']==='Complete'){?><a href="invoice?order_id=<?=base64_encode($res['id'])?>" class="btn btn-sm btn-primary mr-1">invoice</a><?php} else { echo "N/a";}?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
								</div>
							</div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card d-none d-md-flex mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Vehicle List</h4>                               
                                    <div class="row">
                                        <div class="col-4">
                                        <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                        <?php
                                        $i=1; 
                                        foreach ($bike_res as $key => $value) {

                                            $image_res=$this->db->select("image_name,concat('".base_url()."uploads/bikes/',image_name) as image_url")->limit('1')->get('bike_images')->row_array();
                                            $loc_data=bike_location($value['vehicle_no']);
                                            
                                          ?>
                                            <li class="nav-item">
                                                <a  href="#home-2" onclick='initMap(<?=$loc_data['lat'].','.$loc_data['long'];?>)' class="nav-link <?php if($i=='1'){echo "active show";}
                                                   ?>" id="home-tab-vertical" data-toggle="tab"  role="tab" aria-controls="home-2" aria-selected="<?php if($i=='1'){echo "true";}else{
                                                    echo "false";
                                                    }?>">
                                                    <div class="d-flex align-items-center">
                                                        <img width="40" src="<?=$image_res['image_url']?>"/>
                                                        <div class="ml-3">
                                                            <p class="mb-2"><?=$value['name']?></p>
                                                            <p class="mb-0 text-muted text-small"><?=$value['engine']?> / <?=$value['vehicle_no']?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                          <?php $i++;}?>
                                        </ul>
                                        </div>
                                        <div class="col-8">
                                            <div class="tab-content tab-content-vertical">
                                                <div class="tab-pane fade show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-vertical">
                                                    <div class="map-container">
                                                        <div id="map-with-marker" class="google-map"></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-vertical">
                                                    <div class="map-container">
                                                        <div id="map-with-marker" class="google-map"></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="contact-2" role="tabpanel" aria-labelledby="contact-tab-vertical">
                                                    <div class="map-container">
                                                        <div id="map-with-marker" class="google-map"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="js/google-maps.js"></script>

      <script type="text/javascript">
      $(document).ready(function(){
    $('.active').trigger('click');
    
           })
         
     
          
      </script> 
</body>

</html>