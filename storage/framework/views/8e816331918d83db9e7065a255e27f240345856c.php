<button type="button" class="close" data-bs-dismiss="modal" id="postStopVideo" aria-bs-label="Close">
	<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt=""> 
</button>
<?php //echo "<pre>";print_r($post_details);die;  ?>
 
<div class="pvBx">
	 <?php if(count($post_details['post_image']) > 1){ ?>	
			<div class="pv_slider">
				<div id="pv_slider" class="slider_slk">
					<?php foreach($post_details['post_image'] as $image){ ?>
					    <?php if($image->file_type== 'image'){ ?>
						<div class="media"><img src="<?php echo $image->image; ?>" alt=""></div>
						<?php }else{ ?>
						<div class="media">
						        <video class="media_video" controls>
									<source src="<?php echo $image->image; ?>" type="video/mp4">
								</video></div>  
						<?php } ?>
		       		<?php }  ?>       					
				</div>
			</div>
			<?php }else{ ?>
			  
			 
                <?php if(isset($post_details['post_image'][0]->file_type) && $post_details['post_image'][0]->file_type=='image'){ ?>		 <div class="pb_media">	
				<img src="<?php echo $post_details['post_image'][0]->image; ?>" alt=""></div>
				<?php }else{ ?>
					<div class="pb_media">	
				     <video class="media_video" controls>
									<source src="<?php echo $post_details['post_image'][0]->image; ?>" type="video/mp4">
								</video></div>  
				<?php } ?>
			
			<?php } ?>
	<div class="pb_pst">
		<div class="head">
			<h3 id="ev_name">
				<?php echo $post_details['name']; ?>
			</h3>
			<p>
				<?php echo $post_details['time']; ?>
			</p>
		</div>
		<div class="des_bx">
			<p>
				<?php echo $post_details['post_text']; ?>
			</p>
		</div>		
	</div>
	</div> 
</div>   

<script type="text/javascript">
	$(document).ready(function(){
		
		var timeout=setTimeout(function(){
			$("#pv_slider").not('.slick-initialized').slick({
        
        //$('#pv_slider').slick({
        infinite: false,
        speed: 100,
        fade: true,
        cssEase: 'linear'
        // // dots: true,
        // infinite: true,
        // speed: 300,
        // slidesToShow: 1,
        // adaptiveHeight: true,
        // navbar:false        
    });
			 $('video').trigger('pause');
$('.slick-next').click(function(e){
$('video').trigger('pause');
});

$('.slick-prev').click(function(e){
$('video').trigger('pause');
});

		},150);
		timeout();
		clearTimeout(timeout);

	});
	
	$('#postStopVideo').click(function(){
		$('video').trigger('pause');
	});
</script>

<?php /**PATH C:\xampp\htdocs\golden\resources\views/postDetails.blade.php ENDPATH**/ ?>