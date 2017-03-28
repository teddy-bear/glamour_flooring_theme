/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
(function ($) {

	// Real time updates.

	// Copyright.
	wp.customize('copyright', function (value) {
		value.bind(function (newval) {
			$('.site-footer .copyright').html(newval);
		});
	});


	// Logo image.
	wp.customize('image_setting', function (value) {
		value.bind(function (newval) {
			$('.site-logo img').attr('src', newval);
		});
	});

	// Phone number.
	wp.customize('phone', function (value) {
		value.bind(function (newval) {
			$('a.phone-number').html(newval);
		});
	});

	// Email.
	wp.customize('email', function (value) {
		value.bind(function (newval) {
			$('a.email').html(newval);
		});
	});

	// Site header background.
	/*wp.customize('header_textcolor', function (value) {
	 value.bind(function (newval) {
	 $('.site-header').css('background', newval);
	 });
	 });
	 */


	// Colorpicker
	/*wp.customize('colorpicker', function (value) {
	 value.bind(function (newval) {
	 $('a').css('color', newval);
	 });
	 });

	 // Range
	 wp.customize('range_control', function (value) {
	 value.bind(function (newval) {
	 $('pre').html(newval);
	 });
	 });*/

})(jQuery);
