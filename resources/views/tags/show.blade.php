<x-site-layout title="{{ $tag->name }}">
    <div class="flex flex-col gap-4 items-start justify-start">
        <ul class="flex gap-4 items-center justify-start">
            @foreach ($tag->projects as $project)
                <li class="h-full">
                    <a href="/projects/{{ $project->id }}"
                        class="bg-gray-200 hover:bg-red-400 transition hover:text-white block flex-1 rounded-lg h-full p-4">
                        {{ $project->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-site-layout>