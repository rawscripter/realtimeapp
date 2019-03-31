import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from '../components/Login/Login'
const routes = [
    { path: '/login', component: Login },
    { path: '/ask-question', component: Login },
]

const router = new VueRouter({
    routes ,
    hashbang: false,
    mode: 'history'
})

export default router