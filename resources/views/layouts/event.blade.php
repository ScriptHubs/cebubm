<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cebu Business Months</title>

    @include('layouts.cdnAdmin')

</head>

<body>
    @livewireStyles
    <div id="app" class="">
        <main class="">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>

</html>
