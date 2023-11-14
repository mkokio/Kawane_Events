<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <x-application-logo />

        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Create Event') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
                <hr />
                @include('partials/language_switcher')
            </ul>
        </div>
    </div>
</nav>
