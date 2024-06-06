@props([ 'text', 'call' => null, 'isFunc' => true ])

@if ($isFunc)

<button {{ $attributes->merge(['class' => 'rounded-full py-1 px-2 shadow font-medium flex items-center gap-2']) }} @click="{{ $call }}">
    {{ $icon }}
    <span>{{ $text }}</span>
</button>

@else

<button {{ $attributes->merge(['class' => 'rounded-full py-1 px-2 shadow font-medium flex items-center gap-2']) }}>
    {{ $icon }}
    <span>{{ $text }}</span>
</button>

@endif