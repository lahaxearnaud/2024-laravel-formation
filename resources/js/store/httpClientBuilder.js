import axios from "axios";

let instance = undefined;

export default function (token) {
    if (instance) {
        return instance;
    }

    if (token) {
        axios.defaults.headers = {
            'Authorization': 'Bearer ' + token
        }
    }

    return instance = axios.create({
        baseURL: '/api/',
        timeout: 1000,
        withCredentials: true,
        withXSRFToken: true
    });
}
