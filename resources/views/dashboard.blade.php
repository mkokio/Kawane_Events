<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center text-gray-900">
                    <!-- hotlink 'profile' to the update profile page -->
                    {{  __("Before creating an event, make sure you have updated your ")  }} <a href='/profile' class="custom-link">{{ __('profile') }}</a>.
                    <hr />
                </div>

                
                <header>
                    <h2 class="text-lg font-medium text-black">
                        {{ __('Event Details') }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("A Google Calendar Event will be created on Kawane Event shared Calender.") }}
                    </p>
                </header>

                <form method="post" action="{{ route('eventforms.store') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')

                <div>
                    <x-input-label for="event_title" :value="__('Event Title')" />
                    <x-text-input placeholder="川根本町まつり" id="event_title" name="event_title" type="text" class="mt-1 block w-3/4" 
                    required autofocus autocomplete="event_title" />
                    <x-input-error class="mt-2" :messages="$errors->get('event_title')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea
                        id="description"
                        name="description"
                        class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        rows="5"
                        placeholder="楽しもう!"
                        required
                        autofocus
                        autocomplete="description"
                    ></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <!-- make styling of below boxes same as above -->
                <div>
                    <x-input-date name="start_date" for="start_date" label="Start Date" type="date" required></x-input-date>
                    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                </div>

                <div>
                    <x-input-time for="start_time" label="Start Time" required />
                    <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                </div>

                <div>
                    <x-input-date name="end_date" for="end_date" label="End Date" type="date" required></x-input-date>
                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                </div>

                <div>
                    <x-input-time for="end_time" label="End Time" required />
                    <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                </div>

                <div>
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input placeholder="山本さくら" id="location" name="location" type="text" class="mt-1 block w-3/4" 
                    required autofocus autocomplete="location" />
                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                </div>
               
                <x-primary-button>{{ __('Create Event') }}</x-primary-button>

            </form>

            </div>
        </div>
    </div>
</x-app-layout>
