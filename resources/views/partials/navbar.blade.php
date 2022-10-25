<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'link-primary' : '' }}" href="{{ route('about') }}">{{ __('About Us') }}</a>
                </li>

                @if(Auth::guest() || !Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('products.index') ? 'link-primary' : '' }}" href="{{ route('products.index') }}">{{ __('Products') }}</a>
                    </li>
                @endif

                @auth
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('products.index') ? 'link-primary' : '' }}" href="{{ route('products.index') }}">{{ __('Manage Products') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('categories.create') ? 'link-primary' : '' }}" href="{{ route('categories.create') }}">{{ __('Add Category') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('transactions.index') ? 'link-primary' : '' }}" href="{{ route('transactions.index') }}">{{ __('My Transactions') }}</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('login') ? 'link-primary' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('register') ? 'link-primary' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if(! request()->user()->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link {{ Route::is('cart.index') ? 'link-primary' : '' }}">{{ __('Cart') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                             aria-expanded="false">
                            {{ Auth::user()->name }}
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('View Profile') }}</a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
