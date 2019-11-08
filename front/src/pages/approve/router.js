import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

Vue.prototype.$http = Axios;
Vue.use(VueRouter);

import PLogin from '@/pages/approve/login/PLogin.vue';

const routes = [
    {
        path: '/login/:documentId',
        component: PLogin,
        props: true
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
