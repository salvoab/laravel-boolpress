@extends('layouts.app')

@section('title')
    Scrivi un articolo
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Scrivi un articolo</h1>
        <p class="lead">Scrivi un articolo da inserire nel blog</p>
    </div>
    
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

        <div class="select-wrapper">
            <label for="category">Categoria dell'articolo</label>
            <select name="category" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
    

@endsection