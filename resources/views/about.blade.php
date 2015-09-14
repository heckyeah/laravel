@extends('layouts.master')

@section('title', $title)

@section('meta-desc', $metaDesc)

@section('content')
	<h1>About page</h1>

	<ul>
	@foreach($staff as $staffMember)
		<li>{{ $staffMember['name'] }} is {{ $staffMember['age'] }} years old</li>
	@endforeach
	</ul>

@endsection

@section('footer')

	@parent

	<ul>
		<li>Phone: 0800 1234567</li>
	</ul>

@endsection