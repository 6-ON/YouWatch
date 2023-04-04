import axios from "axios";
export default defineNuxtPlugin((nuxtApp) => {
    const defaultUrl = "http://localhost:8000";

    let instance = axios.create({
        baseURL: defaultUrl,
        withCredentials : true,
    });
    return {
        provide: {
            axios: instance,
        },
    };
});