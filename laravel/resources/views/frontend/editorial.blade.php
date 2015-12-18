<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@if($language == 'de') Splace Magazin @else Splace Magazine @endif</title>

	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body class="splace-orientation--portrait">
	
	<div class="splace-portrait">
		<div class="splace-article-header splace-article-header--no-shadow" style="background-image: linear-gradient(90deg, rgb(246, 65, 30), rgb(138, 57, 95)); height: auto !important; ">
			<div class="splace-article-header__marker">Editorial</div>

			<p class="splace-editorial__heading">
				Wertes „splace“-Publikum,<br>
				LeserInnen greift im Fall eines Multiformats zu kurz, denn: „splace“ will und kann Sie auditiv, visuell und kinästhetisch ansprechen (wir arbei- ten am Olfaktorischen und am Gustatorischen) – diesmal bunt und schwarzweiß zugleich, denn der Farbe widmet sich die zweite Ausgabe.
			</p>

			<div class="splace-editorial__small-col">
				<img src="/images/kienzer.jpg" alt="" class="splace-editorial__img">
				<span class="splace-editorial__name">Sabine Kienzer</span>
				<span class="splace-editorial__position">Redaktionsleitung</span>
			</div>
			<div class="splace-editorial__big-col">
				<p>
					Nun, worauf beziehen wir uns, wenn wir etwas als rot, grün oder blau bezeichnen? Zitronen sind gelb, sagt der Hausver- stand. Farbe ist eine individuelle visuelle Wahrnehmung, die durch Licht hervorgerufen wird, liest man auf Wikipedia. Farbe ist in erster Linie ein gesellschaftliches Phänomen, so der Historiker Michel Pastoureau. Eine Farbe leuchtet in ihrer Umgebung, wie Augen nur in einem Gesicht lächeln, schreibt Ludwig Wittgenstein und der Künstler Derek Jar- man befand, dass Maler Rot verwenden wie ein Gewürz. Wir haben Fragen zur Farbe an die LeiterInnen diverser Institute an der Kunstuni Linz weitergeleitet, eine bunte Palette an Antworten bezieht sich auf ein natürliches Ereig- nis, ein komplexes kulturelles Gebilde, einen Anlass zum Zweifeln, einen Grund, über moderne Zombies zu refe- rieren, skandinavische Nächte zu analysieren oder auf die Evidenz, die Wahrheit, die Wirklichkeit ausschließlich im Schwarzweißen zu finden. „Alles ist möglich, man muss es nur denken können“, schreibt „splace“-Art-Direktorin Tina Frank in ihren Betrachtungen zum RGB-Raum und in die- sem Sinne nimmt „splace“ Bezug auf das Phänomen Farbe. Das Layout hat sie mit den jungen KünstlerInnen, die an den jeweiligen Abteilungen studieren, gestaltet, ein Best-of ihrer künstlerischen Arbeiten stellen wir im white/ splace aus und über Karin Fisslthalers Zusage, den Cen- terfold zu gestalten, freuen Sie sich bitte mit uns. Ein buntes und informationsreiches Durchswi- pen, Hören, Sehen, Lesen und Spielen wünscht
					<br><br>
					Sabine Kienzer <br>Redaktionsleitung
				</p>
			</div>

			<p class="splace-editorial__footer-info">
				PS: Eine interdisziplinäre Lehrveranstaltung zur Programmierung und Umset- zung von „splace“ fand gemeinsam mit der Johannes-Keppler-Universität statt mit dem Ziel eine Fachsprache zu entwickeln und „Brücken“ zu bauen.
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