<?php  $mobileDeduct=isMobileDev();  ?>
<?php 
///echo session()->put('defaultCountry', array('image'=>$imgUrl,'value'=>$value,'name'=>$countryName));
    $defaultCountry=session()->get('defaultCountry');

    $countryImg=isset($defaultCountry['image'])?$defaultCountry['image']:'' ;
    $countryValue = isset($defaultCountry['value'])?$defaultCountry['value']:'' ;
    $countryName_ = isset($defaultCountry['name'])?$defaultCountry['name']:'' ;

    $flag=0 ;

    if((request()->segment(1)=='goodies') || (request()->segment(1)=='life_style')){ 
    $flag=1 ;

    } 


 ?>



 <script type="text/javascript">
   $(document).ready(function(){  
       $('.btn-select').html('<li><img src="<?php echo $countryImg ; ?>" alt="" value="<?php echo $countryValue ; ?>"/><span><?php echo $countryName_ ; ?></span></li>').attr('value', <?php echo $countryValue ; ?>);
   });
 
 function ggCountry(countryName,value,imgUrl){   
     
    var flag_ ='<?php echo $flag ; ?>' ;
    var gc=$('#gg_country').val() ;
    $('#ggCountrId').text(countryName);
       ajaxCsrf();
      $.ajax({
        type: "post",
        url: baseUrl + '/updateCountrySession',
        data:{'countryName':countryName,'value':value,'imgUrl':imgUrl},
        success: function (response) {
          if(flag_==1){
             location.reload();
          }
        }
    });

}

 </script>


<div class="ft_sect">
  <ul>
    <?php
      $isSendMail = config('constants.isSendMail');
      // if($isSendMail!=1){ 
        ?>
         <li> <a href="{{ URL('/').'/aboutus'}}" target="_blank">About Us</a></li>
          <li> <a href="{{ URL('/').'/contactus'}}" target="_blank">Contact Us</a></li>
         <li> <a href="{{ URL('/').'/privacyPolicy'}}" target="_blank">Privacy</a></li>
    <li><a href="{{ URL('/').'/termCondition'}}" target="_blank">Teams & Conditions</a></li>
    <li><a href="{{ URL('/').'/eventTermsServices'}}" target="_blank">Event Terms Services</a></li>
    <li><a href="{{ URL('/').'/eventPolicies'}}" target="_blank">Event Policies</a></li>
    <li><a href="{{ URL('/').'/membershipsGuidlines'}}" target="_blank">Membership Guidlines</a></li>
     <?php  //} else { ?> 
      <!--   <li> <a href="javascript:void(0);">Privacy</a></li>
    <li><a href="javascript:void(0);">Teams & Conditions</a></li>
    <li><a href="javascript:void(0);">Event Terms Services</a></li>
    <li><a href="javascript:void(0);">Event Policies</a></li>
    <li><a href="javascript:void(0);">Membership Guidlines</a></li> -->

    <?php //} ?>
   
   <!--  <li><a href="#">More</a></li> -->
    <li>GoldenGirls © 2024</li>
  </ul>
</div>
<div id="loader_spineer" style="display:none;">
  <div class="loader_bx">
    <span class="loader_inner"> </span>
  </div>
</div>

<div class="modal fade custom_modal " id="Serach_post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal_search">

           <?php if($mobileDeduct){ ?>
          <form id="search_data" action="javascript:void(0);" method="post">
            <div class="search_li">
              <div class="form-group form-control-wrap search_list ">
                <div class="head_bx">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ri-arrow-left-line"></i></button>
                  <div class="frm_grp">
                    <input type="text" name="search_user" id="search_user" class="form-control" placeholder="Search">
                    <span id="err_search" class="err" style="color:red"></span>
                  </div>
                </div>


                <div class="search_tags">
                  <div class="">
                    <div class="invit_inner" id="user_search_inner">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>
        <div id="search_loader_spineer" style="display:none;">
  <div class="loader_bx">
    <span class="loader_inner"> </span>
  </div>
</div>
        </div>
      </div>

    </div>
  </div>
</div>


<div class="modal fade basic_infofrom" id="editbasicinfo" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Basic Information</h5>  
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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

<div class="modal fade edit_post_modal about_modal" id="aboutdetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="user_info_modal">
               <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
                </button>
          <?php if (request()->segment(1) == 'home' || request()->segment(1) == 'profile' || request()->segment(1) == 'network' || request()->segment(1) == 'goodies' || request()->segment(1) == 'life_style' ) { ?>

            <div class="sell_box muserinfobx">@include('website.user_info')</div>

          <?php }else if($mobileDeduct && (request()->segment(1) == 'myevent_info' || request()->segment(1) == 'marches_info' || request()->segment(1) == 'message' || request()->segment(1) == 'group')){ ?>
             <div class="sell_box muserinfobx">@include('website.user_info')</div>
          <?php }  ?>
        </div>

      </div>
    </div>
  </div>
</div>