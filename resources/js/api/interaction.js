import axios from "./axios.js";
import api from 'js-cookie'
import data from 'bootstrap/js/src/dom/data.js'

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

const patchItem = (apiUrl, dataRequest) => {
    return axios.patch(apiUrl, dataRequest)
}

const putItem = (apiUrl, dataRequest) => {
    return axios.put(apiUrl, dataRequest)
}

export default {
    forgotPassword,
    resetPassword,
    getItem,
    setItem,
    patchItem,
    putItem
};
