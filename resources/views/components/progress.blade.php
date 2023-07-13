@props([
    'value' => 50,
    'max' => 100,
])

@php
    $barProgressColor = match ($value) {
        '1' => ' bg-red-600',
        '2' => ' bg-orange-400',
        '3' => ' bg-yellow-300',
        '4' => ' bg-green-400',
        default => '',
    }
@endphp

<div {{ $attributes->merge(['class' => 'h-4 bg-gray-200 dark:bg-gray-600']) }}>
    <div class="h-4{{ $barProgressColor }}" style="width: {{ 100 * $value/$max }}%"></div>
</div>
