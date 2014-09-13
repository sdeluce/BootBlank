jQuery.noConflict();
jQuery(document).ready(function($) {
	// Système information sur les cookies
	// http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/que-dit-la-loi/
	if( $.cookie('cookiecancel') != undefined ){
		// Ajouter vos script ici
		console.log('vous avez interdit les cookies.');
	};
	if( $.cookie('cookiebar') === undefined ){

		var cookie_content = 'En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de [ Cookies ou autres traceurs ] pour vous proposer [Par exemple, des publicités ciblées adaptés à vos centres d’intérêts] et [ Par exemple, réaliser des statistiques de visites].';
		var btn_cookie_ok = 'Ok';
		var btn_cookie_cancel = 'Annuler';

		$('body.home').append('<div class="cookiebar" id="cookiebar">'+cookie_content +'<div id="cookie_ok" class="cookie_btn-ok">'+btn_cookie_ok+'</div>'+'<div id="cookie_cancel"  class="cookie_btn-cancel">'+btn_cookie_cancel+'</div>'+'</div>');

		$('#cookie_ok').click(function(e){
			e.preventDefault();
			$('#cookiebar').fadeOut();
			$.cookie('cookiebar', 'hidden', { expires: 365+31 });
		});

		$('#cookie_cancel').click(function(e){
			e.preventDefault();
			$('#cookiebar').fadeOut();
			$.cookie('cookiebar', 'hidden', { expires: 365+31 });
			$.cookie('cookiecancel', 'true', { expires: 365+31 });
		});
	};
});