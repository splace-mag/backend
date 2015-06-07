@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			
			<div class="panel panel-default">
				<div class="panel-heading">Angemeldete User</div>

				<div class="panel-body">
					<ul class="articles">
						@foreach ($user as $u)
						<li>
							{{$u->name}} ({{$u->email}})
							<a class="article-delete link-color__red" href="/admin/user/delete/{{ $u->id }}"><i class="fa fa-times"></i> Löschen</a>
						</li>
						@endforeach
						<li class="important">
							<div class="col-xs-4 col-xs-push-4 article-pagination">
							@if ( $user->currentPage() > 1 )
							<a class="show-prev-page" href="{{ $user->previousPageUrl() }}"><i class="fa fa-chevron-left fa-2x"></i></a>
							@endif
							
							<span class="article-counter">Seite {{ $user->currentPage() }} von {{ $user->lastPage() }}</span>
							
							@if ( $user->hasMorePages() )
							<a class="show-next-page" href="{{ $user->nextPageUrl() }}"><i class="fa fa-chevron-right fa-2x"></i></a>
							@endif
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
