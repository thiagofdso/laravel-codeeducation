@extends('app')

@section('content')
    <div class="container">
    <h1>Edit Post</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::model($post,['route'=>['admin.update',$post->id],'method'=>'put']) !!}

@include('admin.posts.form')

    <!-- Form Input Tags    -->

        <div class="form-group">
            {!! Form::label('tags','Tags:') !!}
            {!! Form::textarea('tags',$post->tagList,['class'=>'form-control']) !!}
        </div>


        <!-- Form Submit-->

        <div class="form-group">
                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                <a href="{{route('admin.cancel')}}" class="btn btn-info">Cancel</a>
        </div>


        {!! Form::close() !!}
    </div>
@endsection