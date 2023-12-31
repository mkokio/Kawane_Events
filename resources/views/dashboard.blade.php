<x-app-layout>
    <section class="relative">

        <x-slot name="header">
            <h2>{{ __('Create Event') }}</h2>
        </x-slot>

        <div class="py-6">
            <div class="text-center">
                <em>{{  __('Before creating an event, make sure you have updated your ')  }} <a href='/profile' class="custom-link">{{ __('profile.') }}</a></em>
                <hr />
            </div>

                <h3>{{  __('Event Details') }}</h3>
                <p class="lead">{{ __('A Google Calendar Event will be created on Kawane Event shared Calendar.') }}</p>

            <form id="event-form" method="post" action="{{ route('eventforms.store') }}">
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
                    class="form-control"
                    rows="5"
                    placeholder="楽しもう!"
                    required
                    autofocus
                    autocomplete="description"
                ></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />          
                    
                <x-input-date name="start_date" for="start_date" label="{{ __('Start Date') }}" required></x-input-date>
                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />

                <x-input-time for="start_time" label="{{ __('Start Time') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />

                <x-input-date name="end_date" for="end_date" label="{{ __('End Date') }}" required></x-input-date>
                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />

                <x-input-time for="end_time" label="{{ __('End Time') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />

                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input placeholder="小川公園" id="location" name="location" type="text" required autofocus autocomplete="location" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            
                <!-- NOTE: neither link-url nor link-text get recorded to the DATABASE -->
                <x-input-label for="event_url" value="{{ __('URL for Event (Optional)') }}" />
                <div class="input-group">
                    <x-text-input class="col-sm-4" placeholder="リンクテキスト" id="link-text" name="link-text" type="text"/>
                    <x-text-input class="col-sm-8" placeholder="https://www.myevent.jp/poster.jpg (URL)" id="link-url" name="link-url" type="text"/>
                    <!-- Paste Function not working, yet!
                    <div class="input-group-append">
                        <button type="button" id="pasteButton" class="btn btn-outline-secondary">{{ __('Paste') }}</button>
                    </div>
                    -->
                </div>

                <x-primary-button id="saveButton" data-bs-toggle="modal" data-bs-target="#confirmationModal">{{ __('Submit') }}</x-primary-button>

            </form>

            <div id="confirmationModal" class="modal fade" data-bs-backdrop="static" ata-bs-keyboard="false" tabindex="-1"  aria-labelledby="staticBackdropLabel"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Create Event with these Details?') }}</h5>
                        </div>
                        <div class="modal-body">
                            <strong>{{ __('Event Title') }}:</strong> <span id="event_title_placeholder"></span><br>
                            <strong>{{ __('Description') }}:</strong> <span id="description_placeholder"></span><br>
                            <strong>{{ __('Location') }}:</strong> <span id="location_placeholder"></span><br>
                            <strong>{{  __('Start') }}:</strong> <span id="start_date_placeholder"></span> ・ <span id="start_time_placeholder"></span><br>
                            <strong>{{  __('End') }}:</strong> <span id="end_date_placeholder"></span> ・ <span id="end_time_placeholder"></span><br>
                            <strong>{{ __('Link') }}:</strong> <a id="link_placeholder" href="#" target="_blank"></a>
                        </div>
                        <div class="modal-footer">
                            <button id="confirmSubmit" class="btn btn-primary">{{ __('Create Event') }}</button>
                            <button id="cancelSubmit" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loading" class="loading">
                <img src="{{ secure_asset('logo80.png') }}" alt="Creating Event..." class="breathing-image" />
            </div>

        </div>
    </section>
    
    <style>
    .confirmationModal {
    display: none;
}

    /* Breathing animation */
    @keyframes breathe {
        0%, 100% { transform: scale(0.4); }
        50% { transform: scale(1); }
    }

    /* Apply the animation to the image */
    .breathing-image {
        animation: breathe 1s infinite ease-in-out;
    }

    /* Center the spinner within the content area */
    .py-6 {
        position: relative;
    }

    .loading {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none; /* Hide the spinner initially */
    }
        /* Media query for smaller screens */
        @media (max-width: 768px) {
        .py-6 {
                min-height: auto; /* Reset min-height for smaller screens */
            }
    }
    </style>

    <script>
    /* Paste function for URL not working, yet   
    document.getElementById('pasteButton').addEventListener('click', function() {
        navigator.clipboard.readText().then(clipText => {
            document.getElementById('link-url').value = clipText;
        }).catch(err => {
            console.error('Failed to read clipboard contents: ', err);
        });
    });
    */

    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('event-form');
    const loading = document.getElementById('loading');
    const confirmationModal = document.getElementById('confirmationModal');
    const confirmSubmit = document.getElementById('confirmSubmit');
    const cancelSubmit = document.getElementById('cancelSubmit');
    const eventTitlePlaceholder = document.getElementById('event_title_placeholder');
    const eventDescriptionPlaceholder = document.getElementById('description_placeholder');
    const eventLocationPlaceholder = document.getElementById('location_placeholder');
    const eventStartDatePlaceholder = document.getElementById('start_date_placeholder');
    const eventStartTimePlaceholder = document.getElementById('start_time_placeholder');
    const eventEndDatePlaceholder = document.getElementById('end_date_placeholder');
    const eventEndTimePlaceholder = document.getElementById('end_time_placeholder');
    const linkTextElement = document.getElementById('link-text');
    const linkUrlElement = document.getElementById('link-url');
    const linkPlaceholder = document.getElementById('link_placeholder');

    if (saveButton && confirmationModal && confirmSubmit && cancelSubmit && eventTitlePlaceholder && eventDescriptionPlaceholder && eventLocationPlaceholder && loading) {
        saveButton.addEventListener('click', function (event) {
            event.preventDefault();
            eventTitlePlaceholder.textContent = document.getElementById('event_title').value;
            eventDescriptionPlaceholder.textContent = document.getElementById('description').value;
            eventLocationPlaceholder.textContent = document.getElementById('location').value;
            eventStartDatePlaceholder.textContent = document.getElementById('start_date').value;
            eventStartTimePlaceholder.textContent = document.getElementById('start_time').value;
            eventEndDatePlaceholder.textContent = document.getElementById('end_date').value;
            eventEndTimePlaceholder.textContent = document.getElementById('end_time').value;
            confirmationModal.style.display = 'block';

            const linkText = linkTextElement.value;
            const linkUrl = linkUrlElement.value;

            linkPlaceholder.textContent = linkText;
            linkPlaceholder.href = linkUrl;
        });

        confirmSubmit.addEventListener('click', function() {
            const linkText = linkTextElement.value;
            const linkUrl = linkUrlElement.value;

            linkPlaceholder.textContent = linkText;
            linkPlaceholder.href = linkUrl;

            loading.style.display = 'block';
            confirmationModal.style.display = 'none';

            setTimeout(function () {
                form.submit();
            }, 500);
        });

        cancelSubmit.addEventListener('click', function() {
            confirmationModal.style.display = 'none';
        });
    } else {
        console.error('Some elements are missing.');
    }
});

    </script>
</x-app-layout>
