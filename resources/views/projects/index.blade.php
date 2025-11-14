<x-site-layout title='Projects'>
    <ul class="grid gap-10">
        @foreach ($projects as $project)
            <li class="h-full">
                <article class="h-full w-full flex flex-col gap-4 bg-slate-50 p-10 rounded-lg">
                    <a href="/projects/{{ $project->id }}" class="transition">
                        <h3 class="font-bold text-6xl">
                            {{ $project->name }}
                        </h3>
                    </a>
                    <div class="flex flex-col gap-1">
                        <x-author-layout :author="$project->author"></x-author-layout>
                        <p class="text-xs"> {{ \Carbon\Carbon::parse($project->published_at)->format('F j') }}</p>
                    </div>
                    <x-tags-layout :tags="$project->tags"></x-tags-layout>
                    <p>
                        {{ $project->leading }}
                    </p>
                </article>
            </li>
        @endforeach
    </ul>
</x-site-layout>