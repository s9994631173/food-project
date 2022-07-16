import './bootstrap';

import { createApp } from 'vue'
import router from './router'
import Store from './store.js'
import VueClickAway from "vue3-click-away";
import Notifications from '@kyvg/vue3-notification'
import 'v-calendar/dist/style.css';
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';

import App from './App.vue'


const app = createApp(App)
app.use(router)
app.use(Store)
app.use(VueClickAway)
app.use(Notifications)
app.use(SetupCalendar, {})
app.component('Calendar', DatePicker)
app.mount('#app')
