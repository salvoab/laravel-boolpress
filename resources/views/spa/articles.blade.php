@extends('layouts.app')

@section('title')
Articoli con API
@endsection

@section('content')

<div id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <article-component></article-component>
        </div>
        <aside class="col-md-4">
            <category-component></category-component>
            <tag-component></tag-component>
        </aside>
    </div>
</div>

@endsection