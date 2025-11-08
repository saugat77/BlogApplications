import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'vue-multiselect/dist/vue-multiselect.min.css'
import './bootstrap';

import Multiselect from 'vue-multiselect'
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js'
import { auth } from './Auth/auth'

const app = createApp(App)

if (localStorage.getItem('auth_token')) {
  auth.fetchUser()
}

app.component('Multiselect', Multiselect)

app.use(router)
app.config.globalProperties.$auth = auth
app.mount('#app')
