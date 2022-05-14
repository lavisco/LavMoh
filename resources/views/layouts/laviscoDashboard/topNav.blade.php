<nav
    class="
        navbar navbar-expand-lg
        d-flex
        justify-content-between
        align-items-center
        dashboard-top-nav
    "
>
    @if(auth()->user()->role_id == 2)
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="navbar-close mr-3" id="toggle-sidenav">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="24"
                    height="24"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z"
                    />
                </svg>
            </button>
            <h3 class="mb-0">
                @{{ $route.meta.title ? $route.meta.title : "Lavisco" }}
            </h3>
        </div>

        <div class="d-flex nav-user-options justify-content-end">
            <a
                class="mr-2 mr-md-4"
                id="navbarDropdown"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="24"
                    height="24"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10zm-4.987-3.744A7.966 7.966 0 0 0 12 20a7.97 7.97 0 0 0 5.167-1.892A6.979 6.979 0 0 0 12.16 16a6.981 6.981 0 0 0-5.147 2.256zM5.616 16.82A8.975 8.975 0 0 1 12.16 14a8.972 8.972 0 0 1 6.362 2.634a8 8 0 1 0-12.906.187zM12 13a4 4 0 1 1 0-8a4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4a2 2 0 0 0 0 4z"
                    />
                </svg>
            </a>
            @auth
            <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
            >
                <span class="hide-content-md-inline">Logout</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="24"
                    height="24"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                    class="ml-2"
                >
                    <path
                        fill="#666"
                        d="M10 11V8l5 4l-5 4v-3H1v-2h9zm-7.542 4h2.124A8.003 8.003 0 0 0 20 12A8 8 0 0 0 4.582 9H2.458C3.732 4.943 7.522 2 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10c-4.478 0-8.268-2.943-9.542-7z"
                    />
                </svg>
            </a>
            @endauth @auth
            <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
            >
                <router-link to="/seller/password_reset" class="dropdown-item">
                    <svg
                        class="mr-2"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        role="img"
                        width="24"
                        height="24"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="#666"
                            d="m10.758 11.828l7.849-7.849l1.414 1.414l-1.414 1.415l2.474 2.474l-1.414 1.415l-2.475-2.475l-1.414 1.414l2.121 2.121l-1.414 1.415l-2.121-2.122l-2.192 2.192a5.002 5.002 0 0 1-7.708 6.294a5 5 0 0 1 6.294-7.708zm-.637 6.293A3 3 0 1 0 5.88 13.88a3 3 0 0 0 4.242 4.242z"
                        />
                    </svg>
                    Password Reset
                </router-link>

                <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        role="img"
                        width="24"
                        height="24"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24"
                        class="mr-2"
                    >
                        <path
                            fill="#666"
                            d="M10 11V8l5 4l-5 4v-3H1v-2h9zm-7.542 4h2.124A8.003 8.003 0 0 0 20 12A8 8 0 0 0 4.582 9H2.458C3.732 4.943 7.522 2 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10c-4.478 0-8.268-2.943-9.542-7z"
                        />
                    </svg>
                    Logout
                </a>

                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-none"
                >
                    @csrf
                </form>
            </div>
            @endauth
        </div>
    </div>
    @endif @if(auth()->user()->role_id == 3)
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="navbar-close mr-3" id="toggle-sidenav">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="24"
                    height="24"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z"
                    />
                </svg>
            </button>
            <h3 class="mb-0">
                @{{ $route.meta.title ? $route.meta.title : "Lavisco" }}
            </h3>
        </div>

        <div class="d-flex nav-user-options justify-content-end">
            @auth
            <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
            >
                <span class="hide-content-md-inline">Logout</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="24"
                    height="24"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                    class="ml-2"
                >
                    <path
                        fill="#666"
                        d="M10 11V8l5 4l-5 4v-3H1v-2h9zm-7.542 4h2.124A8.003 8.003 0 0 0 20 12A8 8 0 0 0 4.582 9H2.458C3.732 4.943 7.522 2 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10c-4.478 0-8.268-2.943-9.542-7z"
                    />
                </svg>
            </a>

            <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                class="d-none"
            >
                @csrf
            </form>

            @endauth
        </div>
    </div>
    @endif
</nav>
