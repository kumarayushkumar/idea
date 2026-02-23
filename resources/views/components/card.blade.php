@props(['is' => 'a'])

<{{ $is }} {{ $attributes(['class' => 'order border-border rounded-lg bg-card p-4 md:text-sm block']) }}>
    {{ $slot }}
</{{ $is }}>
