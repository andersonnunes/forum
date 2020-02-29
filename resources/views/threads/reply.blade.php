<div class="card" id="reply-{{ $reply->id }}">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form action="/replies/{{ $reply->id }}/favorites" method="post">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-outline-primary" {{ $reply->isFavorited() ? 'disabled': '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
