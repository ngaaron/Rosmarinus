jQuery(document).ready(function($) {

	"use strict";
	
	// Mobile search
	$('#top-search i.search-toggle').on('click', function ( e ) {
		e.preventDefault();
    	$('.show-search').slideToggle('fast');
    });
	
	// BXslider
	$('.featured-area .bxslider').bxSlider({
		pager: false,
		auto: true,
		pause: 6000,
		onSliderLoad: function(){
			$("#sideslides").css("visibility", "visible");
		  }
	});
	$('.post-img .bxslider').bxSlider({
	  adaptiveHeight: true,
	  mode: 'fade',
	  pager: false,
	  captions: true
	});
	
	// Menu
	$('#nav-wrapper .menu').slicknav({
		prependTo:'.menu-mobile',
		label:'',
		allowParentLinks: true
	});
	
	// Fitvids
	$(document).ready(function(){
		// Target your .container, .wrapper, .post, etc.
		$(".container").fitVids();
	});
	
	
});