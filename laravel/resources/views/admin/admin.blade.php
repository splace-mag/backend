@extends('app')

@section('content')
<div class="container">
	<div class="row" id="articles">
		<div class="col-md-10 col-md-offset-1">
			<h1>Artikel</h1>

			@if ($warning['article'] == 'noarticlewiththisid')
			<div class="panel-warning">
				<div class="panel-heading">Kein Artikel mit dieser ID vorhanden</div>
			</div>
			@elseif ($warning['article'] == 'noarticleexists')
			<div class="panel-warning">
				<div class="panel-heading">Keine Artikel vorhanden</div>
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="articles">
						@foreach ($articles as $article)
						<li>
							<a href="/admin/article/{{ $article->article_id }}">{{ $article->titleDE }}</a>
						</li>
						@endforeach

						<li class="important"><a href="/admin/article">Alle anzeigen</a></li>
						<li class="important"><a href="/admin/sections">Artikelabsätze anzeigen</a></li>
						<li class="important link-color__green"><a href="/admin/article/create"><i class="fa fa-plus"></i> Neuen Artikel erstellen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row" id="comments">
		<div class="col-md-10 col-md-offset-1">
			<h1>Kommentare</h1>

			@if ($warning['comments'] == 'nocommentwiththisid')
			<div class="panel-warning">
				<div class="panel-heading">Kein Kommentar mit dieser ID vorhanden</div>
			</div>
			@elseif ($warning['comments'] == 'nonewcomment')
			<div class="panel-warning">
				<div class="panel-heading">Kein neues Kommentar vorhanden</div>
			</div>
			@elseif ($warning['comments'] == 'nocommentexists')
			<div class="panel-warning">
				<div class="panel-heading">Keine Kommentare vorhanden</div>
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="articles">
						@foreach ($comments as $comment)
						<li>
							<a href="/admin/article/comments/{{ $comment->article_id }}">{{ $comment->titleDE }}</a>
						  	<span class="show-unread">{{ $comment->count }} ungelesene(s) Kommentar(e)</span>
						</li>
						@endforeach

						<li><a href="/admin/comments">Alle anzeigen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row" id="users">
		<div class="col-md-10 col-md-offset-1">
			<h1>User</h1>

			@if ($warning['user'] == 'nouserwiththisid')
			<div class="panel-warning">
				<div class="panel-heading">Kein User mit dieser ID vorhanden</div>
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="articles">

						<li><a href="/admin/user">Alle anzeigen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
