<x-app-layout>
    <section class="section">
        <div class="container">
            @include('threads.thread')
        </div>
    </section>
    <section class="section">
        <div class="container">
            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
        <div class="container">
            {{ $replies->links() }}
        </div>
    </section>
    <section class="section">
        <div class="container">
            @if(auth()->check())
                <form class="p-1" action="{{ route('replies.store', ['channel' => $thread->channel->slug, 'thread' => $thread->id]) }}" method="post">
                    {{ csrf_field() }}
                    <article class="media">
                            <figure class="media-left">
                                <p class="image is-64x64">
                                    <img src="https://picsum.photos/48/48">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="field">
                                    <p class="control">
                                        <textarea name="body" class="textarea" placeholder="Add a text..."></textarea>
                                    </p>
                                </div>
                                <nav class="level">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <button type="submit" class="button is-info">Submit</button>
                                        </div>
                                    </div>
                                    <div class="level-right">
                                        <div class="level-item">
                                            <label class="checkbox">
                                                <input type="checkbox"> Press enter to submit
                                            </label>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                    </article>
                </form>
            @endif
        </div>
    </section>
</x-app-layout>
