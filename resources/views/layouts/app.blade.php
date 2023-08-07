<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @include('layouts.cdnAdmin')

</head>

<body>
@livewireStyles
    <div id="app" class="bg-dark vh-100 justify-content-center d-flex flex-column">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
        @livewireScripts
</body>

</html>
