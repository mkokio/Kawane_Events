<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Event Created') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h2 class="text-lg font-medium text-black">
            {{ __('Event Created') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Congratulations! You created an event on the ') }} <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank" class="custom-link" target="_blank">{{ __('Kawane Events Public Google Calendar') }}</a>.
        </p>
        <br />
        <div class="d-flex justify-content-center">
            <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank">
                <img class="border rounded mx-auto w-32" src="{{ asset('KWElogoSmall.png') }}" alt="Kawane Events Calendar QR Code">
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <img class="border rounded mx-auto" src="{{ asset('KawaneEventsCalendarQR.png') }}" alt="Kawane Events Calendar QR Code">
        </div>

        <br />
        <hr />
        <br />
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Would you like to ') }} <a href='/dashboard' class="custom-link">{{ __('create another event') }}</a>?
        </p>
        <br />
        <hr />
        <br />
        <div class="d-flex justify-content-center">
        <iframe src="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" style="border-width:0" width="600" height="600" frameborder="0" scrolling="no"></iframe>
        </div> 

        <hr />
        <br />
        <p class="mt-1 text-sm text-gray-600">
        {{ __('Assistance: ') }}
        <a href="mailto:{{ env('MAIL_USERNAME') }}?subject=Kawane%20Event%20Help">
        {{ env('MAIL_USERNAME') }}
        </a>
        </p>
        <hr />
    </div>

</x-app-layout>
