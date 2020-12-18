Vue.component('subscribe-button', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        },
        subscriptions: {
            type: Array,
            required: true,
            default: () => [] // ovo znaci prazan Array
        }
    },

    computed: {
        subscribed() {
            if (! __auth() || this.channel.user_id === __auth().id) return false

            return !!this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        },

        owner() {
            if(__auth() && this.channel.user_id === __auth().id) return true // uvek testirati, koristiti i drugi browser

            return false
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