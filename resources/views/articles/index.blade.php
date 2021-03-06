@extends('layouts.app')

@section('title')
Articles
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Tutti gli articoli del blog</h1>
        <p class="lead">Un elenco di tutti gli articoli scritti in questo blog</p>
        <a class="btn btn-primary" href="{{ route('articles.create') }}" role="button">Scrivi un articolo</a>
    </div>
    
    @if($articles == null)
        <h2>Impossibile utilizzare il database, contattare l'amministratore di sistema</h2>
    @elseif(count($articles) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Estratto dell'Articolo</th>
                <th>Creato il</th>
                <th>Modificato il</th>
                <th>Azione</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td class="body-preview">{{ $article->body }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->updated_at }}</td>
                    <td class="d-flex justify-content-between"> 
                        <a class="btn btn-primary" href="{{ route('articles.show', ['article' => $article->id]) }}">
                            <i class="fas fa-eye fa-lg fa-fw"></i> Visualizza
                        </a>
                        <a class="btn btn-secondary" href="{{ route('articles.edit', ['article' => $article->id]) }}">
                            <i class="fas fa-pen fa-lg fa-fw"></i> Modifica
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-{{ $article->id }}">
                            <i class="fas fa-trash fa-lg fa-fw"></i> Cancella
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="delete-modal-{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cancella Definitivamente il article</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sei sicuro di voler cancellare definitivamente il article con<br>ID: {{ $article->id }} e TITOLO: '{{ $article->title }}' ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                        
                                        <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="post">
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
        <h2>Non ci sono articoli nel blog</h2>
        <p class="lead">Prima di scrivere un articolo si consiglia di visionare le categorie per accertarsi di avere una categoria da associare all'articolo</p>
    @endif

@endsection