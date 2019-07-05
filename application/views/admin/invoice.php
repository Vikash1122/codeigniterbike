<?php 
$this->db->select("bike_rented.id as order_id,bike_details.name as bike_name,bike_details.engine,bike_details.rent_type,concat_ws(' ',users.user_firstname,users.user_lastname) as user_name,DATE_FORMAT(bike_rented.start_date,'%d/%m/%Y %h:%i %p') as start_date,DATE_FORMAT(bike_rented.create_at,'%d/%m/%Y %h:%i %p') as booking_date,DATE_FORMAT(bike_rented.end_date,'%d/%m/%Y %h:%i %p') as end_date,(case when DATEDIFF(end_date,start_date)='0'  then concat(TIMESTAMPDIFF(hour,start_date,end_date),' hour') when TIMESTAMPDIFF(hour,start_date,end_date)='0'  then concat(TIMESTAMPDIFF(minute,start_date,end_date),' minute') else concat((TIMESTAMPDIFF(day,start_date,end_date)),' days') end) as duration, concat('Rs. ',(TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60) as price,concat('Rs. ',round(((TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60)+((TIMESTAMPDIFF(minute,start_date,end_date))*hourly_price/60)*0.18,1)) as netprice,image_name,concat('".base_url()."uploads/bikes/',bike_images.image_name) as image_url,users.user_image,users.user_email,concat('".base_url()."uploads/users/',users.user_image) as image_url1,users.user_id,bike_details.hourly_price,bike_details.category,bike_details.vehicle_no,bike_rented.status")
       ->from("bike_rented")
       ->join("bike_details","bike_details.id=bike_rented.bike_id","left")
       ->join("bike_images","bike_images.bike_id=bike_rented.bike_id","left")
       ->join("users","bike_rented.user_id=users.user_id","left");     
      $res=$this->db->where('bike_rented.id',$_GET['order_id'])->get()->row_array(); 
    $price= (int) filter_var($res['price'], FILTER_SANITIZE_NUMBER_INT);  
 
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
    .box{
        display:none;
    }
    body {
            font-family: 'Poppins', sans-serif;
        }        
        .row {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }        
        #timer div {
            width: 40px;
            text-align: center;
        }        
        #days {
            font-size: 16px;
            color: #1e88e5;
            font-weight: 500;
            float: right;
        }        
        #days span {
            font-size: 14px;
            color: #999;
        }        
        #hours {
            font-size: 16px;
            color: #1e88e5;
            font-weight: 500;
            float: right;
        }        
        #hours span {
            font-size: 14px;
            color: #999;
        }        
        #minutes {
            font-size: 16px;
            color: #1e88e5;
            font-weight: 500;
            float: right;
        }        
        #minutes span {
            font-size: 14px;
            color: #999;
        }        
        #seconds {
            font-size: 16px;
            color: #1e88e5;
            font-weight: 500;
            float: right;
        }        
        #seconds span {
            font-size: 14px;
            color: #999;
        }        
        .page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            position: relative;
        }        
        .page-pd {
            padding: 15px;
        }        
        .page-pd-t {
            padding-top: 15px;
        }        
        .page-pd-b {
            padding-bottom: 10px;
        }        
        .page-pd-lr {
            padding-left: 30px;
            padding-right: 30px;
        }        
        .page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            font-size: 13px;
            color: #000;
        }   
             
        .table {
            margin-bottom: 0px;
            WIDTH: 100%;
            border-collapse: collapse;
        }        
        .table-text tr {
            line-height: 30px;
        }        
        .table-text tr th {
            text-align: right;
            font-weight: 700;
        }        
        .table-text tr td {
            text-align: left;
            font-weight: 500;
            padding-left: 10px;
        }        
        .table-ex-tr {
            background: #f4f5f5;
        }        
        .table-ex-th {
            background: #ef154f;
        }        
        .table-ex-th th {
            color: #fff !important;
            padding-left: 30px;
            line-height: 0px;
        }        
        .table-ex-th th:last-child {
            text-align: right;
            padding-right: 30px;
        }        
        .table-tr-tr td {
            padding-left: 30px;
            padding-bottom: 0px;
            border-bottom: 1px solid #aaa;
            padding-top: 11px;
        }        
        .table-tr-tr td:last-child {
            text-align: right;
            padding-right: 30px;
        }        
        .p-l-30 {
            padding-left: 30px;
        }        
        .p-l-15 {
            padding-left: 15px;
        }        
        .table-ex-tr1 tr td {
            text-align: right;
            padding-right: 30px;
        }        
        .table-ex-tr1 tr {
            line-height: 50px;
        }        
        .table-ex-tr1 tr:first-child {
            border-bottom: 1px solid #aaa;
        }        
        .bottom-div {
            position: absolute;
            bottom: 24px;
        }
      #loading { display: none;

         }
        /* Absolute Center Spinner */

    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Invoice Details</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
            <div class="container-fluid page-body-wrapper">
            <?php include 'menu.php';?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                        <button class="btn btn-sm btn-primary mr-1" id="printbtn">Print</button>
                        <button class="btn btn-sm btn-primary mr-1" id="sendbtn">Send</button>
                        </div>
                      
                        <div class="page" size="A4" id="Invoice">
                            <div class=" page-pd-t"></div>
                            <div class="row page-pd">

                                <div class="col-md-6">
                                    <div class="pull-left">
                                        <address>
                                            <img width="100" src="images/logo.png"/>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right text-right">
                                        <address>
                                            <h2>INVOICE</h2>
                                            <h4 class="font-bold">Swagbike Pvt Ltd</h4>
                                            <p class="text-muted m-l-30">Office 1 Sajhanand Arcade,
                                                <br/> Helmet Circle,
                                                <br/> Ahmedabad,
                                                <br/> India</p>
                   <p class="m-t-30">Mobile: +9170164 36001<br>http://www.swagbikes.in/</p>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <hr class="w-100">
                            <div class="circle-loader" id="loading"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pull-left p-l-15">
                                        <address>
                                            <h3>BILL TO</h3>
                                            <h4 class="font-bold"><?=$res['user_name']?></h4>
                                            <div class="text-black">
                                                
                                               
                                               
                                                <?=$res['user_email']?></div>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6 pull-right">
                                    <address>
                                    <table class="table-text w-100">
                                            <tr>
                                                <th>Invoice Number:</th>
                                                <td>000<?=$_GET['order_id']?></td>
                                            </tr> 
                                            <!-- <tr>
                                                <th>P.O./S.O. Number:</th>
                                                <td>953/MB/SAJJA/DEC18</td>
                                            </tr>  -->
                                            <tr>
                                                <th>Invoice Date:</th>
                                                <td><?=$res['end_date']?></td>
                                            </tr> 
                                            <tr>
                                                <th>Payment Due:</th>
                                                <td><?=$res['booking_date']?></td>
                                            </tr> 
                                            <!-- <tr class="table-ex-tr">
                                                <th>Amount Due (Rs):</th>
                                                <td>AED8,250.00</td>
                                            </tr> --> 
                                        </table>
                                    </address>
                                </div>
                            </div>
                            <div class="page-pd-t">
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="table-ex-th">
                                                <th>No Of Bike</th>
                                                <th>Duration</th>
                                                <!-- <th class="text-right">Price</th> -->
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-tr-tr">
                                                <td>
                                                    <h6 style="padding-bottom: 0;margin-bottom: 8px;margin-top: 0;" class="font-bold">1</h6>
                                                </td>
                                                <td><?=ucwords($res['duration']);?></td>
                                                <!-- <td class="text-right"> <?=$res['duration']?></td> -->
                                                <td class="text-right"> <?=$res['price']?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pull-left p-l-30">
                                        <address></address>
                                    </div>
                                </div>
                                <div class="col-md-6 pull-right">
                                    <address>
                                    <table class="table-text w-100 table-ex-tr1">
                                                                              <tr>
                                                <th>Gst (18%):</th>
                                                <td>Rs <?=$price*0.18?></td>
                                            </tr>  
                                            <tr>
                                                <th>Total:</th>
                                                <td> <?=$res['netprice']?></td>
                                            </tr>     
                                            <tr>
                                                <th>Amount Paid:</th>
                                                <td class="font-bold"><?=$res['netprice']?></td>
                                            </tr> 
                                        </table>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12 text-black page-pd-lr">
                                Notes
                                <br> Total 1 Bike:-
                                <br> Vehicle Number
                                
                                <br> <?=$res['vehicle_no']?>
                                
                            </div>
                            <div class="col-md-12 text-black text-center bottom-div " style="text-align: center;">
                                Thank You
                                <br> Swagbike
                                <br>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
   

       <script> 
