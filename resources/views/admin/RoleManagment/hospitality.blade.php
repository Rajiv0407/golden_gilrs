<div class="widget-head row">
    <h4 class="heading">
        <i class="ri-arrow-left-line"></i>
        <span>Role Management</span>
    </h4>
</div>
<div style="padding: 8px 20px 0 20px; background-color: transparent !important;" class="widget-body margin-bottom-none">
    <div class="row">
        <div
            style="float: left; width: 20%; vertical-align: top; background-color: #fff; padding: 10x; border: solid 1px #dddccc;" class="leftrm">
            <div class="widget widget-inverse">
                <div class="d-block" style="text-align: right;    margin-bottom: 5px;">
                    <a href="#modalAddRole" data-keyboard="false" data-backdrop="static" data-toggle="modal"
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
                                <a  onclick="editRole(<?php echo $role_types['id']; ?>);" href="javascript:void(0)" data-toggle="modal" data-target="#edit_role" style="color: #0d6efd;">							
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
                    <div class="div-cell padding-right-none pull-right right"
                        style="padding: 0px;margin-bottom: 7px;position: absolute;z-index:9;float: right !important;right: -2px;top: -47px;width:100%;display: flex;align-items: center;justify-content: space-between;">
						<div class="div-cell  sorting_disabled" style="padding: 0px; width: 200px; float: left;">
                        <label id="RoleName" style="font-size: 18px; margin: 0px; color: #000000;" class="ng-binding">Hospitality</label>
                       </div>
                       <div style="display:flex;gap:20px;align-item:center;">
					    <div style=" float: right;">
                            <button type="button" name="reset" class=""></i>Reset
                                Permissions</button>
                        </div>
                        <div style=" float: left; margin-right: 5px;">
                            <button type="button" onclick="saveMasterRolePermissions()" class=" btn btn-primary">Submit
                            </button>
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
                            style="max-height: 400px; max-width: 100%; overflow: auto !important;">
							<?php foreach($role_info as $role_infos){     ?>
                            <div class="table-layout chindpading bcpssd"style="padding: 10px 0;">
                                <div style="width: 260px; float: left;" class="table-cell1">
                                    <img style="cursor: pointer; width: 12px; margin-top: -3px; margin-right: 3px;"
                                        src="{{URL::to('/public')}}/admin/images/plus.png" class="">
									
                                    <?php echo $role_infos['title']; ?>
									<input type="hidden" name="roleId_<?php echo $role_infos['id'] ; ?>" value="<?php echo $role_infos['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="2">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($role_infos['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $role_infos['id'] ; ?>"  onclick="add(<?php echo $role_infos['id']; ?>);"  class="chkPermissionAdd_2 child_add<?php echo $role_infos['id']; ?>">
                                </div>  
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $role_infos['id'] ; ?>" onclick="permission_delete(<?php echo $role_infos['id']; ?>);"  class="chkPermissionDelete_2 child_delete<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $role_infos['id'] ; ?>" onclick="edit(<?php echo $role_infos['id']; ?>);"  class="chkPermissionEdit_2 child_edit<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $role_infos['id'] ; ?>"  onclick="view(<?php echo $role_infos['id']; ?>);" class="chkPermissionView_2 child_view<?php echo $role_infos['id']; ?>">
                                </div> 
								 <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($role_infos['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $role_infos['id'] ; ?>"  onclick="status(<?php echo $role_infos['id']; ?>);" class="chkPermissionStatus_2 child_status<?php echo $role_infos['id']; ?>">
                                </div>
                            </div>
							<?php if(!empty($role_infos['sub_title'])){ ?>
							<?php foreach($role_infos['sub_title'] as $sub){ ?>
							
							 <div class="table-layout chindpading bcpssd" style="padding: 10px 0;">
                                <div style="width: 260px; float: left;" class="table-cell1">
								   <input type="hidden" name="roleId_<?php echo $sub['id'] ; ?>" value="<?php echo $sub['id'] ; ?>" />
									<input type="hidden" name="roleTypeId" value="2">   
								
                                    <?php echo $sub['title']; ?>
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                <input <?php if($sub['add']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="add_<?php echo $sub['id']; ?>" onclick="add(<?php echo $role_infos['id']; ?>);" class="chkPermissionAdd_2 child_add<?php echo $role_infos['id']; ?>">  
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($sub['delete']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="delete_<?php echo $sub['id']; ?>" onclick="permission_delete(<?php echo $role_infos['id']; ?>);" class="chkPermissionDelete_2 child_delete<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;" class="">
                                    <input <?php if($sub['edit']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="edit_<?php echo $sub['id']; ?>" onclick="edit(<?php echo $role_infos['id']; ?>);" class="chkPermissionEdit_2 child_edit<?php echo $role_infos['id']; ?>">
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($sub['view']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="view_<?php echo $sub['id']; ?>"  onclick="view(<?php echo $role_infos['id']; ?>);" class="chkPermissionView_2 child_view<?php echo $role_infos['id']; ?>">   
                                </div>
                                <div style="width: 80px; border: 0px none !important; display: inline-block; text-align: left;"
                                    class="">  
                                    <input <?php if($sub['status']== 1){ ?>checked="checked"<?php } ?> type="checkbox" name="status_<?php echo $sub['id']; ?>"  onclick="view(<?php echo $role_infos['id']; ?>);" class="chkPermissionStatus_2 child_status<?php echo $role_infos['id']; ?>">   
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
	 $('.child_add'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_add'+check).prop("checked", true) :$('.child_add'+check).prop("checked", false))
});   
}
function view(check) {
	 $('.child_view'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_view'+check).prop("checked", true) :$('.child_view'+check).prop("checked", false))
});   
}
function edit(check) {  
	 $('.child_edit'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_edit'+check).prop("checked", true) :$('.child_edit'+check).prop("checked", false))
});   
}
function status(check) {  
	 $('.child_status'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_status'+check).prop("checked", true) :$('.child_status'+check).prop("checked", false))
});   
}

function permission_delete(check) {  
	 $('.child_delete'+check).change(function () { 	 
    ($(this).is(":checked") ? $('.child_delete'+check).prop("checked", true) :$('.child_delete'+check).prop("checked", false))
});   
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
	
	if(id == 1){
		brand();
	}
	if(id == 2){
		hospitality();
	}
	if(id == 3){
		admin();
	}
}

function brand(){
	ajaxCsrf();
        $.ajax({
        type: "post",
        url: baseUrl+'/brand_permission',  
        cache: 'FALSE',
		dataType:'html',
        beforeSend: function () {
       // ajax_before();
        },
        success: function(html){
        //ajax_success() ;
           $('.main_site_data').html(html);   

        }

        });
	
	
}
function hospitality(){
	ajaxCsrf();
        $.ajax({
        type: "post",
        url: baseUrl+'/hospitality_permission',  
        cache: 'FALSE',
		dataType:'html',
        beforeSend: function () {
       // ajax_before();
        },
        success: function(html){
        //ajax_success() ;
           $('.main_site_data').html(html);   

        }

        });
}

function admin(){
	ajaxCsrf();
        $.ajax({
        type: "post",
        url: baseUrl+'/admin_permission',    
        cache: 'FALSE',
		dataType:'html',
        beforeSend: function () {
       // ajax_before();
        },
        success: function(html){
        //ajax_success() ;
           $('.main_site_data').html(html);   

        }

        });
}


</script>