<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <title>{{ $title }}</title>
    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <x-header>

    </x-header>

    <div
        class="flex flex-col md:flex-row items-start justify-start gap-5 h-full flex-1 mx-auto w-full max-w-screen-xl px-4 pb-6">

        <main class="flex-1 w-full">

            <div class="flex flex-wrap items-center gap-2 mb-4">
                <button type="button" onclick="history.go(-1)"
                    class="rounded-full hover:bg-red-400/40 p-2 transition hover:text-white">
                    <x-fas-chevron-left class="w-4 h-4" />
                </button>
                <h2 class="text-2xl md:text-3xl font-bold">{{ $title }}</h2>
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
