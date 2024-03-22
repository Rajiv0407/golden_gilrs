<div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">User Details</h3>
                        <ol class="breadcrumb">
                         
						 <li class="breadcrumb-item">
						 <a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
						 
						 <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#admin_users" onclick="adminUserManagement()" >Admin users Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Details</li>

                        </ol>
                    </nav>

                   
                  
</div>
<div class="ibox-content m-b-sm border-bottom" style="padding-bottom: 20px;">
  <div class="row">
    <div class="col-md-2 pr0 pl0">
      <div class="form-group">
        <div class="form-control"><?php echo $userInfo->first_name.' '.$userInfo->last_name ?></div>
        <span ng-bind="TitleName"></span>
      </div>
    </div>
    <div class="col-md-2 pr0">
      <div class="form-group">
        <div class="form-control" style="overflow: hidden;"><?php echo $userInfo->email; ?></div>
      </div>
    </div>
    <div class="col-md-2 pr0">
      <div class="form-group">
        <div class="form-control"><?php echo $userInfo->phone; ?></div>
      </div>
    </div>
    <div class="col-md-2 pr0">
      <div class="form-group">
        <div class="form-control">Active</div>
      </div>
    </div>
	
	
	 <?php if($userInfo->user_type == 3){ ?>
	   
	   <div class="col-md-2 pr0">
      <div class="form-group">
	   
        <div class="form-control">Admin</div>
		</div>
		</div>
	    	
		
	   <?php } ?>
    
	   <?php if($userInfo->user_type == 1){ ?>
	   <div class="col-md-2 pr0">
      <div class="form-group">
	   
        <div class="form-control">Brand</div>
		</div>
		</div>
		
	   <?php } ?>
	   <?php if($userInfo->user_type == 2){ ?>
	   
	   <div class="col-md-2 pr0">
      <div class="form-group">
	   
        <div class="form-control">Hospitality</div>
		</div>
		</div>
	    	
		
	   <?php } ?>
			
	</div>
</div>



<div class="row form">
  <div class="page-title-header">
    <h3 class="page-title fs-5 m-0 fw-500 mb-3"> Set Permission </h3>
  </div>
  <div class="col-md-2">
   
      <div class="form-group mb-3">
        <label class="form-control-label">Role</label>
        <div class="col p-0">
          <?php if($userInfo->user_type == 1){ ?>
        <div class="form-control">Brand</div>
	   <?php } ?>
	   <?php if($userInfo->user_type == 2){ ?>
        <div class="form-control">Hospitality</div>
	   <?php } ?>
        </div>
      </div>
   </div>

  <div class="col-md-10">
    <div class="d-flex btn_grp">
    
        <button type="button" onclick="saveUserRolePermissions()" class="search-btn" >
         Save Privileges
        </button>
        <button  type="button" onclick="saveUserAllRolePermissions()" class="search-btn">
         Grant All
        </button>
        <button  type="button" onclick="deleteUserAllRolePermissions()"  class="search-btn clear-btn ml-5px">
          Revoke All
        </button>
      </div>
   </div>
   
</div>

