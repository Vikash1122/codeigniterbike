if(!sessionStorage.getItem('user')&&!sessionStorage.getItem('access_token')){
	
 var path=window.location.origin+window.location.pathname;
                path=path.split('/admin');
               var base_path=path[0];
	window.location.href = base_path+"/login/";
}
sessionStorage.getItem('access_token')
 var user= JSON.parse(sessionStorage.getItem('user'));
 $(".user-auth-img").attr("src",user.image_url);
 $(".nav-profile-name").text(user.user_firstname);
 var base_path;
$('#logout').on('click',function(){
                 sessionStorage.clear();
               var path=window.location.origin+window.location.pathname;
                path=path.split('/admin');
                base_path=path[0];
                window.location.href = base_path+"/login/";
                });
 var url_active = location.href.split("/").pop(); 
              $("a[href='"+url_active+"']").addClass('active-page');
 
function pagination(div,res,page,ajax='ajax',coundiff=4,category='')

{
    
   	$(div).html('<ul class="pagination pagination-rounded float-right"><li class=" disabled first page-item"> <a href="#" id="first" class="page-link">First</a> </li><li class="disabled prev page-item"> <a href="#" id="prev" class="page-link"><i class="mdi mdi-chevron-left"></i></a> </li></ul>')
                        var count=Math.ceil(res.count/coundiff);
                        var li='';
                       var i;
                        for(i=0; i<count;i++)
                        {
                            if(i===3)
                            {
                                break;
                            }
                         
                         $(div+" .pagination").append('<li id="li'+(page+i)+'" class="page-item"> <a onclick="'+ajax+'('+(page+i)+','+category+')"  id="page'+(i+page)+'" href="#" class="page-link">'+(i+page)+'</a> </li>');
                        }
                         
                         $(div+" .pagination").append('<li class="disabled next page-item"> <a  id="next" href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a> </li><li class="page-item disabled last "> <a id="last" href="#" class="page-link">Last</a> </li>');
                        console.log(count/2);
                         if(page<=count)                       
                         {
                            
                            $(div+' #li'+(count)).nextAll('li').not('li:last').remove();
                           
                        }
                         if (!$(div+' #next').length) {
                            $(div+' .last').before('<li class="disabled next page-item"> <a  id="next" href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a> </li>');
                                     }
                        $(div+' #li'+(page)).addClass('active');
                         if(page>1){
                            $(div+' .prev').removeClass('disabled');
                            $(div+' .first').removeClass('disabled');
                            $(div+' #first').attr("onclick",ajax+'('+1+','+category+')');
                            $(div+' #prev').attr("onclick",ajax+'('+(page-1)+','+category+')');
                          
                        }
                        if(page<count){
                            $(div+' .next').removeClass('disabled');
                            $(div+' .last').removeClass('disabled');
                            $(div+' #last').attr("onclick",ajax+'('+count+','+category+')');
                            $(div+' #next').attr("onclick",ajax+'('+(page+1)+','+category+')');
                            
                        }

}