<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <style type="text/css">.hidden{display:none;}</style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Swag Wallet</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">
                    
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">
                                                <span >Name:</span><span id="name"></span>
                                                <span style="float: right">Balance: Rs. <span id="balance"></span></span>
                                                </h4> 
                                                   <select style="max-width:120px;" class="form-control float-right" id="records">
                                                        <option value="10">10 Records</option>
                                                        <option value="20">20 Records</option>
                                                        <option value="30">30 Records</option>
                                                        <option value="40">40 Records</option>
                                                    </select>
                                                </h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>Type</th>
                                                                <th>For</th>
                                                                <th>Amount</th>
                                                                <th>Order Id</th>
                                                                <th>Date Time</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody id="userlist">
                                                           
                                                        </tbody>
                                                    </table>
                                                    <nav class="pt-3">
                                                    </nav>
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

        <script src="js/file-upload.js"></script>
        <script src="js/iCheck.js"></script>
        <script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>

        <script src="js/formpickers.js"></script>
        <script src="js/form-addons.js"></script>
        <script src="js/x-editable.js"></script>
        <script src="js/dropify.js"></script>
        <script src="js/dropzone.js"></script>
        <script src="js/jquery-file-upload.js"></script>
        <script src="js/formpickers.js"></script>
        <script src="js/form-repeater.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
          
            $('#example-css1').barrating({
                theme: 'css-stars',
                showSelectedRating: false
            });

            ajax();             
              function ajax(page=1,perpage=10){ 
               $('#userlist').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'customer_id':'<?=$_GET["user_id"]?>'},
                    method:'get',
                    url:'/swagbike/api/cud/get_wallet_history',
                    success:function(res){   
                    if(res.user_lastname===''||res.user_lastname===' '||res.user_lastname===null)
                       {
                         var user_name='N/a';
                       }
                       else{
                        user_name=res.user_lastname;
                       }              
                    $('#name').text(user_name);
                       $('#balance').text(res.balance);
                    if($.trim(res.count)!=='0'){ 
                     $.each(res.data, function( key, value ) {
                        
                       
                        if(value.user_email===''||value.user_email===null)
                       {
                         var user_email='N/a';
                       }
                       else{
                        user_email=value.user_email;
                       }
                        
                       if(value.user_image==''||value.user_image==null)
                        {
                            'N/a';
                        }
                       else{                           
                             src=value.image_url;
                             src1=value.image_url;
                             
                        }
                        if(value.transaction_type==='cr')
                        {
                           
                            var atype='<td style="color:red">Credit</td>';
                        }
                        else{
                          atype='<td style="color:green">Debit</td>';
                        }

                        if(value.transaction_for==='none')
                        {
                           
                            var fordata='Add Money';
                        }
                        else{
                          fordata='Redeem For Order';
                        }
                        if(value.order_id===''||value.order_id===null)
                        {
                           
                            var order_id='N/a';
                        }
                        else{
                          order_id='ord_00'+value.order_id;
                        }
                        $('#userlist').append('<tr> '+atype+'<td>'+fordata+'</td><td>Rs. '+value.amount+'</td><td>'+order_id+'</td><td>'+value.create_date+'</td></tr>');
                          });
                      pagination('.pt-3',res,page,'ajax',perpage,perpage);
                        }
                      }
                    })

               }
          $('select#records').on('change', function() {
     ajax(1,this.value);  
});    
        </script>
</body>

</html>