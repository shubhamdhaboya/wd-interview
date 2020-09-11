@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
	<table class="data-table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Logo</th>
				<th>Email</th>
				<th>Website</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
@stop


@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
