import Vue from 'vue';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);
Vue.use(VueRouter);

import MainApp from './views/App';
import router from './router';

import { translations } from './translations';

const i18n = new VueI18n({
    locale: 'nl',
    fallbackLocale: 'en',
    messages: translations,
  })

Vue.filter('formatDate', function(value) {
    if (value) {
        const date = new Date(value);
        return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
    }
});

const app = new Vue({
    el: '#app',
    components: { MainApp },
    router,
    i18n
});