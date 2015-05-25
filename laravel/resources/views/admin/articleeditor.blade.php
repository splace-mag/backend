@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Artikel {{ $article->nameDE or '' }}
					<span class="content-language">
						<a href="#" id="language-switch--de" class="language-switch active">Deutsch</a> | 
						<a href="#" id="language-switch--en" class="language-switch">Englisch</a>
					</span>
				</div>
				
				<div class="panel-body editor">
					<form class="article-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{ $article->article_id or '-1' }}"/>

						<div class="language-de">
							<h2>Deutsche Inhalte</h2>
							<div class="form-group">
								<input class="form-control" name="titleDE" value="{{ $article->titleDE or '' }}" placeholder="Kurztitel" />
							</div>

							<div class="form-group">
								<h4>Seitentitel</h4>
								<h5>Titel</h5>
								<input class="form-control" name="page_titleDE" value="{{ $article->page_titleDE or '' }}" placeholder="Titel" />
								<h5>Untertitel</h5>
								<input class="form-control" name="page_subtitleDE" value="{{ $article->page_sub_titleDE or '' }}" placeholder="Untertitel" />
							</div>

							<div class="form-group">
								<h4>Texte</h4>
								<h5>Einleitung</h5>
								<textarea id="introductionDE" name="introductionDE" class="form-control textarea article__textarea" placeholder="Einleitung" >{{ $article->introductionDE or '' }}</textarea>	
								<h5>H2</h5>
								<textarea id="h2DE" name="h2DE" class="form-control textarea article__textarea" placeholder="H2" >{{ $article->h2DE or '' }}</textarea>	
								<h5>H3</h5>
								<textarea id="h3DE" name="h3DE" class="form-control textarea article__textarea" placeholder="H3" >{{ $article->h3DE or '' }}</textarea>	
								<h5>Used Material</h5>
								<textarea id="used_materialDE" name="used_materialDE" class="form-control article__textarea" placeholder="Used Material" >{{ $article->used_materialDE or '' }}</textarea>	
							</div>

							<div class="form-group">
								<h4>Absätze</h4>
								<div class="epiceditors" id="markdown-textDE"></div>
								<textarea id="textDE" name="textDE" class="hidden" placeholder="Text" >{{ $article->editor_section_codeDE or '' }}</textarea>	
								@if(!$new)
								<a href="/admin/article/sections/{{ $article->article_id}}">Zeige Absätze</a>
								@endif
							</div>
						</div>
						
						<div class="language-en hidden">
							<h2>Englische Inhalte</h2>
							<div class="form-group">
								<input class="form-control" name="titleEN" value="{{ $article->titleEN or '' }}" placeholder="Kurztitel" />
							</div>

							<div class="form-group">
								<h4>Seitentitel</h4>
								<h5>Titel</h5>
								<input class="form-control" name="page_titleEN" value="{{ $article->page_titleEN or '' }}" placeholder="Titel" />
								<h5>Untertitel</h5>
								<input class="form-control" name="page_subtitleEN" value="{{ $article->page_sub_titleEN or '' }}" placeholder="Untertitel" />
							</div>

							<div class="form-group">
								<h4>Texte</h4>
								<h5>Einleitung</h5>
								<textarea id="introductionEN" name="introductionEN" class="form-control textarea article__textarea" placeholder="Einleitung" >{{ $article->introductionEN or '' }}</textarea>	
								<h5>H2</h5>
								<textarea id="h2EN" name="h2EN" class="form-control textarea article__textarea" placeholder="H2" >{{ $article->h2EN or '' }}</textarea>	
								<h5>H3</h5>
								<textarea id="h3EN" name="h3EN" class="form-control textarea article__textarea" placeholder="H3" >{{ $article->h3EN or '' }}</textarea>	
								<h5>Used Material</h5>
								<textarea id="used_materialEN" name="used_materialEN" class="form-control article__textarea" placeholder="Used Material" >{{ $article->used_materialEN or '' }}</textarea>	
							</div>

							<div class="form-group">
								<h4>Absätze</h4>
								<div class="epiceditors" id="markdown-textEN"></div>
								<textarea id="textEN" name="textEN" class="hidden" placeholder="Text" >{{ $article->editor_section_codeEN or '' }}</textarea>	
								@if(!$new)
								<a href="/admin/article/sections/{{ $article->article_id}}">Zeige Absätze</a>
								@endif
							</div>
						</div>

						<div class="form-group">
							<h5>Cover Image</h5>
							<input class="form-file" type="file" name="cover_image" id="cover_image"/>
							<h5>Spitzmarke</h5>
							<input class="form-control" name="spitzmarke" value="{{ $article->spitzmarke or '' }}" placeholder="Spitzmarke" />
							<h5>Lesezeit</h5>
							<input class="form-control" name="reading_time" value="{{ $article->reading_time or '' }}" placeholder="Lesezeit" />
							<h5>Gradient (Format: #000000)</h5>
							<input class="form-control gradient-input" name="gradient_1" value="{{ $article->gradient_1 or '' }}" placeholder="Gradient von" />
							<input class="form-control gradient-input" name="gradient_2" value="{{ $article->gradient_2 or '' }}" placeholder="Gradient bis" />
						</div>

						<div class="form-group">
							<h4>Autor</h4>
							<input class="form-control" name="author_name" value="{{ $article->author_name or '' }}" placeholder="Autor" />
							<h5>Bild</h5>
							<input class="form-file " type="file" name="bio_image"/>

							<h5>Biografie</h5>
							<div class="language-de">
								<textarea id="bio_textDE" name="bio_textDE" class="form-control textarea article__textarea" placeholder="Autor-Biografie" >{{ $article->bio_textDE or '' }}</textarea>	
							</div>
							<div class="language-en hidden">
								<textarea id="bio_textEN" name="bio_textEN" class="form-control textarea article__textarea" placeholder="Autor-Biografie" >{{ $article->bio_textEN or '' }}</textarea>	
							</div>
						</div>

						<div class="form-group">
							<h3>Links</h3>
							<div class="link-box">
								@foreach ($links as $link)
									<div class="link-input" data-key="{{$link->number}}">
										<h4>Link {{$link->number}}</h4>
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
							</div>
							<a class="add-link link-color__green"><i class="fa fa-plus"></i> hinzufügen</a>
						</div>

						<div class="form-group">
							<h3>Buchtipps</h3>
							<div class="booktip-box">
								@foreach ($booktips as $booktip)
									<div class="booktip-input" data-key="{{$booktip->number}}">
										<h4>Buchtipp {{$booktip->number}}</h4>
										<a class="delete-booktip link-color__red" data-key="{{$booktip->number}}"><i class="fa fa-times"></i> Buchtipp löschen</a>
										<input type="hidden" name="booktip-id" value="{{$booktip->link_id}}">
										<input class="form-control" type="text" name="booktip_descriptionDE" value="{{$booktip->textDE}}" placeholder="Buchtipp Deutsch">
										<input class="form-control" type="text" name="booktip_descriptionEN" value="{{$booktip->textEN}}" placeholder="Buchtipp Englisch">
										<hr>
									</div>
								@endforeach
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
						
						<div class="article-editor-form__success alert alert-success">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="article-editor-form__error alert alert-danger">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/epiceditor/js/epiceditor.min.js"></script>
<script src="/epiceditor/js/epiceditor_config.js"></script>
<script src="/js/splace-backend.js"></script>

@endsection
