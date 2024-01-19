<x-app-layout>
    <section class="relative">

        <x-slot name="header">
            <h2>{{ __('My Events') }}</h2>
        </x-slot>

        <div class="py-6">
            <div class="text-center">
                <em>{{  __('Would you like to make a ')  }} <a href='/dashboard' class="custom-link">{{ __('new event?') }}</a></em>
                <hr />
            </div>

                <h3>{{  __('My Events') }}</h3>
                <p class="lead">{{ __('Here is a list of events which you have created.') }}</p>
            
                <div class="accordion" id="accordionOfEvents">
                    @foreach ($events as $index => $event)
                    @if ($event->google_calendar_id)<!--Display all of your events which have a google_calendar_id -->
                        @php
                            // Check if the event exists on Google Calendar
                            $eventOnCalendar = \Spatie\GoogleCalendar\Event::find($event->google_calendar_id);
                        @endphp
                
                        @if ($eventOnCalendar && $eventOnCalendar->status !== 'cancelled')
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                            {{ $event->start_date ?? 'N/A' }} - {{ $event->event_title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordionOfEvents">
                                        <div class="accordion-body">
                                            {{ $event->description ?? 'N/A' }}
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $event->id }}">{{ __('Delete') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="modal fade" id="staticBackdrop{{ $event->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Are you sure?') }}</h1>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('This will remove your event from the Google Calendar. This cannot be undone.') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                <form id="delete-form" action="{{ route('eventforms.destroy', $event->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">{{ __('Delete Event') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                
        
                
                  

        <div id="loading" class="loading">
            <div class="spinner">
                <img src="{{ 'logo80.png' }}" alt="Deleting Event..." class="spin-image" />
            </div>
        </div>

    </section>
    
    <style>
    .confirmationModal {
        display: none;
    }

    /* Deleted animation */
    @keyframes spin {
    0%, 100% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.2);
    }
    }

    /* Apply the animation to the image */
    .spin-image {
        animation: spin 1s infinite linear;
    }

    /* Center the spinner within the content area */
    .py-12 {
        position: relative;
        min-height: 100vh; /* Ensure the content area fills the viewport */
    }

    .loading {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none; /* Hide initially */
    }
    
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteForm = document.getElementById('delete-form');
            var loadingSpinner = document.getElementById('loading');

            deleteForm.addEventListener('submit', function () {
                // Show the loading spinner when the form is submitted
                loadingSpinner.style.display = 'block';
            });
        });
    </script>
</x-app-layout>
