@extends('layouts.master')

@section('content')

	<h1>Edit: {{ $staffMember->first_name }} {{ $staffMember->last_name }}</h1>

	<form action="{{ url('about/'.$staffMember->slug) }}" method="post">
		
		{{ csrf_field() }}

		<div>
			<label for="first_name">First Name: </label>
			<input type="text" name="first-name" value="{{ $staffMember->first_name }}">
		</div>

		<input type="submit" value="Edit">

	</form>
	
	
@endsection