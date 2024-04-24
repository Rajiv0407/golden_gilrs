<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
  <title>Golden Girls</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{URL::to('/public/website')}}/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::to('/public/website')}}/css/intlTelInput.css">
  <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}">


  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/style.css?v={{ time() }}">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/responsive.css?v={{ time() }}">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/only_login.css?v={{ time() }}">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/loveround-font/lovoround-fonts.css">


</head>

<body>
  <div id="loader_spineer" style="display:none;">
  <div class="loader_bx">
    <span class="loader_inner"> </span>
  </div>
</div>
  <header class="navbar_menu login_header">
    <div class="container-custom">

      <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="#"><img src="{{URL::to('/public/website')}}/images/logo.png?v=<?php echo time() ; ?>" alt="">
          <p class="sel_country" id="ggCountrId">London</p>
        </a>
        <div class="frm_grp frm-country  parent">
          <!-- TT -->
          <?php 
            $defaultCountry=session()->get('defaultCountry');
            $country=getCountry(); 



          ?>
          <select class="f-control f-dropdown select" id="gg_country" name="gg_country" onchange="ggCountry()" placeholder="Select Country">
            <?php 

              if(!empty($country)){
                foreach ($country as $key => $value) {  ?>
                <option value="<?php echo $value->id ; ?>"  data-country="<?php echo $value->name ; ?>" data-thumbnail="{{URL::to('/public/website')}}/logo/<?php echo $value->logo ; ?>"  ><?php echo $value->name ; ?></option>
              <?php  }
              } ?>
        
          </select>
          <div class="lang-select">
            <button class="btn-select" value=""></button>
            <div class="b">
              <ul id="a"></ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="login_Home" id="singup_form" style="display: none;">
    <div class="login_wrapp">
      <div class="login_inner">
        <div class="login_card">
          <span id="lblErrorMsg"></span>
          <div class="hd_title">
            <!-- <a href="#" class="login"><img src="{{URL::to('/public/website')}}/images/logo.svg" alt=""></a>   -->
            <h3>Register to join the glamour <br> world of Golden Girls</h3>
          </div>
          <form id="signup_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">
            <div class="frm_sect">
              <div class="row">
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                    <span id="error_first_name" class="err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                    <span id="error_last_name" class="err"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                    <span id="error_email" class="err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">Mobile Number</label>
                    <input type="number" name="mobile_number" id="mobile_number" placeholder="Mobile Number" class="form-control tel_input">
                    <span id="error_mobile_number" class="err"></span>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">Date of Birth</label>
                    <input type="date" name="dob" id="dob" placeholder="dd/mm/yy" class="form-control">
                    <span id="error_dob" class="err"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="frm_grp">
                    <label for="">Nationality</label>
                    <input type="text" name="nationality" id="nationality" placeholder="Nationality" class="form-control">
                    <span id="error_nationality" class="err"></span>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">

                  <div class="frm_grp">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                    <span id="error_password" class="err"></span>
                  </div>
                </div>

              </div>
              <div class="frm_grp"></div>
              <div class="btn_login frm_grp">
                <button class="btn" onclick="singup()">Register Now </button>
              </div>

            </div>
          </form>
          <div class="bottm_txt" id="signup_form_hide">
            Already Registered? <a href="javascript:void(0);">Login</a>
          </div>

        </div>

      </div>

    </div>

  </section>
  <section class="login_Home" id="login_form">
    <div class="login_wrapp">
      <div class="login_inner">
        <div class="login_card">
          <div class="hd_title">
            <!-- <a href="#" class="login"><img src="assets/images/logo.svg" alt=""></a> -->
            <h3>Login to the glamour <br> world of Golden Girls</h3>
          </div>
          <span id="error_user_name_password" class="err"></span>
          <div class="frm_sect">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
              {!! implode('', $errors->all(':message <br>')) !!}
            </div>
            @endif

            <form id="login_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">
              <div class="frm_grp w-100">
                <label for="">Email</label>
                <input type="text" name="login_email" id="login_email" placeholder="Email" class="form-control">
                <span id="error_login_email" class="err"></span>
              </div>


              <div class="frm_grp w-100">
                <label for="">Password</label>
                <input type="password" name="login_password" id="login_password" placeholder="Password" class="form-control">
                <span id="error_login_password" class="err"></span>
              </div>

              <div class="frm_grp"></div>
              <!--- <div id="loadingGife" style="display: none;"><img src="{{URL::to('/public/website')}}/images/loader.gif"></div> -->

              <div class="btn_login frm_grp">
                <div class="frget_btn">
                  <button class="btn" onclick="login()">Login <div id="loadingGife" style="display: none;" class="loader_wrap"><span class="loader"></span></div></button>

                  <a href="javascript:void(0);" id="forget_password">Forgot Password?</a>
                </div>

              </div>
            </form>
          </div>

          <div class="bottm_txt" id="login_form_hide">
            Don't have an account? <a href="javascript:void(0);">Signup</a>
          </div>

        </div>

      </div>

    </div>

  </section>


  <section class="login_Home forget_home" id="forget_form">
    <div class="login_wrapp">
      <div class="login_inner">
        <div class="login_card">
          <div class="hd_title">
            <!-- <a href="#" class="login"><img src="assets/images/logo.svg" alt=""></a> -->
            <h3>Forgot Your Password</h3>
            <p>Lost Your Password? Please Enter your email address. You will receive a New Password Via Email.</p>
          </div>
          <span id="forgot_user_name_password" style="color:green"></span>
          <div class="frm_sect">

            <form id="forgot_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">
              <div class="frm_grp w-100">
                <label for="">Email Address </label>
                <input type="text" name="forgot_email" id="forgot_email" placeholder="Enter Email" class="form-control">
                <span id="error_forgot_email" class="err"></span>
              </div>


              <!-- <div id="loadingGife" style="display: none;"><span class="loader"></span></div> -->
              <div class="btn_login frm_grp">
                <div id="floadingGife" style="display: none;">
                  <!-- <img src="{{URL::to('/public/website')}}/images/loader.gif"> -->
                </div>
                <button class="btn" onclick="forgot_password()">Reset Password</button>
              </div>
            </form>
          </div>
          <div class="bottm_txt" id="signup_form_hide">
            Already Registered? <a href="javascript:void(0);" id="login_forget">Login</a>
          </div>

        </div>

      </div>

    </div>
  </section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="{{URL::to('/public/website')}}/js/bootstrap.min.js"></script>
  <script src="{{URL::to('/public/website')}}/js/intlTelInput.js"></script>
  <script src="{{URL::to('/public/website')}}/js/utils.js"></script>
  <script src="{{URL::to('/public/website')}}/js/custom.js"></script>
  <script src="{{URL::to('/public/website')}}/js/jquery.notyfy.js?v={{ config('app.version') }}" type="text/javascript"></script>
  <script src="{{URL::to('/public/website')}}/js/notyfy.init.js?v={{ config('app.version') }}" type="text/javascript"></script>


  <script>
    //country phone input
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
      preferredCountries: ['in', 'uk'],
      preventInvalidNumbers: true,
      separateDialCode: false,
      initialCountry: "gb",
    });
    // on keyup / change flag: reset
    // telInput.on("keyup change", reset);
  </script>
  <script>
    setTimeout(function() {
      $('.alert-success').hide();
    }, 3000);
    var baseUrl = "{{ url('/') }}";

    function singup() {

      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var email = $('#email').val();
      var mobile_number = $('#mobile_number').val();
      var dob = $('#dob').val();
      var nationality = $('#nationality').val();
      var password = $('#password').val();

      var cehckAge = ageRestriction(dob);
      
//Age must be greater than or equal to 18
      $('.err').html('');
      if (first_name == '') {
        $('#error_first_name').html('Please enter first name');
      } else if (last_name == '') {
        $('#error_last_name').html('Please enter last name');
      } else if (email == '') {
        $('#error_email').html('Please enter email');
      } else if (mobile_number == '') {
        $('#error_mobile_number').html('Please enter mobile number');
      } else if (mobile_number.length < 8) {
        $('#error_mobile_number').html('Please enter minimum 8 digits');
      } else if (mobile_number.length > 12) {
        $('#error_mobile_number').html('Please enter maximum 12 digits');
      } else if (dob == '') {
        $('#error_dob').html('Please enter date of birth');
      } else if (!cehckAge) {
        $('#error_dob').html('Age must be greater than or equal to 18');
      } else if (nationality == '') {
        $('#error_nationality').html('Please enter nationality');
      } else if (password == '') {
        $('#error_password').html('Please enter password');
      } else if (password.length < 8) {
        $('#error_password').html('Please enter maximum 8 characters');
      } else {
        ///var formData = $('#profile_forms').serialize();
      $('#loader_spineer').show();
        var formData = new FormData($('#signup_forms_id')[0]);
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
              // statusMesage('Registered successfully','success');
              $('#signup_forms_id')[0].reset();
              window.location = baseUrl + '/home';
            } else if (res.status == 2) {
              $('#loader_spineer').hide();
              $('#error_email').html('Email id already Registered');
            } else {
              $('#loader_spineer').hide();
              statusMesage('something went wrong', 'error');
            }
          }

        });
      }
    }


