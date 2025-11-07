import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js'
import { auth } from './Auth/auth'

const app = createApp(App)

if (localStorage.getItem('auth_token')) {
  auth.fetchUser()
}

app.use(router)
app.config.globalProperties.$auth = auth
app.mount('#app')
