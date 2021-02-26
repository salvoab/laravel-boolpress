@extends('layouts.app')

@section('title')
Aggiungi tag
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Aggiungi un tag</h1>
        <p class="lead">Aggiungi un nuovo tag per gli articoli del blog</p>
    </div>
    
    @include('partials.errors')

    <form action="{{ route('tags.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Titolo" required value="{{ old('name') }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
          <label for="description">Descrizione</label>
          <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description') }}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
    

@endsection