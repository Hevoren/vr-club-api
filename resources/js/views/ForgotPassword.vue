<script>
import VrLoader from '../components/Loader.vue'
import VrErrors from '../components/Errors.vue'

export default {
    name: 'VrForgotPassword',
    components: {
        VrErrors,
        VrLoader
    },

    data() {
        return {
            email: '',
            emailError: '',
            disableButtons: ''
        }
    },

    methods: {
        onSubmit() {
            if (this.email) {
                this.$store.dispatch('sendEmail', {
                    email: this.email
                })
            }
        },

        validateEmail() {
            if (!this.email) {
                this.emailError = ''
                this.disableButtons = true
            } else if (!this.email.includes('@')) {
                this.emailError = 'Invalid email format'
                this.disableButtons = true
            } else {
                this.emailError = ''
                this.disableButtons = false
            }
        },
    },

    mounted() {
        this.validateEmail()
    },

    computed: {
        isSubmitting() {
            return this.$store.state.interaction.isSubmitting
        },
        isLoading() {
            return this.$store.state.interaction.isLoading
        },
        disableButton() {
            return this.disableButtons
        },
        responseMessage() {
            return this.$store.state.interaction.responseMessage
        }
    },
    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables');
        next();
    }
}
</script>

<template>
    <div class='main'>
        <vr-loader v-if='isLoading'></vr-loader>
        <div class='main-form'>
            <div class='form-block'>
                <p class='form-block-title'>Forgot password?</p>
                <div class='error-block'>
                </div>
                <div class='successMessage'>
                    <p v-if='responseMessage'>{{responseMessage}}</p>
                </div>
                <form action='/' @submit.prevent='onSubmit'>
                    <div class='input-wrapper'>
                        <div class='input-wrapper-item'>
                            <div class='email-container'>
                                <label class='input-type'>
                                    <input required class='input-type-item' type='email' placeholder='Email'
                                           v-model='email' @input='validateEmail'>
                                </label>
                                <div v-if='emailError' class='error-message'><p>{{ emailError }}</p></div>
                            </div>
                        </div>

                        <input :disabled='isSubmitting || disableButton' class='input-submit' type='submit'
                               value='Send'>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<style scoped>
.main {
    min-height: 88vh;
    display: flex;
    flex-direction: column;
    height: fit-content;
}


.main-form {
    display: flex;
    flex-direction: column;
    max-width: 350px;
    margin-top: 200px;
}

.form-block {
    margin: 0;
    max-width: 350px;
}

.form-block-title {
    text-align: center;
    font-size: 32px;
}

.form-block-title {
    text-align: center;
    font-size: 32px;
}

.successMessage {
    font-size: 14px;
    color: green;
}

.input-wrapper {

    display: flex;
    flex-direction: column;
}

.input-wrapper-item {
    display: flex;
    flex-direction: row;
}

.email-container {
    position: relative;
    display: flex;
}

.error-message {
    position: absolute;
    left: 100%;
    top: 0;
    white-space: nowrap;
    padding-left: 10px;
    color: #a61717;
}

.error-message p { /* 2 */
    margin-top: 15px;
}


.round span {
    font-size: 15px;
    color: white;
}

.input-type {
    height: 40px;
    min-width: 350px;
    width: 100%;
    border-radius: 10px;
    border: 2px solid #a61717;
    box-shadow: none;
    margin-top: 10px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.input-type-item {
    text-indent: 10px;
    background: none;
    border: none;
    color: white;
    width: 100%;
    height: 100%;
    text-align: left;
    transition: 0.2s;
}

.input-type-item:focus {
    box-shadow: 0 0 20px #ea2121;
    outline: none;
}

.input-type:focus {
    box-shadow: none;
}

.input-submit {
    border: 2px solid #a61717;
    cursor: pointer;
    border-radius: 10px;
    margin-top: 10px;
    padding: 10px;
    width: 100%;
    background: none;
    transition: 0.5s;
}

.input-submit:hover {
    background-color: #720f0f;
}

.offer {
    margin: 0;
    margin-top: 15px;
}

.offer a {
    transition: .5s;
}

.offer a:hover {
    color: #a61717;
}
</style>

