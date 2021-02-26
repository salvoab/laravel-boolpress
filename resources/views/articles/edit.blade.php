@extends('layouts.app')

@section('title')
    Scrivi un articolo
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Modifica questo articolo</h1>
        <p class="lead">Modifica l'articolo dal titolo: {{$article->title}}</p>
    </div>
    
    @include('partials.errors')

    <form action="{{ route('articles.update', ['article' => $article->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">Titolo</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Titolo" required value="{{ $article->title }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
          <label for="body">Articolo</label>
          <textarea class="form-control" name="body" id="body" rows="3" required>{{ $article->body }}</textarea>
        </div>
        @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- Scelta della categoria -->
        <div class="form-group">
            <label for="category_id">Categoria dell'articolo</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $article->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Scelta dei tag -->
        @if(count($tags) > 0)
            <div class="form-group">
            <label for="tags">Tags</label>
            <select class="form-control" name="tags[]" id="tags" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $article->tags->contains($tag) ? 'selected' : '' }} >{{ $tag->name }}</option>
                @endforeach
            </select>
            </div>
        @endif
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
    

@endsection