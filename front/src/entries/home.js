import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueSession from 'vue-session';

Vue.use(VueSession);
Vue.use(BootstrapVue);
Vue.config.productionTip = false;

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import '@/assets/theme/css/pages.min.css';

import PHome from '@/pages/home/PHome.vue';
import router from '@/pages/home/router';
import store from '@/store';

let vue = new Vue({
    render: h => h(PHome),
    router,
    store
}).$mount('#app');

vue.$session.destroy();
