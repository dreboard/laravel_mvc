
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
    { path: '/home', component: require('./components/admin/Dashboard.vue') },
    { path: '/profile', component: require('./components/admin/Profile.vue') },
    { path: '/users', component: require('./components/admin/Users.vue') },
]
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.filter('adminText', function(text){
    if(text == 0){
        return 'No';
    }
    return 'Yes';
});
Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Front
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('app-front-page', require('./components/front/Front_page.vue'));
Vue.component('app-front-links', require('./components/front/Links.vue'));

//Admin
Vue.component('user_profile', require('./components/admin/Profile.vue'));

const app = new Vue({
    el: '#app',
    router
});
