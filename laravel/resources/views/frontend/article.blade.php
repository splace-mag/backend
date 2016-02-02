<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
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

	<div class="splace-portrait" data-color="{{$article->link_color}}" @if($article->app_name == 'gal' && $language == 'en') data-app-name="galen" @else data-app-name="{{$article->app_name}}" @endif >
		<div class="splace-article-header" style="background-image: linear-gradient(-60deg, {{$article->gradient_2}}, {{$article->gradient_1}});">
			@if($language == 'en' && $article->spitzmarkeEN)
				<div class="splace-article-header__marker">{{$article->spitzmarkeEN}}</div>
			@else
				@if($article->spitzmarkeDE)
				<div class="splace-article-header__marker">{{$article->spitzmarkeDE}}</div>
				@endif
			@endif
			@if($article->reading_time)
			<div class="splace-article-header__marker annotated">Reading: {{$article->reading_time}} min</div>
			@endif
			@if($article->author_name && $article->spitzmarkeDE != 'CENTERFOLD')
			<span class="splace-article-header__author">@if($language == 'de') von @else from @endif <strong>{!!$article->author_name!!}</strong></span>
			@endif
			<div class="splace-article-header__marker down">^ swipe up</div>

			<h1 style="left: {{$article->page_title_padding_left}}%; top: {{$article->page_title_padding_top}}%;">
				@if($language == 'de')
					{!!$article->page_titleDE!!}
				@else
					{!!$article->page_titleEN!!}
				@endif
			</h1>
			
			@if($language == 'de' && $article->page_sub_titleDE || $language != 'de' && $article->page_sub_titleEN)
			<h2 style="left: {{$article->page_sub_title_padding_left}}%; top: {{$article->page_sub_title_padding_top}}%; background-color: rgba( {{$backgroundRGB['r']}}, {{$backgroundRGB['g']}}, {{$backgroundRGB['b']}}, 0.2); ">
				@if($language == 'de')
					{!!$article->page_sub_titleDE!!}
				@else
					{!!$article->page_sub_titleEN!!}
				@endif
			</h2>
			@endif

			@if($article->cover_image) 
				<img src="/images/{{$article->cover_image}}" alt="" style="left: {{$article->cover_image_padding_left}}%; top: {{$article->cover_image_padding_top}}%;"> 
			@endif
		</div>

		@if($language == 'de' && $article->introductionDE || $language != 'de' && $article->introductionEN)
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
		@endif

		@foreach($sections as $section)
		<div class="splace-paragraph">
			<div class="splace-paragraph__comments splace-color splace-background-color-alpha2" data-comment-count="{{count($section->comments)}}">
				<div class="splace-paragraph__comment-icon">
					<i class="splace-background-color"></i>
					<i class="splace-background-color"></i>
					<i class="splace-background-color"></i>
				</div>
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAZCAYAAAAiwE4nAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAMpJREFUeNpiZCACNJWX/WcgHzTWdXY1wDhMDHQGdLeQhQw9B4D4IInqKbLwIHKcDPogHbVw1MLBbyEjlnJTAUgpoAnvR2IvAOKFyJLAfHmAkpLmAxD3A7EBDj0JUAwvnNFLE5J8CPWlAdRXAgT0bwD6LpDiOAQacgFIJRLQS4waDMCMS2L/0aM3HG2sPwKZHjiC3RHosBdUsxBq6QmgpQpY4tMTGgo0yRaF0OCD80lJlUQlGiyJCJR47kMTSSJdMiw0f46CUcAAEGAAjLo29PJtJVwAAAAASUVORK5CYII=" alt="" class="splace-paragraph__comment-icon--active">
				
				@if($language == 'de')
				<div class="splace-paragraph__comments-header">ANMERKUNGEN UNSERER LESER_INNEN</div>
				@else
				<div class="splace-paragraph__comments-header">NOTES FROM OUR READERS</div>
				@endif
				@foreach($section->comments as $c)
				<div class="splace-paragraph__comment">
					<div class="media attribution">
						<div class="img">
					  	<?php 
					  		if(strpos($c->picture, 'https://') === 0) {
					  			echo('<img src="'.$c->picture.'" alt="me" />');
					  		}
					  		else if($c->picture != '') {
					  			echo('<img src="/images/'.$c->picture.'" alt="me" />');
					  		}
					  		else {
					  			$image = 'profil0'.rand(1, 4).'.jpg';
					  			echo('<img src="/images/'.$image.'" alt="me" />');
					  		}
					  	?>
					  	</div>
					  	<div class="bd">
					  		<span class="splace-paragraph__comment-author">{{$c->name}}</span>
					  		<span class="splace-paragraph__comment-time">{{date("d.m.Y", strtotime($c->created_at)) }}</span>
					  	</div>
					  	<p>{!!$c->text!!}</p>
					</div>
				</div>
				@endforeach

				@if($language == 'de')
				<div class="splace-paragraph__comment-note">IHRE ANMERKUNG</div>

				<div class="splace-paragraph__comment-add-note-wrapper">
					<span class="splace-add-comment-notice">Danke für Ihr Statement!</span>
					<p class="splace-paragraph__comment-netiquette splace-paragraph__comment-netiquette--1">
						Wir achten auf die <i class="icon-external-link" style="font-size:.6rem;"></i><a href="https://tools.ietf.org/html/rfc1855" target="_blank">Netiquette</a>!<br>Vor Freischaltung Ihrer Anmerkung wird diese noch von der Redaktion gelesen und freigegeben.
					</p>
					<span class="splace-paragraph__comment-add splace-color">Anmerkung hinzufügen</span>
					<form name="splace-add-comment-form" class="splace-paragraph__comment-form">
						<span class="splace-add-comment-cancel"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAMZJREFUeNpiYACCpvIyAQYSAEw9M5BhAKTPO9pYv9x/9OgFIjXuB6q3YAIyQJpBAvOBEgnEaITqMWCq6+xaAGQkQuVxGoCmEeRCR2aQBMi5QGc8BDIDQBjERvYCNo1ASz8wwxTgMgCXRpAeRizOAzl7PpRbCMTx2DRi1YzFAAZsGkGACUfAbgDiB0j8hegawfGMJ1Q1oAaA+B7ogYhhM5bAMcQXjcyEogNfNDLj00goGhkJacQTC4kgPxcQoxEE0JJyP0CAAQAswIuxKINcrQAAAABJRU5ErkJggg==" alt=""></span>
						<textarea name="comment" required></textarea>
						<p class="splace-paragraph__comment-netiquette splace-paragraph__comment-netiquette--2">
							Wir achten auf die <i class="icon-external-link" style="font-size:.6rem;"></i><a href="https://tools.ietf.org/html/rfc1855" target="_blank">Netiquette</a>!<br>Vor Freischaltung Ihrer Anmerkung wird diese noch von der Redaktion gelesen und freigegeben.
						</p>
						<input type="submit" value="> Anmerkung absenden" class="splace-background-color">
						<input type="hidden" name="paragraph-id" value="{{$section->section_id}}">
					</form>
				</div>

				@else
				<div class="splace-paragraph__comment-note">Your note</div>

				<div class="splace-paragraph__comment-add-note-wrapper">
					<span class="splace-paragraph__comment-add splace-color">Please, leave a note.</span>
					<p class="splace-paragraph__comment-netiquette splace-paragraph__comment-netiquette--1">
						We respect the <i class="icon-external-link" style="font-size:.6rem;"></i><a href="https://tools.ietf.org/html/rfc1855" target="_blank">netiquette</a>!<br/>Bevor publishing our editor will read and approve your note. 
					</p>
					<span class="splace-add-comment-notice">Thank you for your statement!</span>
					<form name="splace-add-comment-form" class="splace-paragraph__comment-form">
						<span class="splace-add-comment-cancel"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAMZJREFUeNpiYACCpvIyAQYSAEw9M5BhAKTPO9pYv9x/9OgFIjXuB6q3YAIyQJpBAvOBEgnEaITqMWCq6+xaAGQkQuVxGoCmEeRCR2aQBMi5QGc8BDIDQBjERvYCNo1ASz8wwxTgMgCXRpAeRizOAzl7PpRbCMTx2DRi1YzFAAZsGkGACUfAbgDiB0j8hegawfGMJ1Q1oAaA+B7ogYhhM5bAMcQXjcyEogNfNDLj00goGhkJacQTC4kgPxcQoxEE0JJyP0CAAQAswIuxKINcrQAAAABJRU5ErkJggg==" alt=""></span>
						<textarea name="comment" required></textarea>
						<p class="splace-paragraph__comment-netiquette splace-paragraph__comment-netiquette--2">
							We respect the <i class="icon-external-link" style="font-size:.6rem;"></i><a href="https://tools.ietf.org/html/rfc1855" target="_blank">netiquette</a>!<br/>Bevor publishing our editor will read and approve your note. 
						</p>
						<input type="submit" value="> Send note" class="splace-background-color">
						<input type="hidden" name="paragraph-id" value="{{$section->section_id}}">
					</form>
				</div>

				@endif
			</div>

			<div class="splace-paragraph__text">
				@if($language == 'de')
					{!!$section->textDE!!}
				@else
					{!!$section->textEN!!}
				@endif
			</div>

			<div class="splace-paragraph__annotation">
				@if($section->media['image'] != false)
					<div class="splace-paragraph__annotation-image">
						<img src="/images/{{ $section->media['image-data']->file_name }}" />
						@if($language == 'de')
							<p class="splace-paragraph__annotation-info">{!! $section->media['image-data']->descriptionDE !!}</p>
						@else
							<p class="splace-paragraph__annotation-info">{!! $section->media['image-data']->descriptionEN !!}</p>
						@endif
					</div>
				@endif
				@if($section->media['youtube-video'] != false)
					<div class="splace-paragraph__annotation-video">
						<a href="https://www.youtube.com/watch?v={{ $section->media['youtube-video-data']->original_name }}" data-youtube="{{ $section->media['youtube-video-data']->original_name }}" class="splace-video splace-video__youtube">
							@if($section->media['youtube-cover'] != false)
							<img src="/images/{{ $section->media['youtube-cover-data']->file_name }}" />
							@else
							<img src="/assets/youtube_logo.jpg">
							@endif
						</a>
						@if($language == 'de')
							<p class="splace-paragraph__annotation-info">{!! $section->media['youtube-video-data']->descriptionDE !!}</p>
						@else
							<p class="splace-paragraph__annotation-info">{!! $section->media['youtube-video-data']->descriptionEN !!}</p>
						@endif
					</div>
				@endif
				@if($section->media['vimeo-video'] != false)
					<div class="splace-paragraph__annotation-video">
						<a href="https://vimeo.com/{{ $section->media['vimeo-video-data']->original_name }}" data-vimeo="{{ $section->media['vimeo-video-data']->original_name }}" class="splace-video splace-video__vimeo">
							@if($section->media['vimeo-cover'] != false)
							<img src="/images/{{ $section->media['vimeo-cover-data']->file_name }}" />
							@else
							<img src="/assets/vimeo_logo.jpg">
							@endif
						</a>
						@if($language == 'de')
							<p class="splace-paragraph__annotation-info">{!! $section->media['vimeo-video-data']->descriptionDE !!}</p>
						@else
							<p class="splace-paragraph__annotation-info">{!! $section->media['vimeo-video-data']->descriptionEN !!}</p>
						@endif
					</div>
				@endif
				
				@if($section->media['gallery'] != false)
					<div class="splace-paragraph__annotation-gallery">
						@if($section->media['cover'] != false)
							<img src="/images/{{ $section->media['cover-data']->file_name }}" />
						@endif
						@foreach($section->media['gallery-data'] as $g)
							@if($language == 'de') 
							    <a href="/images/{{ $g->file_name }}" title="{{ $g->descriptionDE }}" class="splace-gallery-link">
							        <img src="/images/{{ $g->file_name }}" alt="{{ $g->descriptionDE }}">
							    </a>
							@else
								<a href="/images/{{ $g->file_name }}" title="{{ $g->descriptionEN }}" class="splace-gallery-link">
							        <img src="/images/{{ $g->file_name }}" alt="{{ $g->descriptionEN }}">
							    </a>
							@endif
					    @endforeach

						@if($section->media['cover'] != false)
						    @if($language == 'de')
								<p class="splace-paragraph__annotation-info">{!! $section->media['cover-data']->descriptionDE !!}</p>
							@else
								<p class="splace-paragraph__annotation-info">{!! $section->media['cover-data']->descriptionEN !!}</p>
							@endif
						@endif
					</div>
				@endif
				<p>
				@if($language == 'de')
					{!!$section->noteDE!!}
				@else
					{!!$section->noteEN!!}
				@endif
				</p>
			</div>
		</div>
		@endforeach

		<div class="splace-paragraph splace-paragraph--top-space">
			@if(count($links) > 0)
			<div class="splace-paragraph__links">
				<span>Links</span>
				@foreach($links as $link) 
				<a href="{{$link->link}}" target="_blank" class="splace-color">
				@if($language == 'de') 
					{!!$link->link_descriptionDE!!}
				@else
					{!!$link->link_descriptionEN!!}
				@endif
				</a>
				@endforeach
			</div>
			@endif
	
			@if(count($booktips) > 0)
			<div class="splace-paragraph__books">
				<span>@if($language == 'de') Buchtipps @else Booktips @endif</span>

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
			@endif

			<div class="splace-paragraph__author media">
				@if($language == 'de' && $article->bio_textDE || $language != 'de' && $article->bio_textEN)
				<a href="#" class="splace-paragraph__author-more splace-color">
				@endif
					<div class="splace-paragraph__author-blend">
						@if($article->bio_image) <img src="/images/{{$article->bio_image}}" alt=""> @endif
					</div>
					<div class="bd">
						<span>
							@if($language == 'de') 
								{!!$article->bio_text_shortDE!!}
							@else
								{!!$article->bio_text_shortEN!!}
							@endif
						</span>
					</div>
				@if($language == 'de' && $article->bio_textDE || $language != 'de' && $article->bio_textEN)
				</a>
				@endif

				@if($language == 'de' && $article->bio_textDE || $language != 'de' && $article->bio_textEN)
				<div class="splace-paragraph__author-full">
					<i class="close splace-color">×</i>
					@if($article->bio_image_big) 
					<img src="/images/{{$article->bio_image_big}}" alt=""> 
					@endif
					@if($language == 'de') 
						{!!$article->bio_textDE!!}
					@else
						{!!$article->bio_textEN!!}
					@endif
				</div>
				@endif
			</div>
		</div>

		<div class="splace-paragraph">
			<div class="splace-paragraph__share">
				@if($language == 'de') 
					<span>Diesen Artikel teilen</span>
				@else
					<span>Share this article</span>
				@endif
				<a href="https://twitter.com/share?url=http://splace-00-00.dmz.ufg.ac.at/{{$magazine->version}}/article/{{$article->number}}&via=splace-magazine" target="_blank" class="splace-background-color"><i class="icon-twitter"></i></a>
				<a href="http://www.facebook.com/sharer/sharer.php?u=http://splace-00-00.dmz.ufg.ac.at/{{$magazine->version}}/article/{{$article->number}}" target="_blank" class="splace-background-color"><i class="icon-facebook"></i></a>
				<a href="mailto:?subject=splace-magazine.at&body=http://splace-00-00.dmz.ufg.ac.at/{{$magazine->version}}/article/{{$article->number}}" target="_blank" class="splace-background-color"><i class="icon-mail"></i></a>
			</div>
			@if($language == 'de' && $article->used_materialDE || $language != 'de' && $article->used_materialEN)
			<div class="splace-paragraph__usages">
				@if($language == 'de') 
					<span>VERWENDETES BILDMATERIAL</span>
				@else
					<span>MATERIAL USED IN THIS ARTICLE</span>
				@endif
				@if($language == 'de')
					{!!$article->used_materialDE!!}
				@else
					{!!$article->used_materialEN!!}
				@endif
			</div>
			@endif
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
	    <a class="prev"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAgCAYAAADwvkPPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAM9JREFUeNpiYKAS+P//fwI1DBEA4vVA/J9SgxyA+P5/KKDEoIb/aIAcQxSA+Px/LIDkQAbi9/9xAJIDGR8gxiAD5EDGAUDyBiQHMhYAcrEAoUDeT8CQ9wQTKlBBAL5AhgJQbCoQCuT5RHirgVqB7EBM2qEskJEM209RIBNp2HmCaQcNMOGRE4BiBmq4jLjYo3q6okmKp3pepEkCpnrWIqVkhYL9pEbOeSIiJ4CqkUNRPUmNqg5n5UJR2wI9cihtHqBEDrVaQP1UMwwWOQABBgB5ncxkq8AP3AAAAABJRU5ErkJggg==" alt="<"></a>
	    <a class="next"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAgCAYAAADwvkPPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAN5JREFUeNq8VlENxCAMJVNwEpAwCUiYFCTMARImYRKWU3ASkICEXptjyXJZuha6vaQ/Y3np4/EKDgBWrMlZAIk2+CFhvazICB+s0YpsR7Qkg/pdJXtg1gJWRsKgIXsz69QZdZg0UiesAjzk5tD+MPu3o6jMoZ/hGqvYHJJTZV11GTSyk6DL+Q5zvJTQS8zRpmXm2FriR+bkM7KhIc6+JqNrVJG7S7dM4bnLzyTCLKsmU0QRofRMuM3GjlBW7L2d9PcoQ6a/4U/ISvPb449s63pvHMii60UdeKMzwFeAAQCQiazlRkpjoQAAAABJRU5ErkJggg==" alt=">"></a>
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
<?php
	http_response_code(200);
?>