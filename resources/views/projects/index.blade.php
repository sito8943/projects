<x-site-layout :showSidebar="true" title="Proctique Discovery">
    <ul class="grid gap-10">
        @foreach ($projects as $project)
            <li class="h-full">
                <article
                    class="h-full w-full flex flex-col gap-4 sm:gap-5 border border-slate-100 shadow-sm p-4 sm:p-6 lg:p-8 rounded-lg transition-shadow">
                    <a href="/projects/{{ $project->id }}" class="flex flex-col gap-3 sm:gap-4">
                        <img src="{{ $project->media->first()->getUrl()}}" alt="{{ $project->name }}"
                            class="aspect-video w-full object-cover rounded-lg">
                        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">
                            {{ $project->name }}
                        </h3>
                    </a>
                    <x-author :date="$project->published_at" :author="$project->author"></x-author>
                    <x-tags :tags="$project->tags"></x-tags>
                    <p class="text-sm sm:text-base">
                        {{ $project->leading }}
                    </p>
                </article>
            </li>
        @endforeach
    </ul>
</x-site-layout>