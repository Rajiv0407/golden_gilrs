<div class="rgt_usrinfo">
     <?php //echo "<pre>";print_r($users);die;  ?>
        <div class="head">
            <h3>About Info</h3>
            <?php 
             $data=session()->get('user_session');
             if(isset($data['userId']) && isset($users['id']) && $data['userId']==$users['id']){ ?>
                 <a class="ank_btn" data-bs-toggle="modal" data-bs-target="#editbasicinfo" href="javascript:void(0);"><i class="ri-edit-2-line"></i> edit</a>
             <?php }
             ?>
           
        </div>   
        
        <div class="about_info">

		     <?php if(!empty($users['self_des'])){ ?>
                <div class="ai_cell">
                    <p><?php echo  $users['self_des'];  ?></p>
                </div>
			 <?php } ?>   

            <?php if(!empty($users['dob'])){ ?>
                <div class="ai_cell">
                    <h4>
                        <?php /* ?>
                        <span><?php 

                    // $dob = new DateTime($users['dob']);  
                    // $today = new DateTime('today');
                    // $year = $dob->diff($today)->y;
                    // echo $year ;
                    //echo (date('Y') - date('Y',strtotime($users['dob']))); ?> year</span><span>(<?php echo  date('M d, Y', strtotime($users['dob'])); ?>)</span>
                    <?php */ ?>
                    <span><?php echo  date('M d, Y', strtotime($users['dob'])); ?> </span>
                    </h4>
                </div>
            <?php } ?>

          

            <div class="ai_cell">
                <ul>
                    <?php  if(isset($data['userId']) && isset($users['id']) && $data['userId']==$users['id']){ ?> 


                    <?php //if(!empty($users['height']) && $users['id']!=$data['user_id']){ ?>
                    <li><span>Height:</span><span><?php echo  (isset($users['height']) && $users['height']!='')?$users['height']:'---' ;  ?></span></li>
                    <?php //} ?> 

                    
                    <?php //if(!empty($users['weight'])){ ?>
                    <li><span>Weight:</span><span><?php echo  (isset($users['weight']) && $users['weight']!='')?$users['weight']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['waist'])){ ?>
                    <li><span>Waist:</span><span><?php echo  (isset($users['waist']) && $users['waist']!='')?$users['waist']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['waist'])){ ?>
                    <li><span>Breast:</span><span><?php echo  (isset($users['bust']) && $users['bust']!='')?$users['bust']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['hip_size'])){ ?>
                    <li><span>Hips:</span><span><?php echo  (isset($users['hip_size']) && $users['hip_size'])?$users['hip_size']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['eye_color'])){ ?>
                    <li><span>Eye Color:</span><span><?php echo  (isset($users['eye_color']) && $users['eye_color']!='')?$users['eye_color']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['hair_color'])){ ?>
                    <li><span>Hair Color:</span><span><?php echo  (isset($users['hair_color']) && $users['hair_color']!='')?$users['hair_color']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['hair_style'])){ ?>
                    <li><span>Hair Style:</span><span><?php echo (isset($users['hair_style']) && $users['hair_style']!='')?$users['hair_style']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['smoking'])){ ?>
                    <li><span>Smoking:</span><span><?php echo  (isset($users['smoking']) && $users['smoking']!='')?$users['smoking']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['interests'])){ ?>
                    <li><span>Interests:</span><span><?php echo  (isset($users['interests']) && $users['interests']!='')?$users['interests']:'---';  ?></span></li>
                    <?php //} ?> 
                    <?php //if(!empty($users['marital_status'])){ ?>
                    <li><span>Marital Status:</span><span><?php echo  (isset($users['marital_status']) && $users['marital_status']!='')?$users['marital_status']:'---';  ?></span></li>
                    <?php //} ?>
                    <?php //if(!empty($users['know'])){ ?>
                    <li><span>Language:</span><span><?php echo  (isset($users['know']) && $users['know']!='')?$users['know']:'---';  ?></span></li>
                    <?php //} ?>	

                    <?php }else{ ?> 


                    <?php if(!empty($users['height'])){ ?>
                    <li><span>Height:</span><span><?php echo  (isset($users['height']) && $users['height']!='')?$users['height']:'---' ;  ?></span></li>
                    <?php } ?> 

                    
                    <?php if(!empty($users['weight'])){ ?>
                    <li><span>Weight:</span><span><?php echo  (isset($users['weight']) && $users['weight']!='')?$users['weight']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['waist'])){ ?>
                    <li><span>Waist:</span><span><?php echo  (isset($users['waist']) && $users['waist']!='')?$users['waist']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['waist'])){ ?>
                    <li><span>Breast:</span><span><?php echo  (isset($users['bust']) && $users['bust']!='')?$users['bust']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['hip_size'])){ ?>
                    <li><span>Hips:</span><span><?php echo  (isset($users['hip_size']) && $users['hip_size'])?$users['hip_size']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['eye_color'])){ ?>
                    <li><span>Eye Color:</span><span><?php echo  (isset($users['eye_color']) && $users['eye_color']!='')?$users['eye_color']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['hair_color'])){ ?>
                    <li><span>Hair Color:</span><span><?php echo  (isset($users['hair_color']) && $users['hair_color']!='')?$users['hair_color']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['hair_style'])){ ?>
                    <li><span>Hair Style:</span><span><?php echo (isset($users['hair_style']) && $users['hair_style']!='')?$users['hair_style']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['smoking'])){ ?>
                    <li><span>Smoking:</span><span><?php echo  (isset($users['smoking']) && $users['smoking']!='')?$users['smoking']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['interests'])){ ?>
                    <li><span>Interests:</span><span><?php echo  (isset($users['interests']) && $users['interests']!='')?$users['interests']:'---';  ?></span></li>
                    <?php } ?> 
                    <?php if(!empty($users['marital_status'])){ ?>
                    <li><span>Marital Status:</span><span><?php echo  (isset($users['marital_status']) && $users['marital_status']!='')?$users['marital_status']:'---';  ?></span></li>
                    <?php } ?>
                    <?php if(!empty($users['know'])){ ?>
                    <li><span>Language:</span><span><?php echo  (isset($users['know']) && $users['know']!='')?$users['know']:'---';  ?></span></li>
                    <?php } ?>
                    <?php } ?>			
                </ul>
            </div>

            <div class="Follow_sect">
                <ul>
                        <li><span>Followers</span><span><?php echo (isset($users['followers_count']) && $users['followers_count']!='')?$users['followers_count']:0; ?></span></li>

                <li><span>Followings</span><span><?php echo (isset($users['following_count']) && $users['following_count']!='')?$users['following_count']:0; ?></span></li>
                </ul>
            </div>
            
			<?php if(!empty($users['country'])){ ?> 
                <div class="loc_sect">

                <h3><span><img src="<?php echo e(URL::to('/public/website')); ?>/images/map-marker-alt.svg" alt=""></span><span><?php echo (isset($users['country']) && $users['country']!='')?$users['country']:'---' ?>, <?php echo (isset($users['city']) && $users['city']!='')?$users['city']:'---' ; ?></span></h3>
                </div>
			<?php } ?>
                
            
        </div>
    </div>


