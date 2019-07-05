<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
        <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
        <style>
        .form-check{
            min-width: 40px;
        }
        </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0"><?php if(isset($_GET['corder_id'])){?>Lease Vehicles
                                                  <?php }else{?>
                                                  Select Lease Vehicle
                                                   <?php }?>  </h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
                <div class="container-fluid page-body-wrapper">                   
                    <?php include 'menu.php';?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row">
                                <?php if(!isset($_GET['corder_id'])){?>
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body pb-0">
                                            <div id="mainDiv"></div>

                                                <form class="forms-sample">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Lease Duration</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" id="date" /> 
                                                            </div>
                                                        </div>
                                                 <!--        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>End Date</label>
                                                                <input type="text" class="form-control form-control-md" name="birthday" value="" id="end_date" /> 
                                                            </div>
                                                        </div> -->
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><?php if(isset($_GET['corder_id'])){?>Vehicle List
                                                  <?php }else{?>
                                                   Available Vehicle 
                                                   <?php }?>
                                                </h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                            <?php if(!isset($_GET['corder_id'])){?>
                                                                <th>Select</th>
                                                                <?php }?>
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Category</th>
                                                                <th>Color</th>
                                                                <th>Vehicle No.</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="vehicle_list">
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!isset($_GET['corder_id'])){?> 
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">

                                            <div class="card-body">
                                             <?php if(isset($_GET['ccid'])){?><input type="hidden" name="cc_id" value="<?=$_GET['ccid']?>" id="cc_id">
                                             <?php }?>
                                            <?php if(isset($_GET['mode'])){?><input type="hidden" name="cc_id" value="<?=$_GET['mode']?>" id="mode"><?php }?>
                                               <div class="col-md-5 float-right mb-4">
                                                    Total Amount  <span class="float-right" >Rs <span id="tprice">0</span> </span>                                                   
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-5 float-right">
                                                    <span>Discounted Amount</span>  <span class="float-right"><input type="text" class="form-control" id="dprice" placeholder="Rs" value=""></span> 
                                                </div> 
                                                <div class="clearfix"></div>
                                                <div class="col-md-5 float-right mt-4">
                                                    <button type="button" class="btn btn-primary float-right" id="submit">Submit</button>
                                                </div>
                                            </div>
                                                                                              
                                        </div>
                                        </div>
 <?php }?>
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
        <!-- <script src="js/select2.js"></script> -->

        <script src="js/formpickers.js"></script>
        <script src="js/form-addons.js"></script>
        <script src="js/x-editable.js"></script>
        <!-- <script src="js/dropify.js"></script>
        <script src="js/dropzone.js"></script> -->
        <script src="js/jquery-file-upload.js"></script>
        <script src="js/formpickers.js"></script>
        <script src="js/form-repeater.js"></script>
        <script type="text/javascript" src="js/daterangepicker.min.js"></script>

        <script>
           $('#dprice').keyup(function () { 
           this.value = this.value.replace(/[^0-9\.]/g,'');
               })
    var path=window.location.origin+window.location.pathname;
               path=path.split('admin/');
            
           $( "#date" ).daterangepicker({
            minDate:moment(),
            locale: {
      format: 'MM/DD/Y'
    }
      
    });
   
            // $('#end_date').daterangepicker({
            //     singleDatePicker: true,
            //     showDropdowns: true,              
            // });
            $('#example-css1').barrating({
                theme: 'css-stars',
                showSelectedRating: false
            });

            ajax();             
              function ajax(){ 
              var vehicle='';  
               if(path[1]==='instantVehicle'){
                vehicle='instant';            
              }   
              else{
                vehicle='lease';
              }          
              $('#vehicle_list').html(''); 
              var tprice1='0';            
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':'','perpage':'','vehicle_type':vehicle,'mode':$('#mode').val(),'cc_id':$('#cc_id').val(),<?php if(isset($_GET['corder_id'])){echo "c_order:".$_GET['corder_id'];}?>},
                    method:'get',
                    url:'/swagbike/api/cud/get_allbikes',
                    success:function(res){                 

                    if($.trim(res.count)!=='0'){ 
                      var i = 1;
                      $('#dprice').val(res.price);
                     $.each(res.data, function( key, value ) {
                        if(value.rent_type==='instant'){
                            var price=value.hourly_price;
                        }
                        else{
                            price=value.monthly_price;
                        }

                        if($('#mode').val()==='edit' )
                        {

                            if(value.selected==='true')
                            {
                             var checkbox='<input type="checkbox" class="form-check-input  bike_id" value="'+value.id+'" checked="true" data-price="'+price+'" id="bike_click">';
                                tprice1=parseInt(tprice1)+parseInt(value.monthly_price);


                            }
                            else{
                              var checkbox='<input type="checkbox" class="form-check-input bike_id" value="'+value.id+'" data-price="'+price+'">';                             
                                  }

                        }
                        
                        else{
                             checkbox='<input type="checkbox" class="form-check-input bike_id" value="'+value.id+'" data-price="'+price+'">'
                        }
                        var cheboxtd='';
                        <?php if(isset($_GET['corder_id'])){ ?>
                        if(<?=$_GET['corder_id']?>!=='')
                        {
                           cheboxtd=''; 
                          
                        }
                        <?php } else{?>
                        
                        cheboxtd='<td class="py-1"> <div class="form-check"> <label class="form-check-label"> '+checkbox+' </label> </div></td>';
                       <?php }?>
                        $('#vehicle_list').append('<tr>"'+cheboxtd+'"<td ><img src="'+value.bike_image+'" alt="image"/> </td><td class="border-top-0"> <p class="font-weight-medium text-dark mb-0">'+value.name+'</p><p class="text-muted mb-0">'+value.engine+'</p></td><td>'+value.category+'</td><td>'+value.color+'</td><td>'+value.vehicle_no+'</td><td>Rs '+price+' / month</td></tr>');
                          });
                     if($('#mode').val()==='edit')
                     {
                        $('#tprice').text(tprice1);
                     }
                   //  $('#org_name').text(res.org_name); 

                      
                     } 
                     else{
                     $('#vehicle_list').append('<tr> <td colspan="7" style="text-align:center">No Bikes Available!!</td></tr>'); 
                     }              
                  }

                })
 
                    
               }
              
              
    //            $('.bike_id').change(function() {
    //     if($(this).checked) {
    //        tprice= tprice+$(this).data('price');
    //        console.log(tprice);
    //     }
    //     $('#textbox1').val(this.checked);        
    // });
              
  $(function() {  
   var tprice='0';
   var i=1;             
$('.bike_id').on('click', function () {  
    if(this.checked)
    {
      if(i===1)
     {
     var preprice=parseInt($('#tprice').text());
        }
   else{
    preprice=0
   }
       tprice=parseInt(tprice)+parseInt($(this).data("price"))+preprice;
       
    }
   
    else{
        tprice=parseInt(tprice)-parseInt($(this).data("price"));
      
    }
    if(tprice<0)
    {
        tprice=0;
    }
     $('#tprice').text(tprice);

     i++;
});
     });
