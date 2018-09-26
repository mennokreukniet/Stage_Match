import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);
Vue.use(VueRouter);

import MainApp from './views/App';

import Auth from './views/auth/Auth.vue';
import Auth_login from './views/auth/Login.vue';
import Auth_register from './views/auth/Register.vue';
import Index from './views/index/Index.vue';
import Settings from './views/settings/Settings.vue';
import Admin from './views/admin/Admin.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            alias: '/index',
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
            path: '/logout',
            beforeEnter: (to, from, next) => {
                localStorage.removeItem("accessToken");
                next('/auth/login');
            },
        },
        {
            path: '/settings',
            component: Settings,
            beforeEnter: (to, from, next) => {
                document.title = "Stage Match - Settings";
                if (localStorage.getItem("accessToken") === null) {
                    return next('/auth/login');
                }
                next();
            }
        },
        {
            path: '/auth',
            name: 'auth',
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
                    name: 'auth',
                    path: 'login',
                    component: Auth_login
                },
                 {
                    name: 'auth',
                     path: 'register',
                     component: Auth_register
                 }
            ]
        },
        {
            path: '/admin',
            component: Admin,
            beforeEnter: (to, from, next) => {
                document.title = "Stage Match - Admin";
                const token = localStorage.getItem("accessToken");
                console.log()
                if (token === null || JSON.parse(atob(token.split(".")[1])).role !== "3") {
                    
                    return next('/auth/login');
                } else {
                    next();
                }
            },
        },
    ],
});

const translations = {
    en: {
        app: {
            name: "StageMatch"
        },
        auth: {
            product: {
                title: "Finding an internship was never this easy",
                register_message: "Why are you waiting? It is free!",
                register_button: "Create an account",
            },

            already_using: "Already a member?",
            sign_in: "Log in"
        }
    },
    nl: {
        app: {
            name: "StageMatch"
        },
        auth: {
            product: {
                title: "Een stage vinden was nooit zo simpel",
                register_message: "Dus, waar wacht je op? Het is gratis!",
                register_button: "Creeer een account",
            },

            already_using: "Ben je al lid?",
            sign_in: "Log in"
        }
    }
  }

const i18n = new VueI18n({
    locale: 'en', // set locale
    fallbackLocale: 'en',
    messages: translations, // set locale messages
  })

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
    i18n
});