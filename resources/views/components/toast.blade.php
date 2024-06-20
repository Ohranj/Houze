<template x-for="toast in $store.toast.list">
    <template x-teleport="#c_alerts">
        <div class="border bg-white shadow shadow-xl min-w-[275px] max-w-[425px] z-[60] rounded-md grid grid-cols-12 items-center text-sm p-1.5 mt-1.5 relative overflow-hidden">
            <span class="w-6 h-6 absolute -top-2 -right-2 rounded-full" :class="toast.success ? 'bg-green-500' : 'bg-red-500'"></span>
            <div class="col-span-2 mx-auto">
                <template x-if="toast.success">
                    <x-svg.bell class="w-6 h-6" stroke="currentColor" fill="green" />
                </template>
                <template x-if="!toast.success">
                    <x-svg.bell class="w-6 h-6" stroke="currentColor" fill="red" />
                </template>
            </div>
            <div class="col-span-10 flex flex-col gap-0.5">
                <p class="font-semibold">Heads up.</p>
                <small x-text="toast.msg"></small>
            </div>
        </div>
    </template>
</template>