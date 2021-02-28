@extends('layouts.app')

@section('title')
Categorie
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Tutte le categorie del blog</h1>
        <p class="lead">Un elenco di tutte le categorie degli articoli scritti in questo blog</p>
        <a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Aggiungi una categoria</a>
    </div>
    
    @if($categories)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Estratto della descrizione</th>
                <th>Creata il</th>
                <th>Modificata il</th>
                <th>Azione</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="body-preview">{{ $category->description }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td class="d-flex justify-content-between"> 
                        <a class="btn btn-primary" href="{{ route('categories.show', ['category' => $category->id]) }}">
                            <i class="fas fa-eye fa-lg fa-fw"></i> Visualizza
                        </a>
                        <a class="btn btn-secondary" href="{{ route('categories.edit', ['category' => $category->id]) }}">
                            <i class="fas fa-pen fa-lg fa-fw"></i> Modifica
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $category->id }}">
                            <i class="fas fa-trash fa-lg fa-fw"></i> Cancella
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="delete-modal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cancella Definitivamente la categoria</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sei sicuro di voler cancellare definitivamente la categoria con<br>ID: {{ $category->id }} e Nome: '{{ $category->name }}' ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                        
                                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-lg fa-fw"></i>Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h2>Non ci sono categorie nel blog</h2>
        <p class="lead">Inserisci una categoria</p>
        <a class="btn btn-primary" href="{{ route('categories.create') }}">Inserisci una Categoria</a>
    @endif

@endsection