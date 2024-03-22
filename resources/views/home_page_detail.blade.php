<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
  <!-- Facebook Share -->
<meta property="og:title" content="Golden Girls" />
<meta property="og:type" content="website" />
<meta property="og:url"  content="<?php echo isset($data['ogurl'])?$data['ogurl']:'' ; ?>" />
<meta property="og:image:width" content="450"/> 
<meta property="og:image:height" content="298"/>

<meta property="og:image" content="<?php echo isset($data['ogImage'])?$data['ogImage']:'' ; ?>"  />

<meta property="fb:app_id" content="1186143922770318" />
<meta property="og:description" content="<?php echo isset($data['ogdescription'])?$data['ogdescription']:'' ; ?>" />
<meta property="og:site_name" content="">
<meta property="og:updated_time" content="1709895566" />
<link rel="canonical" href="<?php echo URL('/') ; ?>"> 

  <!-- End -->
  <title>Golden Girls</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::to('/public/website')}}/css/intlTelInput.css">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/style.css?v={{ time() }}">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/responsive.css?v={{ time() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="{{URL::to('/public/website')}}/lib/css/emoji.css?v={{ time() }}" rel="stylesheet">
  <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}">

</head>

<body>
	  <script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var imageUrl = "{{ url('/public/website') }}";
  </script>
  <div id="loader_spineer" style="display:none;">
  <div class="loader_bx">
    <span class="loader_inner"> </span>
  </div>
</div>
<?php if(!isset($data['userId'])){ ?> 
  <header class="navbar_menu login_header">
    <div class="container-custom">

      <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#"><img src="{{URL::to('/public/website')}}/images/logo.png?v=<?php echo time() ; ?>" alt="">
          <p class="sel_country" id="ggCountrId">London</p>
        </a>
        
      </nav>
    </div>
  </header>
<?php }else if(isset($data['userId'])){ ?> 
	 <header class="navbar_menu">
      @include('includes.website.header')
    </header>
<?php } ?>
  
<div class="user_prof">
<div class="center_menu center_menu_data">
<div class="post_list" id="post_listing">
	<?php 

	if (!empty($post_info)) {     ?>
			<?php foreach ($post_info as $post_infos) {  ?>
				<div class="post_card"  id="post_card_lisitng_<?php echo $post_infos['id'] ?>">
				<div class="post_hd">

					<div class="post_user">
						<div class="user_avtar">
							<div class="img_bx">
								<img src="<?php echo $post_infos['user_image'];  ?>" alt="">
							</div>
							<div class="user_details">
								<div>
									<h3><a 
										<?php if($loginUserId==0){ ?>href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login_post" <?php } else { ?>href="{{URL::to('/')}}/profile/<?php echo $post_infos['post_user_id']; ?>" <?php } ?>
										>
											<?php echo $post_infos['name'];  ?>
										</a></h3>
									<p>
										<span><?php echo $post_infos['time'];  ?></span>
									 <input type="hidden" name="current_postListP" id="current_postListP_<?php echo $post_infos['id'] ; ?>" value="<?php echo $post_infos['privacy'] ; ?>">
										<span class="pabx">
											<a href="javascript:void();" <?php if($loginUserId==$post_infos['post_user_id']){ ?>data-bs-toggle="modal" data-bs-target="#post_list_privacy_modal" onclick="postListingPrivacy('<?php echo $post_infos['id'] ; ?>')" <?php } ?> >
												<img src="{{URL::to('/public/website')}}/images/icon/<?php echo $post_infos['post_type']; ?>" id="pListPrivacy_<?php echo $post_infos['id'] ; ?>" width="12px" alt="">
											</a>
										</span>	
																			
									</p>
								</div>
							</div>
						</div>
					</div>

					<?php if ($post_infos['post_user_id'] == $loginUserId) { ?>
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li id="edit_id"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editpost"
									onclick="editPost(<?php echo $post_infos['id'];  ?>,2);">Edit</a></li>
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
				<div class="single_imgvideo" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ?>,<?php echo $loginUserId ; ?>);">
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
					<div class="post_box" id="banner_image_<?php echo $image->id; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ?>,<?php echo $loginUserId ; ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $image->id; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ?>,<?php echo $loginUserId ; ?>);">
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
						onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ; ?>,<?php echo $loginUserId ; ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>"  onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id ; ?>,<?php echo $loginUserId ; ?>);">
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
					<div class="post_box" id="banner_image_<?php echo $post_infos['id']; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id; ?>,<?php echo $loginUserId ; ?>);">
						<img class="media_img" src="<?php echo $image->thumbnail; ?>" alt="">
					</div>
					<?php } else { ?>
					<div class="post_video" id="banner_image_<?php echo $post_infos['id']; ?>" onclick="model_data(<?php echo $post_infos['id']; ?>,<?php echo $image->id; ?>,<?php echo $loginUserId ; ?>);" >
						<video class="media_video" controls poster="<?php echo $image->thumbnail ; ?>" preload="metadata">
							<source src="<?php echo $image->image.'#t=0.1'; ?>" type="video/mp4">
						</video>
					</div>
					<?php } ?>

					<?php } ?>
					<?php $i++;
										} ?>
					<div class="more_bx" onclick="model_data(<?php echo $post_infos['id']; ?>,0,<?php echo $loginUserId ; ?>);">
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
								value="<?php echo ($loginUserId===0)?$loginUserId:$post_infos['id']; ?>">

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
										onclick="post_like_model(<?php echo $post_infos['id']; ?>,<?php echo $loginUserId ; ?>)">
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
							<button type="button" class="btn_line" id="message_idklkl"
								value="<?php echo $post_infos['id']; ?>" <?php if($loginUserId==0){ ?> data-bs-toggle="modal" data-bs-target="#login_post" <?php } ?> >
								<span>
									<i class="ri-message-2-line"></i>

								</span>
								<span>Comment</span>
								<sup id="message_count_<?php echo $post_infos['id']; ?>">
									<?php echo $post_infos['post_comment_count']; ?>
								</sup>
							</button>
						</li>
						<?php if($loginUserId > 0){ ?> 
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

<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_infos['post_share_url']; ?>"
target="_blank"><i class="fa fa-linkedin"></i></a>
</li>

</ul>
</li>
<?php } ?>
					</ul>
				</div>
				<div class="post_chat_sect" id="post_chat_sect_<?php echo $post_infos['id'] ?>" <?php if(isset($data['userId'])){ ?>style="display:none" <?php }else{ ?>style="display:none;" <?php } ?>>
					<div class="user_img"><img src="<?php echo $post_infos['session_image']; ?>" alt=""></div>
					<div class="send-message">
						<form id="comment_save_id_<?php echo $post_infos['id']; ?>" action="javascript:void(0);">
							<div class="post_text_area">
								<textarea rows="1" formcontrolname="ComentMeassge" type="text"
									id="comment_<?php echo $post_infos['id']; ?>" placeholder="Comment"
									class="msg_int_style ng-valid ng-pristine ng-touched"
									ng-reflect-name="ComentMeassge"></textarea>
								<span id="error_comment" class="err"></span>
							</div>
							
							<button class="btn_post" onclick="save_comment(<?php echo $post_infos['id']; ?>)">
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
				<div id="loadmorePDetail"></div>
				
			</div>
<?php } } ?>
</div>
</div>
</div>



