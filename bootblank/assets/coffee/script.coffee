console.log 'fuck'
jQuery(document).ready ->
	if Modernizr.svg
		#unless Modernizr.svg
		imgs = jQuery("img[data-fallback]")
		imgs.attr "src", imgs.data("fallback")
	alert 'Therese'