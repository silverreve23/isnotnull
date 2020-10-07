<x-app-layout>
    <section class="section">
        @foreach($threads as $thread)
            <div class="card">
              <div class="card-content">
                <div class="media">
                  <div class="media-left">
                    <figure class="image is-48x48">
                      <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                    </figure>
                  </div>
                  <div class="media-content">
                    <p class="title is-4">
                        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                    </p>
                    <p class="subtitle is-6"><sometag>@</sometag>{{ $thread->creator->name }}</p>
                  </div>
                </div>

                <div class="content">{{ $thread->body }}</div>
              </div>
            </div>
        @endforeach
    </section>
</x-app-layout>
