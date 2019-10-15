import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

Vue.prototype.$http = Axios;
Vue.use(VueRouter);

import PDocumentBuilder from '@/pages/home/documentBuilder/PDocumentBuilder.vue';
import PDocumentBuilderRoutes from '@/pages/home/documentBuilder/router';
import PStats from '@/pages/home/stats/PStats.vue';

const routes = [
    {
        path: '/stats',
        component: PStats
    },
    {
        path: '/document',
        component: PDocumentBuilder,
        children: PDocumentBuilderRoutes
    },
    {
        path: '',
        redirect: '/stats'
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (!router.app.$session.exists()) {
        let key = localStorage.getItem('key');
        let token = localStorage.getItem('token');

        if (!key || !token) {
            throw 'Debe iniciar sesión';
        }

        Axios.request({
            url: `${process.env.VUE_APP_MODULE_API_ROUTE}auth/checkSaiaToken`,
            method: 'post',
            responseType: 'json',
            data: {
                key,
                token
            }
        })
            .then(response => {
                router.app.$session.start();
                router.app.$session.set('key', key);
                router.app.$session.set(
                    'externalToken',
                    response.externalToken
                );
                router.app.$session.set(
                    'apiToken',
                    'Bearer ' + response.data.apiToken
                );

                next();
            })
            .catch(response => {
                console.error(response.message);
                next(false);
            });
    } else {
        next();
    }
});

export { router as default };
