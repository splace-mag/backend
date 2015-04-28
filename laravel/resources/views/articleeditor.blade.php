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
								<input class="form-control" name="page_titleDE" value="{{ $article->page_titleDE or '' }}" placeholder="Titel" />
								<input class="form-control" name="page_subtitleDE" value="{{ $article->page_sub_titleDE or '' }}" placeholder="Untertitel" />
							</div>

							<div class="form-group">
								<h4>Text</h4>
								<textarea id="descriptionDE" name="descriptionDE" class="form-control textarea article__textarea" placeholder="Text" >{{ $article->textDE or '' }}</textarea>	
							</div>

							<div class="form-group">
								<h4>Absätze</h4>
								<div class="epiceditors" id="markdown-textDE"></div>
								<textarea id="textDE" name="textDE" class="hidden" placeholder="Text" >{{ $article->editor_section_codeDE or '' }}</textarea>	
								<a href="/admin/article/sections/{{ $article->article_id }}">Zeige Absätze</a>
							</div>
						</div>
						
						<div class="language-en hidden">
							<h2>Englische Inhalte</h2>
							<div class="form-group">
								<input class="form-control" name="titleEN" value="{{ $article->titleEN or '' }}" placeholder="Kurztitel" />
							</div>

							<div class="form-group">
								<h4>Seitentitel</h4>
								<input class="form-control" name="page_titleEN" value="{{ $article->page_titleEN or '' }}" placeholder="Titel" />
								<input class="form-control" name="page_subtitleEN" value="{{ $article->page_sub_titleEN or '' }}" placeholder="Untertitel" />
							</div>

							<div class="form-group">
								<h4>Text</h4>
								<textarea id="descriptionEN" name="descriptionEN" class="form-control textarea article__textarea" placeholder="Text" >{{ $article->textEN or '' }}</textarea>	
							</div>

							
							<div class="form-group">
								<h4>Absätze</h4>
								<div class="epiceditors" id="markdown-textEN"></div>
								<textarea id="textEN" name="textEN" class="hidden" placeholder="Text" >{{ $article->editor_section_codeEN or '' }}</textarea>	
								<a href="/admin/article/sections/{{ $article->article_id }}">Zeige Absätze</a>
							</div>
						</div>

						<div class="form-group">
							<h4>Autor</h4>
							<input class="form-control" name="author" value="{{ $article->author or '' }}" placeholder="Autor" />
							Bild
							<input type="file" name="author_image"/>

							<div class="language-de">
								<textarea id="author_descriptionDE" name="author_descriptionDE" class="form-control textarea article__textarea" placeholder="Beschreibung" >{{ $article->author_descriptionDE or '' }}</textarea>	
							</div>
							<div class="language-en hidden">
								<textarea id="author_descriptionEN" name="author_descriptionEN" class="form-control textarea article__textarea" placeholder="Beschreibung" >{{ $article->author_descriptionEN or '' }}</textarea>	
							</div>
						</div>

						<div class="form-group">
							<textarea id="used_material" name="used_material" class="form-control textarea" placeholder="Buchreferenzen" >{{ $article->used_material or '' }}</textarea>	
						</div>

						<div class="form-group">
							<a href="/admin/article/comments/{{ $article->article_id }}">Zeige Kommentare</a>
						</div>

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
