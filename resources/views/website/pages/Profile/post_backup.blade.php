<style>
	.thumb { width: 80px; height: 50px; margin: 0.2em -0.7em 0 0; }
	.remove_img_preview {
		position: relative; top: -30px; right: 7px; width: 20px; height: 20px; background: black; color: white; border-radius: 50px; font-size: 0.9em;
		padding: 0 0.3em 0; text-align: center; cursor: pointer; display: inline-block;
	}
	.remove_img_preview:before { content: "×";	}	
</style>
<!-- GGG -->
<?php $data=session()->get('user_session');?>
<div class="box_details_sect" id="homepost">
	<div class="sell_box">
		<div class="head">
			<h3></h3>
		</div>
		
		<div class="filter_mind" onClick="mobilepost();">
			<label for="" class="form-control">What's on you  mind?</label>			
		</div>

		<?php if($data['userId'] == request()->segment(2)){ ?>
		<div class="post_message pm_mv" id="post_message_id">
		<div class="mobile_post_head">
				<div class="headd">
					<h3 onClick="mobilepostclose();"><i class="ri-arrow-left-line"></i> Create Post</h3>
				</div>
			</div>
			<form id="post_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">
				<div class="frm_post_sect">
					<div class="frm_post">
						<input type="hidden" name="session_user_id" id="session_user_id"
							value="<?php echo $data['userId']; ?>">
						<div class="textarea_inpt">

							<textarea class="form-control pro_text" name="post_text" id="post_text" type="text"
								placeholder="Compose new post"></textarea>

							<span id="error_post_text" class="err"></span>
						</div>
					</div>
					<div class="upload_file_post" id="view_imgvideo" style="display:none;">
						<div class="list_bx">
							<div id="output_image"> </div>
							<!-- <video controls class="video"></video> -->
						</div>
					</div>
				</div>
				<div class="attachment_sect">
					<div class="attachment-file">
						<ul>
							<li>
								<label class="ttL_pstnm" for="image_profile">
									<span><img src="{{URL::to('/public/website')}}/images/icon/image_icon.png"
											alt=""></span>
									<span>Photo/Video</span>
								</label>
								<input id="image_profile" type="file" name="image[]" accept="image/*, video/*"
									style="display: none;" multiple>
							</li>

							<li>
								<!-- <label class="ttL_pstnm "  for="">
									<span></span>
									<div class="ttL_pstnm emoji-btn">Feeling/Activity</div>
							</label> -->

								<div class="ttL_pstnm first-btn emoji-btn">
									<img src="{{URL::to('/public/website')}}/images/icon/feel_action.png" alt="">
									Feeling/Activity
								</div>
							</li>
							<li>
								<button type="button" class="adnebtn" data-bs-toggle="modal" data-bs-target="#audience_modal">
									<span class="icon">
										<img src="{{URL::to('/public/website')}}/images/icon/public.png" alt="">
									</span>
									<span>Public</span>
								</button>
							</li>


						</ul>
					</div>

					<div class="btn_grp">
						<button type="submit" class="Publish_btn" onclick="save_post1();">Publish</button>
					</div>

				</div>
			</form>
		</div>
		<?php } ?>
		<div class="post_list" id="post_listing">
			<?php //echo "<pre>";print_r($post_info)die;   ?>
			<?php if(!empty($post_info)){     ?>
			<?php foreach($post_info as $post_infos){ ?>
			<div class="post_card" id="post_card_lisitng_<?php echo $post_infos['id'] ?>">
				<div class="post_hd">
					<div class="post_user">
						<div class="user_avtar">
							<div class="img_bx">
								<img src="<?php echo $post_infos['user_image'];  ?>" alt="">
							</div>
							<div class="user_details">
								<div>
									<h3>
										<?php echo $post_infos['name'];  ?>
									</h3>
									<p>
										<span>
											<?php echo $post_infos['time'];  ?>
										</span>
										<span class="pabx">
											<a href="javascript:void();" data-bs-toggle="modal"
												data-bs-target="#audience_modal">
												<img src="{{URL::to('/public/website')}}/images/icon/public.png"
													width="12px" alt="">
											</a>
										</span>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php if($data['userId'] == request()->segment(2)){ ?>
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li id="delete_id" value="<?php echo $post_infos['id']; ?>"><a class="dropdown-item"
									href="">Delete</a></li>
						</ul>
					</div>
					<?php } ?>
				</div>
				<div class="description_post">
					<p>
						<?php echo $post_infos['post_text'];  ?>
					</p>
				</div>

				<?php if(!empty($post_infos['post_image'])){ ?>
				<?php if(count($post_infos['post_image'])  > 0) { ?>
				<?php if(count($post_infos['post_image']) == 1){ ?>
				<?php foreach($post_infos['post_image'] as $image){ ?>
				<div class="single_imgvideo" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php if($image['file_type']== 'image'){ ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>"
						style="background: url('<?php echo $image['image']; ?>');">
						<img class="media_img" src="<?php echo $image['image']; ?>" alt="">
					</div>
					<?php }else{ ?>
					<div class="single_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image['image']; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
				</div>
				<?php }} ?>

				<?php if(count($post_infos['post_image']) == 2){ ?>
				<div class="dubl_imgvdo" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php foreach($post_infos['post_image'] as $image){ //print_r($image['image']);die; ?>
					<?php if($image['file_type']== 'image'){ ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>">
						<img class="media_img" src="<?php echo $image['image']; ?>" alt="">
					</div>
					<?php }else{ ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image['image']; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php } ?>
				</div>
				<?php } ?>

				<?php if(count($post_infos['post_image']) == 3){ ?>
				<div class="multypl_post" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php foreach($post_infos['post_image'] as $image){ ?>
					<?php if($image['file_type']== 'image'){ ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>">
						<img class="media_img" src="<?php echo $image['image']; ?>" alt="">
					</div>
					<?php }else{ ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image['image']; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>
					<?php } ?>

				</div>
				<?php } ?>

				<?php if(count($post_infos['post_image']) > 3){ ?>
				<div class="morefore" onclick="model_data(<?php echo $post_infos['id']; ?>);">
					<?php $i=0 ?>
					<?php foreach($post_infos['post_image'] as $image){ ?>
					<?php if($i < 3){ ?>
					<?php if($image['file_type']== 'image'){ ?>
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>">
						<img class="media_img" src="<?php echo $image['image']; ?>" alt="">
					</div>
					<?php }else{ ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>">
						<video class="media_video" controls>
							<source src="<?php echo $image['image']; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php }?>
					<?php $i++;} ?>
					<div class="more_bx">
						<button type="button" class="btn">view all</button>
					</div>

				</div>
				<?php } ?>

				<?php } ?>

				<?php } ?>


				<div class="post_likeshare">
					<ul class="likeshare_ul" id="d_post_div">
						<li>
							<button type="button" class="btn_line" id="like_id"
								value="<?php echo $post_infos['id']; ?>">
								<span id="post_like_span_id_<?php echo $post_infos['id']; ?>">
									<?php if($post_infos['user_post_is_like']== 'Yes'){ ?>
									<i class="ri-thumb-up-fill"></i>
									<?php }else{ ?>
									<i class="ri-thumb-up-line"></i>
									<?php } ?>
								</span>
								<span>Like</span>
								<sup id="like_count_<?php echo $post_infos['id']; ?>">
									<?php echo $post_infos['post_like_count']; ?>
								</sup>
							</button>
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
						<li>
							<!-- value="<//?php echo $goodies_listings['id'] ?>" -->
							<a type="button" id="share_id" class="share">
								<span><i class="ri-share-fill"></i></span>
								<span>Share</span>
							</a>
							<ul class="share_ul">
								<li>
									<a href="javascript:void(0);" target="_blank"><i class="fa fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li><a href="javascript:void(0);" target="_blank"><i class="fa fa-youtube"></i></a></li>
								<li><a href="javascript:void(0);" target="_blank"><i class="fa fa-linkedin"></i></a>
								</li>
								<li><a href="javascript:void(0);" target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
								<li><a href="javascript:void(0);"><i class="ri-file-copy-fill"></i></a></li>
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
			<?php } ?>
			<?php }else{ ?>
			<div class="no_record_box">
				<div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt="">
				</div>
				<h3>No record Found</h3>
				<p>Post Not found</p>

			</div>
			<?php } ?>
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
					<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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
					<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="edit_reply_comment_model_id">

			</div>

		</div>
	</div>
</div>

<div class="modal fade pstaudemdl" id="audience_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle"
	aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Post Audience</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
				<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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
											src="{{URL::to('/public/website')}}/images/icon/public.png" alt=""></span>
									<input type="radio" checked="checked" name="radio">
									<span class="amchr"></span>
									Public
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="{{URL::to('/public/website')}}/images/icon/friends.png" alt=""></span>
									<input type="radio" checked="checked" name="radio">
									<span class="amchr"></span>
									Friends
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="{{URL::to('/public/website')}}/images/icon/only_me.png" alt=""></span>
									<input type="radio" checked="checked" name="radio">
									<span class="amchr"></span>
									Only me
								</label>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
						<button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	//$('#image_profile').change(handleFileSelect);
	$("#image_profile").change(function () {
		var fileUploadSize = this.files[0].size;
		var fileSize = 100 * 1000000;
		if (fileUploadSize > fileSize) {
			alert('Please upload file less then 100 MB');

		} else {
			$('#view_imgvideo').hide();
			$('#output_image').html('');

			var input = this;
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
							span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
							document.getElementById('output_image').insertBefore(span, null);
							$('#view_imgvideo').show();
						} else if (fileType === 'video') {
							span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
							document.getElementById('output_image').insertBefore(span, null);
							$('#view_imgvideo').show();
						}
					});
					reader.readAsDataURL(input.files[i]);
				}
			}
		}
	});
	$("#image").change(function () {
		var fileInput = document.getElementById('image');
		var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
		$(".video").attr("src", fileUrl);
	});
	$('#output_image').on('click', '.remove_img_preview', function () {
		$(this).parent('span').remove();
		$(this).val("");
	});




</script>
<script>
	new EmojiPicker({
		trigger: [
			{
				selector: '.emoji-btn',
				insertInto: ['.pro_text'] // '.selector' can be used without array
			}
		],
		closeButton: true,
	});
</script>