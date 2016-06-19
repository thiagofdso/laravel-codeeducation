@extends('app')
@section('content')
    <div class="container">
        <h1>Blog</h1>
        @foreach($posts as $post)
            <h2>{{$post->title}}</h2>
            <p>{{$post->content}}</p>
            <hr>
        @endforeach
    </div>
@stop