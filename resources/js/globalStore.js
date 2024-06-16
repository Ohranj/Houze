document.addEventListener('alpine:init', () => {
    Alpine.store('toast', {
        list: [],
        toggle(msg = '', success = true) {
            const toast = { msg, success }
            this.list.push(toast);
            this.autoRemoveOnDelay()
        },
        async autoRemoveOnDelay() {
            await new Promise((res) => setTimeout(() => res(), 6000));
            this.list.splice(0, 1);
        }
    })
})