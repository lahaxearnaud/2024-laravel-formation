import { createApp } from "vue";
import { createPinia } from 'pinia'

import App from "./components/App.vue";
import httpClientBuilder from "./store/httpClientBuilder.js";


const app = createApp(App);
const pinia = createPinia()


const el = document.getElementById('app');

httpClientBuilder(el.dataset.token ?? '');

app.use(pinia)

app.mount(el)
