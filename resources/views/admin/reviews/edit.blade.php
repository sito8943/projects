<x-app-layout title='Edit review with Id: {{ $review->id }}'>
    <x-form method="PUT" action="/admin/reviews/{{ $review->id }}"
        contentClass="flex flex-col gap-6 md:gap-10 w-full md:w-2/3">
        <div class="flex flex-col gap-6">
            <x-text-input type="number" min="1" max="5" name="stars" id="stars" label="Stars" :value="old('stars', $review->stars)" placeholder="1-5" />

            <x-text-area-input name="comment" id="comment" label="Comment" :value="old('comment', $review->comment)"
                placeholder="Your thoughts..." :rows="6" />
        </div>
    </x-form>
</x-app-layout>