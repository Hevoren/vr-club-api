<script>
import VrErrors from '../components/Errors.vue'
import VrLoader from '../components/Loader.vue'

export default {
    name: 'VrMain',
    components: {
        VrErrors,
        VrLoader
    },

    data() {
        return {
            url: localStorage.getItem('url') || 'http://localhost:8000/api',
            urlError: false,
            showing: false,
            requestMethod: localStorage.getItem('requestMethod') || 'GET',
            disableButtons: false,
            apiEndPoint: '',
            computers: {
                graphic_card: '',
                processor: '',
                ram: '',
            },
            games: {
                game: '',
                age_limit: '',
                duration: '',
                genre: '',
                price: '',
            },
            reservations: {
                login: localStorage.getItem('login'),
                reservation_time: '',
                peoples: '',
                game_id: '',
                room_id: '',
            },
            rooms: {
                type_room: '',
                vr_device_id: '',
                employee_id: '',
                price: '',
            },
            vrdevices: {
                vr_glasses: '',
                controller: '',
                computer_id: '',
            },
            requests: {
                name: '',
                phone_number: '',
            },
        }
    },

    methods: {
        onSubmit() {
            const apiPoint = this.url.substring(this.url.indexOf('http://localhost:8000/api') + 'http://localhost:8000/api'.length)
            this.apiEndPoint = apiPoint.startsWith('i') ? apiPoint.substring(1) : apiPoint
            if (this.requestMethod === 'GET') {
                this.$store.dispatch('getItems', { apiUrl: this.apiEndPoint })
            } if (this.requestMethod === 'POST') {
                if (this.apiEndPoint === '/computers' || this.apiEndPoint === '/computers/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.computers })
                } else if (this.apiEndPoint === '/games' || this.apiEndPoint === '/games/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.games })
                } else if (this.apiEndPoint === '/reservations' || this.apiEndPoint === '/reservations/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.reservations })
                } else if (this.apiEndPoint === '/rooms' || this.apiEndPoint === '/rooms/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.rooms })
                } else if (this.apiEndPoint === '/vrdevices' || this.apiEndPoint === '/vrdevices/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.vrdevices })
                } else if (this.apiEndPoint === '/requests' || this.apiEndPoint === '/requests/') {
                    this.$store.dispatch('setItems', { apiUrl: this.apiEndPoint, dataRequest: this.requests })
                }
            } if (this.requestMethod === 'PATCH') {
                if (this.apiEndPoint.includes("/computers/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.computers), })
                } if (this.apiEndPoint.includes("/games/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.games), })
                } if (this.apiEndPoint.includes("/reservations/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.reservations), })
                } if (this.apiEndPoint.includes("/rooms/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.rooms), })
                } if (this.apiEndPoint.includes("/vrdevices/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.vrdevices), })
                } if (this.apiEndPoint.includes("/requests/")) {
                    this.$store.dispatch('patchItems', { apiUrl: this.apiEndPoint, dataRequest: this.cutObject(this.requests), })
                }
            } if (this.requestMethod === 'PUT') {
                if (this.apiEndPoint.includes("/computers/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.computers })
                } if (this.apiEndPoint.includes("/games/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.games })
                } if (this.apiEndPoint.includes("/reservations/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.reservations })
                } if (this.apiEndPoint.includes("/rooms/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.rooms })
                } if (this.apiEndPoint.includes("/vrdevices/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.vrdevices })
                } if (this.apiEndPoint.includes("/requests/")) {
                    this.$store.dispatch('putItems', { apiUrl: this.apiEndPoint, dataRequest: this.requests })
                }
            } if (this.requestMethod === 'DELETE') {
                this.$store.dispatch('deleteItems', { apiUrl: this.apiEndPoint })
            }
        },
        cutObject(obj) {
            const result = {}
            Object.keys(obj).forEach(key => {
                const value = obj[key]

                if (value) {
                    result[key] = value
                }
            })
            return result
        },

        chekUrl() {
            if (this.url.includes('http://localhost:8000/api')) {
                this.urlError = false
                this.urlErrorFlag(this.urlError)
                this.disableButtons = false
            } else {
                this.urlError = true
                this.urlErrorFlag(this.urlError)
                this.disableButtons = true
            }
        },
        urlErrorFlag(urlError) {
            const round = document.querySelector('.round')
            if (urlError === true) {
                round.classList.add('active')
            } else if (urlError === false) {
                round.classList.remove('active')
            }
        },
        showUrlsGuide() {
            this.showing = !this.showing
        },
    },

    computed: {
        isSubmitting() {
            return this.$store.state.interaction.isSubmitting
        },
        isLoading() {
            return this.$store.state.interaction.isLoading
        },
        disableButton() {
            return this.disableButtons
        },
        responseData() {
            return this.$store.state.interaction
        },
    },

    mounted() {
        this.chekUrl()
    },

    beforeRouteLeave(to, from, next) {
        this.$store.dispatch('resetVariables')
        next()
    },
    watch: {
        url(newUrl) {
            localStorage.setItem('url', newUrl);
            const apiPoint = this.url.substring(this.url.indexOf('http://localhost:8000/api') + 'http://localhost:8000/api'.length)
            this.apiEndPoint = apiPoint.startsWith('i') ? apiPoint.substring(1) : apiPoint
        },
        requestMethod(newMethod) {
            localStorage.setItem('requestMethod', newMethod);
            // ...
        },
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
                        <form action='/' @submit.prevent='onSubmit'>
                            <div class='input-wrapper-item'>
                                <div class='request'>
                                    <select v-model='requestMethod'>
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
                                    <input :disabled='disableButton || isSubmitting' class='input-submit' type='submit'
                                           value='Send'>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
                <div class='enter'>
                    <div class='enter-item-1'>
                        <div v-if='requestMethod === "POST" || requestMethod === "PATCH" || requestMethod === "PUT"'>
                            {
                            <div class='request-action'>
                                <div
                                    v-if='(this.apiEndPoint === "/computers" || this.apiEndPoint.includes("/computers/"))'>
                                    <label for='gp'>"graphic_card":
                                        <input id='gp' v-model='computers.graphic_card'>
                                    </label>
                                    <label for='proc'>"processor":
                                        <input id='proc' v-model='computers.processor'>
                                    </label>
                                    <label for='ram'>"ram":
                                        <input id='ram' v-model='computers.ram'>
                                    </label>
                                </div>

                                <div v-if='(this.apiEndPoint === "/games" || this.apiEndPoint.includes("/games/"))'>
                                    <label for='game'>"game":
                                        <input id='game' v-model='games.game'>
                                    </label>
                                    <label for='age_limit'>"age_limit":
                                        <input type='number' id='age_limit' v-model='games.age_limit'>
                                    </label>
                                    <label for='duration'>"duration":
                                        <input type='number' id='duration' v-model='games.duration'>
                                    </label>
                                    <label for='genre'>"genre":
                                        <input id='genre' v-model='games.genre'>
                                    </label>
                                    <label for='price'>"price":
                                        <input type='number' id='price' v-model='games.price'>
                                    </label>
                                </div>

                                <div v-if='(this.apiEndPoint === "/reservations" || this.apiEndPoint.includes("/reservations/"))'>
                                    <label for='reservation_time'>"reservation_time":
                                        <input type='text' id='reservation_time'
                                               v-model='reservations.reservation_time'>
                                    </label>
                                    <label for='peoples'>"peoples":
                                        <input type='number' id='peoples' v-model='reservations.peoples'>
                                    </label>
                                    <label for='game'>"game":
                                        <input type='number' id='game' v-model='reservations.game_id'>
                                    </label>
                                    <label for='room_id'>"room_id":
                                        <input type='number' id='room_id' v-model='reservations.room_id'>
                                    </label>
                                </div>

                                <div v-if='(this.apiEndPoint === "/rooms" || this.apiEndPoint.includes("/rooms/"))'>
                                    <label for='type_room'>"type_room":
                                        <input type='text' id='type_room' v-model='rooms.type_room'>
                                    </label>
                                    <label for='vr_device_id'>"vr_device_id":
                                        <input type='number' id='vr_device_id' v-model='rooms.vr_device_id'>
                                    </label>
                                    <label for='employee_id'>"employee_id":
                                        <input type='number' id='employee_id' v-model='rooms.employee_id'>
                                    </label>
                                    <label for='price'>"price":
                                        <input type='number' id='price' v-model='rooms.price'>
                                    </label>
                                </div>

                                <div v-if='(this.apiEndPoint === "/vrdevices" || this.apiEndPoint.includes("/vrdevices/"))'>
                                    <label for='vr_glasses'>"vr_glasses":
                                        <input type='text' id='vr_glasses' v-model='vrdevices.vr_glasses'>
                                    </label>
                                    <label for='controller'>"controller":
                                        <input type='text' id='controller' v-model='vrdevices.controller'>
                                    </label>
                                    <label for='computer_id'>"computer_id":
                                        <input type='number' id='computer_id' v-model='vrdevices.computer_id'>
                                    </label>
                                </div>

                                <div v-if='(this.apiEndPoint === "/requests" || this.apiEndPoint.includes("/requests/"))'>
                                    <label for='name'>"name":
                                        <input type='text' id='name' v-model='requests.name'>
                                    </label>
                                    <label for='phone_number'>"phone_number":
                                        <input type='text' id='phone_number' v-model='requests.phone_number'>
                                    </label>
                                </div>

                            </div>
                            }
                        </div>
                    </div>
                    <div class='enter-item-2'>
                        <div class='loader-container' v-if='isLoading'>
                            <vr-loader></vr-loader>
                        </div>
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
@font-face {
    font-family: 'Source Code Pro', monospace;
}
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

.open-url-info {
    font-size: 18px;
    outline: none;
    transition: transform 0.3s ease-in-out;
}

.open-url-info:hover {
    transform: scale(1.1);
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
    font-size: 24px;
    color: red;
    transition: transform 0.5s;
}

.close-button:hover {
    transform: scale(1.2);
    color: #ffffff;
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
    font-family: 'Source Code Pro', monospace;
    width: 50%;
    height: 100%;
    border-radius: 15px;
    border-right: 1px solid black;
}

.request-action div label {
    margin-left: 10px;
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.request-action div label input {
    text-indent: 10px;
    background: none;
    outline: none;
    color: red;
    border-bottom: 2px solid black;
    margin-right: 10px;
    transition: .3s;
}

.request-action div label input:focus {
    border-bottom: 2px solid red;
}

.enter-item-2 {
    font-family: 'Source Code Pro', monospace;
    position: relative;
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

.loader-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
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
