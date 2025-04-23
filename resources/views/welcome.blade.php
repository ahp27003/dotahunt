<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="icon" type="image/png" href="{{ asset('img/favicon-32x32.png') }}" sizes="32x32" />
<link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png" sizes="16x16') }}" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Roboto', sans-serif;
                height: 100%;
            }
            .mySlides {display:none;}
            .clip{
                -webkit-clip-path: polygon(48% 69%, 23% 72%, 0 66%, 0 0, 100% 0, 100% 64%, 87% 69%, 67% 72%);
                -webkit-shape-outside: polygon(48% 69%, 23% 72%, 0 66%, 0 0, 100% 0, 100% 64%, 87% 69%, 67% 72%);
                clip-path: polygon(48% 69%, 23% 72%, 0 66%, 0 0, 100% 0, 100% 64%, 87% 69%, 67% 72%);
            }
            .material-icons.md-18 { font-size: 14px; }
        .material-icons.md-24 { font-size: 22px; }
        .material-icons.md-big { font-size: 144px; }
        .filter{
            background-color: hsla(0,0%,0%, .55);
        }
        .bm-burger-button {
      position: fixed;
      width: 32px !important;
      height: 24px !important;
      left: 36px;
    margin-top: 0.9rem;
      top: 0 !important;
      cursor: pointer;
    }
    .bm-burger-bars {
      background-color: white !important;
    }
    .line-style {
      position: absolute;
      height: 20%;
      left: 0;
      right: 0;
    }
    .cross-style {
      position: absolute;
      top: 12px;
      right: 2px;
      cursor: pointer;
    }
    .bm-cross {
      background: white;
    }
    .bm-cross-button {
      height: 24px;
      width: 24px;
    }
    .bm-menu {
      height: 100%; /* 100% Full-height */
      width: 0; /* 0 width - change this with JavaScript */
      position: fixed; /* Stay in place */
      z-index: 1000; /* Stay on top */
      top: 0;
      left: 0;
      background-color: hsla(0,0%,0%, .55) !important; /* Black*/
      overflow-x: hidden; /* Disable horizontal scroll */
      padding-top: 60px; /* Place content 60px from the top */
      transition: 0.5s; /*0.5 second transition effect to slide in the sidenav*/
    }

    .bm-overlay {
      background: rgba(0, 0, 0, 0.3);
    }
    .bm-item-list {
      color: #b8b7ad;
      margin-left: 10%;
      font-size: 20px;
    }
    .bm-item-list > * {
      display: flex;
      text-decoration: none;
      padding: 0.7em;
    }
    .bm-item-list > * > span {
      margin-left: 10px;
      font-weight: 700;
      color: white;
    }
        </style>
    </head>
    <body class="bg-gray-900">
            <div class="relative z-10 flex flex-col min-h-full bg-primary" id="app">
                <div class="absolute inset-0 bg-local bg-bottom bg-cover clip" style="background-image:url({{asset('img/sniper.jpg')}})">
                </div>
                <header class="z-20 filter">
                        <div class="container px-6 py-2 mx-auto ">
                            <div class="flex">
                                <div class="flex items-baseline w-1/2">
                                    <a href="/" class="pt-1 mr-8 text-2xl font-bold tracking-wide text-white hover:text-gray-500">&lt;dotahunt/&gt;</a>
                                </div>
                                <div class="hidden md:w-1/4 md:flex md:items-baseline">
                                    <a href="#" class="py-3 mr-8 text-lg font-medium text-white hover:text-gray-500">Players</a>
                                    <a href="#" class="py-3 mr-8 text-lg font-medium text-white hover:text-gray-500">Teams</a>
                                    <a href="#" class="py-3 text-lg font-medium text-white hover:text-gray-500">Tournaments</a>
                                </div>
                                <div class="hidden md:flex md:justify-end md:w-1/2">
                                    <a href="/login" class="py-3 mr-2 text-lg font-semibold">
                                    <span class="flex items-center text-white hover:text-gray-500">
                                    Sign in
                                    <i class="ml-1 material-icons md-18">arrow_forward</i>
                                    </span>
                                    </a>
                                </div>
                                <div class="flex items-center justify-end w-1/2 md:hidden">
                                    <Slide right>
                                    <a href="/login" id="login"><span>Sign in</span> </a>
                                    <a href="/register" id="Register" class="border-b border-gray-600"><span>Register</span> </a>
                                    <a href="#" id="Players"><span>Players</span> </a>
                                    <a href="#" id="Teams"><span>Teams</span> </a>
                                    <a href="#" id="Tournaments"><span>Tournaments</span> </a>
                                    </Slide>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="container z-10 mx-auto mt-12 md:mt-16">
                        <div class="flex justify-center md:justify-end">
                                <div id="section" class="flex flex-col items-center w-3/6 md:items-end ">
                                    <div class="flex flex-col pt-2 mr-2">
                                    <p class="max-w-lg px-4 mt-0 text-4xl text-center text-white whitespace-no-wrap bg-purple-700 border-b-4 border-l-4 border-purple-900 md:mt-4">Let's hunt some players!</p>
                                      <p class="max-w-lg pt-3 pb-2 mt-4 text-lg tracking-wide text-center text-white md:text-justify">
                                        Dotahunt is a place for Dota 2 player to find and create dota 2 team to participate tournament in Malaysia.</p>
                                        <p class="max-w-lg text-lg font-semibold tracking-wide text-center text-white md:text-justify">Sign up now to start creating your Dream Team!</p>

                                        <div class="flex justify-center mt-10">
                                            <a href="/register" class="px-4 py-2 font-bold tracking-wider text-white bg-purple-700 border-b-4 border-purple-900 rounded hover:bg-purple-600 hover:border-purple-700">
                                              Sign up
                                            </a>
                                    </div>
                                    </div>
                                </div>
                        </div>
                </div>
                <div class="container z-10 mx-auto mt-56 mb-2 md:mt-48">
                        <div id="bot-section" class="flex flex-col justify-center mt-40 md:mt-0 md:flex-no-wrap md:flex-row md:justify-center">
                            <div class="flex flex-col items-center lg:mr-32 ">
                                    <img src="{{asset('img/statistic.png')}}" class="w-32 md:w-24">
                                            <p class="mt-2 text-2xl font-semibold tracking-wide text-white">Statistics</p>
                                            <p class="text-lg font-medium text-center text-gray-500">Watch and read player's in game statistics</p>
                            </div>
                            <div class="flex flex-col items-center mt-4 md:mt-0 lg:mx-32 ">
                                   <img src="{{asset('img/game.png')}}" class="w-32 md:w-24">
                                            <p class="mt-2 text-2xl font-semibold tracking-wide text-white">Scrims</p>
                                            <p class="text-lg font-medium text-center text-gray-500">Find team to practice together</p>
                            </div>
                            <div class="flex flex-col items-center mt-4 md:mt-0 lg:ml-32">
                                <img src="{{asset('img/search.png')}}" class="w-32 md:w-24">
                                            <p class="mt-2 text-2xl font-semibold tracking-wide text-white">Search</p>
                                            <p class="text-lg font-medium text-center text-gray-500">Find player based on your preferrences</p>
                            </div>
                        </div>
                </div>
                <footer class="z-20 w-full mt-auto bg-black">
                        <div class="container flex flex-col items-center justify-center py-3 mx-auto md:flex-row md:justify-between">
                                <p class="text-sm text-gray-200">&copy;2019 DotaHunt. All rights reserved</p>
                                <p class="flex items-center mt-2 text-sm text-gray-200 md:mt-0"><i class="mr-2 material-icons">
                                        email
                                        </i>farhan.abdhadi@gmail.com</p>
                        </div>
            </footer>
            </div>

    </body>
</html>
