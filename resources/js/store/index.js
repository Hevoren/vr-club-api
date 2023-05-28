import { createStore } from "vuex";
import auth from "./modules/auth.js";
import interaction from "./modules/interaction.js";

export default createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        auth,
        interaction
    }
});
