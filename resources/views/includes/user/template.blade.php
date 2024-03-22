<!DOCTYPE html>
<html>
<head>  
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Golden Girls</title>
  </head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/fonts/euclid-circular-fonts/fonts.css?v={{ time() }}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/fonts/Gerlomi-fonts/fonts.css?v={{ time() }}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/fonts/Loveround-font/fonts.css?v={{ time() }}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/fonts/Ogg-fonts/fonts.css?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/bootstrap.min.css?v={{ time() }}">     
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/styles_new.css?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/responsive.css?v={{ time() }}">
         
    <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}" >
	<script type="text/javascript" src="{{URL::to('/public/website')}}/js/bootstrap.min.js?v={{ config('app.version') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
	 <script  src="{{URL::to('/public/website')}}/js/custom.js?v={{ time() }}"></script>
	 
   </head>

<body>
    <script type="text/javascript">
         var baseUrl = "{{ url('/') }}";
    </script>
    <div class="grid-container">
         
        <section id="header" class="Header">
        @include('includes.user.header')
        </section>
        <section id="sidebar" class="Sidebar">
        @include('includes.user.sidebar')
             </section>			  
	    <section id="footer" class="footer">
        @include('includes.user.footer')
             </section>     

    </div>
	<div class="video-popup-overlay"></div>
 <div class="video-popup-container">
   <div class="video-popup-close">&#10006;</div>
   <div class="video-popup-iframe-container">
     <iframe class="video-popup-iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
   </div>
 </div>

 <!-- partial -->
      <script src="{{URL::to('/public/website')}}/js/jquery.notyfy.js?v={{ config('app.version') }}" type="text/javascript"></script>
      <script src="{{URL::to('/public/website')}}/js/notyfy.init.js?v={{ config('app.version') }}" type="text/javascript"></script>  
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>  
    

    <script>
        $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $("header").addClass("top-fixed");
        } else {
            $("header").removeClass("top-fixed");
        }
    });

    </script> 
	 <script type="text/javascript">
               var primaryColor = '#6fa362',
                    dangerColor = '#b55151',
                    infoColor = '#466baf',
                    successColor = '#yellow',
                    warningColor = '#ab7a4b',
                    inverseColor = '#45484d';
            var themerPrimaryColor = primaryColor;
            
            function statusMesage(message, notifyType) {

                $.notyfy.closeAll();
                $('#lblErrorMsg').notyfy({
                    layout: 'bottom',
                    modal: false,
                    dismissQueue: false,
                    timeout:3000,
                    text: message,
                    type: notifyType
                });
//                var main_check = document.getElementById('input_c');
//                main_check.checked = false;
                //$('input[id="input_c"]').prop('checked', false);
            
            }  
   </script> 
   
</body>

</html>
