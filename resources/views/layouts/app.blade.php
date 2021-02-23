<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Boolpress | @yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Articoli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles_api') }}">Articoli da API</a>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="container">
            @yield('content')
        </div>

        <footer></footer>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>