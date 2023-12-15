<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Event Created') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!--
        <h2 class="text-lg font-medium text-black">
            {{ __('Event Created') }}
        </h2>
        -->

        <p>
            {{ __('Congratulations! You created an event on the ') }} <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank" class="custom-link" target="_blank">{{ __('Kawane Events Public Google Calendar') }}</a>.
        </p>
        <hr>
        <div class="text-center">
            <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank">
                <img width="50%" class="mx-auto" src="{{ secure_asset('KWElogoSmall.png') }}" alt="Kawane Events Calendar QR Code">
            </a>
            <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank">
                <img width="50%" class="mx-auto" src="{{ secure_asset('KawaneEventsCalendarQR.png') }}" alt="Kawane Events Calendar QR Code">
            </a>
        </div>

        <br />
        <hr />
        <p>
            {{ __('Would you like to ') }} <a href='/dashboard' class="custom-link">{{ __('create another event') }}</a>?
        </p>
        <hr />
        <br />
        <x-embed-calendar />
        <hr />
        <!--<br />
        <p>
        {{ __('Assistance: ') }}
        <a href="mailto:{{ env('MAIL_USERNAME') }}?subject=Kawane%20Event%20Help" class="custom-link">
        {{ env('MAIL_USERNAME') }}
        </a>
        </p>
        <hr />-->
    </div>
</div>
</x-app-layout>
