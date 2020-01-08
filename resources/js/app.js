import Vue from "vue";
import Router from "vue-router";
import Antd from 'ant-design-vue';
import App from "./components/App.vue";
import 'ant-design-vue/dist/antd.css';

Vue.use(Router);
Vue.use(Antd);

const router = new Router({
    routes: [
        {
            path: '/',
            component: {template:  `
            <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'hello' }">Hello World</router-link>
            </p>
            `},
            name: 'home'
        },
        {
            path: '/hello',
            component: {template:  `
            <p>
            <router-link :to="{ name: 'home' }">Hello</router-link> |
            <router-link :to="{ name: 'hello' }">Hello World</router-link>
            </p>
            `},
            name: 'hello'
        }
    ],
    mode: 'history'
})


const app = new Vue({
    router,
    el: "#app",
    components: {App}
})
