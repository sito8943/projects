<x-app-layout title='Project with Id {{ $project->id }}''>
    <div class="space-y-4">
        <div class="bg-white rounded-lg p-4 shadow">
            <h2 class="text-2xl font-semibold mb-2">{{ $project->name }}</h2>
            @if ($project->author)
                <p class="text-sm text-gray-600">by {{ $project->author->name }}</p>
            @endif
            @if ($project->header_image)
                <img src="{{ $project->header_image }}" alt="Header image" class="mt-3 rounded-md max-h-60 object-cover">
            @endif
            @if ($project->leading)
                <p class="mt-3 text-gray-800">{{ $project->leading }}</p>
            @endif
            @if ($project->description)
                <div class="mt-3 text-gray-700 whitespace-pre-line">{{ $project->description }}</div>
            @endif
            <div class="mt-3 text-sm text-gray-600">
                <span>Status: {{ $project->is_published ? 'Published' : 'Draft' }}</span>
                @if ($project->published_at)
                    <span class="ml-3">Published at: {{ $project->published_at }}</span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

