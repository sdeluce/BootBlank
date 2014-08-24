
	(function($) {
		var btn_cookie_cancel, btn_cookie_ok, cookie_content;

			cookie_content = "En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de [ Cookies ou autres traceurs ] pour vous proposer [Par exemple, des publicités ciblées adaptés à vos centres d’intérêts] et [ Par exemple, réaliser des statistiques de visites].";
			btn_cookie_ok = "Ok";
			btn_cookie_cancel = "Refuser les cookies";

		if ($.cookie("cookiebar") === undefined) {
			$( "body" ).append( "<strong>Hello</strong>" );
			$("#cookie_ok").click(function(e) {
				e.preventDefault();
				$("#cookiebar").fadeOut();
				$.cookie("cookiebar", "hidden");
			});
			$("#cookie_cancel").click(function(e) {
				e.preventDefault();
				$("#cookiebar").fadeOut();
				$.cookie("cookiebar", "hidden");
				$.cookie("cookiecancel", "true");
			});
		}
		if ($.cookie("cookiecancel") === undefined) {
			return console.log('Placer ici les scripts qui utilisent des cookies');
		}
	})(jQuery);
