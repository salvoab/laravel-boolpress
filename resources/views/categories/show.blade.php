@extends('layouts.app')

@section('title')
Categoria #{{$category->id}}
@endsection

@section('content')

  <div class="jumbotron">
    <h1>{{$category->name}}</h1>
    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary">Modifica questa categoria</a>
  </div>  
  <h2>Descrizione</h2>
  <p>{{$category->description}}</p>
    

@endsection