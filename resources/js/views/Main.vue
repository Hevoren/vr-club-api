<script>
export default {
    name: "VrMain",
    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables');
        next();
    }
}
</script>

<template>
    <div class='main'>
        <div class='first-test-block'>

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
</style>