<!-- Login Modal for post  -->

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login_post">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade login_post_modal" id="login_post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="login_postLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
			<!-- <i class="fa fa-times" aria-hidden="true"></i> -->
			<!-- <i class="ri-close-line"></i> -->
	</button>
      </div>
      <div class="modal-body">
       

	  <div class="login_p_wrap">
		<h4>See More on Golden Girls</h4>
		<div class="login_pst_frm" id="loginForm">
			<form action="javascript:void(0);" id="login_form" >
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control" id="user_email" name="login_email" placeholder="Email" >
            <span class="err" id="err_user_email"> Please enter email</span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="password" class="form-control" name="login_password" id="user_password" placeholder="Password" >
            <span class="err" id="err_user_password"> Please enter email</span>
			</div>
			<span class="err" id="err_login_form"></span>
			<div class="login_p_btn">
				<button class="btn" onclick="loginUser()">Log in</button>
				<a href="javascript:void(0);" class="forgotAccount">Forgotten password</a>
			</div>
			</form>

			<div class="or_create">
            <span>or</span>
			<button class="btn createAccount" >Create New Account</button>
			</div>

		</div>
		<div class="login_pst_frm" id="signupForm" style="display: none;">
			<form action="javascript:void(0);" id="usrRegisterForm">
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" >
            <span class="err" id="err_first_name"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" >
            <span class="err" id="err_last_name"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control" id="signup_emal" name="email" placeholder="Email" >
            <span class="err" id="err_signup_emal"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control tel_input" id="usr_mobileNo" name="mobile_number" placeholder="Mobile Number" >
            <span class="err" id="err_usr_mobileNo"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="date" name="dob" class="form-control" id="usr_dob"   placeholder="dd/mm/yy">
            <span class="err" id="err_usr_dob"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="text" class="form-control" id="usr_nationality" name="nationality" placeholder="Nationality" >
            <span class="err" id="err_usr_nationality"></span>
			</div>
			<div class=" form-group text-lg-start">
            <input type="password" class="form-control" id="signup_password" name="password" placeholder="Password" >
            <span class="err" id="err_signup_password"></span>
			</div>
			<span class="err" id="err_signup_form"></span>
			<div class="login_p_btn">
				<button class="btn" onclick="usrSignup()">Register Now</button>				
			</div>
			</form>

			<div class="or_create">
            <span>or</span>
			<button class="btn loginAccount" > Already Registered? Login </button>
			</div>

		</div>

		<div class="login_pst_frm" id="forgotPassword" style="display: none;">
			
			<p>Lost Your Password? Please Enter your email address. You will receive a New Password Via Email.</p>
			 <span id="forgot_user_name_password" style="color:green"></span>
			 <span id="err_forgot_user_name_password" style="color:red"></span>
			<form action="javascript:void(0);" id="forgotPasswordForm">
			<div class=" form-group">
            <input type="text" class="form-control" id="forgot_email" name="forgot_email" placeholder="Email Addfress" >
            <span class="err" id="err_forgot_email"></span>
			</div>
			
			<div class="login_p_btn">
				<button class="btn" onclick="forgot_password()">Reset Password</button>				
			</div>
			</form>

			<div class="or_create">
            <span>or</span>
			<button class="btn loginAccount" > Already Registered? Login </button>
			</div>

		</div>
	  </div>

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

