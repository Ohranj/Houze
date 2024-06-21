<x-app-layout>
    <div class="w-5/6 mx-auto">
        <small>Welcome {{ $user->username }}!</small>
        <div class="grid grid-rows-3 md:grid-cols-3 gap-8">
            <div class="border row-span-2 md:col-span-2">1</div>
            <div>
                <h1 class="text-center font-semibold text-lg">My Milestones (1 / 4)</h1>
                <div class="space-y-2 mt-4">
                    <div class="border rounded-md p-2 grid grid-cols-5 shadow">
                        <div class="col-span-4 grid grid-rows-3 cursor-move">
                            <small class="text-right">Monday 21st June 2024</small>
                            <p>Took the first step! Created an account on Houze.</p>
                            <div class="flex justify-end gap-2 text-white">
                                <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                                <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center text-ticked cursor-pointer">
                            <x-svg.tick class="w-12 h-12" stroke="currentColor" fill="currentColor" />
                        </div>
                    </div>
                    <div class="border rounded-md p-2 grid grid-cols-5 shadow cursor-move">
                        <div class="col-span-4 grid grid-rows-3">
                            <small class="text-right">-</small>
                            <p>Booked a meeting with a broker.</p>
                            <div class="flex justify-end gap-2 text-white">
                                <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                                <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center cursor-pointer">

                        </div>
                    </div>
                    <div class="border rounded-md p-2 grid grid-cols-5 shadow cursor-move">
                        <div class="col-span-4 grid grid-rows-3">
                            <small class="text-right">-</small>
                            <p>Had an offer accepted.</p>
                            <div class="flex justify-end gap-2 text-white">
                                <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                                <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center cursor-pointer">

                        </div>
                    </div>
                    <div class="border rounded-md p-2 grid grid-cols-5 shadow cursor-move">
                        <div class="col-span-4 grid grid-rows-3">
                            <small class="text-right">-</small>
                            <p>Had a date for exchange confirmed.</p>
                            <div class="flex justify-end gap-2 text-white">
                                <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                                <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center cursor-pointer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>