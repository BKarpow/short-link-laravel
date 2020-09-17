<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('text-title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Menu block -->
        @include('includes.menu')
        <!-- END Menu block -->

        <!-- Error box -->
        @include('includes.error')
        <!-- End Error box -->

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="container mt-2">
            @yield('footer')
        </footer>
    </div>

//Script include
@yield('scripts')
</body>
</html>
