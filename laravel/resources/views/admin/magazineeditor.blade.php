@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Magazin @if(!$new) {{ $magazine->title }} @endif
				</div>
				
				<div class="panel-body editor">
					<form class="magazine-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" @if(!$new) value="{{$magazine->magazine_id}}" @else value="-1" @endif/>
						
						<div class="form-group">
							<h5>Version</h5>
							<input class="form-control" type="text" name="version" @if(!$new) value="{{$magazine->version}}" @endif placeholder="Version"/>
							<h5>Titel</h5>
							<input class="form-control" type="text" name="title" @if(!$new) value="{{$magazine->title}}" @endif placeholder="Titel"/>
							
							Aktiv: 
							<input class="radio-inline" type="radio" name="active" value="1" @if(!$new) @if($magazine->active) checked @endif @endif >Ja</input>
							<input class="radio-inline" type="radio" name="active" value="0" @if(!$new) @if(!$magazine->active) checked @endif @endif >Nein</input>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="magazine-editor-form__success alert alert-success hidden">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="magazine-editor-form__error alert alert-danger hidden">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
