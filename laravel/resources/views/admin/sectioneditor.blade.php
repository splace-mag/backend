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

						<h4>Medien</h4>

<!--
						<div class="form-group">
							<select id="media-type-select" class="input-sm">
								<option value="none">keine</option>
								<option value="gallery" @if($section->media_type == 'gallery') selected @endif >Bildgalerie</option>
								<option value="image" @if($section->media_type == 'image') selected @endif >Bild</option>
								<option value="youtube-video" @if($section->media_type == 'youtube-video') selected @endif >Youtube Video</option>
								<option value="vimeo-video" @if($section->media_type == 'vimeo-video') selected @endif >Vimeo Video</option>
							</select>
						</div>
-->

						<div id="media-image" class="form-group media-type">
							<h5>Bild</h5>
							<input class="form-file" type="file" name="media-file-image"/>
							<div class="media-input">
								@if($media['image'])
								<h6>Aktuelles Bild</h6>
								<a href="/images/{{$media['image-data']->file_name}}" target="_blank">{{$media['image-data']->original_name}}</a>
								<a href="/admin/media/delete/{{$section->section_id}}/{{$media['image-data']->file_name}}" class="link-color__red article-delete"><i class="fa fa-times"></i> Löschen</a>
								<input class="form-control media-descriptionDE" name="image-descriptionDE" data-key="{{$media['image-data']->media_id}}" type="text" value="{{$media['image-data']->descriptionDE}}" placeholder="Bildbeschreibung Deutsch" />
								<input class="form-control media-descriptionEN" name="image-descriptionEN" data-key="{{$media['image-data']->media_id}}" type="text" value="{{$media['image-data']->descriptionEN}}" placeholder="Bildbeschreibung Englisch" />
								@else
								Derzeit kein Bild vorhanden!
								@endif
							</div>
						</div>
						<hr>

						<div id="media-youtube-video" class="form-group media-type">
							<h5>Youtube Video</h5>
							<input class="form-control" type="text" name="media-youtube-video" @if($media['youtube-video']) value="{{$media['youtube-video-data']->original_name}}" @endif placeholder="Youtube Video-Code"/>
							<div class="media-input">
							@if($media['youtube-video'] != '') 
								<input class="form-control" name="youtube-video-descriptionDE" data-key="{{$media['youtube-video-data']->media_id}}" type="text" value="{{$media['youtube-video-data']->descriptionDE}}" placeholder="Bildbeschreibung Deutsch" />
								<input class="form-control" name="youtube-video-descriptionEN" data-key="{{$media['youtube-video-data']->media_id}}" type="text" value="{{$media['youtube-video-data']->descriptionEN}}" placeholder="Bildbeschreibung Englisch" />
							@endif
							</div>
						</div>
						<hr>

						<div id="media-vimeo-video" class="form-group media-type">
							<h5>Vimeo Video</h5>
							<input class="form-control" type="text" name="media-vimeo-video" @if($media['vimeo-video']) value="{{$media['vimeo-video-data']->original_name}}" @endif placeholder="Vimeo Video-Code"/>
							<div class="media-input">
							@if($media['vimeo-video'] && $media['vimeo-video'] != '') 
								<input class="form-control" name="vimeo-video-descriptionDE" data-key="{{$media['vimeo-video-data']->media_id}}" type="text" value="{{$media['vimeo-video-data']->descriptionDE}}" placeholder="Bildbeschreibung Deutsch" />
								<input class="form-control" name="vimeo-video-descriptionEN" data-key="{{$media['vimeo-video-data']->media_id}}" type="text" value="{{$media['vimeo-video-data']->descriptionEN}}" placeholder="Bildbeschreibung Englisch" />						
							@endif
							</div>
						</div>
						<hr>

						<div id="media-gallery-thumbnail" class="form-group media-type">
							<h5>Galerie - Thumbnail</h5>
							<input class="form-file" type="file" name="media-file-image-cover"/>
							<div class="media-input">
							@if($media['cover'])
								<h6>Thumbnail</h6>
								<a href="/admin/media/delete/{{$section->section_id}}/{{$media['cover-data']->file_name}}" class="link-color__red article-delete"><i class="fa fa-times"></i> Löschen</a>
								<a href="/images/{{$media['cover-data']->file_name}}" target="_blank">{{$media['cover-data']->original_name}}</a>
								<input class="form-control media-descriptionDE" name="gallery-thumbnail-descriptionDE" data-key="{{$media['cover-data']->media_id}}" type="text" value="{{$media['cover-data']->descriptionDE}}" placeholder="Bildbeschreibung Deutsch" />
								<input class="form-control media-descriptionEN" name="gallery-thumbnail-descriptionEN" data-key="{{$media['cover-data']->media_id}}" type="text" value="{{$media['cover-data']->descriptionEN}}" placeholder="Bildbeschreibung Englisch" />
							@else
								Derzeit kein Bild vorhanden!
							@endif
							</div>
						</div>
						
						<div id="media-gallery" class="form-group media-type">
							<h5>Bilder für Galerie</h5>
							<input class="form-file" type="file" name="media-file-image-multiple" multiple/>
							<div class="media-input-container">
							@if($media['gallery'])
								<h6>Aktuelle Bilder</h6>
								@foreach($media['gallery-data'] as $gallery_item)
								<div class="media-input">
									<a href="/images/{{$gallery_item->file_name}}" target="_blank">{{$gallery_item->original_name}}</a>
									<a class="link-color__red article-delete" href="/admin/media/delete/{{$section->section_id}}/{{ $gallery_item->file_name }}"><i class="fa fa-times"></i> Löschen</a>
									<input name="media-descriptionDE" name="gallery-item-descriptionDE" class="form-control media-descriptionDE" data-key="{{$gallery_item->media_id}}" type="text" value="{{$gallery_item->descriptionDE}}" placeholder="Bildbeschreibung Deutsch" />
									<input name="media-descriptionEN" name="gallery-item-descriptionEN" class="form-control media-descriptionEN" data-key="{{$gallery_item->media_id}}" type="text" value="{{$gallery_item->descriptionEN}}" placeholder="Bildbeschreibung Englisch" />
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
