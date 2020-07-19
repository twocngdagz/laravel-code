
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
import Passers from "./components/Passers.vue"
import AddPasser from "./components/AddPasser.vue"
import PasserSummary from "./components/PasserSummary.vue"
import NotFound from "./components/NotFound.vue"
import PortalVue from 'portal-vue'
import Vuelidate from 'vuelidate'

Vue.use(PortalVue)
Vue.use(VueRouter)
Vue.use(Vuelidate)

const routes = [
    { path: '/', name: 'home', component: Passers },
    { path: '/add', name: 'addpasser', component: AddPasser },
    { path: '/summary', name: 'summary', component: PasserSummary },
    { path: '/*', name: 'notfound', component: NotFound }
]

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    components: {
        Passers
    },
    router
});
