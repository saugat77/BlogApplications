import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js'

const app = createApp(App)

const URL = import.meta.env.API_BASE_URL;

const token = localStorage.getItem('auth_token');

if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

app.use(router)
app.mount('#app')
