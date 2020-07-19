<script>
    export default {
        props: ["url"],
        data() {
            return {
                response: [],
                loading: true
            }
        },
        created() {
            this.fetchUrl()
        },
        methods: {
            fetchUrl() {
                axios.get(this.url)
                .then((response) => {
                    this.response = response.data
                    this.loading = false
                })
                .catch((error) => {
                    throw new Error(`Error fetching ${error}`)
                })
            }
        },
        render() {
            return this.$scopedSlots.default({
                response: this.response,
                loading: this.loading
            })
        },
        watch: {
            url() {
                this.fetchUrl()
            }
        }
    }
</script>
