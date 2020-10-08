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
        <nav class="navbar is-white">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <img src="/logo.svg" alt="IS NOT NULL">
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-start">
                    <div class="navbar-item">
                        <div class="dropdown is-hoverable">
                          <div class="dropdown-trigger">
                            <div aria-haspopup="true" aria-controls="dropdown-menu-browse">
                                  <span>Browse</span>
                                  <span class="icon is-small">
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                  </span>
                            </div>
                          </div>
                          <div class="dropdown-menu" id="dropdown-menu-browse" role="menu">
                            <div class="dropdown-content">
                              <div class="dropdown-item">
                                <a class="link-menu" href="{{ route('threads.index', ['channel' => false]) }}">
                                    All threads
                                </a>
                                @if(auth()->check())
                                    <a class="link-menu" href="{{ route('threads.index', ['channel' => false, 'by' => auth()->user()->name]) }}">
                                        My threads
                                    </a>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="navbar-item">
                        <div class="dropdown is-hoverable">
                          <div class="dropdown-trigger">
                            <div aria-haspopup="true" aria-controls="dropdown-menu">
                                  <span>Channels</span>
                                  <span class="icon is-small">
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                  </span>
                            </div>
                          </div>
                          <div class="dropdown-menu" id="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                              <div class="dropdown-item">
                                  @foreach($channels as $channel)
                                    <a class="link-menu" href="{{ route('threads.index', ['channel' => $channel->slug]) }}">
                                        {{ $channel->name }}
                                    </a>
                                  @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="navbar-item">
                        <div>
                            <a href="{{ route('threads.create') }}">
                                Create Thread
                            </a>
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
                </div>
            </div>
        </nav>
        <section class="hero">
            <figure class="image">
                <img src="/header.jpeg">
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
