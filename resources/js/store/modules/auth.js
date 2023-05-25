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
    registerSuccess(state, payload) {
        state.isSubmitting = false
        state.currentUser = payload
        state.isLoggedIn = true
        state.isLoading = false
    },
    registerFailure(state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
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
                    context.commit('registerSuccess', credentials)
                    resolve(response.data.user)
                })
                .catch((result) => {
                    console.log(result.response.data.errors)
                    context.commit('registerFailure', result.response.data.errors)
                })
        })
    },
}

export default {
    state,
    mutations,
    actions,
    getters
}