function ajaxCsrf() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
   
   function ageRestriction(date){
      var dob=date.split('-');
      
      var day = parseInt(dob[2]);
      var month = parseInt(dob[1]);
      var year = parseInt(dob[0]);
      var age = 18;

     
      var setDate = new Date(year + age, month - 1, day);
      var currdate = new Date();

      if (currdate >= setDate) {
       
        return true ;
      } else {
       
        return false ;
      }

   }


    function login() {
      var email = $('#login_email').val();
      var password = $('#login_password').val();

      $('.err').html('');
      if (email == '') {
        $('#error_login_email').html('Please enter email');
      } else if (password == '') {
        $('#error_login_password').html('Please enter password');
      } else {
        var formData = $('#login_forms_id').serialize(); //new FormData($('#login_forms_id')[0]);				
      
        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/do_login',
          data: formData,
          beforeSend: function() {
            $('#loadingGife').show();
            //ajax_before();
          },
          success: function(res) {
            // ajax_success() ;
            if (res == 1) {
              $('#loadingGife').hide();
              //$("#login_forms_id")[0].reset();  
              window.location = baseUrl + '/home';
            } else if (res == 2) {
              $('#loadingGife').hide();
              $("#error_user_name_password").html("Incorrect username or Password");
            } else if (res == 3) {
              $('#loadingGife').hide();
              $("#error_user_name_password").html("Your account is inactive. Please contact with <a href=mailto:'admin@goldengirls.world'>admin</a>.");
            } else {
              statusMesage('something went wrong', 'error');
            }
          }

        });
      }
    }

    function forgot_password() {
      var email = $('#forgot_email').val();
      $('.err').html('');
      if (email == '') {
        $('#error_forgot_email').html('Please enter email');
      } else {
        var formData = $('#forgot_forms_id').serialize();
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

            // ajax_success() ;
            if (res == 2) {
              $('#floadingGife').hide();
              $('#forgot_email').val("");
              $("#forgot_user_name_password").html("Email has been sent on your registerd email id");

            } else if (res == 3) {
              $('#floadingGife').hide();
              $("#error_forgot_email").html("This email id not register with us");

            } else {
              statusMesage('something went wrong', 'error');
            }
          }

        });
      }
    }
  </script>


  <script type="text/javascript">
    var primaryColor = '#6fa362',
      dangerColor = '#b55151',
      infoColor = '#466baf',
      successColor = '#yellow',
      warningColor = '#ab7a4b',
      inverseColor = '#45484d';
    var themerPrimaryColor = primaryColor;

    $(document).ready(function(){
      $('.btn-select').html('<li><img src="<?php echo URL('/').'/public/website/logo/flag_london.png' ; ?>" alt="" value="5"/><span>UK</span></li>').attr('value', 5);
    });

    function statusMesage(message, notifyType) {
      $.notyfy.closeAll();
      $('#lblErrorMsg').notyfy({
        layout: 'bottom',
        modal: false,
        dismissQueue: false,
        timeout: 3000,
        text: message,
        type: notifyType
      });

    }

    function ggCountry(countryName,value,imgUrl){    
     
    var gc=$('#gg_country').val() ;
    $('#ggCountrId').text(countryName);
     ajaxCsrf();
      $.ajax({
        type: "post",
        url: baseUrl + '/updateCountrySession',
        data:{'countryName':countryName,'value':value,'imgUrl':imgUrl},
        success: function (response) {
          
        }
    });

}
  </script>

</body>

</html>