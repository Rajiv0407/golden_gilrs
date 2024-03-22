$(document).ready(function () {
	$("#pv_slider").not('.slick-initialized').slick({
    //$('#pv_slider').slick({
        infinite: false,
        speed: 100,
        fade: true,
        cssEase: 'linear'
        // // dots: true,
        // infinite: true,
        // speed: 300,
        // slidesToShow: 1,
        // adaptiveHeight: true,
        // navbar:false        
    });

	
	$("#story_view_slider").not('.slick-initialized').slick({
        infinite: false,
        speed: 100,
        fade: true,
        cssEase: 'linear'
             
    }); 
	
	
	//$("#urslider").not('.slick-initialized').slick({
	$('#urslider').slick({		
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
      });
       	
}) 



