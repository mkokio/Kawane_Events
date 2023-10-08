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
                        {{ __('Congratulations! You created an event on the ') }} <a href='https://calendar.google.com/calendar/embed?src=7443e660ebfca5091d0e33fc49fd7747b8d0a7bef40e6a34427689721e881291%40group.calendar.google.com&ctz=Asia%2FTokyo' class="custom-link" target="_blank">{{ __('Kawane Events Public Google Calendar') }}</a>.
                    </p>
                    <br />
                    <hr />
                    <br />
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Would you like to ') }} <a href='/dashboard' class="custom-link">{{ __('create another event') }}</a>?
                    </p>

                </header>

                

            </div>
        </div>
    </div>
</x-app-layout>
