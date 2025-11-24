<x-project-layout title="Project details" :showSidebar="false">
    <div class="flex flex-col gap-10 items-start justify-start">
        <x-media-image :model="$project" conversion="website" class="aspect-video w-full h-80 object-cover rounded-lg" />
        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">{{ $project->name }}</h3>
        <x-author :author="$project->author" :date="$project->published_at"></x-author>
        <x-tags :tags="$project->tags"></x-tags>
        <p class="text-sm sm:text-base">
            {{ $project->content }}
        </p>

        @if ($authorProjects->isNotEmpty())
            <section class="w-full">
                <h4 class="text-xl font-semibold mb-4">Other projects from {{ $project->author->name }}</h4>
                <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($authorProjects as $item)
                        <li class="h-full">
                            <article class="h-full w-full flex flex-col gap-3 border border-slate-100 shadow-sm p-4 rounded-lg">
                                <a href="/projects/{{ $item->id }}" class="flex flex-col gap-2">
                                    <x-media-image :model="$item" conversion="preview" class="aspect-video w-full object-cover rounded-md" />
                                    <h5 class="font-semibold text-lg line-clamp-2">{{ $item->name }}</h5>
                                </a>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        @if ($tag && $tagProjects->isNotEmpty())
            <section class="w-full">
                <h4 class="text-xl font-semibold mb-4">Other projects with the same {{ $tag->name }}</h4>
                <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($tagProjects as $item)
                        <li class="h-full">
                            <article class="h-full w-full flex flex-col gap-3 border border-slate-100 shadow-sm p-4 rounded-lg">
                                <a href="/projects/{{ $item->id }}" class="flex flex-col gap-2">
                                    <x-media-image :model="$item" conversion="preview" class="aspect-video w-full object-cover rounded-md" />
                                    <h5 class="font-semibold text-lg line-clamp-2">{{ $item->name }}</h5>
                                </a>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
</x-project-layout>
