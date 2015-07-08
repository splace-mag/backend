@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1>Magazine</h1>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="col-xs-2">Version</div>
					<div class="col-xs-6">Titel</div>
					<div class="col-xs-2">Aktiv</div>
				</div>

				<div class="panel-body">
					<ul class="articles">
						@foreach ($magazines as $m)
						<li>
							<div class="col-xs-2">{{$m->version}}</div>
							<a href="magazines/{{$m->magazine_id}}"><div class="col-xs-6">{{$m->title}}</div></a>
							<div class="col-xs-2">
								@if($m->active) Ja @endif
							</div>
							<div class="col-xs-2"><a class="article-delete link-color__red" href="/admin/magazines/delete/{{ $m->magazine_id }}"><i class="fa fa-times"></i> Löschen</a></div>
						</li>
						@endforeach
						<li class="important link-color__green"><a href="magazines/create"><i class="fa fa-plus"></i> Neues Magazin erstellen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
