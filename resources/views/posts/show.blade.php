@extends('layouts.master')

@section('content')

<h1>{{ $post->title }}</h1>
<p>Written by: {{ $post->user->name }}</p>
<p>Contact the author at: {{ $post->user->email }}</p>

<div>{{ $post->post }}</div>

@endsection