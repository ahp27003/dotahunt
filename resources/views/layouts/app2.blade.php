<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
    integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
    .rankMedal {
    position: relative;
    display: flex;
    flex-direction: column;
    -webkit-box-pack: center;
    justify-content: center;
    filter: drop-shadow(rgba(0, 0, 0, 0.3) 2px -2px 2px) drop-shadow(rgba(0, 0, 0, 0.3) 2px -2px 2px);
    }

    .rankMedal-small {
    position: relative;
    display: flex;
    flex-direction: column;
    -webkit-box-pack: center;
    justify-content: center;
    filter: drop-shadow(rgba(0, 0, 0, 0.3) 2px -2px 2px) drop-shadow(rgba(0, 0, 0, 0.3) 2px -2px 2px);
    }

    .rankTierContainer {
    display: flex;
    /* flex-direction: column; */
    -webkit-box-pack: center;
    justify-content: center;
    }

    .rankMedal img {
    width: 124px;
    height: 124px;
    }

    .rankMedal-small img {
    width: 60px;
    height: 60px;
    }

    .rankMedal-star {
    position: absolute;
}

.topContainer {
    display: flex;
    flex-direction: row;
}


</style>


</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    &lt;TeamFinder/&gt;
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        {{-- notification --}}

                        @if (count(Auth::user()->unreadNotifications))

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="badge badge-pill badge-primary" style="float:right; margin-bottom:-10px; "> {{count(Auth::user()->unreadNotifications)}} </span> <i class="far fa-bell"></i>
                            </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach(Auth::user()->unreadNotifications as $noti)
                                        @include('notifications.' . snake_case(class_basename($noti->type)))
                                    @endforeach

                                </div>

                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <i class="far fa-bell"></i>
                            </a>


                        </li>


                        @endif


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                    @if(Auth::user()->accounts)
                                        {{-- <a class="dropdown-item" href="players/{{ Auth::user()->accounts->dota_id}}">Profile</a> --}}
                                        <a class="dropdown-item" href=" {{ url('/players/' . Auth::user()->accounts->dota_id ) }}">My Profile</a>
                                        <a class="dropdown-item" href=" {{ url('/players/' . Auth::user()->accounts->dota_id ) }}/stats">Overview</a>
                                        <a class="dropdown-item" href=" {{ url('/notifications') }}">Notification</a>
                                        <a class="dropdown-item" href="{{ url('/players/' . Auth::user()->accounts->dota_id ) }}/achievements">My Achievements</a>
                                        <a class="dropdown-item" href=" {{ url('/tournaments') }}">Tournaments</a>
                                        <a class="dropdown-item" href="{{ url('/players/list') }}">List Player</a>
                                        <a class="dropdown-item" href="{{ url('/players/recommendation') }}">Recommendation Player</a>
                                        <a class="dropdown-item" href="{{ url('/teams/create') }}">Create Team</a>
                                    @else
                                        <a class="dropdown-item" href="{{ url('/steamconnects') }}">
                                        Link Steam Account</a>

                                    @endif

                                    @if (Auth::user()->team)

                                    @foreach (Auth::user()->team as $item)

                                    <a class="dropdown-item" href="{{ url('/teams/' . $item->id) }}">
                                        My Team</a>
                                    <a class="dropdown-item" href="{{ url('/scrims')}}">
                                        Find team to Scrims</a>
                                    <a class="dropdown-item" href="{{ url('/scrims-schedule')}}">
                                        Scrims Schedule</a>

                                    @endforeach

                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            @yield('content')
        </main>
    </div>
</body>
</html>
