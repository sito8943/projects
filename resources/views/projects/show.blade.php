<x-project-layout title="Project details" :showSidebar="false">
    <div class="flex flex-col gap-10 items-start justify-start">
        <x-media-image :model="$project" conversion="website" class="aspect-video w-full h-80 object-cover rounded-lg" />
        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">{{ $project->name }}</h3>
        <x-author :author="$project->author" :date="$project->published_at"></x-author>
        <x-tags :tags="$project->tags"></x-tags>
        <p class="text-sm sm:text-base">
            {{ $project->content }}
        </p>
    </div>
</x-project-layout>
