import interactionApi from '../../api/interaction.js'
import { setItem } from '../../helpers/saveLocStorage.js'

const state = {
    isSubmitting: false,
    validationErrors: null,
    isLoading: null,
    responseMessage: null
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
    resetVariablesStart(state) {
        state.isSubmitting = false
        state.validationErrors = null
        state.isLoading = null
        state.responseMessage = null
    },
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
    }

}

const actions = {
    sendEmail(context, credentials) {
        console.log(credentials)
        return new Promise((resolve) => {
            context.commit('forgotpasswordStart')
            interactionApi
                .forgotPassword(credentials)
                .then((response) => {
                    console.log(response)
                    context.commit('forgotpasswordSuccess', response.data.message)
                    resolve(response)
                })
                .catch((result) => {
                    console.log(result);
                    context.commit('forgotpasswordFailure', result)
                })
        })
    },
    resetVariables(context) {
        context.commit('resetVariablesStart')
    },
    resetPassword(context, credentials) {
        return new Promise((resolve) => {
            console.log(credentials)
            context.commit('resetPasswordStart')
            interactionApi
                .resetPassword(credentials)
                .then((response) => {
                    console.log(response)
                    context.commit('resetPasswordSuccess', response.data.message)
                    resolve(response)
                })
                .catch((result) => {
                    console.log(result)
                    context.commit('resetPasswordFailure')
                })
        })
    }

}

export default {
    state,
    mutations,
    actions
}
