<div class="hidden lg:grid grid-cols-4 items-center border px-4 h-[75px]">
    <div class="flex items-center gap-1.5 w-[50px]" id="c_h_container">
        <image src="storage/houze_icon_thumbnail.png" />
        <h1 class="font-bold text-3xl flex items-end underline underline-offset-4 decoration-4 decoration-indigo-500">Houze</h1>
    </div>
    <div class="col-span-2 justify-center flex items-center gap-2 sm:gap-8">
        <x-link-pill text="We're here to help" url="/" class="hover:shadow-indigo-100 hover:bg-indigo-50 py-1.5 px-3">
            <x-slot name="icon">
                <x-svg.heart class="inline-block w-6 h-6" stroke="#dc2626" fill="#dc2626" />
            </x-slot>
        </x-link-pill>
        <x-link-pill text="Get in touch" url="/" class="hover:shadow-indigo-100 hover:bg-indigo-50 py-1.5 px-3">
            <x-slot name="icon">
                <x-svg.envelope-closed class="inline-block w-6 h-6" stroke="currentColor" fill="none" />
            </x-slot>
        </x-link-pill>
    </div>
    <x-btn-pill text="Get started" call="modals.getStarted.show = true" isFunc="true" class="border shadow-lg hover:shadow-md ml-auto hover:shadow-indigo-100 hover:bg-indigo-50 py-1.5 px-3">
        <x-slot name="icon">
            <x-svg.hand-raised stroke="currentColor" class="inline-block w-6 h-6" fill="none" />
        </x-slot>
    </x-btn-pill>
</div>

<div class="lg:hidden flex flex-col min-h-[75px] relative" x-data="{dropdown: false}">
    <div class="border flex items-center justify-between px-4 min-h-[75px]">
        <div class="flex items-center gap-1.5 w-[50px]" id="c_h_container">
            <image src="storage/houze_icon_thumbnail.png" />
            <h1 class="font-bold text-2xl">Houze</h1>
        </div>
        <x-svg.hamburger class="w-8 h-8 cursor-pointer" stroke="currentColor" fill="none" call="dropdown = true" />
    </div>
    <div x-cloak x-show="dropdown" x-collapse.duration.350ms class="min-h-50px absolute top-[75px] left-0 bg-modal w-full z-10" @click.away="dropdown = false">
        <ul>
            <li class="hover:bg-slate-300 p-4 cursor-pointer">
                <x-svg.heart class="w-6 h-6 inline-block" stroke="#dc2626" fill="#dc2626" />
                We're here to help.
            </li>
            <hr>
            <li class="hover:bg-slate-300 p-4 cursor-pointer">
                <x-svg.envelope-closed class="inline-block w-6 h-6" stroke="currentColor" fill="none" />
                Get in touch.
            </li>
        </ul>
    </div>
</div>