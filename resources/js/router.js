import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Task1 from './pages/Task1.vue';
import Task2 from './pages/Task2.vue';
import Task3 from './pages/Task3.vue';
import Task4 from './pages/Task4.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/task1',
            name: 'task1',
            component: Task1
        },
        {
            path: '/task2',
            name: 'task2',
            component: Task2
        },
        {
            path: '/task3',
            name: 'task3',
            component: Task3
        },
        {
            path: '/task4',
            name: 'task4',
            component: Task4
        },
    ]
});

export default router;