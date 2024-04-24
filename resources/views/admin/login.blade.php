<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Golden Girls || Admin</title>  
      <link rel="stylesheet" type="text/css" href="{{URL::to('/public/admin')}}/css/style.css">      
      <link rel="stylesheet" type="text/css" href="{{URL::to('/public/admin')}}/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="{{URL::to('/public/admin')}}/css/admin_reponsive.css?v={{ time() }}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
      <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}" >
      <meta name="csrf-token" content="{{ csrf_token() }}"> 
      <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
   </head>
   <body>
    <script type="text/javascript">
          jQuery(function ($) {
            document.title = 'Admin Login';
       
    });


         window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button";
    window.onhashchange=function(){window.location.hash="no-back-button";}
     
    </script>
    <section class="lg_login__box">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-7 p-0"> 
          <div class="lg_login_img">
            <img src="{{URL::to('/public/admin/')}}/images/goldengirl_img.png" class="img-fluid">
          </div>
        </div>
        <div class="col-md-5 p-5">
        <div class="admin_login">
        <div class="account-logo-box">
        <img src="{{URL::to('/public/admin/')}}/images/admin_logo.png" alt="">

                  <!-- <h2 class="text-uppercase text-center">
                      <a href="" class="text-success">
                     <span><img src="{{URL::to('/public/admin/')}}/images/logo.png?v1" alt=""></span>
                     </a> 
                  </h2> -->
               </div>
          <div class="account-box">
               <div class="main-login-box account-content">
                  <div class="login-bg-box login">
                     <div class="login-box-right" id="dvLogin">
                        <div id="pnl">
                          <div class="lg_login_heading">
                          <h2>Login!</h2>
                          <h5>Please sign in to continue.</h5>
						   <div id="error_invalidpass" class="errorbox"></div> 
                           </div>
						   
                           <div class="panel-body innerAll">
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
                              <form name="loginform" id="loginform" action="javascript:void(0);" method="post" onsubmit="loginValidation()" autocomplete="off">
                              <div class="form-group form-group_copy">
                                  <label>UserName</label>
                                    <input type="text" placeholder="Enter user name" class="form-control" id="txtUserName" onkeyup="removeError()" name="txtUserName" onclick="remove_valid(this.id)" onkeypress="remove_valid(this.id)" value="{{$userName}}" autofocus>
                                    <span id="error_txtUserName" class="errorbox"></span>
                               </div>
                                 <div class="form-group form-group_copy">
                                    <label>Password</label>                             
                                    <input type="password" placeholder="Password" class="form-control" id="txtPassword" onkeyup="removeError()" name="txtPassword" onclick="remove_valid(this.id)" onkeypress="remove_valid(this.id)" value="{{$userPassword}}">
                                    <span id="error_txtPassword" class="errorbox"></span>
                                 </div>

                               
                                 <div class="form-group form-group_copy">
                                       <label class="con">
                                          <span>Remember me?</span>
                                          <input type="checkbox" name="rememberMe" value="1">
                                          <span class="checkmark"></span>
                                       </label>
                                 </div>

                                 <!-- <div id="loadingGif2" style="display: none;"><img src="{{URL::to('/public/admin')}}/images/loader.gif"></div> -->
                                 
                                
                                 <div class="btnlogin">
                                    <button class="btn btn-primary" id="btnLogin" type="submit" style="position:relative;">Sign In <div class="spinner-border" id="loadingGif2" style="display: none;"></div></button> 
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

        </div>
        </div>

      </div>

      </div>


    </section>

      <script type="text/javascript">


         function loginValidation(){   
         
                 var txtUserName = document.loginform.txtUserName.value;
                 var txtPassword = document.loginform.txtPassword.value;
                 $("#error_txtUserName").html("");
                 $("#error_txtPassword").html("");
                 document.loginform.txtUserName.style.borderColor = "";
                 document.loginform.txtPassword.style.borderColor = "";
                 if (txtUserName == "") {
                     document.loginform.txtUserName.focus() ;    
                     document.loginform.txtUserName.style.borderColor = "red";
                     $("#error_txtUserName").html("User Name is required.");
                     return false;
                 }
                 else if (txtPassword == "") {
                     document.loginform.txtPassword.focus() ;
                     document.loginform.txtPassword.style.borderColor = "red";
                     $("#error_txtPassword").html("Password is required");
                     return false;
                 }
                 else {   
                     loginchk();
                 }
                 
         }
         
         function remove_error(){
         $('.err').html('');
         }
         function removeError(){
         $('.err').html('');
         }
         function remove_valid(id) {
         
                 $('#'+id).css('border-color', '');
                 $('#'+id).siblings('.errorbox').html('');
                 $('#err_msg').html('');
                 $('#error_txtfusername').html('');
           }
         


function ajaxCsrf() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}


         function loginchk() {
       
          ajaxCsrf();
         var baseUrl = "{{ url('/') }}";
         $.ajax({
         type: "POST",
         url: baseUrl + '/administrator/do_login',
         data: $('#loginform').serialize(),
         cache: 'FALSE',
         beforeSend: function () {
                $('#loadingGif2').show();
         },
         success: function (res) {
         //return false ;
           $('#loadingGif2').hide();
         if (res.trim()=='fail')
         {
			 $("#error_invalidpass").html('Incorrect username or Password');
       
         }else if(res.trim()=='deleted'){
           $("#error_invalidpass").html('User does not exist.');
         }else if(res.trim()=='inactive'){
           $("#error_invalidpass").html('User is inactive.Please contact to Admin.');
         }
         else{
            window.location.reload();
            //= baseUrl + '/administrator/dashboard#index';   
         }

         setTimeout(function(){
                  $('#error_invalidpass').html('');
                },1000);  

                 }
             });
         }
         
      </script>
      <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
      <script src="{{URL::to('/public/admin/js')}}/bootstrap.min.js" type="text/javascript"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{URL::to('/public/admin/js')}}/custom.js" type="text/javascript"></script>
       

   </body>
</html>