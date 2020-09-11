@extends('adminlte::page')

@section('title', 'Company')

@section('content_header')
    <h1>Add Company</h1>
@stop

@section('content')
	<form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-6">
				<div class="flash-message">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
						@if(Session::has('alert-' . $msg))
							<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
						@endif
					@endforeach
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="name">
								Name <span class="text-danger">*</span>
							</label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="email">
								E-mail
							</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="logo" class="logo-clickable-area">
								<span>
									Click here to selct logo
								</span>
								<br />
								<span class="text-muted logo-file-name"></span>
							</label>
							<input type="file" class="d-none" name="logo" id="logo" accept="image/*">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="website">
								Website
							</label>
							<input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="website">
							@error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
				</div>
				<input type="submit" name="submit" class="btn btn-success">
			</div>
		</div>
		@csrf
	</form>
@stop

@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
