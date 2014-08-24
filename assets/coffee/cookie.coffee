(($) ->

	# Systeme cookie CNIL
	if $.cookie("cookiebar")

		cookie_content = "En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de [ Cookies ou autres traceurs ] pour vous proposer [Par exemple, des publicités ciblées adaptés à vos centres d’intérêts] et [ Par exemple, réaliser des statistiques de visites]."
		btn_cookie_ok = "Ok"
		btn_cookie_cancel = "Refuser les cookies"

		$("body").append "<div class=\"cookiebar\" id=\"cookiebar\">lorem</div>"

		$("#cookie_ok").click (e) ->
			e.preventDefault()
			$("#cookiebar").fadeOut()
			$.cookie "cookiebar", "hidden"
			return

		$("#cookie_cancel").click (e) ->
			e.preventDefault()
			$("#cookiebar").fadeOut()
			$.cookie "cookiebar", "hidden"
			$.cookie "cookiecancel", "true"
			return

	if $.cookie("cookiecancel")
		console.log 'Placer ici les scripts qui utilisent des cookies'

)(jQuery)