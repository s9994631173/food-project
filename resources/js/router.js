import { createWebHashHistory, createRouter } from 'vue-router'

const routes = [
    {
        path: '', 
        component: () => import('./components/appComponent.vue'), 
        name: 'home'
    },
    {
        path: '/login', 
        component: () => import('./components/loginComponent.vue'), 
        name: 'login'
    },
    {
        path: '/register', 
        component: () => import('./components/registerComponent.vue'), 
        name: 'register'
    },
    {
        path: '/app', 
        component: () => import('./components/appComponent.vue'), 
        name: 'app'
    },
    {
        path: '/m', 
        component: () => import('./components/mobileComponent.vue'), 
        name: 'mobile'
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router