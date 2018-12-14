
import Auth_login from './views/auth/Login.vue';
import Auth_register from './views/auth/Register.vue';
import Index from './views/index/Index.vue';
import Main from './views/main/Main.vue';
import Settings from './views/settings/Settings.vue';
import Admin from './views/admin/Admin.vue';
import Admin_skills from './views/admin/Skills.vue';
import Reviews from './views/reviews/Reviews.vue';
import Internship from './views/internship/Internship.vue';
import Internship_show from './views/internship/List.vue';
import Demo from './views/demo/Demo.vue';
import About from './views/settings/About.vue';

import { roles } from './config';
import { runtime } from './core/runtime';
import Auth from './controllers/auth';

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
            name: "login",
            meta: {
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
                Auth.logout(false);
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
            path: '/about',
            component: About,
            name: "about"
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
            ]
        },
        {
            path: '/admin',
            component: Admin,
            name: "admin",
            meta: {
                role: roles.admin
            },
            children: [
                {
                    path: 'skills',
                    component: Admin_skills,
                    name: "admin_skills"
                },
            ]
        },
        {
            path: '/demo',
            component: Demo,
            name: "demo"
        },
    ],
}