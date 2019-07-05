<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Swagbike Admin</title>
  <!-- plugins:css -->
  <?php include 'css.php';?>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div style="background:linear-gradient(#5515ef52, #ef154f52), url(../admin/images/lg-bg.jpg); background-size: cover;" class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img class="ml-auto mr-auto" width="100" src="../admin/images/logo.png" alt="logo">
              </div>
              <form class="pt-3" method="post" action="#">
                <div class="form-group">
                <span style="color:red;padding-left:70px;" id="error_msg"></span>
                  <input type="email" class="form-control form-control-lg" placeholder="Username" name="email" id="email" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required="required" id="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
  <script src="../admin/js/vendor.bundle.base.js"></script>
  <script src="../admin/js/vendor.bundle.addons.js"></script>
  
  <script src="../admin/js/off-canvas.js"></script>
  <script src="../admin/js/hoverable-collapse.js"></script>
  <script src="../admin/js/template.js"></script>
  <script src="../admin/js/settings.js"></script>
  <script src="../admin/js/todolist.js"></script>
  
  <script src="../admin/js/dashboard.js"></script>
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
        url:'/swagbike/api/login/login',
        success:function(res){
            if($.trim(res.status)=='true'){
            sessionStorage.setItem("user",JSON.stringify(res.user));
            sessionStorage.setItem("access_token",res.access_token);
            var path=window.location.origin+window.location.pathname;
                path=path.split('/login');
               var base_path=path[0];
               sessionStorage.setItem("base_path",JSON.stringify(base_path));
              window.location.href = base_path+"/admin/";
            }
           if($.trim(res.status)=='false'){
              $('#error_msg').text('Invalid username or password!!!');
            }
        },


    })
     
})
  </script>
</body>
</html>
