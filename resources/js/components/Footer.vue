<script>
export default {
    name: "VrFooter"
}
</script>

<template>
    <div class='footer-template'>
        <div class='footer-template-items'>
            <div class='footer-template-item1'>
                <p>© 2023 - All rights reserved</p>
            </div>
            <div class='footer-template-item2'>
                <p>vrclubtomsk@gmail.com</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.footer-template {
    margin: auto;

}

.footer-template-items {
    height: 5vh;
    display: flex;
    flex-direction: row;
    font-size: 16px;
    text-align: center;
}

.footer-template-item1 {
    width: 50%;
}

.footer-template-item2 {
    width: 50%;
}
</style>
