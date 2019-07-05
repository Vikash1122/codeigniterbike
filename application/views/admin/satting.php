<?php 

// 'SELECT bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date, bike_rented.status,(case when DATEDIFF(curdate(),start_date)<24  then concat(DATEDIFF(curdate(),start_date)," days") else concat((DATEDIFF(curdate(),start_date))*24," hours") end) as duration, concat("Rs. ",(DATEDIFF(curdate(),start_date))*24*hourly_price) as price  FROM `bike_rented` join bike_details on bike_details.id=bike_rented.bike_id join users on bike_rented.user_id=users.user_id  where bike_rented.status='1''
//print_r(array_values($result));
//print_r(all_bike_location());
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Swag Bike</title>
<?php include 'css.php';?>
<link href="css/new-style.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="css/new-style.css" />

<style type="text/css">
     .pac-container {
        z-index: 10000 !important;
    }
  
   
</style>
</head>
<body>
<div class="container-scroller">
<?php include 'nev-1.php';?>
    <ul class="navbar-nav mr-lg-2">
        <li class="nav-item d-none d-lg-block">
            <h4 class="mb-0">Setting</h4>
        </li>
    </ul>
    <?php include 'nev-2.php';?>
        <div class="container-fluid page-body-wrapper">                   
            <?php include 'menu.php';?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Brand<button  data-toggle="modal" data-target="#exampleModal-1" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="brandrow">
                                           
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="brand_tab">
                                               
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Category<button  data-toggle="modal" data-target="#exampleModal-2" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Category</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="categoryrow">
                                       
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="category_tab">
                                               
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Model Name<button  data-toggle="modal" data-target="#exampleModal-3" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Model Name</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="modelrow">
                                           
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="model_tab">
                                               
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Model Year <button  data-toggle="modal" data-target="#exampleModal-4" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Model Year </th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="modelyearrow">
                                            
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="modelyear_tab">
                                                
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Color <button  data-toggle="modal" data-target="#exampleModal-5" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Color </th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="colorrow">
                                            
                                                
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="color_tab">
                                                
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-4 grid-margin stretch-card" style="display: none">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Location <button  data-toggle="modal" data-target="#exampleModal-6" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-plus"></i></button></h4>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th>Location </th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="locationrow">
                                            
                                                
                                            </tbody>
                                            </table>
                                            <nav class="pt-3" id="location_tab">
                                                
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="card-title">Basic Information</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Brand</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">Hero</option>
                                                            <option value="WY">Honda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">Hero</option>
                                                            <option value="WY">Honda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Model Name</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">2017</option>
                                                            <option value="WY">2018</option>
                                                            <option value="WY">2019</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Model Year</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">2017</option>
                                                            <option value="WY">2018</option>
                                                            <option value="WY">2019</option>
                                                        </select>
                                                    </div>
                                                </div>                                                        
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Color</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">Red</option>
                                                            <option value="WY">Blue</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Transmission Type</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">Both</option>
                                                            <option value="WY">Manual</option>
                                                            <option value="WY">Automatic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Fuel Type</label>
                                                        <select class="js-example-basic-single w-100">
                                                            <option value="AL">Petrol</option>
                                                            <option value="WY">Electric</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Fuel Capacity</label>
                                                        <input type="text" class="form-control form-control-md" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Mileage</label>
                                                        <input type="text" class="form-control form-control-md" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Engine</label>
                                                        <input type="text" class="form-control form-control-md" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                                <div class="col-md-12">
                                                    <h4 class="card-title">Price</h4>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                                                            Hourly
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                                                            Monthly
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" style="max-width:25%;" class="form-control form-control-md" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" class="form-control form-control-md" placeholder="">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="card-title">Upload Document <button type="button" class="btn btn-primary btn-sm float-right">Add More</button></h4>
                                                </div>
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <p>Vehicle Image</p>
                                                </div>
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div action="http://www.urbanui.com/file-upload" class="dropzone d-flex align-items-center w-100" id="my-awesome-dropzone"></div>
                                                </div>
                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>RC</label>
                                                        <input type="file" class="dropify" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Insurance</label>
                                                        <input type="file" class="dropify" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Issue Date</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" /> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Expiry Date</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" /> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Polution</label>
                                                        <input type="file" class="dropify" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Issue Date</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" /> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Expiry Date</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" /> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-dark btn-sm">Cancel</button>
                                                <button type="button" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                            <div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Brand</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="bike_brands" method="post" enctype="multipart/form-data" onsubmit="return saveData('bike_brands','1')">
                                                <div class="form-group" id="myRadioGroup">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios1" value="twoCarDiv">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="threeCarDiv">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group desc" id="twoCarDiv">
                                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="recipient-name" name="name" id="name">
                                                    </div>
                                                    <div class="form-group desc"  id="threeCarDiv">
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify" name="userfile" id="userfile" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                            
                                        </div>
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="bike_category" method="post" enctype="multipart/form-data" onsubmit="return saveData('bike_category','2')">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios3" value="option2">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check ">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="option1">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group desc" id="option2">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="name">
                                                </div>
                                                <div class="form-group desc" id="option1" >
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify"  name="userfile"/>
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
                            <div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Model Name </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="return saveData('bike_models','3')" id="bike_models" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios1" value="option3">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="option4">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group desc" id="option3">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="name">
                                                </div>
                                                <div class="form-group desc" id="option4">
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify" name="userfile"/>
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
                            <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Model Year </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="return saveData('bike_year','4')" id="bike_year" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios1" value="option5">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="option6">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group desc" id="option5">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="name">
                                                </div>
                                                <div class="form-group desc" id="option6">
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify"  name="userfile"/>
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
                            <div class="modal fade" id="exampleModal-5" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Color </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="return saveData('bike_color','5')" id="bike_color" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios1" value="option7">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="option8">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group desc" id="option7">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="name" >
                                                </div>
                                                <div class="form-group desc" id="option8">
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify" name="userfile" />
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
                            <div class="modal fade modal" id="exampleModal-6" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Add Location </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="return saveData('bike_locations','6')" id="bike_locations" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios1" value="option9">
                                                        One By One
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="cars" id="optionsRadios2" value="option10">
                                                        Bulk Upload
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group desc" id="option9">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" id="source" name="name" >
                                                    <input type="text" name="latitude" value="" id="latitude">
                                                    <input type="text" name="longitude" value="" id="longitude">
                                                </div>
                                                <div class="form-group desc" id="option10">
                                                        <label>Upload Csv file </label>
                                                        <input type="file" class="dropify" name="userfile" />
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

