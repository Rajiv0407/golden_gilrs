<?php if(count($post_image) > 0){ ?>
      <?php foreach($post_image as $post_images){ ?>
            <div class="gallary_img" id="delete_img_<?php echo $post_images->id ;  ?>_<?php echo $post_images->deleteType ; ?>">
              <a href="<?php echo $post_images->image; ?>" data-fancybox="gallery" data-caption="">
                <img src="<?php echo $post_images->image; ?>" alt="">
              </a>
              <div class="photo_del" onclick="deletePhoto(<?php echo $post_images->id ;  ?>,<?php echo $post_images->deleteType ; ?>)">
                <i class="ri-delete-bin-line"></i>
              </div>
            </div>
            <?php } ?> 
         
 <input type="hidden" name="isShowMore" id="isShowMore" value="<?php echo  isset($data['isShowMore'])?$data['isShowMore']:0 ; ?>">
 <?php  } ?> 
            
      
    <?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Profile/ajax_photo.blade.php ENDPATH**/ ?>