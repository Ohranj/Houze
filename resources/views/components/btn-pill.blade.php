@props([ 'text', 'call' => null, 'isFunc' => true ])

@if ($isFunc)

<button {{ $attributes->merge(['class' => 'rounded-full shadow font-medium flex items-center gap-1.5']) }} @click="{{ $call }}">
    {{ $icon }}
    <span>{{ $text }}</span>
</button>

@else

<button {{ $attributes->merge(['class' => 'rounded-full shadow font-medium flex items-center gap-1.5']) }}>
    {{ $icon }}
    <span>{{ $text }}</span>
</button>

@endif