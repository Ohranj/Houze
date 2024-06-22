<x-app-layout>
    <div class="w-5/6 mx-auto" x-data="dashboard({ csrfToken: '{{ csrf_token() }}' })">
        <small class="font-semibold">Welcome {{ $user->username }}!</small>
        <div class="grid grid-rows-3 xl:grid-cols-3 gap-8">
            <div class="border row-span-2 xl:col-span-2">1</div>
            <x-unique.milestones />
        </div>

        <x-modal showVar=modals.milestone.update.show title="Update Milestone">
            <x-slot:content>
                <div class="p-4 sm:p-6 space-y-8">
                    <h2 class="text-xl">Use the form below to easily update your milestone.</h2>
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between items-center">
                                <label class="font-semibold">Milestone</label>
                                <small>Characters remaining - <span x-text="125 - modals.milestone.update.milestone?.text?.length"></span></small>
                            </div>
                            <textarea class="w-full rounded-lg" placeholder="Update your milestone..." :value="modals.milestone.update.milestone?.text" @input="modals.milestone.update.milestone.text = $el.value" maxlength="125"></textarea>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="font-semibold">Mark completed</p>
                            <div class="relative cursor-pointer" @click="modals.milestone.update.milestone.complete = !modals.milestone.update.milestone.complete;">
                                <input type="checkbox" class="sr-only" :checked="!modals.milestone.update.milestone?.complete">
                                <div class="block w-10 h-6 rounded-full" :class="modals.milestone.update.milestone?.complete ? 'bg-green-500' : 'bg-red-500'"></div>
                                <div class="bg-white absolute left-1 top-1 w-4 h-4 rounded-full transition duration-[650ms]" :class="modals.milestone.update.milestone?.complete ? 'translate-x-4' : ''"></div>
                            </div>
                        </div>
                        <div x-cloak x-show="modals.milestone.update.milestone?.complete" x-transition.duration.750ms.opacity class="flex flex-col w-fit">
                            <label class="font-semibold">Set completed on date</label>
                            <input type="date" class="rounded-md py-0.5 px-2" :value="modals.milestone.update.milestone?.completed ? modals.milestone.update.milestone.completed : new Date().toISOString().toString().substr(0, 10)" @change="modals.milestone.update.milestone.completed = $el.value" />
                        </div>
                        <x-btn-pill text="Confirm" class="py-1.5 px-3 ml-auto shadow-indigo-600 bg-indigo-500 hover:bg-indigo-600 text-white" isFunc="true" call="updateMilestoneConfirmed">
                            <x-slot name="icon">
                                <x-svg.thumbs-up class="w-6 h-6" stroke="currentColor" fill="none" />
                            </x-slot>
                        </x-btn-pill>
                    </div>
                </div>
            </x-slot:content>
        </x-modal>
        <x-modal showVar=modals.milestone.delete.show title="Delete Milestone">
            <x-slot:content>
                <div class="p-4 sm:p-6 space-y-8">
                    <p class="text-lg text-center">Are you sure you would like to delete the following milestone? This milestone can not be restored. Close this modal if you don't wish to proceed.</p>
                    <div class="space-y-4">
                        <ul class="space-y-2">
                            <li>
                                <x-svg.flag class="w-6 h-6 inline-block" stroke="currentColor" fill="none" />
                                <span x-text="modals.milestone.delete.milestone?.text"></span>
                            </li>
                            <li x-cloak x-show="modals.milestone.delete.milestone?.completed">
                                <x-svg.tick class="w-6 h-6 inline-block" stroke="currentColor" fill="none" />
                                <span x-text="modals.milestone.delete.milestone?.human_completed"></span>
                            </li>
                            <li class="text-right"><span>Added: </span><span x-text="modals.milestone.delete.milestone?.human_created"></span></li>
                        </ul>
                    </div>
                    <x-btn-pill text="Confirm" class="py-1.5 px-3 mx-auto shadow-red-600 bg-red-500 hover:bg-red-600 text-white" isFunc="true" call="deleteMilestoneConfirmed">
                        <x-slot name="icon">
                            <x-svg.thumbs-up class="w-6 h-6" stroke="currentColor" fill="none" />
                        </x-slot>
                    </x-btn-pill>
                </div>
            </x-slot:content>
        </x-modal>

        <x-toast />
    </div>

    <script>
        const dashboard = (e) => ({
            data: {
                milestones: {
                    list: [],
                    completedCount: 1
                }
            },
            modals: {
                milestone: {
                    update: {
                        show: false,
                        milestone: null
                    },
                    delete: {
                        show: false,
                        milestone: null
                    }
                }
            },
            init() {
                this.retrieveMilestones();
            },
            async retrieveMilestones() {
                const response = await fetch('/milestones');
                this.data.milestones.list.length = 0;
                const json = await response.json();
                this.data.milestones.list = json.data.milestones;
                this.data.milestones.completedCount = json.data.completedCount
            },
            async milestonesReordered(order) {
                const response = await fetch('refresh-milestones-order', {
                    method: 'POST',
                    body: JSON.stringify({
                        milestones: order
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                })
                const json = await response.json();
                await this.retrieveMilestones()
                Alpine.store('toast').toggle(json.message, response.ok);
            },
            async deleteMilestoneConfirmed() {
                const id = this.modals.milestone.delete.milestone.id;
                const response = await fetch(`milestones/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                });
                const json = await response.json();
                await this.retrieveMilestones();
                this.modals.milestone.delete.show = false;
                Alpine.store('toast').toggle(json.message, response.ok);
            },
            async updateMilestoneConfirmed() {
                const milestone = this.modals.milestone.update.milestone;
                const response = await fetch(`milestones/${milestone.id}`, {
                    method: 'PUT',
                    body: JSON.stringify(milestone),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                });
                const json = await response.json();
                if (!response.ok) {
                    Alpine.store('toast').toggle(json.message, false);
                    return;
                }
                await this.retrieveMilestones();
                await new Promise((res) => setTimeout(() => {
                    res()
                }, 300))
                this.modals.milestone.update.show = false;
                Alpine.store('toast').toggle(json.message);
            },
            async createMilestonePressed() {
                if (!this.toCreate.length) return;
                const response = await fetch('/milestones', {
                    method: 'POST',
                    body: JSON.stringify({
                        text: this.toCreate
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                })
                const json = await response.json()
                if (!response.ok) {
                    Alpine.store('toast').toggle(json.message, false);
                    return;
                }
                await this.retrieveMilestones();
                Alpine.store('toast').toggle(json.message);
                this.toCreate = '';
            },
            ...e
        })
    </script>
</x-app-layout>