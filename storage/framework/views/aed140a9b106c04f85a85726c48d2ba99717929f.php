<style>
	.thumb {
		width: 80px;
		height: 50px;
		margin: 0.2em -0.7em 0 0;
	}

	.remove_img_preview {
		position: relative;
		top: -30px;
		right: 7px;
		width: 20px;
		height: 20px;
		background: black;
		color: white;
		border-radius: 50px;
		font-size: 0.9em;
		padding: 0 0.3em 0;
		text-align: center;
		cursor: pointer;
		display: inline-block;
	}

	.remove_img_preview:before {
		content: "×";
	}

	html,
	body {
		width: 100%;
		height: 100%;
	}
</style>




<div class="box_details_sect" id="homepost">
	<div class="sell_box">
		<div class="head">
			<h3></h3>
		</div>
			
		<div class="filter_mind" onClick="mobilepost();">
			<label for="" class="form-control">What's on you  mind?</label>			
		</div>

		<?php if($data['requestId']==0 || $loingUserId==$data['requestId']){ ?>

		<div class="post_message pm_mv" id="post_message_id">
			
			<div class="mobile_post_head">
				<div class="headd">
					<h3 onClick="mobilepostclose();"><i class="ri-arrow-left-line"></i> Create Post</h3>
				</div>
			</div>

			<form id="post_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">

				<div class="frm_post_sect">
					<div class="frm_post">
						<div class="textarea_inpt">
							<!-- <p class="lead emoji-picker-container homepost_click"></p> -->
							<!--<div class="inclickbx" onClick="inclickbx()"></div> -->
							<textarea class="form-control post_text_area" name="post_text" id="post_text" type="text"
								placeholder="Compose new post"></textarea>

							<span id="error_post_text" class="err"></span>
						</div>
					</div>
					<div class="upload_file_post" id="view_imgvideo" style="display:none;">
						<div class="list_bx">
							<div id="output_image"> </div>
						</div>
					</div>
				</div>
				<div class="attachment_sect">
					<div class="attachment-file">
						<ul>
							<li>
								<label class="ttL_pstnm" for="image">
									<span><img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/image_icon.png"
											alt=""></span>
									<span>Photo/Video</span>
								</label>
								<input id="image" type="file" name="image[]" accept="image/*, video/*"
									style="display: none;" multiple>
								<input type="hidden" name="totalPreviwImg" id="totalPreviwImg" value="0">
							</li>
							<li>
								<div class="ttL_pstnm first-btn">
									<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/feel_action.png" alt="">
									Feeling/Activity
								</div>
							</li>
							<li>
								<button type="button" class="adnebtn" data-bs-toggle="modal" data-bs-target="#audience_modal" >
									<span class="icon">
										<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/public.png" id="createPost" alt="">
									</span>
									<span id="privacyText">Public</span>
								</button>
							</li>
						</ul>
					</div>
						<input type="hidden" name="post_Privacy" id="post_Privacy" value="1">
					<div class="btn_grp">
						<button type="submit" class="Publish_btn" id="homePostAdd" onclick="save_post();">
							<div id="loadingGife" style="display: none;" class="loader_wrap"><span
									class="loader"></span></div> Publish
						</button>
					</div>

				</div>
			</form>

		</div>
	<?php } ?>
		<div class="post_list" id="post_listing">
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
									onclick="editPost(<?php echo $post_infos['id'];  ?>,<?php echo $data['type'] ; ?>);">Edit</a></li>
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
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="single_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls poster="<?php echo $image->thumbnail ; ?>">
							<source src="<?php echo $image->image.'#t=0.1'; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
				</div>
				<?php }
			} else if (count($post_infos['post_image']) == 2) { ?>
				<div class="dubl_imgvdo" >
					<?php foreach ($post_infos['post_image'] as $image) { //print_r($image['image']);die; 
										?>
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $image->id; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $image->id; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ?>);">
						<video class="media_video" controls poster="<?php echo $image->thumbnail ; ?>">
							<source src="<?php echo $image->image.'#t=0.1'; ?>" type="video/mp4">
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
						onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ; ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>"  onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ; ?>);">
						<video class="media_video" controls poster="<?php echo $image->thumbnail ; ?>">
							<source src="<?php echo $image->image.'#t=0.1'; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
					<?php } ?>

				</div>
				<?php } else if (count($post_infos['post_image']) > 3) { ?>
				<div class="morefore" >
					<?php $i = 0 ?>
					<?php foreach ($post_infos['post_image'] as $image) { ?>
					<?php if ($i < 3) { ?>
					<?php if ($image->file_type == 'image') { ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id; ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id; ?>);" >
						<video class="media_video" controls poster="<?php echo $image->thumbnail ; ?>" preload="metadata">
							<source src="<?php echo $image->image.'#t=0.1'; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php } ?>
					<?php $i++;
										} ?>
					<div class="more_bx" onclick="model_data(<?php echo $post_infos['id']; ?>,0);">
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
<!-- <li>
<a href="https://twitter.com/share?text=<?php //echo $blog_title;
?>&url=<?php //echo $post_infos['post_share_url']; ?>" target="_blank">
<i class="fa fa-twitter"></i>
</a>
</li> -->
<!--<li><a href="javascript:void(0);" target="_blank"><i class="fa fa-youtube"></i></a></li> -->
<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_infos['post_share_url']; ?>"
target="_blank"><i class="fa fa-linkedin"></i></a>
</li>
<!-- <li><a href="https://www.instagram.com/<?php //echo $post_infos['post_share_url']; ?>"
target="_blank"><i class="fa fa-instagram"></i></a>
</li> -->
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

<?php } 

if($data['isShowMore']){ 
$page = $data['page'] ;
?>
<div class="loadmorebtn">
	<button id="homeLoadmore" class="btn" onclick="ajax_homeLoadMore('<?php echo $page ; ?>')"><div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status">
  <span class="sr-only">Loading...</span>
</div> <div class="text"> Load More</div>
</button>
</div>
<!--  -->
<?php }  

} else { ?>
			<div class="no_record_box">
				<div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt="">
				</div>
				<h3>No record Found</h3>
				<p>Post Not found</p>
			</div>
			<?php } ?>
		</div>
	</div>
