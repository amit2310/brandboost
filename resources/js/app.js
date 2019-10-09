import Vue from 'vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('../bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import routes from './routes';
import axios from 'axios';
import helpers from './helpers';


window.axios = axios;
Vue.use(VueRouter);

Vue.mixin(helpers)

/*Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard-reivews', require('./components/admin/dashboard/DashReviews.vue').default);*/

const router = new VueRouter({
    routes // short for `routes: routes`
})


/*const app = new Vue({
    el: '#masterContainer',
    router
});*/

const app = new Vue({
    router
}).$mount('#masterContainer2')
