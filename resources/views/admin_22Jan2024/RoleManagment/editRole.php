 <form action="javascript:void(0);"  method="post" class="" id="editRole_">   
                <div class="form modal-form">
                     <div class="form-group">
					  <input type="hidden" name="role_id"  value="<?php echo !empty($name->id)? $name->id:""; ?>"> 
                        <label for="edit_role">Role</label>
                        <input type="text" id="edit_role_type" name="edit_role_type" value="<?php echo !empty($name->title)? $name->title:""; ?>" placeholder="Enter Role"  class="form-control">
                        <span class="err" id="err_role"></span>  
                    </div>

                    <div class="form-group">
                        <label for="">Status </label>
                        <input  type="checkbox" checked style="vertical-align: middle;">
                    </div>
                </div>
                 <div class="mt-2">
                <a href="javascript:void(0);" onclick="updateRole()" class="search-btn">Update</a>
                <a href="javascript:void(0);" class="search-btn clear-btn" data-bs-dismiss="modal" onclick="cancelRole()" >Cancel</a>
            </div>
            </form> 