@extends('layouts.app')

@section('title')
Articolo #{{$article->id}}
@endsection

@section('content')

  <div class="jumbotron">
    <h1>{{$article->title}}</h1>
    <p class="lead">Articolo nella Categoria: {{ $article->category->name }}</p>
    <p class="lead">Tags: 
      @if(count($article->tags) > 0)
        @foreach($article->tags as $tag)
          <span>{{$tag->name}}</span>
        @endforeach
      @else
        <span>Non ci sono tag associati a questo post</span>
      @endif
    </p>
    <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-primary">Modifica questo articolo</a>
  </div>  
    
  <p>{{$article->body}}</p>
    

@endsection