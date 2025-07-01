import { createApp } from 'vue';
import { createRouter } from 'vue-router';
import { createWebHistory } from 'vue-router';
import Register from '../views/auth/Register.vue';
import Login from '../views/auth/Login.vue';
import Home from '../views/listings/Home.vue';

const routes = [
    { path: '/register', component: Register },
    { path: '/login', component: Login },
    { path: '/home', component: Home },
    ];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


