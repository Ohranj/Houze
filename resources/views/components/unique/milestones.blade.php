<div x-data="milestonesDrag">
    <h1 class="text-center font-semibold text-lg">My Milestones (<span x-text="data.milestones.completedCount"></span> / <span x-text="data.milestones.list.length"></span>)</h1>
    <div class="space-y-2 mt-4" x-ref="c_milestones">
        <template x-for="milestone in data.milestones.list" :key="milestone.order">
            <div class="rounded-lg p-2 grid grid-cols-5 border shadow shadow-slate-600 bg-gradient-to-bl from-slate-600 to-slate-700 text-white transition-all ease-in-out" :class="{ 'select-none': milestone.order == 1}" :draggable="milestone.order >= 2" @dragStart="handleDragStart($el)" @dragEnd="handleDragEnd(event)" @dragOver.prevent="handleDragOver($el, milestone.order)" :data-loopIndex="milestone.order">
                <div class="col-span-4 flex flex-col gap-2">
                    <small x-cloak x-show="milestone.complete" class="text-right" x-text="milestone.human_completed"></small>
                    <p class="font-medium text-sm md:text-base" x-text="milestone.text">Took the first step! Created an account on Houze.</p>
                    <div class="flex justify-end gap-2">
                        <button x-show="milestone.order >= 2" class="rounded-md px-2 py-0.5 bg-red-500" @click="modals.milestone.delete.milestone = {...milestone}; modals.milestone.delete.show = true">Delete</button>
                        <button x-show="milestone.order >= 2" class="rounded-md px-2 py-0.5 bg-indigo-500" @click="modals.milestone.update.milestone = {...milestone}; modals.milestone.update.show = true">Update</button>
                    </div>
                </div>
                <div class="flex items-center justify-center text-white">
                    <x-svg.tick x-cloak x-show="milestone.complete" class="w-14 h-14" stroke="currentColor" fill="none" />
                </div>
            </div>
        </template>
    </div>
    <div class="pt-8">
        <small class="text-right block">Characters remaining - <span x-text="125 - toCreate.length"></span></small>
        <textarea class="w-full rounded-lg" rows="2" placeholder="Create a new milestone..." x-model="toCreate" maxlength="125"></textarea>
        <x-btn-pill text="Create" class="py-1.5 px-3 ml-auto shadow-indigo-600 bg-indigo-500 hover:bg-indigo-600 text-white" call="createMilestonePressed" isFunc="true">
            <x-slot name="icon">
                <x-svg.thumbs-up class="w-6 h-6" stroke="currentColor" fill="none" />
            </x-slot>
        </x-btn-pill>
    </div>

    <script>
        const milestonesDrag = () => ({
            toCreate: '',
            dragging: {
                elem: null,
            },
            handleDragStart(elem) {
                this.dragging.elem = elem;
                this.dragging.elem.classList.add('opacity-0')
            },
            handleDragEnd(event) {
                this.dragging.elem.classList.remove('opacity-0');
                this.dragging.elem = null;
                this.refreshMilestonesList();
            },
            handleDragOver(elem, indx) {
                let sibling = elem.previousElementSibling;
                if (indx == 1) {
                    sibling = elem;
                }
                sibling.insertAdjacentElement('afterend', this.dragging.elem)
            },
            refreshMilestonesList() {
                const domOrder = this.$refs.c_milestones;

                const orderedIndxs = [];
                for (const x of domOrder.children) {
                    const indx = x.getAttribute('data-loopIndex')
                    if (!indx) {
                        continue;
                    }
                    orderedIndxs.push(indx);
                }

                const orderedMilestones = [];
                for (let i = 0; i < orderedIndxs.length; i++) {
                    for (let k = 0; k < this.data.milestones.list.length; k++) {
                        const milestone = this.data.milestones.list[k];
                        if (orderedIndxs[i] == milestone.order) {
                            const copyMilestone = {
                                ...milestone,
                                order: i + 1
                            };
                            orderedMilestones.push(copyMilestone);
                            continue;
                        }
                    }
                }

                this.milestonesReordered(orderedMilestones);
            }
        })
    </script>
</div>