<div class="modal fade edit_post_modal" id="editpost" tabindex="-1" role="dialog"
	aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Post</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
					<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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
					<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
				</button>
			</div>
			<div class="modal-body" id="edit_comment_model_id">

			</div>

		</div>
	</div>
</div>

<div class="modal fade pstaudemdl" id="post_list_privacy_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle"
	aria-bs-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Post Audience</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
				<img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
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
											src="{{URL::to('/public/website')}}/images/icon/public.png" alt=""></span>
									<input type="radio" checked="checked" name="postListPrivacy"  id="post_p_public" value="1">
									<span class="amchr"></span>
									Public
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="{{URL::to('/public/website')}}/images/icon/friends.png" alt=""></span>
									<input type="radio" id="post_p_friend" name="postListPrivacy" value="2">
									<span class="amchr"></span>
									Friends
								</label>
							</li>
							<li>
								<label class="amctr">
									<span class="imicon"><img
											src="{{URL::to('/public/website')}}/images/icon/only_me.png" alt=""></span>
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


<div class="sucmssg_box" id="login_succ" style="display:none;">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Login Successfully ! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>

<div class="sucmssg_box" id="signup_succ" style="display:none;">
    <div class="btm_left_box_mdl">
      <div class="media"><i class="m_icon"></i></div>
      <div class="data">
        <h3>Success</h3>
        <p>Singup Successfully ! </p>
        <div class="dismiss crs">
          <button mat-icon-button="" class="crs_btn"><i aria-hidden="true" class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
  
 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>    
  <script src="{{URL::to('/public/website')}}/js/custom.js"></script>
  <script src="{{URL::to('/public/website')}}/js/jquery.notyfy.js?v={{ config('app.version') }}" type="text/javascript"></script>
  <script src="{{URL::to('/public/website')}}/js/notyfy.init.js?v={{ config('app.version') }}" type="text/javascript"></script>
   <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    -->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


  <script type="text/javascript" src="{{URL::to('/public/website')}}/js/intlTelInput.js"></script>
  <script type="text/javascript" src="{{URL::to('/public/website')}}/js/utils.js"></script>
  <script type="text/javascript" src="{{URL::to('/public/website')}}/js/custom.js?v={{ time() }}"></script>
  <script type="text/javascript" src="{{URL::to('/public/website')}}/lib/js/config.min.js?v={{ time() }}"></script>
  <script type="text/javascript" src="{{URL::to('/public/website')}}/lib/js/util.min.js?v={{ time() }}"></script>

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit-icons.min.js"></script>
  <script src="{{URL::to('/public/website')}}/lib/js/vanillaEmojiPicker.js?v={{ time() }}"></script>

