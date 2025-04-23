@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2">
    <span class="italic text-sm">Home / <a href="{{url('/players/' . Auth::user()->accounts->dota_id)}}"
        class="no-underline hover:underline text-blue-500">Profile</a> / Edit</span>
</section>
<div class="container ml-24 mt-12">
    <div class="flex">
    {{-- edit card --}}
    <div class="w-5/12 bg-white rounded-lg shadow-xl">
        <p class="text-gray-700 text-xl capitalize border-b-2 border-gray-200 pb-6 px-5 pt-3">edit profile</p>
        <form class="w-full max-w-lg p-4 ml-2 mb-2">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Name
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700  border border-gray-200
                    rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-indigo-700"
                    id="grid-first-name" type="text" placeholder="Jane">
                  </div>
                  <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                      Age
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded
                    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-last-name"
                    type="text" placeholder="Doe">
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                  <div class="w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                      City
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded
                    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-city" type="text" placeholder="Albuquerque">
                  </div>
                  <div class="w-2/3 px-3 mb-6 ">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                      State
                    </label>
                    <div class="relative">
                      <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4
                      pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-state">
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex justify-center items-center">
                <button type="submit" class="btn-indigo font-bold py-2 px-4 rounded">
                        Save
                      </button>
                </div>
              </form>

              <div class="border-t-2 border-gray-200 mx-3">
              <form class="w-full max-w-lg pl-3 pr-5 pt-4 ml-1">
                    <div class="flex flex-wrap -mx-3  mb-2">
                            <div class="w-full px-3 mb-2">
                                <label class="block capitalize tracking-wide text-gray-700 text-md font-semibold mb-2" for="grid-password">
                                current password
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                id="password" type="password" name="password" value="{{ old('password')}}">
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full px-3 mb-2">
                                    <label class="block capitalize tracking-wide text-gray-700 text-md font-semibold mb-2" for="grid-password">
                                    new password
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                    border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                    focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                    id="password" type="password" name="password" value="{{ old('password')}}">
                                    @error('password')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full px-3 mb-2">
                                            <label class="block capitalize tracking-wide text-gray-700 text-md font-semibold mb-2" for="grid-password">
                                            confirm new password
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                            border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                            focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                            id="password" type="password" name="password" value="{{ old('password')}}">
                                            @error('password')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        </div>
                    <div class="flex justify-center items-center">
                    <button type="submit" class="btn-indigo font-bold py-2 px-4 rounded mb-3">
                            Save
                          </button>
                    </div>
                  </form></div>

            </div>

            {{-- user card --}}
            <div class="-mr-24 bg-white ml-32 rounded-lg shadow-xl w-6/12">
                <div class="flex flex-col items-center border-b-2 mx-10 pb-6">
                    <img src="{{  Auth::user()->accounts->avatar_url  }}" alt="" class="-mt-16 relative rounded-full w-48">
                    <p class="text-2xl font-semibold leading-loose text-indigo-900 capitalize">{{Auth::user()->name}}, {{Auth::user()->age}}</p>
                    <p class="text-md font-medium leading-loose text-indigo-900 capitalize -mt-2">{{Auth::user()->area}}, {{Auth::user()->state}}</p>
                </div>
                <div class="flex flex-col items-center mt-4">
                        <p class="text-lg font-semibold  text-indigo-900 capitalize ">Winrate: {{  round((Auth::user()->accounts->win_lose['win'] / (Auth::user()->accounts->win_lose['win'] +
                                Auth::user()->accounts->win_lose['lose'])) * 100, 2)  }} %</p>
                        <p class="text-lg font-semibold  text-indigo-900 capitalize">Total Games: {{  Auth::user()->accounts->win_lose['win'] + Auth::user()->accounts->win_lose['lose']  }}</p>
                        <p class="text-lg font-semibold  text-indigo-900 capitalize">Main Roles: *reserve</p>
                </div>
            </div>

            {{-- <div class="col-md-3">
                @if ( Auth::user()->id != $fetchPlayers->user_id )
                            <h1><u>Interactions</u></h1>
            <a href="/offer/{{ $fetchPlayers->user_id }}" class="btn btn-success"
                            role="button" aria-pressed="true">Offer</a>
                            <a href="#" class="btn btn-primary"
                            role="button" aria-pressed="true">Live Chat</a>

                            <a href="{{  $fetchPlayers->profile_url  }}" class="btn btn-danger"
                                role="button" aria-pressed="true">Add Friend In Steam</a>
                            <a href="{{ url('/players/' . $fetchPlayers->dota_id) }}/stats" class="btn btn-warning"
                                role="button" aria-pressed="true">Player Overview</a>
                            <a href="{{ url('/players/' . $fetchPlayers->dota_id) }}/achievements" class="btn btn-success"
                                role="button" aria-pressed="true">Player Achievements</a>

                            @if (session('offer'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{ session('offer') }}</li>
                                </ul>
                            </div>
                            @endif
                            @if (session('team'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ session('team') }}</li>
                                </ul>
                            </div>
                            @endif
                            @if (session('captain'))
                            <div class="alert alert-warning">
                                <ul>
                                    <li>{{ session('captain') }}</li>
                                </ul>
                            </div>
                            @endif
                        @endif
           </div> --}}

        {{-- <div class="w-1/6">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card" >

                    <img src="{{  $fetchPlayers->avatar_url  }}" class="rounded mx-auto d-block" alt="...">
                      <div class="card-body">
                    <h5 class="card-title text-center"><b>Real Name:</b> {{  $fetchPlayers->user->name }}</h5>
                      <h5 class="card-title text-center"><b>Steam Name:</b> {{  $fetchPlayers->steam_name  }}</h5>
                        @include('users.medal')

                      <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><b>Steam Profile URL:</b>  <a href="{{  $fetchPlayers->profile_url  }}">{{  $fetchPlayers->profile_url  }}</a></li>
                      <li class="list-group-item"><b>MMR ESTIMATE:</b>  {{  $fetchPlayers->mmr  }}</li>
                      <li class="list-group-item"><b>Win:</b> {{  $fetchPlayers->win_lose['win']  }}<br><b> Lose:</b>  {{  $fetchPlayers->win_lose['lose']  }} </li>
                      <li class="list-group-item"><b>Game:</b> Dota</li>
                      <li class="list-group-item"><b>Age:</b> {{ $fetchPlayers->user->age }}</li>
                      <li class="list-group-item"><b>Area:</b> {{ $fetchPlayers->user->area }}</li>
                      <li class="list-group-item"><b>State:</b> {{ $fetchPlayers->user->state }}</li>
                      <li class="list-group-item"><b>Country:</b> {{ $fetchPlayers->country }}</li>
                    </ul>
                    @if ( Auth::user()->id == $fetchPlayers->user_id )
                    <a href="{{url('users/' . $fetchPlayers->user_id  . '/edit')}}" class="btn btn-success"
                        role="button" aria-pressed="true">Edit</a>
                    @endif
                  </div>

            </div>
        </div> --}}
    </div></div>
@endsection
