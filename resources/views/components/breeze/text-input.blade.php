@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 rounded-3xl px-4 py-1 w-full border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-3xl shadow-xs px-4 py-1']) }}>
