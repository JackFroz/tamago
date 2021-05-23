import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './pages/App'
import Landing from './pages/Landing'
import Login from './pages/Login'
import Register from './pages/Register'
import Home from './pages/Home'
import Profile from './pages/Profile'
import ProjectBoard from './pages/ProjectBoard'
import DivisionBoard from './pages/DivisionBoard'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'landing',
            component: Landing,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
        },
        {
            path: '/project/:id',
            name: 'project-board',
            component: ProjectBoard,
        },
        {
            path: '/division/:id',
            name: 'division-board',
            component: DivisionBoard,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});