$(document).ajaxStart(function() {
  
  
  $("#loading").show();
}).ajaxStop(function() {
  $("#loading").hide();
});
        function srcToFile(src, fileName, mimeType){
    return (fetch(src)
        .then(function(res){return res.arrayBuffer();})
        .then(function(buf){return new File([buf], fileName, {type:mimeType});})
    );
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
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });
            $('#printbtn').on('click',function()
            {  
                $("#Invoice").print();
            })

            $('#sendbtn').on('click',function()
            {
               var data1;
               html2canvas($('#Invoice')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    
            pdfMake.createPdf(docDefinition).getBase64(function(encodedString) {
            data1 = encodedString;
                $.ajax({
                    headers: {
                    'access_token':sessionStorage.getItem('access_token'),  
                    },
                    data:{'user_id':user.user_id,'for':'normal','order_id':'<?=$_GET["order_id"]?>','filedata':data1,'email':'<?=$res["user_email"]?>'},
                    method:'post',                     
                    url:'/swagbike/api/cud/send_invoice',
                    success:function(res){
                    console.log(res);
                    if($.trim(res.status)=='true'){                                
                    alert(res.message);
                     

                    }
                    else{
                       
                     }
                    }
                  })
                console.log(data1);
                //Meteor.call("sendPDFemail", data);
            });
              


          
                }
            });
                 
            });
            
       </script>
</body>

</html>