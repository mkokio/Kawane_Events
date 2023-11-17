<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Make responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Prevent users from cacheing -->
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="float-left">
                    <div style="transform: scale(0.6);">
                        <x-application-logo />
                    </div>
                </div>
            
                <div class="float-right">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/profile') }}" class="btn btn-secondary p-1">{{ __('Profile') }}</a>
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary p-1">{{ __('Create Event') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary p-1">{{ __('Log In') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary p-1">{{ __('Register') }}</a>
                            @endif
                        @endauth
            
                        <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank" class="btn btn-outline-secondary icon-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                            </svg>
                        </a>
                        
                          
                    @endif
                </div>
            </div>
        </nav>
        
            
            <div class="w-100 col-md-6 mt-1 px-4 py-4 bg-white shadow-lg overflow-hidden rounded mx-auto" style="max-width: 700px;">
                    <div class="text-center">
                        <br />
                        {{ __('Welcome to the Kawane Events Creator portal. From here, you can register, log in, and create events on the public Kawane Events Google Calendar for all to see.') }}
                    </div>
                <hr />
                <div class="d-flex justify-content-center">
                    <iframe src="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" style="border-width:0" width="600" height="600" frameborder="0" scrolling="no"></iframe>
                </div>            
            </div>    
            <hr />
            <a href="https://www.marccocchio.com" target="_blank" class="btn btn-link">&copy;2023 マーク</a>
            <br>
            <button type="button" class="btn btn btn-link" data-bs-toggle="modal" data-bs-target="#imageModal">
                {{ __('Donate') }}
            </button>
            
            <!-- Modal with just an image -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('kawaneeventsbitcoinqr.jpg') }}" alt="Bitcoin QR Code" style="width: 80%;">
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>