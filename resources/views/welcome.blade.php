<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cebu Business Months</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @include('cdn')
    </head>
    @livewireStyles
     
    <body class="antialiased">
        <div class="relative min-h-screen bg-dots-darker bg-gray-100 dark:bg-dots-lighter">
            @livewire('registration')
            @livewireScripts
        </div>
    </body>
</html>
