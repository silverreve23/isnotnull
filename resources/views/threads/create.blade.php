<x-app-layout>
    <section class="section">
        <div class="container">
          <h1 class="title">Create new thread</h1>
        </div>
    </section>
    <section class="section">
        @if(auth()->check())
            <form action="{{ route('threads.store') }}" method="post">
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
                                    <div class="select is-fullwidth">
                                      <select name="channel_id">
                                        <option>Select channel</option>
                                        @foreach($channels as $channel)
                                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <input name="title" class="input" placeholder="Add a title..." value="{{ old('title') }}"></input>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <textarea name="body" class="textarea" placeholder="Add a content...">{{ old('body') }}</textarea>
                                </p>
                            </div>
                                @if($errors->first())
                                    <div class="notification is-warning">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
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
        @else
            <p>
                You are not loggined. Please
                </a href="{{ route('login') }}">login</a>
                to create new thread.
            </p>
        @endif
    </section>
</x-app-layout>
