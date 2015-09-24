<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<title>@if($language == 'de') Splace Magazin @else Splace Magazine @endif</title>
	
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body class="splace-orientation--portrait">
	
	<div class="splace-portrait" data-color="{{$article->link_color}}">
		<div class="splace-article-header" style="background-image: linear-gradient(-60deg, {{$article->gradient_1}}, {{$article->gradient_2}});">
			<div class="splace-article-header__marker">{{$article->spitzmarke}}</div>
			<div class="splace-article-header__marker annotated">Reading: {{$article->reading_time}} min</div>
			<span class="splace-article-header__author">@if($language == 'de') von @else from @endif <strong>{{$article->author_name}}</strong></span>
			<div class="splace-article-header__marker down">^ swipe up</div>

			<h1 style="left: {{$article->page_title_padding_left}}%; top: {{$article->page_title_padding_top}}%;" class="splace-profile__trigger">
				@if($language == 'de')
					{{$article->page_titleDE}}
				@else
					{{$article->page_titleEN}}
				@endif</h1>
			<h2 style="left: {{$article->page_sub_title_padding_left}}%; top: {{$article->page_sub_title_padding_top}}%; background-color: {{$article->subtitle_backgroundcolor}}">
				@if($language == 'de')
					{{$article->page_sub_titleDE}}
				@else
					{{$article->page_sub_titleEN}}
				@endif
			</h2>
			@if($article->cover_image) <img src="/images/{{$article->cover_image}}" alt="" style="left: {{$article->cover_image_padding_left}}%; top: {{$article->cover_image_padding_top}}%;"> @endif
		</div>

		<div class="splace-paragraph">
			<div class="splace-paragraph__text splace-paragraph__text--heading splace-color">
				<p>
				@if($language == 'de')
					{!!$article->introductionDE!!}
				@else
					{!!$article->introductionEN!!}
				@endif
				</p>
			</div>
		</div>

		@foreach($sections as $section)
		<div class="splace-paragraph">
			<div class="splace-paragraph__comments splace-color" data-comment-count="{{count($section->comments)}}">
				<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19.1px" height="18.2px" viewBox="0 0 19.1 18.2" enable-background="new 0 0 19.1 18.2" xml:space="preserve">
					<g>
						<g><rect fill="#0A919F" width="19.1" height="4"/></g>
						<g><rect y="7.101" fill="#0A919F" width="19.1" height="4"/></g>
						<g><rect y="14.2" fill="#0A919F" width="13.1" height="4"/></g>
					</g>
				</svg>
				@foreach($section->comments as $c)
				<div class="splace-paragraph__comment">
					<div class="media attribution">
					  <a href="http://twitter.com/stubbornella" class="img {{$c->picture}}">
					  	<?php 
					  		if(strpos($c->picture, 'https://') === 0) {
					  			echo('<img src="'.$c->picture.'" alt="me" />');
					  		}
					  		else if($c->picture != '') {
					  			echo('<img src="/images/'.$c->picture.'" alt="me" />');
					  		}
					  		else {
					  			echo('<img src="https://s3.amazonaws.com/uifaces/faces/twitter/peterlandt/128.jpg" alt="me" />');
					  		}
					  	?>
					  </a>
					  <div class="bd">
					  	<span class="splace-paragraph__comment-author">{{$c->name}}</span>
					  	<span class="splace-paragraph__comment-time">{{date("d.m.Y", strtotime($c->created_at)) }}</span>
					  </div>
					  <p>
					  	{!!$c->text!!}
					  </p>
					</div>
				</div>
				@endforeach

				<div class="splace-paragraph__comment-note">Note</div>
				<div class="splace-paragraph__comment-add-note-wrapper">
					<span class="splace-add-comment-notice">Danke für Ihre Anmerkung!<br>Bevor diese veröffentlicht wird muss sie noch von einem unserer Mitarbeiter geprüft werden.</span>
					<span class="splace-paragraph__comment-add splace-color">@if($language == 'de') Kommentar hinterlassen @else Leave a comment @endif</span>
					<form name="splace-add-comment-form" class="splace-paragraph__comment-form">
						<span> @if($language == 'de') Ihre Anmerkung @else Your comment @endif </span>
						<textarea name="comment" required></textarea>
						<input type="submit" value="@if($language == 'de') > Anmerkung absenden @else > Save @endif" class="splace-background-color">
						<input type="hidden" name="paragraph-id" value="{{$section->section_id}}">
					</form>
				</div>
			</div>

			<div class="splace-paragraph__text">
				@if($language == 'de')
					{!!$section->textDE!!}
				@else
					{!!$section->textEN!!}
				@endif
			</div>

			<div class="splace-paragraph__annotation">
				@if($language == 'de')
					{{$section->noteDE}}
				@else
					{{$section->noteEN}}
				@endif
			</div>
		</div>
		@endforeach

		<div class="splace-paragraph">
			<div class="splace-paragraph__links">
				<span>Links</span>
				@foreach($links as $link) 
				<a href="{{$link->link}}" target="_blank" class="splace-color">
				@if($language == 'de') 
					{{$link->link_descriptionDE}}
				@else
					{{$link->link_descriptionEN}}
				@endif
				</a>
				@endforeach
			</div>

			<div class="splace-paragraph__books">
				<span>@if($language == 'de') Buchtipp @else Booktip @endif</span>

				@foreach($booktips as $booktip) 
				<span>
				@if($language == 'de') 
					{!!$booktip->textDE!!}
				@else
					{!!$booktip->textEN!!}
				@endif
				</span>
				@endforeach
			</div>

			<div class="splace-paragraph__author">
				@if($article->bio_image) <img src="/images/{{$article->bio_image}}" alt=""> @endif
				<span>
				@if($language == 'de') 
					{!!$article->bio_textDE!!}
				@else
					{!!$article->bio_textEN!!}
				@endif
				</span>
			</div>
		</div>

		<div class="splace-paragraph">
			<div class="splace-paragraph__share">
				<span>Share this article</span>
				<a href="https://vimeo.com/splace" class="splace-background-color" target="_blank"><i class="icon-vimeo"></i></a>
				<a href="https://www.facebook.com/SplaceMagazine" class="splace-background-color" target="_blank"><i class="icon-facebook"></i></a>
				<a href="mailto:redaktion@splace-magazine.at" class="splace-background-color" target="_blank"><i class="icon-mail"></i></a>
			</div>
			<p class="splace-paragraph__usages">
				<span>MATERIAL USED IN THIS ARTICLE</span>
				X
				@if($language == 'de')
					{!!$article->used_materialDE!!}
				@else
					{!!$article->used_materialEN!!}
				@endif
				X
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
				<span class="splace-issue-selection__current">#2</span>
				<ul class="splace-issue-selection__list"></ul>
			</div>
			<div class="splace-navigation-trigger">
				<span>Inhalt</span>
			</div>
			<div class="splace-footer-links">
				<a href="#" class="splace-language-switcher splace-footer-links__item">EN</a>
				<a href="#" class="splace-footer-links__item">INFO</a>
				<div class="splace-footer-links__item splace-external-links__wrapper">
					<i class="icon-external-link"></i>
					<ul class="splace-external-links__list">
						<li><a href="#"><i class="icon-vimeo"></i></a></li>
						<li><a href="https://www.facebook.com/SplaceMagazine" target="_blank"><i class="icon-facebook"></i></a></li>
						<li><a href="mailto:redaktion@splace-magazine.at" target="_blank"><i class="icon-mail"></i></a></li>
					</ul>
				</div>
				<a href="hilfe.html" class="splace-footer-links__item">?</a>
				<a href="#" class="splace-footer-links__item splace-user__trigger">*</a>
			</div>
		</div>
	</div>

	<div class="splace-user splace-user__login-signup-modal">
		<span class="splace-user__title">Anmelden / Registrieren</span>
		<span class="splace-user__close splace-color">x</span>

		<div class="splace-user__login-section splace-border-color">
			<h2>Anmelden</h2>
			<p>
				Um Artikel zu kommentieren müssen Sie registriert sein. Nur Kommentare von angemeldeten LeserInnen können berücksichtigt werden. Klar fomulieren was kann ich dann machen. TEXT ?!
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
			<p></p>

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
	<script type="text/javascript" src="/js/blueimp-gallery.min.js"></script>
</body>
</html>