@extends('layouts.app')

@section('title')
Articolo #{{$article->id}}
@endsection

@section('content')

  <div class="jumbotron">
    <h1>{{$article->title}}</h1>
    <p class="lead">Articolo nella Categoria: {{ $article->category->name }}</p>
    <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-primary">Modifica questo articolo</a>
  </div>  
    
  <p>{{$article->body}}</p>
    

@endsection