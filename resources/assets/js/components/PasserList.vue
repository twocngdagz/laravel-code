<template>
    <div class="container h-1/2-screen overflow-scroll border-bottom mb-2">
        <div v-for="passer in passers.passers" :key="passer.id" class="row">
            <div class="col-sm-4 font-thin text-sm">
                {{passer.name}}
            </div>
            <div class="col-sm-4 font-thin text-sm text-center">
                {{passer.school}}
            </div>
            <div class="col-sm-2 font-thin text-sm text-center">
                {{passer.campus}}
            </div>
            <div class="col-sm-2 font-thin text-sm text-center">
                {{passer.division}}
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ["passers"]

    }
</script>
