<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body>
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
                    <a class="navbar-item" href="/">New thread</a>
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
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="/register" class="button is-primary">
                                <strong>Sign up</strong>
                            </a>
                            @if(auth()->check())
                                <form class="" action="/logout" method="post">
                                    {{ csrf_field() }}
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button">Log out</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <a href="/login" class="button is-light">Log in</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <section class="hero">
            <figure class="image">
                {{-- <img src="/header.jpeg"> --}}
                <img src="https://picsum.photos/1200/200" alt="is not null description">
            </figure>
        </section>
        <section class="section">
            <div class="container">
                {{ $slot }}

                @stack('modals')

                @livewireScripts
            </div>
        </section>
    </body>
</html>
