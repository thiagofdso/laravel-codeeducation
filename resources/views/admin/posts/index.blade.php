@extends('app')

@section('content')
    <div class="container">
    <h1>Blog Admin</h1>
        <a href="{{route('admin.create')}}" class="btn btn-success">Create new Post</a>
        <br>
        <br>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Tittle</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->tagList}}</td>
                <td>
                    <a href="{{route('admin.edit',['id'=>$post->id])}}" class="btn btn-default">Edit</a>
                    <a href="{{route('admin.destroy',['id'=>$post->id])}}" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach
        </table>
        {{$posts->render()}}
    </div>
@endsection