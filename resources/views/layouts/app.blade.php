<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')

    @stack('scripts')
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100 bg-white">
        @include('partials.navbar')
        <main id="main" class="pb-4 flex-shrink-0 @hasSection('toasts') position-relative @endif" style="padding-top: 5rem;">
            @yield('content')
            @hasSection('toasts')
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    @yield('toasts')
                </div>
            @endif
        </main>
        @include('partials.footer')
    </div>
</body>
</html>
