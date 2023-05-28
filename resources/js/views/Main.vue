<script>
export default {
    name: 'VrMain',
    data () {
        return {
            url: 'http://localhost:8080/api',
            showing: false,
        }
    },

    methods: {
        showUrlsGuide(){
            console.log('showingBef', this.showing)
            this.showing = !this.showing
            console.log('showingAft', this.showing)
        }
    },

    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables')
        next()
    },
}
</script>

<template>
    <div class='main'>
        <div class='url-info-overlay' v-if='showing === true'></div>
        <div class='url-info-item' v-if='showing === true'>
            <div class='close-url-info'>
                <button class='close-button' v-if='showing === true' @click='showUrlsGuide()'>&#x2716;</button>
            </div>
            <div class='urls'>
                <div class='urls-names'>
                    <p><span style='color: green'>GET</span></p>
                    <p><span style='color: yellow'>POST</span></p>
                    <p><span style='color: blue'>PUT</span></p>
                    <p><span style='color: violet'>PATCH</span></p>
                    <p><span style='color: red'>DELETE</span></p>
                </div>
                <div class='urls-item'>
                    <div class='url-block'>
                        <p>"/computers/{id}?"</p>
                        <p>"/computers/"</p>
                        <p>"/computers/{id}"</p>
                        <p>"/computers/{id}"</p>
                        <p>"/computers/{id}"</p>
                    </div>
                    <div class='url-block'>
                        <p>"/games/{id}?"</p>
                        <p>"/games/"</p>
                        <p>"/games/{id}"</p>
                        <p>"/games/{id}"</p>
                        <p>"/games/{id}"</p>
                    </div>
                    <div class='url-block'>
                        <p>"/reservations/{id}?"</p>
                        <p>"/reservations/"</p>
                        <p>"/reservations/{id}"</p>
                        <p>"/reservations/{id}"</p>
                        <p>"/reservations/{id}"</p>
                    </div>
                    <div class='url-block'>
                        <p>"/rooms/{id}?"</p>
                        <p>"/rooms/"</p>
                        <p>"/rooms/{id}"</p>
                        <p>"/rooms/{id}"</p>
                        <p>"/rooms/{id}"</p>
                    </div>
                    <div class='url-block'>
                        <p>"/vrdevices/{id}?"</p>
                        <p>"/vrdevices/"</p>
                        <p>"/vrdevices/{id}"</p>
                        <p>"/vrdevices/{id}"</p>
                        <p>"/vrdevices/{id}"</p>
                    </div>
                    <div class='url-block'>
                        <p>"/requests/{id}?"</p>
                        <p>"/requests/"</p>
                        <p>"/requests/{id}"</p>
                        <p>"/requests/{id}"</p>
                        <p>"/requests/{id}"</p>
                    </div>
                </div>
            </div>
        </div>
        <div class='main-item'>
            <div class='url-info'>
                <button class='open-url-info' @click='showUrlsGuide()'>Available urls</button>
            </div>
            <div class='first-test-block'>
                <div class='adress-bar'>
                    <div class='bar'>
                        <form>
                            <div class='input-wrapper-item'>
                                <div class='request'>
                                    <select>
                                        <option style='color: green'>GET</option>
                                        <option style='color: yellow'>POST</option>
                                        <option style='color: blue'>PUT</option>
                                        <option style='color: violet'>PATCH</option>
                                        <option style='color: red'>DELETE</option>
                                    </select>
                                </div>

                                <div class='url-container'>
                                    <label class='input-type'>
                                        <input required class='input-type-item' type='text' placeholder='url'
                                               v-model='url'>
                                    </label>
                                </div>

                                <div class='submit-button'>
                                    <input class='input-submit' type='submit'
                                           value='Send'>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
                <div class='enter'>
                    <div class='enter-item-1'>

                    </div>
                    <div class='enter-item-2'>

                    </div>
                </div>
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

.main-item {
    display: flex;
    flex-direction: column;
}

.url-info {
    margin: 0;
    height: 5%;
}

.open-url-info button {
    font-size: 18px;
    transition: 0.5s;
    outline: none;
}

.open-url-info:hover {
    color: red;
}

.url-info-item {
    width: 900px;
    height: 600px;
    border-radius: 15px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    background-color: #282828;
    border: 2px solid red;
    display: flex;
    flex-direction: column;;
}

.urls {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
}

.urls-names {
    height: 10%;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    width: 100%;
}

.urls-item {
    width: 100%;
    height: 90%;
    display: flex;
    flex-direction: column;
}

.url-block {
    display: flex;
    flex-direction: row;
    border: 2px dashed black;
    align-items: center;
    height: 40px;
    width: 100%;
    justify-content: space-around;
}

.url-block p {
    vertical-align: middle;
    margin-left: 15px;
    width: 20%;
}

.url-info-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9998;
}

.close-url-info {
    margin: 0;
    text-align: right;
}

.close-button {
    margin-top: 10px;
    margin-right: 10px;
    transition: .5s;
    font-size: 24px;
}

.close-button:hover {
    color: red;
}

.first-test-block {
    height: 95%;
    display: flex;
    flex-direction: column;
    width: 800px;
    height: 500px;
    background-color: #232222;
    border: 1px solid black;
    border-radius: 15px;
}

.adress-bar {
    height: 10%;
}

.bar {
    height: 100%;
    width: 800px;
    border: 1px solid black;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bar form {
    width: 100%;
}

.enter {
    height: 90%;
    display: flex;
    flex-direction: row;
}

.enter-item-1 {
    width: 50%;
    height: 100%;
    min-width: 400px;
    //border: 2px solid green; /* зеленый цвет */
}

.enter-item-2 {
    width: 50%;
    height: 100%;
    min-width: 400px;
    //border: 2px solid red;
}

.input-wrapper-item {
    display: flex;
    flex-direction: row;
}

.url-container {
    position: relative;
    display: flex;
    width: 75%;
    border-left: 1px solid rgba(128, 128, 128, 0.5);
    border-right: 1px solid rgba(128, 128, 128, 0.5);
}

.input-type {
    height: 40px;
    min-width: 500px;
    width: 100%;
    border-radius: 10px;
    box-shadow: none;
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
    border: 1px solid #a61717;
    box-shadow: 0 0 20px #ea2121;
    outline: none;
}

.input-type:focus {
    box-shadow: none;
}

.request {
    height: 40px;
    width: 10%;
    display: flex;
}


.request select {
    text-indent: 5px;
    height: 100%;
    width: 100%;
    border: none;
    outline: none;
    background: none;
    font-size: 16px;
    position: relative;
}

.request select option {
    font-size: 16px;
    font-weight: bold;
    background-color: #282828;
    border-radius: 15px;
}

.submit-button {
    text-align: center;
    width: 15%;
    height: 40px;
}

.input-submit {
    background-color: #720f0f;
    border: none;
    cursor: pointer;
    border-radius: 10px;
    width: 70%;
    height: 100%;
    transition: 0.5s;
}

.input-submit:hover {
    background-color: #480c0c;
}
</style>
