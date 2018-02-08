

//not really needed, wordpress just insists on putting jquery in, mostly thanks to third party plugins.
//import jQuery from 'jquery';

//used for the map page.  Responsively sized image maps.
import './jquery.rwdImageMaps.min.js';

import './bootstrap.min.js';
//import './dev/bootstrap.js';

//css imports.  we have to do things wierdly here.
import '../css/wp-theme-settings.css';

//import '../css/font-awesome.min.css';
import '../css/bootstrap.min.css';

//master scss file
import '../scss/style.scss';

jQuery(function($) {
	"use strict";

	// hide #back-top first
	$("#back-top").hide();

	// fade in #back-top

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-top a').on("click", function(){
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	//
	$('img[usemap]').rwdImageMaps();
	
	/*$('area').on('click', function() {
		alert($(this).attr('alt') + ' clicked');
	});*/
});
