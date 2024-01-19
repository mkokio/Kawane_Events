<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div style="transform: scale(0.6);">
            <x-application-logo />
        </div>
        <div class="float-center">
            <x-application-title />
        </div>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Create Event') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('myevents') }}">{{ __('My Events') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
                <li class="dropdown-divider"></li>
                <div class="text-center">
                @include('partials/language_switcher')
                </div>
            </ul>
        </div>
    </div>
</nav>
