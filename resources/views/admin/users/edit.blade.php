<x-app-layout title='Edit user with Id: {{ $user->id }}'>
    <x-form method="PUT" action="/admin/users/{{ $user->id }}" enctype="multipart/form-data"
        contentClass="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="flex flex-col gap-6 md:gap-10 w-full md:w-1/2">
            <x-text-input required name="name" id="name" label="Name" :value="old('name', $user->name)"
                placeholder="Jane Doe" />

            <x-text-input required name="email" id="email" label="Email" :value="old('email', $user->email)"
                placeholder="jane@example.com" />

            <x-text-input name="password" id="password" label="Password (leave blank to keep)"
                :value="old('password', '')" />

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_admin" value="1"
                    @checked(old('is_admin', $user->is_admin ?? false))>
                <span>Admin</span>
            </label>
        </div>
        <div class="w-full md:w-1/2">
            <x-image-input name="avatar" id="avatar" label="Avatar" :preview="$user->media->first()?->getUrl() ?? ''" />
            @error('avatar')
                <p class="text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </x-form>
</x-app-layout>
