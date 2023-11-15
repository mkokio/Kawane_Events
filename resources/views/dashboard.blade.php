<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="text-center">
            <!-- hyperlink 'profile' to the update profile page -->
            {{  __('Before creating an event, make sure you have updated your ')  }} <a href='/profile' class="custom-link">{{ __('profile.') }}</a>
            <hr />
        </div>

            <h2>
                {{  __('Event Details') }}
            </h2>
    
            <p>
                {{ __('A Google Calendar Event will be created on Kawane Event shared Calendar.') }}
            </p>

        <form method="post" action="{{ route('eventforms.store') }}">
            @csrf
            @method('post')

            <x-input-label for="event_title" value="{{ __('Event Title') }}" />
            <x-text-input placeholder="川根本町まつり" id="event_title" name="event_title" type="text" 
            required autofocus autocomplete="event_title" />
            <x-input-error class="mt-2" :messages="$errors->get('event_title')" />

            <x-input-label for="description" value="{{ __('Description') }}" />
            <textarea
                id="description"
                name="description"
                class="form-control mt-1"
                rows="5"
                placeholder="楽しもう!"
                required
                autofocus
                autocomplete="description"
            ></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />

            
                
                        <x-input-date name="start_date" for="start_date" label="{{ __('Start Date') }}" type="date" required></x-input-date>
                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />

                        <x-input-time for="start_time" label="{{ __('Start Time') }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('start_time')" />

                        <x-input-date name="end_date" for="end_date" label="{{ __('End Date') }}" type="date" required></x-input-date>
                        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />

                        <x-input-time for="end_time" label="{{ __('End Time') }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
               

            <x-input-label for="location" value="{{ __('Location') }}" />
            <x-text-input placeholder="山本さくら" id="location" name="location" type="text" 
            required autofocus autocomplete="location" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        
        <x-primary-button>{{ __('Create Event') }}</x-primary-button>

    </form>


    </div>
</x-app-layout>
