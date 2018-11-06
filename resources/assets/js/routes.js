
import Auth_login from './views/auth/Login.vue';
import Auth_register from './views/auth/Register.vue';
import Index from './views/index/Index.vue';
import Main from './views/main/Main.vue';
import Settings from './views/settings/Settings.vue';
import Admin from './views/admin/Admin.vue';
import Reviews from './views/reviews/Reviews.vue';
import Internship from './views/internship/Internship.vue';
import Internship_create from './views/internship/Create.vue';
import Internship_show from './views/internship/List.vue';
import Demo from './views/demo/Demo.vue';

import {roles} from './config';

export const routes = {
    mode: 'history',
    routes: [
        {
            path: '/index',
            component: Index,
            name: "index",
            meta: {
                auth_not_allowed: true
            }
        },
        {
            path: '/login',
            component: Auth_login,
            name: "login",meta: {
                auth_not_allowed: true
            }
            
        },
        {
            path: '/register',
            component: Auth_register,
            name: "register",
            meta: {
                auth_not_allowed: true
            }
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
            name: "main",
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
            name: "internship",
            meta: {
                role: roles.company
            },
            children: [
                {
                    path: '',
                    component: Internship_show,
                    name: "internship_show"
                  },
                {
                  path: 'create',
                  component: Internship_create,
                  name: "internship_create"
                },
            ]
        },
        {
            path: '/admin',
            component: Admin,
            name: "admin",
            meta: {
                role: roles.admin
            }
        },
        {
            path: '/demo',
            component: Demo,
            name: "demo"
        },
    ],
}