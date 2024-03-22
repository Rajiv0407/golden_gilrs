
   <div class="modal-header ">
                <h5 class="modal-title" id="manage-membersLabel"><?php echo isset($group->group_name)?$group->group_name:'' ; ?> </h5>
                <p><?php echo isset($groupMember)?$groupMember:'' ; ?> members</p>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
                </button>
            </div>   
             
          <div class="modal-body">
                  <div class="members_popup" >
                    <form id="" action="javascript:void(0);" method="post">
                        <div class="srch_mb_wrapp">
                            <div class="form-group srch_mb">
                                <input type="text" name="Search_members" id="hair_color" class="form-control" onkeyup="groupManageMemberSearch(<?php echo $group->id ; ?>,this.value)" placeholder="Search members">
                                <div class="form-icon"><i class="ri-search-line"></i></div>
                            </div>
                             <?php if($group->admin_id==Auth::id()){ ?>
                            <div class="add_btn" data-bs-toggle="modal" data-bs-target="#addGroupMembermodal" onclick="addGroupMember(<?php echo $group->id ; ?>)">
                                <button class="btn"><i class="ri-add-fill"></i> Add</button>
                            </div>
                        <?php } ?>
                        </div>
                         <div class="member_list">
                            <div class="head_table">
                                <h3>Name</h3>
                                <h3 class="web_show">Email</h3>
                               <!--  <div class="copy_all">
                                    <button class="cpy_btn"><i class="ri-file-copy-line"></i></button>
                                </div> -->
                            </div>
                            <div class="body_table" id="groupManageMember"> 


                            </div>

                        </div>                        
                    </form>
                    
                </div>

             </div>