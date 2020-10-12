<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <img src="/logo.svg" alt="IS NOT NULL">
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link is-arrowless">Browse</a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('threads.index', ['channel' => false]) }}">
                        All threads
                    </a>
                    @if(auth()->check())
                        <a class="navbar-item" href="{{ route('threads.index', ['channel' => false, 'by' => auth()->user()->name]) }}">
                            My threads
                        </a>
                    @endif
                    <a class="navbar-item" href="{{ route('threads.index', ['channel' => false, 'popular' => true]) }}">
                        Popular threads
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">Report an issue</a>
                </div>
            </div>
            <a class="navbar-item" href="{{ route('threads.create') }}">New thread</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link is-arrowless">Channels</a>
                <div class="navbar-dropdown">
                    @foreach($channels as $channel)
                      <a class="navbar-item" href="{{ route('threads.index', ['channel' => $channel->slug]) }}">
                          {{ $channel->name }}
                      </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Search . . .">
                    </div>
                </div>
            </div>
                @if(auth()->check())
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link is-arrowless">{{ auth()->user()->name }}</a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('profiles.show', auth()->user()->name) }}">My profile</a>
                            <a class="navbar-item" href="{{ route('threads.index', ['channel' => $channel->slug]) }}">
                                <form class="" action="/logout" method="post">
                                    {{ csrf_field() }}
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit">Log out</button>
                                        </div>
                                    </div>
                                </form>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="/register" class="button is-primary">
                                <strong>Sign up</strong>
                            </a>
                            <a href="/login" class="button is-light">Log in</a>
                        </div>
                    </div>
                @endif
        </div>
    </div>
</nav>
