import axios from "./axios.js";

const register = (credentials) => {
    return axios.post("/register", credentials);
};

const login = (credentials) => {
    return axios.post("/login", credentials);
};

const logout = (credentials) => {
    return axios.post("/logout", credentials);
}

const resendEm = (credentials) => {
    return axios.post("/email/verify/resend", credentials)
}

export default {
    register,
    login,
    logout,
    resendEm
};
