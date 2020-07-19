<template>
    <div class="container h-1/2-screen overflow-scroll border-bottom mb-2">
        <div v-for="summary in summaries.passerSummaries" :key="summary.school" class="row">
            <div class="col-sm-8 font-thin text-sm">
                {{summary.school}}
            </div>
            <div class="col-sm-4 font-thin text-sm text-center">
                {{summary.total}}
            </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ["summaries"]

    }
</script>
