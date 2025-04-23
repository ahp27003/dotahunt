@extends('layouts.app')

@section('content')
    <section id="breadcrumb" class="pt-2 ml-4">
    <span class="text-sm italic font-medium tracking-wide text-white">Home / Top Live Streams</span>
    </section>

    <!--topsection-->
        <div class="container w-full p-4 mx-auto mt-4 font-mono rounded-lg bg-dark-100">
            <div class="flex flex-col">
                    <p class="text-xl font-semibold text-purple-600 uppercase">Top Live Streams</p>
                    <p class="pb-4 ml-1 text-md font-normal text-gray-500 italic">View Dota 2 stream from Twitch directly</p>
                </div>

        <div class="flex flex-col items-center">

            @foreach ($pageStream as $stream)
            <iframe
            src="https://player.twitch.tv/?channel={{$stream['user_name']}}&muted=true&autoplay=false"
            height="480"
            width="720"
            frameborder="0"
            scrolling="no"
            allowfullscreen="true" class="my-4">
            </iframe>
            @endforeach

        </div>
        <div class="mt-4 p-2">
            {{ $pageStream->links() }}
        </div>

        </div>
@endsection
