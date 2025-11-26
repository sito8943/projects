<x-app-layout title='All Reviews'>

    <div class="w-full pl-4 top-32 sticky bg-gray-100">
        {{ $reviews->links() }}
    </div>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($reviews as $review)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex flex-col items-start justify-between gap-2">
                    <x-admin.actions class="w-full">
                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="hover:text-red-400" title="Edit">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer" title="Delete">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </x-admin.actions>
                    <div class="flex flex-col items-start justify-start h-full w-full">
                        <div class="text-yellow-600">
                            @php $full = (int) $review->stars; @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $full)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <p class="mt-5 text-sm text-gray-600">by <strong>{{ $review->author->name }}</strong> on
                            <strong>{{ $review->project->name }}</strong>
                        </p>
                        <p class="mt-2 text-gray-800 line-clamp-3">{{ $review->comment }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>