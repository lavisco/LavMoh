<nav
    class="
        navbar navbar-vertical
        fixed-left
        navbar-expand-md navbar-light
        bg-white
    "
    id="sidenav-main"
>
    <div class="container-fluid">
        <!-- Toggler -->
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <router-link to="/admin/dashboard" class="navbar-brand pt-0">
            <img
                src="/images/lavisco/logo.png"
                class="navbar-brand-img"
                alt="..."
            />
        </router-link>
        <!-- User menu in mobile view -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img
                                alt="Image placeholder"
                                src="{{
                                    asset('argon')
                                }}/img/theme/team-1-800x800.jpg"
                            />
                        </span>
                    </div>
                </a>
                <div
                    class="
                        dropdown-menu dropdown-menu-arrow dropdown-menu-right
                    "
                >
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a href="" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>My profile</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Settings</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>Activity</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a
                        href="{{ route('logout') }}"
                        class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <router-link to="/admin/dashboard">
                            <img src="/images/lavisco/logo.png" />
                        </router-link>
                    </div>
                    <div class="col-6 collapse-close">
                        <button
                            type="button"
                            class="navbar-toggler"
                            data-toggle="collapse"
                            data-target="#sidenav-collapse-main"
                            aria-controls="sidenav-main"
                            aria-expanded="false"
                            aria-label="Toggle sidenav"
                        >
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Search Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input
                        type="search"
                        class="
                            form-control
                            form-control-rounded
                            form-control-prepended
                        "
                        placeholder="Search"
                        aria-label="Search"
                    />
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/admin/dashboard" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/admin/products" class="nav-link">
                        <i class="fas fa-shopping-basket"></i> Products
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/admin/shops" class="nav-link">
                        <i class="fas fa-store"></i> Shop
                    </router-link>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#navbar-option-dropdown"
                        data-toggle="collapse"
                        role="button"
                        aria-expanded="true"
                        aria-controls="navbar-option-dropdown"
                    >
                        <i class="fas fa-swatchbook"></i>
                        <span class="nav-link-text">Options</span>
                    </a>

                    <div class="collapse" id="navbar-option-dropdown">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <router-link
                                    to="/admin/productstates"
                                    class="nav-link"
                                >
                                    Product States
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/variations"
                                    class="nav-link"
                                >
                                    Variations
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/variation_options"
                                    class="nav-link"
                                >
                                    Variation options
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/categories"
                                    class="nav-link"
                                >
                                    Categories
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/materials"
                                    class="nav-link"
                                >
                                    Materials
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/occasions"
                                    class="nav-link"
                                >
                                    Occasions
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/recipients"
                                    class="nav-link"
                                >
                                    Recipients
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/shippings"
                                    class="nav-link"
                                >
                                    Shipping Types
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/giftwraps"
                                    class="nav-link"
                                >
                                    Giftwraps
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/homesliders"
                                    class="nav-link"
                                >
                                    Home Sliders
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/analytics" class="nav-link">
                        <i class="fas fa-store"></i> Analytics
                    </router-link>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3" />
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">User Control</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#navbar-user-dropdown"
                        data-toggle="collapse"
                        role="button"
                        aria-expanded="true"
                        aria-controls="navbar-user-dropdown"
                    >
                        <i class="fas fa-user-cog"></i>
                        <span class="nav-link-text">Users</span>
                    </a>

                    <div class="collapse" id="navbar-user-dropdown">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <router-link to="/admin/users" class="nav-link">
                                    All Users
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/sellerprofiles"
                                    class="nav-link"
                                >
                                    Sellers
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/buyerprofiles"
                                    class="nav-link"
                                >
                                    Buyers
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#navbar-access-dropdown"
                        data-toggle="collapse"
                        role="button"
                        aria-expanded="true"
                        aria-controls="navbar-access-dropdown"
                    >
                        <i class="fas fa-key"></i>
                        <span class="nav-link-text">Access Level</span>
                    </a>

                    <div class="collapse" id="navbar-access-dropdown">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <router-link to="/admin/roles" class="nav-link">
                                    Roles
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    to="/admin/permissions"
                                    class="nav-link"
                                >
                                    Permissions
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
