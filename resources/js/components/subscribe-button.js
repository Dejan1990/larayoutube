Vue.component('subscribe-button', {
    props: {
        subscriptions: {
            type: Array,
            required: true,
            default: () => [] // ovo znaci prazan Array
        }
    },
    methods: {
        toggleSubscription() {
            if (!__auth()) {
                alert('Please log in to subscribe');
            }
        }
    }
})