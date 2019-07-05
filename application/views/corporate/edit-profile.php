<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link href="css/new-style.css">
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
    <style>
        .hi-50{
            height: 45px;
            margin-top: 23px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Edit Profile </h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">                   
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                
                                    <div class="col-12 grid-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="row repeater">
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Key Persons to Contact</h4>
                                                        </div>
                                                        <div data-repeater-list="group-a" style="width:96% !important;">
                                                            <div data-repeater-item class="d-flex mb-2">
                                                                <div class="form-group col-md-2">
                                                                    <label>Department</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Department">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Name">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Designation">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Contact No</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Contact No">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Email</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Email">
                                                                </div>
                                                                <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2 hi-50" >
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2 hi-50">
                                                        <i class="mdi mdi-plus"></i>
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Logo</label>
                                                                <input type="file" class="dropify" />
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
                                    </div>
                                   

                                </div>
                            </div>
                            <?php include 'footer.php';?>
                        </div>
                </div>
    </div>
    <?php include 'script.php';?>

        <script src="js/file-upload.js"></script>
        <script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>

        
        <script src="js/form-addons.js"></script>
        <script src="js/x-editable.js"></script>
        <script src="js/dropify.js"></script>
        <script src="js/formpickers.js"></script>
        <script src="js/form-repeater.js"></script>
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
            function preview_images() 
                {
                var total_file=document.getElementById("images").files.length;
                for(var i=0;i<total_file;i++)
                {
                    $('#image_preview').append("<div class='col-md-3'> <i class='mdi mdi-delete dl-ig'></i> <img style='width:100%;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                }
            }
            
        </script>
</body>

</html>