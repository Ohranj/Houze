@props(['showVar', 'title'])

<div x-cloak x-show="{{ $showVar }}" x-transition.opacity.duration.350ms class="fixed inset-0 z-50 backdrop-blur-sm bg-modal">
    <div class="fixed inset-0"></div>
    <div class="relative flex min-h-screen items-center justify-center p-4">
        <div class="relative min-w-[300px] w-[768px] flex flex-col rounded-lg shadow shadow-lg bg-white border">
            <div class="flex items-center justify-between p-4 sm:p-6">
                <h1 class="text-2xl font-semibold tracking-wide">{{ $title }}</h1>
                <x-svg.close class="w-10 h-10 cursor-pointer" stroke="currentColor" fill="none" call="{{ $showVar }} = false" />
            </div>
            <hr class="text-dark-400">
            {{ $content }}
        </div>
    </div>
</div>