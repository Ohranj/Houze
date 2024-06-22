<x-app-layout>
    <div class="w-5/6 mx-auto" x-data="dashboard">
        <small>Welcome {{ $user->username }}!</small>
        <div class="grid grid-rows-3 md:grid-cols-3 gap-8">
            <div class="border row-span-2 md:col-span-2">1</div>
            <x-unique.milestones />
        </div>
    </div>

    <script>
        const dashboard = () => ({
            init() {
                console.log(2)
            }
        })
    </script>
</x-app-layout>