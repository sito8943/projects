<x-app-layout title="Create a new user">
    <x-form method="POST" action="/admin/users" enctype="multipart/form-data"
        contentClass="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="flex flex-col gap-6 md:gap-10 w-full md:w-1/2">
            <x-text-input required name="name" id="name" label="Name" :value="old('name', '')"
                placeholder="Jane Doe" />

            <x-text-input required name="email" id="email" label="Email" :value="old('email', '')"
                placeholder="jane@example.com" />

            <x-text-input required name="password" id="password" label="Password" :value="old('password', '')" />

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin', false))>
                <span>Admin</span>
            </label>
        </div>

        <div class="w-full md:w-1/2">
            <x-image-input name="avatar" id="avatar" label="Avatar" />
        </div>
    </x-form>
</x-app-layout>
