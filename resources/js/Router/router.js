import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from '../components/Login/Login'
import Signup from "../components/Login/Signup";
import Forum from "../components/Forum";
import Logout from "../components/Logout";

const routes = [
    {path: '/login', component: Login},
    {path: '/signup', component: Signup},
    {path: '/forum', component: Forum, name: 'forum'},
    {path: '/logout', component: Logout},
]

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router