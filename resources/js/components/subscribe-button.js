import Axios from 'axios';
import numeral from 'numeral';

Vue.component('subscribe-button', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        },

        initialSubscriptions: {
            type: Array,
            required: true,
            default: () => [] // ovo znaci prazan Array
        }
    },

    data() {
        return {
            subscriptions: this.initialSubscriptions
        }
    },

    computed: { //computed ucitava automatski zajedno sa stranicom
        subscribed() {
            if (! __auth() || this.channel.user_id === __auth().id) return false

            return !!this.subscription
        },

        owner() {
            if(__auth() && this.channel.user_id === __auth().id) return true // uvek testirati, koristiti i drugi browser

            return false
        },

        subscription() {
            if(! __auth()) return null

            return this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        },

        count() {
            return numeral(this.subscriptions.length).format('0a.0')
        }
    },

    methods: {
        toggleSubscription() {
            if (!__auth()) {
                return alert('Please log in to subscribe');
            }

            if(this.owner) {
                return alert('You cannot subscribe to your channel');
            }

            if(this.subscribed) {
                axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                    .then(() => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })
            } else {
                axios.post(`/channels/${this.channel.id}/subscriptions`)
                    .then(response => {
                        this.subscriptions = [ //will spread all of existing subscriptions
                            ...this.subscriptions,
                            response.data //response from the server(response.data) and attach to the existing list of subscriptions
                        ]
                    })
            }
        }
    }
})