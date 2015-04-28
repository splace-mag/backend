@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			@if ($warning == 'noarticlewiththisid')
			<div class="panel-warning">
				<div class="panel-heading">Kein Artikel mit dieser ID vorhanden</div>
			</div>
			@elseif ($warning == 'noarticleexists')
			<div class="panel-warning">
				<div class="panel-heading">Keine Artikel vorhanden</div>
			</div>
			@endif

			
			<div class="panel panel-default">
				<div class="panel-heading">Artikel</div>

				<div class="panel-body">
					<ul class="articles">
						@foreach ($articles as $article)
						<li>
							<a href="/admin/article/{{ $article->article_id }}">{{ $article->titleDE }}</a>
							<a class="article-delete link-color__red" href="/admin/article/delete/{{ $article->article_id }}"><i class="fa fa-times"></i> Löschen</a>
						</li>
						@endforeach

						<li class="important">
							<div class="col-xs-4 col-xs-push-4 article-pagination">
							@if ( $articles->currentPage() > 1 )
							<a class="show-prev-page" href="{{ $articles->previousPageUrl() }}"><i class="fa fa-chevron-left fa-2x"></i></a>
							@endif
							
							<span class="article-counter">Seite {{ $articles->currentPage() }} von {{ $articles->lastPage() }}</span>
							
							@if ( $articles->hasMorePages() )
							<a class="show-next-page" href="{{ $articles->nextPageUrl() }}"><i class="fa fa-chevron-right fa-2x"></i></a>
							@endif
							</div>
						</li>
						<li class="important link-color__green"><a href="article/create"><i class="fa fa-plus"></i> Neuen Artikel erstellen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
