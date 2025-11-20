<x-app-layout title='Edit project with Id: {{ $project->id }}'>
    <x-form-layout method="PUT" action="/admin/projects/{{ $project->id }}" enctype="multipart/form-data"
        contentClass="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="flex flex-col gap-6 md:gap-10 w-full md:w-1/2">
            <x-text-input name="name" id="name" label="Name" :value="old('name', $project->name)"
                placeholder="Ex: Awesome Tool" />

            <x-text-area-input name="leading" id="leading" label="Leading" :value="old('leading', $project->leading ?? '')"
                placeholder="Short intro" />

            <x-text-area-input name="content" id="content" label="Content" :value="old('content', $project->content ?? '')"
                placeholder="Longer content" :rows="10" />

            <div class="flex gap-4 items-center justify-start">
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id" class="border-2 border-gray-200 rounded-3xl px-4 py-1">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('author_id', $project->author_id) == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->is_published))>
                <span>Published</span>
            </label>

            <div class="flex items-center gap-2 flex-wrap">
                <label for="published_at">Published at</label>
                <input id="published_at" name="published_at" type="datetime-local"
                    class="border-2 border-gray-200 rounded-3xl px-4 py-1 w-full md:w-auto"
                    value="{{ old('published_at', $project->published_at) }}" />
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <label>
                <span>
                    Header image (click to change)
                </span>

                <input class="invisible" id="header_image" type="file" name="header_image" />

                @if ($project->header_image_path)
                    <img class="object-cover w-full max-h-96 rounded-lg border border-gray-200 mt-2"
                        id="header_image_preview" name="header_image_preview" src="/{{ $project->header_image_path }}" />
                @endif
            </label>

            <script>
                document.getElementById('header_image').addEventListener('change', function (event) {
                    const preview = document.getElementById('header_image_preview');
                    const file = event.target.files[0];

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                    } else {
                        preview.src = "{{ $project->header_image_path ?? '' }}";
                    }
                });
            </script>
        </div>
    </x-form-layout>
</x-app-layout>
