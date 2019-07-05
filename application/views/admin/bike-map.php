<?php $bike_res=$this->db->get('bike_details')->result();?>
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
                    <h4 class="mb-0">Search Bike</h4>
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
                                    <h4 class="card-title">Search Bike</h4>
                                    <div class="row">
									<div class="col-md-10">
                                        <select class="js-example-basic-single w-100" name="vehicle_no" id="vehicle_no">
                                         <option value=''>All</option>
                                            <?php foreach(all_bike_location() as $value){?>
                                            <option value="<?=$value['vehicle_no']?>"><?=$value['vehicle_no'];?></option>
                                            <?php }?>
                                           </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="getloc()" style="padding: 12px;
    margin-left: -30px;">
                                            <i class="mdi mdi-magnify"></i>
                                            </button>
                                      </div> 
                                      </div>                                  
								</div>
							</div>
							<div class="card mt-4">
								<div class="card-body">
                                    <h6 class="card-title">Map</h6>
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
<script src="js/select2.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnT63XUjqjPgXZ0lFTU_pdpfUX7swzTTM&amp;callback=initMap"></script>
    <script src="js/google-maps.js"></script>
<script type="text/javascript">
   
    function getloc()
    {
        initMap($('#vehicle_no').val());
    }
    

        </script> 
</body>

</html>