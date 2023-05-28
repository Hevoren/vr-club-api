import { createRouter, createWebHistory } from "vue-router";

import VrMain from "../views/Main.vue"
import VrLogin from "../views/Login.vue"
import VrRegister from "../views/Register.vue"
import VrForgotPassword from "../views/ForgotPassword.vue"
import VrResetPassword from "../views/ResetPassword.vue"
import store from '../store/modules/auth.js'




const routes = [
    {
        path: "/",
        component: VrMain,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: "/main",
        name: "main",
        component: VrMain,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: "/login",
        name: "login",
        component: VrLogin,
        meta: {
            requiresNotAuth: true
        }
    },

    {
        path: "/register",
        name: "register",
        component: VrRegister,
        meta: {
            requiresNotAuth: true
        }
    },

    {
        path: "/forgot-password",
        name: "forgot-password",
        component: VrForgotPassword,
        meta: {
            requiresNotAuth: true
        }
    },

    {
        path: '/reset-password/:token',
        name: 'ResetPassword',
        component: VrResetPassword,
        props: true,
        meta: {
            requiresNotAuth: true
        }
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    // Check if the route requires authentication
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Check if the user is authenticated
        if (!store.state.isLoggedIn) {
            // If not authenticated, redirect to the login page
            next({ name: 'login' })
        } else {
            // If authenticated, allow access to the route
            next()
        }
    } else {
        // If the route does not require authentication, allow access to the route
        next()
    }
})

router.beforeEach((to, from, next) => {
    // Check if the route requires authentication
    if (to.matched.some(record => record.meta.requiresNotAuth)) {
        // Check if the user is authenticated
        if (store.state.isLoggedIn) {
            // If not authenticated, redirect to the login page
            next({ name: 'main' })
        } else {
            // If authenticated, allow access to the route
            next()
        }
    } else {
        // If the route does not require authentication, allow access to the route
        next()
    }
})

export default router;

