import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import Notifications from 'vue-notification';

Vue.use(Notifications);
Vue.use(VueI18n);
Vue.use(VueRouter);

import MainApp from './views/App';
import Auth_login from './views/auth/Login.vue';
import Auth_register from './views/auth/Register.vue';
import Index from './views/index/Index.vue';
import Main from './views/main/Main.vue';
import Settings from './views/settings/Settings.vue';
import Admin from './views/admin/Admin.vue';
import Reviews from './views/reviews/Reviews.vue';
import Internship from './views/internship/Internship.vue';
import Internship_show from './views/internship/List.vue';
import InternshipForm from './views/internship/InternshipForm.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/index',
            component: Index,
            name: "index"
        },
        {
            path: '/login',
            component: Auth_login,
            name: "login"
        },
        {
            path: '/register',
            component: Auth_register,
            name: "register"
        },
        {
            path: '/logout',
            beforeEnter: (to, from, next) => {
                localStorage.removeItem("accessToken");
                next({ name: "index" });
            },
        },
        {
            path: '/main',
            alias: '/',
            component: Main,
            name: "main"
        },
        {
            path: '/reviews',
            alias: '/',
            component: Reviews,
            name: "review"
        },

        {
            path: '/settings',
            component: Settings,
            name: "settings"
        },
        {
            path: '/internship',
            component: Internship,
            children: [
                {
                    path: '',
                    component: Internship_show,
                    name: "internship_show"
                  },
                {
                  path: 'create',
                  component: InternshipForm,
                  name: "internship_create"
                },
                {
                    path: ':id',
                    props: true,
                    component: InternshipForm,
                    name: "internship_edit"
                }
            ]
        },
        {
            path: '/admin',
            component: Admin,
            name: "admin"
        },
    ],
});


/**
 * @description Router middleware
 */
router.beforeEach((to, from, next) => {

    document.title = `StageMatch - ${to.name}`;

    const token = localStorage.getItem("accessToken");

    if (["login", "register", "index"].includes(to.name)) {
        if (token !== null) {
            return next({ name: "main" });
        }
    } else if (to.name === "admin") {
        if (token === null || JSON.parse(atob(token.split(".")[1])).role !== "3") {
            return next({ name: "login" });
        }
    } else if (to.name === "internship_create") {
        if (token === null || JSON.parse(atob(token.split(".")[1])).role !== "2") {
            return next({ name: "main" });
        }
    } else if (token === null) {
        return next({ name: "index" });
    }

    next();
})

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

            footer: {
                waiting: "What are you waiting for?"
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
                register_button: "Creëer een account",
            },
            footer: {
                waiting: "Waar wacht je op?"
            },
            already_using: "Ben je al lid?",
            sign_in: "Log in"
        }
    }
  }

const i18n = new VueI18n({
    locale: 'nl',
    fallbackLocale: 'en',
    messages: translations,
  })

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
    i18n
});