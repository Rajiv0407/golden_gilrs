 <?php 

$session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);  

// echo "<pre>";
// print_r($user_per_info) ;

// exit ;  

  $dashboard=checkRole($user_per_info,1);

  $AdminUser=checkRole($user_per_info,2);

  $CustomerManagement=checkRole($user_per_info,3);

  $EventManagement=checkRole($user_per_info,4);

  //$CouponManagement=checkRole($user_per_info,5);
  $GoodiesManagement=checkRole($user_per_info,6);

  $BookingManagement=checkRole($user_per_info,7);
  $EventBookingManagement=checkRole($user_per_info,11);
  $GoodiesBookingManagement=checkRole($user_per_info,12);


    
  $CMS=checkRole($user_per_info,8);
  $TermConditions=checkRole($user_per_info,13); 
  $PrivacyPolicy=checkRole($user_per_info,14);

  $Master=checkRole($user_per_info,9);

  $eventType=checkRole($user_per_info,15);
  $eventFeeType=checkRole($user_per_info,16);
  
   //echo $EventBookingManagement;die;
 
?>
 <script type="text/javascript">

jQuery(document).ready(function ($) {
 /* menu selection .hash*/ 
   var hash = window.location;
 $('#letsgo_sidebar li a').each(function () {

var toBactive = $(this).attr('href');

if (toBactive == hash) {
    
    //$(this).parents('.sub-menu').addClass('show in');
    $(this).parents('li').addClass('active-li');  

}});
   /* end */
    function adminHome(){
       
        ajaxCsrf();
        mobileMenuHide();
        $.ajax({
        type: "POST",
        url: baseUrl+'/administrator/home',
        cache: 'FALSE',
        beforeSend: function () {
        ajax_before();
        },
        success: function(html){
        ajax_success() ;
        $('.main_site_data').html(html);

        }

        });
    }

$('#letsgo_sidebar').find('li a').click(function(){
   
   // $('.nav-item').removeClass('active');
   // $('#rSidemenubar').find('li a.active').removeClass('active');
   //  $('ul li .nav-item').removeClass('active');
    
   // $(this).closest('ul').hasClass('sub-menu').addClass('show in');
    if($(this).closest('ul').hasClass('sub-menu')){
     $('li').removeClass('active-li'); 
     $(this).parents('li').addClass('active-li');  
        
   }
     else{
        $('li').removeClass('active-li'); 
      $('.sub-menu').removeClass('show in');
      $(this).parent('li').addClass('active-li');
    
       } });

 /* end menu selection */
  var hash = window.location.hash;
  var res = hash.split("/");
  //var get_the_id = hash.replace('#',"").split('/');
  
        if(res!='')
        {
            $(".dashbordWrapper").css("display", "none");
        }
         if(res[0]=='#notification_for'){
            notificationFor();
        }    
        
         if(res[0]=='#index'){
            var check='<?php echo $dashboard ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               dashboard();
            }
            
        } 


        if(res[0]=='#event_type'){

           var check='<?php echo $eventType ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               eventtypeList();
            }

        } 

		if(res[0]=='#event_fee_type'){
             var check='<?php echo $eventFeeType ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                eventfeetypeList();
            }
           
        } 
		if(res[0]=='#admin_users'){
        var check='<?php echo $AdminUser ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               adminUserManagement();   
            }
            
        }
		
		if(res[0]=='#user_detail')
        {  
           var check='<?php echo $CustomerManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               user_detail(res[1]);   
            }
         
        }
		
		if(res[0]=='#customer_detail')
        {  
           var check='<?php echo $CustomerManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               customer_detail(res[1]);     
            }
          
        }
		
		if(res[0]=='#event_booking_detail')
        {  
          event_booking_detail(res[1]);       
        }
        
       if(res[0]=='#goodies_booking_detail')
        {  
          goodies_booking_detail(res[1]);         
        }		
		

		if(res[0]=='#role'){
            roleManagment();     
        }

		if(res[0]=='#customer_management'){

       var check='<?php echo $CustomerManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
               customerManagement();  
            }
            
        }

        if(res[0]=='#event'){
           var check='<?php echo $EventManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                eventList();
            }
            
           
        }	
       // if(res[0]=='#coupon'){  
       //      couponList();
       //  }
		// if(res[0]=='#booking'){    
  //           bookingList();  
  //       }
		if(res[0]=='#eventbooking'){    

          var check='<?php echo $EventBookingManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                eventBookingRequest();      
            }
            
        }
		if(res[0]=='#goodiesbooking'){ 		
            
      var check='<?php echo $GoodiesBookingManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                goodiesBookingRequest(); 
            }
           		
        }
      if(res[0]=='#goodies'){  

        var check='<?php echo $GoodiesManagement ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                goodiesList();
            }
            
        }		
        
     
        
     

        
        if(res[0]=='#termCondition'){

           var check='<?php echo $TermConditions ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                termCondition();
            }
           
        }

		if(res[0]=='#privacyPolicy'){

          var check='<?php echo $PrivacyPolicy ; ?>' ;
            if(check!=1){
              adminHome();
              return false ;
            }else{
                 privacyPolicy();
            }
           
        }

		// if(res[0]=='#country'){
  //           country();
  //       }
		// if(res[0]=='#city'){
  //           city();
  //       }  

       

        

       


       
     
});



