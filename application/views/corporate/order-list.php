<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Swagbike Corporate Admin</title>
  <?php include 'css.php';?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
  <div class="container-scroller">
    <?php include 'nev-1.php';?>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item d-none d-lg-block">
            <h4 class="mb-0">Order List</h4>
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
                        <div class="card-body">
                            <form class="forms-sample">
                                <div class="row">
                                    <div class="col-md-4">  
                                        <label>Order ID </label>   
                                        <input type="text" class="form-control" id="order_id" placeholder="">
                                    </div>
                                    <div class="col-md-4"> 
                                        <label>By Date</label> 
                                        <input type="text" class="form-control" name="daterange" placeholder="" id="daterange"> 
                                        <!-- <input type="text" name="birthday" value="10/24/1984" /> -->
                                    </div>
                                    <div class="col-md-4">  
                                    <label>Status</label>     
                                        <div class="input-group">
                                            
                                            <select class="form-control form-control-lg" id="status">
                                                <option selected disabled value="">Status</option>
                                                <option value="complete">Complete</option>
                                                <option value="active">Active</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary" type="button" id="filterdata">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All User                                                 
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
                                            <th>Order ID</th>
                                            <th>No Of Bike</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Duration</th>
                                           <!--  <th>Status</th> -->
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corporate_orders">
                                      
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
        <!-- <div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Order Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="card-title">Order No. <strong>546454</strong></h4>
                            <table class="table table-border">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Active</td>
                                        <td>12/02/2019</td>
                                        <td>12:20 PM</td>
                                    </tr>
                                    <tr>
                                        <td>Active</td>
                                        <td>12/02/2019</td>
                                        <td>12:20 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
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
    $(function() {
       
         $('input[name="daterange"]').focus ( function(){
    $( 'input[name="daterange"]').daterangepicker();
  });
    });
    
      

                ajax();             
              function ajax(page=1,perpage=10,order_id='',daterange='',status=''){ 
               $('#corporate_orders').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.id,'page':page,'perpage':perpage,'cc_id':user.id,'for':'corporate','order_id':order_id,'daterange':daterange,'status':status},
                    method:'get',
                    url:'/swagbike/api/corporate/get_corporate',
                    success:function(res){                
                    if($.trim(res.count)!=='0' && $.trim(res['data'][0].duration)!==''){ 
                     $.each(res.data, function( key, value ) {
                      var ccid=btoa(value.id);
                        $('#corporate_orders').append(' <tr> <td>'+value.order_id+'</td><td>'+value.tbikes+'</td><td>'+value.lease_start+'</td><td>'+value.lease_end+'</td><td>'+value.duration+'</td><td>Rs <strong>'+value.price+'</strong></td><td> <a href="orderDetails?id='+ccid+'" class="btn btn-primary btn-sm">View</a> </td></tr>');
                          });
                      pagination('.pt-3',res,page,'ajax',perpage,perpage);
                        }

                        else{
                            $('#corporate_orders').append(' <tr> <td colspan="7">No Data Found!!</td></tr>');
                            $('.pt-3').html('');
                        }
                      }
                    })

               }

$('#filterdata').on('click',function()
{
  ajax(1,10,$('#order_id').val(),$('#daterange').val(),$('#status').val());
})

$('select#records').on('change', function() {
     ajax(1,this.value);  
});
</script>
</body>
</html>
