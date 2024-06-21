<div class="grid grid-cols-4 items-center border px-4 h-[75px]">
    <div class="hidden md:flex items-center gap-1.5 w-[50px]" id="c_h_container">
        <image src="storage/houze_icon_thumbnail.png" />
        <h1 class="font-bold text-3xl flex items-end underline underline-offset-4 decoration-4 decoration-indigo-500">Houze</h1>
    </div>
    <div class="col-span-3 md:col-span-2 md:justify-center flex items-center gap-2 sm:gap-8 font-semibold text-2xl">
        <h1>Dashboard</h1>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-btn-pill text="Logout" call="null" isFunc="false" class="border shadow-lg hover:shadow-md ml-auto hover:shadow-indigo-100 hover:bg-indigo-50 py-1.5 px-3">
            <x-slot name="icon">
                <x-svg.logout stroke="currentColor" class="inline-block w-6 h-6 rotate-180" fill="none" />
            </x-slot>
        </x-btn-pill>
    </form>
</div>