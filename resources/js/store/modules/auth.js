import authApi from '../../api/auth.js'
import VueCookies from 'vue-cookies'
import index from 'vuex'

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
        state.validationErrors = payload.response.data
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
    },
    resendEmailStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.validationErrors = null
    },
    resendEmailSuccess(state, payload) {
        state.isSubmitting = false
        state.responseMessage = payload
        state.isLoading = false
    },
    resendEmailFailure(state, payload) {
        state.validationErrors = payload
        state.isSubmitting = false
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
                    localStorage.setItem('login', credentials.login)
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
                    credentials.token = response.data.bearer
                    console.log(credentials.token)
                    VueCookies.set('login', credentials.login, "3600s")
                    VueCookies.set('password', credentials.password, "3600s")
                    if(credentials.token !== null || credentials.token !== 'undefined') {
                        VueCookies.set('token', credentials.token, '3600s')
                        context.commit('loginSuccess', credentials)
                        resolve(response)
                    } else {
                        let payload = {
                            response: {
                                data: {
                                    error: 'Error for creating token'
                                }
                            }
                        }
                        context.commit('loginFailure', payload)
                    }
                })
                .catch((result) => {
                    console.log(result)
                        context.commit('loginFailure', result)
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
                    VueCookies.remove('token')
                    VueCookies.remove('login')
                    VueCookies.remove('password')
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
        const login = VueCookies.get('login')
        const token = VueCookies.get('token')
        const password = VueCookies.get('password')
        if (login && token && password) {
            const payload = { login: login, token: token, password: password }
            context.commit('refreshAuthSuccess', payload)
        } else {
            context.commit('refreshAuthFailure')
        }
    },
    resendEmail(context) {
        return new Promise((resolve) => {
            const login = localStorage.getItem('login')
            context.commit('resendEmailStart')
            authApi
                .resendEm({login: login})
                .then((response) => {
                    context.commit('resendEmailSuccess', response.data.message)
                    resolve()
                })
                .catch((result) => {
                    if (result.response.status === 401) {
                        context.commit('resendEmailFailure', result.response.data.message)
                    }
                })
        })
    }
}

export default {
    state,
    mutations,
    actions,
}
