<?php if(count($post_image) > 0){ ?>
      <?php foreach($post_image as $post_images){ ?>
            <div class="gallary_img" id="delete_img_<?php echo $post_images->id ;  ?>">
          <video width="100%" height="180" controls poster="<?php echo $post_images->thumbnail; ?>">
            <source src="<?php echo $post_images->image.'#t=0.1'; ?>" type="video/mp4">
          </video>
          <div class="photo_del" onclick="deleteVideo(<?php echo $post_images->id ;  ?>)">
                <i class="ri-delete-bin-line"></i>
              </div>
        </div>
            <?php } ?> 
         
 <input type="hidden" name="isShowMore" id="isShowMore" value="<?php echo  isset($data['isShowMore'])?$data['isShowMore']:0 ; ?>">
 <?php  } ?> 
            <!--  -->
      
    