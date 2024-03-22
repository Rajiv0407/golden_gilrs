<!DOCTYPE html>
<html>
<head>  
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Golden Girls</title>
  </head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/bootstrap.min.css?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">	
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
	<link rel="stylesheet" href="{{URL::to('/public/website')}}/css/intlTelInput.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/public/website')}}/css/style.css?v={{ time() }}">
	<link rel="stylesheet" href="{{URL::to('/public/website')}}/lib/css/emoji.css?v={{ time() }}" rel="stylesheet">
    <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}" >
	
	
	
	<!--  -->
   </head>
<body>
    <script type="text/javascript">
         var baseUrl = "{{ url('/') }}";
		 var imageUrl = "{{ url('/public/website') }}";
    </script>
	  
    <div class="grid-container">
         <header class="navbar_menu">
        @include('includes.website.header')
		</header>
             <div class="main_cont">
				     @yield('content') 
             </div>
             <footer class="footer_copy">
               @include('includes.website.footer')
            </footer>			 
    </div>	
 <!-- partial -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{URL::to('/public/website')}}/js/intlTelInput.js"></script>
	<script src="{{URL::to('/public/website')}}/js/utils.js"></script>
    <script src="{{URL::to('/public/website')}}/js/custom.js?v={{ time() }}"></script>
	<script src="{{URL::to('/public/website')}}/lib/js/config.min.js?v={{ time() }}"></script>
	<script src="{{URL::to('/public/website')}}/lib/js/util.min.js?v={{ time() }}"></script>  
	<script src="{{URL::to('/public/website')}}/lib/js/jquery.emojiarea.min.js?v={{ time() }}"></script>
	<script src="{{URL::to('/public/website')}}/lib/js/emoji-picker.min.js?v={{ time() }}"></script>
   





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
   
   <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: baseUrl+'/public/website/lib/img',  
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script> 
	
	
   
</body>

</html>
