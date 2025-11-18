<x-app-layout title='All Projects' action="/admin/projects/create" button="New Project">
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex items-center justify-between gap-2">
                    <div>
                        <h3 class="font-bold text-lg">{{ $project->name }}</h3>
                        @if ($project->author)
                            <p class="text-sm text-gray-600">by {{ $project->author->name }}</p>
                        @endif
                    </div>
                    <ul class="flex gap-4 items-center justify-end">
                        <a href="/admin/projects/{{ $project->id }}/edit" class="hover:text-red-400" title="Edit">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="/admin/projects/{{ $project->id }}" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer" title="Delete">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>

