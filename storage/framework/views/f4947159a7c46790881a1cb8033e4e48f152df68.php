
<?php $__env->startSection('content'); ?>
<div class="sell_box">
  <div class="head">
    <h3>Matches</h3>
  </div>

  <?php if(count($maches_friend) > 0){ ?>
  <div class="Marche_wrapp">
    <div class="Marche_list">
      <?php 


      foreach($maches_friend as $maches_friends){ //echo "<pre>";print_r($maches_friends); ?>
      <div class="card_bx">
        <a href="<?php echo e(URL('/').'/profile/'.$maches_friends->id); ?>" > 
        <div class="img_bx">
          <img src="<?php echo $maches_friends->image; ?>" alt="">
        </div>
        <div class="cont_marche">
          <h3>
            <?php            

             if($maches_friends->name!=''){
              echo $maches_friends->name ;
            }
            
            ?>
           
          </h3>
          </div>
          </a>
          <h4><span>
              <svg xmlns="http://www.w3.org/2000/svg" width="11.143" height="14.045" viewBox="0 0 11.143 14.045">
                <g id="Icon_feather-clock" data-name="Icon feather-clock" transform="translate(0.5 0.5)">
                  <path id="Path_12647" data-name="Path 12647"
                    d="M13.143,9.523c0,3.6-2.271,6.523-5.071,6.523S3,13.125,3,9.523,5.271,3,8.071,3,13.143,5.92,13.143,9.523Z"
                    transform="translate(-3 -3)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1" />
                  <path id="Path_12648" data-name="Path 12648" d="M18,9v3.914l2.029,1.3"
                    transform="translate(-13.451 -4.803)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1" />
                </g>
              </svg>
            </span><span>
              <?php //echo dateTimeFormat($maches_friends->login_date); ?> 
            </span></h4>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php }else{ ?>
  <div class="no_record_box">
    <div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt=""> </div>
    <h3>No record Found</h3>
    <p>Marches Not found</p>
  </div>
  <?php } ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.website.ajax_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Marches/marches.blade.php ENDPATH**/ ?>