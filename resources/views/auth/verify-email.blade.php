<x-guest-layout>
    <div>
        {{ __('Check your email inbox! Click the link we sent you to verify your mail. If you didn\'t get it, we can resend it. Thanks for signing up!') }}
        (Check your email.)
    </div>

    @if (session('status') == 'verification-link-sent')
        <div>
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
        <form method="POST" action="{{ route('verification.send') }}" class="d-inline-block">
            @csrf

                <button type="submit" class="btn btn-outline-primary" class="d-inline-block">
                    {{ __('Resend Verification Email') }}
                </button>
            
        </form>

        <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-outline-secondary" class="d-inline-block">
                    {{ __('Log Out') }}
                </button>
        </form>
    </div>
</x-guest-layout>
