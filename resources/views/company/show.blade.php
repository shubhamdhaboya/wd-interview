@extends('adminlte::page')

@section('title', 'Company')

@section('content_header')
    <h1>{{$company['name']}}</h1>
@stop

@section('content')
	<ul>
		@foreach($company as $column => $value)
			<li>
				@if($column == 'logo')
					<strong>{{$column}}:</strong> <a href="{{$value}}" target="_blank">click here</a>
				@elseif($column == 'website')
					<strong>{{$column}}:</strong> <a href="{{$value}}" target="_blank">{{ $value }}</a>
				@else
					<strong>{{$column}}:</strong> {{$value}}
				@endif
			</li>
		@endforeach
	</ul>
@stop


@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
