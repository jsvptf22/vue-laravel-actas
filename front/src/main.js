import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import VueSession from 'vue-session';

Vue.use(VueSession)
Vue.use(BootstrapVue);
Vue.config.productionTip = false;

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import router from "./router";
import App from "./App.vue";

new Vue({
    render: h => h(App),
    router
}).$mount("#app");
