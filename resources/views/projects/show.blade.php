<x-site-layout title="Project details" :showSidebar="false">
    <div class="flex flex-col gap-4 items-start justify-start">
        <h3 class="font-bold text-6xl">{{ $project->name }}</h3>
        <x-author-layout :author="$project->author"></x-author-layout>
        <x-tags-layout :tags="$project->tags"></x-tags-layout>
        <p>
            {{ $project->description }}
        </p>
    </div>
</x-site-layout>