<form action="javascript:void(0);" method="post" id="editUserForm" enctype="multipart/form-data">  
                <div class="form modal-form">
                    <input type="hidden" name="updateUserId" value="<?php echo $adminData->id ; ?>">
                    <div class="form-group">
                        <label for="edit_name">First Name</label>
                         <input type="text" name="edit_name" id="edit_name"  class="form-control" placeholder="First Name" value="<?php echo  $adminData->first_name ; ?>"  >
                         <span id="err_edit_name" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="edit_last_name">Last Name</label>
                         <input type="text" name="edit_last_name" id="edit_last_name"  class="form-control" placeholder="Last Name" value="<?php echo  $adminData->last_name ; ?>">
                         <span id="err_edit_last_name" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="edit_user_role">Role</label>
                       <select name="edit_user_role" id="edit_user_role" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($role_type as $role_types){ ?>
                                <option value="<?php echo $role_types['id']; ?>" <?php echo ($adminData->user_type==$role_types['id'])?'selected':'' ; ?>><?php echo $role_types['title']; ?></option>
                                <?php } ?>
                                
                                                                    
                            </select>
                         <span id="err_edit_user_role" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="edit_category">Category</label>
                        <select name="edit_category" id="edit_category" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach($category_data as $category_datas){ ?>
                                <option value="<?php echo $category_datas->name; ?>" <?php echo ($adminData->category==$category_datas->name)?'selected':'' ; ?>><?php echo $category_datas->name; ?></option>
                                <?php } ?>      
                                </select>
                         <span id="err_edit_category" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select name="edit_status" id="edit_status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" <?php echo ($adminData->status==1)?'selected':'' ; ?>>Active</option>
                                <option value="2" <?php echo ($adminData->status==2)?'selected':'' ; ?>>Inactive</option>  
                                  
                                </select>
                         <span id="err_edit_user_status" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                         <input type="email" name="email1" id="email1"  class="form-control" placeholder="Email" value="<?php echo $adminData->email ; ?>" readonly>
                         <span id="err_email" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="edit_mobile_number">Mobile Number</label>
                         <input type="number" name="edit_mobile_number" id="edit_mobile_number"  class="form-control" placeholder="Mobile Number" value="<?php echo $adminData->phone ; ?>">
                         <span id="err_edit_mobile_number" class="err" style="color:red"></span>
                    </div>
                </div>
               
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="updateUsers()" class="search-btn">Update</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelUpdateUser()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>