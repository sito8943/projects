<x-site-layout title='Projects'>
    <ul class="grid grid-cols-3 grid-rows-1 gap-4">
        @foreach ($projects as $project)
            <li class="h-full">
                <a href="/projects/{{ $project->id }}" class="bg-gray-200 rounded-lg h-full p-4 flex flex-col gap-2">
                    <h3 class="font-bold text-xl">
                        {{ $project->name }}
                    </h3>
                    <p>
                        {{ $project->description }}
                    </p>
                </a>
            </li>
        @endforeach
    </ul>
</x-site-layout>