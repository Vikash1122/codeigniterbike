<?php $banner_run=$this->db->select("name, concat('".base_url()."uploads/banners/',name) as image_url")->where('status','2')->get('banners')->result_array();
   $banner_all=$this->db->select("id,name, concat('".base_url()."uploads/banners/',name) as image_url,(CASE WHEN status=2 THEN 'true' ELSE 'false' END) as selected")->get('banners')->result_array();
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Swag Bike</title>
      <?php include 'css.php';?>
      <link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
   <body>
      <div class="container-scroller">
         <?php include 'nev-1.php';?>
         <ul class="navbar-nav mr-lg-2">
            <li class="nav-item d-none d-lg-block">
               <h4 class="mb-0">Banner List </h4>
            </li>
         </ul>
         <?php include 'nev-2.php';?>
         <div class="container-fluid page-body-wrapper">
            <div class="theme-setting-wrapper">
               <div onclick="javascript:location.href='addBanner'" id="settings-trigger"><i class="mdi mdi-plus"></i></div>
            </div>
            <?php include 'menu.php';?>
            <div class="main-panel">
               <div class="content-wrapper">
                  <div class="row mb-4">
                     <div class="col-lg-12 col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <h4 class="card-title">Banner Image 
                              <a href="#myModal" class="btn btn-primary btn-sm float-right ml-2" data-toggle="modal">Delete</a>
                                 <button type="button" class="btn btn-primary btn-sm float-right ml-2" id="runBtn">Run</button> 
                              </h4>
                              <div id="lightgallery" class="row lightGallery">
                                 <?php foreach ($banner_run as $key => $value) {?>
                                 <a href="<?=$value['image_url']?>" class="image-tile"><img src="<?=$value['image_url']?>" style="height: 165px;"></a>
                                 <?php }?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <?php foreach ($banner_all as $key => $value) {
                        ?>
                     <div class="col-lg-3 col-md-3">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group">
                                 <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input optionsRadios" name="optionsRadios" id="optionsRadios1" value="<?=$value['id']?>" <?php echo ($value['selected']=='true' ? 'checked' : '');?>>
                                    <?=$value['name']?>
                                    </label>
                                 </div>
                              </div>
                              <img class="w-100" style="height: 150px;" src="<?=$value['image_url']?>" alt="image"/>
                           </div>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <div id="myModal" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to delete these selected banners? This process cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteBtn">Delete</button></div></div></div></div>
               <div class="swal-overlay swal-overlay--show-modal" tabindex="-1" style="display: none;">
                  <div class="swal-modal" role="dialog" aria-modal="true" >
                     <div class="swal-icon swal-icon--success">
                        <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                        <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
                        <div class="swal-icon--success__ring"></div>
                        <div class="swal-icon--success__hide-corners"></div>
                     </div>
                     <div class="swal-title" style="">Congratulations!</div>
                     <div class="swal-text" style="">You entered the correct answer</div>
                     <div class="swal-footer">
                        <div class="swal-button-container">
                           <button class="swal-button swal-button--confirm btn btn-primary" id="continue">Continue</button>
                           <div class="swal-button__loader">
                              <div></div>
                              <div></div>
                              <div></div>
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
      <script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
      <script src="js/light-gallery.js"></script>
      <script type="text/javascript">
        $("#runBtn").on('click', function () {
            var banner_id = $('input:checkbox:checked.optionsRadios').map(function () {
                return this.value;
            }).get().join(",");
            var form_data = new FormData();
            form_data.append('user_id', user.user_id);
            form_data.append('banner_id', banner_id);
            console.log(user.user_id);
            $.ajax({
                headers: {
                    'access_token': sessionStorage.getItem('access_token'),
                },
                data: form_data,
                method: 'post',
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                url: '/swagbike/api/cud/running_banner',
                success: function (res) {
                    console.log(res);
                    if ($.trim(res.status) == 'true') {
                        $('.swal-overlay--show-modal').modal('toggle');
                        $('.swal-text').html(res.message);
                    }
                }
            })
        });
        $('#continue').on('click', function () {
            $('.swal-overlay--show-modal').modal('toggle');
            window.location.reload(true);
        })
        $('#deleteBtn').on('click',function(){        
            var banner_id = $('input:checkbox:checked.optionsRadios').map(function () {
                return this.value;
            }).get().join(",");
            var form_data = new FormData();
            form_data.append('user_id', user.user_id);
            form_data.append('id',banner_id);
            form_data.append('table','banners');
                             
        $.ajax({
        headers: {
        'access_token':sessionStorage.getItem('access_token'),  
        },

        data:form_data,
        method:'post',         
        contentType: false,
        processData: false, 
        url:'/swagbike/api/cud/delete_data',
        success:function(res){
         console.log(res);
        if($.trim(res.status)=='true'){                                
          //alert(res.message);
          $('.swal-overlay--show-modal').modal('toggle');
          $('.swal-text').html(res.message);
         // window.location.reload(true);
          }
        }
       })
    });

      </script>
   </body>
</html>