$('#submit').on('click',function(){
var bike_id = $('input:checkbox:checked.bike_id').map(function(){
return this.value; }).get().join(",");
// console.log($('#cc_id').val());
// console.log($('#tprice').html());
// console.log(bike_id);
// console.log($('#date').val());
if(bike_id===''){
 $('#mainDiv').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select atleast one vehicle!!</div>');
    $("html, body").animate({ scrollTop: 0 }, "slow");  
    return false; 
           } 
if($('#dprice').val()!=='')
{

    var price=$('#dprice').val();
}
else{
    price=$('#tprice').text();
}
var datearray = $('#date').val().split("-");
formdata=new FormData();
formdata.append('cc_id',$('#cc_id').val());
formdata.append('bike_id',bike_id);
formdata.append('lease_start',datearray[0]);
formdata.append('lease_end',datearray[1]);
formdata.append('price',price);
formdata.append('user_id',user.user_id);
if($('#mode').val()==='edit')
{
    formdata.append('order_id','true');
}
   $.ajax({
    headers: {
    'access_token':sessionStorage.getItem('access_token'),  
    },
    data:formdata,
    method:'post', 
    enctype: 'multipart/form-data',   
    contentType: false,
    processData: false, 
    url:'/swagbike/api/corporate/corporate_order',
    success:function(res){
    console.log(res);
    if($.trim(res.status)=='true'){                                
    alert(res.message);
    window.location.href='/swagbike/admin/corporateLease';
    }
    else{
        $('#mainDiv').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '+res.message+'</div>');
        $("html, body").animate({ scrollTop: 0 }, "slow");
     }
    }
  })
               })
        </script>
</body>

</html>