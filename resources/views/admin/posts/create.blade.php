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

    <!-- Form Input Tags    -->

        <div class="form-group">
            {!! Form::label('tags','Tags:') !!}
            {!! Form::textarea('tags',null,['class'=>'form-control']) !!}
        </div>


    <!-- Form Submit-->

        <div class="form-group">
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
                <a href="{{route('admin.cancel')}}" class="btn btn-info">Cancel</a>
        </div>


        {!! Form::close() !!}
    </div>
@endsection