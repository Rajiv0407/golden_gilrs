<div class="tab_photo">
  <div class="Box_details_sect">
    
      <?php if(count($post_image) > 0){ ?>
        <div class="Photoupload_wrapp">
     <div class="head">
             <h3>Videos</h3>
             <div class="addlnkscl">
               <button type="button" class="btn" class="btn lbl_btn" data-bs-toggle="modal" data-bs-target="#addstory2" onclick="addVideoPopup();">
                 <i class="ri-add-circle-line"></i>
                 <span>Add Videos</span>
               </button>
             </div>
          </div>
      <div class="list_stories abt_video" id="profile_photo_listing">

        <?php foreach($post_image as $post_images){ ////echo "<pre>";print_r($post_images); ?>
        <div class="gallary_img" id="delete_img_<?php echo $post_images->id ;  ?>">
          <video width="100%" height="180" controls poster="<?php echo $post_images->thumbnail; ?>">
            <source src="<?php echo $post_images->image.'#t=0.1'; ?>" type="video/mp4">
          </video>
          <div class="photo_del" onclick="deleteVideo(<?php echo $post_images->id ;  ?>)">
                <i class="ri-delete-bin-line"></i>
              </div>
        </div>
        <?php } ?>
      </div>
              <input type="hidden" name="myphoto_page" id="myphoto_page" value="<?php echo  isset($data['page'])?$data['page']:0 ; ?>">
           <input type="hidden" name="isShowMore" id="isShowMore" value="<?php echo  isset($data['isShowMore'])?$data['isShowMore']:0 ; ?>">
         <?php if($data['isShowMore']){ 
$page = $data['page'] ;
?>
<div class="loadmorebtn">
  <button id="homeLoadmore" class="btn" onclick="ajax_myvideo(<?php echo $data['user_id'] ; ?>)"><div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status">
  <span class="sr-only">Loading...</span>
</div> <div class="text"> Load More</div>
</button>
</div>

<?php } ?>
      </div>
      <?php }else{ ?>



      <div class="no_record_box">
        <div class="head">
             <h3>Videos</h3>
             <div class="addlnkscl">
               <button type="button" class="btn" class="btn lbl_btn" data-bs-toggle="modal" data-bs-target="#addstory2" onclick="addVideoPopup();">
                 <i class="ri-add-circle-line"></i>
                 <span>Add Videos</span>
               </button>
             </div>
          </div>
        <div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt=""> </div>
        <h3>No record Found</h3>
        <p>Video Not found</p>

      </div>



      <?php } ?>

    
  </div>
</div>


<div class="modal fade add_story_modal" id="addstory2" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Videos</h5>  
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
                </button>
            </div>
            <div class="modal-body" id="add_photo_popup_model"> 
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
  function addVideoPopup(){
      ajaxCsrf();
        $.ajax({
            type: "get",
            url: baseUrl + '/addVideoModal',
            dataType: 'html',
            success: function (res) {
                $("#add_photo_popup_model").html(res);
            }
        });

}



</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Profile/Videos.blade.php ENDPATH**/ ?>