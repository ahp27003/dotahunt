@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
        <span class="italic text-sm">Home / Recomendation / Search</a></span>
    </section>
    <div class="container mx-auto mt-12">
        <div class="flex">
            <div class="mx-auto bg-dark-100 max-w-2xl shadow-xl mt-3 rounded font-sans w-auto rounded-lg">
                <div class="bg-purple-700 rounded-t py-4">
                        <p class="text-2xl font-bold uppercase flex
                        justify-center text-white tracking-wider font-mono">Search Players</p>
                        <p class="text-md font-bold italic flex
                        justify-center text-white tracking-wider font-mono text-purple-300 mt-1">Find Dota 2 player based on your preferences</p>
                </div>
                <div>
                    <form class="w-full px-8 py-4 font-mono" method="POST" action="/players/recommendation" id="achievement">
                        @csrf
                        <div class="flex flex-wrap -mx-3">
                                <div class="w-full px-3 my-2">
                                <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                    Player Role*
                                </label>
                                <div class="w-full ">
                                                <div class="block">
                                                        <div class="mt-2 flex">
                                                        <div>
                                                            <label class="inline-flex items-center cursor-pointer">
                                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="player_role" value="core">
                                                            <span class="ml-2 text-white opacity-75">Core</span>
                                                            </label>
                                                        </div>
                                                        <div class="ml-4">
                                                            <label class="inline-flex items-center cursor-pointer">
                                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="player_role" value="support">
                                                            <span class="ml-2 text-white opacity-75">Support</span>
                                                            </label>
                                                        </div>
                                                        </div>
                                                    </div>
                                            @error('player_role')
                                                <p class="text-red-500 text-xs italic">Please select one of these option</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 ">
                                <div class="w-full px-3 my-2">
                                <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                    Player Position*
                                </label>
                                <div class="w-full ">
                                                <div class="block">
                                                        <div class="mt-2 flex">
                                                        <div>
                                                            <label class="inline-flex items-center cursor-pointer">
                                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="position" value="carry">
                                                            <span class="ml-2 text-white  opacity-75">Carry</span>
                                                            </label>
                                                        </div>
                                                        <div class="mx-4">
                                                            <label class="inline-flex items-center cursor-pointer">
                                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="position" value="mid">
                                                            <span class="ml-2 text-white  opacity-75">Mid</span>
                                                            </label>
                                                        </div>
                                                        <div class="mx-4">
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="position" value="offlaner">
                                                                <span class="ml-2 text-white  opacity-75">Offlaner</span>
                                                                </label>
                                                            </div>
                                                            <div class="mx-4">
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="position" value="roamer">
                                                                    <span class="ml-2 text-white  opacity-75">Roamer</span>
                                                                    </label>
                                                                </div>
                                                                <div class="ml-4">
                                                                        <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="position" value="support">
                                                                        <span class="ml-2 text-white  opacity-75">Support</span>
                                                                        </label>
                                                                    </div>
                                                        </div>
                                                    </div>
                                            @error('position')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                    @if (session('constraint'))
                                    <p class="text-red-500 text-xs italic">Constraint: {{ session('constraint') }}</p>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 ">
                                <div class="w-full px-3 my-2">
                                <label class="block capitalize tracking-wide text-white text-md font-semibold mb-2" for="rank">
                                    Rank*
                                </label>
                                <div class="w-full ">
                                    <div class="relative">
                                                <div class="block">
                                                    <div class="mt-2 flex flex-wrap">
                                                        <div class="w-1/3">
                                                            <div>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer"  name="rank[]" value="uncalibrated">
                                                                <span class="ml-2 text-white opacity-75">Uncalibrated</span> <img src="{{ asset('/img/rank_icons/uncalibrated.png') }}" class="w-6 ml-1">
                                                                </label>
                                                                </div>
                                                                <div>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="herald">
                                                                    <span class="ml-2 text-white opacity-75">Herald</span><img src="{{ asset('/img/rank_icons/herald.png') }}" class="w-6 ml-1">
                                                                </label>
                                                                </div>
                                                                <div>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="guardian">
                                                                    <span class="ml-2 text-white opacity-75">Guardian</span> <img src="{{ asset('/img/rank_icons/guardian.png') }}" class="w-6 ml-1">
                                                                </label>
                                                                </div>

                                                        </div>

                                                        <div class="w-1/3">
                                                            <div>
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="crusader">
                                                                    <span class="ml-2 text-white opacity-75">Crusader</span><img src="{{ asset('/img/rank_icons/crusader.png') }}" class="w-6 ml-1">
                                                                </label>
                                                        </div>
                                                                <div>
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="archon">
                                                                        <span class="ml-2 text-white opacity-75">Archon</span><img src="{{ asset('/img/rank_icons/archon.png') }}" class="w-6 ml-1">
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="legend">
                                                                        <span class="ml-2 text-white opacity-75">Legend</span><img src="{{ asset('/img/rank_icons/legend.png') }}" class="w-6 ml-1">
                                                                    </label>
                                                                </div>

                                                        </div>
                                                        <div class="w-1/3">
                                                                <div>
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="ancient">
                                                                        <span class="ml-2 text-white opacity-75">Ancient</span><img src="{{ asset('/img/rank_icons/ancient.png') }}" class="w-6 ml-1">
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="divine">
                                                                        <span class="ml-2 text-white opacity-75">Divine</span><img src="{{ asset('/img/rank_icons/divine.png') }}" class="w-6 ml-1">
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" class="form-checkbox text-purple-600 cursor-pointer" name="rank[]" value="immortal">
                                                                        <span class="ml-2 text-white opacity-75">Immortal</span><img src="{{ asset('/img/rank_icons/immortal.png') }}" class="w-6 ml-1">
                                                                    </label>
                                                                </div>
                                                        </div>

                                                </div>
                                                </div>
                                            </div>
                                            @error('rank')
                                                <p class="text-red-500 text-xs italic">Please choose at least one of available rank</p>
                                            @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full px-3 my-2">
                                <label class="block capitalize tracking-wide text-white text-md font-semibold mb-2" for="rank">
                                    Skill level*
                                </label>
                                <div class="w-full ">
                                    <div class="relative">
                                    <div class="block">
                                        <div class="mt-2 flex">
                                        <div>
                                            <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="experience" value="1">
                                            <span class="ml-2 text-white opacity-75">Beginner</span>
                                            </label>
                                        </div>
                                        <div class="mx-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="experience" value="2">
                                            <span class="ml-2 text-white opacity-75">Professional</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" class="form-radio text-purple-600 cursor-pointer" name="experience" value="0"  checked>
                                            <span class="ml-2 text-white opacity-75">Both</span>
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @error('experience')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full px-3 my-2">
                                    <label class="block capitalize tracking-wide text-white text-md font-semibold mb-2" for="rank">
                                        Tournament*
                                    </label>
                                    <div class="w-full ">
                                        <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-400 border border-gray-200
                                        py-3 px-4 pr-8 rounded leading-tight  focus:bg-gray-200 focus:border-gray-500
                                        " id="tournament" name="tournament">
                                        <option disabled selected>Select Tournament</option>
                                        @foreach($tours as $tour)
                                        <option value="{{$tour->id}}">{{$tour->name}}</option>
                                    @endforeach
                                    </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2  {{$errors->has('player_role') ? 'border-red-500' : ''}}">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                    @error('tournament')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                        </div>

                                    </div>
                                </div>
                                {{-- advance --}}
                                <div class="flex justify-between border-b border-gray-600 mb-4">
                                    <p class="text-lg font-semibold text-gray-400"> Advances Search (Optional)</p>
                                    <toggle-button @change="onChangeEventHandler" color="#6b46c1" :speed="300"></toggle-button>
                                </div>

                                <transition name="fadedrop">
                                <div v-show="toggleRec" style="display: none;">
                                    <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                            <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                            avg Winrate
                                            </label>
                                            {{-- <input class="appearance-none bg-gray-400 block border border-gray-200 focus:outline-none focus:shadow-outline focus:bg-gray-200 leading-tight mb-0 px-4 py-3 rounded text-black w-full {{$errors->has('winrate') ? 'border-red-500' : ''}} "
                                            id="winrate" type="text" name="winrate" value="{{ old('winrate')}}"> --}}
                                            <knob-control v-model="winrate"
                                            primary-color="#38A169"
                                            secondary-color="#68D391"
                                            :size="75"
                                            text-color="white" class="cursor-pointer"
                                            ></knob-control>
                                            <input type="hidden" name="winrate" v-model="winrate">
                                            @error('winrate')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="w-1/2 px-3 mb-2  flex flex-col items-center">
                                                <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                avg Gold Per Minute
                                                </label>
                                                        {{-- <div class="relative">
                                                        <select class="block appearance-none w-full bg-gray-400 border border-gray-200
                                                        py-3 px-4 pr-8 rounded leading-tight  focus:bg-gray-200 focus:border-gray-500
                                                        " id="gpm" name="gpm">
                                                        <option disabled selected>Select GPM</option>
                                                        <option value="0">Any</option>
                                                        <option value="200">200+</option>
                                                        <option value="400">400+</option>
                                                        <option value="600">600+</option>
                                                        <option value="800">800+</option>
                                                    </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 {{$errors->has('player_role') ? 'border-red-500' : ''}}">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                        </div>
                                                    </div> --}}
                                                    <knob-control v-model="gpm"
                                                    :min="0"
                                                    :max="800"
                                                    :step-size="200"
                                                    primary-color="#d69e2e"
                                                    secondary-color="#F6E05E"
                                                    :size="75"
                                                    :value-display-function="toWord"
                                                    text-color="white" class="cursor-pointer"
                                                    ></knob-control>
                                                    <input type="hidden" name="gpm" v-model="gpm">
                                                    @error('gpm')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                    </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                                    <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                        <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                        avg Xp per minute
                                                        </label>
                                                            <knob-control v-model="xppm"
                                                            :min="0"
                                                            :max="800"
                                                            :step-size="200"
                                                            primary-color="#B7791F"
                                                            secondary-color="#ECC94B"
                                                            :size="75"
                                                            :value-display-function="toWord"
                                                            text-color="white" class="cursor-pointer"
                                                            ></knob-control>
                                                            <input type="hidden" name="xppm" v-model="xppm">
                                                            @error('xppm')
                                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                            @enderror
                                                                </div>
                                                <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                        <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                        avg last hit
                                                        </label>

                                                            <knob-control v-model="lasthit"
                                                            :min="0"
                                                            :max="400"
                                                            :step-size="100"
                                                            primary-color="#319795"
                                                            secondary-color="#4FD1C5"
                                                            :size="75"
                                                            :value-display-function="toWord2"
                                                            text-color="white" class="cursor-pointer"
                                                            ></knob-control>
                                                            <input type="hidden" name="lasthit" v-model="lasthit">
                                                            @error('lasthit')
                                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                            @enderror
                                                                </div>
                                            </div>
                                            <div class="flex flex-wrap -mx-3 mb-2">
                                                <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                    <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                    avg tower damage
                                                    </label>
                                                        <knob-control v-model="tower_dmg"
                                                        :min="0"
                                                        :max="9000"
                                                        :step-size="3000"
                                                        primary-color="#E53E3E"
                                                        secondary-color="#FC8181"
                                                        :size="75"
                                                        :value-display-function="toWord3"
                                                        text-color="white" class="cursor-pointer"
                                                        ></knob-control>
                                                        <input type="hidden" name="tower_dmg" v-model="tower_dmg">
                                                        @error('tower_dmg')
                                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                        @enderror
                                                </div>
                                            <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                    <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                    avg hero damage
                                                    </label>
                                                        <knob-control v-model="hero_dmg"
                                                        :min="0"
                                                        :max="30000"
                                                        :step-size="10000"
                                                        primary-color="#E53E3E"
                                                        secondary-color="#FC8181"
                                                        :size="75"
                                                        :value-display-function="toWord4"
                                                        text-color="white" class="cursor-pointer"
                                                        ></knob-control>
                                                        <input type="hidden" name="hero_dmg" v-model="hero_dmg">
                                                        @error('hero_dmg')
                                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                        @enderror
                                                </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                avg ward
                                                </label>
                                                    <knob-control v-model="ward"
                                                    :min="0"
                                                    :max="20"
                                                    :step-size="5"
                                                    primary-color="#ED8936"
                                                    secondary-color="#FBD38D"
                                                    :size="75"
                                                    :value-display-function="toWord5"
                                                    text-color="white" class="cursor-pointer"
                                                    ></knob-control>
                                                    <input type="hidden" name="ward" v-model="ward">
                                                    @error('ward')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <div class="w-1/2 px-3 mb-2 flex flex-col items-center">
                                                    <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                                    avg deward
                                                    </label>
                                                        <knob-control v-model="deward"
                                                        :min="0"
                                                        :max="20"
                                                        :step-size="5"
                                                        primary-color="#667EEA"
                                                        secondary-color="#A3BFFA"
                                                        :size="75"
                                                        :value-display-function="toWord5"
                                                        text-color="white" class="cursor-pointer"
                                                        ></knob-control>
                                                        <input type="hidden" name="deward" v-model="deward">
                                                        @error('deward')
                                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                        @enderror
                                                </div>
                                        </div>
                                    <div class="flex flex-wrap -mx-3 mb-2">
                                        <div class="w-1/3 px-3 mb-2 flex flex-col items-center">
                                            <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                            avg kill
                                            </label>
                                                <knob-control v-model="kills"
                                                :min="0"
                                                :max="20"
                                                :step-size="5"
                                                primary-color="#E53E3E"
                                                secondary-color="#F56565"
                                                :size="75"
                                                :value-display-function="toWord5"
                                                text-color="white" class="cursor-pointer"
                                                ></knob-control>
                                                <input type="hidden" name="kills" v-model="kills">
                                                @error('kills')
                                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    <div class="w-1/3 px-3 mb-2 flex flex-col items-center">
                                            <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                            avg death
                                            </label>
                                                <knob-control v-model="death"
                                                :min="0"
                                                :max="20"
                                                :step-size="5"
                                                primary-color="#C53030"
                                                secondary-color="#F56565"
                                                :size="75"
                                                :value-display-function="toWord5"
                                                text-color="white" class="cursor-pointer"
                                                ></knob-control>
                                                <input type="hidden" name="death" v-model="death">
                                                @error('death')
                                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    <div class="w-1/3 px-3 mb-2 flex flex-col items-center">
                                        <label class="block uppercase tracking-wide text-white text-md font-semibold mb-2" for="grid-first-name">
                                        avg assist
                                        </label>
                                            <knob-control v-model="assists"
                                            :min="0"
                                            :max="20"
                                            :step-size="5"
                                            primary-color="#D53F8C"
                                            secondary-color="#F687B3"
                                            :size="75"
                                            :value-display-function="toWord5"
                                            text-color="white" class="cursor-pointer"
                                            ></knob-control>
                                            <input type="hidden" name="assists" v-model="assists">
                                            @error('assists')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                </div>
                                </transition>
                                <div class="flex justify-center items-center pb-2">

                                    <div class="mt-2">
                                        <a href="javascript:;" onclick="document.getElementById('achievement').submit()"
                                        class="bg-purple-700 hover:bg-purple-800 text-white font-bold
                                        py-2  px-4 rounded mx-auto ml-2 text-xl tracking-wider">Generate</a>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
