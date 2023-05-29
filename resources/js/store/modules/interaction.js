import interactionApi from '../../api/interaction.js'
import authState from "../modules/auth.js";
import { getItem, setItem } from '../../helpers/saveLocStorage.js'
import data from 'bootstrap/js/src/dom/data.js'

const state = {
    isSubmitting: false,
    validationErrors: null,
    isLoading: null,
    responseMessage: null,
    data: null,
    error: null,
}

const mutations = {
    forgotpasswordStart(state){
        state.isSubmitting = true
        state.validationErrors = null
        state.isLoading = true
    },
    forgotpasswordSuccess(state, payload){
        state.isSubmitting = false
        state.responseMessage = payload
        state.isLoading = false
    },
    forgotpasswordFailure(state, payload){
        state.isSubmitting = false
        state.validationErrors = payload
        state.isLoading = false
    },
    // -----
    resetVariablesStart(state) {
        state.isSubmitting = false
        state.validationErrors = null
        state.isLoading = null
        state.responseMessage = null
    },
    // -----
    resetPasswordStart(state) {
        state.isSubmitting = true
        state.isLoading = true
    },
    resetPasswordSuccess(state, payload) {
        state.isSubmitting = false
        state.responseMessage = payload
        state.isLoading = false
    },
    resetPasswordFailure(state) {
        state.isSubmitting = false
        state.isLoading = false
    },
    // -----
    getItemStart(state) {
        state.isSubmitting = true
        state.isLoading = true
        state.error = null
        state.data = null
    },
    getItemSuccess(state, payload) {
        state.data = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    getItemFailure(state, payload) {
        state.error = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    // -----
    setItemStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.responseMessage = null
        state.error = null
        state.data = null
    },
    setItemSuccess(state, payload) {
        state.isSubmitting = false
        state.data = payload
        state.isLoading = false
    },
    setItemFailure(state, payload) {
        state.isSubmitting = false
        state.error = payload
        state.isLoading = false
    },
    // -----
    patchItemStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.responseMessage = null
        state.error = null
        state.data = null
    },
    patchItemSuccess(state, payload) {
        state.data = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    patchItemFailure(state, payload) {
        state.error = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    // -----
    putItemStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.responseMessage = null
        state.error = null
        state.data = null
    },
    putItemSuccess(state, payload) {
        state.data = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    putItemFailure(state, payload) {
        state.error = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    // -----
    deleteItemStart(state) {
        state.isLoading = true
        state.isSubmitting = true
        state.responseMessage = null
        state.error = null
        state.data = null
    },
    deleteItemSuccess(state, payload) {
        state.data = payload
        state.isSubmitting = false
        state.isLoading = false
    },
    deleteItemFailure(state, payload) {
        state.error = payload
        state.isSubmitting = false
        state.isLoading = false
    }

}

const actions = {
    sendEmail(context, credentials) {
        return new Promise((resolve) => {
            context.commit('forgotpasswordStart')
            interactionApi
                .forgotPassword(credentials)
                .then((response) => {
                    context.commit('forgotpasswordSuccess', response.data.message)
                    resolve(response)
                })
                .catch((result) => {
                    context.commit('forgotpasswordFailure', result)
                })
        })
    },
    resetVariables(context) {
        context.commit('resetVariablesStart')
    },
    resetPassword(context, credentials) {
        return new Promise((resolve) => {
            context.commit('resetPasswordStart')
            interactionApi
                .resetPassword(credentials)
                .then((response) => {
                    context.commit('resetPasswordSuccess', response.data.message)
                    resolve(response)
                })
                .catch((result) => {
                    context.commit('resetPasswordFailure')
                })
        })
    },
    getItems(context, { apiUrl }) {
        return new Promise((resolve) => {
            context.commit('getItemStart');
            const token = authState.state.currentUser.token;
            axios.defaults.headers.common.Authorization = `Bearer ${token}`;
            interactionApi
                .getItem(apiUrl)
                .then((response) => {
                    context.commit('getItemSuccess', response.data);
                    resolve(response.data)
                })
                .catch((result) => {
                    context.commit('getItemFailure', result.response);
                })
        })
    },
    setItems(context, { apiUrl, dataRequest }) {
        return new Promise((resolve) => {
            context.commit('setItemStart');
            const token = authState.state.currentUser.token;
            axios.defaults.headers.common.Authorization = `Bearer ${token}`;
            interactionApi
                .setItem(apiUrl, dataRequest)
                .then((response) => {
                    context.commit('setItemSuccess', response.data)
                    resolve(response.data)
                })
                .catch((result) => {
                    context.commit('setItemFailure', result.response)
                })
        })
    },
    patchItems(context, { apiUrl, dataRequest }) {
        return new Promise((resolve) => {
            context.commit('patchItemStart');
            const token = authState.state.currentUser.token;
            axios.defaults.headers.common.Authorization = `Bearer ${token}`;
            interactionApi
                .patchItem(apiUrl, dataRequest)
                .then((response) => {
                    context.commit('patchItemSuccess', response.data)
                    resolve(response.data)
                })
                .catch((result) => {
                    context.commit('patchItemFailure', result.response)
                })
        })
    },
    putItems(context, { apiUrl, dataRequest }) {
        return new Promise((resolve) => {
            context.commit('putItemStart')
            const token = authState.state.currentUser.token;
            axios.defaults.headers.common.Authorization = `Bearer ${token}`;
            interactionApi
                .putItem(apiUrl, dataRequest)
                .then((response) => {
                    context.commit('putItemSuccess', response.data)
                    resolve(response.data)
                })
                .catch((result) => {
                    context.commit('putItemFailure', result.response)
                })
        })
    },
    deleteItems(context, { apiUrl }) {
        return new Promise((resolve) => {
            context.commit('deleteItemStart')
            const token = authState.state.currentUser.token;
            axios.defaults.headers.common.Authorization = `Bearer ${token}`;
            interactionApi
                .deleteItem(apiUrl)
                .then((response) => {
                    context.commit('deleteItemSuccess', response.data)
                    resolve(response)
                })
                .catch((result) => {
                    context.commit('deleteItemFailure', result.response)
                })
        })
    }
}

export default {
    state,
    mutations,
    actions
}
