import { createStore } from "vuex";
import auth from "./modules/auth.js";
import forgotpassword from "./modules/forgotpassword.js";

export default createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        auth,
        forgotpassword
    }
});
