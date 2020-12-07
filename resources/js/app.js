require('./bootstrap');

import BootstrapVue from 'bootstrap-vue';

window.Vue = require('vue');

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app'
});
