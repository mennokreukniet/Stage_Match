import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import MainApp from './views/App';

import Home from './views/Home';

import Auth from './views/auth/Auth.vue';
import Auth_login from './views/auth/Login.vue';
import Auth_register from './views/auth/Register.vue';
import Index from './views/index/Index.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Index,
            beforeEnter: (to, from, next) => {
                document.title = "Stage Match - Index";
                if (localStorage.getItem("accessToken") === null) {
                    return next('/auth/login');
                }
                next();
            },
        },
        {
            path: '/auth',
            component: Auth,
            beforeEnter: (to, from, next) => {
                document.title = "Stage Match - Auth";
                if (localStorage.getItem("accessToken") !== null) {
                    return next('/');
                }
                next();
            },
            children: [
                {
                    path: 'login',
                    component: Auth_login
                },
                 {
                     path: 'register',
                     component: Auth_register
                 }
            ]
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
});