<div class="swal-overlay swal-overlay--show-modal" tabindex="-1" style="display: none;">
  <div class="swal-modal" role="dialog" aria-modal="true" ><div class="swal-icon swal-icon--success">
    <span class="swal-icon--success__line swal-icon--success__line--long"></span>
    <span class="swal-icon--success__line swal-icon--success__line--tip"></span>

    <div class="swal-icon--success__ring"></div>
    <div class="swal-icon--success__hide-corners"></div>
  </div><div class="swal-title" style="">Congratulations!</div><div class="swal-text" style="">You entered the correct answer</div><div class="swal-footer"><div class="swal-button-container">

    <button class="swal-button swal-button--confirm btn btn-primary" id="continue">Continue</button>

    <div class="swal-button__loader">
      <div></div>
      <div></div>
      <div></div>
    </div>

  </div></div></div></div>
                        </div>
                    </div>
                    <?php include 'footer.php';?>
                </div>
        </div>
</div>
<?php include 'script.php';?>

<script src="js/file-upload.js"></script>
<!-- <script src="js/iCheck.js"></script> -->
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>


<script src="js/form-addons.js"></script>
<script src="js/x-editable.js"></script>
<script src="js/dropify.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/jquery-file-upload.js"></script>
<script src="js/formpickers.js"></script>
<script src="js/form-repeater.js"></script>
<script src="js/alerts.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<div id="map"></div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfx5b3YVA5D_PYBpFzSsH95zJ55xRCnN0&libraries=places&callback=initMap" async defer></script>

