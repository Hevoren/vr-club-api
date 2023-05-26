import { createRouter, createWebHashHistory } from "vue-router";

import VrMain from "../views/Main.vue"
import VrLogin from "../views/Login.vue"
import VrRegister from "../views/Register.vue"

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

];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;

