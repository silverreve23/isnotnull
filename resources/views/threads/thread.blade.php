<div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://picsum.photos/48/48?r={{ rand(0, 10) }}" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">
            <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
        </p>
        <p class="subtitle is-6">
            <a href="{{ route('profiles.show', ['profile' => $thread->creator->name]) }}">
                <sometag v-pre>@</sometag>{{ $thread->creator->name }}
            </a>
            <span>|</span>
            <a href="{{ route('threads.index', ['channel' => $thread->channel->slug]) }}">
                {{ $thread->channel->name }}
            </a>
            <small>{{ $thread->created_at->diffForHumans() }}</small>
        </p>
      </div>
      <div class="media-right">
          @can('delete', $thread)
              <form action="{{ $thread->path() }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <button class="button is-small" {{ false ? 'disabled' : '' }}>
                      Delete
                  </button>
              </form>
          @endcan
      </div>
    </div>
    <div class="content">
        <p>{{ $thread->body }}</p>
        <p><a href="#comment-form">{{ Str::plural('Comment', $thread->replies_count) }}</a> {{ $thread->replies_count }}</p>
    </div>
  </div>
</div>
