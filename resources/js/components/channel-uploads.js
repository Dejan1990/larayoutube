Vue.component('channel-uploads', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data() {
        return {
            selected: false,
            videos: [],
            progress: {}
        }
    },

    methods: {
        upload() {
            this.selected = true
            this.videos = Array.from(this.$refs.videos.files) // Array.from konvertuje u array

            const uploaders = this.videos.map(video => {    //posto je array mozemo da koristimo map -> mapoverate // map ocekuje da vratimo rezultat i onda map menja pozicije u novom array-u

                const form = new FormData()

                this.progress[video.name] = 0

                form.append('video', video)
                form.append('title', video.name)

                return axios.post(`/channels/${this.channel.id}/videos`, form, {
                    onUploadProgress: (event) => {
                        this.progress[video.name] = Math.ceil((event.loaded / event.total) * 100)

                        this.$forceUpdate()
                    }
                })
            }) 
        }
    },
})