@extends('app')

@section('content')
    <div class="container">
    <h1>Create new Post</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['route'=>'admin.store','method'=>'post']) !!}

        @include('admin.posts.form')

        <!-- Form Submit-->

        <div class="form-group">
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>


        {!! Form::close() !!}
    </div>
@endsection