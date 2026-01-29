<div id="to-top" class="fixed bottom-4 right-4 z-50">
    <button type="button" aria-label="Back to top"
        class="scale-0 w-11 h-11 rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-500 flex items-center justify-center transition">
        <x-fas-arrow-up class="w-5 h-5" />
    </button>
</div>
<script>
    (function () {
        const container = document.getElementById('to-top');
        if (!container) return;
        const btn = container.querySelector('button');
        if (!btn) return;

        // Adjust position to avoid overlapping the footer when it's visible
        const footer = document.getElementById('site-footer');
        let footerVisible = false;

        const setBottomOffset = () => {
            if (!footerVisible || !footer) {
                container.style.bottom = '';
                return;
            }
            const h = footer.getBoundingClientRect().height || 0;
            const margin = 16; // 1rem
            container.style.bottom = (h + margin) + 'px';
        };

        if (footer && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    footerVisible = entry.isIntersecting;
                    setBottomOffset();
                });
            }, { root: null, threshold: 0 });
            observer.observe(footer);

            window.addEventListener('resize', setBottomOffset, { passive: true });
        }

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