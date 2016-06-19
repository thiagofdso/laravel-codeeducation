@extends('app')
@section('content')
    <div class="container">
        <h1>Blog</h1>
        @foreach($posts as $post)
            <h2>{{$post->title}}</h2>
            <p>{!!  $post->content!!}</p>
        <ul>
            @foreach($post->tags as $tag)

                <li>{{$tag->name}}</li>
            @endforeach
        </ul>
            @foreach($post->comments as $comment)
                <b>Name: </b>{{$comment->name}}<br>
                <b>Comment:</b>{{$comment->comment}}

            @endforeach
            <hr>
        @endforeach
    </div>
@stop