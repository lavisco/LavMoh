require("./bootstrap");
import VueRouter from "vue-router";
import { routes } from "./routes";
import store from "./store/index.js";

window.Vue = require("vue").default;

/*
Vue Router
*/

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

/*
Vue Components
*/

//admin

Vue.component(
    "dashboard-cards",
    require("./components/admin/DashboardCards.vue").default
);
Vue.component(
    "table-header",
    require("./components/admin/TableHeader.vue").default
);

//website

Vue.component(
    "menu-cart",
    require("./components/website/parts/CartSmall.vue").default
);

Vue.component(
    "index-component",
    require("./components/website/Index.vue").default
);

Vue.component(
    "fail-modal",
    require("./components/website/parts/FailModal.vue").default
);

Vue.component(
    "fail-toast",
    require("./components/website/parts/FailToast.vue").default
);

Vue.component(
    "footer-component",
    require("./components/website/parts/FooterComponent.vue").default
);

Vue.component(
    "navbar-component",
    require("./components/website/parts/NavbarComponent.vue").default
);

Vue.component(
    "searchbar",
    require("./components/website/parts/SearchBar.vue").default
);

Vue.component(
    "success-modal",
    require("./components/website/parts/SuccessModal.vue").default
);

Vue.component(
    "success-toast",
    require("./components/website/parts/SuccessToast.vue").default
);

Vue.component(
    "topnav-component",
    require("./components/website/parts/TopNav.vue").default
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
