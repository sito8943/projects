<header class="m-auto w-full max-w-screen-xl px-4 my-4 sticky top-2 z-10">
    <div class="bg-[#1b4b96]/70 backdrop-blur-sm rounded-md px-4 py-2 flex items-center justify-between">
        <h1 class="text-xl poppins">
            <a href="{{ route('home') }}" class="text-white">Proctique</a>
        </h1>

        <!-- Desktop nav -->
        <nav class="hidden md:block">
            <x-public-header-links layout="desktop" />
        </nav>

        <!-- Mobile menu button -->
        <button type="button" id="mobile-menu-button"
            class="md:hidden inline-flex items-center justify-center rounded-xl p-2 text-white/90 hover:text-white hover:bg-blue-500/30 focus:outline-none focus:ring-2 focus:ring-white/60"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <x-fas-bars class="h-6 w-6" />
        </button>
    </div>

    <!-- Mobile nav panel -->
    <nav id="mobile-menu"
        class="md:hidden mt-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow border border-white/60 hidden">
        <x-public-header-links layout="mobile" />
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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
    });
    </script>
