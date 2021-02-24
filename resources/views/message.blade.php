@extends('layouts.app')

@section('title')
Errore
@endsection

@section('content')
<div class="jumbotron">
    <h1 class="display-3">Ops, Errore...</h1>
    <p class="lead">{{ $errorMessage }}</p>
    <a class="btn btn-primary" href="{{ route($backTo) }}">Indietro</a>
</div>
@endsection