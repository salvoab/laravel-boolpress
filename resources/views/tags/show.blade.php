@extends('layouts.app')

@section('title')
Tag #{{$tag->id}}
@endsection

@section('content')

  <div class="jumbotron">
    <h1>{{$tag->name}}</h1>
    <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="btn btn-primary">Modifica questo tag</a>
  </div>  
  <h2>Descrizione</h2>
  <p class="lead">{{$tag->description}}</p>

  @if(count($tag->articles) > 0)
    <h3>Articoli che hanno il tag {{ $tag->name }}</h3>
    <ul>
      @foreach($tag->articles as $article)
        <li><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></li>
      @endforeach
    </ul>
  @endif
    

@endsection