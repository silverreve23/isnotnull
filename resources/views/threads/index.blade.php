<x-app-layout>
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
