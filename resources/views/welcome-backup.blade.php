<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <!-- Styles -->
        <style>
            html, body {

                height: 100vh;

            }
            .mySlides {display:none;}
        </style>
    </head>
    <body class="bg-black font-sans">
            {{-- <!-- Full width column -->
            <nav class="fixed  z-50 bg-transparent w-full ">
                <div class="container mx-auto ">
                    <img src="https://postbox-inc.com/assets/images/postbox-logo-white.png" alt="">
                </div>
                  </nav>
                  <section class="bg-primary bg-cover bg-center min-h-full" style="background-image:url(https://postbox-inc.com/assets/images/hero/postbox-hero-night.svg);">
                </section> --}}
            <div class="flex flex-col bg-primary bg-fixed bg-cover bg-center min-h-full" style="background-image:url({{asset('img/dota2.jpg')}})">
                <header>
                    <div class="container mx-auto pt-8 ">
                        <div class="flex">

                            <div class="w-1/4 flex items-center">
                                <button class="bg-red-500  text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <span class="text-lg">DOTA HUB</span>
                                </button>
                            </div>

                            <div class="w-1/2 flex justify-center">
                                <a href="#" class="text-lg font-semibold mr-8 py-6 text-white">Players</a>
                                <a href="#" class="text-lg font-semibold mr-8 py-6 text-white">Teams</a>
                                <a href="#" class="text-lg font-semibold py-6 text-white">Tournaments</a>
                            </div>

                            <div class="w-1/4 flex items-center  flex-row-reverse text-right">
                                <a href="/register" class="bg-transparent hover:bg-red-500 text-white font-semibold hover:text-white py-3 px-3 border border-red-500 hover:border-transparent rounded inline-block ">Sign Up</a>
                                <a href="/login" class="bg-red-500 hover:bg-red-700 font-bold text-white inline-block mr-1  py-3 px-3 rounded">Login</a>
                            </div>

                        </div>
                    </div>
                </header>

                <div class="container mx-auto mt-16">

                    <div class="flex ">
                            <div id="section" class="w-3/6 mr-2 pt-2">
                                <p class="text-4xl font-sans font-bold text-black text-center bg-white max-w-md ">THE ULTIMATE PLACE TO</p><p class="pt-3 text-2xl font-sans font-bold text-white   max-w-md capitalize border-b-2 border-gray-600 pb-2"> find players that are interested in local tournament</p>
                                <p class="pt-3 text-2xl font-sans font-bold text-white   max-w-md capitalize border-b-2 border-gray-600 pb-2"> find teammates and participate in local tournaments</p>
                                <p class="pt-3 text-2xl font-sans font-bold text-white   max-w-md capitalize border-b-2 border-gray-600 pb-2"> play practice match with another teams</p>
                                <a href="/register" class="bg-red-600 hover:bg-red-700 font-bold text-white inline-block mr-1 mt-3  py-3 px-3 rounded ">LETS GET START</a>
                            </div>

                            <div id="images" class="flex flex-wrap w-3/6 pl-3 ml-4 pt-2">
                                <div class="w3-content w3-section" >
                                        <img class="mySlides border-2 border-indigo-600" src="{{asset('img/og.jpg')}}" style="width:90%">
                                        <img class="mySlides border-2 border-indigo-600" src="{{asset('img/liquid.jpg')}}" style="width:90%">
                                        <img class="mySlides border-2 border-indigo-600" src="{{asset('img/lgd.jpg')}}" style="width:90%">
                                      </div>
                                {{-- <img src="{{asset('img/og1.jpg')}}" class="w-2/5 shadow-2xl">
                                <img src="{{asset('img/liquid.jpg')}}" class="w-2/5 shadow-2xl">
                                <img src="{{asset('img/lgd.jpg')}}" class="w-2/5 shadow-2xl"> --}}
                            </div>
                    </div>
                </div>
            </div>
            <script>
                    var myIndex = 0;
                    carousel();

                    function carousel() {
                      var i;
                      var x = document.getElementsByClassName("mySlides");
                      for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                      }
                      myIndex++;
                      if (myIndex > x.length) {myIndex = 1}
                      x[myIndex-1].style.display = "block";
                      setTimeout(carousel, 2000); // Change image every 2 seconds
                    }
                    </script>
    </body>
</html>
