/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import Swal from 'sweetalert2';
import { loadProgressBar } from 'axios-progress-bar'
import {
    Form,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

Vue.use(VueRouter);
window.Swal=Swal;
window.swal=Swal;
window.Form=Form;
window.Toast = swal.mixin({
    toast: true,
    // position: 'top-end',
    showConfirmButton: true,
    // timer: 3000
});
window.linker1=0
Vue.use(VeeValidate);
let routes=[
    {path:'/activeCertifications',component: require('./components/Test/AttemptTest').default},
    {path:'/passedCertifications',component: require('./components/Test/PassedTests').default},
    {path:'/contactUs',component: require('./components/Contact/Contact').default},
    {path:'/home',component: require('./components/StudentDashboard').default},
]
const router =new VueRouter({
    mode:'history',
    routes
})
loadProgressBar()
Vue.component('QuestionersModalWindow', require('./components/AttemptWindow/QuestionModule').default);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',router,
});
