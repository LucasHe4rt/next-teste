require('./bootstrap');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueTheMask from 'vue-the-mask';
import VueToast from 'vue-toast-notification';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-toast-notification/dist/theme-sugar.css';

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(VueTheMask);
Vue.use(VueToast, {
    position: 'top-right',
    dismissible: true,
    duration: 3000,
    pauseOnHover: true,
    queue: true
});

import attributesPtBr from 'vee-validate/dist/locale/pt_BR';
import VeeValidate, { Validator } from 'vee-validate';

Validator.localize('pt-br', attributesPtBr);

const configVeeValidate = {
    classes: true,
    classNames: {
        valid: "is-valid",
        invalid: "is-invalid"
    },
    errorBagName: 'errorsVeeValidate',
    fieldsBagName: 'fieldsVeeValidate',
    locale: 'pt-br',
    dictionary: {
        translationsPtBr: {
            attributes: attributesPtBr
        }
    }
};

Vue.use(VeeValidate, configVeeValidate);

Vue.component('form-component', require('./components/FormComponent').default);
Vue.component('list-component', require('./components/ListComponent').default);

const app = new Vue({
    el: '#app'
});
