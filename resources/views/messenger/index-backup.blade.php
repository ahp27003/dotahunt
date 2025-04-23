@extends('layouts.master')

@section('content')
    @include('messenger.partials.flash')

    {{-- @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads') --}}

    @foreach ($threads as $thread)

        @foreach ($thread->users as $user)
            @if($user->id == auth()->user()->id)
            <?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

            <div class="media alert {{ $class }}">
                <h4 class="media-heading">
                    <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
                    ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</h4>
                <p>
                    {{ $thread->latestMessage->body }}
                </p>
                <p>
                    <small><strong>Creator:</strong> {{ $thread->creator()->name }}</small>
                </p>
                <p>
                    <small><strong>Participants:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
                </p>
            </div>
            @endif
        @endforeach

    @endforeach



    @stop
