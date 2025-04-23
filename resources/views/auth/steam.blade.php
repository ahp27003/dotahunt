<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-32x32.png') }}" sizes="32x32" />
<link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png" sizes="16x16') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

<style>
.bg-grape{
        background-color: #4b2f8b;
    }
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
.material-icons.md-36 { font-size: 36px; }
.material-icons.md-48 { font-size: 48px; }

</style>


</head>
<body class="h-full">
        @php

            if(Auth::user()->accounts()->exists() == true){
                $playerUrl = 'players/'. Auth::user()->accounts->dota_id;
            }
            else{
                $playerUrl = 0;
            }
        @endphp
            <div id="app" class="flex min-h-screen font-sans">
                    <sidebar-component v-bind:is-open="isOpen" class="flex flex-col w-2/12 bg-sidebar">
                        <a href="#"
                        class="mt-12 mb-10 text-lg font-semibold text-purple-400 hover:text-white"
                      >
                        <i class="material-icons align-middle {{Request::is('home') ? 'text-white' : ''}}">home</i>
                        <span class="align-middle ml-2 {{Request::is('home') ? 'text-white' : ''}}">Home</span>
                      </a>
                        <a href="#"
                        class="mb-10 text-lg font-semibold text-purple-400 hover:text-white"
                      >
                        <i class="material-icons align-middle {{Request::is($playerUrl . '/stats', $playerUrl . '/heroes', '/stats', $playerUrl . '/totals',  'matches/*') ? 'text-white' : ''}}">assessment</i>
                        <span class="align-middle ml-2 {{Request::is($playerUrl . '/stats', $playerUrl . '/heroes', '/stats', $playerUrl . '/totals',  'matches/*') ? 'text-white' : ''}}">Overview</span>
                      </a>
                      <a
                      href="#"
                        class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white"
                      >
                        <i class="material-icons align-middle {{Request::is($playerUrl . '/achievements', $playerUrl . '/achievements/*') ? 'text-white' : ''}}">emoji_events</i>
                        <span class="align-middle ml-2 {{Request::is($playerUrl . '/achievements', $playerUrl . '/achievements/*') ? 'text-white' : ''}}">Achievements</span>
                      </a>
                      <a
                        href="#"
                        class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white"
                      >
                        <i class="material-icons align-middle {{Request::is('tournaments') ? 'text-white' : ''}}" >videogame_asset</i>
                        <span class="align-middle ml-2 {{Request::is('tournaments') ? 'text-white' : ''}}" >Tournaments</span>
                      </a>
                      <a
                        href="#"
                        class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white"
                      >
                        <i class="material-icons align-middle {{Request::is('teams') ? 'text-white' : ''}}" >group</i>
                        <span class="align-middle ml-2 {{Request::is('teams') ? 'text-white' : ''}}" >Teams</span>
                      </a>
                      <a href="#" class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white">
                        <i class="material-icons align-middle {{Request::is('scrims', 'scrims-schedule') ? 'text-white' : ''}}">sports_kabaddi</i>
                        <span class="align-middle ml-2 {{Request::is('scrims', 'scrims-schedule') ? 'text-white' : ''}}" >Scrims</span>
                      </a>
                      <a href="#" class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white">
                        <i class="material-icons align-middle {{Request::is('players/list') ? 'text-white' : ''}}">face</i>
                        <span class="align-middle ml-2 {{Request::is('players/list') ? 'text-white' : ''}}" >Players</span>
                      </a>
                      <a href="#" class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white">
                        <i class="material-icons align-middle {{Request::is('players/recommendation') ? 'text-white' : ''}}">assignment</i>
                        <span class="align-middle ml-2 {{Request::is('players/recommendation') ? 'text-white' : ''}}" >Recommendation</span>
                      </a>
                      <a href="#" class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white">
                        <i class="material-icons align-middle {{Request::is('livestream') ? 'text-white' : ''}}">ondemand_video</i>
                        <span class="align-middle ml-2 {{Request::is('livestream') ? 'text-white' : ''}}" >Live Stream</span>
                      </a>
                      <a href="#" class="mb-10 text-lg font-semibold text-purple-400 cursor-not-allowed hover:text-white">
                        <i class="material-icons align-middle {{Request::is('/map/search') ? 'text-white' : ''}}">near_me</i>
                        <span class="align-middle ml-2 {{Request::is('/map/search') ? 'text-white' : ''}}" >Find nearby</span>
                      </a>
                    </sidebar-component>
                    <section id="maindiv" class="flex flex-col w-10/12 bg-gray-900" v-bind:class=" { 'w-10/12': isOpen, 'w-screen': !isOpen }">
                        <header class="justify-between hidden h-20 mb-4 lg:flex bg-grape">
                            <div class="flex items-center w-8 ml-12">
                                   <i v-on:click="toggle"  class="text-white cursor-pointer material-icons md-36">
                                            menu_open
                                            </i>
                            </div>
                            <div class="flex items-center justify-around mr-12">

                                <div class="mx-3">

                                        <div class="mr-3 cursor-pointer" v-click-outside="hideNoti" @click="noti" v-if="bell == false">
                                                <i class="mt-1 text-yellow-500 material-icons md-36">notifications
                                                </i>
                                        </div>

                                </div>

                                <div class="mx-3">
                                    @if(Auth::user()->accounts()->exists() == true)
                                    <img  class="w-12 h-12 rounded-full cursor-pointer" src="{{Auth::user()->accounts->avatar_url}}" alt="">
                                    @else
                                    <img src="{{asset('img/default.svg')}}" alt="" class="w-12 h-12 rounded-full cursor-pointer">
                                    @endif
                                </div>
                                <div class="mx-3">
                                        <i  v-click-outside="hide" @click="onoff" class="text-white cursor-pointer material-icons md-36" aria-haspopup="true" :aria-expanded="opened">
                                                more_horiz
                                                </i>
                                </div>
                                <div class="mt-16">
                                    <transition name="fadedrop">
                                        <div v-show="opened" id="dropdown" class="absolute right-0 w-1/12 rounded shadow bg-content" style="display: none;">
                                                <a href="#" class="block px-4 py-2 my-1 ml-1 leading-loose text-white no-underline text-default hover:underline text-md hover:bg-dark-100">Setting</a>
                                                <a href="#" class="block px-4 py-2 my-1 ml-1 leading-loose text-white no-underline text-default hover:underline text-md hover:bg-dark-100">Inbox</a>
                                                <a class="block px-4 py-2 mb-1 ml-1 leading-loose text-white no-underline text-default hover:underline text-md hover:bg-dark-100" href="/logout"
                                                onclick="event.preventDefault();
                                                              document.getElementById('logout-form2').submit();">
                                                 {{ __('Logout') }}
                                             </a>
                                             <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </transition>
                                </div>

                            </div>
                        </header>
                        <alert-component></alert-component>

                <section id="content-div" class="h-full px-20 pb-20">
                        <section id="breadcrumb" class="pt-2 ml-4 font-medium tracking-wide text-white">
                                <span class="text-sm italic">Home / Steam / Connect</span>
                            </section>
                            <div class="container mt-12 ml-20">

                                <div class="flex w-8/12 shadow-lg bg-dark-100">
                                    <div class="w-3/12 h-48">
                                        <img src="{{ URL::to('/') }}/img/steam-icon.png" class="h-full">
                                    </div>
                                    <div class="flex flex-col items-start justify-center w-8/12 mb-10 ml-4 bg-dark-100">
                                        <p class="text-2xl font-bold text-indigo-500">Steam</p>
                                        <p class="text-xl font-semibold text-white ">You need to connect to steam before you can proceed.</p>
                                        <p class="text-gray-500 text-md font-base">Please enable "Expose Public Match Data" setting in the Dota 2 game client.</p>
                                    </div>
                                    <div class="flex flex-col items-start justify-center w-auto px-2">
                                        <div>
                                            <a href="/login/steam" class="flex-shrink-0 w-64 px-8 py-3 font-semibold text-white rounded-full shadow-md cursor-pointer btn-indigo">
                                                    Connect
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if (session('error'))
                                <p class="mt-3 ml-20 italic text-red-500">{{ session('error') }}</p>
                                @endif

                            </div>

                </section>
            </section>


    </div>


</body>
</html>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You need to connect your accounts with steam to continue</div>
                <div class="text-center">
                    <img src="{{ URL::to('/') }}/img/steam.png" alt="" class="w-50"><br>
                    <a href="/login/steam" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Connect</a>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                </div>


            </div>
        </div>
    </div>
</div> --}}


