<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ $title }}</title>
</head>

<body class="flex flex-col min-h-screen">
    <header
        class="bg-red-400/70 backdrop-blur-sm rounded-3xl m-auto w-full max-w-[960px] px-4 py-2 flex items-center justify-between my-4 sticky top-2">
        <h1 class="text-xl poppins">
            <a href="/" class="text-white">
                Proctique
            </a>
        </h1>
        <nav>
            <ul class="flex gap-2 items-center justify-end">
                <li>
                    <a href="/" class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/projects"
                        class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">
                        Projects
                    </a>
                </li>
                <li>
                    <a href="/tags"
                        class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">
                        Tags
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex-1 h-full m-auto w-full max-w-[960px]  pb-4">
        <div class="flex items-center gap-2 mb-4">
            @if ($title !== 'Proctique')
                <button type="button" onclick="history.go(-1)"
                    class="rounded-full hover:bg-red-400/40 p-2 transition hover:text-white">
                    <x-fas-chevron-left class="w-4 h-4" />
                </button>
            @endif
            <h2 class="text-3xl font-bold">
                {{ $title }}
            </h2>
        </div>

        <section>
            {{ $slot }}
        </section>
    </main>
    <footer class="bg-red-400 w-full p-8">
        <div>
            <p class="text-3xl text-white">
                Proctique
            </p>
        </div>
    </footer>
</body>

</html>