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
    <style>

        input[type="text"] {
            background-color: #f2f2f2;
            color: #1F2937; /* kolor tekstu */
        }
        input[type="email"] {
            background-color: #f2f2f2;
            color: #1F2937; /* kolor tekstu */
        }
        input[type="password"] {
            background-color: #f2f2f2;
            color: #1F2937; /* kolor tekstu */
        }
        input[type="checkbox"] {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: #f2f2f2; color: #1F2937;">
<div class="min-h-screen" style="background-color: #f2f2f2; color: #1F2937;">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
