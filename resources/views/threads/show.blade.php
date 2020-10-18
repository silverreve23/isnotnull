<x-app-layout>
    <thread-view inline-template>
        <div class="thread-view">
            <section class="section">
                <div class="container">
                    @include('threads.thread')
                </div>
            </section>
            <replies></replies>
        </div>
    </thread-view>
</x-app-layout>
