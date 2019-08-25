import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import PAccess from "./components/access/PAccess.vue";
import PDashboard from "./components/dashboard/PDashboard.vue";
import PDashboardRoutes from "./components/dashboard/router";

const routes = [
    {
        path: "/access",
        component: PAccess
    },
    {
        path: "/dashboard",
        component: PDashboard,
        meta: { requiresAuth: true },
        children: PDashboardRoutes
    },
    {
        path: "",
        redirect: "/access"
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!router.app.$session.exists()) {
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
