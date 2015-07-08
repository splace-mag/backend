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
								<h4>Notizen (Text rechte Seite)</h4>
								<textarea class="form-control section-area" name="noteDE" placeholder="Notiz (vollständig)">{{ $section->noteDE or '' }}</textarea>
							</div>

							<div class="form-group">
								<h4>Text (HTML Code)</h4>
								<textarea class="form-control section-area--disabled" name="textDE" disabled="disabled" placeholder="Text" >{{ $section->textDE or '' }}</textarea>	
							</div>
						</div>
						
						<div class="language-en hidden">
							<h2>Englische Inhalte</h2>
							
							<div class="form-group">
								<h4>Notizen (Text rechte Seite)</h4>
								<textarea class="form-control section-area" name="noteEN" placeholder="Notiz (vollständig)">{{ $section->noteEN or '' }}</textarea>
							</div>

							<div class="form-group">
								<h4>Text (HTML Code)</h4>
								<textarea class="form-control section-area--disabled" name="textEN" disabled="disabled" placeholder="Text" >{{ $section->textEN or '' }}</textarea>	
							</div>
						</div>

						<div class="form-group">
							<h4>Medien</h4>
							<select id="media-type-select" class="input-sm">
								<option value="none">keine</option>
								<option value="gallery" @if($section->media_type == 'gallery') selected @endif >Bildgalerie</option>
								<option value="image" @if($section->media_type == 'image') selected @endif >Bild</option>
								<option value="video" @if($section->media_type == 'video') selected @endif >Video</option>
							</select>
						</div>

						<div id="media-image" class="form-group media-type @if($section->media_type != 'image') hidden @endif">
							<h5>Bild</h5>
							<input class="form-file" type="file" name="media-file-image" id="media-file-image"/>
							<div>
							@if($media['type'] == 'image')
								<div>
									<h6>Aktuelles Bild</h6>
									<a href="/images/{{$media['image']->file_name}}" target="_blank">{{$media['image']->original_name}}</a>
									<input class="form-control media-input" data-key="{{$media['image']->media_id}}" type="text" value="{{$media['image']->description}}" placeholder="Bildbeschreibung" />
								</div>
							@else
								Derzeit kein Bild vorhanden!
							@endif
							</div>
						</div>

						<div id="media-video" class="form-group media-type @if($section->media_type != 'video') hidden @endif">
							<h5>Video</h5>
							<input class="form-file" type="file" name="media-file-video" id="media-file-video"/>
							@if($media['type'] == 'video')
								<div>
									<h6>Aktuelles Video</h6>
									<a href="/images/{{$media['video']->file_name}}" target="_blank">{{$media['video']->original_name}}</a>
									<input class="form-control media-input" data-key="{{$media['video']->media_id}}" type="text" value="{{$media['video']->description}}" placeholder="Videobeschreibung" />
								</div>
							@else
								Derzeit kein Video vorhanden!
							@endif
						</div>

						<div id="media-gallery" class="form-group media-type @if($section->media_type != 'gallery') hidden @endif">
							<h5>Thumbnail</h5>
							<input class="form-file" type="file" name="media-file-image-cover" id="media-file-image-cover"/>
							@if($media['type'] == 'cover')
								<div>
									<h6>Thumbnail</h6>
									<a href="/images/{{$media['cover']->file_name}}" target="_blank">{{$media['cover']->original_name}}</a>
									<input class="form-control media-input" data-key="{{$media['cover']->media_id}}" type="text" value="{{$media['cover']->description}}" placeholder="Bildbeschreibung" />
								</div>
							@else
								Derzeit kein Bild vorhanden!
							@endif
							<hr>
							<h5>Bilder für Galerie</h5>
							<input class="form-file" type="file" name="media-file-image-multiple" id="media-file-image-multiple" multiple/>
							<div>
							@if($media['type'] == 'gallery')
								<h6>Aktuelle Bilder</h6>
								@foreach($media['gallery'] as $gallery_item)
								<div>
									<a class="link-color__red" href="/admin/media/delete/{{ $gallery_item->file_name }}"><i class="fa fa-times"></i></a>
									<a href="/images/{{$gallery_item->file_name}}" target="_blank">{{$gallery_item->original_name}}</a>
									<input class="form-control media-input" data-key="{{$gallery_item->media_id}}" type="text" value="{{$gallery_item->description}}" placeholder="Bildbeschreibung" />
								</div>
								<br>
								@endforeach
							@else
								Derzeit kein Bild vorhanden!
							@endif
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="section-editor-form__success alert alert-success hidden">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="section-editor-form__error alert alert-danger hidden">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
