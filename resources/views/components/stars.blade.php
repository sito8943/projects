<div {{ $attributes->merge(['class' => 'text-yellow-600']) }}>
    @for ($i = 1; $i <= $max; $i++)
        {{ $i <= ($displayValue ?? 0) ? '★' : '☆' }}
    @endfor
    @if (!empty($withCount) && isset($count))
        <span class="ml-1">({{ $count }})</span>
    @endif
</div>
