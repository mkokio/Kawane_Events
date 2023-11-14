<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>{{ __('Kawane Event Creator') }}</title>

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
            
                        <a href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}" target="_blank" class="btn btn-outline-secondary">{{ __('Events Calendar') }}</a>
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
            <a href="https://www.marccocchio.com" class="link-info">
                &copy; マーク
            </a><br />
            <a href="{{ asset('kawaneeventsbitcoinqr.jpg') }}" class="link-info">{{ __('Donate') }}</a>
    </body>
</html>
