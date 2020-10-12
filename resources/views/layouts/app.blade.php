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
        <link rel="stylesheet" href="/css/common.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            @include('layouts.navbar')
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

                    <flash message='{{ session('flash', null) }}'></flash>
                </div>
            </section>
        </div>
        @livewireScripts
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                if($navbarBurgers.length > 0){
                    $navbarBurgers.forEach(el => {
                        el.addEventListener('click', () => {
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);

                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');
                        });
                    });
                }
            });
        </script>
    </body>
</html>
