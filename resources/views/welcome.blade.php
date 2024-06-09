<x-guest-layout>
    @push('scripts')
    @vite([ 'resources/js/particles.js' ])
    @endpush

    <x-slot name="main">
        <div class="h-full flex flex-col" x-data="welcome">
            <x-unique.guest-nav />

            <div class="grow grid place-content-center relative" id="c_container">
                <!-- <div class="flex justify-center" id="graphic"></div> -->
                <div class="z-10">
                    <x-link-pill href="/" text="Sign in with Google" class="border shadow-xl hover:shadow-indigo-100 hover:shadow-md hover:bg-indigo-50 bg-white py-1.5 px-3">
                        <x-slot name="icon">
                            <x-svg.google class="w-6 h-6 inline-block" fill="currentColor" />
                        </x-slot>
                    </x-link-pill>
                </div>

                <canvas class="-z-1 absolute top-0 left-0" id="c_particles"></canvas>
            </div>

            <x-modal showVar=modals.getStarted.show title="Let's get you started!">
                <x-slot:content>
                    <div x-show="!modals.getStarted.success" class="p-4 sm:p-6 space-y-8">
                        <h2 class="text-xl">Use the form below to create your account.</h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 space-y-4">
                            <div class="flex flex-col col-span-2">
                                <label class="font-medium">Email Address <sup>*</sup></label>
                                <div class="flex items-center gap-4">
                                    <input type="email" class="rounded-lg grow" placeholder="..." x-model="modals.getStarted.credentials.email" />
                                    <span class="hidden lg:inline-block w-6 h-6 rounded-full" :class="isValidEmail() ? 'bg-green-500' : 'border'"></span>
                                </div>
                            </div>
                            <div class="flex flex-col col-span-2">
                                <label class="font-medium">Create a Username <sup>*</sup></label>
                                <div class="flex items-center gap-4">
                                    <input type="text" class="rounded-lg grow" placeholder="R.Prior" x-model="modals.getStarted.credentials.username" />
                                    <span class="hidden lg:inline-block w-6 h-6 rounded-full" :class="isValidUsername() ? 'bg-green-500' : 'border'"></span>
                                </div>
                            </div>
                            <div class="flex items-center col-span-2 relative">
                                <div class="grid w-full lg:w-fit lg:grid-cols-2 gap-4 lg:gap-2">
                                    <div class="flex flex-col w-full">
                                        <label class="font-medium">Password <sup>*</sup></label>
                                        <input type="password" class="rounded-lg" placeholder="..." x-model="modals.getStarted.credentials.password" />
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <label class="font-medium">Confirm your Password <sup>*</sup></label>
                                        <input type="password" class="rounded-lg" placeholder="..." x-model="modals.getStarted.credentials.password_confirmation" />
                                    </div>
                                </div>
                                <span class="hidden lg:inline-block w-6 h-6 rounded-full absolute bottom-[10px] right-0" :class="isValidPassword() ? 'bg-green-500' : 'border'"></span>
                            </div>
                            <small class="col-span-2 italic relative -top-4 left-0">Passwords require at least 12 characters and a number.</small>
                        </div>
                        <x-btn-pill text="Confirm" class="py-1.5 px-3 mx-auto shadow-indigo-600 bg-indigo-500 hover:bg-indigo-600 text-white" isFunc="true" call="createAccountConfirmBtnPressed">
                            <x-slot name="icon">
                                <x-svg.thumbs-up class="w-6 h-6" stroke="currentColor" fill="none" />
                            </x-slot>
                        </x-btn-pill>
                        <div class="flex items-center gap-8">
                            <div class="grow border-b border-2"></div>
                            <p class="font-medium">Alternatively</p>
                            <div class="grow border-b border-2"></div>
                        </div>
                        <div>
                            <x-link-pill href="/" text="Sign in with Google" class="w-fit block mx-auto border shadow-xl hover:shadow-indigo-100 hover:shadow-md hover:bg-indigo-50 bg-white py-1.5 px-3">
                                <x-slot name="icon">
                                    <x-svg.google class="w-6 h-6 inline-block" fill="currentColor" />
                                </x-slot>
                            </x-link-pill>
                        </div>
                    </div>
                    <div x-cloak x-show="modals.getStarted.success" class="p-4 sm:p-6 text-center space-y-2">
                        <h2 class="text-lg">Success!</h2>
                        <p>If your password exists we will issue you further instructions.</p>
                        <p>Please check your inbox.</p>
                    </div>
                </x-slot:content>
            </x-modal>

            <x-toast />
        </div>
    </x-slot>
</x-guest-layout>

<script>
    const welcome = () => ({
        modals: {
            getStarted: {
                show: false,
                credentials: {},
                success: false,
                error: {
                    show: [],
                    messages: []
                }
            }
        },
        isValidPassword() {
            const {
                password,
                password_confirmation
            } = this.modals.getStarted.credentials;

            try {
                if (password.length < 12) throw 'Invalid length';
                if (password != password_confirmation) throw 'Invalid match';
                if (!/\d/.test(password)) throw 'Invalid string';
                return true
            } catch (err) {
                return false;
            }
        },
        isValidEmail() {
            const {
                email
            } = this.modals.getStarted.credentials;

            try {
                if (!email.length || email?.length < 3) throw 'Invalid length';
                if (!/@/.test(email)) throw 'Invalid string';
                return true;
            } catch (err) {
                return false;
            }
        },
        isValidUsername() {
            return this.modals.getStarted.credentials.username?.length > 5
            //Check backend - Have debounce with spinner
        },
        createAccountConfirmBtnPressed() {
            if (!this.isValidEmail() || !this.isValidUsername() || !this.isValidPassword()) {
                Alpine.store('toast').toggle('Please make sure all fields are completed correctly.', false);
                return;
            }
            alert(2)
        }
    })
</script>