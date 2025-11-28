<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/css/fonts.css">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />

</head>

<body class="flex flex-col min-h-screen">
    <x-header>

    </x-header>
    <div
        class="flex flex-col md:flex-row items-start justify-start gap-5 h-full flex-1 mx-auto w-full max-w-screen-xl px-4 pb-6">
        <x-sidebar :tags="$tags">

        </x-sidebar>

        <main class="flex-1 w-full">
            <button type="button" id="toggle-sidebar"
                class="md:hidden ml-auto rounded-xl px-3 py-1.5 text-sm font-medium text-blue-600 border border-blue-200 hover:bg-blue-50">
                Filters
            </button>

            <!-- Mobile inline sidebar panel -->
            <div id="mobile-sidebar" class="md:hidden hidden mb-4">
                <aside class="w-full bg-gray-100 rounded-lg p-3">
                    <x-sidebar :tags="$tags" />
                </aside>
            </div>

            <section>
                {{ $slot }}
            </section>
        </main>
    </div>

    <x-footer>

    </x-footer>

    <x-to-top />
</body>

</html>