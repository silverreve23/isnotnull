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
        <nav class="navbar is-dark">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <img src="https://cdn0.iconfinder.com/data/icons/simpline-mix/64/simpline_47-512.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/">
                        Home
                    </a>
                    <a class="navbar-item" href="{{ route('threads.index') }}">
                        Threads
                    </a>
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
                <img src="https://www.guntawang.com.au/wp-content/uploads/2012/11/guntawang-tree-1000x200.jpg">
            </figure>
        </section>
        <section class="section">
            <div class="container">
                <h2 class="title">{{ $header }}</h2>

                {{ $slot }}

                @stack('modals')

                @livewireScripts
            </div>
        </section>
    </body>
</html>
