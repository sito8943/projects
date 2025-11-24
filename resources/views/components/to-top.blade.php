<div id="to-top" class="fixed bottom-4 right-4 z-50">
    <button
        type="button"
        aria-label="Back to top"
        class="scale-0 w-11 h-11 rounded-full bg-red-500 text-white shadow-lg hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-red-500 flex items-center justify-center transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l5 5a1 1 0 01-1.414 1.414L11 6.414V17a1 1 0 11-2 0V6.414L5.707 9.707A1 1 0 114.293 8.293l5-5A1 1 0 0110 3z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
<script>
    (function () {
        const container = document.getElementById('to-top');
        if (!container) return;
        const btn = container.querySelector('button');
        if (!btn) return;

        const toggle = () => {
            if (window.scrollY > 200) {
                btn.classList.remove('scale-0');
            } else {
                btn.classList.add('scale-0');
            }
        };

        window.addEventListener('scroll', toggle, { passive: true });
        window.addEventListener('load', toggle);
        document.addEventListener('turbo:load', toggle);

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
</script>

