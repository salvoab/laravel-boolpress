@extends('layouts.app')

@section('title')
    Scrivi un articolo
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Scrivi un articolo</h1>
        <p class="lead">Scrivi un articolo da inserire nel blog</p>
    </div>
    
    @if(count($categories) > 0)

        @include('partials.errors')

        <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titolo" required value="{{ old('title') }}">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
            <label for="body">Articolo</label>
            <textarea class="form-control" name="body" id="body" rows="3" required>{{ old('body') }}</textarea>
            </div>
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Scelta della categoria -->
            <div class="form-group">
                <label for="category_id">Categoria dell'articolo</label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Scelta dei tag -->
            @if(count($tags) > 0)
                <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" name="tags[]" id="tags" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                </div>
            @endif
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    @else
        <h2>Non si può scrivere un articolo perché non ci sono categorie da associare all'articolo</h2>
        <p class="lead">Inserisci una categoria nel blog prima di scrivere l'articolo</p>
        <a class="btn btn-primary" href="{{ route('categories.create') }}">Inserisci una categoria</a>
    @endif
    

@endsection