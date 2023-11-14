<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @include('profile.partials.update-profile-information-form')
        <hr />
        @include('profile.partials.update-password-form')
        <hr />
        @include('profile.partials.delete-user-form')   
    </div>
</x-app-layout>
