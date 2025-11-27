<x-site-layout title="Proctique">
    <section id="hero" class="py-12 sm:py-16">
        <div class="flex flex-col-reverse md:flex-row items-center gap-8">
            <div class="flex-1">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight text-center">
                    Discover, review and share amazing projects
                </h1>
                <p class="mt-4 text-gray-600 text-base sm:text-lg text-center">
                    Explore community projects, find inspiration by tags and authors, and leave thoughtful reviews.
                </p>
                <div class="mt-6 flex gap-3 justify-center">
                    <a href="{{ route('projects.index') }}"
                        class="rounded-3xl bg-blue-600 text-white px-5 py-2.5 hover:bg-blue-500">Explore
                        Projects</a>
                    <a href="{{ route('register') }}"
                        class="rounded-3xl border border-blue-200 text-blue-600 px-5 py-2.5 hover:bg-blue-50">Start
                        Posting</a>
                </div>
            </div>
        </div>
    </section>

    <section id="trending-projects" class="mt-8">
        <x-project-grid :projects="$trendingProjects" title="Trending Projects" />
    </section>

    <section id="recent-projects">
        <h2 class="text-6xl font-semibold my-10">
            Recent projects
        </h2>

        <div class="flex flex-col md:flex-row gap-6 md:gap-10 border border-slate-100 shadow-sm p-4 rounded-lg">
            <x-media-image :model="$mostRecentProject" conversion="website"
                class="aspect-video w-full object-cover rounded-lg" />
            <div class="flex flex-col gap-4">
                <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">
                    {{ $mostRecentProject->name }}
                </h3>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <x-stars :for="$mostRecentProject" with-count />
                </div>
                <x-author :date="$mostRecentProject->published_at" :author="$mostRecentProject->author"></x-author>
                <x-tags :tags="$mostRecentProject->tags"></x-tags>
                <p class="text-sm sm:text-base">
                    {{ $mostRecentProject->leading }}
                </p>
                <a href="{{ route('projects.show', $mostRecentProject->slug) }}"
                    class="rounded-3xl px-5 py-2 bg-blue-600 text-white hover:bg-blue-500 w-fit">Read</a>
            </div>
        </div>

        <div class="mt-10">
            <x-project-grid :projects="$recentProjects" />
        </div>
    </section>

    <section id="register-cta" class="my-16">
        <div class="rounded-3xl bg-blue-50 border border-blue-100 p-8 sm:p-12 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold">What are you waiting for?</h2>
            <p class="mt-3 text-gray-700">Create an account and start sharing your work with the community.</p>
            <div class="mt-6">
                <a href="{{ route('register') }}"
                    class="rounded-3xl bg-blue-600 text-white px-6 py-3 hover:bg-blue-500">Join Now</a>
            </div>
        </div>
    </section>
</x-site-layout>
