import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Access from "./components/access/Access.vue";
import Dashboard from "./components/dashboard/Dashboard.vue";

const routes = [
    {
        path: "/access",
        component: Access
    },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: { requiresAuth: true }
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem("token")) {
            next({
                path: "/access"
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export { router as default };
