<!-- </?php echo "hello"; ?> -->
<!-- </?php echo "hello"; ?> -->
<?php $data=session()->get('user_session');   ?>
<?php $user_id=request()->segment(2); ?>
<?php $abouInfo=profileAboutInfo($userId);   
       $users=$abouInfo['users'] ;
       $country=$abouInfo['country'] ;
    // echo "<pre>";
    // print_r($abouInfo);
    // exit ;


?>

<div id="aboutinfo" class="abtsection">
    <div class="section_rept">
        <div class="head">
            <h3>Account Information</h3>
            <?php if($user_id == $data['userId']){  ?>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#accountinformation"><i
                    class="ri-edit-2-fill"></i> Edit</button>
            <?php } ?>
        </div>
        <div class="group_form">
            <div class="form-group">
                <label for="">First Name</label>
                <h4>
                    <?php echo isset($users['first_name'])?$users['first_name']:''; ?>
                </h4>
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <h4>
                    <?php echo isset($users['last_name'])?$users['last_name']:''; ?>
                </h4>
            </div>

            <div class="form-group">
                <label for="">Account Type</label>
                <h4>
                    <?php if(isset($users['isPrivate']) && $users['isPrivate']==0){ ?> 
                    <span class="icon">
                            <img src="<?php echo URL('/').'/public/website/images/icon/public.png' ?>" title="Friends" id="accountT" alt="">
                        </span>
                    <?php }else if(isset($users['isPrivate']) && $users['isPrivate']==1){ ?> 
                         <span class="icon">
                            <img src="<?php echo URL('/').'/public/website/images/icon/only_me.png' ?>" title="Friends" id="accountT" alt="">
                        </span>
                        <?php } ?>
                    <?php echo isset($users['isPrivate_'])?$users['isPrivate_']:''; ?>
                </h4>
            </div>
            <?php if(!empty($users['brand_name'])){ ?>
            <div class="form-group">
                <label for="">Brand Name</label>
                <h4>
                    <?php echo !empty($users['brand_name'])?$users['brand_name']:""; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['brand_website'])){ ?>
            <div class="form-group">
                <label for="">Brand website</label>
                <h4>
                    <?php echo !empty($users['brand_website'])?$users['brand_website']:""; ?>
                </h4>
            </div>
            <?php } ?>

        </div>
    </div>
     <?php  if(isset($data['userId']) && $user_id!=$data['userId'] && $users['address_line_1']!='' && (($users['isPrivate']==0 && $users['isAddressPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isAddressPrivacy']==2) || ($users['isFriend']==1 && ($users['isAddressPrivacy']==1 || $users['isAddressPrivacy']==2) && $users['isPrivate']==1))){    ?>
    <div class="section_rept">
        <div class="head">
            <h3>Address</h3>
            <?php if($user_id == $data['userId']){  ?>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addressmodal"><i
                    class="ri-edit-2-fill"></i> Edit</button>
            <?php } ?>
        </div>
        <!-- <div class="addlnkscl">
            <button type="button" class="btn"><i class="ri-add-circle-line"></i>Add Address</button>
        </div> -->
        <div class="group_form">
            <?php if(!empty($users['address_line_1'])){  ?>
            <div class="form-group">
                <label for="">Address Line 1</label>
                <h4>
                    <?php echo !empty($users['address_line_1'])?$users['address_line_1']:""; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['address_line_2'])){  ?>
            <div class="form-group">
                <label for="">Address Line 2</label>
                <h4>
                    <?php echo !empty($users['address_line_2'])?$users['address_line_2']:""; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['country'])){  ?>
            <div class="form-group">
                <label for="">Country</label>
                <h4>
                    <?php echo $users['country']; ?>
                </h4>

            </div>
            <?php } ?>
            <?php if(!empty($users['city'])){  ?>
            <div class="form-group">
                <label for="">City</label>
                <h4>
                    <?php echo $users['city']; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['zip_code'])){  ?>
            <div class="form-group">
                <label for="">Zip/Postal Code</label>
                <h4>
                    <?php echo !empty($users['zip_code'])?$users['zip_code']:""; ?>
                </h4>
            </div>
            <?php } ?>
        </div>
    </div>
