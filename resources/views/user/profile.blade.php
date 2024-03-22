              <div class="edt_form">
                    <div class="edt_head">
                        <div class="eh_name"><h3 class="ttl_name">Profile Information</h3></div>
                        <div class="eh_btn">
                            <!-- <a class="samebtn" href="/accounts/change-password/"><i class="ri-lock-line"></i> Change Password</a> -->
                            <a class="samebtn remv_attr" href="{{URL::to('/')}}/user/index#edit_profile" onClick="edit_profile()"><i class="ri-edit-2-fill"></i> Edit</a>                                                                
                            <!-- <a class="samebtn" id="delete_profile"  href="/accounts/profile/delete/"><i class="ri-delete-bin-5-fill"></i>Delete</a> -->
                        </div>
                    </div>
               <div class="edt_form_list">
                            <div class="form-group">
                                <label class="ttl-n">Name</label>
                                <input type="name" class="form-control" name="name"  id="name" placeholder="Name" value="<?= !empty($userInfo['name'])?$userInfo['name']:"";?>" >
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">Email Address</label>
                                <input type="text" class="form-control" placeholder="Enter email" value="<?= !empty($userInfo['email'])?$userInfo['email']:"";?>" disabled="">
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Mobile Number" value="<?= !empty($userInfo['phone'])?$userInfo['phone']:"";?>" >
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">DOB</label>
                                <input type="text" class="form-control" placeholder="DOB" value="<?= !empty($userInfo['dob'])?$userInfo['dob']:"";?>" >
                            </div>
                            <div class="form-group">
                                <label class="ttl-n">Male/Female</label>
                            
                                
                                <input type="text" class="form-control" placeholder="Gender" value=<?= !empty($userInfo['gender'])?$userInfo['gender']:"";?> >
                                
                            </div>                       
                            <div class="add_attr d-none">
                                <a href="javascript:void(0);" class="btn btn-primary">Save</a>
                                <a href="javascript:void(0);" class="btn btn-outline-dark">Cancel</a>
                            </div> 
                    </div>
 </div> 
				
           