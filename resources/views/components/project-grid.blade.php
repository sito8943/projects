@if (filled($projects) && count($projects))
    <section class="w-full">
        @if ($title)
            <h4 class="text-xl font-semibold mb-4">{{ $title }}</h4>
        @endif
        <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <li class="h-full">
                    <article class="h-full w-full flex flex-col gap-3 border border-slate-100 shadow-sm p-4 rounded-lg">
                        <a href="{{ route('projects.show', $project->id) }}" class="flex flex-col gap-2">
                            <x-media-image :model="$project" conversion="preview"
                                class="aspect-video w-full object-cover rounded-md" />
                            <h5 class="font-semibold text-lg line-clamp-2">{{ $project->name }}</h5>
                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                <x-stars :for="$project" with-count />
                            </div>
                            @if ($showAuthors)
                                <x-author :author="$project->author" :date="$project->published_at" />
                            @endif
                            <p class="text-xs">
                                {{ $project->leading }}
                            </p>
                        </a>
                    </article>
                </li>
            @endforeach
        </ul>
    </section>
@endif
