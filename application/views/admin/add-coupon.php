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
               <h4 class="mb-0">Add Coupon</h4>
            </li>
         </ul>
         <?php include 'nev-2.php';?>
         <div class="container-fluid page-body-wrapper">
            <?php include 'menu.php';?>
            <div class="main-panel">
               <div class="content-wrapper">
                  <form class="forms-sample" action="#" method="post" id="addCoupon">
                     <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                              <div class="card-body">
                                 <div id="mainDiv"></div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <h4 class="card-title">Basic Information</h4>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Coupon Code</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="code">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Coupon Value(%)</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="coupon_value">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Total Coupons</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="total_coupon">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Total use of each customer</label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="per_use">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Coupon Details </label>
                                          <input type="text" class="form-control form-control-md" placeholder="" name="detail">
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
                                       <h4 class="card-title">Coupon's Validity</h4>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Validity</label>
                                          <input type="text" class="form-control form-control-md" name="validity" value="" id="date" /> 
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
                                       <h4 class="card-title">Coupon's Criteria</h4>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label>Criteria</label>
                                          <select class="form-control form-control-lg" name="criteria">
                                             <option>Instant</option>
                                             <option>Lease</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-center ">
                           <button type="button" class="btn btn-dark btn-sm">Cancel</button>
                           <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                     </div>
                  </form>
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
             $("#date").daterangepicker({
                 minDate: moment(),
                 locale: {
                     format: 'MM/DD/Y'
                 }
             });
         });
         $('form#addCoupon').submit(function() {
             event.preventDefault();
             var formdata = new FormData($(this)[0]);
             formdata.append("user_id", user.user_id);
             $.ajax({
                 headers: {
                     'access_token': sessionStorage.getItem('access_token'),
                 },
                 data: formdata,
                 method: 'post',
                 contentType: false,
                 processData: false,
                 url: '/swagbike/api/cud/add_coupon',
                 success: function(res) {
                     console.log(res);
                     if ($.trim(res.status) == 'true') {
                         alert(res.message);
                         window.location.href = '/swagbike/admin/couponList';
         
                     } else {
                         $('#mainDiv').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> ' + res.message + '</div>');
                         $("html, body").animate({
                             scrollTop: 0
                         }, "slow");
                     }
                 }
             })
         });        
                 
      </script>
   </body>
</html>