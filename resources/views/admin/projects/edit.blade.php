<x-app-layout title='Edit project with Id: {{ $project->id }}'>
    <x-form-layout method="PUT" action="/admin/projects/{{ $project->id }}">
        <x-text-input name="name" id="name" label="Name" :value="old('name', $project->name)" placeholder="Ex: Awesome Tool" />

        <x-text-input name="header_image" id="header_image" label="Header Image URL" :value="old('header_image', $project->header_image)"
            placeholder="https://..." />

        <div class="flex gap-4 items-start justify-start">
            <label for="leading" class="pt-2">Leading</label>
            <textarea id="leading" name="leading" class="border-2 border-gray-200 rounded-3xl px-4 py-2 w-full" rows="2" placeholder="Short intro">{{ old('leading', $project->leading) }}</textarea>
        </div>

        <div class="flex gap-4 items-start justify-start">
            <label for="description" class="pt-2">Description</label>
            <textarea id="description" name="description" class="border-2 border-gray-200 rounded-3xl px-4 py-2 w-full" rows="5" placeholder="Longer description">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="flex gap-4 items-center justify-start">
            <label for="author_id">Author</label>
            <select id="author_id" name="author_id" class="border-2 border-gray-200 rounded-3xl px-4 py-1">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('author_id', $project->author_id) == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-6 items-center justify-start">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->is_published))>
                <span>Published</span>
            </label>
            <div class="flex items-center gap-2">
                <label for="published_at">Published at</label>
                <input id="published_at" name="published_at" type="datetime-local" class="border-2 border-gray-200 rounded-3xl px-4 py-1"
                    value="{{ old('published_at') }}" />
            </div>
        </div>
    </x-form-layout>
</x-app-layout>
