<section>


    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <header>
            <h2 class="text-lg font-medium text-black">
                {{ __('Public Information') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __('All the information below will automatically be appendend to each Google Calendar Event description.') }}
            </p>
        </header>

        <div>
            <x-input-label for="public_name" :value="__('Event Creator\'s Name (Required)')" />
            <x-text-input placeholder="山本さくら" id="public_name" name="public_name" type="text" class="mt-1 block w-full" 
            :value="old('public_name', $user->public_name)" required autofocus autocomplete="public_name" />
            <x-input-error class="mt-2" :messages="$errors->get('public_name')" />
        </div>
        
        <div>
            <x-input-label for="business_name" :value="__('Business Name')" />
            <x-text-input placeholder="カフェさくら" id="business_name" name="business_name" type="text" class="mt-1 block w-full" 
            :value="old('business_name', $user->business_name)" autofocus autocomplete="business_name" nullable  />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input placeholder="09012345678" id="phone" name="phone" type="text" class="mt-1 block w-full" 
            :value="old('phone', $user->phone)" nullable autofocus autocomplete="phone" />
        </div>

        <div>
            <x-input-label for="contact_email" :value="__('Contact email')" />
            <x-text-input placeholder="sakura@mail.jp" id="contact_email" name="contact_email" type="text" class="mt-1 block w-full" 
            :value="old('contact_email', $user->contact_email)" nullable autofocus autocomplete="contact_email" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />
        </div>

        <div>
            <x-input-label for="instagram" :value="__('Instagram @')" />
            <x-text-input placeholder="sakura_insta" id="instagram" name="instagram" type="text" class="mt-1 block w-full" 
            :value="old('instagram', $user->instagram)" nullable autofocus autocomplete="instagram" />
            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
        </div>

        <div>
            <x-input-label for="twitter" :value="__('Twitter @')" />
            <x-text-input placeholder="sakura_tweets" id="twitter" name="twitter" type="text" class="mt-1 block w-full" 
            :value="old('twitter', $user->twitter)" nullable autofocus autocomplete="twitter" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        </div>

        <div>
            <x-input-label for="homepage" :value="__('Homepage')" />
            <x-text-input placeholder="www.town.kawanehon.shizuoka.jp" id="homepage" name="homepage" type="text" class="mt-1 block w-full" 
            :value="old('homepage', $user->homepage)" nullable autofocus autocomplete="homepage" />
            <x-input-error class="mt-2" :messages="$errors->get('homepage')" />
        </div>

        <!-- Create a Color selector
        <div>
            <x-input-label for="colors" :value="__('Calendar Event Color')" />
            <x-text-input id="colors" name="colors" type="text" class="mt-1 block w-full" 
            :value="old('colors', $user->colors)" nullable autofocus autocomplete="colors" />
            <x-input-error class="mt-2" :messages="$errors->get('colors')" />
        </div>
        -->

        <br />
        <hr />
        <br />
        
        <header>
            <h2 class="text-lg font-medium text-black">
                {{ __('Log-In Information') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{  __('Update your account\'s log-in information and email address.') }}
            </p>
        </header>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        


        <!-- Additional (optional) profile information to be auto-appended to event description -->
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
