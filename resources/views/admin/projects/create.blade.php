<x-app-layout title="Create a new project">
    <x-form-layout method="POST" action="/admin/projects">
        <x-text-input name="name" id="name" label="Name" :value="old('name', '')" placeholder="Ex: Awesome Tool" />

        <x-text-input name="header_image" id="header_image" label="Header Image URL" :value="old('header_image', '')"
            placeholder="https://..." />

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
    </x-form-layout>
</x-app-layout>