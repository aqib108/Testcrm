require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes';
//import store from './store/index'

//import a class for globel used
import User from './Helpers/User';
window.User = User;

//import a class for globel used
import Notification from './Helpers/Notification';
window.Notification = Notification;


//sweet alert 2
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
window.Toast = Toast;
window.swalWithBootstrapButtons = swalWithBootstrapButtons;



//end of sweet alert 2
window.Reload = new Vue();
Vue.use(VueRouter)
const router = new VueRouter({
        routes,
        mode: 'history'
    })
   
    Vue.component('pagination', require('laravel-vue-pagination'));
    // Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
}).$mount('#app');