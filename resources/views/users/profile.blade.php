@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="pt-2 ml-4 font-medium tracking-wide text-white">
    <span class="text-sm italic">Home / <a href="{{url('/players/' . $fetchPlayers->dota_id)}}"
        class="text-blue-500 no-underline hover:underline">Profile</a> / {{$fetchPlayers->user->name}}</span>
</section>
{{-- //lg untuk laptop 1278 x XXX
//xl tuk desktop 1440 x 737 --}}
<div class="container mt-12 font-mono">
    @if (session('offer'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-green-700 bg-green-100 border border-green-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('offer') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    @if (session('pass'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-green-700 bg-green-100 border border-green-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('pass') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    @if (session('profile'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-green-700 bg-green-100 border border-green-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('profile') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-green-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    @if (session('team'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-orange-700 bg-orange-100 border border-orange-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Hold up!</strong>
            <span class="block sm:inline">{{ session('team') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 text-orange-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    @if (session('captain'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-red-700 bg-red-100 border border-red-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Ops!</strong>
            <span class="block sm:inline">{{ session('captain') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    @if (session('full'))
    <div class="flex flex-row-reverse mb-4">
        <div v-show="alert" class="relative px-4 py-3 -mt-8 text-red-700 bg-red-100 border border-red-400 rounded w-2/5" v-on:click="hideAlert" role="alert">
            <strong class="font-bold">Ops!</strong>
            <span class="block sm:inline">{{ session('full') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif
    <div class="flex flex-col-reverse items-center justify-center xl:flex-row">
    {{-- edit card --}}
    @if( Auth::user()->id == $fetchPlayers->user_id )
    <div class="w-7/12 p-4 mb-16 rounded-lg shadow-xl xl:w-5/12 bg-dark-100">
        <p class="px-5 pt-3 pb-6 text-xl font-semibold text-white uppercase border-b border-gray-600">edit profile</p>
    <form class="w-full max-w-lg p-4 mb-2 ml-2" method="POST" action="/users/{{$fetchPlayers->user_id }}">
      @csrf
      @method('PATCH')
                <div class="flex flex-wrap mb-6 -mx-3">
                  <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-white uppercase" for="grid-first-name">
                      Name
                    </label>
                    <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 capitalize bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-indigo-700"
                    id="grid-first-name" type="text" placeholder="{{$fetchPlayers->user->name}}" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="w-full px-3 md:w-1/2">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-white uppercase" for="grid-last-name">
                        Birth Day
                    </label>
                    {{-- <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-last-name"
                    type="text" placeholder="{{$fetchPlayers->user->age}}" name="age">
                    @error('age')
                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                    @enderror --}}
                    <div class="relative">
                            <flat-pickr v-model="date" placeholder="{{$fetchPlayers->user->birthdate}}"  :config="{ dateFormat: 'Y-m-d' }"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-500 rounded appearance-none focus:outline-none focus:border-indigo-600"></flat-pickr>
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
                </div>
                <div class="flex flex-wrap mb-2 -mx-3">
                  <div class="w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-white uppercase" for="grid-city">
                      City
                    </label>
                    <input class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-city"
                    type="text" placeholder="{{$fetchPlayers->user->area}}" name="city" value="{{ old('city') }}" required>
                    @error('city')
                    <p class="italic text-red-500 text-md">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="w-2/3 px-3 mb-6 ">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-white uppercase" for="grid-state">
                      State
                    </label>
                    <div class="relative">
                      <select class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-indigo-700" id="grid-state"
                      name="state" required>
                      <option value="" selected disabled hidden>{{$fetchPlayers->user->state}}</option>
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
                <div class="flex items-center justify-center">
                <button type="submit" class="px-4 py-2 font-bold rounded btn-indigo">
                        Save
                      </button>
                </div>
    </form>
              <div class="mx-3 border-t border-gray-600">
              <form class="w-full max-w-lg pt-4 pl-3 pr-5 ml-1" method="POST" action="{{ route('change.password') }}">
                @csrf
                <div class="flex flex-wrap mb-2 -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label class="block mb-2 font-semibold tracking-wide text-white capitalize text-md" for="grid-password">
                                current password
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                id="password" type="password" name="current_password">
                                @error('current_password')
                                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            </div>
                        <div class="flex flex-wrap mb-2 -mx-3">
                                <div class="w-full px-3 mb-2">
                                    <label class="block mb-2 font-semibold tracking-wide text-white capitalize text-md" for="grid-password">
                                    new password
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                    border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                    focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                    id="password1" type="password" name="new_password" >
                                    @error('new_password')
                                        <p class="text-xs italic text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                </div>
                                <div class="flex flex-wrap mb-2 -mx-3">
                                        <div class="w-full px-3 mb-2">
                                            <label class="block mb-2 font-semibold tracking-wide text-white capitalize text-md" for="grid-password">
                                            confirm new password
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700
                                            border border-gray-200 rounded py-3 px-4 mb-0 leading-tight focus:outline-none
                                            focus:bg-white focus:shadow-outline {{$errors->has('password') ? 'border-red-500' : ''}} "
                                            id="password2" type="password" name="new_confirm_password" value="{{ old('password')}}">
                                            @error('new_confirm_password')
                                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        </div>
                    <div class="flex items-center justify-center">
                    <button type="submit" class="px-4 py-2 font-bold rounded btn-indigo">
                            Change Password
                          </button>
                    </div>
                </form></div>

            </div>

            {{-- user card --}}
            <div class="w-7/12 mt-20 mb-40 rounded-lg shadow-xl xl:ml-32 xl:w-5/12 bg-dark-100">
                @if ( Auth::user()->id == $fetchPlayers->user_id )
                <div class="flex justify-center mx-10 ">
                    <img src="{{  $fetchPlayers->avatar_url  }}" class="relative w-48 -mt-24 border-2 rounded-full shadow-lg">
                </div>
                @elseif( Auth::user()->id != $fetchPlayers->user_id )
                <div class="flex justify-between mx-10 ">
                        <a href="{{  $fetchPlayers->profile_url  }}" class="px-4 py-2 mt-6 mb-16 text-sm font-semibold text-white whitespace-no-wrap bg-purple-500 rounded-lg shadow-lg hover:bg-purple-400">Add Friend </a>
                        @if($fetchPlayers->avatar_url == null)
                        <img src="{{asset('img/default.svg')}}" alt="" class="relative w-48 -mt-16 rounded-full shadow-lg">
                        @else
                        <img src="{{  $fetchPlayers->avatar_url  }}" alt="" class="relative w-48 -mt-16 rounded-full shadow-lg">
                        @endif
                        <a href="/offer/{{ $fetchPlayers->user_id }}" class="px-4 py-2 mt-6 mb-16 text-sm font-bold text-white whitespace-no-wrap bg-indigo-500 rounded-lg shadow-lg hover:bg-indigo-400">Invite Team</a>
                    </div>
                @endif
                <div class="flex flex-col items-center pb-6 border-b-2">
                        <p class="text-2xl font-semibold leading-loose text-white capitalize">{{$fetchPlayers->user->name}}, {{$fetchPlayers->user->age}}</p>
                        <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">{{$fetchPlayers->user->area}}, {{$fetchPlayers->user->state}}</p>
                        <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">Birthday: {{$fetchPlayers->user->birthdate}}</p>
                        <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">Current Team:
                            @if($fetchPlayers->user->team()->exists() != false)
                            <a class="text-blue-500 no-underline hover:underline"
                            href="/teams/{{$fetchPlayers->user->team[0]->id}}">
                            {{$fetchPlayers->user->team[0]->name}}</a>
                            @else
                                None
                            @endif
                        </p>

                </div>
                <div class="flex flex-col items-center pb-5 mt-4">
                        <p class="text-lg font-semibold text-white capitalize ">Winrate: {{  round(($fetchPlayers->win_lose['win'] / ($fetchPlayers->win_lose['win'] +
                                $fetchPlayers->win_lose['lose'])) * 100, 2)  }} %</p>
                        <p class="text-lg font-semibold text-center text-white capitalize">Total Games: {{  $fetchPlayers->win_lose['win'] + $fetchPlayers->win_lose['lose']  }} (Win: {{$fetchPlayers->win_lose['win']}}
                        Lose: {{$fetchPlayers->win_lose['lose']}})</p>
                        @if($fetchPlayers->user->knowledge != null)
                        <p class="text-lg font-semibold text-white capitalize">Main Roles: {{$fetchPlayers->user->knowledge->mainRole()}}</p>
                        <a href="#" @click.prevent="$modal.show('spider',{ knowledge: {{$fetchPlayers->user->knowledge}} })"
                            class="text-lg font-semibold text-white text-indigo-500 capitalize hover:underline">View Playstyle</a>
                            <spider-component></spider-component>
                        @endif
                        <div class="mt-4">
                                @include('users.medal')
                        </div>
                        <a  href="{{ url('/players/' . $fetchPlayers->dota_id) }}/stats" class="px-4 py-2 mt-5 text-lg font-bold text-white bg-pink-500 rounded-lg shadow-lg hover:bg-pink-400">
                                View Statistic
                        </a>

                </div>
            </div>
    </div>
  </div>
    @else
    <!-- if visit others profile !-->
    <div class="container w-full mx-auto">

    <div class="px-10 pb-10 mx-64 mb-32 rounded-lg shadow-xl bg-dark-100">
        @if ( Auth::user()->id == $fetchPlayers->user_id )
        <div class="flex justify-center mx-10 ">
            <img src="{{  $fetchPlayers->avatar_url  }}" alt="" class="relative flex-shrink-0 w-48 -mt-24 border-2 rounded-full shadow-lg">
        </div>
        @elseif( Auth::user()->id != $fetchPlayers->user_id )
        <div class="flex items-center justify-between">
            <div class="">
                <a href="{{  $fetchPlayers->profile_url  }}" class="flex-shrink-0 px-4 py-2 text-sm font-semibold text-white whitespace-no-wrap bg-purple-500 rounded-lg shadow-lg hover:bg-purple-400">Add Friend </a>
            </div>
            <div class="">
                @if($fetchPlayers->avatar_url == null)
                <img src="{{asset('img/default.svg')}}" alt="" class="relative flex-shrink-0 w-48 -mt-24 border-2 rounded-full shadow-lg">
                @else
                <img src="{{  $fetchPlayers->avatar_url  }}" alt="" class="relative flex-shrink-0 w-48 -mt-24 border-2 rounded-full shadow-lg">
                @endif
            </div>
            <div class="">
                <a href="/offer/{{ $fetchPlayers->user_id }}" class="flex-shrink-0 px-4 py-2 text-sm font-bold text-white whitespace-no-wrap bg-indigo-500 rounded-lg shadow-lg hover:bg-indigo-400">Invite Team</a>
            </div>
            </div>
        @endif
        <div class="flex flex-col items-center pb-6 border-b-2">
                <p class="text-2xl font-semibold leading-loose text-white capitalize">{{$fetchPlayers->user->name}}, {{$fetchPlayers->user->age}}</p>
                <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">{{$fetchPlayers->user->area}}, {{$fetchPlayers->user->state}}</p>
                <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">Birthday: {{$fetchPlayers->user->birthdate}}</p>
                <p class="-mt-2 font-medium leading-loose text-white capitalize text-md">Current Team:
                        @if($fetchPlayers->user->team()->exists() != false)
                        <a class="text-blue-500 no-underline hover:underline"
                        href="/teams/{{$fetchPlayers->user->team[0]->id}}">
                        {{$fetchPlayers->user->team[0]->name}}</a>
                        @else
                            None
                        @endif
                    </p>
        </div>
        <div class="flex flex-col items-center mt-4">
                <p class="text-lg font-semibold text-white capitalize ">Winrate: {{  round(($fetchPlayers->win_lose['win'] / ($fetchPlayers->win_lose['win'] +
                        $fetchPlayers->win_lose['lose'])) * 100, 2)  }} %</p>
                <p class="text-lg font-semibold text-white capitalize">Total Games: {{  $fetchPlayers->win_lose['win'] + $fetchPlayers->win_lose['lose']  }} (Win: {{$fetchPlayers->win_lose['win']}}
                Lose: {{$fetchPlayers->win_lose['lose']}})</p>
                @if($fetchPlayers->user->knowledge != null)
                <p class="text-lg font-semibold text-white capitalize">Main Roles: {{$fetchPlayers->user->knowledge->mainRole()}}</p>

                <a href="#" @click.prevent="$modal.show('spider',{ knowledge: {{$fetchPlayers->user->knowledge}} })"
                    class="text-lg font-semibold text-white text-indigo-500 capitalize hover:underline">View Playstyle</a>
                    <spider-component></spider-component>
                @endif
                <a href="#" class="text-lg font-semibold text-white text-indigo-500 capitalize hover:underline"
                @click.prevent="$modal.show('achievement' ,{ id: {{$fetchPlayers->dota_id}} })">View Latest Achievements</a>
                <div class="mt-4">
                        @include('users.medal')
                </div>
                <a  href="{{ url('/players/' . $fetchPlayers->dota_id) }}/stats" class="px-4 py-2 mt-10 text-lg font-bold text-white bg-pink-500 rounded-lg shadow-lg hover:bg-pink-400">
                        View Statistic
                </a>
                <a  @click.prevent="$modal.show('hello-world', {user: [    { id: {{$user->id}} },
                { name: '{{$user->name}}' } ]})" href="/messages/create/{{$fetchPlayers->user_id}}"
                class="px-4 py-2 mt-10 text-lg font-bold text-white bg-transparent border-2 border-pink-500 rounded-lg shadow-lg hover:bg-pink-400">
                    Send Message
            </a>
                </div>
            </div>



        <message-component></message-component>
        <achievement-component></achievement-component>
        </div>

        @endif
@endsection


