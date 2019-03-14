require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import {routes} from './routes';
import VueProgressBar from 'vue-progressbar';
import Swal from 'sweetalert2';
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showCloseButton: false,
    timer: 3000
});

window.toast = toast;

Vue.use(VueRouter);

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

const router = new VueRouter({
    mode: 'history',
    routes
});



Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-component', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router
});
