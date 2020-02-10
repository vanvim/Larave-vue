require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import 'ant-design-vue/dist/antd.css';
Vue.use(VueRouter)
import Toasted from 'vue-toasted'
Vue.use(Toasted, {
    duration: 1000
})
let routes = [
    {
        path: '/',
        component: require('./components/dashboard.vue').default
    },{
        path: '/course',
        component: require('./components/course/List.vue').default
    },
    {
        path: '/class',
        component: require('./components/Class/List.vue').default
    },
    {
        path: '/student',
        component: require('./components/Student/List.vue').default
    },
    {
        path: '/teacher',
        component: require('./components/Teacher/List.vue').default
    },
    {
        path: '/pay',
        component: require('./components/Pay/List.vue').default
    },
    {
        path: '/qualification',
        component: require('./components/Qualification/List.vue').default
    },
    {
        path: '/Img',
        component: require('./components/Upload/List.vue').default
    },
]

const router = new VueRouter({
    routes
})
const app = new Vue({
    el: '#app',
    router
});