<div class="modal fade basic_infofrom" id="editbasicinfo" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Basic Information</h5>  
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body">
                
    <form id="update_profile" action="javascript:void(0);" method="post">
                <div class="aef_bx">
                    <div class="form-group">
                       <label for="">Hair Color</label>
                            <input type="text" name="hair_color" id="hair_color" value="<?php echo !empty($users['hair_color'])?$users['hair_color']:""; ?>" class="form-control" placeholder="Hair Color">
                            <span id="error_edit_hair_color" class="err"></span>
                    </div>
                    <div class="form-group">
                      <label for="">Waist</label>
                            <input type="number" name="waist" id="waist" value="<?php echo !empty($users['waist'])?$users['waist']:""; ?>" class="form-control" placeholder="Waist" maxlength="2">
                            <span id="error_edit_waist" class="err"></span>
                    </div>
                    <div class="form-group">
                       <label for="">Height(CM)</label>  
                          <input type="number" name="height" id="height" value="<?php echo !empty($users['height'])?$users['height']:""; ?>" class="form-control" placeholder="Height in Centimeter">
                          <span id="error_edit_height" class="err"></span>
                    </div>
                    <div class="form-group">
                       <label for="">Weight(Kg)</label>
                          <input type="number" name="weight" id="weight" value="<?php echo !empty($users['weight'])?$users['weight']:""; ?>" class="form-control" placeholder="Weight">
                          <span id="error_edit_weight" class="err"></span>
                    </div>
                     <div class="form-group">
                      <label for="">Hips(CM)</label>
                      <input type="number" name="hips" id="hips" value="<?php echo !empty($users['hip_size'])?$users['hip_size']:""; ?>" class="form-control" placeholder="Hips">
                      <span id="error_edit_hips" class="err"></span>
                    </div>
                     <div class="form-group">
                        <label for="">Hair Style</label>
                            <input type="text" name="hair_style" id="hair_style" value="<?php echo !empty($users['hair_style'])?$users['hair_style']:""; ?>" class="form-control" placeholder="Hair Style">
                            <span id="error_edit_hair_style" class="err"></span>
                    </div>
                      <div class="form-group">
                       <label for="">Bust (Inches)</label>
                        <input type="text" name="bust" id="bust" value="<?php echo !empty($users['bust'])?$users['bust']:""; ?>" class="form-control" placeholder="Enter Bust (Inches)">
                        <span id="error_edit_bust" class="err"></span>
                    </div>
                     <div class="form-group">
                      <label for="">Eye Color</label>
                        <input type="text" name="eye_color" id="eye_color" value="<?php echo !empty($users['eye_color'])?$users['eye_color']:""; ?>" class="form-control" placeholder="Eye Color">
                        <span id="error_edit_eye_color" class="err"></span>
                    </div>
                      <div class="form-group">
                      <label for="">Smoking</label>
                        <select name="smoking" id="smoking" class="form-control" <?php echo !empty($users['smoking'])?$users['smoking']:""; ?>>
                              <option value="">Select</option>
                            <option value="Yes" <?php echo (isset($users['smoking']) && $users['smoking']=='Yes') ? ' selected="selected"' : ''
                                    ;?>>Yes</option>
                            <option value="No" <?php echo (isset($users['smoking']) && $users['smoking']=='No') ? ' selected="selected"' : ''
                                    ;?>>No</option>  
                        </select>
                        <span id="error_edit_smoking" class="err"></span>
                    </div>
                     <div class="form-group">
                      <label for="">Language</label>
                    <input type="text" name="know" id="know" value="<?php echo !empty($users['know'])?$users['know']:""; ?>" class="form-control" placeholder="Language">
                    <span id="error_edit_know" class="err"></span>
                    </div>
                      <div class="form-group">
                      <label for="">Interest</label>
                    <input type="text" name="interests" id="interests" value="<?php echo !empty($users['interests'])?$users['interests']:""; ?>" class="form-control" placeholder="Interest">
                    <span id="error_edit_interests" class="err"></span>
                    </div>
                     <div class="form-group">
                       <label for="">Marital Status</label>
                    <!-- <input type="text" name="marital_status" id="marital_status" value="<?php echo !empty($users['marital_status'])?$users['marital_status']:""; ?>" class="form-control" placeholder="Marital Status"> -->
                    <select name="marital_status" id="marital_status" class="form-control">  <option value="">Select</option>
                        <option value="Single" <?php echo (isset($users['marital_status']) && $users['marital_status']=='Single') ? ' selected="selected"' : ''
                                    ;?>>Single</option>
                        <option value="Married" <?php echo (isset($users['marital_status']) && $users['marital_status']=='Married') ? ' selected="selected"' : ''
                                    ;?>>Married</option>
                    </select>
                    <span id="error_edit_marital_status" class="err"></span>
                    </div>
                    
                    <div class="form-group long_text">
                        <label for="">About Info</label>
                        <textarea type="text" name="about_self" id="about_self" class="form-control" placeholder="Tell people about yourself" cols="12" rows="5"><?php echo !empty($users['self_des'])? strip_tags($users['self_des']):""; ?></textarea>
                        <span id="error_edit_about" class="err"></span>
                    </div>   
                    <div class="button-group">
                        <button type="button" class="btn" onclick="update_profile()">Save</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
                    </div>
                    </div>
                    
                    </form>

               
                </div>

            </div>
        </div>
    </div>
