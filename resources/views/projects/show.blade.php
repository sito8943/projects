<x-project-layout title="Project details" :showSidebar="false">
    @if (!empty($activePurchase) || !empty($projectHasAnyPurchase))
        <div id="sponsor-spinner" class="opacity-0 fixed right-4 top-20 z-30 select-none transition-opacity duration-300"
            aria-hidden="false">
            <span class="sr-only">This project is being sponsored</span>
            <svg viewBox="0 0 100 100" class="w-32 h-32 text-green-700 animate-spin pointer-events-none"
                style="animation-duration:8s;animation-timing-function:linear" role="img">
                <defs>
                    <path id="circlePath" d="M50,50 m-35,0 a35,35 0 1,1 70,0 a35,35 0 1,1 -70,0" />
                </defs>
                <text font-size="10" class="fill-current uppercase" style="letter-spacing:1.2px">
                    <textPath href="#circlePath">
                        SPONSORED • PROJECT • CLICK HERE •
                    </textPath>
                </text>
            </svg>
            <a href="#sponsor-form" data-scroll-to="sponsor-form"
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 inline-flex items-center justify-center rounded-full bg-green-600 text-white text-xs font-semibold w-16 h-16 shadow hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600">
                Sponsor
            </a>
        </div>
    @endif
    <div class="flex flex-col gap-10 items-start justify-start">
        <x-media-image :model="$project" conversion="website"
            class="aspect-video w-full h-80 object-cover rounded-lg" />
        <div class="w-full flex items-start">
            <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl flex-1">{{ $project->name }}</h3>
        </div>
        <x-author :author="$project->author" :date="$project->published_at"></x-author>
        <x-tags :tags="$project->tags"></x-tags>
        <p class="text-sm sm:text-base">
            {{ $project->content }}
        </p>
        <div class="w-full">
            <x-project-sponsor :project="$project" :sponsors="$sponsors" :active-purchase="$activePurchase" />
        </div>

        <section class="w-full flex flex-col gap-6">
            <h4 class="text-xl font-semibold" id="reviews">Reviews</h4>

            <livewire:review-form :project="$project" />

            <livewire:project-review :project="$project" />

        </section>

        @if ($authorProjects->isNotEmpty())
            <x-project-grid :projects="$authorProjects" :title="'Also from ' . $project->author->name"
                :showAuthors="false" />
        @endif

        @if ($tag && $tagProjects->isNotEmpty())
            <x-project-grid :projects="$tagProjects" :title="'Similar projects'" show />
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const spinner = document.getElementById('sponsor-spinner');
            if (!spinner) return;
            let lastY = window.scrollY;
            let ticking = false;
            const handle = () => {
                const y = window.scrollY;
                if (y > 255) {
                    spinner.classList.add('opacity-0', 'pointer-events-none');
                } else {
                    spinner.classList.remove('opacity-0', 'pointer-events-none');
                }
                lastY = y;
                ticking = false;
            };
            requestAnimationFrame(handle);
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(handle);
                    ticking = true;
                }
            }, { passive: true });

            // Delegated smooth scroll with sticky header offset
            document.addEventListener('click', (event) => {
                const trigger = event.target.closest('[data-scroll-to]');
                if (!trigger) {
                    return;
                }

                const targetId = trigger.getAttribute('data-scroll-to');
                const el = document.getElementById(targetId);
                const header = document.querySelector('header.sticky, header[role="banner"], header');
                const offset = ((header && header.offsetHeight) || 64) + 200;

                if (el) {
                    event.preventDefault();
                    const y = el.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                }
            });
        });
    </script>

</x-project-layout>