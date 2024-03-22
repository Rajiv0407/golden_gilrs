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
    <li> <a href="#">Privacy</a></li>
    <li><a href="#">Teams</a></li>
    <li><a href="#">Advertising</a></li>
    <li><a href="#">Ad Choices</a></li>
    <li><a href="#">Cookies</a></li>
    <li><a href="#">More</a></li>
    <li>GoldenGirls © 2023</li>
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

        </div>
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
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
          <?php if (request()->segment(1) == 'home' || request()->segment(1) == 'profile' || request()->segment(1) == 'network' || request()->segment(1) == 'goodies' || request()->segment(1) == 'life_style' ) { ?>
            <div class="sell_box muserinfobx"><?php echo $__env->make('website.user_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

          <?php }  ?>
        </div>

      </div>
    </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\golden\resources\views/includes/website/footer.blade.php ENDPATH**/ ?>