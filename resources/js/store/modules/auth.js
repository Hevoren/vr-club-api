import authApi from '../../api/auth.js'
import { getItem, setItem } from '../../helpers/saveLocStorage.js'
import getAltAxis from '@popperjs/core/lib/utils/getAltAxis.js'


const state = {
    isSubmitting: false,
    currentUser: null,
    validationErrors: null,
    isLoggedIn: null,
    isLoading: null,
    responseMessage: null
}

const mutations = {
    registerStart(state) {
        state.idLoggedIn = false
        state.isLoading = true
        state.isSubmitting = true
        state.validationErrors = null
        state.responseMessage = null
    },
    registerSuccess(state, payload) {
        state.isSubmitting = false
        state.responseMessage = payload
        state.isLoggedIn = false
        state.isLoading = false
    },
    registerFailure(state, payload) {
        state.isSubmitting = false
        state.isLoggedIn = false
        state.validationErrors = payload
        state.isLoading = false
    },
    loginStart(state) {
        state.isLoading = true
        state.isLoggedIn = false
        state.isSubmitting = true
        state.validationErrors = null
    },
    loginSuccess(state, payload) {
        state.isSubmitting = false
        state.currentUser = payload
        state.isLoggedIn = true
        state.isLoading = false
    },
    loginFailure(state, payload) {
        state.isSubmitting = false
        state.isLoggedIn = false
        state.validationErrors = payload
        state.isLoading = false
    },
    exitStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.validationErrors = null
    },
    exitSuccess(state, payload) {
        state.isSubmitting = false
        state.currentUser = null
        state.isLoggedIn = false
        state.responseMessage = payload
        state.isLoading = false
    },
    exitFailure(state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
        state.isLoggedIn = false
        state.isLoading = false
    },
    refreshAuthStart(state) {
        state.isLoading = true
        state.validationErrors = null
    },
    refreshAuthSuccess(state, payload) {
        state.isSubmitting = false
        state.currentUser = payload
        state.isLoggedIn = true
        state.isLoading = false
    },
    refreshAuthFailure(state) {
        state.isLoading = false
    }
}

const actions = {
    register(context, credentials) {
        return new Promise((resolve) => {
            context.commit('registerStart')
            authApi
                .register(credentials)
                .then((response) => {
                    console.log(response)
                    context.commit('registerSuccess', response.data)
                    resolve(response.data.user)
                })
                .catch((result) => {
                    context.commit('registerFailure', result.response.data.errors)
                })
        })
    },
    login(context, credentials) {
        return new Promise((resolve) => {
            context.commit('loginStart')
            authApi
                .login(credentials)
                .then((response) => {
                    localStorage.setItem('token', response.data.bearer)
                    localStorage.setItem('login', credentials.login)
                    localStorage.setItem('password',credentials.password)
                    credentials.token = response.data.bearer
                    context.commit('loginSuccess', credentials)
                    resolve(response)
                })
                .catch((result) => {
                    if (result.response.status === 422) {
                        context.commit('loginFailure', {
                            error: ['Email or password incorrect'],
                        })
                    }
                })
        })
    },
    exit(context) {
        return new Promise((resolve) => {

            const token = state.currentUser.token
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

            context.commit('exitStart')
            authApi
                .logout(token)
                .then((response) => {
                    localStorage.clear()
                    context.commit('exitSuccess', response.data.message)
                    resolve()
                })
                .catch((result) => {
                    if (result.response.status === 401) {
                        context.commit('exitFailure', result.response.data.message)
                    }
                })
        })
    },
    refreshAuth(context) {
        context.commit('refreshAuthStart')
        const login = localStorage.getItem('login')
        const token = localStorage.getItem('token')
        const password = localStorage.getItem('password')
        if (login && token && password) {
            const payload = { login: login, token: token, password: password }
            context.commit('refreshAuthSuccess', payload)
        } else {
            context.commit('refreshAuthFailure')
        }
    },
}

export default {
    state,
    mutations,
    actions,
}
