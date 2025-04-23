

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <!-- Styles -->
        <style>
            html, body {

                height: 100vh;

            }
            .mySlides {display:none;}
        </style>
    </head>
    <body class="font-mono bg-black">
            {{-- <!-- Full width column -->
            <nav class="fixed z-50 w-full bg-transparent ">
                <div class="container mx-auto ">
                    <img src="https://postbox-inc.com/assets/images/postbox-logo-white.png" alt="">
                </div>
                  </nav>
                  <section class="min-h-full bg-center bg-cover bg-primary" style="background-image:url(https://postbox-inc.com/assets/images/hero/postbox-hero-night.svg);">
                </section> --}}
            <div class="flex flex-col min-h-full bg-fixed bg-center bg-cover bg-primary" style="background-image:url({{asset('img/dota2.jpg')}})">
                <header>
                    <div class="container pt-8 mx-auto ">
                        <div class="flex">

                            <div class="flex items-center w-1/4">
                                <button class="inline-flex items-center px-4 py-2 font-bold text-white bg-purple-800 rounded">
                                    <span class="text-lg tracking-wider">DOTAHUNT</span>
                                </button>
                            </div>

                            <div class="flex justify-center w-1/2">
                                <a href="#" class="py-6 mr-8 text-lg font-semibold text-white">Players</a>
                                <a href="#" class="py-6 mr-8 text-lg font-semibold text-white">Teams</a>
                                <a href="#" class="py-6 text-lg font-semibold text-white">Tournaments</a>
                            </div>

                            <div class="flex flex-row-reverse items-center w-1/4 text-right">
                                <a href="/register" class="inline-block px-3 py-3 font-semibold text-white bg-transparent border-2 border-purple-800 rounded hover:bg-purple-800 hover:text-white hover:border-transparent ">Sign Up</a>
                                <a href="/login" class="inline-block px-3 py-3 mr-1 font-bold text-white bg-purple-700 rounded hover:bg-purple-800">Sign In</a>
                            </div>

                        </div>
                    </div>
                </header>

                <div class="container mx-auto mt-16">

                    <div class="flex ">
                            <div id="section" class="w-3/6 pt-2 mr-2">
                                <p class="max-w-md text-4xl font-bold text-center text-black bg-white ">THE ULTIMATE PLACE TO</p><p class="max-w-md pt-3 pb-2 text-2xl font-bold text-white capitalize border-b-2 border-gray-600"> find players that are interested in local tournament</p>
                                <p class="max-w-md pt-3 pb-2 text-2xl font-bold text-white capitalize border-b-2 border-gray-600"> find teammates and participate in local tournaments</p>
                                <p class="max-w-md pt-3 pb-2 text-2xl font-bold text-white capitalize border-b-2 border-gray-600"> play practice match with another teams</p>
                                <a href="/register" class="inline-block px-3 py-3 mt-3 mr-1 font-bold text-white bg-purple-700 rounded hover:bg-purple-800 ">LETS GET START</a>
                            </div>

                            {{-- <div id="images" class="flex flex-wrap w-3/6 pt-2 pl-3 ml-4">
                                <div class="w3-content w3-section" >
                                        <img class="border-2 border-indigo-600 mySlides" src="{{asset('img/og.jpg')}}" style="width:90%">
                                        <img class="border-2 border-indigo-600 mySlides" src="{{asset('img/liquid.jpg')}}" style="width:90%">
                                        <img class="border-2 border-indigo-600 mySlides" src="{{asset('img/lgd.jpg')}}" style="width:90%">
                                      </div>

                            </div> --}}
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
