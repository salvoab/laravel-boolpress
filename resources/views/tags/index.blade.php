@extends('layouts.app')

@section('title')
Tag
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Tutti i tag del blog</h1>
        <p class="lead">Un elenco di tutti i tag degli articoli scritti in questo blog</p>
        <a class="btn btn-primary" href="{{ route('tags.create') }}" role="button">Aggiungi un tag</a>
    </div>
    
    @if($tags)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Estratto della descrizione</th>
                <th>Creato il</th>
                <th>Modificato il</th>
                <th>Azione</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td class="body-preview">{{ $tag->description }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>{{ $tag->updated_at }}</td>
                    <td class="d-flex justify-content-between"> 
                        <a class="btn btn-primary" href="{{ route('tags.show', ['tag' => $tag->id]) }}">
                            <i class="fas fa-eye fa-lg fa-fw"></i> Visualizza
                        </a>
                        <a class="btn btn-secondary" href="{{ route('tags.edit', ['tag' => $tag->id]) }}">
                            <i class="fas fa-pen fa-lg fa-fw"></i> Modifica
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $tag->id }}">
                            <i class="fas fa-trash fa-lg fa-fw"></i> Cancella
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="delete-modal-{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $tag->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cancella Definitivamente la categoria</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sei sicuro di voler cancellare definitivamente la categoria con<br>ID: {{ $tag->id }} e Nome: '{{ $tag->name }}' ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                        
                                        <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="post">
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
        <h2>Non ci sono tag nel blog</h2>
        <p class="lead">Inserisci un tag</p>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Inserisci un tag</a>
    @endif

@endsection