</div>



<div class="modal fade edit_post_modal" id="editpost" tabindex="-1" role="dialog"
	aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Post</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
					<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="edit_post_model_id">

			</div>

		</div>
	</div>
</div>

<div class="modal fade edit_post_modal" id="editComment" tabindex="-1" role="dialog"
	aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Comment</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
					<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="edit_comment_model_id">

			</div>

		</div>
	</div>
</div>

<div class="modal fade edit_post_modal" id="editReplyComment" tabindex="-1" role="dialog"
	aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Reply Comment</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
					<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="edit_reply_comment_model_id">

			</div>

		</div>
	</div>
</div>
<!-- Modal --->
<div class="modal fade postview_modal" id="postvewmodal" tabindex="-1" role="dialog"
	aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body" id="homePostSlider">

			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade pstaudemdl" id="audience_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle"
	aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Post Audience</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
				<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body">
				<div class="ammdl">
					<h3>Who can see your post?</h3>
					<p>Your post will appear in Feed, on your profile and in search results.</p>
					<p>Your default audience is set to Public, but you can change the audience of this specific post.
					</p>
					<div class="amsltr">
						<ul class="amlst">
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/public.png" alt=""></span>
									<input type="radio" checked="checked" name="postPrivacy"  value="1">
									<span class="amchr"></span>
									Public
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/friends.png" alt=""></span>
									<input type="radio"  name="postPrivacy" value="2">
									<span class="amchr"></span>
									Friends
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/only_me.png" alt=""></span>
									<input type="radio"  name="postPrivacy" value="3">
									<span class="amchr"></span>
									Only me
								</label>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
						<button type="button" class="btn" onclick="postPrivacy()" data-bs-dismiss="modal" aria-bs-label="Close">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Post Listing Privacy -->
