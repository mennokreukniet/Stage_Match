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
        },
        {
            path: '/admin',
            component: Admin,
            beforeEnter: (to, from, next) => {
                document.title = "Stage Match - Admin";
                if (localStorage.getItem("accessToken") === null) {
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
        email: "Email",
        password: "Password",
        confirm_password: "Confirm password",
        login: "Login",
        name: "Name",
        sign_up: "Sign up"
        
    },
    nl: {
        email: "Email",
        password: "Wachtwoord",
        confirm_password: "Bevestig wachtwoord",
        login: "Inloggen",
        name: "Naam",
        sign_up: "Account aanmaken"
    }
  }

const i18n = new VueI18n({
    locale: 'nl', // set locale
    fallbackLocale: 'en',
    translations, // set locale messages
  })

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
    i18n
});