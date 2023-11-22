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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
        <style>
        .form-control::placeholder {
            color: rgb(220, 164, 164); /* Change 'red' to the color you want */
        }
        </style>
        
    </head>
    <body class="font-sans antialiased">
        <div class="container-fluid">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="container py-3">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main class="col-md-6 mt-1 px-4 py-4 bg-white shadow-lg rounded mx-auto" style="max-width: 700px;">
                {{ $slot }}
            </main>
        </div> 
        <hr />
        {{ __('Assistance: ') }}
        <a href="mailto:{{ env('MAIL_USERNAME') }}?subject=Kawane%20Event%20Help">
        {{ env('MAIL_USERNAME') }}
        </a>
    </body>
<!-- Bootstrap JavaScript and Popper.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z6W5/KZlU2u8z2n2pHf2b5N4A4PjB4fl6S6v5wM" crossorigin="anonymous"></script>
</html>
