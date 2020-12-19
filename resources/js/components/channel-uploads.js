Vue.component('channel-uploads', {
    data() {
        return {
            selected: false
        }
    },

    methods: {
        upload() {
            this.selected = true
            const videos = this.$refs.videos.files
            console.log(videos)
        }
    },
})