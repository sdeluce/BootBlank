console.log('fuck');

jQuery(document).ready(function() {
  var imgs;
  if (Modernizr.svg) {
    imgs = jQuery("img[data-fallback]");
    imgs.attr("src", imgs.data("fallback"));
  }
  return alert('Therese');
});
