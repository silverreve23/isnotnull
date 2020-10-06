<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum Threds') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                            <p class="subtitle is-6">@isnotnull</p>
                          </div>
                        </div>

                        <div class="content">{{ $thread->body }}</div>
                      </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
