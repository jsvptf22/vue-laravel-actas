import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

Vue.prototype.$http = Axios;
Vue.use(VueRouter);

import PLogin from '@/pages/approve/login/PLogin.vue';

const routes = [
    {
        path: '/login',
        component: PLogin
    },
    {
        path: '',
        redirect: '/login'
    }
];

const router = new VueRouter({
    routes
});

export { router as default };
