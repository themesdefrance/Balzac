(function($){
$(function(){

	 $(document).ready(function(){

		//back to top button
		var $toTop = $('#back-to-top');
		if ($(window).scrollTop() <= $(window).height()) $toTop.hide();

		$toTop.on('click', function(){
			$('html,body').animate({
				scrollTop: 0
			}, 400);
		});

		$(document).on('scroll', function(event){
			if ($(window).scrollTop() > $(window).height()) $toTop.fadeIn();
			else $toTop.fadeOut();
		});
		
		$('.entry-video, .widget-video, .entry-content').fitVids();
		
		
		
		//MENU BUTTON TRIGGER
		
		$( '#toggle-sidebar-icon' ).click(function() {
		  if ($('.sidebar').hasClass('open')) {
		  closeSidebar();
		} else {
		  openSidebar();
		}
		});
		
		// MOBILE CLOSE 
		$( '#sidebar-close' ).click(function() {
		  if ($('.sidebar').hasClass('open')) {
		  	closeSidebar();
		  }
		});
	 
	//OPEN
	function openSidebar(){
	 	//$('.sidebar').css('display','block');
	 	$('.sidebar').addClass('open');
	 	$('#toggle-sidebar-icon').addClass('close');
	 	//$('#toTop').addClass('hide');
	 	$('.page-wrapper').addClass('sidebar-open');
	 	//$('.safari #theme-wrapper').addClass('no-flick');
	 	//$('.safari #header-container').addClass('no-flick');
	 	//setTimeout(function(){$('.sidebar').css('z-index','0');},400);
	}
	
	//CLOSE 
	function closeSidebar(){
		//$('.sidebar').css('z-index','-1');
		//$('.sidebar').css('display','none');
		$('.sidebar').removeClass('open');
		$('#toggle-sidebar-icon').removeClass('close');
		//$('#toTop').removeClass('hide');
	    $('.page-wrapper').removeClass('sidebar-open');
	    //$('.safari #theme-wrapper').removeClass('no-flick');
	    //$('.safari #header-container').removeClass('no-flick');
		//setTimeout(function(){ $('.sidebar').css('z-index','-1'); },400);
		
	 }
		
		
		
		
		
		
		// Toutatis Menu
		
		$("#toggle-menu-icon").click(function() {
		  $(".top-level-menu").slideToggle(400);
		  return false;
		});
		
		var menuTimeout;
		
		$( window ).resize( function() {
			if (menuTimeout) clearTimeout(menuTimeout);
			menuTimeout = setTimeout(recalculateMenuSize, 100);
		} );
		
		var recalculateMenuSize = function(){
			var browserWidth = $( window ).width();
			
			if ( browserWidth == $( window ).width() ) {
		        return;
		    }
			
			if ( browserWidth > 800 ) {
				$(".top-level-menu").show();
			}else{
				$(".top-level-menu").hide();
			}
		}
		
	

	});
});
})(jQuery);