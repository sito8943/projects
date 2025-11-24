<ul class="flex flex-wrap @if ($orientation == 'vertical') flex-col @else items-center justify-start @endif gap-2">
    @if ($tags->count() > 0)
        @foreach ($tags as $tag)
            <li>
                <a href="{{ $admin ? url('admin/tags/' . $tag->id . '/edit') : url('/projects?tag=' . $tag->id) }}"
                            style=" --tag-color: {{ $tag->color }};"
                    class="group inline-flex items-center rounded px-2 py-1 text-xs border border-gray-300 transition-colors hover:bg-[var(--tag-color)]/20 hover:border-[var(--tag-color)] hover:text-[var(--tag-color)]">
                    <span class="text-[var(--tag-color)] mr-1">#</span>{{ $tag->name }}
                </a>
            </li>
        @endforeach
    @else
        <p class="text-xs italic text-gray-400">
            No tags
        </p>
    @endif

</ul>