<script>  
function update_profile(){   
		var hair_color = $('#hair_color').val();
		var waist = $('#waist').val();
		var height = $('#height').val();
		var bust = $('#bust').val();
		var weight = $('#weight').val();
		var hips = $('#hips').val();
		var hair_style = $('#hair_style').val();
		var eye_color = $('#eye_color').val();
		var smoking = $('#smoking').val();
		var interests = $('#interests').val();
		var marital_status = $('#marital_status').val();
		var about_self = $('#about_self').val();
		
        // console.log($.trim(waist));
        // $('.err').html('');

        // if(hair_color==''){
        //     $('#error_edit_hair_color').html('Please enter hair color') ;
        // }
        // else if(waist==''){
        //     $('#error_edit_waist').html('Please enter waist size') ;
        // }
        // else if(height==''){
        //     $('#error_edit_height').html('Please enter height') ;
        // }
        // else if(bust== ''){
        //     $('#error_edit_bust').html('Please enter Bust (Inches)') ;
        // }
        // else if(weight== ''){
        //     $('#error_edit_weight').html('Please enter weight') ;
        // }
        // else if(hips== ''){
        //     $('#error_edit_hips').html('Please enter hips size') ;
        // }
        // else if(hair_style== ''){
        //     $('#error_edit_hair_style').html('Please enter hair style') ;
        // }
        // else if(eye_color== ''){
        //     $('#error_edit_eye_color').html('Please enter eye color') ;
        // }
        // else if(smoking== ''){
        //     $('#error_edit_smoking').html('Please select smoking') ;
        // }
        // else if(interests== ''){
        //     $('#error_edit_interests').html('Please enter interests') ;
        // }
        // else if(marital_status== ''){
        //     $('#error_edit_marital_status').html('Please enter marital status');
        // }
        // else if(about_self== ''){
        //     $('#error_edit_about').html('Please enter about');
        // }
        // else{
               //var formData = $('#profile_forms').serialize();
                var formData=new FormData($('#update_profile')[0]);				
                 ajaxCsrf();
        
                 $.ajax({
            type:"post",
            url:baseUrl+'/update_profile',
            data:formData,
            contentType:false,
            processData:false,	
            dataType:'json',			
            beforeSend:function()
            {
                 //ajax_before();
            },
            success:function(res)
            {
                // ajax_success() ;
            if(res){
				//$(".rgt_usrinfo").load(".rgt_usrinfo");
				$('#editbasicinfo').modal('hide');
                $('#basic_profile_info').show();
				$(".right_menu").load(location.href + " .right_menu");
                setTimeout(function() {
				   $("#basic_profile_info").hide();  
				}, 2000);  				
            }else{
               statusMesage('something went wrong','error');
            }  
            }

            });
        //   }
    }
function refreshDiv(){
		 $("#web_container").load(location.href + " #web_container");
	  } 

</script>
<?php /**PATH C:\xampp\htdocs\golden\resources\views/website/user_info.blade.php ENDPATH**/ ?>