<x-project-layout title="Project details" :showSidebar="false">
    <div class="flex flex-col gap-10 items-start justify-start">
        <x-media-image :model="$project" conversion="website"
            class="aspect-video w-full h-80 object-cover rounded-lg" />
        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">{{ $project->name }}</h3>
        <x-author :author="$project->author" :date="$project->published_at"></x-author>
        <x-tags :tags="$project->tags"></x-tags>
        <p class="text-sm sm:text-base">
            {{ $project->content }}
        </p>

        <section class="w-full flex flex-col gap-6">
            <h4 class="text-xl font-semibold">Reviews</h4>

            @auth
                @if (auth()->id() !== $project->author_id)
                    <form method="POST" action="{{ route('projects.reviews.store', $project->id) }}"
                        class="flex flex-col gap-3 border border-slate-200 rounded-lg p-4">
                        @csrf
                        <div>
                            <label for="stars" class="block text-sm font-medium">Rating</label>
                            <select id="stars" name="stars" class="mt-1 block w-24 rounded border border-gray-300 p-1 text-sm">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}">{{ $i }} {{ \Illuminate\Support\Str::plural('star', $i) }}</option>
                                @endfor
                            </select>
                            @error('stars')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="comment" class="block text-sm font-medium">Comment (optional)</label>
                            <textarea id="comment" name="comment" rows="3"
                                class="mt-1 block w-full rounded border border-gray-300 p-2 text-sm"
                                placeholder="Write your thoughts..."></textarea>
                            @error('comment')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="rounded-xl px-3 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600">Submit
                                review</button>
                        </div>
                    </form>
                @endif
            @endauth

            @if (session('status'))
                <div class="text-sm text-green-700 bg-green-50 border border-green-200 rounded p-3">
                    {{ session('status') }}
                </div>
            @endif

            <ul class="flex flex-col gap-4" id="reviews">
                @forelse ($project->reviews as $review)
                    <li class="border border-slate-100 rounded-lg p-4 flex gap-4">
                        <x-media-image :model="$review->author" class="w-10 h-10 rounded-full object-cover bg-gray-300"
                            :alt="$review->author->name" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium">{{ $review->author->name }}</span>
                                <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-yellow-500">
                                @php $full = (int) $review->stars; @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $full)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            @if ($review->comment)
                                <p class="text-sm mt-1">{{ $review->comment }}</p>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="text-sm text-gray-600">No reviews yet.</li>
                @endforelse
            </ul>
        </section>

        @if ($authorProjects->isNotEmpty())
            <x-project-grid :projects="$authorProjects" :title="'Also from ' . $project->author->name" />
        @endif

        @if ($tag && $tagProjects->isNotEmpty())
            <x-project-grid :projects="$tagProjects" :title="'Similar projects'" show />
        @endif
    </div>
</x-project-layout>
