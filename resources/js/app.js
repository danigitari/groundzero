import { ClientTable } from 'vue-tables-2';
import Vue from 'vue'
import vuetify from './plugins/vuetify'
import VueTextareaAutosize from 'vue-textarea-autosize'
import  firebase from 'firebase/app'
import 'firebase/firestore'
import VueRouter from 'vue-router'
import users from './components/users.vue'
import Home from './components/home.vue'
import Calender from './components/calender'
import Login from './components/login.vue'
import Register from './components/register'
import Parent from './components/parent'
import Dashboard from './components/dashboard'
import Listsessions from './components/listsessions'
import EDIT_SESSIONS from './components/edit_sessions'
import Admin from './components/adminLogin'
import Edit from './components/edit'
import Edit_users from './components/edit_users'
import All_Sessions from './components/allsessions'
import AdminRegister from  './components/adminRegister' 
/*import axios from 'axios'*/
 
Vue.config.productionTip = false
Vue.use(VueTextareaAutosize)
Vue.use(ClientTable);
Vue.use(VueRouter)

firebase.initializeApp({
    apiKey: "AIzaSyBbfFDOjb8FjT4jPbAk-GnbmZRXDvCUV2s",
    authDomain: "ics2302.firebaseapp.com",
    databaseURL: "https://ics2302-default-rtdb.firebaseio.com",
    projectId: "ics2302",
    storageBucket: "ics2302.appspot.com",
    messagingSenderId: "446670503433",
    appId: "1:446670503433:web:f5fdacb1c4a999b34802d8",
    measurementId: "G-DJHY8F6LP6"
});
export const db = firebase.firestore()
const routes = [
    {
        path: '/users',
        name: 'users',
        component: users,
    },
    {
        path: '/adminRegister',
        name: 'adminRegister',
        component: AdminRegister,
    },
    {
        path: '/edit',
        name: 'edit',
        component: Edit,
        props: true
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },
    {
        path: '/allsessions',
        name: 'allsessions',
        component: All_Sessions,
    },
    {
        path: '/edit_users',
        name: 'edit_users',
        component: Edit_users,
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
    },
    {
        path: '/parent',
        name: 'parent',
        component: Parent,
    },
    {
        path: '/edit_sessions',
        name: 'edit_sessions',
        component: EDIT_SESSIONS,
    },
    {
        path: '/calender',
        name: 'calender',
        component: Calender,
    },
    {
        path: '/home',
        name:'home',
        component: Home,
    },
    {
        path: '/register',
        name:'register',
        component: Register,
    },
    {
        path: '/listsessions',
        name:'listsessions',
        component: Listsessions,
    },
    {
        path: '/login',
        name:'login',
        component: Login,
    }

]
const router = new VueRouter({
    routes,
    // mode: "history"
})
Vue.component('calender', () => import('./components/calender'));
Vue.component('home', () => import('./components/home'));
Vue.component('users', () => import('./components/users'));
Vue.component('login', () => import('./components/login'));
Vue.component('register', () => import('./components/register'));
Vue.component('parent', () => import('./components/parent'));
Vue.component('admin', () => import('./components/adminLogin'));
Vue.component('edit_users', () => import('./components/edit_users'));

const app = new Vue({
    vuetify,
    router,
}).$mount('#app');


