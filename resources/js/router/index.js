import { createApp } from 'vue';
import { createRouter } from 'vue-router';
import { createWebHistory } from 'vue-router';
import Register from '../views/auth/Register.vue';
import Login from '../views/auth/Login.vue';


const routes = [
    { path: '/register', component: Register },
    { path: '/login', component: Login },
    { path: '/listing/index', component: Listing}
    ];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


