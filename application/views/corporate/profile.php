<?php 
$ccid = $this->session->userdata('client_id');
$corporate_res=$this->db->select('*,CONCAT_WS(",",address1,address2,city,country) location')->where('id',$ccid)->get('corporate_clients')->row_array();
$key_persons=$this->db->select('*')->where('cc_id',$ccid)->get('corporate_key_person')->result_array();
$document_res=$this->db->select("*, concat('".base_url()."uploads/corporate/',name) as doc_url")->where('cc_id',$ccid)->get('corporate_client_documents')->result_array();
$document_res1=array();
foreach ($document_res as $key => $value) {
    if($value['doc_type']==='1')
    {
       $document_res1['commercial']=$value; 
    }
    if($value['doc_type']==='2')
    {
       $document_res1['tax']=$value; 
    }
    if($value['doc_type']==='3')
    {
       $document_res1['insurance']=$value; 
    }
    if($value['doc_type']==='4')
    {
       $document_res1['check']=$value; 
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
    <link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
    <style>
    .box{
        display:none;
    }
    figcaption { text-align: center;  overflow-wrap: break-word;}
    figcaption {
  background-color: #ef1750;
  padding: 1rem;  
  transition: opacity 1s ease; 
  color:white;
  font-weight: bold;
}
img{
        width: 300px;
    height: 250px;
}

    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Corporate Lease Details</h4>
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
                                  
                                      <figcaption ><?=$corporate_res['client_name']?></figcaption>
                                      <br>
                                        <div class="mb-3">
                                          
                                            <p class="text-muted mb-0"><?=$corporate_res['email']?></p>
                                            <p class="text-muted mb-0"><?=$corporate_res['mobile']?></p>
                                            <p class="text-muted mb-0"><?=$corporate_res['landline']?></p>
                                            <p class="mt-4 card-text">
                                            <?=$corporate_res['location']?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">Bank Name </span>
                                            <span class="float-right text-muted"><?=$corporate_res['bank_name']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">IFSC Code</span>
                                            <span class="float-right text-muted"><?=$corporate_res['ifsc_code']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Acount No.</span>
                                            <span class="float-right text-muted"><?=$corporate_res['account_no']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Holder Name</span>
                                            <span class="float-right text-muted"><?=$corporate_res['holder_name']?></span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">Payment Terms</span>
                                            <span class="float-right text-muted"><?=$corporate_res['payment_terms']?></span>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="editProfile" class="btn btn-primary mr-1">Edit</a>
                                    </div>
                                </div>
                            </div>
                        
                      </div>
                       <div class="col-md-9 grid-margin grid-margin-md-0 ">
                            <div class="card">
                                <div class="card-body">                                
                                    <h4 class="card-title">Key Persons To Contact </h4>
                                    <?php foreach ($key_persons as $key1 => $value1) {
                                      ?>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Department</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['department']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Name</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['name']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Designation</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['designation']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Contact No</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['contact']?></p>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <p class="mb-2">Email</p>
                                            <p class="mb-0 text-muted text-small"><?=$value1['email']?></p>
                                        </div>
                                    </div>
                                  <hr>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Document</h4>
                                    <div id="lightgallery" class="row lightGallery">
                                        <a href="<?=$document_res1['commercial']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Commercial License </span>
                                            </p>
                                            <img src="<?=$document_res1['commercial']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['commercial']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['commercial']['expiry_date']))?></span>
                                            </p>
                                        </a>
                                       <a href="<?=$document_res1['tax']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">TAX Registration Certificate </span>
                                            </p>
                                            <img src="<?=$document_res1['tax']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['tax']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['tax']['expiry_date']))?>
                                            </p>
                                        </a>
                                        <a href="<?=$document_res1['insurance']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Insurance </span>
                                            </p>
                                            <img src="<?=$document_res1['insurance']['doc_url']?>">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Issue Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['insurance']['issue_date']))?></span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">Expiry Date </span>
                                                <span class="float-right text-muted"><?=date('d/m/Y',strtotime($document_res1['insurance']['expiry_date']))?></span>
                                            </p>
                                        </a>
                                        <a href="<?=$document_res1['check']['doc_url']?>" class="image-tile">
                                            <p class="clearfix mt-4">
                                                <span class="float-left">Cancel Check </span>
                                            </p>
                                            <img src="<?=$document_res1['check']['doc_url']?>">
                                        </a>
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

    <script src="js/profile-demo.js"></script>
    <script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
    <script src="js/light-gallery.js"></script>
    <script src="js/owl-carousel.js"></script>
    <script src="js/dropify.js"></script>
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
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });

              
                           

                       
               
       </script>
</body>

</html>