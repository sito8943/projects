<p class="italic">
    @if ($showLabel)
        Publish by
    @endif
    <a href="/authors/{{ $author->id }}" class="transition text-red-400 hover:text-red-300">
        {{ $author->name }}
    </a>
</p>