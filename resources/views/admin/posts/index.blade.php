@extends('app')

@section('content')
    <div class="container">
    <h1>Blog Admin</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Tittle</th>
                <th>Action</th>
            </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td></td>
            </tr>


        @endforeach
        </table>
    </div>
@endsection