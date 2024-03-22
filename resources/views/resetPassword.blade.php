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
          
          
          
        </div>
      </nav>
    </div>
  </header>

  
  <section class="login_Home" id="login_form">
    <div class="login_wrapp">
      <div class="login_inner">
        <div class="login_card">
          <div class="hd_title">
            <!-- <a href="#" class="login"><img src="assets/images/logo.svg" alt=""></a> -->
            <h3>Reset password</h3>
          </div>
          
           <span id="forgot_user_name_password" style="color:green"></span>
          <div class="frm_sect">
           
            <form id="forgot_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">
              <div class="frm_grp w-100">
                <input type="hidden" value="<?php echo $encryption ; ?>" name="encryption">
                <label for="">Enter new password </label>
                <input type="password" name="password" id="forgot_email" placeholder="Enter new password" class="form-control">
                <span id="error_forgot_email" class="err"></span>
              </div>
              <div class="btn_login frm_grp">
                <div id="floadingGife" style="display: none;">

                </div>
                <button class="btn" onclick="reset_password()">Submit</button>
              </div>
            </form>
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

    function reset_password() {
      var password = $('#forgot_email').val();
      $('.err').html('');
      if (password == '') {
        $('#error_forgot_email').html('Please enter new password.');
      } else if (password.length < 8) {
        $('#error_forgot_email').html('Please enter maximum 8 characters password');
      }else {
        $('#loader_spineer').show();
        var formData = $('#forgot_forms_id').serialize();
        ajaxCsrf();
        $.ajax({
          type: "post",
          url: baseUrl + '/updateUserPassword',
          data: formData,
          beforeSend: function() {
          },
          success: function(res) {

              $('#loader_spineer').hide();
              $('#forgot_email').val("");
              $("#forgot_user_name_password").html("Your password has been reset successfully.");
              setTimeout(function(){
                $("#forgot_user_name_password").html('');
              },1000);
              window.location = baseUrl ;

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