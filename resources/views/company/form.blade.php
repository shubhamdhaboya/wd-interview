@extends('adminlte::page')

@section('title', 'Create Company')

@section('content_header')
    <h1>Create Company</h1>
@stop

@section('content')
	@if(isset($company))
		@php
			$route = route('companies.update', ['company' => $company->id]);
		@endphp
	@else
		@php
			$route = route('companies.store');
		@endphp
	@endif

	<form action="{{ $route }}" method="post" enctype="multipart/form-data">
		@if(isset($company))
			{{ method_field('PUT') }}
		@endif
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
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ isset($company) ? $company->name : '' }}" />
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
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ isset($company) ? $company->email : '' }}" />
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
								@if(isset($company))
									<span>Click here to change logo</span>
								@else
									<span>Click here to selct logo</span>
								@endif
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
							<input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="website" value="{{ isset($company) ? $company->website : '' }}">
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
			@if(isset($company))
				<div class="col-6">
					<h3>Logo</h3>
					<img src="{{$company->logo}}" width="300" height="300" />
				</div>
			@endif
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
