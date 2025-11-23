@php($inputId = $id !== '' ? $id : $name)
<div class="flex flex-col gap-2 w-full">
    <label for="{{ $inputId }}" class="font-medium">{{ $label }}
        <input class="hidden" id="{{ $inputId }}" type="file" accept="image/*" name="{{ $name }}"
            accept="{{ $accept }}" />
    </label>



    <label for="{{ $inputId }}"
        class="relative border-2 border-dashed rounded-lg w-full aspect-video flex items-center justify-center cursor-pointer bg-white/40 hover:bg-white transition group overflow-hidden">
        <div class="pointer-events-none flex flex-col items-center justify-center text-gray-500 group-hover:text-red-400 transition absolute inset-0"
            id="{{ $inputId }}_placeholder" @class(['hidden' => !empty($preview)])>
            <x-fas-plus class="w-8 h-8 mb-2" />
            <span>Click to upload</span>
        </div>

        <img id="{{ $inputId }}_preview" alt="Preview"
            class="object-cover w-full h-full @if (empty($preview)) hidden @endif" src="{{ $preview }}" />
    </label>

    @error($name)
        <p class="text-red-400">{{ $message }}</p>
    @enderror

    <script>
        (function () {
            const input = document.getElementById('{{ $inputId }}');
            const img = document.getElementById('{{ $inputId }}_preview');
            const placeholder = document.getElementById('{{ $inputId }}_placeholder');
            if (!input || !img || !placeholder) return;

            input.addEventListener('change', function (event) {
                const file = event.target.files && event.target.files[0];
                if (file) {
                    img.src = URL.createObjectURL(file);
                    img.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                } else {
                    img.src = '';
                    img.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                }
            });
        })();
    </script>
</div>