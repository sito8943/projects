<div class="flex gap-4 items-center justify-start">
    <img loading="lazy" src={{ $author->avatar }} alt={{ $author->name }} class="w-10 h-10 rounded-full bg-gray-400" />
    <div class="flex flex-col gap-1">
        <p class="text-sm">
            @if ($showLabel)
                Publish by
            @endif
            <a href="/authors/{{ $author->id }}" class="transition text-red-400 hover:text-red-300">
                {{ $author->name }}
            </a>
        </p>
        <p class="text-xs"> {{ \Carbon\Carbon::parse($date)->format('F j') }}</p>
    </div>
</div>