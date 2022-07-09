import './bootstrap';

import { createApp } from 'vue'
import router from './router'
import Store from './store.js'

import App from './App.vue'


const app = createApp(App)
app.use(router)
app.use(Store)
app.mount('#app')
