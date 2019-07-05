<?php if(isset($_GET['notification'])){if($_GET['notification']==='true'){
$this->db->set('seen','true')->where('user_role','customer')->where('created_at>=CURDATE()')->update('users');
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link href="css/new-stule.css">
        <style>
           .hidden {
                 display: none;
            }
        </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Customer List </h4>
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
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="js-example-basic-single w-100" id="status">
                                                                <option value="" >Select</option>
                                                                    <option value="lease" >Lease</option>
                                                                    <option value="instant">Instant</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>DL No.</label>
                                                                <input type="text" class="form-control form-control-md" placeholder="" id="dl_no" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>By Name</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="" id="uname">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-sm btn-primary" type="button" id="filterdata">Search</button>
                                                                    </div>
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
                                                <h4 class="card-title">All Customer 
                                                    <select style="max-width:120px;" class="form-control float-right" id="records">
                                                        <option value="10">10 Records</option>
                                                        <option value="20">20 Records</option>
                                                        <option value="30">30 Records</option>
                                                        <option value="40">40 Records</option>
                                                    </select>
                                                </h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="order-listing">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Dl No</th>
                                                                <th>Gender</th>
                                                                <th>Total Trip</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="customer_list">
                                                        
                                                            
                                                        </tbody>
                                                    </table>
                                                    <nav class="pt-3">
                                                        <!-- <ul class="pagination pagination-rounded float-right">
                                                            <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
                                                        </ul> -->
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php include 'footer.php';?>
                            <div class="swal-overlay swal-overlay--show-modal" tabindex="-1" style="display: none;">
                                <div class="swal-modal" role="dialog" aria-modal="true" ><div class="swal-icon swal-icon--success">
                                <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                                <span class="swal-icon--success__line swal-icon--success__line--tip"></span>

                                <div class="swal-icon--success__ring"></div>
                                <div class="swal-icon--success__hide-corners"></div>
                                </div><div class="swal-title" style="">Congratulations!</div><div class="swal-text" style="">You entered the correct answer</div><div class="swal-footer"><div class="swal-button-container">

                                <button class="swal-button swal-button--confirm btn btn-primary" id="continue">Continue</button>

                                <div class="swal-button__loader">
                                  <div></div>
                                  <div></div>
                                  <div></div>
                                </div>

                          </div></div></div>
                       </div>
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
                    maxYear: parseInt(moment().format('YYYY'), 10)
                }, function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    alert("You are " + years + " years old!");
                });
            });
            $('#example-css1').barrating({
                theme: 'css-stars',
                showSelectedRating: false
            });

            ajax();             
              function ajax(page=1,perpage=10,status='',name='',dl=''){                
              $('#customer_list').html('');             
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'name':name,'status':status,'dl_no':dl},
                    method:'get',
                    url:'/swagbike/api/cud/get_users',
                    success:function(res){                 

                    if($.trim(res.count)!=='0'){  
                   
                   
                     var org_name='';
                      var i = 1;
                     $.each(res.data, function( key, value ) {
                       if(value.user_name===''||value.user_name===' '||value.user_name===null)
                       {
                         var user_name='N/a';
                       }
                       else{
                        user_name=value.user_name;
                       }
                       if(value.user_mobile===''||value.user_mobile===null)
                       {
                         var user_mobile='N/a';
                       }
                       
                       else{
                        user_mobile=value.user_mobile;
                       }
                       if(value.dl_no===''||value.dl_no===null)
                       {
                         var dl_no='N/a';
                       }
                       else{
                        dl_no=value.dl_no;
                       }
                        if(value.user_email===''||value.user_email===null)
                       {
                         var user_email='N/a';
                       }
                       else{
                        user_email=value.user_email;
                       }
                        if(value.gender===''||value.gender===null)
                       {
                         var gender='N/a';
                       }
                       else{
                        gender=value.gender;
                       }
                       if(value.user_image==''||value.user_image==null)
                        {
                            var src='N/a';
                        }
                       else{                           
                             src=value.image_url;
                             src1=value.image_url;
                             
                        }
                        if(value.user_status==='0')
                        {
                          var deletemodal='<a href="#myModal'+value.user_id+'" class="btn btn-success btn-sm" data-toggle="modal" title="click to deactive">Active</a>';
                        }
                        else{
                            deletemodal ='<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="deleteData('+value.user_id+','+0+')" title="click to active">Deactive</button>';
                        }
                        $('#customer_list').append('<tr> <td class="py-1"> <img src="'+src+'" alt="image"/> </td><td class="border-top-0"> <p class="font-weight-medium text-dark mb-0">'+user_name+'</p></td><td>'+dl_no+'</td><td>'+gender+'</td><td>'+value.total_trip+'</td><td>'+user_email+'</td><td>'+user_mobile+'</td><td> <div class="template-demo"> <a href="userDetail?id='+value.user_id+'" class="btn btn-primary btn-sm">View</a> '+deletemodal+'  </div></td></tr>');
                        $('#customer_list').after('<div id="myModal'+value.user_id+'" class="modal fade"><div class="modal-dialog modal-confirm"><div class="modal-content"><div class="modal-header"><div class="icon-box"><i class="material-icons">&#xE5CD;</i></div><h4 class="modal-title">Are you sure?</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"><p>Do you really want to deactive this user?</p></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteData('+value.user_id+','+1+')">Confirm</button></div></div></div></div>')
                          });
                   //  $('#org_name').text(res.org_name); 
                       $('.pt-3').removeClass('hidden');
                       pagination('.pt-3',res,page,'ajax',perpage,perpage);
                         
                     }  
                     else{
                        $('.pt-3').addClass('hidden');
                       $('#customer_list').append('<tr><td colspan="8">No Data Found!!!</td></tr>'); 
                     }              
                  }

                })
 
                           

                       
               }

$('select#records').on('change', function() {
     ajax(1,this.value);  
});
$('#filterdata').on('click',function()
{
    ajax(1,10,$('#status').val(),$('#uname').val(),$('#dl_no').val());
})
function deleteData(id,status){        
        // alert('#'+id+' input[name="userfile"]');        
        var data = new FormData(); 
        
       // alert(table);
        data.append("table", 'users'); 
        data.append("id", id);
        data.append("status", status);
        data.append("user_id",user.user_id); 
                             
        $.ajax({
        headers: {
        'access_token':sessionStorage.getItem('access_token'),  
        },

        data:data,
        method:'post',         
        contentType: false,
        processData: false, 
        url:'/swagbike/api/cud/delete_data',
        success:function(res){
         console.log(res);
        if($.trim(res.status)=='true'){                                
          //alert(res.message);
          $('.swal-overlay--show-modal').modal('toggle');
          if(status===1){
          $('.swal-text').html('User has deactivated successfully!!!');
             }
             else{
            $('.swal-text').html('User has activated successfully!!!');    
             }
         // window.location.reload(true);
          }
        }
       })
    };

$('#continue').on('click',function()
{
    $('.swal-overlay--show-modal').modal('toggle');
              
              ajax(); 
})

        </script>
</body>

</html>