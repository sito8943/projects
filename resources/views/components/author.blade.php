<div class="flex gap-4 items-center justify-start">
    <x-media-image :model="$author" class="w-10 h-10 rounded-full object-cover bg-gray-400" :alt="$author->name" />
    <div class="flex flex-col gap-1">
        <p class="text-sm">
            @if ($showLabel)
                Published by
            @endif
            <span class="transition">
                {{ $author->name }}
            </span>
        </p>
        <p class="text-xs"> {{ \Carbon\Carbon::parse($date)->format('F j') }}</p>
    </div>
</div>
