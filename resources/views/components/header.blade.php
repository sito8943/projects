<header class="m-auto w-full max-w-screen-xl px-4 my-4 sticky top-2">
    <div class="bg-[#1b4b96]/70 backdrop-blur-sm rounded-md px-4 py-2 flex items-center justify-between">
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
                @if (auth()->user() != null)
                    <li>
                        <a href="/profile"> <img class="w-8 h-8 bg-gray-50 rounded-full" src="{{ auth()->user()->avatar }}"
                                alt="{{ auth()->user()->name }}" /></a>
                    </li>
                @else
                    <li>
                        <a href="/login"
                            class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Login</a>
                    </li>
                    <li>
                        <a href="/register"
                            class="transition rounded-3xl px-4 py-1 hover:text-white hover:bg-red-600 text-red-400 bg-white">Register</a>
                    </li>
                @endif
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
                <a href="/projects" class="block w-full rounded-xl px-4 py-2 text-red-500 hover:bg-red-50">Projects</a>
            </li>
            <li>
                <a href="/authors" class="block w-full rounded-xl px-4 py-2 text-red-500 hover:bg-red-50">Authors</a>
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