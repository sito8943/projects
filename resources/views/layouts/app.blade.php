<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & Alpine.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.app_navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main
            class="flex flex-col gap-5 h-full flex-1 mx-auto w-full max-w-screen-xl px-4 pb-6">

            <div name="header" class="bg-gray-100 w-full flex items-center justify-between py-4 sticky top-16">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __($title) }}
                </h2>
                @if ($action && $button)
                    <a href="{{ $action }}"
                        class="rounded-3xl px-4 py-2 bg-red-400 text-white hover:bg-red-300">{{ $button }}</a>
                @endif
            </div>


            {{ $slot }}
        </main>
    </div>
    <x-to-top />
</body>

</html>
