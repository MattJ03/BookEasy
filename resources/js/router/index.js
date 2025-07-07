import { createApp } from 'vue';
import { createRouter } from 'vue-router';
import { createWebHistory } from 'vue-router';
import Register from '../views/auth/Register.vue';
import Login from '../views/auth/Login.vue';
import Home from '../views/listings/Home.vue';
import Create from '../views/listings/Create.vue';
import Dashboard from '../views/Dashboard.vue';


const routes = [
    { path: '/register', component: Register },
    { path: '/login', component: Login },
    { path: '/home', component: Home },
    { path: '/create', component: Create },
    { path: '/dashboard', component: Dashboard },
    ];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


