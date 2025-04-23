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

</head>
<body class="h-screen">
    <div id="app" class="flex flex-col h-auto max-w-full md:flex-row" >
        <div class="flex flex-col items-start justify-start w-full h-screen md:w-8/12 xl:w-2/4 ">
            <div class="w-full">
                    <form class="px-20 pt-8 mb-4 antialiased bg-white rounded lg:px-32" method="POST" action="{{ route('register') }}">
                            @csrf
                    <p class="mb-2 text-4xl font-extrabold text-left text-black ">Let's hunt some players!</p>
                    <p class="mb-3 text-lg font-medium text-left text-indigo-700 ">Sign up now to start creating your Dream Team!</p>
                    <p class="mb-10 text-left text-black font-base text-md">Already have an account?
                        <a href="/login" class="font-medium text-indigo-700 cursor-pointer hover:text-indigo-800">
                            Log in.</a></p>
                            <div class="flex flex-wrap mb-3 -mx-3">
                                <div class="w-full px-3 md:w-1/2">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-last-name">
                                        Full Name*
                                    </label>
                                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"
                                    type="text" placeholder="Enter your full name" name="name" required value="{{old('name')}}">
                                    @error('name')
                                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full px-3 md:w-1/2">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-last-name">
                                        Birth Day*
                                    </label>
                                    {{-- <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600" id="grid-last-name"
                                    type="date" placeholder="Enter your age" name="age" required> --}}
                                    <div class="relative">
                                        <flat-pickr v-model="date" placeholder="Select your birth day"  :config="{ dateFormat: 'Y-m-d' }" class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"></flat-pickr>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                            <i class="material-icons">
                                                date_range
                                                </i>
                                        </div>
                                      </div>


                                    <input type="hidden" name="birthdate" v-model="date">
                                    @error('birthdate')
                                        <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mt-5">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-last-name">
                                        E-mail*
                                    </label>
                                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600" id="grid-last-name"
                                    type="email" placeholder="Enter your valid email address" name="email" required value="{{old('email')}}">
                                    @error('email')
                                        <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- <div class="w-full px-3 mt-5 md:w-1/2">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-last-name">
                                        Phone
                                    </label>
                                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"
                                    type="text" placeholder="Enter your phone number" required>
                                </div> --}}
                            </div>
                            <div class="flex flex-wrap mb-3 -mx-3">
                                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-state">
                                        City*
                                    </label>
                                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"
                                    type="text" placeholder="Enter your city" name="area" required value="{{old('area')}}">
                                    @error('area')
                                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md" for="grid-state">
                                        State*
                                    </label>
                                    <div class="relative">
                                        <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600 " name="state" required>
                                        <option selected disabled>Select state</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Penang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                    @error('state')
                                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap mb-6 -mx-3">
                                <div class="w-full px-3 md:w-1/2">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md">
                                    Password*
                                    </label>
                                    <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"
                                    type="password" id="password" placeholder="*****" name="password" required>
                                    @error('password')
                                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full px-3 md:w-1/2">
                                    <label class="block mb-2 font-semibold tracking-wide text-gray-700 capitalize text-md">
                                        Confirm Password*
                                    </label>
                                    <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600" type="password"
                                    placeholder="*****" name="password_confirmation" required id="password-confirm" required>

                                </div>
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <button class="w-64 px-4 py-2 mt-4 font-bold text-white rounded-full shadow-md btn-indigo" type="submit">
                                            Sign Up
                                    </button>
                                    <a href="/" class="w-64 px-4 py-2 mt-2 font-bold text-center text-white bg-red-700 rounded-full shadow-md hover:bg-red-800">Back</a>
                                </div>
                    </form>
                    <p class="text-xs text-center text-indigo-700">
                      &copy;2019 DotaHunt. All rights reserved.
                    </p>
                  </div>
        </div>
        <div class="h-auto max-w-full bg-center bg-cover md:w-4/12 xl:w-2/4" style="background-image: url({{asset('img/3.jpg')}})">
        </div>
    </div>
</body>
</html>





{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="area" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="area" autofocus>

                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">Region</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
