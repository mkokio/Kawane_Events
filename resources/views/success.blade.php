<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Created') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                
                <header>
                    <h2 class="text-lg font-medium text-black">
                        {{ __('Event Created') }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Congratulations! You created an event on the ') }} <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank" class="custom-link" target="_blank">{{ __('Kawane Events Public Google Calendar') }}</a>.
                    </p>
                    <br />
                    <div class="flex justify-center">
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
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Assistance: ') }}
                        <a href="mailto:{{ env('MAIL_USERNAME') }}?subject=Kawane%20Event%20Help">
                            {{ env('MAIL_USERNAME') }}
                        </a>
                    </p>
                    


                </header>

                

            </div>
        </div>
    </div>
</x-app-layout>
