(($) ->
	jQuery(document).ready ->
		unless Modernizr.svg
			imgs = $("img[data-fallback]")
			imgs.attr "src", imgs.data("fallback")
)(jQuery)