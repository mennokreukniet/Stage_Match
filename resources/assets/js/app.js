
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');
// import MainApp from './views/App.vue'
// console.log(1)
// window.Vue = require('vue');

// const app = new Vue({
//     el: '#app',
//     components: {
//         MainApp
//     }
// });


import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import MainApp from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
});