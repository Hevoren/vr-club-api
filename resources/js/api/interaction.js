import axios from "./axios.js";

const forgotPassword = (credentials) => {
    return axios.post("/forgot-password", credentials);
}

const resetPassword = (credentials) => {
    return axios.post("/reset-password-action", credentials);
}

const getItem = (apiUrl) => {
    return axios.get(apiUrl);
}

const setItem = (apiUrl, dataRequest) => {
    return axios.post(apiUrl, dataRequest);
}

export default {
    forgotPassword,
    resetPassword,
    getItem,
    setItem
};
