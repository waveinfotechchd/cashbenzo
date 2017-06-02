/**
 * Written by: Pratiksha, 2017
 * Senior Webdesigner 
 * Wave Infotech
 * http://www.waveinfotech.biz
 */
//toggle menu
/*$menuLeft = $('.pushmenu-right');
$nav_list = $('#nav_list');

$nav_list.click(function() {
	$(this).toggleClass('active');
	$('.pushmenu-push').toggleClass('pushmenu-push-toleft');
	$menuLeft.toggleClass('pushmenu-open');
});*/

$(window).scroll(function(){
  var sticky = $('.header'),
      scroll = $(window).scrollTop();

  if (scroll >= 470) { 
	sticky.addClass('fixed');
	$('body').addClass('fixed-container');
  }
  else { 
	  sticky.removeClass('fixed');
	  $('body').removeClass('fixed-container');
  }
});
	
// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});	
	function resizeForm(){
        var width = (window.innerWidth > 0) ? window.innerWidth : document.documentElement.clientWidth;
		if(width > 992){
			$(".top-coupons-stories > div").filter(function(index) {
			  return index % 4 === 0;
			}).addClass("first");
		}
		if(width > 768 && width < 992){
			$(".top-coupons-stories > div").filter(function(index) {
			  return index % 2 === 0;
			}).addClass("first");
		}
        if(width > 768){
			$(function(){
				$(".header .dropdown").hover(            
					function() {
						$('.header .dropdown-menu', this).stop( true, true ).fadeIn("fast");
						$(this).toggleClass('open');
						$('b', this).toggleClass("caret caret-up");                
					},
					function() {
						$('.header .dropdown-menu', this).stop( true, true ).fadeOut("fast");
						$(this).toggleClass('open');
						$('b', this).toggleClass("caret caret-up");                
					});
			});
        }   
    }
    window.onresize = resizeForm;
    resizeForm();