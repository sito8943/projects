<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body class="flex flex-col min-h-screen">
    <header class="m-auto w-full max-w-screen-xl px-4 my-4 sticky top-2">
        <div class="bg-red-400/70 backdrop-blur-sm rounded-[120px] px-4 py-2 flex items-center justify-between">
            <h1 class="text-xl poppins">
                <a href="/" class="text-white">Proctique</a>
            </h1>

            <!-- Desktop nav -->
            <nav class="hidden md:block">
                <ul class="flex gap-2 items-center justify-end">
                    <li>
                        <a href="/"
                            class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Home</a>
                    </li>
                    <li>
                        <a href="/projects"
                            class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Projects</a>
                    </li>
                    <li>
                        <a href="/authors"
                            class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Authors</a>
                    </li>
                    <li>
                        <a href="/sign-in"
                            class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Sign
                            in</a>
                    </li>
                    <li>
                        <a href="/sign-up"
                            class="transition rounded-3xl px-4 py-1 hover:text-white hover:bg-red-600 text-red-400 bg-white">Sign
                            up</a>
                    </li>
                </ul>
            </nav>

            <!-- Mobile menu button -->
            <button type="button" id="mobile-menu-button"
                class="md:hidden inline-flex items-center justify-center rounded-xl p-2 text-white/90 hover:text-white hover:bg-red-400/40 focus:outline-none focus:ring-2 focus:ring-white/60"
                aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <x-fas-bars class="h-6 w-6" />
            </button>
        </div>

        <!-- Mobile nav panel -->
        <nav id="mobile-menu"
            class="md:hidden mt-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-white/60 hidden">
            <ul class="px-3 py-2">
                <li>
                    <a href="/" class="block w-full rounded-xl px-4 py-2 text-red-500 hover:bg-red-50">Home</a>
                </li>
                <li>
                    <a href="/projects"
                        class="block w-full rounded-xl px-4 py-2 text-red-500 hover:bg-red-50">Projects</a>
                </li>
                <li>
                    <a href="/authors"
                        class="block w-full rounded-xl px-4 py-2 text-red-500 hover:bg-red-50">Authors</a>
                </li>
                <li class="mt-1 flex gap-2">
                    <a href="/sign-in"
                        class="flex-1 text-center rounded-xl px-4 py-2 text-red-500 border border-red-200 hover:bg-red-50">Sign
                        in</a>
                    <a href="/sign-up"
                        class="flex-1 text-center rounded-xl px-4 py-2 text-white bg-red-500 hover:bg-red-600">Sign
                        up</a>
                </li>
            </ul>
        </nav>
    </header>

    <div
        class="flex flex-col md:flex-row items-start justify-start gap-5 h-full flex-1 mx-auto w-full max-w-screen-xl px-4 pb-6">
        @if ($showSidebar)
            <x-sidebar>

            </x-sidebar>
        @endif

        <main class="flex-1 w-full">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if ($title !== 'Proctique')
                    <button type="button" onclick="history.go(-1)"
                        class="rounded-full hover:bg-red-400/40 p-2 transition hover:text-white">
                        <x-fas-chevron-left class="w-4 h-4" />
                    </button>
                @endif
                <h2 class="text-2xl md:text-3xl font-bold">{{ $title }}</h2>

                @if ($showSidebar)
                    <button type="button" id="toggle-sidebar"
                        class="md:hidden ml-auto rounded-xl px-3 py-1.5 text-sm font-medium text-red-600 border border-red-200 hover:bg-red-50">
                        Filters
                    </button>
                @endif
            </div>

            @if ($showSidebar)
                <!-- Mobile inline sidebar panel -->
                <div id="mobile-sidebar" class="md:hidden hidden mb-4">
                    <aside class="w-full bg-gray-100 rounded-lg p-3"></aside>
                </div>
            @endif

            <section>
                {{ $slot }}
            </section>
        </main>
    </div>
    <footer class="bg-red-400 w-full mt-auto">
        <div class="max-w-screen-xl mx-auto px-4 py-8">
            <p class="text-2xl md:text-3xl text-white">Proctique</p>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (menuBtn && menu) {
            menuBtn.addEventListener('click', () => {
                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                menuBtn.setAttribute('aria-expanded', String(isHidden));
            });
        }

        const toggleSidebarBtn = document.getElementById('toggle-sidebar');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        if (toggleSidebarBtn && mobileSidebar) {
            toggleSidebarBtn.addEventListener('click', () => {
                mobileSidebar.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>