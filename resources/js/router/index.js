import { createRouter, createWebHistory } from "vue-router";

import VrMain from "../views/Main.vue"
import VrLogin from "../views/Login.vue"
import VrRegister from "../views/Register.vue"
import VrForgotPassword from "../views/ForgotPassword.vue"
import VrResetPassword from "../views/ResetPassword.vue"
import auth from "../middleware/auth.js"
import unauth from "../middleware/unauth.js"

const routes = [
    {
        path: "/",
        component: VrMain
    },

    {
        path: "/main",
        name: "main",
        component: VrMain,
        meta: { requiresAuth: true },
        beforeEnter: auth
    },

    {
        path: "/login",
        name: "login",
        component: VrLogin,
        meta: { requiresAuth: true },
        beforeEnter: unauth
    },

    {
        path: "/register",
        name: "register",
        component: VrRegister,
        meta: { requiresAuth: true },
        beforeEnter: unauth
    },

    {
        path: "/forgot-password",
        name: "forgot-password",
        component: VrForgotPassword,
        meta: { requiresAuth: true },
        beforeEnter: unauth
    },

    {
        path: '/reset-password/:token',
        name: 'ResetPassword',
        component: VrResetPassword,
        props: true,
        meta: { requiresAuth: true },
        beforeEnter: unauth
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