<div class="modal fade pstaudemdl" id="post_list_privacy_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle"
	aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Post Audience</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
				<img src="<?php echo e(URL::to('/public/website')); ?>/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="postList_privacy">
				<form id="postListPrivacyForm" action="javascript:void(0);">
					<input type="hidden" name="upatePrivacyPost" id="upatePrivacyPost" value="">
				<div class="ammdl">
					<h3>Who can see your post?</h3>
					<p>Your post will appear in Feed, on your profile and in search results.</p>
					<p>Your default audience is set to Public, but you can change the audience of this specific post.
					</p>
					<div class="amsltr">
						<ul class="amlst">
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/public.png" alt=""></span>
									<input type="radio" checked="checked" name="postListPrivacy"  id="post_p_public" value="1">
									<span class="amchr"></span>
									Public
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/friends.png" alt=""></span>
									<input type="radio" id="post_p_friend" name="postListPrivacy" value="2">
									<span class="amchr"></span>
									Friends
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="<?php echo e(URL::to('/public/website')); ?>/images/icon/only_me.png" alt=""></span>
									<input type="radio"  id="post_p_onlyme" name="postListPrivacy" value="3">
									<span class="amchr"></span>
									Only me
								</label>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
						<button type="button" class="btn" onclick="savePostListPrivacy()" data-bs-dismiss="modal" aria-bs-label="Close">Done</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- End -->

<?php 

$privacyImgPath=URL::to('/public/website').'/images/icon/' ;
$pivacyImg=array(
'public'=>$privacyImgPath.'public.png' ,
'friend'=>$privacyImgPath.'friends.png' ,
'onlyme'=>$privacyImgPath.'only_me.png' 
); 


?>

