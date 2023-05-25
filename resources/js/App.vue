<script>

import VrTopBar from '@/components/TopBar.vue'
import VrMain from '@/views/Main.vue'
import VrFooter from '@/components/Footer.vue'
export default {
    name: 'AppComponent',
    components: {
        VrFooter,
        VrMain,
        VrTopBar
    }
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