<?php 

$privacyImgPath=URL::to('/public/website').'/images/icon/' ;
$pivacyImg=array(
'public'=>$privacyImgPath.'public.png' ,
'friend'=>$privacyImgPath.'friends.png' ,
'onlyme'=>$privacyImgPath.'only_me.png' 
); 


?>

  <script type="text/javascript">
  	$(document).ready(function(){
  		var isLogin='<?php echo isset($data['userId'])?$data['userId']:'NA' ; ?>'
  		save_comment(<?php echo $data['postId'] ; ?>,2,isLogin);
  	})


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

  $('.createAccount').click(function(){  		
  		$('#signupForm').show();
  		$('#loginForm').hide();
  		$('#forgotPassword').hide();
  });

  $('.loginAccount').click(function(){
  		$('#loginForm').show();
  		$('#signupForm').hide();  		
  		$('#forgotPassword').hide();
  });

  $('.forgotAccount').click(function(){
  	    $('#forgotPassword').show();
  		$('#loginForm').hide();
  		$('#signupForm').hide();  
  });

 function loginUser(){
    
  var usrEmail=$('#user_email').val();
  var usrPassword = $('#user_password').val();

	$('.err').text('');

	if(usrEmail==''){
		$('#err_user_email').text('Please enter email');
	}else if(usrPassword==''){	
		$('#err_user_password').text('Please enter password');
	}else{
		
		 $('#loader_spineer').show(); 
		
		    var formData = $('#login_form').serialize(); //new 

		ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/do_login',
          data: formData,
          beforeSend: function() {
          
          },
          success: function(res) {
           
               $('#loader_spineer').hide();
                 
               if(res==1){
               	$('#login_succ').show();
               	$('#login_post').modal('hide');
               	
               	 location.reload();
               }else if(res==="2"){
               	$('#err_login_form').text('Invalid Credentials.');
               }else{
               	 $('#err_login_form').text('Something went wrong');
               }
             // 
           	
           	setTimeout(function(){
           			$('#login_succ').hide();
           		$('#err_login_form').text('');
           	},2000);
          }

        });

	}
  }

  function usrSignup(){

     var firstName = $('#first_name').val();
     var last_name = $('#last_name').val();
     var signup_emal = $('#signup_emal').val();
     var usr_mobileNo = $('#usr_mobileNo').val();
     var usr_dob = $('#usr_dob').val();
     var usr_nationality = $('#usr_nationality').val();
     var signup_password = $('#signup_password').val();
     $('.err').text('');
     if(firstName==''){
     	$('#err_first_name').text('Please enter first name.');
     }else if(last_name==''){
     	$('#err_last_name').text('Please enter last name.');
     }else if(signup_emal==''){
     	$('#err_signup_emal').text('Please enter email.');
     }else if(!validateEmail(signup_emal)){
     	$('#err_signup_emal').text('Please enter valid email.');
     }else if(usr_mobileNo==''){
     	$('#err_usr_mobileNo').text('Please enter mobile number.');
     } else if (usr_mobileNo.length < 8) {
        $('#err_usr_mobileNo').html('Please enter minimum 8 digits');
      } else if (usr_mobileNo.length > 14) {
        $('#err_usr_mobileNo').html('Please enter maximum 14 digits');
      }else if(usr_dob==''){	
     	$('#err_usr_dob').text('Pleas select Date of birth');
     }else if(usr_nationality==''){
     	$('#err_usr_nationality').text('Please enter nationality');
     }else if(signup_password==''){
     	$('#err_signup_password').text('Please enter password');
     }else if (signup_password.length < 8) {
        $('#err_signup_password').html('Please enter maximum 8 characters');
      } else{

     	 $('#loader_spineer').show();
       
  
         var formData = new FormData($('#usrRegisterForm')[0]);

        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/Signup',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',    
          beforeSend: function() {
          },
          success: function(res) {
            if(res.status == 1) {           
              $('#usrRegisterForm')[0].reset();
              	$('#signup_succ').show();
               	$('#login_post').modal('hide');
               	
               	 location.reload();
             
            } else if (res.status == 2) {
              $('#loader_spineer').hide();
              $('#err_signup_emal').html('Email id already Registered');
            } else {
              $('#loader_spineer').hide();
              $('#err_signup_form').text('Something went wrong');
            }
          }

        });
     }

  }

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

    var telInput = $(".tel_input")
    // initialise plugin
    telInput.intlTelInput({
      allowExtensions: true,
      formatOnDisplay: true,
      autoFormat: true,
      autoHideDialCode: true,
      autoPlaceholder: true,
      defaultCountry: "auto",
      ipinfoToken: "yolo",
      nationalMode: false,
      numberType: "MOBILE",      
      preventInvalidNumbers: true,
      separateDialCode: false,
      initialCountry: "gb",
    });


 function forgot_password() {
      var email = $('#forgot_email').val();
      $('.err').html('');
      if (email == '') {
        $('#error_forgot_email').html('Please enter email');
      }else if(!validateEmail(email)){
     	$('#error_forgot_email').text('Please enter valid email.');
     } else {
     	 $('#loader_spineer').show();
        var formData = $('#forgotPasswordForm').serialize();
        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/forgot_password',
          data: formData,
          beforeSend: function() {
            $('#floadingGife').show();
            //ajax_before();
          },
          success: function(res) {
 			$('#loader_spineer').hide();
            // ajax_success() ;
            if (res == 2) {
             
              $('#forgot_email').val("");
              $("#forgot_user_name_password").html("Email has been sent on your registerd email id");

            } else if (res == 3) {
             
              $("#error_forgot_email").html("This email id not register with us");

            } else {
               $("#err_forgot_user_name_password").html("Something went wrong.");
            }

            setTimeout(function(){
            	$("#err_forgot_user_name_password").html("");
            	 $("#error_forgot_email").html("");
            	 $("#forgot_user_name_password").html("");
            },2000);
          }

        });
      }
    }
  </script>

</body>

</html>