import { createWebHashHistory, createRouter } from 'vue-router'

const routes = [
    {
        path: '', 
        component: () => import('./App.vue'), 
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
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router