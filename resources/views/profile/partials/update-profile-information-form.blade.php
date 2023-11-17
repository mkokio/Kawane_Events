<section class="relative">
    <div class="text-center">
        <!-- hyperlink 'profile' to the update profile page -->
        {{  __('Would you like to make an ')  }} <a href='/dashboard' class="custom-link">{{ __('event?') }}</a>
        <hr />
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="py-6">
        <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            
                <h2 class>{{ __('Public Information') }}</h2>
        
                <p class="lead">{{ __('All the information below will automatically be appendend to each Google Calendar Event description.') }}</p>
                
                <x-input-label for="public_name" :value="__('Event Creator\'s Name (Required)')" />
                <x-text-input placeholder="山本さくら" id="public_name" name="public_name" type="text" class="mt-1 block w-full" 
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

                <!--A list of the calendar event colors to iterate through -->
                @php
                $colors = ['#a4bdfc', '#7ae7bf', '#dbadff', '#ff887c', '#fbd75b', '#ffb878', '#46d6db', '#e1e1e1', '#5484ed', '#51b749'];
                @endphp

                <div>
                    <x-input-label for="color" :value="__('Color Selector')" /><br />
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic mixed styles example">
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
                        <label class="btn" style="background-color: {{ $colors[$i-1] }};" for="color_{{ $i }}"></label>
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
                
        
        


                <!-- Additional (optional) profile information to be auto-appended to event description -->
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="small text-success""
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
            <div id="loading" class="loading">
                <img src="{{ asset('logo80.png') }}" alt="Editing Profile..." class="spin-image" />
            </div>
</section>
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
        const form = document.getElementById('profile-form'); // Update the form ID
        const loading = document.getElementById('loading');

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Show loading animation
                loading.style.display = 'block';

                // Calculate the exact center of the viewport
                const clientHeight = document.documentElement.clientHeight;
                const spinnerHeight = loading.offsetHeight;
                const spinnerTop = (clientHeight - spinnerHeight) / 2 + window.scrollY;
                loading.style.top = spinnerTop + 'px';

                // Simulate form submission (this is where you might perform the actual form submission using AJAX, etc.)
                setTimeout(() => {
                    form.submit(); // Simulated form submission
                }, 2000); // Adjust this timeout according to your needs
            });
        }
    });
</script>
