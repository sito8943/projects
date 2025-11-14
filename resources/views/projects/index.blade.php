<x-site-layout title='Projects'>
    <ul class="grid gap-10">
        @foreach ($projects as $project)
            <li class="h-full">
                <article class="h-full w-full flex flex-col gap-6 bg-slate-50 p-10 rounded-lg">
                    <a href="/projects/{{ $project->id }}" class="transition">
                        <h3 class="font-bold text-6xl">
                            {{ $project->name }}
                        </h3>
                    </a>
                    <x-author-layout :date="$project->published_at" :author="$project->author"></x-author-layout>
                    <x-tags-layout :tags="$project->tags"></x-tags-layout>
                    <p>
                        {{ $project->leading }}
                    </p>
                </article>
            </li>
        @endforeach
    </ul>
</x-site-layout>