<section class="relative">
    <div class="text-center">
        <em>{{  __('Would you like to make an ')  }} <a href='/dashboard' class="custom-link">{{ __('event?') }}</a></em>
        <hr />
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="py-6">
        <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            
                <h3 class>{{ __('Profile Information') }}</h3>
        
                <p class="lead">{{ __('All the information below will automatically be appendend to each Google Calendar Event description.') }}</p>
                
                <x-input-label for="public_name" :value="__('Event Creator\'s Name (Required)')" />
                <x-text-input placeholder="山田さくら" id="public_name" name="public_name" type="text" class="mt-1 block w-full" 
                    :value="old('public_name', $user->public_name ?? $user->name)" required autofocus autocomplete="{{ $user->public_name ? 'off' : $user->name }}" />
                <x-input-error class="mt-2" :messages="$errors->get('public_name')" />
            
            
                <x-input-label for="business_name" :value="__('Business Name')" />
                <x-text-input placeholder="カフェさくら" id="business_name" name="business_name" type="text" class="mt-1 block w-full" 
                :value="old('business_name', $user->business_name)" autofocus autocomplete="business_name" nullable  />

                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input placeholder="09012345678" id="phone" name="phone" type="text" class="mt-1 block w-full" 
                :value="old('phone', $user->phone)" nullable autofocus autocomplete="phone" />

                <x-input-label for="contact_email" :value="__('Contact email')" />
                <x-text-input placeholder="sakura@mail.jp" id="contact_email" name="contact_email" type="text" class="mt-1 block w-full" 
                :value="old('contact_email', $user->contact_email)" nullable autofocus autocomplete="contact_email" />
                <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />

                <x-input-label for="instagram" :value="__('Instagram')" />
                <div class="input-group ">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <x-text-input placeholder="sakura_insta" id="instagram" name="instagram" type="text" class="" 
                    :value="old('instagram', $user->instagram)" nullable autofocus autocomplete="instagram" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('instagram')" />

                <x-input-label for="twitter" :value="__('Twitter')" />
                <div class="input-group ">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <x-text-input placeholder="sakura_tweets" id="twitter" name="twitter" type="text" class="" 
                    :value="old('twitter', $user->twitter)" nullable autofocus autocomplete="twitter" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('twitter')" />

                <x-input-label for="homepage" :value="__('Homepage')" />
                <x-text-input placeholder="www.town.kawanehon.shizuoka.jp" id="homepage" name="homepage" type="text" class="mt-1 block w-full" 
                :value="old('homepage', $user->homepage)" nullable autofocus autocomplete="homepage" />
                <x-input-error class="mt-2" :messages="$errors->get('homepage')" />

                <!--A pretty cool list of the calendar event colors to iterate through -->
                @php
                $colors = ['#a4bdfc', '#7ae7bf', '#dbadff', '#ff887c', '#fbd75b', '#ffb878', '#46d6db', '#e1e1e1', '#5484ed', '#51b749'];
                @endphp

                <div>
                    <x-input-label for="color" :value="__('Color Selector for you Events')" /><br />
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic mixed styles example" style="height: 35px;">
                        @for ($i = 1; $i <= 10; $i++)
                        <input type="radio"
                            class="btn-check visually-hidden"
                            name="colorselector"
                            id="color_{{ $i }}"
                            value="{{ $i }}"
                            autocomplete="off"
                            style="display: none;"
                            @if (old('colors', $user->colors) == $i || ($i === 1 && $user->colors === null)) checked @endif
                        />
                        <label class="btn" style="background-color: {{ $colors[$i-1] }}; height: 100%;" for="color_{{ $i }}"></label>
                        @endfor
                    </div>
                </div>          

                <div class="mt-4">
                    <p class="lead"><br>{{  __('Update your account\'s log-in information and email address.') }}</p>
                </div>

                <x-input-label for="name" :value="__('Login Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="font-italic">
                            {{ __('Your email address is unverified.') }}
                            <form method="POST" action="{{ route('verification.send') }}" id="send-verification" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger" form="send-verification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </form>
                            <div class="py-12">
                                @include('profile.partials.update-profile-information-form')
                                <br />
                                <hr />
                                @include('profile.partials.update-password-form')
                                <br />
                                <hr />
                                @include('profile.partials.delete-user-form')   
                            </div>
                        </p>
                
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-weight-bold text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

                <div class="flex items-center gap-4">
                    <x-primary-button id="saveButton" data-bs-toggle="modal" data-bs-target="#confirmationModal">{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="small text-success"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
            <div id="confirmationModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Update profile information?') }}</h5>
                        </div>
                        <div class="modal-body">
                        {{ __('This information will be publicly available on any future events that you create.') }}
                        </div>
                        <div class="modal-footer">
                            <button id="confirmSubmit" class="btn btn-primary">{{ __('Save') }}</button>
                            <button id="cancelSubmit" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loading" class="loading">
                <div class="spinner">
                    <img src="{{ secure_asset('logo80.png') }}" alt="Saving Profile..." class="spin-image" />
                </div>
            </div>
</section>

<style>
    .confirmationModal {
        display: none;
    }

    /* Spinner animation */
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
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none; /* Hide initially */
    }
    
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('profile-form');
        const loading = document.getElementById('loading');
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmSubmit = document.getElementById('confirmSubmit');
        const cancelSubmit = document.getElementById('cancelSubmit');
        const saveButton = document.getElementById('saveButton');

        if (saveButton && confirmationModal && confirmSubmit && cancelSubmit && loading) {
            saveButton.addEventListener('click', function (event) {
                event.preventDefault();
                confirmationModal.style.display = 'block';
            });

            confirmSubmit.addEventListener('click', function () {
                loading.style.display = 'block';
                confirmationModal.style.display = 'none';
                //loading.classList.add('spin-image');

                setTimeout(() => {
                    form.submit();
                }, 2000);
            });

            cancelSubmit.addEventListener('click', function () {
                confirmationModal.style.display = 'none';
            });
        }
    });
</script>

