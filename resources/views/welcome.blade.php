<x-guest-layout>
    @section('js')
    @vite(['resources/js/graphicHome.js'])
    @endsection

    <x-slot name="main">
        <div x-data="welcome">
            <div class="flex justify-center" id="graphic"></div>
            <x-btn-pill text="Sign in with Google" class="hover:bg-indigo-50 mx-auto" isFunc="false">
                <x-slot name="icon">
                    <x-svg.google class="w-6 h-6" />
                </x-slot>
            </x-btn-pill>
        </div>
    </x-slot>
</x-guest-layout>

<script>
    const welcome = () => ({
        init() {
            console.log(1)
        }
    })
</script>