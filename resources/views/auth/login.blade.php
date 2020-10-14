<x-app-layout>
    <section class="section">
        <div class="container">
            @if(session('errors'))
                <p class="subtitle is-4">
                    {{ session('errors')->first() }}
                </p>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </p>
                </div>
                <div class="field is-grouped">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            {{ __('Login') }}
                        </button>
                    </p>
                    <div class="is-pulled-right">
                        <p class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember">
                                {{ __('Remember me') }}
                            </label>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
