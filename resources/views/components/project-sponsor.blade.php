<section class="w-full flex ">
    <div
        class="rounded-3xl bg-blue-50 border border-blue-100 p-8 sm:p-12 text-center flex flex-col items-center justify-center w-full">
        <h3 class="text-3xl sm:text-4xl font-extrabold">Don't be afraid to be a sponsor</h3>

        <p class="mt-4">
            If you find this project useful, consider sponsoring it to support its development and maintenance.
        </p>

        <form id="sponsor-form" action="{{ route('projects.sponsor', ['project' => $project]) }}"
            class="mt-4 flex items-center justify-center gap-2 scroll-mt-24">
            <x-breeze.text-input type="text" name="amount" value="5" placeholder="Amount (euro)"
                class="w-32 text-center" />

            <button type="submit"
                class="rounded-3xl px-6 py-2 bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-500 flex items-center justify-center transition">
                Submit
            </button>
        </form>

        @if (request()->has('purchase') && !empty($activePurchase))
            <div class="mt-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-3 inline-block">
                Thank you for sponsoring this project! Your support helps us create more great content.
            </div>
        @endif

        @if(isset($sponsors) && $sponsors->isNotEmpty())
            <p class="mt-6 text-gray-700">Already sponsoring</p>
            <div class="mt-3 flex items-center gap-2 flex-wrap justify-center">
                @foreach($sponsors as $sponsor)
                    <div
                        class="inline-flex items-center gap-2 border border-green-200 text-green-700 bg-green-50 rounded-full px-3 py-1">
                        <x-media-image :model="$sponsor" class="w-6 h-6 rounded-full object-cover bg-gray-400"
                            :alt="$sponsor->name" />
                        <span class="text-xs font-medium">{{ $sponsor->name }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>