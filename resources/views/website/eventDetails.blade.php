@extends('includes.website.ajax_template')
@section('content')

<div class="sell_box " id="event_detail">
  <div class="head">
    <ul class="step_bar">
      <li><a <?php if($data['isLogin']==1){ ?>href="{{URL::to('/')}}/life_style" <?php }else{ ?>href="javascript:void(0);" <?php } ?> >Event</a></li>
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

            <button type="button" class="btn" onclick="send_booking_confirm(<?php echo $data['isLogin'] ; ?>);">Join</button>
          </div>
        </div>
      </form>

    </div>

  </div>

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

          <p class="jc_dec">Now sit back and relax.  We will review your details and send you a confirmation email shortly.</p>

          <div class="jc_name">
            <p>In THE meantime, Learn more. </p>
            <!-- <h4>Golden Girls</h4> -->
          </div>

          <div class="button-group">
            <a href="{{URL::to('/')}}/aboutus" target="_blank">
              <button type="button" class="btn">About Golden Girls</button></a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Login Modal -->
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
            <span class="err" id="err_user_email"> </span>
      </div>
      <div class=" form-group text-lg-start">
            <input type="password" class="form-control" name="login_password" id="user_password" placeholder="Password" >
            <span class="err" id="err_user_password"> </span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


 
</script>
@stop