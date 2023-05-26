import { createRouter, createWebHistory } from "vue-router";

import VrMain from "../views/Main.vue"
import VrLogin from "../views/Login.vue"
import VrRegister from "../views/Register.vue"
import VrForgotPassword from "../views/ForgotPassword.vue"
import VrResetPassword from "../views/ResetPassword.vue"

const routes = [
    {
        path: "/",
        component: VrMain
    },

    {
        path: "/main",
        name: "main",
        component: VrMain
    },

    {
        path: "/login",
        name: "login",
        component: VrLogin
    },

    {
        path: "/register",
        name: "register",
        component: VrRegister
    },

    {
        path: "/forgot-password",
        name: "forgot-password",
        component: VrForgotPassword
    },

    {
        path: '/reset-password/:token',
        name: 'ResetPassword',
        component: VrResetPassword,
        props: true
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

