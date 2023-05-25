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
                const messages = this.validationErrors[name].join(", ");
                return `${messages}`;
            });
        },
    },
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
</style>
