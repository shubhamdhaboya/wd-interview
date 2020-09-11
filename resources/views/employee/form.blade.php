@extends('adminlte::page')

@section('title', 'Create Employee')

@section('content_header')
    <h1>Create Employee</h1>
@stop

@section('content')
	@if(isset($employee))
		@php
			$route = route('employees.update', ['employee' => $employee->id]);
		@endphp
	@else
		@php
			$route = route('employees.store');
		@endphp
	@endif

	<form action="{{ $route }}" method="post" enctype="multipart/form-data">
		@if(isset($employee))
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
							<label for="first_name">
								First name <span class="text-danger">*</span>
							</label>
							<input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ isset($employee) ? $employee->first_name : '' }}" />
							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="last_name">
								Last name <span class="text-danger">*</span>
							</label>
							<input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{ isset($employee) ? $employee->last_name : '' }}" />
							@error('name')
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
							<label for="company_id">
								Company
							</label>
							<select class="form-control" name="company_id">
								@foreach($companies as $company)
									@if(isset($employee) && $employee->company_id == $company->id)
										<option value="{{ $company->id }}" selected="">
									@else
										<option value="{{ $company->id }}">
									@endif
										{{ $company->fullDetails }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="phone">
								Phone
							</label>
							<input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ isset($employee) ? $employee->phone : '' }}">
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="email">
								Email
							</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ isset($employee) ? $employee->email : '' }}">
							@error('email')
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
