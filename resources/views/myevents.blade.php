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
            
                <!-- logic goes below -->

                <div class="accordion" id="accordionOfEvents">
                    @foreach ($events as $index => $event)
                        @if ($event->google_calendar_id)
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
                                            <button type="button" class="btn btn-outline-danger btn-sm">{{  __('Delete Event') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                

    </section>
    
    <style>

    </style>

    <script>

    </script>
</x-app-layout>
