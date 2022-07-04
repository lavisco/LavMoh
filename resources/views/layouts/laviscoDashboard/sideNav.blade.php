<nav class="navbar dashboard-side-nav">
    @if(auth()->user()->role_id == 2)
    <div
        class="
            d-flex d-flex
            flex-column
            justify-content-center
            align-items-center
            seller-nav
        "
    >
        <div
            class="
                d-flex
                justify-content-between justify-content-lg-center
                align-items-center
                w-100
                mb-4
            "
        >
            <router-link to="/seller/dashboard" class="navbar-brand">
                <svg
                    height="50"
                    viewBox="0 0 290 76"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                    <rect width="290" height="75.2187" fill="url(#pattern0)" />
                    <defs>
                        <pattern
                            id="pattern0"
                            patternContentUnits="objectBoundingBox"
                            width="1"
                            height="1"
                        >
                            <use
                                xlink:href="#image0_2511_1885"
                                transform="scale(0.003125 0.0120482)"
                            />
                        </pattern>
                        <image
                            id="image0_2511_1885"
                            width="320"
                            height="83"
                            xlink:href="data:image/png;base64,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"
                        />
                    </defs>
                </svg>
            </router-link>
            <button class="navbar-close" id="close-sidenav">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M10.5858 12L6.34315 7.75736L7.75736 6.34315L12 10.5858L16.2426 6.34315L17.6569 7.75736L13.4142 12L17.6569 16.2426L16.2426 17.6569L12 13.4142L7.75736 17.6569L6.34315 16.2426L10.5858 12Z"
                        fill="#8D8788"
                    />
                </svg>
            </button>
        </div>

        <router-link to="/seller/dashboard" class="dashboard-link">
            <div class="dashboard-link-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="1em"
                    height="1em"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M6.75 2.5A4.25 4.25 0 0 1 11 6.75V11H6.75a4.25 4.25 0 1 1 0-8.5zM9 9V6.75A2.25 2.25 0 1 0 6.75 9H9zm-2.25 4H11v4.25A4.25 4.25 0 1 1 6.75 13zm0 2A2.25 2.25 0 1 0 9 17.25V15H6.75zm10.5-12.5a4.25 4.25 0 1 1 0 8.5H13V6.75a4.25 4.25 0 0 1 4.25-4.25zm0 6.5A2.25 2.25 0 1 0 15 6.75V9h2.25zM13 13h4.25A4.25 4.25 0 1 1 13 17.25V13zm2 2v2.25A2.25 2.25 0 1 0 17.25 15H15z"
                    />
                </svg>
            </div>
            Dashboard
        </router-link>

        <router-link to="/seller/shop" class="dashboard-link">
            <div class="dashboard-link-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="1em"
                    height="1em"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#8D8788"
                        d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                    />
                </svg>
            </div>
            Store
        </router-link>
        <router-link to="/seller/sellerprofile" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573l1-1.732l.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573l1 1.732l-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573l-1 1.732l-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573l-1-1.732l.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3z"
                    />
                </svg>
            </div>
            Account
        </router-link>

        @if(auth()->user()->shop && auth()->user()->shop->status == true)
        <router-link to="/seller/products" class="dashboard-link">
            <div class="dashboard-link-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="1em"
                    height="1em"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M15.5 2a3.5 3.5 0 0 1 3.437 4.163l-.015.066a4.502 4.502 0 0 1 .303 8.428l-1.086 6.507a1 1 0 0 1-.986.836H6.847a1 1 0 0 1-.986-.836l-1.029-6.17a3 3 0 0 1-.829-5.824L4 9a6 6 0 0 1 8.574-5.421A3.496 3.496 0 0 1 15.5 2zM9 15H6.86l.834 5H9v-5zm4 0h-2v5h2v-5zm4.139 0H15v5h1.305l.834-5zM10 5C7.858 5 6.109 6.684 6.005 8.767L6 8.964l.003.17a2 2 0 0 1-1.186 1.863l-.15.059A1.001 1.001 0 0 0 5 13h12.5a2.5 2.5 0 1 0-.956-4.81l-.175.081a2 2 0 0 1-2.663-.804l-.07-.137A4 4 0 0 0 10 5zm5.5-1a1.5 1.5 0 0 0-1.287.729a6.006 6.006 0 0 1 1.24 1.764a4.45 4.45 0 0 1 1.446-.453A1.5 1.5 0 0 0 15.5 4z"
                    />
                </svg>
            </div>
            Products
        </router-link>

        <router-link to="/seller/orders" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M8.965 18a3.5 3.5 0 0 1-6.93 0H1V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2h3l3 4.056V18h-2.035a3.5 3.5 0 0 1-6.93 0h-5.07zM15 7H3v8.05a3.5 3.5 0 0 1 5.663.95h5.674c.168-.353.393-.674.663-.95V7zm2 6h4v-.285L18.992 10H17v3zm.5 6a1.5 1.5 0 1 0 0-3.001a1.5 1.5 0 0 0 0 3.001zM7 17.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0z"
                    />
                </svg>
            </div>
            Orders
        </router-link>
        <router-link to="/seller/transactions" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M14 2a8 8 0 0 1 3.292 15.293A8 8 0 1 1 6.706 6.707A8.003 8.003 0 0 1 14 2zm-4 6a6 6 0 1 0 0 12a6 6 0 0 0 0-12zm1 1v1h2v2H9a.5.5 0 0 0-.09.992L9 13h2a2.5 2.5 0 1 1 0 5v1H9v-1H7v-2h4a.5.5 0 0 0 .09-.992L11 15H9a2.5 2.5 0 1 1 0-5V9h2zm3-5a5.985 5.985 0 0 0-4.484 2.013a8 8 0 0 1 8.47 8.471A6 6 0 0 0 14 4z"
                    />
                </svg>
            </div>
            Transactions
        </router-link>
        <router-link to="/coming_soon" class="dashboard-link">
            <div class="dashboard-link-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="1em"
                    height="1em"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M12 2c5.522 0 10 3.978 10 8.889a5.558 5.558 0 0 1-5.556 5.555h-1.966c-.922 0-1.667.745-1.667 1.667c0 .422.167.811.422 1.1c.267.3.434.689.434 1.122C13.667 21.256 12.9 22 12 22C6.478 22 2 17.522 2 12S6.478 2 12 2zm-1.189 16.111a3.664 3.664 0 0 1 3.667-3.667h1.966A3.558 3.558 0 0 0 20 10.89C20 7.139 16.468 4 12 4a8 8 0 0 0-.676 15.972a3.648 3.648 0 0 1-.513-1.86zM7.5 12a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3zm9 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3zM12 9a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3z"
                    />
                </svg>
            </div>
            Custom Requests
        </router-link>
        <router-link to="/coming_soon" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M15 2a4 4 0 0 1 3.464 6.001L23 8v2h-2v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V10H1V8l4.536.001A4 4 0 0 1 12 3.355A3.983 3.983 0 0 1 15 2zm-4 8H5v9h6v-9zm8 0h-6v9h6v-9zM9 4a2 2 0 0 0-.15 3.995L9 8h2V6a2 2 0 0 0-1.697-1.977l-.154-.018L9 4zm6 0a2 2 0 0 0-1.995 1.85L13 6v2h2a2 2 0 0 0 1.995-1.85L17 6a2 2 0 0 0-2-2z"
                    />
                </svg>
            </div>
            Giftboxes
        </router-link>
        @endif

        <router-link to="/seller/statistics" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="m4.406 14.523l3.402-3.402l2.828 2.829l3.157-3.157L12 9h5v5l-1.793-1.793l-4.571 4.571l-2.828-2.828l-2.475 2.474a8 8 0 1 0-.927-1.9zm-1.538 1.558l-.01-.01l.004-.004A9.965 9.965 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10c-4.07 0-7.57-2.43-9.132-5.919z"
                    />
                </svg>
            </div>
            Statistics
        </router-link>
    </div>
    @endif @if(auth()->user()->role_id == 3)
    <div
        class="
            d-flex d-flex
            flex-column
            justify-content-center
            align-items-center
            seller-nav
        "
    >
        <div
            class="
                d-flex
                justify-content-between justify-content-lg-center
                align-items-center
                w-100
                mb-4
            "
        >
            <router-link to="/buyer/dashboard" class="navbar-brand">
                <svg
                    height="50"
                    viewBox="0 0 290 76"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                    <rect width="290" height="75.2187" fill="url(#pattern0)" />
                    <defs>
                        <pattern
                            id="pattern0"
                            patternContentUnits="objectBoundingBox"
                            width="1"
                            height="1"
                        >
                            <use
                                xlink:href="#image0_2511_1885"
                                transform="scale(0.003125 0.0120482)"
                            />
                        </pattern>
                        <image
                            id="image0_2511_1885"
                            width="320"
                            height="83"
                            xlink:href="data:image/png;base64,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"
                        />
                    </defs>
                </svg>
            </router-link>
            <button class="navbar-close" id="close-sidenav">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M10.5858 12L6.34315 7.75736L7.75736 6.34315L12 10.5858L16.2426 6.34315L17.6569 7.75736L13.4142 12L17.6569 16.2426L16.2426 17.6569L12 13.4142L7.75736 17.6569L6.34315 16.2426L10.5858 12Z"
                        fill="#8D8788"
                    />
                </svg>
            </button>
        </div>

        <router-link to="/buyer/dashboard" class="dashboard-link">
            <div class="dashboard-link-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="1em"
                    height="1em"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="#666"
                        d="M6.75 2.5A4.25 4.25 0 0 1 11 6.75V11H6.75a4.25 4.25 0 1 1 0-8.5zM9 9V6.75A2.25 2.25 0 1 0 6.75 9H9zm-2.25 4H11v4.25A4.25 4.25 0 1 1 6.75 13zm0 2A2.25 2.25 0 1 0 9 17.25V15H6.75zm10.5-12.5a4.25 4.25 0 1 1 0 8.5H13V6.75a4.25 4.25 0 0 1 4.25-4.25zm0 6.5A2.25 2.25 0 1 0 15 6.75V9h2.25zM13 13h4.25A4.25 4.25 0 1 1 13 17.25V13zm2 2v2.25A2.25 2.25 0 1 0 17.25 15H15z"
                    />
                </svg>
            </div>
            Dashboard
        </router-link>
        <router-link to="/buyer/buyerprofile" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573l1-1.732l.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573l1 1.732l-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573l-1 1.732l-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573l-1-1.732l.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3z"
                    />
                </svg>
            </div>
            Account
        </router-link>
        <router-link to="/buyer/orders" class="dashboard-link">
            <div class="dashboard-link-icon">
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
                        d="M8.965 18a3.5 3.5 0 0 1-6.93 0H1V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2h3l3 4.056V18h-2.035a3.5 3.5 0 0 1-6.93 0h-5.07zM15 7H3v8.05a3.5 3.5 0 0 1 5.663.95h5.674c.168-.353.393-.674.663-.95V7zm2 6h4v-.285L18.992 10H17v3zm.5 6a1.5 1.5 0 1 0 0-3.001a1.5 1.5 0 0 0 0 3.001zM7 17.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0z"
                    />
                </svg>
            </div>
            Orders
        </router-link>
    </div>
    @endif
</nav>
