<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Profile') }}</h2>
    </x-slot>
    <div class="py-6">
        @include('profile.partials.update-profile-information-form')
        <br />
        <hr />
        @include('profile.partials.update-password-form')
        <br />
        <hr />
        @include('profile.partials.delete-user-form')   
    </div>
</x-app-layout>
