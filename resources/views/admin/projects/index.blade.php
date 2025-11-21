<x-app-layout title='All Projects' action="/admin/projects/create" button="New Project">

    {{ $projects->links() }}

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex flex-col items-start justify-between gap-2">
                    <ul class="flex gap-4 items-center justify-end w-full">
                        <a href="/admin/projects/{{ $project->id }}/toggle-is-published" class="hover:text-red-400"
                            title="@if ($project->is_published) 'Unpublish' @else 'Publish' @endif">
                            @if ($project->is_published)
                                <x-fas-close class="w-4 h-4" />
                            @else
                                <x-fas-check class="w-4 h-4" />
                            @endif
                        </a>
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
                    <div class="flex flex-col items-start justify-start h-full w-full">
                        <h3 class="font-bold text-lg">{{ $project->name }}</h3>
                        <p class="text-sm text-gray-600">by {{ $project->author->name }}</p>

                        <div class="flex flex-col gap-1 mt-2">
                            <h4>
                                Tags
                            </h4>
                            <x-tags :tags="$project->tags" />
                        </div>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>