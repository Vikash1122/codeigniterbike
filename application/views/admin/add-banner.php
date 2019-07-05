<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link href="css/new-style.css">
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <style>
        .hi-50{
            height: 45px;
            margin-top: 23px;
        }
        .dl-ig{
            position: absolute;
            font-size: 30px;
            color: #ef1751;
            right: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Add Banners</h4>
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
                                            <div id="mainDiv"></div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Basic Information</h4>
                                                    </div>
                                                       <div class="col-lg-12 grid-margin">
                                                        <label>Banner Image</label>
                                                       <!--  <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple="" >
                                                        <div class="row" id="image_preview"></div> -->
                                                        <!-- <div action="http://www.urbanui.com/file-upload" class="dropzone d-flex align-items-center w-100" id="my-awesome-dropzone"></div> -->
                                                         <form id="upload-widget" method="post" action="/swagbike/api/cud/addBanner" class="dropzone d-flex">
  <div class="fallback">
    <input name="file[]" type="file" />
  </div>
</form>                                      
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <button type="button" class="btn btn-dark btn-sm">Cancel</button>
                                                        <button type="button" class="btn btn-primary btn-sm" id="btnUpload" name="submit">Save</button>
                                                    </div>
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
        <script>
Dropzone.options.uploadWidget = {
  paramName: 'file',
  parallelUploads: 20,
  autoProcessQueue: false,
  addRemoveLinks: true,
  dictDefaultMessage: 'Drag an image here to upload, or click to select one',
  headers: {
'access_token':sessionStorage.getItem('access_token'),  
},
  acceptedFiles: 'image/*',
  init: function() {
    $('#mainDiv').html('');
     var submitButton = document.querySelector("#btnUpload")
    myDropzone = this;
    console.log(myDropzone.getUploadingFiles());
    submitButton.addEventListener("click", function() {
      
      /* Check if file is selected for upload */
      if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {      
        alert('No file selected for upload');  
        return false;
      }
      else {
        
        /* Remove event listener and start processing */ 
        myDropzone.removeEventListeners();
        myDropzone.processQueue(); 
        
      }
    });
    
    this.on("sending", function(file, xhr, formData) {       
      formData.append("user_id",user.user_id);
    });
   
     this.on("success", function(file, responseText) {     
       myDropzone.removeFile(file);
       // $('#mainDiv').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong>File Uploaded Successfully</div>');
       //alert('File Uploaded Successfully');
       window.location.href='/swagbike/admin/bannerList';

    });  
 
}}
        </script>
</body>

</html>