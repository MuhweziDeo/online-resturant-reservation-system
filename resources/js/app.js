import Vue from "vue";
import Router from "vue-router";
import Antd from 'ant-design-vue';
import App from "./components/App.vue";
import Login from "./components/Login.vue";
import Dashboard from "./components/dashboard";
import store from "./store";
import 'ant-design-vue/dist/antd.css';

Vue.use(Router);
Vue.use(Antd);

const router = new Router({
    routes: [
        {
            path: '/',
            component: Dashboard,
            name: 'dashboard',
            beforeEnter: (to, from, next) => {
                const token = localStorage.getItem("token");
                if(!token) next('/login');
                else next();
            }
        },
        {
            path: '/login',
            component: Login,
            name: 'login',
            beforeEnter:(to, from, next) => {
                const token = localStorage.getItem("token");
                if(token) next('/');
                else next();
            }
        }
    ],
    mode: 'history'
})


const app = new Vue({
    router,
    el: "#app",
    store,
    components: {App}
})
