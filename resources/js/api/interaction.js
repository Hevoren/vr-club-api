import axios from "./axios.js";

const forgotPassword = (credentials) => {
    return axios.post("/forgot-password", credentials);
}

const resetPassword = (credentials) => {
    return axios.post("/reset-password-action", credentials);
}

export default {
    forgotPassword,
    resetPassword,
};
