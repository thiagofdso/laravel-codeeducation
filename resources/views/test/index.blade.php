@extends('app')
@section('content')
    <div class="container">
        <h1>Olá {{$nome}} (Com proteção)</h1>
        <h1>Olá {!! $nome !!} (Sem proteção)</h1>
    </div>
@stop