@extends('layouts.master')

@section('content')

<h1>All posts</h1>

@foreach( $allPosts as $post )
<div>
	<h2><a href="{{ url('posts/'.$post->id) }}">{{ $post->title }}</a></h2>
</div>
@endforeach

@endsection