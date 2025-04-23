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
    .bg-gradient
    {
        background-image: linear-gradient(-225deg, #AC32E4 0%, #7918F2 48%, #4801FF 100%);
    }

.gradient{
    background: #8E2DE2;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4A00E0, #8E2DE2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}


</style>
</head>
<body class="h-full">
    <div id="app" class="flex flex-col h-auto max-w-full md:flex-row-reverse" >
        <div class="flex items-center justify-center w-full h-screen md:w-2/4 bg-gradient">
            <div class="w-full max-w-md">
                    <form class="px-8 pt-16 pb-12 mb-4 antialiased bg-white rounded shadow-md" method="POST" action="{{ route('login') }}">
                            @csrf
                    <p class="mb-1 font-medium text-center text-gray-500 text-md">Welcome Back!</p>
                    <p class="mb-6 text-2xl font-extrabold text-center text-black ">Login Your Account</p>
                      <div class="py-2 mb-4 border-b-2 border-indigo-500">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                          Email
                        </label>
                        <input name="email" placeholder="Enter your email" class="w-full px-2 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" id="email" type="email" value="{{old('email')}}">

                    </div>
                    @error('email')
                            <p class="-mt-3 text-xs italic text-center text-red-500">{{ $message }}</p>
                        @enderror
                      <div class="py-2 mb-4 border-b-2 border-indigo-500">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                            </label>
                            <input class="w-full px-2 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" id="password" name="password" type="password" placeholder="***************">
                        </div>
                        @error('password')
                        <p class="-mt-3 text-xs italic text-center text-red-500">{{ $message }}</p>
                    @enderror
                      <div class="flex flex-col items-center justify-center">
                            <button class="w-64 px-4 py-2 mt-4 font-bold text-white rounded-full shadow-md btn-indigo" type="submit">
                                    Login
                            </button>
                            <a class="inline-block mt-3 text-sm font-bold text-gray-600 align-baseline hover:text-blue-800" href="/password/reset">
                                Forgot Password?
                              </a>
                            <a class="inline-block mt-3 text-sm font-bold text-black align-baseline hover:text-blue-800" href="register">
                                    Create New Account?
                                  </a>
                      </div>
                    </form>
                    <p class="text-xs text-center text-gray-500">
                      &copy;2019 DotaHunt. All rights reserved.
                    </p>
                  </div>
        </div>
        <div class="w-2/4 h-auto max-w-full bg-center bg-cover" style="background-image: url({{asset('img/champ.jpg')}})">
        </div>
    </div>
</body>
</html>
