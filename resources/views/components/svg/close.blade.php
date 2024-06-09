@props(['call'])

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" {{ $attributes->merge(['class', 'stroke', 'fill']) }} @click="{{ $call }}">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>