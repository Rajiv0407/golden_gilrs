$('.right_nav').click(function(){
  $('.right_navbar').toggleClass('active');
});
$(window).scroll(function () {
  var sticky = $('.navbar_menu'),
      scroll = $(window).scrollTop();

  if (scroll >= 60) sticky.addClass('top-fixed');
  else sticky.removeClass('top-fixed');
});