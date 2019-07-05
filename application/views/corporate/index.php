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
              <form class="pt-3" method="post" action="#">
                <div class="form-group">
                <span style="color:red;padding-left:70px;" id="error_msg"></span>
                  <input type="email" class="form-control form-control-lg" placeholder="Username" name="email" id="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button> 
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="forgotPassword" class="auth-link text-black">Forgot password?</a> -->
                  <a  href="#myModal" data-toggle="modal">Forgot password?</button>
                </div>
               

  <!-- Modal -->
 
  
</div>

                <div class="text-center mt-4 font-weight-light">
                © 2019. All Rights Reserved   <a href="www.swagbike..in" class="text-primary">Swag Bike</a>
                </div>
              </form>
               <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title" style="color:black">Forgot Password?</h4>
        </div>
        <div class="modal-body">
         <div class="form-group"><label>Enter your registered email</label></div>
          <div class="form-group">
                
                  <input type="email" class="form-control form-control-lg" placeholder="Enter your registered email id" name="email" id="remail">
                </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="sendPassword">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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
       
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
   $('.pt-3').on('submit',function(){
    event.preventDefault();
    var formdata=new FormData();
    var email=$('#email').val();
    var password=$('#password').val();
    var formdata = {
        'email': email,
        'password': password
};

    $.ajax({
       headers: {
                    'access_token':'8f3a07f4b8575c447078a203ff97d21806384458f8cfb3e4def94773dfc6077f62588383408be7c2',         
                     },
        data:formdata,
        method:'post',
        url:'/swagbike/api/login/corporate_login',
        success:function(res){
            if($.trim(res.status)=='true'){
            sessionStorage.setItem("user",JSON.stringify(res.user));
            sessionStorage.setItem("access_token",res.access_token);
            var path=window.location.origin+window.location.pathname;
                path=path.split('/login');
               var base_path=path[0];
               sessionStorage.setItem("base_path",JSON.stringify(base_path));
              window.location.href = base_path+"/";
            }
           if($.trim(res.status)=='false'){
              $('#error_msg').text('Invalid username or password!!!');
            }
        },


    })
     
})

   $('#sendPassword').on('click',function()
   {
    $.ajax({
       headers: {
                    'access_token':'8f3a07f4b8575c447078a203ff97d21806384458f8cfb3e4def94773dfc6077f62588383408be7c2',         
                     },
        data:{'email':$('#remail').val()},
        method:'post',
        url:'/swagbike/api/login/change_password',
        success:function(res){
            if($.trim(res.status)=='true'){
              $('.modal-title1').text('Info');
              $('.modal-body1').html('<div class="form-group"><p>'+res.message+'</p></div>');
            $('#myModal1').modal('toggle');
            }

            if($.trim(res.status)=='false'){              
              $('.modal-title1').text('Info');
              $('.modal-body1').html('<div class="form-group"><p>'+res.message+'</p></div>');
            $('#myModal1').modal('toggle');
            }
          
        },


    })
     
   }
)
</script>
</body>
</html>
