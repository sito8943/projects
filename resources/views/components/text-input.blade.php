<div class="flex flex-col gap-4 items-start justify-start w-full">
    <label for="{{ $name }}">{{ $label }} @if ($required)
        *
    @endif </label>
    <input @class([
        'border-2 rounded-3xl px-4 py-1 w-full',
        'border-red-400' => $errors->has($name),
        'border-gray-200' => !$errors->has($name),
    ]) id="{{ $id ?: $name }}" name="{{ $name }}" type="{{ $type ?? 'text' }}" value="{{ $value }}"
        @if($required) required @endif placeholder="{{ $placeholder }}" @if($disabled) disabled @endif />
    @error($name)
        <p class="text-red-400">{{ $message }}</p>
    @enderror
</div>
