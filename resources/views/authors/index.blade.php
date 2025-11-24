<x-site-layout title="Authors" :showSidebar="false">
    <div class="w-full border-slate-100 border rounded pl-4 top-16 sticky bg-white">
        {{ $authors->links() }}
    </div>
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight mt-2">
        Authors
    </h2>
    <ul class="grid gap-6 mt-5">
        @foreach ($authors as $author)
            <li>
                <div
                    class="p-4 border border-slate-100 rounded-lg shadow-sm hover:shadow transition-shadow flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <x-media-image :model="$author" class="w-12 h-12 rounded-full object-cover bg-gray-300"
                            :alt="$author->name" />
                        <div class="flex flex-col">
                            <a href="/authors/{{ $author->id }}"
                                class="font-semibold text-lg hover:text-red-500 transition">{{ $author->name }}</a>
                            <h3 class="text-sm text-gray-600">{{ $author->projects_count }} projects</>
                        </div>
                    </div>

                    <ul class="grid grid-cols-3 gap-3">
                        @foreach ($author->projects as $project)
                            <li>
                                <a href="/projects/{{ $project->id }}" class="group flex flex-col gap-1">
                                    <x-media-image :model="$project" conversion="preview"
                                        class="w-full aspect-video rounded-md object-cover bg-gray-200" :alt="$project->name" />
                                    <h4
                                        class="text-lg line-clamp-2 group-hover:text-red-500 transition">{{ $project->name }}</h4>
                                    <p
                                        class="text-xs line-clamp-2 group-hover:text-red-500 transition">{{ $project->leading }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</x-site-layout>