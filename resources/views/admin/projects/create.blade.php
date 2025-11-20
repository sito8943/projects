<x-app-layout title="Create a new project">
    <x-form-layout method="POST" action="/admin/projects" enctype="multipart/form-data"
        contentClass="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="flex flex-col gap-6 md:gap-10 w-full md:w-1/2">
            <x-text-input required name="name" id="name" label="Name" :value="old('name', '')" placeholder="Ex: Awesome Tool" />

            <x-text-area-input name="leading" id="leading" label="Leading" :value="old('leading', '')"
                placeholder="Short intro" />

            <x-text-area-input name="content" id="content" label="Content" :value="old('content', '')"
                placeholder="Longer content" :rows="10" />

            <div class="flex gap-4 items-center justify-start">
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id" class="border-2 border-gray-200 rounded-3xl px-4 py-1">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('author_id') == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="w-full md:w-1/2">
            <label>
                <span>
                    Header image (click to change)
                </span>

                <input class="invisible" id="header_image" type="file" name="header_image" />

                <img class="object-cover w-full max-h-96 rounded-lg border border-gray-200 mt-2 hidden"
                    id="header_image_preview" alt="Header image preview" />
            </label>

            <script>
                document.getElementById('header_image').addEventListener('change', function (event) {
                    const preview = document.getElementById('header_image_preview');
                    const file = event.target.files[0];

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove('hidden');
                    } else {
                        preview.src = '';
                        preview.classList.add('hidden');
                    }
                });
            </script>
        </div>
    </x-form-layout>
</x-app-layout>
