<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Swag Bike</title>
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
                                    <!-- <div class="col-md-4"> 
                                        <label>By Date</label> 
                                        <input type="text" class="form-control" name="daterange" placeholder=""> 
                                        <input type="text" name="birthday" value="10/24/1984" />
                                    </div> -->
                                    <div class="col-md-4">  
                                    <label>By Date</label>     
                                        <div class="input-group">
                                        <input type="text" class="form-control" name="daterange" placeholder="" id="daterange">
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
                            <h4 class="card-title">Complete Orders                                    
                              <!--   <select style="max-width:120px;" class="form-control float-right  ml-2">
                                    <option>10 Records</option>
                                    <option>20 Records</option>
                                    <option>30 Records</option>
                                    <option>40 Records</option>
                                </select> -->
                                                
                                <button type="button" class="btn btn-primary btn-sm float-right ml-2" id="leasedata">Lease</button>    
                                <button type="button" class="btn btn-primary btn-sm float-right ml-2" id="instantdata">Instant </button>                           
                                                                
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Bike Name</th>
                                            <th>User Name</th>
                                            <th>Start Date Time</th>
                                            <th>End Date Time</th>
                                            <th>Duration</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order_list">
                                        
                                        
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
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
            }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
    
        $(function() {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            alert("You are " + years + " years old!");
        });
        });

        ajax();             
              function ajax(page=1,perpage=10,rent_type='',order_id='',daterange=''){                
              $('#order_list').html('');             
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'status':'complete','rent_type':rent_type,'order_id':order_id,'daterange':daterange},
                    method:'get',
                    url:'/swagbike/api/cud/get_orders',
                    success:function(res){                 

                    if(($.trim(res.data.length))!==0){ 
                     $.each(res.data, function( key, value ) {
                        $('#order_list').append('<tr> <td>ord_00'+value.order_id+' </td><td> <p class="mb-2">'+value.bike_name+'</p><p class="mb-0 text-muted text-small">'+value.engine+'</p>  </td><td>'+value.user_name+'</td><td>'+value.start_date+'</td><td >'+value.end_date+'</td><td>'+value.duration+'</td><td>'+value.rent_type+'</td><td>'+value.price+'</td><td> <div class="template-demo"> <a class="btn btn-primary btn-sm" href="completeOrderDetails?order_id='+value.order_id+'">View</a>  </div></td></tr>');
                          });
                  
                       pagination('.pt-3',res,page,'ajax',perpage,perpage);
                     }                
                  }

                })
 
                           

                       
               }

$("#leasedata").on('click',function()
{
  $("#instantdata").removeClass('active');
  $(this).addClass('active');
   ajax(1,10,'lease');
})

$("#instantdata").on('click',function()
{
  $("#leasedata").removeClass('active');
  $(this).addClass('active');
  ajax(1,10,'instant');
})
$('#filterdata').on('click',function()
{
  ajax(1,10,'',$('#order_id').val(),$('#daterange').val());
})
</script>
</body>
</html>
