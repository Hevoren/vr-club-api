<script>

import VrTopBar from '../js/components/TopBar.vue'
import VrMain from '../js/views/Main.vue'
import VrFooter from '../js/components/Footer.vue'
import VrResetPassword from '../js/views/ResetPassword.vue'

export default {
    name: 'AppComponent',
    components: {
        VrFooter,
        VrMain,
        VrTopBar,
        VrResetPassword,
    },
    mounted() {
        this.$store.dispatch('refreshAuth')
    },
}
</script>

<template>
    <div class='all'>
        <vr-top-bar />
        <router-view />
        <vr-footer />
    </div>
</template>

<style scoped>
</style>
