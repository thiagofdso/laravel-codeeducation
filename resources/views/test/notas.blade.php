@extends('app')
@section('content')
    <div class="container">
        <h1>Anotações</h1>
        <ul>
            @foreach($notas as $nota)
                <li>{{$nota}}</li>
            @endforeach
        </ul>
    </div>
@stop