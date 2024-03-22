<?php 

			if (!empty($post_info)) {     ?>
			<?php foreach ($post_info as $post_infos) {  ?>
				 



			<div class="post_card" id="post_card_lisitng_<?php echo $post_infos['id'] ?>">
				<div class="post_hd">

					<div class="post_user">
						<div class="user_avtar">
							<div class="img_bx">
								<img src="<?php echo $post_infos['user_image'];  ?>" alt="">
							</div>
							<div class="user_details">
								<div>
									<h3><a href="<?php echo e(URL::to('/')); ?>/profile/<?php echo $post_infos['post_user_id']; ?>">
											<?php echo $post_infos['name'];  ?>
										</a></h3>
									<p>
										<span><?php echo $post_infos['time'];  ?></span>
									 <input type="hidden" name="current_postListP" id="current_postListP_<?php echo $post_infos['id'] ; ?>" value="<?php echo $post_infos['privacy'] ; ?>">
										<span class="pabx">
											<a href="javascript:void();" <?php if($loingUserId==$post_infos['post_user_id']){ ?>data-bs-toggle="modal" data-bs-target="#post_list_privacy_modal" onclick="postListingPrivacy('<?php echo $post_infos['id'] ; ?>')" <?php } ?> >
												<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/<?php echo $post_infos['post_type']; ?>" id="pListPrivacy_<?php echo $post_infos['id'] ; ?>" width="12px" alt="">
											</a>
										</span>	
																			
									</p>
								</div>
							</div>
						</div>
					</div>

					<?php if ($post_infos['post_user_id'] == $post_infos['session_user_id']) { ?>
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li id="edit_id"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editpost"
									onclick="editPost(<?php echo $post_infos['id'];  ?>);">Edit</a></li>
							<li id="delete_id" value="<?php echo $post_infos['id'];  ?>"><a
									class="dropdown-item">Delete</a></li>

						</ul>
					</div>
					<?php } ?>
				</div>
				<div class="description_post">
					<p>
						<?php echo getStringWithLink($post_infos['post_text']);  ?>
					</p>
				</div>

				<?php if (!empty($post_infos['post_image'])) {   ?>
				<?php if (count($post_infos['post_image'])  > 0) { ?>

				<?php if (count($post_infos['post_image']) == 1) { ?>
				<?php foreach ($post_infos['post_image'] as $image) { ?>
				<div class="single_imgvideo" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>"
						style="background:url('<?php echo $image->image; ?>');">
						<img class="media_img" src="<?php echo $image->image; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="single_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image->image; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
				</div>
				<?php }
								} else if (count($post_infos['post_image']) == 2) { ?>
				<div class="dubl_imgvdo" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php foreach ($post_infos['post_image'] as $image) { //print_r($image['image']);die; 
										?>
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>">
						<img class="media_img" src="<?php echo $image->image; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image->image; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php } ?>
				</div>
				<?php } else if (count($post_infos['post_image']) == 3) { ?>
				<div class="multypl_post">
					<?php foreach ($post_infos['post_image'] as $image) { ?>
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>"
						onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->file_type ; ?>);">
						<img class="media_img" src="<?php echo $image->image; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image->image; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
					<?php } ?>

				</div>
				<?php } else if (count($post_infos['post_image']) > 3) { ?>
				<div class="morefore" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php $i = 0 ?>
					<?php foreach ($post_infos['post_image'] as $image) { ?>
					<?php if ($i < 3) { ?>
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>">
						<img class="media_img" src="<?php echo $image->image; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image->image; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php } ?>
					<?php $i++;
										} ?>
					<div class="more_bx">
						<button type="button" class="btn">view
							all</button>
					</div>

				</div>
				<?php } ?>

				<?php } ?>

				<?php } ?>


				<div class="post_likeshare">
					<ul class="likeshare_ul coman_post" id="d_post_div">
						<li class="position-relative">
							<button type="button" class="btn_line" id="like_id"
								value="<?php echo $post_infos['id']; ?>">

								<span id="post_like_span_id_<?php echo $post_infos['id']; ?>">
									<?php if ($post_infos['user_post_is_like'] == 'Yes') { ?>
									<i class="ri-thumb-up-fill"></i>
									<?php } else { ?>
									<i class="ri-thumb-up-line"></i>
									<?php } ?>
								</span>
								<span>Like</span>
								<sup class="d-none" id="like_count_<?php echo $post_infos['id']; ?>">
									<?php echo $post_infos['post_like_count']; ?>
								</sup>
							</button>

							<div id="like_name_<?php echo $post_infos['id']; ?>" class="otherlikebx">
								<?php $y = 0; ?>
								<?php if (!empty($post_infos['post_like_listing'])) {  ?>
								<?php /*foreach($post_infos['post_like_listing'] as $val){  ?>

								<?php if($y < 1){ ?>
								<div class="ol_n">
									<?php echo $val['name']; ?>
								</div>
								<?php }   ?>
								<?php $y++; } */ ?>
								<?php /* if($y > 0){ */ ?>
								<div class="ol_odbx">
									<button type="button" class="btn"
										onclick="post_like_model(<?php echo $post_infos['id']; ?>)">
										<?php // echo $y; 
																																				?>
										<?php echo $post_infos['post_like_count']; ?>
									</button>
								</div>
								<?php //} 
											?>
								<?php } ?>
							</div>
						</li>
						<li>
							<button type="button" class="btn_line" id="message_id"
								value="<?php echo $post_infos['id']; ?>">
								<span>
									<i class="ri-message-2-line"></i>

								</span>
								<span>Comment</span>
								<sup id="message_count_<?php echo $post_infos['id']; ?>">
									<?php echo $post_infos['post_comment_count']; ?>
								</sup>
							</button>
						</li>
						<li id="share_id" value="<?php echo $post_infos['id']; ?>" class="share">
							<!-- value="<//?php echo $goodies_listings['id'] ?>" -->
							<a type="button">
								<span><i class="ri-share-fill"></i></span>
								<span>Share</span>
							</a>
							<ul class="share_ul social_icons" id="share_ul_<?php echo $post_infos['id']; ?>">
								<li>
									<a href="https://www.facebook.com/share.php?u=<?php echo $post_infos['post_share_url']; ?>"
										target="_blank"><i class="fa fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="https://twitter.com/share?text=<?php //echo $blog_title;
																					?>&url=<?php echo $post_infos['post_share_url']; ?>" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<!--<li><a href="javascript:void(0);" target="_blank"><i class="fa fa-youtube"></i></a></li> -->
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_infos['post_share_url']; ?>"
										target="_blank"><i class="fa fa-linkedin"></i></a>
								</li>
								<li><a href="https://www.instagram.com/<?php echo $post_infos['post_share_url']; ?>"
										target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>







				<!-- <div class="post_footer"></div> -->



				<div class="post_chat_sect" id="post_chat_sect_<?php echo $post_infos['id'] ?>" style="display:none">
					<div class="user_img"><img src="<?php echo $post_infos['session_image']; ?>" alt=""></div>
					<div class="send-message">
						<form id="comment_save_id_<?php echo $post_infos['id']; ?>" action="javascript:void(0);">
							<div class="post_text_area">
								<textarea rows="1" formcontrolname="ComentMeassge" type="text"
									id="comment_<?php echo $post_infos['id']; ?>" placeholder="Comment"
									class="msg_int_style ng-valid ng-pristine ng-touched"
									ng-reflect-name="ComentMeassge"></textarea>
								<span id="error_comment" class="err"></span>
							</div><button class="btn_post" onclick="save_comment(<?php echo $post_infos['id']; ?>)">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
									fill="none">
									<g clip-path="url(#clip0_1052_7993)">
										<path
											d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"
											fill="#C5963A"></path>
									</g>
									<defs>
										<clipPath id="clip0_1052_7993">
											<rect width="20" height="20" fill="white"></rect>
										</clipPath>
									</defs>
								</svg>
							</button>
							<div class="attachment-file_post">
							</div>
						</form>
					</div>
				</div>
				<div class="post_list_chat" id="post_list_chat_<?php echo $post_infos['id']; ?>" style="display:none">
				</div>
			</div>
			<?php } } ?>

				<?php if($data['isShowMore']){ 
					$page=$data['page'];
					?>
					<div class="loadmorebtn">
	<button id="homeLoadmore" class="btn" onclick="ajax_homeLoadMore('<?php echo $page ; ?>')"><div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status">
  <span class="sr-only">Loading...</span>
</div> <div class="text"> Load More</div>
</button>
</div>
			
		<?php } ?>

		<?php /**PATH C:\xampp\htdocs\golden\resources\views/home_page_loadmore.blade.php ENDPATH**/ ?>