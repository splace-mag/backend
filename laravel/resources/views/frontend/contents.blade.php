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
		<div class="splace-article-header" style="background-image: linear-gradient(-60deg, rgb(112,198,215), rgb(117,179,180));">
			
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
				<a href="#" class="splace-footer-links__item">INFO</a>
				<div class="splace-footer-links__item">
					<a href="#"><i class="icon-vimeo"></i></a>
					<a href="#"><i class="icon-facebook"></i></a>
					<a href="#"><i class="icon-mail"></i></a>
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