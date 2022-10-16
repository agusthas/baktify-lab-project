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
        <main id="main" class="pb-4 flex-shrink-0">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>
</html>
