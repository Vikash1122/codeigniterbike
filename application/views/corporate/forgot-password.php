<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Swagbike Corporate Admin</title>
  <!-- plugins:css -->
  <?php include 'css.php';?>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div style="background:linear-gradient(#5515ef52, #ef154f52), url(images/lg-bg.jpg); background-size: cover;" class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img class="ml-auto mr-auto" width="100" src="images/logo.png" alt="logo">
              </div>
              <form class="pt-3">
                <div class="form-group">
                 <span style="color:red;padding-left:70px;" id="error_msg"></span>
                  <input type="text" class="form-control form-control-lg" placeholder="New Password" id="newpaas"> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="Confirm Password" id="cnfpass">
                </div>
                <div class="mt-3">
                  <button type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="sendPassword">Change Password</button>
                </div>
             
                
              </form>
            </div>
            <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title1" style="color:black"></h4>
        </div>
        <div class="modal-body1">
        
          
        </div>
        <div class="modal-footer">
       
          <button type="button" class="btn btn-primary" onclick="location.href='login'">Click</button>
        </div>
      </div>
      
    </div>
  </div>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
   <script src="js/vendor.bundle.base.js"></script>
  <script src="js/vendor.bundle.addons.js"></script>
  
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  
  <script src="js/dashboard.js"></script>
  <!-- endinject -->
  <script type="text/javascript">
    $('#sendPassword').on('click',function()
   {
    $.ajax({
       headers: {
                    'access_token':'8f3a07f4b8575c447078a203ff97d21806384458f8cfb3e4def94773dfc6077f62588383408be7c2',         
                     },
        data:{'token':'<?=$_GET["token"]?>','user_id':'<?=$_GET["user_id"]?>','newpassword':$('#newpaas').val(),'cnfpass':$('#cnfpass').val()},
        method:'post',
        url:'/swagbike/api/login/update_password',
        success:function(res){
            if($.trim(res.status)=='true'){
              $('.modal-title1').text('Info');
              $('.modal-body1').html('<div class="form-group"><p>'+res.message+'</p></div>');
            $('#myModal1').modal('toggle');
            }

            if($.trim(res.status)=='false'){ 
             $('#error_msg').text(res.message);             
              
            }
          
        },


    })
     
   }
)
  </script>
</body>
</html>
