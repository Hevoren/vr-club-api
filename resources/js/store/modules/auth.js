import authApi from '../../api/auth.js'
import { setItem } from '../../helpers/saveLocStorage.js'

const state = {
    isSubmitting: false,
    currentUser: null,
    validationErrors: null,
    isLoggedIn: null,
    isLoading: null
}

const getters = {
    isLoggedIn: (state) => {
        return Boolean(state.isLoggedIn)
    }
}

const mutations = {
    registerStart(state) {
        state.isSubmitting = true
        state.validationErrors = null
        state.isLoading = true
    },
    registerSuccess(state) {
        state.isSubmitting = false
        state.isLoggedIn = true
        state.isLoading = false
    },
    registerFailure(state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
        state.isLoading = false
    },
    loginStart(state) {
        state.isSubmitting = true;
        state.validationErrors = null;
    },
    loginSuccess(state, payload) {
        state.isSubmitting = false;
        state.currentUser = payload;
        console.log(state.currentUser)
        state.isLoggedIn = true;
    },
    loginFailure(state, payload) {
        state.isSubmitting = false;
        state.validationErrors = payload;
    },
}

const actions = {
    register(context, credentials) {
        return new Promise((resolve) => {
            context.commit('registerStart')
            authApi
                .register(credentials)
                .then((response) => {
                    context.commit('registerSuccess', credentials)
                    resolve(response.data.user)
                })
                .catch((result) => {
                    context.commit('registerFailure', result.response.data.errors)
                })
        })
    },
    login(context, credentials) {
        return new Promise((resolve) => {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bearer');
            context.commit("loginStart");
            authApi
                .login(credentials)
                .then((response) => {
                    credentials.token = response.data.bearer;
                    context.commit("loginSuccess", credentials);
                    setItem("bearer", response.data.bearer);
                    setItem("login", credentials.login);
                    resolve();
                })
                .catch((result) => {
                    if (result.response.status === 422) {
                        context.commit("loginFailure", {
                            error: ["Email or password incorrect"],
                        });
                    }
                });
        });
    },
}

export default {
    state,
    mutations,
    actions,
    getters
}
