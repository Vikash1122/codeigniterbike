<?php $pollution=$this->db->select('DATE_FORMAT(expiry_date, "%d/%m/%Y") as date,bike_id,vehicle_no')->join('bike_details','bike_details.id=bike_pollution.bike_id','left')->where('expiry_date>curdate()')->where('(expiry_date-INTERVAL 7 DAY)<= CURDATE()')->get('bike_pollution')->result_array();
$insurance=$this->db->select('DATE_FORMAT(expiry_date, "%d/%m/%Y") as date,bike_id,vehicle_no')->join('bike_details','bike_details.id=bike_insurance.bike_id','left')->where('expiry_date>curdate()')->where('(expiry_date-INTERVAL 7 DAY)<= CURDATE()')->get('bike_insurance')->result_array();
$service=$this->db->select('DATE_FORMAT(next_due_date, "%d/%m/%Y") as date,bike_id,vehicle_no')->join('bike_details','bike_details.id=bike_service.bike_id','left')->where('next_due_date>curdate()')->where('(next_due_date-INTERVAL 7 DAY)<= CURDATE()')->get('bike_service')->result_array();
$user_results_data=$this->db->where('user_role','customer')->where('created_at>=CURDATE()')->where('seen','false')->get('users')->result_array();
$bike_rented=$this->db->where('create_at>=CURDATE()')->where('seen','false')->get('bike_rented')->result_array();  

?>

        <ul class="navbar-nav navbar-nav-right">
        <!--   <li class="nav-item nav-search position-relative" id="navbarSearch">
            <a class="nav-link d-flex justify-content-center align-items-center" id="navbarSearchButton" href="#">
              <i class="mdi mdi-magnify mx-0"></i>
            </a>
            <input type="text" class="form-control" placeholder="Search..." id="navbarSearchInput">                  
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-email-outline mx-0"></i>
              <span class="count count-email"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline mx-0"></i>
              <?php if(!empty($pollution) || !empty($service) || !empty($insurance) || !empty($user_results_data) || !empty($bike_rented)){?>
              <span class="count"></span>
             <?php }?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">
              <?php if(!empty($pollution)|| !empty($service)|| !empty($insurance) || !empty($user_results_data) || !empty($bike_rented)){echo 'Notifications';} else{
                echo 'No Notifications Available';;
                }?></p>
              
                
                <?php if(!empty($pollution)){
                    foreach ($pollution as $key => $value) {
                      
                  ?>
                  <a class="dropdown-item preview-item" href="vehicleDetails?id=<?= $value['bike_id']?>">
                 <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Pollution Going To Expired At <?=$value['date']?></h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    <?=$value['vehicle_no']?>
                  </p>
                </div>
                
                <?php }}?>

                 <?php if(!empty($service)){
                    foreach ($service as $key => $value) {
                      
                  ?>
                  <a class="dropdown-item preview-item" href="vehicleDetails?id=<?= $value['bike_id']?>">
                 <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Service Next Due Date Going To Start At <?=$value['date']?></h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    <?=$value['vehicle_no']?>
                  </p>
                </div>
                
                <?php }}?>
                       
                <?php if(!empty($insurance)){
                    foreach ($insurance as $key => $value) {
                      
                  ?>
                  <a class="dropdown-item preview-item" href="vehicleDetails?id=<?= $value['bike_id']?>">
                  <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Insurance Going To Expired At <?=$value['date']?></h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                     <?=$value['vehicle_no']?>
                  </p>
                </div>
                
                <?php }}?>
              </a>
              <form method="post">
              <input type="hidden" name="seedata" value="1">
              </form>
              <?php if(!empty($user_results_data)){?>
              
              <a class="dropdown-item preview-item" href="userList?notification=true">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Today
                  </p>
                </div>
              </a>
               <?php }?> 
                <?php if(!empty($bike_rented)){?>
              
              <a class="dropdown-item preview-item" href="activeOrders?notification=true">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-cart mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New Order Created</h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Today
                  </p>
                </div>
              </a>
               <?php }?> 
             
             
            </div>
          </li>
          <li class="nav-item nav-profile dropdown mr-0 mr-sm-3">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile" class="user-auth-img" />
              <span class="nav-profile-name mr-2">Craig Estrada</span>              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" id="logout"> 
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <!-- <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link d-flex justify-content-center align-items-center" href="#">
              <i class="mdi mdi-dots-horizontal"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>