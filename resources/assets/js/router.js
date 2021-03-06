import { routes } from './routes';
import VueRouter from 'vue-router';
import Auth from '@/controllers/auth';

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

    if (token !== null && JSON.parse(atob(token.split(".")[1])).exp < Math.floor(Date.now()/1000)) {
        return Auth.logout();
    }

    next();
})

export default router;