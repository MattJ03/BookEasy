import { createApp } from 'vue';
import { createRouter } from 'vue-router';
import { createWebHistory } from 'vue-router';
import Register from '../views/auth/Register.vue';


const routes = [
    { path: '/register', component: Register },
    ];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


