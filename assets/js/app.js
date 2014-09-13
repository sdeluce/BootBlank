(function($) {
  return jQuery(document).ready(function() {
    var imgs;
    if (!Modernizr.svg) {
      imgs = $("img[data-fallback]");
      return imgs.attr("src", imgs.data("fallback"));
    }
  });
})(jQuery);
