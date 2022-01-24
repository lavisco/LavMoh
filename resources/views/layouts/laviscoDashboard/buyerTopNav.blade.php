<nav
    class="
        navbar navbar-expand-lg
        d-flex
        justify-content-between
        align-items-center
    "
>
    <div class="container-fluid dashboard-topnav">
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            menu
        </button>

        <div
            class="collapse navbar-collapse seller-nav"
            id="navbarSupportedContent"
        >
            <div
                class="
                    d-flex
                    align-items-center
                    flex-column flex-lg-row
                    justify-content-center
                    gap
                    seller-nav
                "
            >
                <router-link to="/buyer/buyerprofile" class="dashboard-link">
                    Account
                </router-link>
                <router-link to="/buyer/orders" class="dashboard-link">
                    Order History
                </router-link>
                <router-link to="/buyer/messages" class="dashboard-link">
                    Messages
                </router-link>
            </div>
        </div>
    </div>
</nav>
