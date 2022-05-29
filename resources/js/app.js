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
    scrollBehavior(to, from, savedPosition) {
        document.getElementById("app").scrollIntoView();
    },
});

router.beforeEach((to, from, next) => {
    window.document.title =
        to.meta && to.meta.title ? to.meta.title : "Lavisco";
    next();
});

//Vue Components

Vue.component(
    "navbar-component",
    require("./components/website/NavbarComponent.vue").default
);
Vue.component(
    "footer-component",
    require("./components/website/FooterComponent.vue").default
);
Vue.component(
    "topnav-component",
    require("./components/website/TopNav.vue").default
);
Vue.component(
    "dashboard-cards",
    require("./components/admin/DashboardCards.vue").default
);
Vue.component(
    "table-header",
    require("./components/admin/TableHeader.vue").default
);
Vue.component(
    "index-component",
    require("./components/website/Index.vue").default
);
Vue.component(
    "menu-cart",
    require("./components/website/CartSmall.vue").default
);

Vue.component(
    "success-modal",
    require("./components/website/SuccessModal.vue").default
);
Vue.component(
    "fail-modal",
    require("./components/website/FailModal.vue").default
);
Vue.component(
    "success-toast",
    require("./components/website/SuccessToast.vue").default
);
Vue.component(
    "fail-toast",
    require("./components/website/FailToast.vue").default
);
Vue.component(
    "searchbar",
    require("./components/website/SearchBar.vue").default
);

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
