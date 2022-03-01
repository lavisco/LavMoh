<nav
    class="
        navbar navbar-expand-lg
        pb-3 pb-md-0
        d-flex
        justify-content-center
        align-items-center
        lavisco-dashboard-nav-menu
    "
>
    <div
        class="
            container-fluid
            dashboard-topnav
            align-items-center
            justify-content-between
            p-0
        "
    >
        <div class="d-flex align-items-center">
            @if(auth()->user()->shop && auth()->user()->shop->status == true)
            <button
                class="navbar-toggler mr-3"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <svg
                    width="19"
                    height="18"
                    viewBox="0 0 19 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M17.5 0.00976562H1.06671C0.794417 0.00976563 0.53328 0.114069 0.340743 0.29973C0.148205 0.485391 0.0400391 0.737201 0.0400391 0.999766V3.51C0.0400391 3.77256 0.148205 4.02437 0.340743 4.21004C0.53328 4.3957 0.794417 4.5 1.06671 4.5H17.5C17.7723 4.5 18.0334 4.3957 18.226 4.21004C18.4185 4.02437 18.5267 3.77256 18.5267 3.51V0.999766C18.5267 0.737201 18.4185 0.485391 18.226 0.29973C18.0334 0.114069 17.7723 0.00976563 17.5 0.00976562ZM17.4934 13.01H1.02667C0.754378 13.01 0.493241 13.1143 0.300704 13.2999C0.108167 13.4856 0 13.7374 0 14V16.4198C0 16.6824 0.108167 16.9342 0.300704 17.1198C0.493241 17.3055 0.754378 17.4098 1.02667 17.4098H17.4934C17.7657 17.4098 18.0268 17.3055 18.2193 17.1198C18.4119 16.9342 18.52 16.6824 18.52 16.4198V14C18.52 13.7374 18.4119 13.4856 18.2193 13.2999C18.0268 13.1143 17.7657 13.01 17.4934 13.01Z"
                        fill="#333333"
                    />
                    <path
                        d="M1.02667 6.60015H17.4934C17.7657 6.60015 18.0268 6.70446 18.2193 6.89012C18.4119 7.07578 18.52 7.32759 18.52 7.59016V10.01C18.52 10.2726 18.4119 10.5244 18.2193 10.71C18.0268 10.8957 17.7657 11 17.4934 11H1.02667C0.754378 11 0.493241 10.8957 0.300704 10.71C0.108167 10.5244 0 10.2726 0 10.01V7.59016C0 7.32759 0.108167 7.07578 0.300704 6.89012C0.493241 6.70446 0.754378 6.60015 1.02667 6.60015Z"
                        fill="#333333"
                    />
                </svg>
            </button>
            @endif

            <h3 class="mb-0">
                @{{ $route.meta.title ? $route.meta.title : "BugTrack" }}
            </h3>
        </div>

        <div class="d-flex nav-user-options">
            <router-link to="/seller/dashboard">
                <svg
                    width="78"
                    height="79"
                    viewBox="0 0 78 79"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g filter="url(#filter0_d_2202_1098)">
                        <rect
                            x="10"
                            y="10"
                            width="58"
                            height="59"
                            rx="12"
                            fill="white"
                        />
                    </g>
                    <path
                        d="M36.2208 20.855C36.9986 20.1996 37.9829 19.8401 39 19.8401C40.0171 19.8401 41.0014 20.1996 41.7792 20.855L54.7167 31.7705C55.6903 32.5889 56.25 33.7945 56.25 35.0671V53.8543C56.25 54.7439 55.8966 55.597 55.2676 56.226C54.6386 56.8551 53.7854 57.2085 52.8958 57.2085H47.1458C46.2563 57.2085 45.4031 56.8551 44.7741 56.226C44.145 55.597 43.7917 54.7439 43.7917 53.8543V44.271C43.7917 43.8897 43.6402 43.5241 43.3706 43.2545C43.101 42.9849 42.7354 42.8335 42.3542 42.8335H35.6458C35.2646 42.8335 34.899 42.9849 34.6294 43.2545C34.3598 43.5241 34.2083 43.8897 34.2083 44.271V53.8543C34.2083 54.7439 33.8549 55.597 33.2259 56.226C32.5969 56.8551 31.7437 57.2085 30.8542 57.2085H25.1042C24.6637 57.2085 24.2275 57.1217 23.8206 56.9531C23.4136 56.7846 23.0439 56.5375 22.7324 56.226C22.4209 55.9146 22.1739 55.5448 22.0053 55.1379C21.8368 54.7309 21.75 54.2948 21.75 53.8543V35.0652C21.75 33.7945 22.3097 32.5889 23.2833 31.7685L36.2208 20.855V20.855Z"
                        fill="#333333"
                    />
                    <defs>
                        <filter
                            id="filter0_d_2202_1098"
                            x="0"
                            y="0"
                            width="78"
                            height="79"
                            filterUnits="userSpaceOnUse"
                            color-interpolation-filters="sRGB"
                        >
                            <feFlood
                                flood-opacity="0"
                                result="BackgroundImageFix"
                            />
                            <feColorMatrix
                                in="SourceAlpha"
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                result="hardAlpha"
                            />
                            <feOffset />
                            <feGaussianBlur stdDeviation="5" />
                            <feColorMatrix
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"
                            />
                            <feBlend
                                mode="normal"
                                in2="BackgroundImageFix"
                                result="effect1_dropShadow_2202_1098"
                            />
                            <feBlend
                                mode="normal"
                                in="SourceGraphic"
                                in2="effect1_dropShadow_2202_1098"
                                result="shape"
                            />
                        </filter>
                    </defs>
                </svg>
            </router-link>
            <a
                id="navbarDropdown"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
            >
                <svg
                    width="78"
                    height="79"
                    viewBox="0 0 78 79"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g filter="url(#filter0_d_2202_1045)">
                        <rect
                            x="10"
                            y="10"
                            width="58"
                            height="59"
                            rx="12"
                            fill="white"
                        />
                    </g>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M24.625 56.25C24.625 56.25 21.75 56.25 21.75 53.375C21.75 50.5 24.625 41.875 39 41.875C53.375 41.875 56.25 50.5 56.25 53.375C56.25 56.25 53.375 56.25 53.375 56.25H24.625ZM39 39C41.2875 39 43.4813 38.0913 45.0988 36.4738C46.7163 34.8563 47.625 32.6625 47.625 30.375C47.625 28.0875 46.7163 25.8937 45.0988 24.2762C43.4813 22.6587 41.2875 21.75 39 21.75C36.7125 21.75 34.5187 22.6587 32.9012 24.2762C31.2837 25.8937 30.375 28.0875 30.375 30.375C30.375 32.6625 31.2837 34.8563 32.9012 36.4738C34.5187 38.0913 36.7125 39 39 39Z"
                        fill="#333333"
                    />
                    <defs>
                        <filter
                            id="filter0_d_2202_1045"
                            x="0"
                            y="0"
                            width="78"
                            height="79"
                            filterUnits="userSpaceOnUse"
                            color-interpolation-filters="sRGB"
                        >
                            <feFlood
                                flood-opacity="0"
                                result="BackgroundImageFix"
                            />
                            <feColorMatrix
                                in="SourceAlpha"
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                result="hardAlpha"
                            />
                            <feOffset />
                            <feGaussianBlur stdDeviation="5" />
                            <feColorMatrix
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"
                            />
                            <feBlend
                                mode="normal"
                                in2="BackgroundImageFix"
                                result="effect1_dropShadow_2202_1045"
                            />
                            <feBlend
                                mode="normal"
                                in="SourceGraphic"
                                in2="effect1_dropShadow_2202_1045"
                                result="shape"
                            />
                        </filter>
                    </defs>
                </svg>
            </a>
            @auth
            <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
            >
                <router-link to="/seller/password_reset" class="dropdown-item">
                    <i class="fas fa-key mr-2 link-fa"></i>
                    Password Reset
                </router-link>

                <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                >
                    <i class="fas fa-door-open mr-2 link-fa"></i>
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

        @if(auth()->user()->shop && auth()->user()->shop->status == true)
        <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
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
                <router-link to="/seller/shop" class="dashboard-link">
                    Store
                </router-link>
                <router-link to="/seller/sellerprofile" class="dashboard-link">
                    Account
                </router-link>
                <router-link to="/seller/products" class="dashboard-link">
                    Products
                </router-link>
                <router-link to="/seller/orders" class="dashboard-link">
                    Orders
                </router-link>
                <router-link to="/seller/messages" class="dashboard-link">
                    Messages
                </router-link>
                <router-link to="/seller/statistics" class="dashboard-link">
                    Statistics
                </router-link>
            </div>
        </div>
        @endif
    </div>
</nav>
