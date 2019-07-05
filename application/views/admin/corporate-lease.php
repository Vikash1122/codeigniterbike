<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swag Bike</title>
    <?php include 'css.php';?>
    <link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
    <link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
    <style>
    .box{
        display:none;
    }
    .select-wrapper {
        margin: auto;
        max-width: 600px;
        width: calc(100% - 40px);
      }

      .select-pure__select {
        align-items: center;
        background: #f9f9f8;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        color: #363b3e;
        cursor: pointer;
        display: flex;
        font-size: 16px;
        font-weight: 500;
        justify-content: left;
        min-height: 44px;
        padding: 5px 10px;
        position: relative;
        transition: 0.2s;
        width: 100%;
      }

      .select-pure__options {
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        color: #363b3e;
        display: none;
        left: 0;
        max-height: 221px;
        overflow-y: scroll;
        position: absolute;
        top: 50px;
        width: 100%;
        z-index: 5;
      }

      .select-pure__select--opened .select-pure__options {
        display: block;
      }

      .select-pure__option {
        background: #fff;
        border-bottom: 1px solid #e4e4e4;
        box-sizing: border-box;
        height: 44px;
        line-height: 25px;
        padding: 10px;
      }

      .select-pure__option--selected {
        color: #e4e4e4;
        cursor: initial;
        pointer-events: none;
      }

      .select-pure__option--hidden {
        display: none;
      }

      .select-pure__selected-label {
        background: #5e6264;
        border-radius: 4px;
        color: #fff;
        cursor: initial;
        display: inline-block;
        margin: 5px 10px 5px 0;
        padding: 3px 7px;
      }

      .select-pure__selected-label:last-of-type {
        margin-right: 0;
      }

      .select-pure__selected-label i {
        cursor: pointer;
        display: inline-block;
        margin-left: 7px;
      }

      .select-pure__selected-label i:hover {
        color: #e4e4e4;
      }

      .select-pure__autocomplete {
        background: #f9f9f8;
        border-bottom: 1px solid #e4e4e4;
        border-left: none;
        border-right: none;
        border-top: none;
        box-sizing: border-box;
        font-size: 16px;
        outline: none;
        padding: 10px;
        width: 100%;
      }
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include 'nev-1.php';?>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item d-none d-lg-block">
                    <h4 class="mb-0">Corporate Lease</h4>
                </li>
            </ul>
            <?php include 'nev-2.php';?>
            <div class="container-fluid page-body-wrapper">
            <div class="theme-setting-wrapper">
                        <div onclick="javascript:location.href='corporateClient'" id="settings-trigger"><i class="mdi mdi-plus"></i></div>
                    </div>
            <?php include 'menu.php';?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="row">
                        <div class="col-md-12 grid-margin grid-margin-md-0 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Corporate Client List 
                                        <div class="form-group float-right">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="" id="cname">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary" type="button" id="filterdata">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Location</th>
                                                    <th>No of Vehicle</th>
                                                    <th>Lease Start</th>
                                                    <th>Lease End</th>
                                                    <th>Duration</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="corporate_users">
                                           
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

    <script src="js/dropify.js"></script>
    <script type="text/javascript" src="js/daterangepicker.min.js"></script>
    <script src="js/bundle.min.js"></script>
       <script> 
           $(function() {
            $('.birthday').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                
                }, 
                function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    alert("You are " + years + " years old!");
                });
            });

                         ajax();             
              function ajax(page=1,perpage=10,cname=''){ 
               $('#corporate_users').html(''); 
                $.ajax({

                     headers: {
                    'access_token':sessionStorage.getItem('access_token'),         
                     },
                    data:{'user_id':user.user_id,'page':page,'perpage':perpage,'client_name':cname},
                    method:'get',
                    url:'/swagbike/api/corporate/get_corporate',
                    success:function(res){                 
                    
                    if($.trim(res.count)!=='0'){ 
                     $.each(res.data, function( key, value ) {
                        if(value.price!==''){
                       var btn1= "<button class='btn btn-primary mr-1 btn-sm' disabled='disabled'><i class='mdi mdi-plus'></i></button>"; 
                       }
                       else{
                        btn1= "<a href='availableVehicle?ccid="+value.id+"' class='btn btn-primary mr-1 btn-sm' ><i class='mdi mdi-plus'></i></a>"; 
                       }
                       
                        //var l_start=moment(value.lease_start).format("YYYY-MM-DD");;
                        var t_date=moment().format("YYYY-MM-DD");
                      if(value.lease_start!==''){

                        if(t_date>value.lease_start){
                             console.log(value.lease_start);
                           var btn2="<button  class='btn btn-primary mr-1 btn-sm' disabled='disabled'><i class='mdi mdi-box-cutter' ></i></button>";
                          }
                          else{
                            var btn2="<a href='availableVehicle?ccid="+value.id+"&mode=edit' class='btn btn-primary mr-1 btn-sm' ><i class='mdi mdi-box-cutter'></i></a>";
                          }
                        }
                        else{
                            var btn2="<button class='btn btn-primary mr-1 btn-sm' disabled='disabled'><i class='mdi mdi-box-cutter' ></i></button>";
                         }
                      var btn3="<a href='corporateLeaseDetail?ccid="+value.id+"' class='btn btn-primary mr-1 btn-sm'><i class='mdi mdi-eye' ></i></a>";
                       
                        $('#corporate_users').append(' <tr> <td>'+value.client_name+'</td><td><p class="mb-2">'+value.location+'</p></td><td>'+value.tbikes+'</td><td>'+value.lease_start+'</td><td>'+value.lease_end+'</td><td>'+value.duration+'</td><td>'+value.price+'</td><td>'+btn1+' '+btn2+' '+btn3+' </td></tr>');
                          });
                      pagination('.pt-3',res,page,'ajax',perpage,perpage);
                        }
                      }
                    })

               }
$('#filterdata').on('click',function()
{
    ajax(1,10,$('#cname').val());
})
       </script>
</body>

</html>