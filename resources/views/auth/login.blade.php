<x-guest-layout>
    <p class="lead">{{ __('Before creating an event, please Log In or Register.') }}</p>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me" >
                <input id="remember_me" type="checkbox"  name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('register') }}" class="btn btn-primary p-1 mt-4">{{ __('Register') }}</a>
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
    </form>
</x-guest-layout>
