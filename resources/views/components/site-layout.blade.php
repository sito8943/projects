<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ $title }}</title>
</head>

<body class="flex flex-col min-h-screen">
    <header class="bg-red-400 rounded-3xl px-4 py-2 flex items-center justify-between mx-9 my-4 sticky top-2">
        <h1 class="text-xl">
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
                    <a href="/projects">
                        class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">
                        Projects
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex-1 h-full px-4 pb-4">
        {{ $slot }}
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