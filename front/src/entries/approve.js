import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueSession from 'vue-session';
import moment from 'moment';

Vue.use(VueSession);
Vue.use(BootstrapVue);
Vue.prototype.moment = moment;
Vue.config.productionTip = false;

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import '@/assets/theme/css/pages.min.css';

import PApprove from '@/pages/approve/PApprove.vue';
import router from '@/pages/approve/router';
import store from '@/pages/approve/store';

let vue = new Vue({
    render: h => h(PApprove),
    router,
    store
}).$mount('#app');

vue.$session.destroy();
