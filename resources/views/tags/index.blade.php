<x-site-layout title='Project Tags'>

    {{ $tags->links() }}

    <ul class="grid grid-cols-3 grid-rows-1 gap-4">
        @foreach ($tags as $tag)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex items-center justify-between gap-2">
                    <a href="/tags/{{ $tag->id }}" class="">
                        <h3 class="font-bold text-xl hover:text-red-400">
                            {{ $tag->name }}
                        </h3>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</x-site-layout>