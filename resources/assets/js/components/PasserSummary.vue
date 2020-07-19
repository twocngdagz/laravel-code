<template>
    <div>
        <fetch-json :url="url" class="mb-8">
            <div class="card h-3/4-screen" slot-scope="{ response, loading }">
                <div>
                    <div class="container">
                        <div class="flex justify-between mb-2">
                            <label>Show
                                <select v-model="limit">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                                entries
                            </label>
                            <router-link :to="{ name: 'home'}">Home</router-link>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-8 font-bold text-center">
                                School
                            </div>
                            <div class="col-sm-4 font-bold text-center">
                                Passer Total Count
                            </div>
                        </div>
                        <div v-if="loading" class="text-grey-darker">
                            Loading...
                        </div>
                        <passer-summary-list :summaries="response" v-else></passer-summary-list>
                        <pagination class="row" :pages="pages(response, loading)" :currentPage.sync="currentPage"></pagination>
                    </div>
                </div>
            </div>
        </fetch-json>
    </div>
</template>


<script>
    import FetchJson from "./FetchJson.vue"
    import PasserSummaryList from "./PasserSummaryList.vue"
    import Pagination from "./Pagination.vue"


    export default {
        components: {
            FetchJson,
            Pagination,
            PasserSummaryList
        },
        data() {
            return {
                limit: 50,
                currentPage: 1
            }
        },
        computed: {
            url() {
                let offset = (this.currentPage - 1) * this.limit

                return `/api/passers/summary?offset=${offset}&limit=${this.limit}&summary=true`
            },
        },
        methods: {
            pages(summaries, loading) {
                if (loading || summaries.passerSummariesCount <= this.limit) {
                    return []
                }
                return [...Array(Math.ceil(summaries.passerSummariesCount / this.limit)).keys()].map(e => e + 1)
            }
        }
    }
</script>
