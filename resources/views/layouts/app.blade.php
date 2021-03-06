<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Primary Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>{{ config('app.name', 'JournalDeBord') }}</title>

    <!-- Canonical & Favicon -->	
    <link rel="canonical" href="https://tocwebproject.fr">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Secondary Meta -->
    <meta name="description" content="Journal de bord, l'application qui vous aides à vous organiser dans vos tâches tout en ayant 
    accès à une citation par jour, votre météo et des images incroyables">
    <meta name="author"      content="TocWebProject">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    {{ config('app.name', 'JournalDeBord') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Se Connecter') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item h-100">
                                <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-home mr-1"></i>Accueil</a>
                            </li>
                            <li class="nav-item h-100">
                                <a class="nav-link" href="{{ route('todo-list') }}"><i class="fas fa-list-ul mr-1"></i>Tâches</a> 
                            </li>
                            <li class="nav-item h-100">
                                <a class="nav-link" href="{{ route('calendar') }}"><i class="fas fa-calendar-alt mr-1"></i>Calendrier</a> 
                            </li>
                        @can('manage-users')
                            <li class="nav-item h-100">
                                <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fa fa-users mr-1" aria-hidden="true"></i>Utilisateurs</a> 
                            </li>
                        @endcan
                            <li class="nav-item dropdown h-100">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->avatar)
                                    <img class="img-fluid rounded" src="{{ asset('/storage/images/'.Auth::user()->avatar) }}" alt="Avatar" width="45"/>
                                    @endif
                                    {{ Auth::user()->name }} 
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
        @include('footer')
        <div id="QuoteOFDay" style="display: none;"></div>
    </div>
    <!-- Quote of the Day with Ouest France Script -->
    <script>
        var type="day";
    </script>
    <script src="https://citations.ouest-france.fr/js/web/export.js?v3"></script>
    <!-- Lottie Animation Script -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
