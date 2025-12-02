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

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --cb-dark: #0D1421;
                --cb-card: #141D2D;
                --cb-green: #10B981;
                --cb-border: #29374D;
            }
            .bg-cb-dark { background-color: var(--cb-dark); }
            .bg-cb-card { background-color: var(--cb-card); }
            .bg-cb-green { background-color: var(--cb-green); }
            .text-cb-green { color: var(--cb-green); }
            .border-cb-border { border-color: var(--cb-border); }
            .text-cb-dark { color: var(--cb-dark); }
        </style>
    </head>
    <body class="font-sans antialiased bg-cb-dark">
        <div class="min-h-screen bg-cb-dark">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-cb-card shadow border-b border-cb-border">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="bg-cb-dark">
                {{ $slot }}
            </main>
        </div>

        <!-- Stack para scripts adicionales -->
        @stack('scripts')
    </body>
</html>
