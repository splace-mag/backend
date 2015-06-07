@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Kommentar zu {{ $comment->titleDE }}
				</div>
				
				<div class="panel-body editor">
					<form class="comment-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{ $comment->comment_id }}"/>

						<div class="form-group">
							Absatz: <a href="/admin/sections/{{ $comment->section_id }}"> {{ $comment->key }}</a><br>
							User: <a href="/admin/user/{{ $comment->user_id }}">{{ $comment->name }}</a>
						</div>

						<div class="form-group">
							<h4>Kommentar</h4>
							<textarea class="form-control comment-text-area" name="text" placeholder="Text" >{{ $comment->text or '' }}</textarea>	
						</div>
						
						<!--
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>
						-->
						<div class="form-group">
							Veröffentlichen 
							<input type="checkbox" name="marked" value="{{ $comment->marked }}" @if($comment->marked == '1') checked @endif />
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="comment-editor-form__success alert alert-success">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="comment-editor-form__error alert alert-danger">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
