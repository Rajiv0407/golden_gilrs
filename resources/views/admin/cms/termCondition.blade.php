<?php $session_data=session()->get('admin_session');?>
<?php $user_per_info=user_permission($session_data['userId']);
$EditTermConditions=checkEditRole($user_per_info,14);
 
?> 
<div class="carManagement__wrapper">
    <div class="breadcrumbWrapper">
        <nav aria-label="breadcrumb">
            <h3 class="fs-5 m-0 fw-500">Terms & Conditions</h3>
            <ol class="breadcrumb">

             
                  <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                <li class="breadcrumb-item">CMS</li>
                <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
            </ol>
        </nav>
    </div>
    <div>
        <form action="javascript:void(0);" method="post" id="termConditionForm" name="termConditionForm">
        <div class="form-group mb-3">
            <label for="cms_type">Description</label> 
			<input type="hidden" name="content_id" id="content_id" value="<?php echo isset($id)? $id:'' ; ?>">
            <textarea name="termCondition" id="termCondition"   class="ckeditor textarea_control w-100 "><?php echo isset($termCondition)?$termCondition:'' ; ?></textarea>
        </div>
		<?php if($EditTermConditions == 1){ ?>
        <div class="d-flex max-w-250">
            <a href="javascript:void(0);"  onclick="submitTermCondition()" class="search-btn"> Update </a> 
            <a href="javascript:void(0);" onclick="termConditionCancel()" class="search-btn clear-btn ml-5px"> Cancel </a>
        </div>
		<?php } ?>
        </form>
    </div>
</div>

   

<script type="text/javascript">

 

    function termConditionCancel(){
        $('#termCondition').val('') ;
    }

    function submitTermCondition(){
         ajaxCsrf();  
		  var term=CKEDITOR.instances['termCondition'].getData();
          var fromData=$("#termConditionForm").serialize() ;
		  var content_id=$("#content_id").val() ;
          $.ajax({
            type: "POST",
            url: baseUrl+'/saveTermCondition',
            data:{'term':term,'content_id':content_id} ,
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
 <script>
                        CKEDITOR.replace( 'termCondition' );
						
                </script>   
        