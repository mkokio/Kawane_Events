<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @include('profile.partials.update-profile-information-form')
        <br />
        <hr />
        @include('profile.partials.update-password-form')
        <br />
        <hr />
        @include('profile.partials.delete-user-form')   
    
        <div id="loading" class="loading">
            <img src="{{ asset('logo80.png') }}" alt="Editing Profile..." class="spin-image" />
        </div>
    
    </div>

    <style>
        /* Define your spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none; /* Hide the spinner initially */
        }
    </style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('profile-form');
        const loading = document.getElementById('loading');
        
        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Show loading animation
                loading.style.display = 'block';

                // Simulate form submission after a delay
                setTimeout(function () {
                    form.submit();
                }, 1500); // Replace with your logic or remove this timeout
            });
        }
    });
</script>
</x-app-layout>
