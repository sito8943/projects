<x-site-layout title='Project Tags'>
    <ul class="grid grid-cols-3 grid-rows-1 gap-4">
        @foreach ($tags as $tag)
            <li class="h-full">
                <a href="/tags/{{ $tag->id }}" class="bg-gray-200 rounded-lg h-full p-4 flex flex-col gap-2">
                    <h3 class="font-bold text-xl">
                        {{ $tag->name }}
                    </h3>
                </a>
            </li>
        @endforeach
    </ul>
</x-site-layout>