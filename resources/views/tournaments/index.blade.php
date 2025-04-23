@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
    <span class="italic text-sm">Home / Tournaments / <a href="tournaments" class="no-underline hover:underline text-blue-500">View</a></span>
    </section>

    <div class="container ml-12 mt-12 pr-4 font-mono">
            @if (session('interest'))
            <div v-show="alert" class="-mt-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" v-on:click="hideAlert" role="alert">
                <strong class="font-bold">Successfully!</strong>
                <span class="block sm:inline">{{ session('interest') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            @elseif(session('notInterest'))
            <div v-show="alert" class="-mt-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-on:click="hideAlert" role="alert">
                    <strong class="font-bold">Successfully!</strong>
                    <span class="block sm:inline">{{ session('notInterest') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif
            <p class="ml-10 text-2xl font-bold text-purple-600 uppercase">UPCOMING TOURNAMENT</p>
            <p class="pb-2 ml-10 text-md font-normal text-gray-600 italic">Find tournament that you wish to parcipate</p>
        <div class="flex flex-wrap flex-row justify-center">
            @foreach ($tournament as $tour)
                <div class="max-w-xs rounded rounded-t-none overflow-hidden shadow-lg mx-2 mb-2 mt-2  bg-dark-100  hover:bg-content border-t-4 border-purple-700">
                    <div class="p-4">
                            <div class="font-bold text-lg text-center text-white uppercase tracking-wide">{{ $tour->name }}</div>

                            <img class="max-h-1/4 object-scale-down w-full rounded-lg mt-4" src="{{  asset('storage/tour/' . $tour->image) }}" alt="">

                    </div>
                    <div class="px-6 py-4 text-center text-gray-300">
                        <p class="text-sm capitalize">TOTAL PRIZE POOL</p>
                        <p class="font-semibold text-2xl mb-2 text-purple-500 uppercase">RM {{ number_format($tour->prizepool) }}</p>
                        <p class="text-base">Organize by<span class="font-medium capitalize"> {{ $tour->organizer }}</span></p>
                        <p class="text-base">From <span class="font-medium capitalize underline">
                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $tour->start_date)->format('d-m-Y') }}</span> until
                            <span class="font-medium capitalize underline">{{ Carbon\Carbon::createFromFormat('Y-m-d', $tour->end_date)->format('d-m-Y') }}</span></p>
                        <p class="text-base"><span class="font-medium capitalize">venue:</span> {{ $tour->venue }}</p>
                        <p class="text-base"><span class="font-medium capitalize">State:</span> {{ $tour->state }}</p>

                    </div>
                        @php
                            $check = false;
                            foreach ($tour->users as $user) {
                                if($user->id == Auth::user()->id)
                                {
                                    $check = true;
                                    break;
                                }
                            }
                        @endphp
                        <div class="text-center -mt-2 pb-6">

                        @if($check)
                            <a href="/tournaments/notInterested/{{ $tour->id }}" class="inline-block bg-transparent rounded px-3 py-1
                                text-md font-semibold text-white mt-3 text-center hover:bg-purple-700 border-2 border-purple-800
                                hover:text-white tracking-wide">Cancel</a>

                        @else
                        <a href="/tournaments/interested/{{ $tour->id }}" class="inline-block  rounded px-3 py-1
                            text-md font-semibold text-white mt-3 text-center btn-indigo tracking-wide border-2 border-purple-800">Interested</a>
                        @endif
                    </div>

                </div>
            @endforeach
            <tournament-component></tournament-component>
        </div>

    </div>
@endsection
