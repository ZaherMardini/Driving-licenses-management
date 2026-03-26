<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex">

    <!-- Left Side Image -->
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-left"
         style="background-image: url('/images/defaults/login.png')">
        <div class="h-full w-full bg-black/30"></div>
    </div>

    <!-- Right Side Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-100 dark:bg-gray-900">

        <div class="w-full max-w-md px-8 py-6
                    bg-white/10 backdrop-blur-md
                    border border-white/20
                    shadow-xl rounded-2xl">
            {{ $slot }}
        </div>

    </div>

</div>

</body>
</html>