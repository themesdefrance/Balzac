(function($){
$(function(){

	 $(document).ready(function(){
	 	
	 	// Move menu in sidebar on mobile width
		$( window ).on( "resize load", function () {
			var browserWidth = $( window ).width();
			
			if( browserWidth < 769 ) {
				$( ".site-header" ).find( ".main-menu" ).insertAfter( "#sidebar-close" );
			}
			if( browserWidth > 769 ) {
				$( ".sidebar" ).find( ".main-menu" ).insertAfter( "#toggle-sidebar-icon" );
			}
		});
	 	
		// Back to top button
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
		
		// FitVids
		$('.entry-video, .widget-video, .entry-content').fitVids();


		// Hidden sidebar handling
		$( '#toggle-sidebar-icon' ).click(function(e) {
			e.preventDefault();
			if ($('.sidebar').hasClass('open')) {
			  closeSidebar();
			} else {
			  showSidebar();
			}
		});

		// Close sidebar button
		$( '#sidebar-close' ).click(function() {
		  if ($('.sidebar').hasClass('open')) {
		  	closeSidebar();
		  }
		});

		// Show sidebar
		function showSidebar(){
		 	$('.sidebar').addClass('open');
		 	$('#toggle-sidebar-icon').addClass('close');
		 	$('.page-wrapper').addClass('sidebar-open');
		}

		// Hide sidebar
		function closeSidebar(){
			$('.sidebar').removeClass('open');
			$('#toggle-sidebar-icon').removeClass('close');
		    $('.page-wrapper').removeClass('sidebar-open');
		}

	});
});
})(jQuery);