@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2">
    <span class="italic text-sm text-white">Home</span>
</section>

<p class="text-2xl font-bold text-pink-500 mb-4 ml-4">QUICK ACCESS</p>

    <div class="flex flex-wrap">

        <div class="w-full lg:w-6/12 xl:w-4/12 px-4 mb-6">
            <a href="/players/recommendation">
            <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-orange-600" style="background-color:#FDA006;">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-2 max-w-full flex-grow flex-1">
                            <h5 class="text-white uppercase font-bold text-xl">SEARCH</h5>
                            <span class="font-semibold text-md text-orange-200">Find player based on your preferences</span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                                <i class="material-icons">
                                    location_searching
                                    </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-6">
                <a href="/players/list">
                <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-green-600"  style="background-color:#00C689;">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-white uppercase font-bold text-xl tracking-wide">Registered Players</h5>
                            <span class="font-semibold text-md text-green-200">{{ $count }} players</span>
                            </div>
                            <div class="relative w-auto pl-4 flex-initial">
                                <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                                    <i class="material-icons">
                                        how_to_reg
                                        </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>



        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-6">
            <a href="/teams/list">
            <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-blue-600" style="background-color:#3DA5F4;">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-white uppercase font-bold text-xl">Registered team</h5>
                            <span class="font-semibold text-md text-blue-200">{{$teams}} teams</span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                                <i class="material-icons">
                                    people_alt
                                    </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-6 z-0">
            <a href="/messages">
            <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-red-600" style="background-color:#F1536E;">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-white uppercase font-bold text-xl">INBOX</h5>
                            <span class="font-semibold text-md text-red-200">Open inbox</span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                                <i class="material-icons">
                                    chat
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-6">
        <a href="/tournaments">
        <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-pink-700 bg-pink-500">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-2 max-w-full flex-grow flex-1">
                        <h5 class="text-white uppercase font-bold text-xl">Tournament</h5>
                        <span class="font-semibold text-md text-pink-200">View available tournament</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                            <i class="material-icons">
                                emoji_events
                                </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="w-full lg:w-6/12 xl:w-4/12 px-4 mb-6">
        <a href="/players/{{Auth::user()->accounts->dota_id}}/stats">
        <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-teal-700 bg-teal-500">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-white uppercase font-bold text-xl tracking-wide">Overview</h5>
                    <span class="font-semibold text-md text-teal-200">View your overview</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                            <i class="material-icons">
                                assignment
                                </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </div>

    @if(Auth()->user()->team->first() != null)
    <div class="w-full lg:w-6/12 xl:w-4/12 px-4 mb-6">
        <a href="/scrims-schedule">
        <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg hover:bg-indigo-700 bg-indigo-500">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                        <h5 class="text-white uppercase font-bold text-xl tracking-wide">Scrims status</h5>
                    <span class="font-semibold text-md text-indigo-200">View Scrims schedule and status</span>
                    </div>
                    <div class="relative w-auto pl-4 flex-initial">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-purple-900">
                            <i class="material-icons">
                                done_all
                                </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </div>
    @endif
    </div>
@endsection
