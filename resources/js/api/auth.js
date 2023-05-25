import axios from "./axios.js";

const register = (credentials) => {
    return axios.post("/register", credentials);
};

const login = (credentials) => {
    return axios.post("/login", credentials);
};

export default {
    register,
    login
};
