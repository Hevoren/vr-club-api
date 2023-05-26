<script>
export default {
    name: "VrTopVar"
}

</script>

<template>
    <nav class='header-template'>
        <div class='header'>
            <div class='header-logo'>
                <router-link to="main"><p>VR CLUB <span>API</span></p></router-link>
            </div>
            <div class='header-menu'>
                <div class='header-menu-item'>
                    <router-link to='login' exact active-class="active">Sign In</router-link>
                    <router-link to='register' exact active-class="active">Sign Up</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.header-template {
    height: 7vh;
    background-image: linear-gradient(to bottom, rgba(29, 29, 32, 1), rgba(255, 255, 255, 0));
}

.header {
    height: 7vh;
    display: flex;
    flex-direction: row;
}

.header-logo {
    text-align: center;
    width: 50%;
}

    .header-logo p {
        font-size: 32px;
    }

    .header-logo p span {
        color: #eb2403;
    }

.header-menu {
    width: 50%;
    display: flex;
    justify-content: center;
}

.header-menu-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 200px;
}

    .header-menu a {
        margin-right: 10px;
        font-size: 18px;
        transition: 0.5s;
    }

    .header-menu a:hover {
        color: #eb2403;
    }

    .header-menu a.active {
        color: #eb2403;
    }
</style>