<script type="text/javascript" src="<?php echo e(URL::to('/public/website')); ?>/js/new.js?v=<?php echo e(time()); ?>"></script>
<!-- edit post modal ---- -->
<script type="text/javascript">

	// $(document).ready(function () {

	// });
	var filesToUploadPost = [];
	//$('#view_imgvideo').hide();
	$("#image").change(function (e) {
        
		alert('hello');

		var fileUploadSize = this.files[0].size;
		var fileSize = 100 * 1000000;
		if (fileUploadSize > fileSize) {
			alert('Please upload file less then 100 MB');
			return false;
		} else {

			//$('#output_image').html('');    
			//var filesToUploadPost = [];  
			var input = this;
			var totalPreviewImg = $('#totalPreviwImg').val();
			var j = totalPreviewImg;
			if (input.files && input.files.length) {

				var filesAmount = input.files.length;
				for (i = 0; i < filesAmount; i++) {
					const file = input.files[i];
					const fileType = file.type.split('/')[0];

					var reader = new FileReader();
					this.enabled = false;
					reader.onload = (function (e) {
						var span = document.createElement('span');
						if (fileType === 'image') {
							span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id=' + j + ' class="remove_img_preview"></span>'].join('');
							document.getElementById('output_image').insertBefore(span, null);
							$('#view_imgvideo').show();
						} else if (fileType === 'video') {
							span.innerHTML = ['<video  id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"></video><span id=' + j + ' class="remove_img_preview media-video"></span>'].join('');
							document.getElementById('output_image').insertBefore(span, null);
							$('#view_imgvideo').show();
						}else{
							alert('Only accept image and video type file');
							return false ;
						}


						// filesToUploadPost.push({
						//       id: j,
						//       file: file
						//   });
						var total = $('#totalPreviwImg').val();
						$('#totalPreviwImg').val(parseInt(total + 1));
						j++;
					});
					reader.readAsDataURL(input.files[i]);
				}
			}

			for (const file of input.files) {
				filesToUploadPost.push(file);
			}

		}



	});

	$('#output_image').on('click', '.remove_img_preview', function () {
		var id = $(this).attr('id');

		const dt = new DataTransfer();
		const input = document.getElementById('image');
		const { files } = input;

		for (let i = 0; i < files.length; i++) {
			const file = files[i];
			if (id != i) {
				dt.items.add(file) // here you exclude the file. thus removing it.
				input.files = dt.files
			} else {
				filesToUploadPost.splice(i, 1);
			}
			if (files.length == 1) {
				$("#image").val("");
			}
		}
		$(this).parent('span').remove();
		$(this).val("");
	});


	function save_comment(id, type = 0) {

		var comment = $('#comment_' + id).val();
		$('.err').html('');
		if (comment == '' && type == 0) {
			$('#error_comment').html('Please enter comment');
		} else {
			$('#loader_spineer').show();
			// var formData=new FormData($('#comment_save_id')[0]);             
			ajaxCsrf();
			$.ajax({
				type: "post",
				url: baseUrl + '/save_comment',
				data: { 'post_id': id, 'comment': comment, 'type': type },
				dataType: 'json',
				beforeSend: function () {
					//ajax_before();
				},
				success: function (res) {

					// ajax_success() ;
					$('#loader_spineer').hide();
					if (res) {
						//alert(res.comment_info.length);
						if (res.comment_info.length == 0) {
							$("#message_count_" + id).html('');
						}
						$("#comment_save_id_" + id)[0].reset();
						$("#post_list_chat_" + id).html('');
						//Post_listing();
						$.each(res.comment_info, function (key, comment_data) {
							$("#message_count_" + id).html('<sup id="message_count_' + id + '">' + comment_data.comment_count + '</sup>');
							if (comment_data.is_comment == 'Yes') {
								var yes = '<div class="chat_reply_list" id="chat_reply_list_' + comment_data.id + '"></div>';
							} else {
								var yes = '';
							}
							if (comment_data.user_id == comment_data.session_user_id) {
								var comment_reply = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment" onclick="editComment(' + id + ',' + comment_data.id + ');">Edit</a></li><li onclick="post_comment_delete(' + id + ',' + comment_data.id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
							} else {
								var comment_reply = '';
							}
							$("#post_list_chat_" + id).append('<div class="post_bx" id="commmnet_listing_' + comment_data.id + '"><div class="user_avtar"><img src="' + comment_data.image + '" alt=""></div><div class="post_details"><div class="cont_user"><h3><span>' + comment_data.name + '</span>' + comment_reply + '</h3><p>' + comment_data.time + '</p></div><div class="post_descrip"><p>' + comment_data.comment + '</p></div><div class="post_commit"><ul><li onclick="comment_like(' + comment_data.id + ',' + id + ')"> <a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g> <defs><clipPath id="clip0_1421_4501"><rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="count_' + comment_data.id + '">' + comment_data.comment_likes + '</span></div></div></a> </li> <li id="reply_from_hide" value=' + comment_data.id + '><a><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7258)"><path d="M17.25 18.0017C17.0511 18.0017 16.8604 17.9227 16.7197 17.782C16.5791 17.6414 16.5 17.4506 16.5 17.2517C16.4989 16.0586 16.0244 14.9147 15.1807 14.071C14.3371 13.2274 13.1932 12.7529 12 12.7517H7.62754V13.9412C7.62748 14.2378 7.53947 14.5278 7.37465 14.7744C7.20982 15.021 6.97558 15.2132 6.70153 15.3267C6.42748 15.4402 6.12593 15.4699 5.835 15.4121C5.54407 15.3542 5.27682 15.2114 5.06704 15.0017L0.657793 10.5924C0.235983 10.1705 -0.000976563 9.5983 -0.000976562 9.00168C-0.000976563 8.40506 0.235983 7.83287 0.657793 7.41093L5.06704 3.00168C5.27682 2.79197 5.54407 2.64916 5.835 2.59131C6.12593 2.53345 6.42748 2.56316 6.70153 2.67666C6.97558 2.79017 7.20982 2.98238 7.37465 3.22899C7.53947 3.47561 7.62748 3.76555 7.62754 4.06218V5.25168H11.25C13.0396 5.25367 14.7554 5.96546 16.0208 7.2309C17.2863 8.49634 17.9981 10.2121 18 12.0017V17.2517C18 17.4506 17.921 17.6414 17.7804 17.782C17.6397 17.9227 17.449 18.0017 17.25 18.0017ZM6.12754 4.06218L1.71829 8.47143C1.57769 8.61208 1.4987 8.80281 1.4987 9.00168C1.4987 9.20055 1.57769 9.39128 1.71829 9.53193L6.12754 13.9412V12.0017C6.12754 11.8028 6.20656 11.612 6.34721 11.4714C6.48787 11.3307 6.67863 11.2517 6.87754 11.2517H12C12.8517 11.2514 13.6937 11.4329 14.4697 11.7839C15.2457 12.1349 15.9379 12.6474 16.5 13.2872V12.0017C16.4985 10.6098 15.9448 9.27535 14.9606 8.29112C13.9764 7.3069 12.6419 6.75327 11.25 6.75168H6.87754C6.67863 6.75168 6.48787 6.67266 6.34721 6.53201C6.20656 6.39136 6.12754 6.20059 6.12754 6.00168V4.06218Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7258"><rect width="18" height="18" fill="white"></rect></clipPath></defs></svg></span><span>' + comment_data.reply_comment_count + '</span></a></li></ul></div><div class="post_chat_sect"><div class="send-message"><form id="reply_comment_id_' + comment_data.id + '" action="javascript:void(0);"><div class="user_img"><img src="' + comment_data.session_image + '" alt=""></div><div class="post_text_area"><textarea  rows="1" type="text" placeholder="Reply" id="reply_coment_id_' + comment_data.id + '"  class="msg_int_style"></textarea><span id="error_reply_comment" class="err"></span></div><button class="btn_post" onclick="save_reply_comment(' + comment_data.id + ',' + id + ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_1052_7993)"><path d="M18.263 7.27403L3.3038 0.236526C2.4588 -0.174307 1.46297 -0.0326407 0.7638 0.595693C0.0629663 1.22653 -0.180367 2.20653 0.142966 3.09153C0.157133 3.12736 3.8188 10.0049 3.8188 10.0049C3.8188 10.0049 0.224633 16.8807 0.212133 16.9157C-0.110367 17.8015 0.135466 18.7799 0.8363 19.4099C1.27047 19.799 1.8188 19.9999 2.37047 19.9999C2.7113 19.9999 3.05297 19.9232 3.3713 19.7674L18.2646 12.7357C19.3355 12.2332 20.0005 11.1865 19.9996 10.004C19.9996 8.82069 19.3321 7.77403 18.263 7.27403ZM1.69297 2.47403C1.5913 2.12819 1.80797 1.89903 1.8788 1.83403C1.95297 1.76819 2.2238 1.56403 2.57713 1.73736C2.5813 1.73903 17.5555 8.78319 17.5555 8.78319C17.7546 8.87653 17.9205 9.00819 18.048 9.16819H5.26213L1.69297 2.47403ZM17.5546 11.2274L2.64797 18.2657C2.2938 18.4399 2.0238 18.2365 1.94963 18.169C1.87797 18.1057 1.6613 17.8749 1.7638 17.5282L5.26547 10.8349H18.053C17.9255 10.9974 17.7563 11.1324 17.5546 11.2274Z"fill="#C5963A"></path></g><defs><clipPath id="clip0_1052_7993"><rect width="20" height="20" fill="white"></rect></clipPath>defs></svg></button><div class="attachment-file_post"><button class="btn"></button><button class="btn"></button></div></form></div></div>' + yes + '</div></div></div>')
							$('#chat_reply_list_' + id).html('');
							$.each(comment_data.reply_info, function (key1, rep_info) {

								if (rep_info.user_id == rep_info.session_user_id) {
									var reply_edit = '<span><div class="nav-item dropdown"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg"  width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0_1018_7245)"><path d="M1.5 10.5C2.32843 10.5 3 9.82843 3 9C3 8.17157 2.32843 7.5 1.5 7.5C0.671573 7.5 0 8.17157 0 9C0 9.82843 0.671573 10.5 1.5 10.5Z" fill="#C5963A"></path><path d="M9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z" fill="#C5963A"></path><path d="M16.5 10.5C17.3284 10.5 18 9.82843 18 9C18 8.17157 17.3284 7.5 16.5 7.5C15.6716 7.5 15 8.17157 15 9C15 9.82843 15.6716 10.5 16.5 10.5Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1018_7245"><rect width="18" height="18" fill="white"></rect></clipPath> </defs></svg></a><ul aria-labelledby="navbarDropdown" class="dropdown-menu"><li><a href="javascript:void(0)" class="dropdown-item" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReplyComment" onclick="editReplyComment(' + rep_info.id + ',' + rep_info.post_id + ');">Edit</a></li><li onclick="reply_comment_delete(' + rep_info.id + ',' + rep_info.post_id + ')"><a href="javascript:void(0)" class="dropdown-item">Delete</a></li></ul></div></span>';
								} else {
									var reply_edit = '';
								}

								$('#chat_reply_list_' + rep_info.comment_id).append('<div class="crd_bx" id="reply_comment_' + rep_info.id + '"><div class="user_avtar"><img src=' + rep_info.image + ' alt=""></div><div class="user_details"><div class="user_cont"><h3><span>' + rep_info.name + '</span>' + reply_edit + '</h3><p>' + rep_info.time + '</p></div><div class="reply_descrip"><p>' + rep_info.reply_comment + '</p></div><div class="post_commit"><ul><li onclick="reply_like(' + rep_info.id + ',' + id + ')"><a><div class="like_icon"><span><svg xmlns="http://www.w3.org/2000/svg" width="19"  height="19" viewBox="0 0 19 19" fill="none"><g clip-path="url(#clip0_1421_4501)"><path d="M17.5798 6.29128C17.2281 5.88598 16.7934 5.56099 16.3052 5.33829C15.817 5.1156 15.2866 5.00041 14.75 5.00053H11.7582L12.0103 3.46978C12.0994 2.93072 11.9918 2.37758 11.7071 1.91123C11.4225 1.44489 10.9796 1.09641 10.4594 0.929371C9.93918 0.76233 9.37625 0.787853 8.87328 1.00128C8.37031 1.21471 7.96082 1.60183 7.7195 2.09203L6.284 5.00053H4.25C3.2558 5.00172 2.30267 5.39719 1.59966 6.10019C0.896661 6.8032 0.501191 7.75633 0.5 8.75053L0.5 12.5005C0.501191 13.4947 0.896661 14.4479 1.59966 15.1509C2.30267 15.8539 3.2558 16.2493 4.25 16.2505H14.225C15.1276 16.2468 15.9989 15.9193 16.6803 15.3274C17.3618 14.7355 17.8082 13.9187 17.9382 13.0255L18.467 9.27553C18.5415 8.74358 18.5008 8.20184 18.3477 7.68698C18.1946 7.17211 17.9327 6.69614 17.5798 6.29128ZM2 12.5005V8.75053C2 8.15379 2.23705 7.58149 2.65901 7.15954C3.08097 6.73758 3.65326 6.50053 4.25 6.50053H5.75V14.7505H4.25C3.65326 14.7505 3.08097 14.5135 2.65901 14.0915C2.23705 13.6696 2 13.0973 2 12.5005ZM16.9783 9.06478L16.4487 12.8148C16.3713 13.3503 16.1043 13.8402 15.6962 14.1954C15.2881 14.5507 14.766 14.7477 14.225 14.7505H7.25V6.30103C7.32068 6.23945 7.37919 6.16517 7.4225 6.08203L9.06425 2.75578C9.12582 2.64472 9.21286 2.54987 9.31822 2.479C9.42358 2.40813 9.54426 2.36328 9.67033 2.34812C9.7964 2.33297 9.92426 2.34794 10.0434 2.39182C10.1626 2.4357 10.2696 2.50723 10.3558 2.60053C10.4294 2.68621 10.4833 2.7871 10.5135 2.896C10.5437 3.0049 10.5495 3.11913 10.5305 3.23053L10.1345 5.63053C10.1171 5.73776 10.1232 5.84749 10.1524 5.95213C10.1816 6.05677 10.2332 6.15381 10.3036 6.23655C10.374 6.31929 10.4616 6.38575 10.5602 6.43132C10.6588 6.4769 10.7661 6.50051 10.8748 6.50053H14.75C15.0721 6.50048 15.3904 6.56958 15.6834 6.70314C15.9765 6.8367 16.2374 7.03161 16.4487 7.2747C16.6599 7.5178 16.8165 7.80341 16.9079 8.11223C16.9992 8.42105 17.0232 8.74588 16.9783 9.06478Z" fill="#C5963A"></path></g><defs><clipPath id="clip0_1421_4501"> <rect width="18" height="18" fill="white" transform="translate(0.5 0.5)"></rect></clipPath></defs></svg></span><div class="count_no_like"><span id="reply_count_' + rep_info.id + '">' + rep_info.reply_like_count + '</span></div></div></a></li></ul></div></div></div>')
							})
						})
						if (type == 0) {
							$("#post_chat_sect_" + id).show();
							$("#post_list_chat_" + id).show();
						}
					} else {
						statusMesage('something went wrong', 'error');
					}
				}

			});
		}

	}

	function save_post() {
        
		var post_text = $('#post_text').val();
		var type='<?php echo $data['type'] ; ?>' ;
		var loginUserId = '<?php echo $data['loginUserId'] ; ?>' ;
		
		
		$('.err').html('');
		
		if (post_text == '' && filesToUploadPost.length==0) {
			$('#error_post_text').html('Please enter post text');
		} else {

			$('#loadingGife').css('display', 'block');
			var formData = new FormData($('#post_forms_id')[0]);
			//const formData = new FormData(event.target);
			formData.delete('image[]');
			// debugger ;
			//        console.log('ddd'+JSON.stringify(filesToUploadPost.values()));
			for (const file of filesToUploadPost) {
				formData.append('image[]', file);
			}

			ajaxCsrf();
			$.ajax({
				type: "post",
				url: baseUrl + '/save_post',
				data: formData,
				contentType: false,
				processData: false,
				async: true,
				dataType: 'json',
				beforeSend: function () {

				},
				success: function (res) {

					$('#loadingGife').css('display', 'none');
					if (res.status == 1) {
						$("#post_forms_id")[0].reset();
						//$("#post_message_id").hide();
						if(type==1){
							myPosts(loginUserId);
						}else{
							home_page(0);
						}
						//mobilepostclose();
						//
						//location.reload();

						//$(".main_cont").load(location.href + " .main_cont");
						//location.reload()
					} else {
						statusMesage('something went wrong', 'error');
					}
				}

			});
		}

	}

	function save_reply_comment(id, post_id) {
		var reply_comment = $('#reply_coment_id_' + id).val();
		$('.err').html('');
		if (reply_comment == '') {
			$('#error_reply_comment').html('Please enter comment');
		} else {
			$('#loader_spineer').show();
			ajaxCsrf();
			$.ajax({
				type: "post",
				url: baseUrl + '/save_reply_comment',
				data: { 'comment_id': id, 'reply_comment': reply_comment, 'post_id': post_id },
				dataType: 'json',
				success: function (response) {
					$('#loader_spineer').hide();
					$("#reply_comment_id_" + id)[0].reset();
					save_comment(post_id, 1);
					// $("#count_"+comment_id).html('');
					//$("#count_"+comment_id).html('<span id="count_'+comment_id+'">'+response+'</span>');
				}
			});
		}
	}

$(function(){

	  const videoElements = document.querySelectorAll('video');

  const options = {
    threshold: 0.1
  };

  function videoInViewport(entries, observer) {
    entries.forEach(entry => {
      const video = entry.target;

      if (entry.isIntersecting) {
        video.pause();
      } else {
        video.pause();
      }
    });
  }

  const observer = new IntersectionObserver(videoInViewport, options);

  videoElements.forEach(video => {
    observer.observe(video);
  });
});

function postPrivacy(){
   
    var privacyValue= $('input[name="postPrivacy"]:checked').val();
    var privacyImg='' ;
    var privacyTxt='' ; 
    if(privacyValue==1){
    	privacyImg='<?php echo $pivacyImg["public"] ?>';
    	privacyTxt='Public' ;
    }else if(privacyValue==2){
    	privacyImg='<?php echo $pivacyImg["friend"] ?>';
    	privacyTxt='Friends' ;
    }else if(privacyValue==3){
    	privacyImg='<?php echo $pivacyImg["onlyme"] ?>';
    	privacyTxt='Only me' ;
    }
    $('#post_Privacy').val(privacyValue);
   $('#createPost').attr('src',privacyImg);
   $('#privacyText').text(privacyTxt);
}

function savePostListPrivacy(){
  
  $('#loader_spineer').show();
    var privacyImg='' ;
  var privacyType=$('input[name="postListPrivacy"]:checked').val(); 
  
  var postId = $('#upatePrivacyPost').val();
 var formData =$('#postListPrivacyForm').serialize();
  ajaxCsrf();
  $('#current_postListP_'+postId).val(privacyType);
                    $.ajax({
                    type: "POST",
                    url: baseUrl + '/savePostPrivacy',
                    data: formData, 
                    async:true,                           
                    beforeSend: function () {

                    },
                    success: function(res) { 
                    	 $('#loader_spineer').hide();
                    	
						if(privacyType==1){
						privacyImg='<?php echo $pivacyImg["public"] ?>';
						 $('#pListPrivacy_'+postId).attr('src',privacyImg);
						}else if(privacyType==2){
						privacyImg='<?php echo $pivacyImg["friend"] ?>';
						 $('#pListPrivacy_'+postId).attr('src',privacyImg);
						}else if(privacyType==3){
						privacyImg='<?php echo $pivacyImg["onlyme"] ?>';
						 $('#pListPrivacy_'+postId).attr('src',privacyImg);
						}
						
                    }

                    });


}
function postListingPrivacy(postId){
		
		$('#upatePrivacyPost').val(postId);
		var privacy = $('#current_postListP_'+postId).val();
		
		if(privacy==1){
			$("#post_p_public").prop("checked", true);
		}else if(privacy==2){
			$("#post_p_friend").prop("checked", true);
		}else {
			$("#post_p_onlyme").prop("checked", true);
		}

}

function ajax_homeLoadMore($page){

	$('#loadmorebtn_loader').css('display','block');
	
    ajaxCsrf();
    $.ajax({
        type: "post",    
        url: baseUrl + '/home_page',
        data:{"page":parseInt($page)+1},
        dataType: 'html',
        beforeSend: function () {
                  //$('#loader_spineer').show();

                },
        success: function (html) {
        	
        	$('#homeLoadmore').remove();
         
            if (html) {
                $('#post_listing').append(html);
            } else {
                statusMesage('something went wrong', 'error');
            }
        }
    });
}

// $(window).scroll(function() {
// 	console.log('hello');
//   if($(window).scrollTop() + $(window).height() >= $(document).height()){
//      alert('hello');
//   var isShowMore = $('#isShowMore').val();
//       var page = $('#page').val();
//       if(isShowMore){
//       	ajax_homeLoadMore(page);
//       }
     
//   }
// });

function postDetails(postId){
		window.location.href=baseUrl + '/postDetail/'+postId  ;
}

</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/ajax_index.blade.php ENDPATH**/ ?>