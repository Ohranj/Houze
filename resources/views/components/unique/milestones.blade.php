<div x-data="milestones">
    <h1 class="text-center font-semibold text-lg">My Milestones (1 / 4)</h1>
    <div class="space-y-2 mt-4" @dragenter.prevent="" @dragover.prevent="" @drop="handleDrop($el)">
        <div class="rounded-lg p-2 grid grid-cols-5 border shadow shadow-slate-600 bg-slate-600 text-white transition-all ease-in-out">
            <div class="col-span-4 flex flex-col gap-2">
                <small class="text-right">Monday 21st June 2024</small>
                <p class="font-medium text-sm md:text-base">Took the first step! Created an account on Houze.</p>
                <div class="flex justify-end gap-2">
                    <button class="rounded-md px-2 py-0.5 bg-red-500" disabled>Delete</button>
                    <button class="rounded-md px-2 py-0.5 bg-indigo-500" disabled>Update</button>
                </div>
            </div>
            <div class="flex items-center justify-center text-white">
                <x-svg.tick class="w-14 h-14" stroke="currentColor" fill="none" />
            </div>
        </div>
        <div class="rounded-lg p-2 grid grid-cols-5 border shadow shadow-slate-600 bg-slate-600 text-white transition-all ease-in-out" draggable="true" @dragStart="handleDragStart($el)" @dragEnd="handleDragEnd()">
            <div class="col-span-4 flex flex-col gap-2 cursor-move">
                <small class="text-right"></small>
                <p class="font-medium text-sm md:text-base">Booked a meeting with a broker.</p>
                <div class="flex justify-end gap-2">
                    <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                    <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                </div>
            </div>
            <div class="flex items-center justify-center cursor-pointer"></div>
        </div>
        <div class="rounded-lg p-2 grid grid-cols-5 border shadow shadow-slate-600 bg-slate-600 text-white transition-all ease-in-out" draggable="true" @dragStart="handleDragStart($el)" @dragEnd="handleDragEnd()">
            <div class="col-span-4 flex flex-col gap-2 cursor-move">
                <small class="text-right"></small>
                <p class="font-medium text-sm md:text-base">Offer accepted.</p>
                <div class="flex justify-end gap-2">
                    <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                    <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                </div>
            </div>
            <div class="flex items-center justify-center cursor-pointer"></div>
        </div>
        <div class="rounded-lg p-2 grid grid-cols-5 border shadow shadow-slate-600 bg-slate-600 text-white transition-all ease-in-out" draggable="true" @dragStart="handleDragStart($el)" @dragEnd="handleDragEnd()">
            <div class="col-span-4 flex flex-col gap-2 cursor-move">
                <small class="text-right"></small>
                <p class="font-medium text-sm md:text-base">Date for exchange confirmed.</p>
                <div class="flex justify-end gap-2">
                    <button class="rounded-md px-2 py-0.5 bg-red-500">Delete</button>
                    <button class="rounded-md px-2 py-0.5 bg-indigo-500">Update</button>
                </div>
            </div>
            <div class="flex items-center justify-center cursor-pointer"></div>
        </div>
    </div>
    <div class="pt-4">
        <small class="text-right block">Characters remaining - <span x-text="125 - toCreate.length"></span></small>
        <textarea class="w-full rounded-lg" rows="2" placeholder="Create a new milestone..." x-model="toCreate" maxlength="125"></textarea>
        <x-btn-pill text="Create" class="py-1.5 px-3 ml-auto shadow-indigo-600 bg-indigo-500 hover:bg-indigo-600 text-white" isFunc="false">
            <x-slot name="icon">
                <x-svg.thumbs-up class="w-6 h-6" stroke="currentColor" fill="none" />
            </x-slot>
        </x-btn-pill>
    </div>
</div>

<script>
    const milestones = () => ({
        toCreate: '',
        dragItem: null,
        handleDragStart(elem) {
            this.dragItem = elem;
            this.dragItem.classList.add('opacity-0')
        },
        handleDragEnd() {
            this.dragItem.classList.remove('opacity-0')
        },
        handleDrop(elem) {
            elem.append(this.dragItem)
        }
    })
</script>