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
<link rel="canonical" href="https://goldengirls.intigate.co.in/"> 

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
<div class="center_menu center_menu_data sell_box" id="event_detail">
  <div class="head">
    <ul class="step_bar">
      <li><a href="{{URL::to('/')}}/life_style">Event</a></li>
      <li>Event Details</li>
    </ul>
  </div>

  <?php //print_r($event_info);die;   
  ?>

  <!-- <//?php echo $event_info['time']; ?>     -->

  <div class="post_detailbx">
    <div class="pd_card">
      <div class="pd_media"><img class="media" src="<?php echo $event_info['image']  ?>" alt=""></div>

      <div class="pd_head">
        <div class="pd_date">
          <span class="month"><?php echo $event_info['event_day']; ?></span>
          <span class="day"><?php echo $event_info['event_month']; ?></span>
        </div>
        <div class="pd_name">
          <h3><?php echo $event_info['event_name']; ?></h3>
          <p data-bs-toggle="modal" data-bs-target="#manage-members"><i class="ri-group-fill"></i><?php echo $event_info['event_view_count'];   ?> people responded</p>
        </div>
      </div>

      <div class="pd_dscrpn">
        <p><?php echo $event_info['event_descrption']; ?></p>
      </div>

      <div class="lctn_view">
        <ul class="lctn_ul">
          <li>
            <span><i class="ri-calendar-todo-fill"></i></span>
            <span><?php echo $event_info['event_date']; ?></span>
          </li>
          <li>
            <span><i class="ri-eye-fill"></i></span>
            <span><?php echo $event_info['event_view_count'];   ?> View</span>
          </li>
          <li>
            <span><i class="ri-time-fill"></i></span>
            <span><?php echo $event_info['event_time']; ?></span>
          </li>
          <!-- <li>
            <span><i class="ri-road-map-fill"></i></span>
            <span>2.5 Miles</span>
          </li> -->
          <li>
            <span><i class="ri-map-pin-fill"></i></span>
            <span><?php echo $event_info['address']; ?></span>
          </li>
        </ul>
      </div>

    </div>

    <div class="pd_card">
      <div class="head">
        <h3><i class="ri-coupon-fill"></i> Tickets</h3>
      </div>

      <form id="booking_event" action="javascript:void(0);" method="post">
        <!-- <div id="field1">Please select number of ticket</div> -->
        <div class="pd_tkt_bx">
          <div class="pdt_name">
            <p>Standard Price</p>
          </div>
          <div class="pdt_fr">
            <div class="wrap">
              <input type="hidden" name="booking_type" value="1">
              <input type="hidden" name="type_id" value="<?php echo $event_info['id']; ?>">

              <button type="button" class="sub" id="sub">-</button>
              <input type="text" class="count" name="no_ticket" id="no_ticket" value="1" min="1" max="10" readonly />
              <button type="button" class="add" id="add">+</button>
            </div>

            <button type="button" class="btn" onclick="send_booking_confirm();">Join</button>
          </div>
        </div>
      </form>

    </div>

  </div>

</div>
</div>
<div style="height:100px;">
	
</div>

<div class="modal fade small_modal" id="event_booking_modal" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalCenterTitle" aria-bs-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-0 p-0">
        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
          <img src="{{URL::to('/public/website')}}/images/icon/close_button.png" alt="">
        </button>
      </div>
      <div class="modal-body">

        <div class="join_cont">

          <div class="jc_head">
            <i class="ri-checkbox-circle-fill"></i>
            <h3>You have Succeeded</h3>
          </div>

          <p class="jc_dec">Now sit back and relax. Now it was our work to check out your details. We will send you Email Confirmation once we are done.</p>

          <div class="jc_name">
            <p>In mean time, Know about</p>
            <h4>Golden Girls</h4>
          </div>

          <div class="button-group">
            <a href="{{URL::to('/')}}/life_style">
              <button type="button" class="btn">About Golden Girls</button></a>
          </div>

        </div>
      </div>
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



<script>
  $("#life_style_id").addClass("active");
  $("#goodies_style_id").removeClass("");
  $('.add').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() < 10) th.val(+th.val() + 1);
  });
  $('.sub').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() > 1) th.val(+th.val() - 1);
  });
</script>

  <script type="text/javascript">
  	$(document).ready(function(){
  		var isLogin='<?php echo isset($data['userId'])?$data['userId']:'NA' ; ?>'
  		
  	})







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