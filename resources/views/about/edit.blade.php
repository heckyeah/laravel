@extends('layouts.master')

@section('content')

	<h1>Edit: {{ $staffMember->first_name }} {{ $staffMember->last_name }}</h1>

	<form action="{{ url('about/'.$staffMember->slug) }}" method="post">
		
		<input type="hidden" name="_method" value="patch">

		{{ csrf_field() }}

		<div>
			<label for="first_name">First Name: </label>
			<input type="text" name="first_name" value="{{ old('first_name') ? old('first_name') : $staffMember->first_name }}">
			{{ $errors->first('first_name') }}
		</div>

		<div>
			<label for="last_name">Last Name: </label>
			<input type="text" name="last_name" value="{{ old('last_name') ? old('last_name') : $staffMember->last_name }}">
			{{ $errors->first('last_name') }}
		</div>

		<div>
			<label for="age">Age: </label>
			<input type="number" name="age" value="{{ old('age') ? old('age') : $staffMember->age }}">
			{{ $errors->first('age') }}
		</div>

		<input type="submit" value="Edit">

	</form>
	
	
@endsection