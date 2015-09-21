@extends('layouts.master')

@section('content')

<h1>Create a new post</h1>

<form action="{{ url('posts') }}" method="post">
	
	{{ csrf_field() }}
	
	<div>
		<label for="title">Title: </label>
		<input type="text" name="title" value="{{old('title')}}">
		{{ $errors->first('title') }}
	</div>

	<div>
		<label for="post">Post: </label>
		<textarea name="post" id="post" cols="30" rows="10">{{ old('post') }}</textarea>
		{{ $errors->first('post') }}
	</div>

	<input type="submit" value="Add Post">

</form>

@endsection