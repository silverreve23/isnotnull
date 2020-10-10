<x-app-layout>
    <section class="section">
        <div class="container">
            <p class="title">{{ $profile->name }}</p>
            <p class="subtitle">since {{ $profile->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <section class="section">
        @foreach($threads as $thread)
            @include('threads.thread')
        @endforeach
    </section>
    <section class="section">
        <div class="container">
            {{ $threads->links() }}
        </div>
    </section>
</x-app-layout>
