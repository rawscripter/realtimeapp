import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from '../components/Login/Login'
import Signup from "../components/Login/Signup";
import Forum from "../components/Forum/Forum";
import Create from "../components/Forum/Create";
import Logout from "../components/Logout";
import SingleQuestion from "../components/Forum/SingleQuestion";
import EditQuestion from "../components/Forum/EditQuestion";


const routes = [
    {path: '/login', component: Login},
    {path: '/signup', component: Signup},
    {path: '/forum', component: Forum, name: 'forum'},
    {path: '/ask', component: Create},
    {path: '/logout', component: Logout},
    {path: '/question/:slug', component: SingleQuestion, name: 'SingleQuestion'},
    {path: '/edit/:slug', component: EditQuestion, name: 'EditQuestion'},

]

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router