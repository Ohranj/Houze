@props([ 'text' => null, 'url' => null ])

<a href="{{ $url }}" {{ $attributes->merge(['class' => 'shadow font-medium rounded-full flex items-center gap-1.5']) }}>
    {{ $icon }}
    {{ $text }}
</a>