<div class="rgt_usrinfo">
     <?php // echo "<pre>";print_r($users); 
    
   

      ?>
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

                <h3><span><img src="{{URL::to('/public/website')}}/images/map-marker-alt.svg" alt=""></span><span><?php echo (isset($users['country']) && $users['country']!='')?$users['country']:'---' ?>, <?php echo (isset($users['city']) && $users['city']!='')?$users['city']:'---' ; ?></span></h3>
                </div>
			<?php } ?>
                
            
        </div>
    </div>



<script>  


</script>
