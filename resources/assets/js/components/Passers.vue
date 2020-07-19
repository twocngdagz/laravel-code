<template>
    <div>
        <fetch-json :url="url" class="mb-8">
            <div class="card h-3/4-screen" slot-scope="{ response, loading }">
                <div>
                    <div class="container">
                        <div class="flex justify-between mb-2">
                            <router-link :to="{ name: 'addpasser'}">Add Entry</router-link>
                            <router-link :to="{ name: 'summary'}">Summary</router-link>

                            <label>Show
                                <select v-model="limit">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                                entries
                            </label>
                            <input v-model="query" placeholder="search" class="border-gray border-solid border-2 rounded-full">
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-4 font-bold text-center">
                                Name
                            </div>
                            <div class="col-sm-4 font-bold text-center">
                                School
                            </div>
                            <div class="col-sm-2 font-bold text-center">
                                Campus
                            </div>
                            <div class="col-sm-2 font-bold text-center">
                                Division
                            </div>
                        </div>
                        <div v-if="loading" class="text-grey-darker">
                            Loading...
                        </div>
                        <passer-list :passers="response" v-else></passer-list>
                        <pagination class="row" :pages="pages(response, loading)" :currentPage.sync="currentPage"></pagination>
                    </div>
                </div>
            </div>
        </fetch-json>
    </div>
</template>

<script>
    import PasserList from "./PasserList.vue"
    import FetchJson from "./FetchJson.vue"
    import Pagination from "./Pagination.vue"

    export default {
        components: {
            PasserList,
            FetchJson,
            Pagination
        },
        data() {
            return {
                limit: 50,
                currentPage: 1,
                query: ''
            }
        },
        computed: {
            url() {
                let offset = (this.currentPage - 1) * this.limit
                if (this.query) {
                    return `/api/passers?offset=${offset}&limit=${this.limit}&search=${this.query}`
                }
                return `/api/passers?offset=${offset}&limit=${this.limit}&order=name&direction=asc`
            },
        },
        methods: {
            pages(passers, loading) {
                if (loading || passers.passersCount <= this.limit) {
                    return []
                }
                return [...Array(Math.ceil(passers.passersCount / this.limit)).keys()].map(e => e + 1)
            }
        }
    }
</script>
