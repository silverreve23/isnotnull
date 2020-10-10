<div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://picsum.photos/48/48?r={{ rand(0, 10) }}" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-6">
            <a href="{{ route('profiles.show', ['profile' => $reply->owner->name]) }}">
                <sometag>@</sometag>{{ $reply->owner->name }}
            </a>
        </p>
        <p class="subtitle is-6">
            <small>{{ $reply->created_at->diffForHumans() }}</small>
        </p>
      </div>
      <div class="media-right">
          <form action="{{ route('favorites.store', ['reply' => $reply->id]) }}" method="post">
              {{ csrf_field() }}
              <button class="button is-small" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                  {{ $reply->favorites_count }} {{ Str::plural('favorite', $reply->favorites_count ) }}
              </button>
          </form>
      </div>
    </div>
    <div class="content">
        <p>{{ $reply->body }}</p>
    </div>
  </div>
</div>
