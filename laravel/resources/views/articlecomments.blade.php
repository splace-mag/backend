@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			@if ($warning == 'nocommentwiththisid')
			<div class="panel-warning">
				<div class="panel-heading">Kein Kommentar mit dieser ID vorhanden</div>
			</div>
			@elseif ($warning == 'nonewcomment')
			<div class="panel-warning">
				<div class="panel-heading">Kein neues Kommentar vorhanden</div>
			</div>
			@elseif ($warning == 'nocommentexists')
			<div class="panel-warning">
				<div class="panel-heading">Keine Kommentare vorhanden</div>
			</div>
			@else
			
			<h4>Kommentare</h4>
			<div class="panel panel-default">
				
				<div class="panel-heading">
					<div class="col-xs-4">User</div>
					<div class="col-xs-4">Absatz</div>
					<div class="col-xs-2">Veröffentlicht</div>
				</div>

				<div class="panel-body">
					<div class="form">
						<ul class="sections">
							@foreach ($comments as $comment)
							<li>
								<div class="col-xs-4">{{ $comment->name }}</div>
								<div class="col-xs-4"><a href="/admin/comments/{{ $comment->comment_id }}">{{ $comment->titleDE }} | {{ $comment->key }}</a></div>
								<div class="col-xs-2">
									@if ( $comment->marked == 1)
									<input name="marked-{{$comment->comment_id}}" type="checkbox" checked/>
									@else
									<input name="marked-{{$comment->comment_id}}" type="checkbox"/>
									@endif
								</div>
								<div class="col-xs-2"><a class="article-delete link-color__red" href="/admin/comments/delete/{{ $comment->comment_id }}"><i class="fa fa-times"></i> Löschen</a></div>
							</li>
							@endforeach

							<li class="important">
								<div class="col-xs-4 col-xs-push-4 article-pagination">
								@if ( $comments->currentPage() > 1 )
								<a class="show-prev-page" href="{{ $comments->previousPageUrl() }}"><i class="fa fa-chevron-left fa-2x"></i></a>
								@endif
								
								<span class="article-counter">Seite {{ $comments->currentPage() }} von {{ $comments->lastPage() }}</span>
								
								@if ( $comments->hasMorePages() )
								<a class="show-next-page" href="{{ $comments->nextPageUrl() }}"><i class="fa fa-chevron-right fa-2x"></i></a>
								@endif
								</div>
							</li>

						</ul>
					</div>
				</div>
			</div>

			@endif
		</div>
	</div>
</div>
@endsection
