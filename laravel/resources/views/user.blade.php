@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $user->name }}
				</div>
				
				<div class="panel-body editor">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="user-editor-form" method="post" >
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="id" value="{{ $user->id }}"/>

						<div class="form-group">
							<h4>Name</h4>
							<input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name or '' }}">	
						</div>

						<div class="form-group">
							<h4>E-Mail</h4>
							<input type="email" class="form-control" name="email" placeholder="E-Mail" value="{{ $user->email or '' }}">	
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Speichern</button>
						</div>
						
						<div class="user-editor-form__success alert alert-success hidden">
							Änderungen erfolgreich gespeichert!
						</div>
						<div class="user-editor-form__error alert alert-danger hidden">
							Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!
						</div>
					</form>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send Password Reset Link
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/splace-user.js"></script>

@endsection
