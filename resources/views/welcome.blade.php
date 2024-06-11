<x-guest-layout>
    @push('scripts')
    @vite([ 'resources/js/particles.js' ])
    @endpush

    <x-slot name="main">
        <div class="h-full flex flex-col" x-data="welcome({csrfToken: '{{ csrf_token() }}'})">
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
                        <h2 class="text-xl">Use the form below to easily create your account.</h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 space-y-4">
                            <div class="flex flex-col col-span-2">
                                <label class="font-medium">Email Address <sup>*</sup></label>
                                <div class="flex items-center gap-4">
                                    <input type="email" class="rounded-lg grow" placeholder="..." @input.debounce.250ms="isValidEmail()" x-model="modals.getStarted.credentials.email.value" />
                                    <span class="hidden lg:inline-block w-6 h-6 rounded-full" :class="modals.getStarted.credentials.email.valid ? 'bg-green-500' : 'border'"></span>
                                </div>
                            </div>
                            <div class="flex flex-col col-span-2">
                                <label class="font-medium">Create a Username <sup>*</sup></label>
                                <div class="flex items-center gap-4">
                                    <input type="text" class="rounded-lg grow" placeholder="R.Prior" @input.debounce.500ms="isValidUsername()" x-model="modals.getStarted.credentials.username.value" />
                                    <span class="hidden lg:inline-block w-6 h-6 rounded-full" :class="modals.getStarted.credentials.username.valid ? 'bg-green-500' : 'border'"></span>
                                </div>
                                <small x-cloak x-show="modals.getStarted.credentials.username.hasChecked" class="italic relative top-1" :class="modals.getStarted.credentials.username.valid ? 'text-green-600' : 'text-red-600'" x-text="modals.getStarted.credentials.username.valid ? 'Username available' : 'Username already taken'"></small>
                            </div>
                            <div class="flex items-center col-span-2 relative">
                                <div class="grid w-full lg:w-fit lg:grid-cols-2 gap-4 lg:gap-2">
                                    <div class="flex flex-col w-full">
                                        <label class="font-medium">Password <sup>*</sup></label>
                                        <input type="password" class="rounded-lg" placeholder="..." @input.debounce.250ms="isValidPassword()" x-model="modals.getStarted.credentials.password.value" />
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <label class="font-medium">Confirm your Password <sup>*</sup></label>
                                        <input type="password" class="rounded-lg" placeholder="..." @input.debounce.250ms="isValidPassword()" x-model="modals.getStarted.credentials.password_confirmation.value" />
                                    </div>
                                </div>
                                <span class="hidden lg:inline-block w-6 h-6 rounded-full absolute bottom-[10px] right-0" :class="modals.getStarted.credentials.password.valid ? 'bg-green-500' : 'border'"></span>
                            </div>
                            <small class="col-span-2 italic relative -top-5 left-0">Passwords require at least 12 characters and a number.</small>
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
    const welcome = (e) => ({
        modals: {
            getStarted: {
                show: false,
                credentials: {
                    password: {},
                    password_confirmation: {},
                    email: {},
                    username: {}
                },
                success: false,
                error: {
                    show: [],
                    messages: []
                }
            }
        },
        init() {
            this.$watch('modals.getStarted.show', (state) => {
                if (state) return
                this.modals.getStarted.credentials = {
                    password: {},
                    password_confirmation: {},
                    email: {},
                    username: {}
                }
            })
        },
        isValidPassword() {
            const {
                password,
                password_confirmation
            } = this.modals.getStarted.credentials;

            try {
                if (password.value.length < 12) throw 'Invalid length';
                if (password.value != password_confirmation.value) throw 'Invalid match';
                if (!/\d/.test(password.value)) throw 'Invalid string';
                password.valid = true;
            } catch (err) {
                password.valid = false;
            }
        },
        isValidEmail() {
            const {
                email
            } = this.modals.getStarted.credentials;

            try {
                if (!email.value.length || email.value?.length < 3) throw 'Invalid length';
                if (!/@/.test(email.value)) throw 'Invalid string';
                email.valid = true
            } catch (err) {
                email.valid = false
            }
        },
        async isValidUsername() {
            const {
                username
            } = this.modals.getStarted.credentials;
            username.hasChecked = false;
            try {
                if (!username.value.length || username.value?.length < 2) throw 'Invalid string';
                const params = new URLSearchParams({
                    username: username.value
                })
                const response = await fetch('/validate-username-status?' + params);
                const json = await response.json();
                username.hasChecked = true;
                if (!response.ok) throw 'Invalid string';
                username.valid = true;
            } catch (err) {
                username.valid = false;
            }
        },
        async createAccountConfirmBtnPressed() {
            const {
                password,
                password_confirmation,
                username,
                email
            } = this.modals.getStarted.credentials;
            if (!email.valid || !username.valid || !password.valid) {
                Alpine.store('toast').toggle('Please make sure all fields are completed correctly before confirming your account.', false);
                return;
            }
            const response = await fetch('/register', {
                method: 'POST',
                body: JSON.stringify({
                    password: password.value,
                    password_confirmation: password_confirmation.value,
                    username: username.value,
                    email: email.value
                }),
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
            Alpine.store('toast').toggle(json.message);
        },
        ...e
    })
</script>