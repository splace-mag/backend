<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>@if($language == 'de') Splace Magazin @else Splace Magazine @endif</title>

	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/css/main.css">

	<link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/assets/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/assets/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/assets/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/assets/favicon/manifest.json">
	<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/assets/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/assets/favicon/mstile-144x144.png">
	<meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
</head>
<body class="splace-orientation--portrait">
	
	<div class="splace-portrait">
		<div class="splace-article-header splace-article-header--no-shadow" style="background-image: linear-gradient(90deg, rgb(246, 65, 30), rgb(138, 57, 95)); height: auto !important; ">
			<div class="splace-article-header__marker">Editorial</div>

			<p class="splace-editorial__heading">
				@if($language == 'de')
					Wertes „splace“-Publikum,<br>
					LeserInnen greift im Fall eines Multiformats zu kurz, denn: „splace“ will und kann Sie auditiv, visuell und kinästhetisch ansprechen (wir arbeiten am Olfaktorischen und am Gustatorischen) – diesmal bunt und schwarzweiß zugleich, denn der Farbe widmet sich die zweite Ausgabe.
				@else
					Dear "splace" audience, <br>
					Readers, in this case, falls short, because "splace" wishes to and can address you audibly, visually and kinaesthetically (we are working on the olfactory and gustatory) – this time in colour and black and white simultaneously, because the second issue is dedicated to colour.
				@endif
			</p>

			<div class="splace-editorial__small-col">
				<img src="/images/kienzer.jpg" alt="" class="splace-editorial__img">
				<span class="splace-editorial__name">Sabine Kienzer</span>
				<span class="splace-editorial__position">@if($language == 'de') Redaktionsleitung @else Editor @endif</span>
			</div>
			<div class="splace-editorial__big-col">
				<p>
					@if($language == 'de')
						Nun, worauf beziehen wir uns, wenn wir etwas als rot, grün oder blau bezeichnen? Zitronen sind gelb, sagt der Hausverstand. Farbe ist eine individuelle visuelle Wahrnehmung, die durch Licht hervorgerufen wird, liest man auf Wikipedia. Farbe ist in erster Linie ein gesellschaftliches Phänomen, so der Historiker Michel Pastoureau. Eine Farbe leuchtet in ihrer Umgebung, wie Augen nur in einem Gesicht lächeln, schreibt Ludwig Wittgenstein und der Künstler Derek Jarman befand, dass Maler Rot verwenden wie ein Gewürz. Wir haben Fragen zur Farbe an die LeiterInnen diverser Institute an der Kunstuni Linz weitergeleitet, eine bunte Palette an Antworten bezieht sich auf ein natürliches Ereignis, ein komplexes kulturelles Gebilde, einen Anlass zum Zweifeln, einen Grund, über moderne Zombies zu referieren, skandinavische Nächte zu analysieren oder auf die Evidenz, die Wahrheit, die Wirklichkeit ausschließlich im Schwarzweißen zu finden. „Alles ist möglich, man muss es nur denken können“, schreibt „splace“-Art-Direktorin Tina Frank in ihren Betrachtungen zum RGB-Raum und in diesem Sinne nimmt „splace“ Bezug auf das Phänomen Farbe. Das Layout hat sie mit den jungen KünstlerInnen, die an den jeweiligen Abteilungen studieren, gestaltet, ein Best-of ihrer künstlerischen Arbeiten stellen wir im white/ splace aus und über Karin Fisslthalers Zusage, den Centerfold zu gestalten, freuen Sie sich bitte mit uns. Ein buntes und informationsreiches Durchswipen, Hören, Sehen, Lesen und Spielen wünscht
					@else
						So what are we referring to when we describe something as red, green or blue? Lemons are yellow, our common sense tells us. Colour is an individual visual perception caused by light, one reads in Wikipedia. Colour is primarily a social phenomenon, according to the historian 
						Michel Pastoureau. A colour shines in its surroundings, as eyes only smile in a face, writes Ludwig Wittgenstein, and the artist Derek Jarman felt that painters use red like a spice. 
						We forwarded questions on colour to the directors of various institutes at the Linz University of Art; a colourful palette of answers refer to a natural event, a complex cultural form, an occasion for doubt, a reason to report on modern zombies, to analyse Scandinavian nights or the evidence for finding the truth, reality exclusively in black and white. “Everything is possible; you only have to be able to think it,” writes "Splace" art director Tina Frank in her observations on the RGB space, and it is with this in mind that "Splace" refers to the phenomenon of colour.
						She designed the layout together with the young artists who are studying in the respective departments. We are showing the best of their artistic works in the white/splace, and please share our pleasure that Karin Fisslthaler has agreed to design the centrefold. We wish you a colourful and informative swiping through, listening, seeing, reading and playing.
					@endif
					<br><br>
					Sabine Kienzer <br>
					@if($language == 'de') Redaktionsleitung @else Editor @endif
				</p>
			</div>

			<p class="splace-editorial__footer-info">
				@if($language == 'de')
					PS: Eine interdisziplinäre Lehrveranstaltung zur Programmierung und Umsetzung von „splace“ fand gemeinsam mit der Johannes-Kepler-Universität statt mit dem Ziel eine Fachsprache zu entwickeln und „Brücken“ zu bauen.
				@else
					PS: An interdisciplinary lecture on the programming and realisation of "splace" took place together with the Johannes Kepler University with the aim of developing a specialist language and building “bridges”.

				@endif
			</p>
		</div>
	</div>

	<div class="splace-landscape"></div>

	<div class="splace-menu">
		<nav class="splace-navigation">
			<a href="#" class="splace-navigation__prev"><i class="icon-chevron-left"></i></a>
			<div class="splace-navigation__list-wrapper">
				<ul class="splace-navigation__list">
					
				</ul>
			</div>
			<a href="#" class="splace-navigation__next"><i class="icon-chevron-right"></i></a>
		</nav>
		<div class="splace-footer">
			<div class="splace-issue-selection">
				<span class="splace-issue-selection__current">#{{$magazine->version}}</span>
				<ul class="splace-issue-selection__list"></ul>
			</div>
			<div class="splace-navigation-trigger">
				<span>@if($language == 'de') Inhalt @else Content @endif</span>
			</div>
			<div class="splace-footer-links">
				<a @if($language == 'de') href="/locale/en" @else href="/locale/de" @endif class="splace-language-switcher splace-footer-links__item">@if($language == 'de') EN @else DE @endif</a>
				<a href="/2/article/14" class="splace-footer-links__item">INFO</a>
				<a href="https://vimeo.com/splace" target="_blank" class="splace-footer-links__item"><i class="icon-vimeo"></i></a>
				<a href="https://www.facebook.com/SplaceMagazine" target="_blank" class="splace-footer-links__item"><i class="icon-facebook"></i></a>
				<a href="/help" class="splace-footer-links__item">?</a>
				<div class="splace-footer-links__item splace-user-links__wrapper">
					<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAM5JREFUeNpiYEAD////lwDib/8h4Am6PBMDJtAAYk4oWxqoSZgBi6kJQPwDiCcC8af/qOAxEM+CsmMYgQQbUM8LIBZkIAxugJwkBcTcSILvgNgT6twgIP6KJCcOc5IMkhPa0ZzbABX/CcSiME9/QVLzBYdz/gLxL5AJgkB8DcmGR0AsDTVdHuppGLgP8jTI/c+AmA/NRJBNPGhiH5kYGRlBnqqFCmwD4t9QNg+SU7ZB2RNhHhMAYnUo2xctHgKg4qogddgikQ1NA4pTAQIMAMtXyVCPo+16AAAAAElFTkSuQmCC" alt="" class="splace-footer-links__user-menu">

					<ul class="splace-user-links__list">
						<li class="splace-show-loggedin"><a href="#" class="splace-user__trigger">@if($language == 'de') Profil @else Profile @endif</a></li>
						<li class="splace-hide-loggedin"><a href="#" class="splace-user__trigger">@if($language == 'de') Anmelden @else Login @endif</a></li>
						<li class="splace-show-loggedin"><a href="#" class="splace-user-logout_trigger">@if($language == 'de') Abmelden @else Logout @endif</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="splace-user splace-user__login-signup-modal">
		<span class="splace-user__title">@if($language == 'de') Anmeldung @else Login / Register @endif </span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color">
			@if($language == 'de')
			<h2>Anmelden</h2>
			<p>
				Um Artikel zu kommentieren müssen Sie registriert sein. Nur Kommentare von angemeldeten LeserInnen können berücksichtigt werden.
			</p>
			@else
			<h2>Login</h2>
			<p>
				To comment an article, you have to be registered and logged in. Only notes from registered readers can be considered.
			</p>
			@endif

			<div class="splace-grid-row splace-grid-2 splace-user__action-grid cf">
				<div class="splace-grid-item">
					<a href="/facebook" class="splace-user__facebook-login"><i class="icon-facebook"></i>
					@if($language == 'de') 
						Über Facebook
					@else
						via facebook
					@endif
					</a>
					<span class="splace-user__login-or">
					@if($language == 'de') 
						oder
					@else
						or
					@endif
					</span>
				</div>
				<div class="splace-grid-item">
					<form class="splace-user__login-form">
						<h4 class="splace-color">
						@if($language == 'de') 
							Sie haben eine falsche Email/PWD Kombination eingegeben
						@else
							Wrong E-Mail/Password Combination
						@endif
						</h4>
						<div class="splace-user__input-wrapper">
							<label for="splace-login-email" class="splace-login__label">@if($language == 'de') E-Mail Adresse @else e-mail address @endif </label>
							<input type="email" name="email" id="splace-login-email" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-login-password" class="splace-login__label">@if($language == 'de') Passwort @else password @endif </label>
							<input type="password" name="password" id="splace-login-password" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<a href="#" class="splace-user__forgot-password splace-pw-reset__trigger splace-color">@if($language == 'de') > Password vergessen? @else Forgot password? @endif </a>
							<input type="submit" value="> OK" class="splace-user__submit splace-background-color">
						</div>
					</form>

				</div>
			</div>
		</div>

		<div class="splace-user__signup-section">
			@if($language == 'de')
				<h2>Registrieren</h2>
				<p>
					Um Artikel kommentieren zu können, ersuchen wir Sie um Ihre Registrierung.<br>
					Ihre Daten werden selbstverständlich vertraulich behandelt, nicht für Werbezwecke verwendet oder an Dritte weitergegeben.
				</p>
			@else
				<h2>Registration</h2>
				<p>
					Only registered users can comment an article. <br>
					Your data will be kept confidential and not be used for promotional purposes or disclosed to third parties.
				</p>
			@endif

			<form class="splace-user__signup-form">
				<h4></h4>
				<div class="splace-grid-row splace-grid-2 splace-user__action-grid cf">
					<div class="splace-grid-item">
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-name" class="splace-login__label">@if($language == 'de') Name @else name @endif </label>
							<input type="name" name="name" id="splace-signup-name" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-email" class="splace-login__label">@if($language == 'de') E-Mail Adresse @else e-mail address @endif </label>
							<input type="email" name="email" id="splace-signup-email" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<input type="file" class="splace-user__file" id="splace-signup-photo" data-label="@if($language == 'de')Profilbild hochladen @else Upload Profile Picture @endif ">
						</div>
					</div>
					<div class="splace-grid-item">
						
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-password" class="splace-login__label">@if($language == 'de') Passwort @else password @endif </label>
							<input type="password" name="password" id="splace-signup-password" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-password-confirm" class="splace-login__label">@if($language == 'de') Passwort wiederholen @else repeat password @endif </label>
							<input type="password" name="password-confirm" id="splace-signup-password-confirm" class="splace-user__input">
						</div>
						<input type="submit" value="> @if($language == 'de') Registrieren @else Register @endif " class="splace-user__submit splace-background-color">
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="splace-user splace-user__pw-reset-modal">
		<span class="splace-user__title">@if($language == 'de') Passwort vergessen @else Forgot password @endif </span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color" style="border-bottom: 0;">
			@if($language == 'de')
				<h2>Passwort vergessen?</h2>
				<p>
					Sie haben Ihr Passwort vergessen? Kein Problem, nach Eingabe Ihrer Email Adresse übermitteln wir Ihnen ein neues Passwort.
				</p>
			@else
				<h2>Forgotten your password?</h2>
				<p>
					We'll send you an e-mail with your new password.
				</p>
			@endif

			<form class="splace-user__pw-reset-form" name="pw-reset-form">
				<h4>@if($language == 'de') Ihre Emailadresse ist uns leider nicht bekannt. @else Sorry, your e-mail address is unknown. @endif </h4>
				<div class="splace-user__input-wrapper">
					<label for="splace-pw-reset-email" class="splace-login__label">E-Mail</label>
					<input type="email" name="email" id="splace-pw-reset-email" class="splace-user__input">
				</div>
				<input type="submit" value="> Passwort anfordern" class="splace-user__submit splace-background-color">
			</form>
			<div class="splace-user__pw-reset-success">
				<p>
					@if($language == 'de') 
						Es wurde ein neues Passwort an Ihre E-Mail Adresse gesendet.
					@else
						A new temporary password has been sent to your e-mail address. 
					@endif
				</p>
			</div>
		</div>
	</div>

	<div class="splace-user splace-user__profile-modal">
		<span class="splace-user__title">@if($language == 'de') Profil @else Profile @endif </span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color">
			<h2>@if($language == 'de') Ihre Einstellungen @else Settings @endif </h2>
			<p>
			</p>

			<form class="splace-user__profile-form" name="profile-form">
				<h4 class="splace-color"></h4>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-name" class="splace-login__label">@if($language == 'de') Name @else name @endif </label>
					<input type="name" name="name" id="splace-profile-name" class="splace-user__input" value="Lukas Leitner">
				</div>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-email" class="splace-login__label">@if($language == 'de') E-Mail Adresse @else e-mail address @endif </label>
					<input type="email" name="email" id="splace-profile-email" class="splace-user__input" value="leitner@applics.at">
				</div>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-password" class="splace-login__label">@if($language == 'de') Passwort @else password @endif </label>
					<input type="password" name="password" id="splace-profile-password" class="splace-user__input" value="********">
				</div>
				
				<div class="splace-user__profile-photo">
					<img src="https://scontent-vie1-1.xx.fbcdn.net/hprofile-xpa1/v/t1.0-1/p160x160/1508604_10202847543100539_5665856051308959351_n.jpg?oh=972185063d696503372536a70c5daba2&oe=566CA9D6" alt="" id="splace-profile-image">
					<input type="file" class="splace-user__file splace-border-color" id="splace-profile-photo">
				</div>
				
				<input type="submit" value="> Änderungen speichern" class="splace-user__submit splace-background-color">
			</form>
			<div class="splace-user__pw-reset-success">
				<p>Die Änderungen wurden gespeichert.</p>
			</div>
		</div>
	</div>


	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">‹</a>
	    <a class="next">›</a>
	    <a class="close">×</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>
	
	<script type="text/javascript">
		var splaceConfig = <?php echo($navigation); ?>
	</script>
	
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/hammer.min.js"></script>
	<script type="text/javascript" src="/js/jquery.hammer.js"></script>
	<script type="text/javascript" src="/js/OrientationController.js"></script>
	<script type="text/javascript" src="/js/MenuController.js"></script>
	<script type="text/javascript" src="/js/CommentController.js"></script>
	<script type="text/javascript" src="/js/PageController.js"></script>
	<script type="text/javascript" src="/js/UserController.js"></script>
	<script type="text/javascript" src="/js/LandscapeAppController.js"></script>
	<script type="text/javascript" src="/js/AuthorController.js"></script>
	<script type="text/javascript" src="/js/blueimp-gallery.min.js"></script>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-45837803-8', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>