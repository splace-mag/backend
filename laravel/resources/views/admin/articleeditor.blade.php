@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Artikel {{ $article->nameDE or '' }}
					<span class="content-language">
						<a id="language-switch--de" class="language-switch active">Deutsch</a> | 
						<a id="language-switch--en" class="language-switch">Englisch</a>
					</span>
				</div>
				
				<div class="panel-body editor">
					<form class="article-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{ $article->article_id or '-1' }}"/>

						<a class="show-sections">Alle ausklappen</a>

						<div class="form-group">
							<div class="language-de">
								<h2>Deutsche Inhalte</h2>
								<h5>Kurztitel (Navigation)</h5>
								<input class="form-control" name="titleDE" value="{{ $article->titleDE or '' }}" placeholder="Kurztitel" />
							</div>
							<div class="language-en hidden">
								<h2>Englische Inhalte</h2>
								<h5>Kurztitel (Navigation)</h5>
								<input class="form-control" name="titleEN" value="{{ $article->titleEN or '' }}" placeholder="Kurztitel" />
							</div>
							<h5>App-Name (für Quervariante)</h5>
							<input class="form-control" name="app_name" value="{{ $article->app_name or '' }}" placeholder="App-Name" />
						</div>

						<a class="section-header" data-key="title"><h4>Seitentitel</h4></a>
						<div class="form-group section-content hidden" data-key="title">
							

							<h5>Titel</h5>
							<div class="language-de">
								<input class="form-control" name="page_titleDE" value="{{ $article->page_titleDE or '' }}" placeholder="Titel" />
							</div>
							<div class="language-en hidden">
								<input class="form-control" name="page_titleEN" value="{{ $article->page_titleEN or '' }}" placeholder="Titel" />
							</div>

							<div class="col-md-6">
								Abstand links (in %): 
								<input class="form-control gradient-input" name="page_title_padding_left" value="{{ $article->page_title_padding_left or ''}}" />
							</div>
							<div class="col-md-6">
								Abstand oben (in %): 
								<input class="form-control gradient-input" name="page_title_padding_top" value="{{ $article->page_title_padding_top or ''}}"/>
							</div>

							<h5>Untertitel</h5>
							<div class="language-de">
								<input class="form-control" name="page_subtitleDE" value="{{ $article->page_sub_titleDE or '' }}" placeholder="Untertitel" />
							</div>
							<div class="language-en hidden">
								<input class="form-control" name="page_subtitleEN" value="{{ $article->page_sub_titleEN or '' }}" placeholder="Untertitel" />
							</div>

							<div class="col-md-12">
								Hintergrundfarbe (Format: #000000): 
								<input class="form-control gradient-input" name="subtitle_backgroundcolor" value="{{ $article->subtitle_backgroundcolor or '' }}" placeholder="Hintergrundfarbe"/>
							</div>

							<div class="col-md-6">
								Abstand links (in %): 
								<input class="form-control gradient-input" name="page_sub_title_padding_left" value="{{ $article->page_sub_title_padding_left or ''}}" />
							</div>
							<div class="col-md-6">
								Abstand oben (in %): 
								<input class="form-control gradient-input" name="page_sub_title_padding_top" value="{{ $article->page_sub_title_padding_top or ''}}"/>
							</div>

							<h5>Cover Bild</h5>
							<input class="form-file" type="file" name="cover_image" id="cover_image"/>
							@if(!$new)
							<div>
							@if($article->cover_image)
								Aktuelles Cover Image: <a href="/images/{{$article->cover_image}}" target="_blank">{{$article->cover_image_name}}</a>
							@else
								Derzeit kein Cover Image vorhanden!
							@endif
							</div>
							@endif
							<div class="col-md-6">
								Abstand links (in %): 
								<input class="form-control gradient-input" name="cover_image_padding_left" value="{{ $article->cover_image_padding_left or ''}}" />
							</div>
							<div class="col-md-6">
								Abstand oben (in %): 
								<input class="form-control gradient-input" name="cover_image_padding_top" value="{{ $article->cover_image_padding_top or ''}}"/>
							</div>
						</div>

		
						<a class="section-header" data-key="info"><h4>Leseinformationen</h4></a>
						<div class="form-group section-content hidden" data-key="info">
							<h5>Summary</h5>
							<div class="language-de">
								<div class="epiceditor" data-markdown="summaryDE"></div>
								<input id="summaryDE" name="summaryDE" class="hidden" value="{{ $article->markdown_summaryDE or '' }}" placeholder="Summary" />
							</div>
							<div class="language-en hidden">
								<div class="epiceditor" data-markdown="summaryEN"></div>
								<input id="summaryEN" name="summaryEN" class="hidden" value="{{ $article->markdown_summaryEN or '' }}" placeholder="Summary" />
							</div>
						
							<h5>Spitzmarke</h5>
							<input class="form-control" name="spitzmarke" value="{{ $article->spitzmarke or '' }}" placeholder="Spitzmarke" />
							
							<h5>Lesezeit</h5>
							<input class="form-control" name="reading_time" value="{{ $article->reading_time or '' }}" placeholder="Lesezeit" />
							
							<h5>Gradient (Format: #000000)</h5>
							<input class="form-control gradient-input" name="gradient_1" value="{{ $article->gradient_1 or '' }}" placeholder="Gradient von" />
							<input class="form-control gradient-input" name="gradient_2" value="{{ $article->gradient_2 or '' }}" placeholder="Gradient bis" />
							
							<h5>Link-Farbe (Format: #000000)</h5>
							<input class="form-control gradient-input" name="link_color" value="{{ $article->link_color or '' }}" placeholder="Link Farbe" />
						</div>

						<a class="section-header" data-key="text"><h4>Einleitung</h4></a>
						<div class="form-group section-content hidden" data-key="text">
							<div class="language-de">
								<div class="epiceditor" data-markdown="introductionDE"></div>
								<textarea id="introductionDE" name="introductionDE" class="hidden" placeholder="Einleitung" >{{ $article->markdown_introductionDE or '' }}</textarea>	
							</div>
							<div class="language-en hidden">
								<div class="epiceditor" data-markdown="introductionEN"></div>
								<textarea id="introductionEN" name="introductionEN" class="hidden" placeholder="Einleitung" >{{ $article->markdown_introductionEN or '' }}</textarea>	
							</div>
						</div>

						<a class="section-header" data-key="material"><h4>Used Material</h4></a>
						<div class="form-group section-content hidden" data-key="material">
							<div class="language-de">
								<div class="epiceditor" data-markdown="used_materialDE"></div>
								<textarea id="used_materialDE" name="used_materialDE" class="hidden" placeholder="Used Material" >{{ $article->markdown_used_materialDE or '' }}</textarea>	
							</div>
							<div class="language-en hidden">
								<div class="epiceditor" data-markdown="used_materialEN"></div>
								<textarea id="used_materialEN" name="used_materialEN" class="hidden" placeholder="Used Material" >{{ $article->markdown_used_materialEN or '' }}</textarea>	
							</div>
						</div>

						<a class="section-header" data-key="author"><h4>Autor</h4></a>
						<div class="form-group section-content hidden" data-key="author">
							<input class="form-control" name="author_name" value="{{ $article->author_name or '' }}" placeholder="Autor" />
							
							<h5>Bild Autor</h5>
							<input class="form-file " type="file" name="bio_image" id="bio_image"/>
							@if(!$new)
								@if($article->bio_image)
									Aktuelles Bild: <a href="/images/{{$article->bio_image}}" target="_blank">{{$article->bio_image_name}}</a>
								@else
									Derzeit kein Bild vorhanden!
								@endif
							@endif

							<h5>Bild Autor (groß)</h5>
							<input class="form-file " type="file" name="bio_image_big" id="bio_image_big"/>
							@if(!$new)
								@if($article->bio_image)
									Aktuelles Bild: <a href="/images/{{$article->bio_image_big}}" target="_blank">{{$article->bio_image_big_name}}</a>
								@else
									Derzeit kein Bild vorhanden!
								@endif
							@endif
							
							<h5>Biografie Kurztext</h5>
							<div class="language-de">
								<input class="form-control" name="bio_text_shortDE" value="{{ $article->bio_text_shortDE or '' }}" placeholder="Autor-Biografie (kurzer Vorschautext)" />
							</div>
							<div class="language-en hidden">
								<input class="form-control" name="bio_text_shortEN" value="{{ $article->bio_text_shortEN or '' }}" placeholder="Autor-Biografie (kurzer Vorschautext)" />
							</div>

							<h5>Biografie</h5>
							<div class="language-de">
								<div class="epiceditor" data-markdown="bio_textDE"></div>
								<textarea id="bio_textDE" name="bio_textDE" class="hidden" placeholder="Autor-Biografie" >{{ $article->markdown_bio_textDE or '' }}</textarea>	
							</div>
							<div class="language-en hidden">
								<div class="epiceditor" data-markdown="bio_textEN"></div>
								<textarea id="bio_textEN" name="bio_textEN" class="hidden" placeholder="Autor-Biografie" >{{ $article->markdown_bio_textEN or '' }}</textarea>	
							</div>
						</div>

						<a class="section-header" data-key="sections"><h4>Text</h4></a>
						<div class="form-group section-content hidden" data-key="sections">
							<div class="language-de">
								<div class="epiceditor" data-markdown="textDE"></div>
								<textarea id="textDE" name="textDE" class="hidden" placeholder="Text" >{{ $article->editor_section_codeDE or '' }}</textarea>
							</div>
							<div class="language-en hidden">
								<div class="epiceditor" data-markdown="textEN"></div>
								<textarea id="textEN" name="textEN" class="hidden" placeholder="Text" >{{ $article->editor_section_codeEN or '' }}</textarea>	
							</div>

							@if(!$new)
							<a href="/admin/article/sections/{{ $article->article_id}}">Zeige Absätze</a>
							@endif
						</div>

						<a class="section-header" data-key="links"><h4>Links</h4></a>
						<div class="form-group section-content hidden" data-key="links">
							<div class="link-box">
								@if(!$new)
								@foreach ($links as $link)
									<a class="link-head" data-key="{{$link->number}}"><h4>Link {{$link->number}}</h4></a>
									<div class="link-input hidden" data-key="{{$link->number}}">
										<a class="delete-link link-color__red" data-key="{{$link->number}}"><i class="fa fa-times"></i> Link löschen</a>
										<input type="hidden" name="link-id" value="{{$link->link_id}}">
										<input class="form-control" type="text" name="link" value="{{$link->link}}" placeholder="Link">
										<h5>Beschreibung Deutsch</h5>
										<input class="form-control" type="text" name="link_descriptionDE" value="{{$link->link_descriptionDE}}" placeholder="Beschreibung Deutsch">
										<h5>Beschreibung Englisch</h5>
										<input class="form-control" type="text" name="link_descriptionEN" value="{{$link->link_descriptionEN}}" placeholder="Beschreibung Englisch">
										<hr>
									</div>
								@endforeach
								@endif
							</div>
							<a class="add-link link-color__green"><i class="fa fa-plus"></i> hinzufügen</a>
						</div>

						<a class="section-header" data-key="booktips"><h4>Buchtipps</h4></a>
						<div class="form-group section-content hidden" data-key="booktips">
							<div class="booktip-box">
								@if(!$new)
								@foreach ($booktips as $booktip)
									<a class="booktip-head" data-key="{{$booktip->number}}"><h4>Buchtipp {{$booktip->number}}</h4></a>
									<div class="booktip-input hidden" data-key="{{$booktip->number}}">
										<a class="delete-booktip link-color__red" data-key="{{$booktip->number}}"><i class="fa fa-times"></i> Buchtipp löschen</a>
										<input type="hidden" name="booktip-id" value="{{$booktip->link_id}}">
										<input class="form-control" type="text" name="booktip_descriptionDE" value="{{$booktip->textDE}}" placeholder="Buchtipp Deutsch">
										<input class="form-control" type="text" name="booktip_descriptionEN" value="{{$booktip->textEN}}" placeholder="Buchtipp Englisch">
										<hr>
									</div>
								@endforeach
								@endif
							</div>
							<a class="add-booktip link-color__green"><i class="fa fa-plus"></i> hinzufügen</a>
						</div>

						
						@if(!$new)
						<div class="form-group">
							<a href="/admin/article/comments/{{ $article->article_id }}">Zeige Kommentare</a>
						</div>
						@endif

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="article-editor-form__success alert alert-success hidden">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="article-editor-form__error alert alert-danger hidden">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="/epiceditor/js/epiceditor.min.js"></script>
<script src="/epiceditor/js/epiceditor_config.js"></script>
@endsection
