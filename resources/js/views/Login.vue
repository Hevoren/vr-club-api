<script>
import VrErrors from '@/components/Errors.vue'

export default {
    name: 'VrLogin',
    components: { VrErrors },
}
</script>

<template>
    <div class='main'>
        <div class='main-form'>
            <div class='form-block'>
                <p class='form-block-title'>Sign In</p>
                <div class='error-block'>
                    <vr-errors v-if='validationErrors'
                               :validation-errors='validationErrors'
                               class='errors'></vr-errors>
                </div>
                <form action='/' @submit.prevent='onSubmit'>
                    <div class='input-wrapper'>
                        <label class='input-type'>
                            <input required class='input-type-item' type='text' placeholder='Login' v-model='login'>
                        </label>

                        <label class='input-type'>
                            <input required class='input-type-item' type='password' placeholder='Password'
                                   v-model='password'>
                        </label>

                        <input :disabled="isSubmitting" class='input-submit' type='submit' value='Login'>
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
    width: 350px;
    margin-top: 200px;
}

.form-block {
    margin: 0;
    width: 350px;
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

.input-type {
    height: 40px;
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
