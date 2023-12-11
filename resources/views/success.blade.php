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
        <br />
        <div class="d-flex justify-content-center">
            <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank">
                <img class="mx-auto w-32" src="{{ secure_asset('KWElogoSmall.png') }}" alt="Kawane Events Calendar QR Code">
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <img size="40%" class="mx-auto" src="{{ secure_asset('KawaneEventsCalendarQR.png') }}" alt="Kawane Events Calendar QR Code">
        </div>

        <br />
        <hr />
        <br />
        <p>
            {{ __('Would you like to ') }} <a href='/dashboard' class="custom-link">{{ __('create another event') }}</a>?
        </p>
        <br />
        <hr />
        <br />
        <x-embed-calendar />
        <hr />
        <br />
        <p>
        {{ __('Assistance: ') }}
        <a href="mailto:{{ env('MAIL_USERNAME') }}?subject=Kawane%20Event%20Help">
        {{ env('MAIL_USERNAME') }}
        </a>
        </p>
        <hr />
    </div>
</div>
<!-- Success message and loading animation initially hidden -->
<div class="loading" style="display: none;">
    <img src="{{ secure_asset('logo80.png') }}" alt="Loading..." class="spin-image" />
</div>

<div class="loaded content" style="display: none;">
    <p class="text-sm text-gray-600">{{ __('Event created successfully.') }}</p>
</div>

<!-- CSS -->
<style>
    /* Spinner animation styles */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .spin-image {
        animation: spin 1s infinite linear;
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('event-form');

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                document.querySelector('.loading').style.display = 'block';
                document.querySelector('.loaded').style.display = 'none';

                // Simulate form submission
                setTimeout(function () {
                    // Assuming successful submission after a delay
                    document.querySelector('.loading').style.display = 'none';
                    document.querySelector('.loaded').style.display = 'block';
                    
                    // Redirect to eventcreatesuccess route after successful submission
                    window.location.href = "{{ route('eventcreatesuccess') }}"; // Replace with your actual route
                }, 2000); // Simulated 2-second delay, replace with your logic
            });
        }
    });
</script>

</x-app-layout>
