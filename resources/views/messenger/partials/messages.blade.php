

<div class="media">
        <a class="pull-left" href="#">
            <img src="{{$message->user->accounts->avatar_url}}"
                 alt="{{ $message->user->accounts->steam_name }}" class="img-circle">
        </a>
        <div class="media-body">
            <h5 class="media-heading">{{ $message->user->accounts->steam_name }}</h5>
            <p>{{ $message->body }}</p>
            <div class="text-muted">
                <small>Posted {{ $message->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
