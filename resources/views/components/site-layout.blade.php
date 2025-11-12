<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body class="flex flex-col h-screen">
    <header class="bg-red-200 rounded-3xl px-4 py-2 flex items-center justify-between m-4 sticky top-2">
        <h1 class="text-xl">
            Proctique
        </h1>
        <nav>
            <ul class="flex gap-4 items-center justify-end">
                <li>
                    <a href="/">
                        Home
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex-1 h-full">
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