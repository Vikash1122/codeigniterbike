<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike Admin</title>
    <?php include 'css.php';?>
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Dashboard</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">
                <div class="theme-setting-wrapper">
                  <!-- <div id="settings-trigger"><i class="mdi mdi-settings"></i></div> -->
                  <div id="theme-settings" class="settings-panel">
                      <i class="settings-close mdi mdi-close"></i>
                      <p class="settings-heading">SIDEBAR SKINS</p>
                      <!-- <div class="sidebar-bg-options" id="sidebar-light-theme">
                          <div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
                      <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
                          <div class="img-ss rounded-circle bg-primary border mr-3"></div>Dark</div>
                      <p class="settings-heading mt-2">HEADER SKINS</p>
                      <div class="color-tiles mx-0 px-4">
                          <div class="tiles light"></div>
                          <div class="tiles dark"></div>
                          <div class="tiles default"></div>
                      </div> -->
                  </div>
              </div>
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start justify-content-between">
                                                    <h5 class="card-title">Total Vehicle</h5>
                                                    <div class="icon-rounded-primary d-none d-lg-block">
                                                        <i class="mdi mdi-motorbike icon-md"></i>
                                                    </div>
                                                </div>
                                                <h1 class="mt-0"><?php echo $this->db->get('bike_details')->num_rows()?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start justify-content-between">
                                                    <h5 class="card-title">Total User</h5>
                                                    <div class="icon-rounded-primary d-none d-lg-block">
                                                        <i class="mdi mdi-account-outline icon-md"></i>
                                                    </div>
                                                </div>
                                                <h1 class="mt-0"><?php echo $this->db->where('user_role','customer')->get('users')->num_rows()?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start justify-content-between">
                                                    <h5 class="card-title">Total Order</h5>
                                                    <div class="icon-rounded-primary d-none d-lg-block">
                                                        <i class="mdi mdi-cart icon-md"></i>
                                                    </div>
                                                </div>
                                                <h1 class="mt-0"><?php echo $this->db->get('bike_rented')->num_rows()?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                          <div class="row">
                           <div class="col-md-12 grid-margin stretch-card">
                             <div class="card">
                              <div class="card-body">
                                <h6 class="card-title">Map</h6>
                                  <div class="map-container">
                                     <div id="map-with-marker" class="google-map">
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
   
    
    

        </script> 
</body>
</html>