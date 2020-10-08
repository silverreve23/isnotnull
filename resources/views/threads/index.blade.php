<x-app-layout>
    <section class="section">
        @foreach($threads as $thread)
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
                        <sometag>@</sometag>{{ $thread->creator->name }}
                        <span>|</span>
                        <a href="{{ route('threads.index', ['channel' => $thread->channel->slug]) }}">
                            {{ $thread->channel->name }}
                        </a>
                        <small>{{ $thread->created_at->diffForHumans() }}</small>
                    </p>
                  </div>
                </div>

                <div class="content">{{ $thread->body }}</div>
              </div>
            </div>
        @endforeach
    </section>
</x-app-layout>
