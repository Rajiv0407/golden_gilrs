<div class="widget-head row">
    <h4 class="heading"><a href="javascript:void(0);" onclick="roleManagment();">
        <i class="ri-arrow-left-line"></i>
        <span>Role Management</span></a>
    </h4>
</div>
<?php //echo $role_id;die;  ?>
<div style="padding: 8px 20px 0 20px; background-color: transparent !important;" class="widget-body margin-bottom-none">
    <div class="row">
        <div
            style="float: left; width: 20%; vertical-align: top; background-color: #fff; padding: 10x; border: solid 1px #dddccc;" class="leftrm">
            <div class="widget widget-inverse">
                <div class="d-block" style="text-align: right;    margin-bottom: 5px;">
                    <a  href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_role"
                        style="color: #353535; margin-right: 5px; margin-top: 0px; font-size: 12px;">
                        <i class="ri-add-line"></i> Add Role
                    </a>
                </div>
                <div style="padding: 10px 0px;">
                    <input type="text" placeholder="Search Role" class="form-control"
                        style="width: 100%;font-size: 12px;padding-left: 6px;">
                </div>
                <div class="widget-body">
                    <div class="table-layout">
                        <?php foreach($role_type as $role_types){ ?>
                        <div class="d-flex justify-content-between">
                            <a class="name_role" onclick="role_type(<?php echo $role_types['id']; ?>)" href="javascript:void(0)" style="color: #000;"><?php echo $role_types['title']; ?></a> 
                                <a  onclick="editRole(<?php echo $role_types['id']; ?>);" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_role" style="color: #0d6efd;">							
                                <i class="ri-edit-box-line"></i>
                              </a>

                        </div>
					   <?php } ?>
						
                    </div>
                </div>
            </div>
        </div>
        <div style="float: left; width: 79%; vertical-align: top;margin-left:10px;"  class="rgtrm">
            <form id="master_permission_role" method="post">
                <div class="div-layout">

                    <div class="div-cell padding-right-none pull-right right" style="padding: 0px;margin-bottom: 7px;position: absolute;z-index:9;float: right;right: -2px;top: -47px;width:100%;display: flex;align-items: center;justify-content: space-between;">
						<div class="div-cellb  sorting_disabled" style="padding: 0px; width: 200px; float: left;">
                            <?php foreach($role_type as $role_types){ ?>
                            <?php if($role_id == $role_types['id']){ ?>
                            <label id="RoleName" style="font-size: 18px; margin: 0px; color: #000000;" class="ng-binding"><?php echo $role_types['title']; ?></label>
                            <?php } ?>
                            <?php } ?>
                        </div>

                       <div class="button_group" style="display:flex;gap:20px;align-item:center;">
					    <div class="sellbx bg_prmsrb" style=" float: right;">
                            <button type="button" name="reset" class="btn"></i>Reset Permissions</button>
                        </div>
                        <div class="sellbx bg_prsbt" style=" float: left; margin-right: 5px;">
                            <button type="button" onclick="saveMasterRolePermissions()" class=" btn btn-primary">Submit</button>
                        </div>
					   </div>

                    </div>
                </div>


                <div class="mscroll_box2">
                    <div class="table_min">
                        <div class="table-layout" style=" background-color: #ececec; padding: 7px .30rem 7px .30rem;">
                            <div class="table-cell1 head  sorting_disabled"
                                style="width: 255px; display: inline-block;color:#000; background-color: #ececec; height: 23px; float: left;">
                                <input type="checkbox" style="position: absolute; margin-left: 10px; margin-top:2px;"
                                    class="">
                                <label style="margin-left: 26px; margin-top: 2px;color:#000; font-size: 12px;"
                                    class="col-white">Pages</label>
                            </div>
                            <div class="table-cell1 head  sorting_disabled "
                                style="width: 80px; padding: 2px 0px; text-align: left; display: inline-block; background-color: #ececec; color: #000; font-size: 11px;">
                                <input type="checkbox" id='addCheckAll' style="position: absolute;margin-top:2px;" class="">
                                <label class="col-white" style="margin-left: 16px;">Add</label>
                            </div>
                            <div class="table-cell1 head  sorting_disabled "
                                style="width: 80px; padding: 2px 0px; text-align: left; display: inline-block; background-color: #ececec; color: #000; font-size: 11px;">
                                <input type="checkbox" id='deleteCheckAll' style="position: absolute;margin-top:2px;" class="">
                                <label class="col-white" style="margin-left: 16px;">Delete</label>
                            </div>
                            <div class="table-cell1 head  sorting_disabled"
                                style="width: 80px; padding: 2px 0px; text-align: left; display: inline-block; background-color: #ececec; color: #000; font-size: 11px;">
                                <input type="checkbox" id='editCheckAll' style="position: absolute;margin-top:2px;" class="">
                                <label class="col-white" style="margin-left: 16px;">Edit</label>
                            </div>
                            <div class="table-cell1 head  sorting_disabled "
                                style="width: 80px; padding: 2px 0px; text-align: left; display: inline-block; background-color: #ececec; color: #000; font-size: 11px;">
                                <input type="checkbox" id='viewCheckAll' style="position: absolute;margin-top:2px;" class="">
                                <label class="col-white" style="margin-left: 16px;">View</label>
                            </div>
							<div class="table-cell1 head  sorting_disabled "
                                style="width: 80px; padding: 2px 0px; text-align: left; display: inline-block; background-color: #ececec; color: #000; font-size: 11px;">
                                <input type="checkbox" id='statusCheckAll' style="position: absolute;margin-top:2px;" class="">
                                <label class="col-white" style="margin-left: 16px;">Status</label>
                            </div>
                            
                        </div>
                        <div class="table-layout-body"
                            style="max-height: 400px; max-width: 100%; overflow: auto ;">
							<?php foreach($role_info as $role_infos){     ?>
                            <div class="table-layout chindpading bcpssd"style="padding: 10px 0;">
                                <div style="width: 260px; float: left;" class="table-cell1">
                                    <img style="cursor: pointer; width: 12px; margin-top: -3px; margin-right: 3px;"
                                        src="<?php echo e(URL::to('/public')); ?>/admin/images/plus.png" class="">
									
                                    <?php echo $role_infos['title']; ?>
									<input type="hidden" name="roleId_<?php echo $role_infos['id'] ; ?>" value="<?php echo $role_infos['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="<?php echo !empty($role_id)?$role_id:""; ?>">  
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($role_infos['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $role_infos['id'] ; ?>"  onclick="add(<?php echo $role_infos['id']; ?>);"  class="chkPermissionAdd_2 child_add1<?php echo $role_infos['id']; ?>">
                                </div>  
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $role_infos['id'] ; ?>" onclick="permission_delete(<?php echo $role_infos['id']; ?>);"  class="chkPermissionDelete_2 child_delete1<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $role_infos['id'] ; ?>" onclick="edit(<?php echo $role_infos['id']; ?>);"  class="chkPermissionEdit_2 child_edit1<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $role_infos['id'] ; ?>"  onclick="view(<?php echo $role_infos['id']; ?>);" class="chkPermissionView_2 child_view1<?php echo $role_infos['id']; ?>">
                                </div>
                                 <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $role_infos['id'] ; ?>"  onclick="status(<?php echo $role_infos['id']; ?>);" class="chkPermissionStatus_2 child_status1<?php echo $role_infos['id']; ?>">
                                </div> 								
                            </div>
							<?php if(!empty($role_infos['sub_title'])){ ?>
							<?php foreach($role_infos['sub_title'] as $sub){ ?>
							
							 <div class="table-layout chindpading bcpssd" style="padding: 10px 0;">
                                <div style="width: 260px; float: left;" class="table-cell1">
								   <input type="hidden" name="roleId_<?php echo $sub['id'] ; ?>" value="<?php echo $sub['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="<?php echo !empty($role_id)?$role_id:""; ?>">       
                                    <?php echo $sub['title']; ?>
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                <input <?php if($sub['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $sub['id']; ?>" onclick="sub_add(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionAdd_2 child_add21<?php echo $role_infos['id']; ?> sub_add<?php echo $sub['id']; ?>">  
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($sub['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $sub['id']; ?>" onclick="sub_delete(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionDelete_2 child_delete21<?php echo $role_infos['id']; ?> sub_delete<?php echo $sub['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($sub['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $sub['id']; ?>" onclick="sub_edit(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionEdit_2 child_edit21<?php echo $role_infos['id']; ?> sub_edit<?php echo $sub['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($sub['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $sub['id']; ?>"  onclick="sub_view(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionView_2 child_view21<?php echo $role_infos['id']; ?> sub_view<?php echo $sub['id']; ?>">   
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($sub['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $sub['id']; ?>"  onclick="sub_status(<?php echo $role_infos['id']; ?>,<?php echo $sub['id']; ?>);" class="chkPermissionStatus_2 child_status21<?php echo $role_infos['id']; ?> sub_status<?php echo $sub['id']; ?>">   
                                </div>								
                            </div>
							
							<?php } ?>
							<?php }?>  
							<?php } ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal right_side" id="edit_role" tabindex="-1" aria-bs-labelledby="exampleModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
                </div>
            </div>
			
            <div class="modal-body" id="edit_model_role">
              
            </div>  
            
        </div>
    </div>
</div>



<div class="modal right_side" id="add_role" tabindex="-1" aria-bs-labelledby="exampleModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
                </div>
            </div>
			
            <div class="modal-body">
              <form action="javascript:void(0);"  method="post" class="form-control" id="addRole_">   
                <div class="form modal-form">
                     <div class="form-group">
                        <label for="add_role">Role</label>
                        <input type="text" id="add_role_title" name="add_role_title" placeholder="Enter Role"  class="form-control">
                        <span class="err" id="err_add_role"></span>  
                    </div>

                    <div class="form-group">
                        <label for="">Status </label>
                        <input  type="checkbox" checked>
                    </div>
                </div>
                 <div class="mt-4">  
                <a href="javascript:void(0);" onclick="addRole()" class="search-btn">Add</a>
                <a href="javascript:void(0);" class="search-btn clear-btn" data-bs-dismiss="modal" onclick="cancelRole()" >Cancel</a>
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

/* start */
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

    /* End */

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

function addRole(){  
        var add_role = $('#add_role_title').val();
        $('.err').html('');  
        if(add_role==''){    
            $('#err_add_role').html('Please enter role');  
        }else{
			   //var formData = $('#editRole_').val() ;
			   var formData = new FormData($('#addRole_')[0]);
                 ajaxCsrf();  
        $.ajax({
            type:"post",
            url:baseUrl+'/addRole',    
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

             if(res.status==1){
			
			$('#addRole_')[0].reset();
            $('#add_role').modal('hide');     
            roleManagment();  			
              statusMesage('Role addeded successfully','success');
			    
            }else if(res==2){
				$('#err_add_role').html('Role already exists');
				
			}else{
               statusMesage('something went wrong','error');
            } 
            }

            });
    }
 }

function saveMasterRolePermissions(){
	
         //var formData = $('#master_permission_role').val();
		 var formData = new FormData($('#master_permission_role')[0]);
         ajaxCsrf();
        $.ajax({
            type:"post",
            url:baseUrl+'/saveMasterRolePermissions',
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
					 statusMesage('Permissions save Successfully','success');
				 }else{
					statusMesage('something went wrong','error'); 
				 }
           
            }

            });
    }
	


function role_type(id){
	
	ajaxCsrf();
        $.ajax({
        type: "post",
        url: baseUrl+'/brand_permission/'+id,  
        cache: 'FALSE',
		dataType:'html',
        beforeSend: function () {
           ajax_before();
        },
        success: function(html){
            ajax_success() ;
           $('.main_site_data').html(html);   

        }

        });

}

</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/admin/RoleManagment/brand.blade.php ENDPATH**/ ?>