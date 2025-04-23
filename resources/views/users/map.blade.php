<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{Auth::check() ? Auth::user()->id : ''}}">
    <meta name="noticount" content="{{count(Auth::user()->unreadNotifications)}}">

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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css">
      <link rel="stylesheet" href="https://unpkg.com/ol-popup@4.0.0/src/ol-popup.css">
      <link href="https://cdn.jsdelivr.net/npm/ol-geocoder@latest/dist/ol-geocoder.min.css" rel="stylesheet">

<style>
     .bg-grape{
        background-color: #4b2f8b;
    }
.fadedrop-enter-active, .fadedrop-leave-active {
  transition: opacity .3s;
}
.fadedrop-enter, .fadedrop-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
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
                <a href="/home"
                class="mt-12 mb-10 text-lg font-semibold text-purple-400 hover:text-white"
              >
                <i class="material-icons align-middle {{Request::is('home') ? 'text-white' : ''}}">home</i>
                <span class="align-middle ml-2 {{Request::is('home') ? 'text-white' : ''}}">Home</span>
              </a>
                <a href="/{{$playerUrl}}/stats"
                class="mb-10 text-lg font-semibold text-purple-400 hover:text-white"
              >
                <i class="material-icons align-middle {{Request::is($playerUrl . '/stats', $playerUrl . '/heroes', '/stats', $playerUrl . '/totals',  'matches/*') ? 'text-white' : ''}}">assessment</i>
                <span class="align-middle ml-2 {{Request::is($playerUrl . '/stats', $playerUrl . '/heroes', '/stats', $playerUrl . '/totals',  'matches/*') ? 'text-white' : ''}}">Overview</span>
              </a>
                <a
                href="/{{$playerUrl}}/achievements"
                  class="mb-10 text-lg font-semibold text-purple-400 cursor-pointer hover:text-white"
                >
                  <i class="material-icons align-middle {{Request::is($playerUrl . '/achievements', $playerUrl . '/achievements/*') ? 'text-white' : ''}}">emoji_events</i>
                  <span class="align-middle ml-2 {{Request::is($playerUrl . '/achievements', $playerUrl . '/achievements/*') ? 'text-white' : ''}}">Achievements</span>
                </a>
                <a
                  href="/tournaments"
                  class="mb-10 text-lg font-semibold text-purple-400 hover:text-white"
                >
                  <i class="material-icons align-middle {{Request::is('tournaments') ? 'text-white' : ''}}" >videogame_asset</i>
                  <span class="align-middle ml-2 {{Request::is('tournaments') ? 'text-white' : ''}}" >Tournaments</span>
                </a>
                <a
                  href="{{ url('/teams') }}"
                  class="mb-10 text-lg font-semibold text-purple-400 hover:text-white"
                >
                  <i class="material-icons align-middle {{Request::is('teams') ? 'text-white' : ''}}" >group</i>
                  <span class="align-middle ml-2 {{Request::is('teams') ? 'text-white' : ''}}" >Teams</span>
                </a>
                <a href="/scrims" class="mb-10 text-lg font-semibold text-purple-400 hover:text-white">
                  <i class="material-icons align-middle {{Request::is('scrims', 'scrims-schedule') ? 'text-white' : ''}}">sports_kabaddi</i>
                  <span class="align-middle ml-2 {{Request::is('scrims', 'scrims-schedule') ? 'text-white' : ''}}" >Scrims</span>
                </a>
                <a href="/players/list" class="mb-10 text-lg font-semibold text-purple-400 hover:text-white">
                  <i class="material-icons align-middle {{Request::is('players/list') ? 'text-white' : ''}}">face</i>
                  <span class="align-middle ml-2 {{Request::is('players/list') ? 'text-white' : ''}}" >Players</span>
                </a>
                <a href="/players/recommendation" class="mb-10 text-lg font-semibold text-purple-400 hover:text-white">
                  <i class="material-icons align-middle {{Request::is('players/recommendation') ? 'text-white' : ''}}">assignment</i>
                  <span class="align-middle ml-2 {{Request::is('players/recommendation') ? 'text-white' : ''}}" >Recommendation</span>
                </a>
                <a href="/livestream" class="mb-10 text-lg font-semibold text-purple-400 hover:text-white">
                    <i class="material-icons align-middle {{Request::is('livestream') ? 'text-white' : ''}}">ondemand_video</i>
                    <span class="align-middle ml-2 {{Request::is('livestream') ? 'text-white' : ''}}" >Live Stream</span>
                  </a>
                  <a href="/map/search" class="mb-10 text-lg font-semibold text-purple-400 hover:text-white">
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
                          {{-- <h1 class="m-auto font-sans text-2xl ">Dream Team</h1> --}}
                          <div class="mx-3">
                              @if (count(Auth::user()->unreadNotifications))
                                  <div class="mr-3 cursor-pointer" v-click-outside="hideNoti" @click="noti" v-bind:kira="{{count(Auth::user()->unreadNotifications)}}">
                                    <i class="mt-1 text-yellow-500 material-icons md-36">notifications_active</i>
                                    <span class="absolute px-1 -mt-2 -ml-2 text-sm text-white bg-red-500 rounded-full">
                                      <p v-text="count"></p>
                                    </span>
                                  </div>
                                  <div v-show="notification" style="display: none;" id="dropdowns" class="absolute right-0 z-10 w-auto mt-3 text-center bg-white border rounded shadow">

                                @foreach(Auth::user()->unreadNotifications as $noti)
                                    @include('notifications.' . snake_case(class_basename($noti->type)))
                                @endforeach

                                  <noti-component v-bind:realnoti="true"></noti-component>
                                    <a href="http://teamfinder.test/notifications" class="block px-4 py-2 my-1 ml-1 font-bold leading-loose no-underline hover:bg-gray-200 text-default text-md">See All Notifications</a>
                                  </div>
                              @else
                                  <div class="mr-3 cursor-pointer" v-click-outside="hideNoti" @click="noti" v-if="bell == false">
                                          <i class="mt-1 text-yellow-500 material-icons md-36">notifications
                                          </i>
                                  <span class="absolute px-1 -mt-2 -ml-2 text-sm text-white bg-red-500 rounded-full">
                                      <p v-text="count"></p></span>
                                  </div>
                                  <div class="mr-3 cursor-pointer" v-click-outside="hideNoti" @click="noti" v-if="bell == true">
                                          <i
                                          class="mt-1 text-yellow-500 material-icons md-36">
                                          notifications_active
                                          </i>
                                      <span class="absolute px-1 -mt-2 -ml-2 text-sm text-white bg-red-500 rounded-full">
                                          <p v-text="count"></p></span>
                                  </div>
                                  <div v-if="notification" id="dropdowns" class="absolute right-0 z-10 w-2/12 mt-3 text-center bg-white rounded shadow">
                                      <noti-component v-bind:realnoti="bell"></noti-component>
                                      <a href="http://teamfinder.test/notifications" class="block px-4 py-2 my-1 ml-1 font-bold leading-loose no-underline hover:bg-gray-200 text-default text-md">
                                          See All Notifications</a>
                                      </div>
                              @endif
                          </div>

                          <div class="mx-3">
                            @if(Auth::user()->accounts()->exists() == true)
                            <a href="/{{$playerUrl}}"><img  class="w-12 h-12 border border-blue-800 rounded-full cursor-pointer" src="{{Auth::user()->accounts->avatar_url}}" alt=""></a>
                            @else
                            <a href="/{{$playerUrl}}"><img src="{{asset('img/default.svg')}}" alt="" class="w-12 h-12 border-2 border-purple-800 rounded-full cursor-pointer"></a>
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
                                        <a href="/{{$playerUrl}}" class="block px-4 py-2 my-1 ml-1 leading-loose text-white no-underline text-default hover:underline text-md hover:bg-dark-100">Setting</a>
                                        <a href="/messages" class="block px-4 py-2 my-1 ml-1 leading-loose text-white no-underline text-default hover:underline text-md hover:bg-dark-100">Inbox</a>
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
                            <span class="text-sm italic">Home / map </span>
                        </section>
                        {{-- //lg untuk laptop 1278 x XXX
                        //xl tuk desktop 1440 x 737 --}}
                        <div class="container mt-12 ml-24">

                            <map-component v-bind:user="{{ Auth::User()->id}}"></map-component>
                        </div>

                </section>
            </section>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
    <script src="https://unpkg.com/ol-popup@4.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/ol-geocoder"></script>
</body>
</html>




