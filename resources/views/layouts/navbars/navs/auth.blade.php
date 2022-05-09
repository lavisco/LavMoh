<!-- Top navbar -->
<nav
    class="navbar navbar-top navbar-expand-md navbar-dark bg-blue"
    id="navbar-main"
>
    <div class="container-fluid">
        <!-- Brand -->
        <div class="h3 mb-0 text-white d-none d-lg-inline-block">
            @{{ $route.meta.title ? $route.meta.title : "Lavisco" }}
        </div>

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a
                    class="nav-link pr-0"
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
                                src="/images/lavisco/img-bg.jpg"
                            />
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span
                                class="mb-0 text-sm font-weight-bold"
                                >{{ auth()->user()->name }}</span
                            >
                        </div>
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
    </div>
</nav>
