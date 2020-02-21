import Vue from 'vue';
import VueSocketIO from 'vue-socket.io';
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
/*import forms from './forms';*/
import commonComponents from './components/helpers/Common/LoadCommonComponents.js';
import Form from './forms';


commonComponents.forEach(component => {
    Vue.component(component.name, component);
});

window.axios = axios;
window.Form = Form;

Vue.use(new VueSocketIO({
        debug: false,
        connection: 'http://vue.brandboostx.com:3000'
    })
);
Vue.use(VueRouter);

Vue.mixin(helpers);

import VueApexCharts from 'vue-apexcharts';
Vue.use(VueApexCharts);
Vue.component('apexchart', VueApexCharts);


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
    router,
    data: {
        // declare message with an empty value
        pageColor: '',
    },
}).$mount('#masterContainer2')