<?php  } else if($user_id==$data['userId']) { ?> 
    <div class="section_rept">
        <div class="head">
            <h3>Address</h3>
            <?php if($user_id == $data['userId']){  ?>            
                <div class="ab_rbx">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addressmodal">
                        <i class="ri-edit-2-fill"></i> Edit
                    </button>
                    <button type="button" class="btn pstpblc" data-bs-toggle="modal" data-bs-target="#audience_modal"  onclick="profilePrivacy(1)">
                        <span class="icon">
                            <img src="<?php echo getPrivacyIcon($users['isAddressPrivacy']); ?>" title="<?php echo getPrivacyToolTip($users['isAddressPrivacy']); ?>" id="addressPrivacy" alt="">
                        </span>                        
                    </button>
                </div>
            <?php } ?>
        </div>
        
        <!-- <div class="addlnkscl">
            <button type="button" class="btn"><i class="ri-add-circle-line"></i>Add Address</button>
        </div> -->

        <div class="group_form">
            <?php if(!empty($users['address_line_1'])){  ?>
            <div class="form-group">
                <label for="">Address Line 1</label>
                <h4>
                    <?php echo !empty($users['address_line_1'])?$users['address_line_1']:""; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['address_line_2'])){  ?>
            <div class="form-group">
                <label for="">Address Line 2</label>
                <h4>
                    <?php echo !empty($users['address_line_2'])?$users['address_line_2']:""; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['country'])){  ?>
            <div class="form-group">
                <label for="">Country</label>
                <h4>
                    <?php echo $users['country']; ?>
                </h4>

            </div>
            <?php } ?>
            <?php if(!empty($users['city'])){  ?>
            <div class="form-group">
                <label for="">City</label>
                <h4>
                    <?php echo $users['city']; ?>
                </h4>
            </div>
            <?php } ?>
            <?php if(!empty($users['zip_code'])){  ?>
            <div class="form-group">
                <label for="">Zip/Postal Code</label>
                <h4>
                    <?php echo !empty($users['zip_code'])?$users['zip_code']:""; ?>
                </h4>
            </div>
            <?php } ?>
        </div>
    </div>

