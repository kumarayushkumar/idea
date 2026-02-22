@props([
    'status' => 'pending',
])

@php
    $classes = 'inline-block rounded-full border px-2 py-1 font-medium text-[10px] ';

    if ($status === 'pending') {
        $classes .= 'bg-amber-800/50 text-amber-300/90 border-amber-400/50';
    }

    if ($status === 'in_progress') {
        $classes .= 'bg-blue-800/50 text-blue-300/90 border-blue-400/50';
    }

    if ($status === 'completed') {
        $classes .= 'bg-green-800/50 text-green-300/90 border-green-400/50';
    }

@endphp

<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>
