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
	
	<div class="splace-portrait">
		<div class="splace-article-header" style="background-image: linear-gradient(-60deg, rgb(73,137,124), rgb(112,198,215));">
			<div class="splace-article-header__marker">{{$article->spitzmarke}}</div>
			<div class="splace-article-header__marker annotated">Reading: {{$article->reading_time}} min</div>
			<span class="splace-article-header__author">@if($language == 'de') von @else from @endif <strong>{{$article->author_name}}</strong></span>
			<div class="splace-article-header__marker down">^ swipe up</div>

			<h1 style="right: -12%; bottom: 31%;">
				@if($language == 'de')
					{{$article->page_titleDE}}
				@else
					{{$article->page_titleEN}}
				@endif</h1>
			<h2 style="right: 0%; bottom: 17%;">
				@if($language == 'de')
					{{$article->page_sub_titleDE}}
				@else
					{{$article->page_sub_titleEN}}
				@endif
			</h2>
			@if($article->cover_image) <img src="/images/{{$article->cover_image}}" alt="" style="width: 70%; left: 0; top: 10%;"> @endif
		</div>

		<div class="splace-paragraph">
			<div class="splace-paragraph__text splace-paragraph__text--heading">
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
			<div class="splace-paragraph__comments" data-comment-count="{{count($section->comments)}}">
				@foreach($section->comments as $c)
				<div class="splace-paragraph__comment">
					<span class="splace-paragraph__comment-author">{{$c->name}}</span>
					<div class="media attribution">
					  <a href="http://twitter.com/stubbornella" class="img">
					    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/peterlandt/128.jpg" alt="me" />
					  </a>

					  <div class="bd">
					    {!!$c->text!!}
					  </div>

					</div>
				</div>
				@endforeach
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
				<a href="{{$link->link}}" target="_blank">
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
				<a href="#"><i class="icon-twitter"></i></a>
				<a href="#"><i class="icon-facebook"></i></a>
				<a href="#"><i class="icon-mail"></i></a>
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
				<span class="splace-issue-selection__current">#{{$magazine->version}}</span>
				<ul class="splace-issue-selection__list"></ul>
			</div>
			<div class="splace-navigation-trigger">
				<span>@if($language == 'de') Inhalt @else Content @endif</span>
			</div>
			<div class="splace-footer-links">
				<a @if($language == 'de') href="/locale/en" @else href="/locale/de" @endif class="splace-language-switcher splace-footer-links__item">@if($language == 'de') EN @else DE @endif</a>
				<a href="/imprint" class="splace-footer-links__item">INFO</a>
				<div class="splace-footer-links__item splace-external-links__wrapper">
					<i class="icon-external-link"></i>
					<ul class="splace-external-links__list">
						<li><a href="#"><i class="icon-vimeo"></i></a></li>
						<li><a href="https://www.facebook.com/SplaceMagazine" target="_blank"><i class="icon-facebook"></i></a></li>
						<li><a href="mailto:redaktion@splace-magazine.at" target="_blank"><i class="icon-mail"></i></a></li>
					</ul>
				</div>
				<a href="/help" class="splace-footer-links__item">?</a>
			</div>
		</div>
	</div>


	
	<script type="text/javascript">
		var splaceConfig = <?php echo($navigation); ?>
	</script>
	
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/hammer.min.js"></script>
	<script type="text/javascript" src="/js/jquery.hammer.js"></script>
	<script type="text/javascript" src="/js/OrientationController.js"></script>
	<script type="text/javascript" src="/js/MenuController.js"></script>
	<script type="text/javascript" src="/js/PageController.js"></script>
	<script type="text/javascript">
	/*$('.splace-footer').on('click', function(e){
		$('.splace-navigation').addClass('active');
	});*/
	</script>
</body>
</html>