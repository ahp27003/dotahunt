@extends('layouts.app')

@section('content')
<section id="breadcrumb" class="ml-4 pt-2 text-white font-medium tracking-wide">
        <span class="italic text-sm">Home /  <a href="/messages"
            class="no-underline hover:underline text-blue-500">Inbox</a></span>
    </section>

    <div class="container ml-24 mt-5">
    @include('messenger.partials.flash')
    <p class="text-2xl font-bold text-purple-600 uppercase ml-10">chat</p>
    <div class="flex pb-2">
        <div class="border-t border-gray-600 ml-10 w-10/12" v-if="chat == false">
            <div class="mt-4 bg-dark-100 rounded p-6">
                <div class="mb-2">
                    <p class="font-bold text-xl text-white capitalize">Subject: {{$thread->subject}}</p>
                </div>

                <div class=" overflow-auto max-h-2/4">
                @foreach ($thread->messages as  $message)
            {{-- first --}}

            <div class="flex flex-col">
                    @if(auth()->user()->id != $message->user->id)
                <div class="mt-4 flex py-1 px-2">
                        <div class="flex flex-col items-center">
                            @if($message->user->accounts->avatar_url == null)
                            <img src="{{asset('img/default.png')}}"
                            class="rounded-full w-12" >
                            <p class="text-xs font-medium text-white">{{ $message->user->name }}</p>
                            @else
                            <img src="{{ $message->user->accounts->avatar_url}}" class="rounded-full w-12">
                            <p class="text-xs font-medium text-white">{{ $message->user->name }}</p>
                            @endif
                    </div>
                    <div class="rounded-lg bg-pink-500 text-white ml-4 p-2 shadow-md mb-1">
                        <p class="max-w-xl font-medium mb-2 pl-1">{{ $message->body }}</p>
                        <p class="text-xs text-gray-300 text-right pl-1">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @elseif(auth()->user()->id == $message->user->id)
                <div class="flex flex-row-reverse mt-4 py-1 px-2">
                        <div class="flex flex-col items-center">
                                @if($message->user->accounts->avatar_url == null)
                                <img src="{{asset('img/default.png')}}"
                                class="rounded-full w-12" >
                                <p class="text-xs font-medium text-white">{{ $message->user->name }}</p>
                                @else
                                <img src="{{ $message->user->accounts->avatar_url}}" class="rounded-full w-12">
                                <p class="text-xs font-medium text-white">{{ $message->user->name }}</p>
                                @endif

                        </div>
                        <div class="rounded-lg bg-indigo-700 mr-4 p-2 shadow-md mb-2">
                            <p class="max-w-xl font-medium text-white mb-1 pl-1">{{ $message->body }}</p>
                            <p class="text-xs text-gray-300 text-right pl-1">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endif
                {{-- second --}}
            </div>

            @endforeach</div>
            {{-- send message --}}

                    <form action="{{ route('messages.update', $thread->id) }}" method="post" class="bg-content
                        flex items-start bg-white rounded-lg px-3 pt-3  mt-6 hover:shadow-lg">
                            {{ method_field('put') }}
                            {{ csrf_field() }}
                    <textarea class="
                    outline-none resize-none w-full  focus:border-indigo-600 bg-content text-white pt-2"
                    name="message" class="form-control"
                    placeholder="Type a message....">{{ old('message') }}</textarea>
                    <input type="text" name="recipients"
                    value="{{ $sendTo->id }}" hidden>
                    <button type="submit" class="bg-indigo-600 border-indigo-700 font-bold hover:bg-indigo-700 pb-1 pt-2 px-2 rounded-full text-white">
                            <i class="material-icons text-white text-center">
                                    send
                                    </i>
                    </button></form>
            </div>
        </div>

    </div>
    </div>


@endsection
