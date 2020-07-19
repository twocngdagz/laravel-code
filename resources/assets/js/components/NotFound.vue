<template>
    <div class="card">
        <h1>404</h1>
        <h3>Opps! This Page Could Not Be Found</h3>
        <p>SORRY BUT THE PAGE YOU ARE LOOKING FOR DOES NOT EXIST, HAVE BEEN REMOVED. NAME CHANGED OR IS TEMPORARILY UNAVAILABLE</p>
        <router-link :to="{ name: 'home'}">Go To Home</router-link>
    </div>
</template>

<script>
    export default {

    }
</script>
