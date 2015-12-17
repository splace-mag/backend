<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@if($language == 'de') Splace Magazin @else Splace Magazine @endif</title>

	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body class="splace-orientation--portrait">
	
	<div class="splace-portrait" data-color="#ff0000" data-app-name="index">

		<div class="splace-article-header splace-article-header--cover" style="">
			
			<iframe src="/assets/threeJSBackground/index.html" class="splace-cover-wbgl-bg"></iframe>

			<div class="splace-article-header__marker">splace – das digitale Magazin der Kunstuni Linz / the digital magazine of the University of Art and Design Linz</div>
			<div class="splace-article-header__marker annotated">Issue #2, 2015</div>
			<div class="splace-article-header__marker down"></div>

			<div class="splace-cover-links">
				<div class="splace-cover-links__block">
					<span class="splace-cover-links__author">essay Karin Harrasser</span>
					<a href="/2/article/10">Zombies. Leben, Arbeit, Produktion</a>
					<a href="/2/article/10">Zombies: Life, Work, Production</a>
				</div>
				<div class="splace-cover-links__block">
					<span class="splace-cover-links__author">essay Helmut lethen</span>
					<a href="/2/article/4">Steinzeit der Evidenz.<br>Das Schwarz-Weiß des Roland Barthes</a>
					<a href="/2/article/4">Stone Age of Evidence:<br>The Black and White of Roland Barthes</a>
				</div>
				<div class="splace-cover-links__block">
					<span class="splace-cover-links__author">centerfold</span>
					<a href="/2/article/7">Karin Fisslthaler</a>
					<a href="/2/article/7">Brainbows</a>
				</div>
			</div>

			<div class="splace-cover-fat">
				<span class="splace-cover-fat__lang">
					<a href="#">Deutsch</a>
					<a href="#">English</a>
				</span>
				<span class="splace-cover-fat__color">
					<a href="#">Farbe</a>
					/
					<a href="#">Colour</a>
				</span>
			</div>

			<img src="/assets/portraitLogo.png" alt="Splace Logo" class="splace-cover-logo">

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
				<div class="splace-footer-links__item splace-external-links__wrapper">
					<i class="icon-external-link"></i>
					<ul class="splace-external-links__list">
						<li><a href="#"><i class="icon-vimeo"></i></a></li>
						<li><a href="https://www.facebook.com/SplaceMagazine" target="_blank"><i class="icon-facebook"></i></a></li>
						<li><a href="mailto:redaktion@splace-magazine.at" target="_blank"><i class="icon-mail"></i></a></li>
					</ul>
				</div>
				<a href="/help" class="splace-footer-links__item">?</a>
				<div class="splace-footer-links__item splace-user-links__wrapper">
					<!--<i class="icon-user-link"></i>-->*
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
		<span class="splace-user__title">Anmelden / Registrieren</span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color">
			<h2>Anmelden</h2>
			<p>
				Um Artikel zu kommentieren müssen Sie registriert sein. Nur Kommentare von angemeldeten LeserInnen können berücksich- tigt werden. Klar fomulieren was kann ich dann machen. TEXT ?!
			</p>

			<div class="splace-grid-row splace-grid-2 splace-user__action-grid cf">
				<div class="splace-grid-item">
					<a href="/facebook" class="splace-user__facebook-login"><i class="icon-facebook"></i> Über Facebook</a>
					<span class="splace-user__login-or">oder</span>
				</div>
				<div class="splace-grid-item">
					<form class="splace-user__login-form">
						<h4>Ungültige E-Mail/Passwort Kombination</h4>
						<div class="splace-user__input-wrapper">
							<label for="splace-login-email" class="splace-login__label">E-Mail</label>
							<input type="email" name="email" id="splace-login-email" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-login-password" class="splace-login__label">Password</label>
							<input type="password" name="password" id="splace-login-password" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<a href="#" class="splace-user__forgot-password splace-pw-reset__trigger splace-color">> Password vergessen</a>
							<input type="submit" value="> OK" class="splace-user__submit splace-background-color">
						</div>
					</form>

				</div>
			</div>
		</div>

		<div class="splace-user__signup-section">
			<h2>Registrieren</h2>
			<p>
				Hinweistext - Informationen vertraulich behandelt. Hier steht noch ein Blindtext mit der freundlichen Aufforderung zu registrieren. Klar fomulieren was kann ich dann machen. TEXT ?!
			</p>

			<form class="splace-user__signup-form">
				<h4></h4>
				<div class="splace-grid-row splace-grid-2 splace-user__action-grid cf">
					<div class="splace-grid-item">
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-name" class="splace-login__label">Name</label>
							<input type="name" name="name" id="splace-signup-name" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-email" class="splace-login__label">E-Mail</label>
							<input type="email" name="email" id="splace-signup-email" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<input type="file" class="splace-user__file" id="splace-signup-photo">
						</div>
					</div>
					<div class="splace-grid-item">
						
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-password" class="splace-login__label">Password</label>
							<input type="password" name="password" id="splace-signup-password" class="splace-user__input">
						</div>
						<div class="splace-user__input-wrapper">
							<label for="splace-signup-password-confirm" class="splace-login__label">Password wiederholung</label>
							<input type="password" name="password-confirm" id="splace-signup-password-confirm" class="splace-user__input">
						</div>
						<input type="submit" value="> Registrieren" class="splace-user__submit splace-background-color">
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="splace-user splace-user__pw-reset-modal">
		<span class="splace-user__title">Passwort anfordern</span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color" style="border-bottom: 0;">
			<h2>Passwort vergessen</h2>
			<p>
				Sie haben Ihr Passwort vergessen? Kein Problem, nach Eingabe Ihrer Email Adresse übermitteln wir Ihnen ein neues Passwort.
			</p>

			<form class="splace-user__pw-reset-form" name="pw-reset-form">
				<h4>Ihre Emailadresse ist uns leider nicht bekannt.</h4>
				<div class="splace-user__input-wrapper">
					<label for="splace-pw-reset-email" class="splace-login__label">E-Mail</label>
					<input type="email" name="email" id="splace-pw-reset-email" class="splace-user__input">
				</div>
				<input type="submit" value="> Passwort anfordern" class="splace-user__submit splace-background-color">
			</form>
			<div class="splace-user__pw-reset-success">
				<p>Es wurde ein neues Passwort an Ihre Adresse gesendet.</p>
			</div>
		</div>
	</div>

	<div class="splace-user splace-user__profile-modal">
		<span class="splace-user__title">Profil</span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color">
			<h2>Ihre Einstellungen</h2>
			<p>
			</p>

			<form class="splace-user__profile-form" name="profile-form">
				<h4 class="splace-color"></h4>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-name" class="splace-login__label">Name</label>
					<input type="name" name="name" id="splace-profile-name" class="splace-user__input" value="Lukas Leitner">
				</div>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-email" class="splace-login__label">E-Mail</label>
					<input type="email" name="email" id="splace-profile-email" class="splace-user__input" value="leitner@applics.at">
				</div>
				<div class="splace-user__input-wrapper">
					<label for="splace-profile-password" class="splace-login__label">Passwort</label>
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
</body>
</html>