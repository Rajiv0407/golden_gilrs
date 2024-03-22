<?php $session_data=session()->get('admin_session');?>
<?php $user_per_info=user_permission($session_data['userId']);
$EditPrivacy=checkEditRole($user_per_info,13);
 
?>    
	 <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Privacy & Policy</h3>
                        <ol class="breadcrumb">
                          
                             <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item">CMS</li>
                            <li class="breadcrumb-item active" aria-current="page">Privacy & Policy</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <form action="javascript:void(0);" method="post" id="privacyPolicyForm" name="privacyPolicyForm">
                    <div class="form-group mb-3">
                        <label for="cms_type">Description</label>
						<input type="hidden" name="privacy_id" id="privacy_id" value="<?php echo isset($id)? $id:'' ; ?>">
                        <textarea name="privacyPolicy" id="privacyPolicy" cols="30" rows="4" class="ckeditor textarea_control w-100 "><?php echo isset($privacyPolicy)?$privacyPolicy:'' ; ?></textarea>
                    </div>
					<?php if($EditPrivacy == 1){  ?>
                    <div class="d-flex max-w-250">
                        <a href="javascript:void(0);" onclick="submitPrivacyPolicy()" class="search-btn"> Update</a> 
                        <a href="javascript:void(0);" onclick="privacyPolicyCancel()" class="search-btn clear-btn ml-5px"> Cancel </a>
                    </div>
					<?php } ?>
                </form>
                </div>
            </div>

   <script>
    CKEDITOR.replace( 'privacyPolicy' );
   </script>   

<script type="text/javascript">

    function privacyPolicyCancel(){
        $('#privacyPolicy').val('') ;
    }

    function submitPrivacyPolicy(){

         ajaxCsrf();  
     
         var fromData=$("#privacyPolicyForm").serialize() ;
		 var term=CKEDITOR.instances['privacyPolicy'].getData();
		  var privacy_id=$("#privacy_id").val() ;

          $.ajax({
            type: "POST",
            url: baseUrl+'/savePrivacyPolicy',
            data:{'privacy_policy':term,'privacy_id':privacy_id} ,
            cache: 'FALSE',
            dataType:'json',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
             if(html.status==1){
                   statusMesage('Updated successfully','success');
               }else{
                    statusMesage('something went wrong','error') ;
               }
                
            
                    }
                });
    }


</script>
        