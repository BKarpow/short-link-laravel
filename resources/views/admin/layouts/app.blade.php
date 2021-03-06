<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/public/css/app.css') }}">

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">

    @yield('styles')

    <title>@yield('text-title') | Admin Panel</title>
</head>
<body>

<div id="app">
    <div  id="menu">
        @include('admin.includes.menu')
    </div>
    <!-- /#menu.container -->
    <div id="alertBlock">
        @include('admin.includes.alert')
    </div>
    <!-- /#alertBlock -->
    <main id="content" class="mt-3">
        @yield('content')
    </main>
    <!-- /#content -->
    <footer class="container mt-2">
        @yield('footer')
    </footer>

</div>
<!-- /#app -->
<!-- Script include -->
<script src="{{ asset('/public/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
