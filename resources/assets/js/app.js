import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);
Vue.use(VueRouter);

import MainApp from './views/App';
import { routes } from './routes';

const router = new VueRouter(routes);

/**
 * @description Router middleware
 */
router.beforeEach((to, from, next) => {
    document.title = `StageMatch - ${to.name}`;

    const token = localStorage.getItem("accessToken");

    if (to.meta.role !== undefined) {
        if (token === null || JSON.parse(atob(token.split(".")[1])).role !== to.meta.role) {
            return next({ name: "main" });
        }
    }

    if (to.meta.auth_not_allowed === true) {
        if (token !== null) {
            return next({ name: "main" });
        }
    }

    if (to.meta.auth_required === false) {
        return next();
    }

    if (token === null && to.meta.auth_not_allowed !== true) {
        return next({ name: "index" });
    }
    
    next();
})

import { translations } from './translations';

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