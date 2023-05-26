<script>
import VrErrors from '../components/Errors.vue'
import VrLoader from '../components/Loader.vue'

export default {
    name: 'VrRegister',
    components: {
        VrErrors,
        VrLoader,
    },

    data() {
        return {
            login: '',
            password: '',
            disableButtons: '',
        }
    },

    methods: {
        onSubmit() {
            this.$store.dispatch('login', {
                login: this.login,
                password: this.password,
            }).then(() => {
                this.$router.push({ name: 'main' })
            })

        },
    },

    computed: {
        isSubmitting() {
            return this.$store.state.auth.isSubmitting
        },
        validationErrors() {
            return this.$store.state.auth.validationErrors
        },
        isLoading() {
            return this.$store.state.auth.isLoading
        }
    },
}
</script>

<template>
    <div class='main'>
        <vr-loader v-if='isLoading'></vr-loader>
        <div class='main-form'>
            <div class='form-block'>
                <div class='error-block'>
                    <vr-errors v-if='validationErrors'
                               :validation-errors='validationErrors'
                               class='errors'></vr-errors>
                </div>
                <form action='/' @submit.prevent='onSubmit'>
                    <div class='input-wrapper'>
                        <div class='input-wrapper-item'>
                            <label class='input-type'>
                                <input required class='input-type-item' type='text' placeholder='Login' v-model='login'>
                            </label>
                        </div>

                        <div class='input-wrapper-item'>
                            <div class='email-container'>
                                <label class='input-type'>
                                    <input required class='input-type-item' type='password' placeholder='Password'
                                           v-model='password'>
                                </label>
                            </div>
                        </div>
                        <input :disabled='isSubmitting' class='input-submit' type='submit'
                               value='Login'>
                        <div>
                            <a href='https://localhost:8080/'>
                                Forgot password?
                            </a>
                        </div>
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

.form-block form {
    margin-top: 10px;
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

.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip-text {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 10px;
}

.tooltip-text::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: black transparent transparent transparent;
}

.round {
    margin-top: 15px;
    margin-left: 10px;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 2px solid white;
    background: none;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.round span {
    font-size: 15px;
    color: white;
}

.round.active {
    box-shadow: 0 0 15px red;
    border: 2px solid #a61717;
    color: red;
}

.round:hover + .tooltip-text,
.tooltip-text:hover {
    visibility: visible;
    opacity: 1;
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

</style>