</script>
    <div class="header_logo">
    <a class="navbar-brand" href="#">
                <img src="{{URL::to('/public/admin')}}/images/logo.svg" class="un-clp-logo" alt="">
                 <!-- <img src="{{URL::to('/public/admin')}}/images/lesgo_logo-sml.png?v" class="clp-logo" alt=""> -->
                 <span class="clp-logo">GG</span>
            </a>
            </div>	
    <div class="sidebarWrapper">   
    <ul class="height_navigation" id="letsgo_sidebar">
	    <?php if($dashboard== 1){ ?>
        <li><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard();"><img src="{{URL::to('/public/admin')}}/icon/dashboard.png"><span class="tooltip_nav">Dashboard</span></a></li>  
		<?php } ?>
		<?php if($AdminUser== 1){ ?>
        <li>
            <div class="admin_nav">
                <a class="" id="admin_n"><span><img src="{{URL::to('/public/admin')}}/icon/admin_user.png">
                     <span class="tooltip_nav">Admin Users</span>
                </span> <span class="dropdown_tog"><i class="ri-arrow-drop-down-line"></i></span></a>
                <ul class="dropdown-menu" id="drop_admin_m"> 
                <li><a href="{{URL::to('/')}}/administrator/dashboard#admin_users" onclick="adminUserManagement()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">Admin User Management</span>
                </a></li>
                </ul>
            </div>
        </li>
		<?php } ?>
		<?php if($CustomerManagement== 1){ ?>
	<li><a href="{{URL::to('/')}}/administrator/dashboard#customer_management" onclick="customerManagement()"><img src="{{URL::to('/public/admin')}}/icon/customer_management.png">
           <span class="tooltip_nav">
        Customer Management
    </span></a></li>
	<?php } ?>
	<?php if($EventManagement== 1){ ?>
	 <li><a href="{{URL::to('/')}}/administrator/dashboard#event" onclick="eventList()"><img src="{{URL::to('/public/admin')}}/icon/event_management.png">
           <span class="tooltip_nav">
        Event Management
    </span></a></li>
	<?php } ?>
	<?php /*if($CouponManagement== 1){ ?>
	<li><a href="{{URL::to('/')}}/administrator/dashboard#coupon" onclick="couponList()"><i class="ri-user-settings-line"></i>
           <span class="tooltip_nav">
        Coupon Management
    </span></a></li> 
   <?php } */ ?>	

   <?php if($GoodiesManagement==1){ ?>
  <li><a href="{{URL::to('/')}}/administrator/dashboard#goodies" onclick="goodiesList()"><img src="{{URL::to('/public/admin')}}/icon/goodies_management.png">
           <span class="tooltip_nav">
        Goodies Management
  </span></a></li> 
 <?php } ?>

  <?php if($BookingManagement== 1 || $GoodiesBookingManagement==1 || $EventBookingManagement== 1){ ?>
		<li>
            <div class="booking_nav">
                <a class="" id="booking_n"><span><img src="{{URL::to('/public/admin')}}/icon/booking_management.png">
                     <span class="tooltip_nav">Booking Management</span>
                </span> <span class="dropdown_tog"><i class="ri-arrow-drop-down-line"></i></span></a>
                <ul class="dropdown-menu" id="drop_booking_m"> 
				<?php if($EventBookingManagement== 1) { ?>
                <li><a href="{{URL::to('/')}}/administrator/dashboard#eventbooking" onclick="eventBookingRequest()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">Event Booking Request</span>
                </a></li>
				<?php } ?>
				<?php if($GoodiesBookingManagement==1){ ?>
                 <li><a href="{{URL::to('/')}}/administrator/dashboard#goodiesbooking" onclick="goodiesBookingRequest()">
                <i class="ri-arrow-right-s-line"></i> 
                <span class="tooltip_nav">Goodies Booking Request</span>
                </a></li>
				<?php } ?>
                </ul>
            </div>
        </li>
		<?php } ?>
       <?php if($CMS==1 || $TermConditions==1 || $PrivacyPolicy==1){ ?>		
        <li>
            <div class="cms_nav">
                <a class="" id="drop_nav"><span><img src="{{URL::to('/public/admin')}}/icon/cms.png">
                      <span class="tooltip_nav">CMS</span>
                </span>
                    <!-- <span class="tooltip_nav">CMS</span> -->
                <span class="dropdown_tog"><i class="ri-arrow-drop-down-line"></i></span>
                </a>
                <ul class="dropdown-menu" id="drop_content">
				    <?php if($TermConditions==1){ ?>
                    <li><a href="{{URL::to('/')}}/administrator/dashboard#termCondition" onclick="termCondition()">
                     <i class="ri-arrow-right-s-line"></i>
                     <span class="tooltip_nav">
                    Terms & Conditions
                     </span>
                </a></li>
				<?php } ?>
				<?php if($PrivacyPolicy==1){  ?>
                    <li><a href="{{URL::to('/')}}/administrator/dashboard#privacyPolicy" onclick="privacyPolicy()">
                     <i class="ri-arrow-right-s-line"></i>
                     <span class="tooltip_nav">
                       Privacy Policy
                     </span>
                </a></li>
				<?php } ?>
                </ul>
            </div>
        </li>
     <?php } ?>	
  <?php if($Master==1 || $eventType==1 || $eventFeeType==1){ ?>	 
        <li>
            <div class="master_nav">
                <a class="" id="master_n"><span><img src="{{URL::to('/public/admin')}}/icon/master.png">
                     <span class="tooltip_nav">Master</span>
                </span> <span class="dropdown_tog"><i class="ri-arrow-drop-down-line"></i></span></a>
                <ul class="dropdown-menu" id="drop_content_m"> 
  
                <?php if($eventType==1){ ?>
                <li><a href="{{URL::to('/')}}/administrator/dashboard#event_type" onclick="eventtypeList()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">Event Type</span>
                </a></li>
              <?php } ?>

              <?php if($eventFeeType==1){ ?>
                 <li><a href="{{URL::to('/')}}/administrator/dashboard#event_fee_type" onclick="eventfeetypeList()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">Event Fee Type</span>
                </a></li>
                <?php } ?>
		<!-- 		<li><a href="{{URL::to('/')}}/administrator/dashboard#country" onclick="country()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">Country</span>
                </a></li>  
				<li><a href="{{URL::to('/')}}/administrator/dashboard#city" onclick="city()">
                <i class="ri-arrow-right-s-line"></i>
                <span class="tooltip_nav">City</span>  
                </a></li> -->
				
                </ul>
            </div>
        </li>
		 <?php } ?>	
    </ul>
</div>
<script type="text/javascript">
    $("#drop_nav").click(function() { 
    $("#drop_content").delay(4000).toggleClass();
});
$("#social_drop_nav").click(function() {
    $("#drop_content12").delay(4000).toggleClass();
});
 $("#master_n").click(function() {
    $("#drop_content_m").delay(4000).toggleClass();
}); 
$("#booking_n").click(function() {
    $("#drop_booking_m").delay(4000).toggleClass();
});
$("#admin_n").click(function() {
    $("#drop_admin_m").delay(4000).toggleClass();
});
$('.cms_nav #drop_nav').click(function(){
    $('.cms_nav #drop_nav').toggleClass('show_submenu');
});
 $('.master_nav #master_n').click(function(){
    $('.master_nav #master_n').toggleClass('show_submenu');
}); 
$('.booking_nav #booking_n').click(function(){
    $('.booking_nav #booking_n').toggleClass('show_submenu');
});
$('.admin_nav #admin_n').click(function(){
    $('.admin_nav #admin_n').toggleClass('show_submenu');
});
/* $('.social_nav #social_drop_nav').click(function(){
    $('.social_nav #social_drop_nav').toggleClass('show_submenu');
}); */
  

</script>

