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
                    <h4 class="mb-0">Add Corporate Client</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">                   
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >       
                                            <div id="mainDiv"></div>                            
                                                <form class="forms-sample" action="#" method="post" enctype="multipart/form-data" id="addClient">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Basic Information</h4>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Client Name</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="client_name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Client Address</h4>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Address (line 1)</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="address1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Address (line 2)</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="address2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="country">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Email </label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Landline </label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="landline">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Mobile Number </label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="mobile">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Website </label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="website">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Description of Business</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Type of Business</label>
                                                            <input type="text" class="form-control form-control-md" placeholder="" name="buiseness_type">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Trade License No.</label>
                                                            <input type="text" class="form-control form-control-md" placeholder="" name="trade_license">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Tax Registration Number</label>
                                                            <input type="text" class="form-control form-control-md" placeholder="" name="tax_reg_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Payment Terms</label>
                                                            <input type="text" class="form-control form-control-md" placeholder="" name="payment_terms">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Banker Details</h4>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Bank Name</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="bank_name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>IFSC Code</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="ifsc_code">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Acount No.</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="account_no">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Holder Name</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" name="holder_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                                    <input type="text" class="form-control form-control-md department" placeholder="Department" name="department">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Name" name="name">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Designation" name="designation">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Contact No</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Contact No" name="contact">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Email</label>
                                                                    <input type="text" class="form-control form-control-md" placeholder="Email" name="email">
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
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Upload Documents </h4>
                                                        </div>  
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Commercial License</label>
                                                                <input type="file" class="dropify" name="cl" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Issue Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="cl_issue_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Expiry Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="cl_exp_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>TAX Registration Certificate</label>
                                                                <input type="file" class="dropify" name="tax_certificate" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Issue Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="tc_issue_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Expiry Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="tc_exp_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Insurance</label>
                                                                <input type="file" class="dropify" name="insurance"/>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Issue Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="ins_issue_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Expiry Date</label>
                                                                        <input type="text" class="form-control form-control-md birthday" name="ins_exp_date" value="" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Cancel Check</label>
                                                                <input type="file" class="dropify" name="cancel_check"/>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <button type="button" class="btn btn-dark btn-sm">Cancel</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
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
            $('.birthday').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                
                }, 
                function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    alert("You are " + years + " years old!");
                });
            });
            $('')
            
$('form#addClient').submit(function(){
event.preventDefault();               
var formdata = new FormData($(this)[0]) ;   
    $('input[name*="group-a"]').each(function() {
        var name = $(this).attr("name");
        var val1 = $(this).val();
        formdata.append(name,val1);
    });   

 formdata.append("user_id",user.user_id);         
 formdata.append("cl[]",$('input[name="cl"]')[0].files[0]);
 formdata.append("insurance[]",$('input[name="insurance"]')[0].files[0]);
 formdata.append("tax_certificate[]",$('input[name="tax_certificate"]')[0].files[0]);
 formdata.append("cancel_check[]",$('input[name="cancel_check"]')[0].files[0]);

    $.ajax({
    headers: {
    'access_token':sessionStorage.getItem('access_token'),  
    },
    data:formdata,
    method:'post', 
    enctype: 'multipart/form-data',   
    contentType: false,
    processData: false, 
    url:'/swagbike/api/corporate/add_client',
    success:function(res){
    console.log(res);
    if($.trim(res.status)=='true'){                                
    alert(res.message);
    window.location.reload(true);
    }
    else{
        $('#mainDiv').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '+res.message+'</div>');
        $("html, body").animate({ scrollTop: 0 }, "slow");
     }
    }
  })
});      

            
        </script>
</body>

</html>