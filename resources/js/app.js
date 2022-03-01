require("./bootstrap");
import VueRouter from "vue-router";
import { routes } from "./routes";
import store from "./store/index.js";

window.Vue = require("vue").default;

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes: routes,
});

router.beforeEach((to, from, next) => {
    window.document.title =
        to.meta && to.meta.title ? to.meta.title : "Lavisco";
    next();
});

//Vue Components

Vue.component(
    "navbar-component",
    require("./components/NavbarComponent.vue").default
);
Vue.component(
    "footer-component",
    require("./components/FooterComponent.vue").default
);
Vue.component("topnav-component", require("./components/TopNav.vue").default);
Vue.component(
    "dashboard-cards",
    require("./components/admin/DashboardCards.vue").default
);
Vue.component(
    "table-header",
    require("./components/admin/TableHeader.vue").default
);
Vue.component(
    "product-variation",
    require("./components/admin/ProductVariation.vue").default
);
Vue.component("index-component", require("./components/Index.vue").default);
Vue.component("menu-cart", require("./components/CartSmall.vue").default);

Vue.component(
    "success-modal",
    require("./components/SuccessModal.vue").default
);
Vue.component("fail-modal", require("./components/FailModal.vue").default);
Vue.component(
    "success-toast",
    require("./components/SuccessToast.vue").default
);
Vue.component("fail-toast", require("./components/FailToast.vue").default);

//Fire is a new instance of vue which will be used as a bus
window.Fire = new Vue();

/**
 * Fresh Vue application instance.
 */

const app = new Vue({
    el: "#app",
    router: router,
    store,
});