<div class="row">
  <div class="col-md-12">
  <div class="mscroll_box2">
                    <div class="table_min user_details">
					<form id="user_permission_role" method="post">
                        <div class="table-layout">
                            <div class="table-cell1 head" class="all" style="width: 255px;">
                                <label>Pages</label>
                            </div>
                            <div class="table-cell1 head ">
                                <input type="checkbox" class="all" id='addCheckAll'>
                                <label>Add</label>
                            </div>
                            <div class="table-cell1 head">
                                <input type="checkbox" class="all" id='deleteCheckAll'>
                                <label>Delete</label>
                            </div>
                            <div class="table-cell1 head">
                                <input type="checkbox" class="all" id='editCheckAll'>
                                <label>Edit</label>
                            </div>
                            <div class="table-cell1 head">
                                <input type="checkbox" class="all" id='viewCheckAll'>
                                <label>View</label>
                            </div>
							<div class="table-cell1 head">
                                <input type="checkbox" class="all" id='statusCheckAll'>
                                <label>Status</label>
                            </div>
                            
                        </div>
                        <!--  -->
                        <div class="table-layout-body"
                            style="">
							<?php foreach($role_info as $role_infos){     ?>
							<div class="bcpssd" style="padding: 10px 0;">
                                <div style="width: 265px; float: left;" class="table-cell1">
                                    <img style="cursor: pointer; width: 12px; margin-top: -3px; margin-right: 3px;" src="<?php echo URL('/'); ?>/public/admin/images/plus.png" class="">
                                    <?php echo $role_infos['title']; ?><input type="hidden" name="roleId_<?php echo $role_infos['id'] ; ?>" value="<?php echo $role_infos['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="<?php echo $userInfo->user_type;?>">
                                     <input type="hidden" name="userId" value="<?php echo $userInfo->id;?>">
									</div>
                                <div class="head_body">
                                    <input <?php if($role_infos['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $role_infos['id'] ; ?>" onclick="add(<?php echo $role_infos['id']; ?>);"  class="chkPermissionAdd_2 all child_add1<?php echo $role_infos['id']; ?>">
                                </div>  
                                <div class="head_body">
                                    <input <?php if($role_infos['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $role_infos['id'] ; ?>" onclick="permission_delete(<?php echo $role_infos['id']; ?>);" class="chkPermissionDelete_2 all child_delete1<?php echo $role_infos['id']; ?>">
                                </div>
                                <div class="head_body">
                                    <input <?php if($role_infos['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $role_infos['id'] ; ?>" onclick="edit(<?php echo $role_infos['id']; ?>);"  class="chkPermissionEdit_2 all child_edit1<?php echo $role_infos['id']; ?>">
                                </div>
                                <div class="head_body">
                                    <input <?php if($role_infos['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $role_infos['id'] ; ?>" onclick="view(<?php echo $role_infos['id']; ?>);"  class="chkPermissionView_2 all child_view1<?php echo $role_infos['id']; ?>">
                                </div> 
								<div class="head_body">
                                    <input <?php if($role_infos['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $role_infos['id'] ; ?>" onclick="status(<?php echo $role_infos['id']; ?>);"  class="chkPermissionStatus_2 all child_status1<?php echo $role_infos['id']; ?>">
                                </div>
                            </div>
							<?php if(!empty($role_infos['sub_title'])){ ?>
							<?php foreach($role_infos['sub_title'] as $sub){ ?>
							<div class="bcpssd" style="padding: 10px 0;">
                                <div style="width: 265px; float: left;" class="table-cell1">
								   <input type="hidden" name="roleId_<?php echo $sub['id'] ; ?>" value="<?php echo $sub['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="<?php echo $userInfo->user_type;?>"> 
                                    <input type="hidden" name="userId" value="<?php echo $userInfo->id;?>">	  								
                                    <?php echo $sub['title']; ?>                               </div>
                                <div class="head_body">
                                    <input <?php if($sub['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $sub['id'] ; ?>" onclick="sub_add(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" value="1" class="chkPermissionAdd_2 all child_add21<?php echo $role_infos['id']; ?> sub_add<?php echo $sub['id']; ?>">
                                </div>  
                                <div class="head_body">
                                    <input <?php if($sub['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $sub['id'] ; ?>" onclick="sub_delete(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionDelete_2 all child_delete21<?php echo $role_infos['id']; ?> sub_delete<?php echo $sub['id']; ?>">
                                </div>
                                <div class="head_body">
                                    <input <?php if($sub['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $sub['id'] ; ?>" onclick="sub_edit(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" value="1" class="chkPermissionEdit_2 all child_edit21<?php echo $role_infos['id']; ?> sub_edit<?php echo $sub['id']; ?>">
                                </div>
                                <div class="head_body">
                                    <input <?php if($sub['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $sub['id'] ; ?>" onclick="sub_view(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);"  class="chkPermissionView_2 all child_view21<?php echo $role_infos['id']; ?> sub_view<?php echo $sub['id']; ?>">
                                </div> 
								 <div class="head_body">
                                    <input <?php if($sub['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $sub['id'] ; ?>" onclick="sub_status(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);"  class="chkPermissionStatus_2 all child_status21<?php echo $role_infos['id']; ?> sub_status<?php echo $sub['id']; ?>">
                                </div>
                            </div>
							<?php } ?>
							<?php } ?>
							<?php } ?>
						</div>
						</form> 
						 </div>
</div>
   </div>
</div>
<script>
$('#addCheckAll').change(function () { 
    ($(this).is(":checked") ? $('.chkPermissionAdd_2').prop("checked", true) :    $('.chkPermissionAdd_2').prop("checked", false))
});
$('#deleteCheckAll').change(function () {  
    ($(this).is(":checked") ? $('.chkPermissionDelete_2').prop("checked", true) :    $('.chkPermissionDelete_2').prop("checked", false))
});
$('#editCheckAll').change(function () {  
    ($(this).is(":checked") ? $('.chkPermissionEdit_2').prop("checked", true) :    $('.chkPermissionEdit_2').prop("checked", false))
});
$('#viewCheckAll').change(function () { 

    ($(this).is(":checked") ? $('.chkPermissionView_2').prop("checked", true) :    $('.chkPermissionView_2').prop("checked", false))
});
$('#statusCheckAll').change(function () { 

    ($(this).is(":checked") ? $('.chkPermissionStatus_2').prop("checked", true) :    $('.chkPermissionStatus_2').prop("checked", false))
});


function add(check) {
	 $('.child_add1'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_add21'+check).prop("checked", true) :$('.child_add21'+check).prop("checked", false))
});   
}
function sub_add(check,subId) {
        $('.sub_add' + subId).change(function () {

            ($(this).is(":checked") ? $('.sub_add' + subId).prop("checked", true) : $('.sub_add' + subId).prop("checked", false))
                
        });

       subMenuSelection(check);
    }
  function subMenuSelection(check){
         var totalCheckedL = $('input.child_add21'+check+':checked').length;
  
                var totalCheckBoxL = $('input.child_add21'+check).length;
                

                if(totalCheckBoxL==totalCheckedL){
                   $('.child_add1'+check).prop("checked", true);                
                }else if(totalCheckedL!=2){                      
                  $('.child_add1'+check).prop("checked", false);
                }
    }



function view(check) {
	 $('.child_view1'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_view21'+check).prop("checked", true) :$('.child_view21'+check).prop("checked", false))
});   
}
function sub_view(check,subId) {
        $('.sub_view' + subId).change(function () {

            ($(this).is(":checked") ? $('.sub_view' + subId).prop("checked", true) : $('.sub_view' + subId).prop("checked", false))
                
        });

        var totalCheckedL = $('input.child_view21'+check+':checked').length;
  
                var totalCheckBoxL = $('input.child_view21'+check).length;
                

                if(totalCheckBoxL==totalCheckedL){
                   $('.child_view1'+check).prop("checked", true);                
                }else if(totalCheckedL!=2){                      
                  $('.child_view1'+check).prop("checked", false);
                }
    }
function status(check) {
	 $('.child_status1'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_status21'+check).prop("checked", true) :$('.child_status21'+check).prop("checked", false))
});   
}
function sub_status(check,subId) {
        $('.sub_status' + subId).change(function () {

            ($(this).is(":checked") ? $('.sub_status' + subId).prop("checked", true) : $('.sub_status' + subId).prop("checked", false))
                
        });

        var totalCheckedL = $('input.child_status21'+check+':checked').length;
  
                var totalCheckBoxL = $('input.child_status21'+check).length;
                

                if(totalCheckBoxL==totalCheckedL){
                   $('.child_status1'+check).prop("checked", true);                
                }else if(totalCheckedL!=2){                      
                  $('.child_status1'+check).prop("checked", false);
                }
    }
function edit(check) {  
	 $('.child_edit1'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_edit21'+check).prop("checked", true) :$('.child_edit21'+check).prop("checked", false))
});   
}
function sub_edit(check,subId) {
        $('.sub_edit' + subId).change(function () {

            ($(this).is(":checked") ? $('.sub_edit' + subId).prop("checked", true) : $('.sub_edit' + subId).prop("checked", false))
                
        });

        var totalCheckedL = $('input.child_edit21'+check+':checked').length;
  
                var totalCheckBoxL = $('input.child_edit21'+check).length;
                

                if(totalCheckBoxL==totalCheckedL){
                   $('.child_edit1'+check).prop("checked", true);                
                }else if(totalCheckedL!=2){                      
                  $('.child_edit1'+check).prop("checked", false);
                }
    }

function permission_delete(check) {  
	 $('.child_delete1'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_delete21'+check).prop("checked", true) :$('.child_delete21'+check).prop("checked", false))
});   
}
function sub_delete(check,subId) {
        $('.sub_delete' + subId).change(function () {

            ($(this).is(":checked") ? $('.sub_delete' + subId).prop("checked", true) : $('.sub_delete' + subId).prop("checked", false))
                
        });

        var totalCheckedL = $('input.child_delete21'+check+':checked').length;
  
                var totalCheckBoxL = $('input.child_delete21'+check).length;
                

                if(totalCheckBoxL==totalCheckedL){
                   $('.child_delete1'+check).prop("checked", true);                
                }else if(totalCheckedL!=2){                      
                  $('.child_delete1'+check).prop("checked", false);
                }
    }

function saveUserRolePermissions(){
	 
         //var formData = $('#master_permission_role').val();
		 var formData = new FormData($('#user_permission_role')[0]);
         ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/saveUserRolePermissions',
            data:formData,
			contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function()
            {
                 ajax_before();
            },
            success:function(res)
            {
                 ajax_success() ;
				 if(res==1){
					 statusMesage('The selected privileges have been allotted successfully.','success');
				 }else{
					statusMesage('something went wrong','error'); 
				 }
           
            }

            });
    }
	
	function saveUserAllRolePermissions(){
	      $('.all').prop("checked", true);
         //var formData = $('#master_permission_role').val();
		 var formData = new FormData($('#user_permission_role')[0]);
         ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/saveUserAllRolePermissions',
            data:formData,
			contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function()
            {
                 ajax_before();
            },
            success:function(res)
            {
                 ajax_success() ;
				 if(res==1){
					 statusMesage('All privileges have been granted successfully.','success');
				 }else{
					statusMesage('something went wrong','error'); 
				 }
           
            }

            });
    }
	
	function deleteUserAllRolePermissions(){
	      $('.all').prop("checked", false);  
         //var formData = $('#master_permission_role').val();
		 var formData = new FormData($('#user_permission_role')[0]);
         ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/deleteUserAllRolePermissions',
            data:formData,
			contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function()
            {
                 ajax_before();
            },
            success:function(res)
            {
                 ajax_success() ;
				 if(res==1){
					 statusMesage('All privileges have been revoked successfully.','success');
				 }else{
					statusMesage('something went wrong','error'); 
				 }
           
            }

            });
    }
	
	
</script>

