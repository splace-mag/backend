@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Absatz {{ $section->article_id }} | {{ $section->key }}
					<span class="content-language">
						<a href="#" id="language-switch--de" class="language-switch active">Deutsch</a> | 
						<a href="#" id="language-switch--en" class="language-switch">Englisch</a>
					</span>
				</div>
				
				<div class="panel-body editor">
					<form class="section-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{ $section->section_id }}"/>

						<div class="language-de">
							<h2>Deutsche Inhalte</h2>

							<div class="form-group">
								<h4>Notes (Text rechte Seite)</h4>
								<textarea class="form-control section-area--short" name="noteShortDE" placeholder="Note (kurz)">{{ $section->note_shortDE or '' }}</textarea>
								<textarea class="form-control section-area" name="noteDE" placeholder="Note (vollständig)">{{ $section->noteDE or '' }}</textarea>
							</div>

							<div class="form-group">
								<h4>Text HTML Code</h4>
								<textarea class="form-control section-area--disabled" name="textDE" disabled="disabled" placeholder="Text" >{{ $section->textDE or '' }}</textarea>	
							</div>
						</div>
						
						<div class="language-en hidden">
							<h2>Englische Inhalte</h2>
							
							<div class="form-group">
								<h4>Notes (Text rechte Seite)</h4>
								<textarea class="form-control section-area--short" name="noteShortEN" placeholder="Note (kurz)">{{ $section->note_shortEN or '' }}</textarea>
								<textarea class="form-control section-area" name="noteEN" placeholder="Note (vollständig)">{{ $section->noteEN or '' }}</textarea>
							</div>

							<div class="form-group">
								<h4>Text HTML Code</h4>
								<textarea class="form-control section-area--disabled" name="textEN" disabled="disabled" placeholder="Text" >{{ $section->textEN or '' }}</textarea>	
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="section-editor-form__success alert alert-success">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="section-editor-form__error alert alert-danger">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/splace-backend.js"></script>

@endsection
