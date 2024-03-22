<div class="modal fade storiesmodal" id="stotiesmodal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Story views/Likes</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
					<!-- <img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt=""> -->
					<i class="ri-close-line"></i>
				</button>
			</div>
			<div class="modal-body">
				<?php if (!empty($post_infos)) {  ?>
					<div class="like_wrap">

						<?php foreach ($post_infos as $val1) {  ?>
							<div class="like_details">
							<div class="avtar_img">
							<div class="img_bx">
									<img src="<?php echo $val1->image; ?>" alt="">
								</div>
								<div>
									<span>
										<?php echo $val1->name; ?>
									</span>
								</div>
							</div>
							<div class="ffp_group">
						<div class="form-button">
						<button type="button" class="btn">
							<?php if($val1->is_like==1){ ?> 
								<i class="ri-heart-fill" ></i>
						
						<?php }else{ ?>
							<i class="ri-heart-line" ></i>
						<?php } ?>
						
						</button> 
						</div>
							</div>
							</div>
						<?php } ?>
					</div>


			</div>
		<?php } ?>

		</div>
	</div>
</div><?php /**PATH C:\xampp\htdocs\golden\resources\views/website/story_modal.blade.php ENDPATH**/ ?>