<script type="text/javascript">
//var pickupListLatitude  = [];
function initMap(num) { 
//var pickupListLatitude  = [];

//var dropupListLatitude = [];
     if (num == undefined)  {
         
        var source = document.getElementById('source');
        var source_autocomplete = new google.maps.places.Autocomplete(source);
        source_autocomplete.addListener('place_changed', function() {
            var place = source_autocomplete.getPlace();
            if (place.geometry) {
                var sourceLatitude = place.geometry.location.lat();
                var sourceLongitude = place.geometry.location.lng();
                $("#latitude").val(sourceLatitude);
                $("#longitude").val(sourceLongitude);               
            }
        });   

        }
    }
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
    $(document).ready(function() {
        $("div.desc").hide();
        $("input[name$='cars']").click(function() {
            var test = $(this).val();
            //alert(test);
            $("div.desc").hide();
            $("#" + test).show();
        });
    });

        function saveData(id,modal){
        event.preventDefault();  
        // alert('#'+id+' input[name="userfile"]');
        var file_data = $('#'+id+' input[name="userfile"]')[0].files[0];
        var data = new FormData();   
        data.append("userfile", file_data); 
        data.append("table", id); 
        data.append("user_id",user.user_id); 
        var form_data =$('#'+id).serializeArray();
        $.each(form_data,function(key,input){
        data.append(input.name,input.value);
        });                     
        $.ajax({
        headers: {
        'access_token':sessionStorage.getItem('access_token'),  
        },

        data:data,
        method:'post', 
        enctype: 'multipart/form-data',   
        contentType: false,
        processData: false, 
        url:'/swagbike/api/cud/add_csv',
        success:function(res){
         console.log(res);
        if($.trim(res.status)=='true'){     
        $('#exampleModal-'+modal+'').modal('toggle');                           
           $('.swal-overlay--show-modal').modal('toggle');
          $('.swal-text').html(res.message);
          //window.location.reload(true);
          }
        }
       })
    };

     

              brand();
              color();
              category();
              model();
              modelyear(); 
              bikelocation();            
              function brand(page=1,perpage=5){                
                $('#brandrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_brand',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                var tables="brands";
                $.each(res.data, function( key, value ) {
                $('#brandrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><a href="#brandmyModal'+value.id+'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>');
                 $('#brandrow').after('<div id="brandmyModal'+value.id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these records? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.id+',0)">Delete</button></div></div></div></div>');
                });
                pagination('#brand_tab',res,page,'brand',perpage,perpage);
                }                
                }
                })
            }

            function bikelocation(page=1,perpage=5){  
                $('#locationrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_bike_location',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                $.each(res.data, function( key, value ) {
                $('#locationrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><button class="btn btn-primary btn-sm"><i class="mdi mdi-delete"></i></button></td></tr>');
                });
                pagination('#location_tab',res,page,'bikelocation',perpage,perpage);
                }                
                }
                })
            }
            function category(page=1,perpage=5){                
                $('#categoryrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_category',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                $.each(res.data, function( key, value ) {
                $('#categoryrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><a href="#myModal'+value.id+'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>');
                $('#categoryrow').after('<div id="myModal'+value.id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these records? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.id+',1)">Delete</button></div></div></div></div>');
                });
                pagination('#category_tab',res,page,'category',perpage,perpage);
                }                
                }
                })
            }

            function color(page=1,perpage=5){                
                $('#colorrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_colors',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                $.each(res.data, function( key, value ) {
                $('#colorrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><a href="#colormyModal'+value.id+'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>');
                $('#colorrow').after('<div id="colormyModal'+value.id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these records? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.id+',2)">Delete</button></div></div></div></div>');
                });
                pagination('#color_tab',res,page,'color',perpage,perpage);
                }                
                }
                })
            }
            function model(page=1,perpage=5){                
                $('#modelrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_model',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                $.each(res.data, function( key, value ) {
                $('#modelrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><a href="#modalmyModal'+value.id+'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>');
                $('#modelrow').after('<div id="modalmyModal'+value.id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these records? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.id+',3)">Delete</button></div></div></div></div>');
                });
                pagination('#model_tab',res,page,'model',perpage,perpage);
                }                
                }
                })
            }

            function modelyear(page=1,perpage=5){                
                $('#modelyearrow').html('');             
                $.ajax({
                headers: {
                'access_token':sessionStorage.getItem('access_token'),         
                },
                data:{'user_id':user.user_id,'page':page,'perpage':perpage},
                method:'get',
                url:'/swagbike/api/cud/get_modelyear',
                success:function(res){                 

                if(($.trim(res.data.length))!==0){                    
                result=res;
                var i = 1;
                $.each(res.data, function( key, value ) {
                $('#modelyearrow').append('<tr> <td> <div class="d-flex align-items-center"> <div class=" ml-4 pl-2"> <p class="font-weight-medium">'+value.name+'</p></div></div></td><td class="font-weight-medium"><a href="#yearmyModal'+value.id+'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="mdi mdi-delete"></i></a></td></tr>');
                $('#modelyearrow').after('<div id="yearmyModal'+value.id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these records? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.id+',4)">Delete</button></div></div></div></div>');
                });
                pagination('#modelyear_tab',res,page,'modelyear',perpage,perpage);
                }                
                }
                })
            }

function deleteData(id,table){        
        // alert('#'+id+' input[name="userfile"]');        
        var data = new FormData(); 
        if(table===0)
        {
            table='bike_brands';
        }
        if(table===1)
        {
            table='bike_category';
        }
        if(table===2)
        {
            table='bike_color';
        }
        if(table===3)
        {
            table='bike_models';
        }
        if(table===4)
        {
            table='bike_year';
        }
       // alert(table);
        data.append("table", table); 
        data.append("id", id);
        data.append("user_id",user.user_id); 
                             
        $.ajax({
        headers: {
        'access_token':sessionStorage.getItem('access_token'),  
        },

        data:data,
        method:'post',         
        contentType: false,
        processData: false, 
        url:'/swagbike/api/cud/delete_data',
        success:function(res){
         console.log(res);
        if($.trim(res.status)=='true'){                                
          //alert(res.message);
          $('.swal-overlay--show-modal').modal('toggle');
          $('.swal-text').html(res.message);
         // window.location.reload(true);
          }
        }
       })
    };

$('#continue').on('click',function()
{
    $('.swal-overlay--show-modal').modal('toggle');
              brand();
              color();
              category();
              model();
              modelyear(); 
              bikelocation(); 
})
</script>
</body>

</html>