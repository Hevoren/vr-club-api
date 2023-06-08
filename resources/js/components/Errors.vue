<script>
export default {
    name: 'VrErrors',
    props: {
        validationErrors: {
            type: Object,
            required: true,
        },
    },
    computed: {
        errorMessages() {
            return Object.keys(this.validationErrors).map((name) => {
                const messages = this.validationErrors[name];
                return `${messages}`;
            });
        },
    },
    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables');
        next();
    }
}
</script>

<template>
    <ul class='error-messages' v-for='errorMessage in errorMessages' :key='errorMessage'>
        <li style='color: red; align-items: flex-start' >
            {{ errorMessage }}
        </li>
    </ul>
</template>

<style scoped>
.error-messages {
    list-style-type: disc
;
}
</style>
