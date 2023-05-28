<script>
import VrErrors from '../components/Errors.vue'
import VrLoader from '../components/Loader.vue'

export default {
    name: 'VrMain',
    components: {
        VrErrors,
        VrLoader,
    },

    data () {
        return {
            url: 'http://localhost:8000/api',
            urlError: false,
            showing: false,
            selected: 'GET',
            disableButtons: false,
            apiEndPoint: '',
            computers: {
                graphic_card: '',
                processor: '',
                ram: ''
            },
            games: {
                game: '',
                age_limit: '',
                duration: '',
                genre: '',
                price: ''
            },
            reservations: {
                login: localStorage.getItem('login'),
                reservation_time: '',
                peoples: '',
                game_id: '',
                room_id: ''
            }
        }
    },

    methods: {
        onSubmit() {
            const apiEndPoint = this.url.substring(this.url.indexOf('http://localhost:8000/api') + 'http://localhost:8000/api'.length);
            this.apiEndPoint = apiEndPoint.startsWith('i') ? apiEndPoint.substring(1) : apiEndPoint;
            const lastChar = this.apiEndPoint.slice(-1);

            if (this.selected === 'GET') {
                if (this.apiEndPoint === '/computers' || `/computers/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                } else if (this.apiEndPoint === '/games' || `/games/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                } else if (this.apiEndPoint === '/reservations' || `/reservaions/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                } else if (this.apiEndPoint === '/rooms' || `/rooms/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                } else if (this.apiEndPoint === '/vrdevices' || `/vrdevice/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                } else if (this.apiEndPoint === '/requests' || `/requests/${lastChar}`) {
                    this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint });
                }
            } if (this.selected === 'POST') {
                if (this.apiEndPoint === '/computers' || this.apiEndPoint === '/computers/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.computers })
                } else if (this.apiEndPoint === '/games' || this.apiEndPoint === '/games/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.games })
                } else if (this.apiEndPoint === '/reservations' || this.apiEndPoint === '/reservations/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.reservations })
                }
            }
        },
        chekUrl() {
            if (this.url.includes('http://localhost:8000/api')){
                this.urlError = false
                this.urlErrorFlag(this.urlError)
                this.disableButtons = false
            } else {
                this.urlError = true
                this.urlErrorFlag(this.urlError)
                this.disableButtons = true
            }
        },
        urlErrorFlag(urlError){
            const round = document.querySelector('.round')
            if (urlError === true) {
                round.classList.add('active')
            } else if (urlError === false) {
                round.classList.remove('active')
            }
        },
        showUrlsGuide(){
            this.showing = !this.showing
        }
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
        },
        disableButton() {
            return this.disableButtons
        },
        responseData () {
            return this.$store.state.interaction
        }
    },

    mounted() {
        this.chekUrl()
    },

    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables')
        next()
    },

    watch: {
        url(newValue, oldValue) {
            const apiEndPoint = this.url.substring(this.url.indexOf('http://localhost:8000/api') + 'http://localhost:8000/api'.length);
            this.apiEndPoint = apiEndPoint.startsWith('i') ? apiEndPoint.substring(1) : apiEndPoint;
            const lastChar = this.apiEndPoint.slice(-1);
            console.log(apiEndPoint)
        },
    }
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
                        <form action='/' @submit.prevent='onSubmit'>
                            <div class='input-wrapper-item'>
                                <div class='request'>
                                    <select v-model='selected'>
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
                                               v-model='url' @input='chekUrl'>
                                    </label>
                                    <div class='tooltip'>
                                        <div class='round'><span>!</span></div>
                                        <div class='tooltip-text'>The URL must contain "http://localhost:8000/api/"
                                        </div>
                                    </div>
                                </div>

                                <div class='submit-button'>
                                    <input :disabled='disableButton' class='input-submit' type='submit'
                                           value='Send'>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
                <div class='enter'>
                    <div class='enter-item-1'>
                        <div v-if='selected === "POST"'>
                            {
                            <div class='request-action'>
                                <label for='gp' v-if='(apiEndPoint === "/computers" || apiEndPoint === "/computers/")'>"graphic_card":
                                    <input id='gp' v-model='computers.graphic_card'>
                                </label>
                                <label for='proc' v-if='(apiEndPoint === "/computers" || apiEndPoint === "/computers/")'>"processor":
                                    <input id='proc' v-model='computers.processor'>
                                </label>
                                <label for='ram' v-if='(apiEndPoint === "/computers" || apiEndPoint === "/computers/")'>"ram":
                                    <input id='ram' v-model='computers.ram'>
                                </label>
                                <label for='game' v-if='(apiEndPoint === "/games" || apiEndPoint === "/games/")'>"game":
                                    <input id='game' v-model='games.game'>
                                </label>
                                <label for='age_limit' v-if='(apiEndPoint === "/games" || apiEndPoint === "/games/")'>"age_limit":
                                    <input type='number' id='age_limit' v-model='games.age_limit'>
                                </label>
                                <label for='duration' v-if='(apiEndPoint === "/games" || apiEndPoint === "/games/")'>"duration":
                                    <input type='number' id='duration' v-model='games.duration'>
                                </label>
                                <label for='genre' v-if='(apiEndPoint === "/games" || apiEndPoint === "/games/")'>"genre":
                                    <input id='genre' v-model='games.genre'>
                                </label>
                                <label for='price' v-if='(apiEndPoint === "/games" || apiEndPoint === "/games/")'>"price":
                                    <input type='number' id='price' v-model='games.price'>
                                </label>
                                <label for='reservation_time' v-if='(apiEndPoint === "/reservations" || apiEndPoint === "/reservations/")'>"reservation_time":
                                    <input type='text' id='reservation_time' v-model='reservations.reservation_time'>
                                </label>
                                <label for='peoples' v-if='(apiEndPoint === "/reservations" || apiEndPoint === "/reservations/")'>"peoples":
                                    <input type='number' id='peoples' v-model='reservations.peoples'>
                                </label>
                                <label for='game' v-if='(apiEndPoint === "/reservations" || apiEndPoint === "/reservations/")'>"game":
                                    <input type='number' id='game' v-model='reservations.game_id'>
                                </label>
                                <label for='room_id' v-if='(apiEndPoint === "/reservations" || apiEndPoint === "/reservations/")'>"room_id":
                                    <input type='number' id='room_id' v-model='reservations.room_id'>
                                </label>
                            </div>
                            }
                        </div>
                    </div>
<!--                    "graphic_card": "graphic_card",-->
<!--                    "processor": "processor",-->
<!--                    "ram": "ram"-->
                    <div class='enter-item-2'>
                        <div>
                            <div v-if='!responseData.error'>
                                <pre>{{ responseData.data }}</pre>
                            </div>
                            <div v-else>
                                <pre>{{ responseData.error.data }}</pre>
                            </div>
                        </div>

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
    width: 100%;
}

.enter-item-1 {
    width: 50%;
    height: 100%;
    border-radius: 15px;
    border-right: 1px solid black;
}

.request-action {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.request-action label{
    margin: 0;
    margin-left: 30px;
    margin-top: 10px;

    float: left;
}

.request-action label input {
    float: right;
    text-indent: 10px;
    margin-left: 10px;
    background: none;
    outline: none;
    border: 1px solid red;
}

.enter-item-2 {
    width: 50%;
    height: 100%;
    overflow: auto;
}

.enter-item-2::-webkit-scrollbar-thumb {
    background-color: #fff;
    border-radius: 10px;
    width: 5px;
}

.enter-item-2::-webkit-scrollbar-thumb:hover {
    background-color: #9d9d9d;
}

.enter-item-2::-webkit-scrollbar {
    width: 10px;
    height: 10px;
    background-color: #000;
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


.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip-text {
    visibility: hidden;
    width: 150px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-bottom: 10px;
    margin-left: -70px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 10px;
}

.tooltip-text::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    border-width: 5px;
    border-style: solid;
    border-color: black transparent transparent transparent;
}

.round {
    margin-right: 10px;
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
