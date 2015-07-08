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
			<div class="splace-qarticle-header__marker down">^ swipe up</div>

			<h1 style="right: 5%; bottom: 30%;">
				@if($language == 'de')
					{{$article->page_titleDE}}
				@else
					{{$article->page_titleEN}}
				@endif
			</h1>
			<h2 style="right: 0%; bottom: 56%;">
				@if($language == 'de')
					{{$article->page_sub_titleDE}}
				@else
					{{$article->page_sub_titleEN}}
				@endif
			</h2>
			<img src="/images/{{$article->cover_image}}" alt="" style="width: 70%; left: 0; top: 10%;">
		</div>

		<div class="splace-paragraph">
			<div class="splace-paragraph__text splace-paragraph__text--heading">
				<p>
				@if($language == 'de')
					{{{$article->introductionDE}}}
				@else
					{{{$article->introductionEN}}}
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
					    {{$c->text}}
					  </div>

					</div>
				</div>
				@endforeach
			</div>
			<div class="splace-paragraph__text">
				@if($language == 'de')
					{{{$section->textDE}}}
				@else
					{{{$section->textEN}}}
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
				<span>Buchtipp</span>

				@foreach($booktips as $booktip) 
				<span>
				@if($language == 'de') 
					{{{$booktip->textDE}}}
				@else
					{{{$booktip->textEN}}}
				@endif
				</span>
				@endforeach
			</div>

			<div class="splace-paragraph__author">
				<img src="/images/{{$article->bio_image}}" alt="">
				<span>
				@if($language == 'de') 
					{{{$article->bio_textDE}}}
				@else
					{{{$article->bio_textEN}}}
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
				@if($language == 'de')
					{{{$article->used_materialDE}}}
				@else
					{{{$article->used_materialEN}}}
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
				<span class="splace-issue-selection__current">Issue #2</span>
				<ul class="splace-issue-selection__list"></ul>
			</div>
			<div class="splace-navigation-trigger">
				<span>@if($language == 'de') Inhalt @else Content @endif</span>
			</div>
			<div class="splace-footer-links">
				<a @if($language == 'de') href="/locale/en" @else href="/locale/de" @endif class="splace-language-switcher splace-footer-links__item">@if($language == 'de') EN @else DE @endif</a>
				<a href="#" class="splace-footer-links__item">INFO</a>
				<div class="splace-footer-links__item">
					<a href="https://vimeo.com/splace"><i class="icon-vimeo" target="_blank"></i></a>
					<a href="https://www.facebook.com/SplaceMagazine"><i class="icon-facebook" target="_blank"></i></a>
					<a href="mailto: redaktion@splace-magazine.at"><i class="icon-mail" target="_blank"></i></a>
				</div>
				<a href="#" class="splace-footer-links__item">?</a>
			</div>
		</div>
	</div>

	
	<script type="text/javascript">
		var splaceConfig = {
			issueList: [
				{name: 'Issue #1', url: '#'}
			],
			navigationItems: [
				{url: '/splace.html', title: 'Cover', subtitle: ''},
				{url: '/dummyPage.html', title: 'Inhaltsverzeichnis', subtitle: 'Index'},
				{url: '/dummyPage2.html', title: 'Editorial', subtitle: 'Editorial'},
				{url: '#', title: 'Staging Knowledge', subtitle: '1'},
				{url: '#', title: 'Flock, Bernd Oppl', subtitle: '2'},
				{url: '#', title: 'Raum ist Rahmen <br>für Inhalte.', subtitle: '3'},
				{url: '#', title: 'Titel für einen Beitrag <br>hier geschrieben.', subtitle: '4'}
			]
		}
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