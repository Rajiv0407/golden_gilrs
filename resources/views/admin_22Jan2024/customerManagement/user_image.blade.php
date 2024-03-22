<?php if((count($image)) > 0 ) {  ?>
<div class="img_bx_list">
<?php foreach($image as $images){ ?>

<div class="img_bx_wrap">
<img src="<?php echo  $images['image']; ?>">
</div>



<?php } ?>
</div>
<?php }else{ ?>
  not found
<?php }  ?>