require('./bootstrap');


import { createApp } from 'vue'
import router from './router/router';
import store from './store/store';
import VueCookies from 'vue3-cookies';
import '../css/app.css';

import MainApp from './components/App'

const app = createApp({})
app.use(VueCookies, {
    expireTimes: "1d",
    path: "/",
    domain: "",
    secure: true,
    sameSite: "None"
});
app.component('main-app', MainApp)

app.use(store).use(router).mount('#app')