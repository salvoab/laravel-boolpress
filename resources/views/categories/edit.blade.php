@extends('layouts.app')

@section('title')
Aggiungi categoria
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Modifica la categoria: {{ $category->name }}</h1>
    </div>
    
    @include('partials.errors')

    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Titolo" required value="{{ $category->name }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" id="description" rows="3" required>{{ $category->description }}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
    

@endsection