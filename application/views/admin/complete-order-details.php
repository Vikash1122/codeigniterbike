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
                    <h4 class="mb-0">Completed Order Details</h4>
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
                                        <img src="images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3" />
                                        <div class="mb-3">
                                            <h3 class="text-center">Person Name.</h3>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 mr-2 text-muted">User ID</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Booking Time</span>
                                            <span class="float-right text-muted">12/02/2019 02:20 PM</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Activate Time</span>
                                            <span class="float-right text-muted">12/02/2019 02:20 PM</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Ongoing Time</span>
                                            <span class="float-right text-muted">12/02/2019 02:20 PM</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">End Time</span>
                                            <span class="float-right text-muted">12/02/2019 02:20 PM</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Duration</span>
                                            <span class="float-right text-muted">2 Hour</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Price</span>
                                            <span class="float-right text-muted">Rs <strong>25 / Hour</strong></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Total Price</span>
                                            <span class="float-right text-muted">Rs <strong>50</strong></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Status</span>
                                            <span class="float-right text-success">Complete</span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Status</span>
                                            <span class="float-right text-danger">Cancel</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin grid-margin-md-0 ">
							<div class="card">
								<div class="card-body">
                                    <h4 class="card-title">Order ID : <strong>4464646</strong></h4>
									<div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="pt-1 pl-0">Bike Name</th>
                                                    <th class="pt-1">Bike Type</th>
                                                    <th class="pt-1">Vehicle No.</th>
                                                    <th class="pt-1">Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1 pl-0">
                                                        <div class="d-flex align-items-center">
                                                            <img src="images/faces/face1.jpg" alt="profile"/>
                                                            <div class="ml-3">
                                                                <p class="mb-2">Hero Splender Pro</p>
                                                                <p class="mb-0 text-muted text-small">97.8 CC</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Scooty</td>
                                                    <td>DL-214 12545</td>
                                                    <td><label class="badge badge-success"><strong>4.5*<strong></label></td>
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
    <script src="js/google-maps.js"></script>

       
</body>

</html>