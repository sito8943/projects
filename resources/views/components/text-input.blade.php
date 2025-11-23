<div class="flex flex-col gap-4 items-start justify-start w-full">
    <label for="{{ $attributes->get('name') }}">{{ $label }}</label>
    <input @class([
        'border-2 rounded-3xl px-4 py-1 w-full',
        'border-red-400' => $errors->has($attributes->get('name')),
        'border-gray-200' => !$errors->has($attributes->get('name')),
    ]) {{ $attributes }} />
    @error($attributes->get('name'))
        <p class="text-red-400">{{ $message }}</p>
    @enderror
</div>