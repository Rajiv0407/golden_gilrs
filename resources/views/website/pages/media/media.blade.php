<div class="">
  <div class="Box_details_sect">
    <div class="heading_title">Media</div>
    <div class="Photoupload_wrapp  mt-3">
      <h3>Uploaded Photo</h3>

      <div class="list_stories">
        <?php foreach($post_image as $post_images){ //echo "<pre>";print_r($post_images); ?>
        <?php if($post_images['file_type']=='image'){ ?>
        <div class="gallary_img">
          <img src="<?php echo $post_images['image']; ?>" alt="">
        </div>
        <?php }else{ ?>
        <div class="gallary_img">
          <video width="100%" height="180" controls>
            <source src="<?php echo $post_images['image']; ?>" type="video/mp4">
          </video>
        </div>

        <?php } ?>
        <?php } ?>
      </div>
      <!-- <h3 class="mt-3">January</h3> -->

    </div>
  </div>

</div>