<?php } ?>

   <?php  if($user_id!=$data['userId'] && (($users['isPrivate']==0 && $users['isMNPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isMNPrivacy']==2) || ($users['isPrivate']==0 && $users['isEmailIdPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isEmailIdPrivacy']==2)) || ($users['isPrivate']==1 && ($users['isMNPrivacy']==1 || $users['isMNPrivacy']==2) && $users['isFriend']==1) || ($users['isPrivate']==1 && ($users['isEmailIdPrivacy']==1 || $users['isEmailIdPrivacy']==2) && $users['isFriend']==1)){ ?> 
        <div class="section_rept">
        <div class="head">
            <h3>Contact Info</h3>           
        </div>      
        <div class="group_form">
            <?php  if(($users['isPrivate']==0 && $users['isMNPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isMNPrivacy']==2) || ($users['isPrivate']==1 && $users['isFriend']==1 && ($users['isMNPrivacy']==1 || $users['isMNPrivacy']==2)) ){ ?> 
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-phone-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <?php echo isset($users['phone'])?$users['phone']:''; ?>
                    </h4>
                    <label>Mobile</label>
                </div>
                
            </div>


        <?php } ?>

 <?php if(($users['isPrivate']==0 && $users['isEmailIdPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isEmailIdPrivacy']==2) || ($users['isPrivate']==1 && $users['isFriend']==1 && ($users['isEmailIdPrivacy']==2 || $users['isEmailIdPrivacy']==1))){ ?> 
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-mail-unread-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <?php echo isset($users['email'])?$users['email']:''; ?>
                    </h4>
                    <label>Email</label>
                </div>
              
            </div>

        <?php } ?>

        </div>
    </div>

   <?php } else if($user_id==$data['userId']) { ?>

        <div class="section_rept">
        <div class="head">
            <h3>Contact Info</h3>           
        </div>      
        <div class="group_form">          
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-phone-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <?php echo isset($users['phone'])?$users['phone']:''; ?>
                    </h4>
                    <label>Mobile</label>
                    <button type="button" class="btn pstpblc" data-bs-toggle="modal" data-bs-target="#audience_modal"  onclick="profilePrivacy(2)">
                        <span class="icon">
                            <img src="<?php echo getPrivacyIcon($users['isMNPrivacy']); ?>"  title="<?php echo getPrivacyToolTip($users['isMNPrivacy']); ?>" id="contactPrivacy" alt="">                        
                        </span>                        
                    </button>
                </div>              
                
            </div> 
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-mail-unread-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <?php echo isset($users['email'])?$users['email']:''; ?>
                    </h4>
                    <label>Email</label>
                    <button type="button" class="btn pstpblc" data-bs-toggle="modal" data-bs-target="#audience_modal"  onclick="profilePrivacy(3)">
                        <span class="icon">
                            <img src="<?php echo getPrivacyIcon($users['isEmailIdPrivacy']); ?>" title="<?php echo getPrivacyToolTip($users['isEmailIdPrivacy']); ?>" id="emailPrivacy" alt="">
                        </span>                        
                    </button> 
                </div>                 
                              
            </div>        

        </div>
    </div>
   <?php } ?>

    


 <?php  if(isset($data['userId']) && $user_id!=$data['userId'] && ($users['instagram']!='' || $users['snapchat']!='' || $users['youtube'] !='') && (($users['isSocialPrivacy']==1 && $users['isPrivate']==0) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isSocialPrivacy']==2) || ($users['isPrivate']==1 && $users['isFriend']==1 && ($users['isSocialPrivacy']==2 || $users['isSocialPrivacy']==1)))){   ?>
    <div class="section_rept">

        <div class="head">
            <h3>Websites and social links</h3>
            <?php  if(isset($data['userId']) && $user_id == $data['userId']){   ?>
			<?php if(($users['instagram'] !='') || ($users['snapchat'] !='') || ($users['youtube'] !='')){
				$var='Edit';
				}else{
				 $var='Add';
				}
				?>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#websoclmodal"><i
                    class="ri-edit-2-fill"></i><?php echo $var; ?></button>
            <?php } ?>
        </div>

        <div class="group_form threeclm">
            <?php if(!empty($users['instagram'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-instagram-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <a href="https://www.instagram.com/<?php echo !empty($users['instagram'])?$users['instagram']:""; ?>" target="_blanck">
                            <?php echo !empty($users['instagram'])?$users['instagram']:""; ?>
                        </a>
                    </h4>
                    <label>Instagram</label>
                </div>
            </div>
            <?php }  ?>
            <?php if(!empty($users['snapchat'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-snapchat-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <a href="https://www.snapchat.com/add/<?php echo !empty($users['snapchat'])?$users['snapchat']:""; ?>" target="_blanck">
                            <?php echo !empty($users['snapchat'])?$users['snapchat']:""; ?>
                        </a>                        
                    </h4>
                    <label>Snapchat</label>
                </div>
            </div>
            <?php }  ?>
            <?php if(!empty($users['youtube'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-youtube-fill"></i>
                </div>

                <div class="form-group">
                    <h4>
                        <a href="https://www.youtube.com/@<?php echo !empty($users['youtube'])?$users['youtube']:""; ?>" target="_blanck">
                           <?php echo !empty($users['youtube'])?$users['youtube']:""; ?>
                        </a>                        
                    </h4>
                    <label>Youtube</label>
                </div>
            </div>
            <?php }  ?>
        </div>
    </div>
<?php } else if($user_id==$data['userId']){ ?> 

<div class="section_rept">

        <div class="head">
            <h3>Websites and social links</h3>           
            <?php if(($users['instagram'] !='') || ($users['snapchat'] !='') || ($users['youtube'] !='')){
                $var='Edit';
                }else{
                 $var='Add';
                }
                ?>
                <div class="ab_rbx">                    
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#websoclmodal">
                        <i class="ri-edit-2-fill"></i><?php echo $var; ?>
                    </button>
                    <button type="button" class="btn pstpblc" data-bs-toggle="modal" data-bs-target="#audience_modal"  onclick="profilePrivacy(4)">
                        <span class="icon">
                            <img src="<?php echo getPrivacyIcon($users['isSocialPrivacy']); ?>" title="<?php echo getPrivacyToolTip($users['isSocialPrivacy']); ?>" id="websitePrivacy" alt="">
                        </span>                        
                    </button>
                </div>                   
        
        </div>


        <div class="group_form threeclm">
            <?php if(!empty($users['instagram'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-instagram-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <a href="https://www.instagram.com/<?php echo !empty($users['instagram'])?$users['instagram']:""; ?>" target="_blanck">
                            <?php echo !empty($users['instagram'])?$users['instagram']:""; ?>
                        </a>
                    </h4>
                    <label>Instagram</label>
                </div>
            </div>
            <?php }  ?>
            <?php if(!empty($users['snapchat'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-snapchat-fill"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <a href="https://www.snapchat.com/add/<?php echo !empty($users['snapchat'])?$users['snapchat']:""; ?>" target="_blanck">
                            <?php echo !empty($users['snapchat'])?$users['snapchat']:""; ?>
                        </a>                        
                    </h4>
                    <label>Snapchat</label>
                </div>
            </div>
            <?php }  ?>
            <?php if(!empty($users['youtube'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-youtube-fill"></i>
                </div>

                <div class="form-group">
                    <h4>
                        <a href="https://www.youtube.com/@<?php echo !empty($users['youtube'])?$users['youtube']:""; ?>" target="_blanck">
                           <?php echo !empty($users['youtube'])?$users['youtube']:""; ?>
                        </a>                        
                    </h4>
                    <label>Youtube</label>
                </div>
            </div>
            <?php }  ?>
        </div>
    </div>

<?php } ?>


    <div class="section_rept">
        <div class="head">
            <h3>Basic Info</h3>
            <?php if($user_id == $data['userId']){  ?>
                  
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#basicinfomdl"><i
                    class="ri-edit-2-fill"></i> Edit</button>
            <?php } ?>
        </div>
        <div class="group_form threeclm">
            <?php if(!empty($users['gender'])){ ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-user-5-fill"></i>
                </div>

                <div class="form-group">
                    <h4>
                        <?php echo $users['gender']; ?>
                    </h4>
                    <label>Gender</label>
                </div>
            </div>
            <?php } ?>
           

                <?php if($user_id == $data['userId']){  ?>
                     <div class="fgwi">
                <div class="icon">
                    <i class="fa fa-birthday-cake"></i>
                </div>
                <div class="form-group">
                    <h4>
                        <?php 
                        if(isset($users['dob'])){
                             echo date("F d, Y", strtotime($users['dob']));
                        }
                        ?>
                    </h4>
                    <label>Birthday</label>
                     
                    <button type="button" class="btn pstpblc" data-bs-toggle="modal" data-bs-target="#audience_modal"  onclick="profilePrivacy(5)">
                        <span class="icon">
                            <img src="<?php echo getPrivacyIcon($users['isDOBPrivacy']); ?>" title="<?php echo getPrivacyToolTip($users['isDOBPrivacy']); ?>" id="dobPrivacy" alt="">
                        </span>                        
                    </button>
           
                </div>
                   </div>
                     <?php }else if($user_id!=$data['userId'] && (($users['isPrivate']==0 && $users['isDOBPrivacy']==1) || ($users['isPrivate']==0 && $users['isFriend']==1 && $users['isDOBPrivacy']==2) || ($users['isPrivate']==1 && $users['isFriend']==1 && ($users['isDOBPrivacy']==1 || $users['isDOBPrivacy']==2)))){ ?> 
                         <div class="fgwi">
                <div class="icon">
                    <i class="fa fa-birthday-cake"></i>
                </div>
                        <div class="form-group">
                        <h4>
                            <?php 
                            if(isset($users['dob'])){
                                 echo date("F d, Y", strtotime($users['dob']));
                            }
                            ?>
                        </h4>
                    <label>Birthday</label>
                    </div>
                    </div>
                     <?php } ?>

            
            <?php if(!empty($users['know'])){  ?>
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-question-answer-line"></i>
                </div>

                <div class="form-group">
                    <h4>
                        <?php echo !empty($users['know'])?$users['know']:""; ?>
                    </h4>
                    <label>Know</label>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- <div class="section_rept">
        <div class="head">
            <h3>Categories</h3>
			<?//php if($user_id == $data['userId']){  ?>
			<?//php if(!empty($users['categories_name'])){ ?>     
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#adedtcategoriesmdl"><i class="ri-edit-2-fill"></i> Edit</button>
			<//?php } ?>
			<//?php } ?>
        </div>
		<?//php if($user_id == $data['userId']){  ?>
		<//?php if(empty($users['categories_name'])){ ?>
        <div class="addlnkscl">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#adedtcategoriesmdl"><i class="ri-add-circle-line"></i>Add Categories</button>
        </div>
		<?//php }  ?>
		<?//php } ?>
		<?//php if(!empty($users['categories_name'])){ ?>
        <div class="group_form">
            <div class="fgwi">
                <div class="icon">
                    <i class="ri-dashboard-fill"></i>
                </div>
                <div class="form-group">
                    <h4><?//php echo !empty($users['categories_name'])?$users['categories_name']:""; ?></h4>
                    <label>Categories</label>
                </div>
            </div>
        </div>
		<?//php } ?>
    </div> -->
</div>
<!-- Account Information Modal -->
<div class="modal fade abut_editfrom" id="accountinformation" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <form id="editAccoutInformation" method="post">
                    <div class="aef_bx">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                value="<?php echo isset($users['first_name'])?$users['first_name']:''; ?>" class="form-control"
                                placeholder="Enter First Name">
                            <span id="err_first_name" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                value="<?php echo isset($users['last_name'])?$users['last_name']:''; ?>" class="form-control"
                                placeholder="Enter Last Name">
                            <span id="err_last_name" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name"
                                value="<?php echo !empty($users['brand_name'])?$users['brand_name']:""?>"
                                class="form-control" placeholder="Enter Brand Name">
                            <span id="err_brand_name" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Brand Website</label>
                            <input type="text" name="brand_website"
                                value="<?php echo !empty($users['brand_website'])?$users['brand_website']:""?>"
                                id="brand_website" class="form-control" placeholder="Enter Brand Website">
                        </div>
                        <div class="form-group">
                            <label for="">Account Type</label>
                            
                          <select class="form-control" id="accountType" name="accountType">
                            <option value="">Select</option>
                            <option value="0" <?php echo ($users['isPrivate']==0)?'selected':'' ; ?>>Public</option>
                            <option value="1" <?php echo ($users['isPrivate']==1)?'selected':'' ; ?>>Private</option>
                              
                          </select>
                        </div>
                        <div class="button-group">
                            <button type="button" class="btn" onclick="editAccoutInformation()">Save</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                aria-bs-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Address Modal -->
<div class="modal fade abut_editfrom" id="addressmodal" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Address Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <form id="update_address" method="post">
                    <div class="aef_bx">
                        <div class="form-group">
                            <label for="">Address Line 1</label>
                            <input type="text" id="address_line_1" name="address_line_1"
                                value="<?php echo !empty($users['address_line_1'])?$users['address_line_1']:""; ?>"
                                class="form-control" placeholder="Enter Address Line 1">
                            <span id="err_address_line_1" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address Line 2</label>
                            <input type="text" id="address_line_2" name="address_line_2"
                                value="<?php echo !empty($users['address_line_2'])?$users['address_line_2']:""; ?>"
                                class="form-control" placeholder="Enter Address Line 2">
                            <span id="err_address_line_2" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            <select name="edit_country" id="edit_country" class="form-control">
                                <option value="">Select</option>
                                <?php 
                                if(isset($country) && !empty($country)){ 
                                foreach($country as $countrys){   ?>
                                <option value="<?php echo $countrys->name; ?>" <?php if(isset($users['country']) && $users['country']==$countrys->name){ ?> selected='selected' <?php } ?>>
                                    <?php echo $countrys->name;  ?>
                                </option>
                                <?php } } ?>
                            </select>
                            <span id="err_edit_country" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" id="edit_city" name="edit_city" value="<?php echo isset($users['city'])?$users['city']:'' ;  ?>"
                                class="form-control" placeholder="Enter City">
                            <span id="err_edit_city" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Zip/Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code"
                                value="<?php echo !empty($users['zip_code'])?$users['zip_code']:""; ?>"
                                class="form-control" placeholder="Enter Zip/Postal Code">
                            <span id="err_postal_code" class="err" style="color:red"></span>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn" onclick="updateAddress()">Save</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                aria-bs-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Websites and social links Modal -->
<div class="modal fade abut_editfrom" id="websoclmodal" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Websites and social links</h5>
                
                <button type="button" onClick="cancelMediaUrl();" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <form id="saveMediaUrl" method="post">
                    <div class="aefws_bx">
                        <!-- <div class="form-group w-75">
                        <label for="">Website</label>
                        <input type="text" class="form-control" placeholder="Enter Website URL">
                    </div> -->
                        <!-- <div class="mdl_head">
                        <h3>Social links</h3>
                        <button type="button" class="btn"><i class="ri-add-circle-line"></i>Add Website and
                            Social</button>
                    </div> -->
                        <div class="sclgrp_rpt">
                            <div class="form-group">
                                <label for="">Media</label>
                                <input type="text" name="Instagram" id="Instagram" value="Instagram"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Media URL</label>

                                <input type="text"
                                    value="<?php echo  !empty($users['instagram'])? $users['instagram']:""; ?>"
                                    name="instagram_url" id="instagram_url" class="form-control"
                                    placeholder="Enter Userid">
                            </div>
                        </div>
                        <div class="sclgrp_rpt">
                            <div class="form-group">
                                <label for="">Media</label>
                                <input type="text" name="snapchat" id="snapchat" value="snapchat" class="form-control"
                                    readonly>

                            </div>
                            <div class="form-group">
                                <label for="">Media URL</label>
                                <input type="text"
                                    value="<?php echo !empty($users['snapchat'])? $users['snapchat']:""; ?>"
                                    id="snapchat_url" name="snapchat_url" class="form-control"
                                    placeholder="Enter Userid">
                            </div>
                        </div>
                        <div class="sclgrp_rpt">
                            <div class="form-group">
                                <label for="">Media</label>.
                                <input type="text" name="youtube" id="youtube" value="youtube" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Media URL</label>
                                <input type="text" name="you_tube_url" id="you_tube_url"
                                    value="<?php echo  !empty($users['youtube'])? $users['youtube']:""; ?>"
                                    class="form-control" placeholder="Enter Userid">
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn" onclick="saveMediaUrl();">Save</button>
                            <button type="button" onclick="cancelMediaUrl();" class="btn" data-bs-dismiss="modal"
                                aria-bs-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Basic Info Modal -->
<div class="modal fade abut_editfrom" id="basicinfomdl" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Basic Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                <form id="profile_basic_info" method="post">
                    <div class="aef_bx">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="basic_gender" id="basic_gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php echo (isset($users['gender']) && $users['gender']=='Male') ? ' selected="selected"' : ''
                                    ;?>>Male</option>
                                <option value="Female" <?php echo (isset($users['gender']) &&  $users['gender']=='Female' )? ' selected="selected"'
                                    : '' ;?>>Female</option>
                            </select>
                            <span id="err_basic_gender" class="err" style="color:red"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Birthday</label>
                            <input type="date" name="dob" id="dob" value="<?php echo  !empty($users['dob'])? date("Y-m-d", strtotime($users['dob'])):"";?>" class="form-control" placeholder="Enter
                            BirthDay" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Languages</label>
                            <input type="text" name="know" id="know"
                                value="<?php echo !empty($users['know'])?$users['know']:""; ?>" class="form-control"
                                placeholder="Enter Languages">
                            <span id="err_know" class="err" style="color:red"></span>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn" onclick="updateBasicProfile()">Save</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                aria-bs-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Basic Info Modal -->
<div class="modal fade abut_editfrom" id="adedtcategoriesmdl" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add/Edit Categories</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <!--<div class="modal-body">
                <form id="add_category" method="post">
                <div class="aef_bx">
                    <div class="form-group">
                        <label for="">Categories</label>
						<?//php $cat=explode(",",$users['category']); ?>
                        <select name="category[]" id="category" class="form-control" multiple="multiple">
                            <option value="">Select Categories</option>
						<//?php 
								foreach($categories as $categ){    ?>
                                <//?php if(in_array($categ->id,$cat)){ ?> 
                                <option value="<//?php echo $categ->id; ?>"selected ><//?php echo $categ->name;  ?></option>
								<//?php }else{ ?>
                                <option value="<//?php echo $categ->id; ?>"><//?php echo $categ->name;  ?></option>
                               <?//php } ?>
                                <?//php } ?>  
                        </select>  
						<span id="err_category" class="err" style="color:red"></span>
                    </div>
                    <div class="button-group">
                        <button type="button" class="btn" onclick="addCategory();">Save</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
                    </div>
					
                </div>
               </form>  
            </div> -->
        </div>
    </div>
</div>

<!-- test -->
<div class="modal fade pstaudemdl" id="audience_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle"
    aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Privacy</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body" id="profilePivacyModal">
                
            </div>
        </div>
    </div>
</div>

<!-- ss -->
  
<script>

function profilePrivacy(type=0){
      ajaxCsrf();
     $.ajax({
            type: "POST",
            url: baseUrl + '/profilePrivacy',
            data: {type:type},           
            beforeSend: function () {
                
            },
            success: function (res) {                
               $('#profilePivacyModal').html(res);

            }
        });
}

function saveUserProfilePrivacy($type){                   
                    $('#loader_spineer').show();
                    var formData = new FormData($('#profilePrivacy')[0]);
                    formData.append('type',$type);

                    ajaxCsrf();
                    $.ajax({
                    type: "POST",
                    url: baseUrl + '/saveProfilePrivacy',
                    data: formData, 
                    dataType: 'json',
                    contentType: false,
                    processData: false,         
                    beforeSend: function () {

                    },
                    success: function(res) { 
                    //     console.log(res);
                    // alert(res.data.privacyIcon) ;
                    if(res.data.privacyType==1){
                        $('#addressPrivacy').attr('src',res.data.privacyIcon);
                        $('#addressPrivacy').attr('title',res.data.title);
                    }else if(res.data.privacyType==2){
                        $('#contactPrivacy').attr('src',res.data.privacyIcon);
                         $('#contactPrivacy').attr('title',res.data.title);
                    }else if(res.data.privacyType==3){
                        $('#emailPrivacy').attr('src',res.data.privacyIcon);
                         $('#emailPrivacy').attr('title',res.data.title);
                    }else if(res.data.privacyType==4){
                         $('#websitePrivacy').attr('src',res.data.privacyIcon);
                          $('#websitePrivacy').attr('title',res.data.title);
                    }else if(res.data.privacyType==5){
                        $('#dobPrivacy').attr('src',res.data.privacyIcon);
                         $('#dobPrivacy').attr('title',res.data.title);
                    }

                    $('#loader_spineer').hide();              
                    $("#profie_privacy_succ").show();
                      setTimeout(function () {
                        $("#profie_privacy_succ").hide();
                      }, 2000);

                    }
                    });
    }




  function cancelMediaUrl(){
	 $('#saveMediaUrl')[0].reset();  
     $('#websoclmodal').modal('hide');   
  }
    function saveMediaUrl() {
        ajaxCsrf();
        $('.err').html('');
        $('#loader_spineer').show(); 
        var user_id = '<?php echo $data['userId']; ?>';
        var formData = new FormData($('#saveMediaUrl')[0]);
        $.ajax({
            type: "POST",
            url: baseUrl + '/saveMediaUrl',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                //ajax_before();
            },
            success: function (res) {
                //ajax_success() ;
                $('#loader_spineer').hide(); 
                if (res == 1) {
                    $('#saveMediaUrl')[0].reset();
                    $('#websoclmodal').modal('hide');
                    myabout(user_id);
                    $("#about_info_id").show();
					$(".section_rept").load(location.href + " .section_rept");
                    setTimeout(function () {
                        $("#about_info_id").hide();
                    }, 2000);
                } else {
                    statusMesage(html.message, 'error');
                }

            }
        });

		
    }

    function addCategory() {

        ajaxCsrf();
        var category = $('#category').val();
        var user_id = '<?php echo $data['userId']; ?>';
        //alert(user_id);
        $('.err').html('');
        if (category == '') {
            $('#err_category').html('Please Select cattegory');
        } else {
            var formData = new FormData($('#add_category')[0]);
            $.ajax({
                type: "POST",
                url: baseUrl + '/addCategory',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    //ajax_before();
                },
                success: function (res) {
                    //ajax_success() ;
                    if (res == 1) {
                        $('#add_category')[0].reset();
                        $('#adedtcategoriesmdl').modal('hide');
                        myabout(user_id);
                        $("#about_info_id").show();
                        setTimeout(function () {
                            $("#about_info_id").hide();
                        }, 2000);
                    } else {
                        statusMesage(html.message, 'error');
                    }

                }
            });

        }

    }
    function updateBasicProfile() {
        ajaxCsrf();
        var gender = $('#basic_gender').val();
        var know = $('#know').val();
        var dob = $('#dob').val();
        var user_id = '<?php echo $data['userId']; ?>';
        //alert(user_id);
        $('.err').html('');
        if (gender == '') {
            $('#err_basic_gender').html('Please Select gender');
        } else if (know == '') {
            $('#err_know').html('Please enter languages');
        } else if (dob == '') {
            $('#err_dob').html('Please select Date of birth');
        } else {
            var formData = new FormData($('#profile_basic_info')[0]);
            $.ajax({
                type: "POST",
                url: baseUrl + '/updateBasicProfile',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    //ajax_before();
                },
                success: function (res) {
                    //ajax_success() ;
                    if (res == 1) {
                        $('#profile_basic_info')[0].reset();
                        $('#basicinfomdl').modal('hide');
                        myabout(user_id);
                        $("#about_info_id").show();
                        setTimeout(function () {
                            $("#about_info_id").hide();
                        }, 2000);
                    } else {
                        statusMesage(html.message, 'error');
                    }

                }
            });

        }
    }
    function editAccoutInformation() {
        ajaxCsrf();
        var user_id = '<?php echo $data['userId']; ?>';
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var brand_name = $('#brand_name').val();
        var brand_website = $('#brand_website').val();
        $('.err').html('');
        if (first_name == '') {
            $('#err_first_name').html('Please enter first name');
        } else if (last_name == '') {
            $('#err_last_name').html('Please enter last name');
        } else {
            var formData = new FormData($('#editAccoutInformation')[0]);
            $.ajax({
                type: "POST",
                url: baseUrl + '/updateAccountInfo',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loader_spineer').show();
                },
                success: function (res) {
                    //ajax_success() ;
                    if (res == 1) {
                        $('#editAccoutInformation')[0].reset();
                        $('#accountinformation').modal('hide');
                        $('#loader_spineer').hide();
                        myabout(user_id);
                        $("#about_info_id").show();
                        setTimeout(function () {
                            $("#about_info_id").hide();
                        }, 2000);
                    } else {
                        statusMesage(html.message, 'error');
                    }

                }
            });

        }
    }

    function updateAddress() {
        ajaxCsrf();
        var user_id = '<?php echo $data['userId']; ?>';
        var address_line_1 = $('#address_line_1').val();
        var address_line_2 = $('#address_line_2').val();
        var edit_country = $('#edit_country').val();
        var edit_city = $('#edit_city').val();
        var postal_code = $('#postal_code').val();
        $('.err').html('');
        if (address_line_1 == '') {
            $('#err_address_line_1').html('Please enter address line 1.');
        } else if (edit_country == '') {
            $('#err_edit_country').html('Please select country');
        } else if (edit_city == '') {
            $('#err_edit_city').html('Please enter city');
        } else if (postal_code == '') {
            $('#err_postal_code').html('Please enter postal code');
        } else {
            var formData = new FormData($('#update_address')[0]);
            $.ajax({
                type: "POST",
                url: baseUrl + '/updateAddress',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    //ajax_before();
                },
                success: function (res) {
                    //ajax_success() ;
                    if (res == 1) {
                        $('#update_address')[0].reset();
                        $('#addressmodal').modal('hide');
                        myabout(user_id);
                        $("#about_info_id").show();
                        setTimeout(function () {
                            $("#about_info_id").hide();
                        }, 2000);



                    } else {
                        statusMesage(html.message, 'error');
                    }

                }
            });

        }
    }
</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Profile/about.blade.php ENDPATH**/ ?>