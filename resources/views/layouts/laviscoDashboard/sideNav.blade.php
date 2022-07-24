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
                justify-content-between
                align-items-center
                w-100
                mb-4
            "
        >
            <router-link to="/seller/dashboard" class="navbar-brand ml-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 805.67 156.56"
                >
                    <title>lavisco logo</title>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <path
                                fill="#dc1e3d"
                                d="M290.5,148.5c-4.5-0.7-5.1-7.9-5.1-7.9v-66c0.3-5.5-6.8-28.2-37.3-29.1c-30.5-0.9-32.7,26.1-32.7,28.4
                                                    c0.1,4.9,3.3,5.5,6,5.5c3.2-0.1,6-2.1,7.2-5.1c1-2.3,3.7-14.9,18.7-14.9c15,0,15.8,15,15.8,15v22.9c0,0-2.3-7.9-18.1-7.9
                                                    c-15.8,0-34.8,11.2-34.8,32.4s17.4,34.2,33.9,34.2s20.2-7.2,20.2-7.2s3.8,6.6,15.7,7.2C288.4,156.7,295,149.2,290.5,148.5z
                                                    M263.3,132.1c0,0-4.4,10.2-15.3,10.2s-19.1-7.9-19.1-17.7s9.6-18.1,17.2-18.1c7.6,0,14.2,3.1,17.2,8.8V132.1z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M293.29,62.66l32.5,89.18s1,4.14,11.77,4.39c0,0,5.17.5,5.17-2.78,0-1.24-2.11-3.32,10.39-27s22.75-44.37,22.75-44.37,4.14-8,.64-20.41C374,54.5,370.33,46.23,354,45.59c-6.32-.25-.76,6.35.53,7.6.2.2.35.42.54.63,2.11,2.38,8.71,15.46.28,36.83-13.08,28.47-16,35.82-16,35.82L312.81,54.14s-4.08-11.3-15-7.89C288.6,49.14,293.29,62.66,293.29,62.66Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M384.73,54.18v90.21s1.08,11.45,10.92,11.45,10.92-8,10.92-12V54.18a11.14,11.14,0,0,0-21.84,0Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M395.66,15.71s-12.33-.08-12.33,12.08,12.33,12.33,12.33,12.33S407.8,39.83,407.8,28C407.8,28,407.91,15.71,395.66,15.71Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M418.25,72S418.06,46.38,451,45.78c25.94,1.2,27.87,24.37,27.87,24.37s.7,13.77-6,13.84c-4.16.05-3.8-6.44-3.8-6.44s1.6-16.15-14.29-16.77c-9.33.25-11.82,4.92-12.35,8.48A8.26,8.26,0,0,0,444,75.39c2.56,3.42,9.69,10.46,17.18,15.8,13.08,9.85,20.9,21.09,20.88,31.93-.08,5.77,1.26,23.37-25.35,31.79-30.46,6.64-41.62-15.56-44-21.75a12.17,12.17,0,0,1-.79-3.37c-.33-3.78-.42-11.75,7.83-13.54,5.07-1.1,7.6,2.23,7.55,6.8,0,1.45,0,.62,0,4.14a12.12,12.12,0,0,0,.29,3c1,4.26,4.12,10.65,13.53,10.89,14.15.37,18.12-6.08,18.5-13.16s-5-14.77-12.69-20.36S418,88.46,418.25,72Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M541,154.37a40.16,40.16,0,0,1-25-1.53c-11.55-4.6-27-16.11-27.23-42.66-.38-45.81,24.14-58.76,24.14-58.76s17-11.85,33.34-.09C558.86,60.42,560,71.44,560,71.44s2.36,10.92-5.34,12.29c-6.49,1.15-7.77-6.8-8-9.31a6.81,6.81,0,0,0-.43-1.78c-.94-2.33-3.63-7.77-8.31-7.77-6,0-11.42.5-18.74,14.28s-4.91,43.57,1.57,51.45c0,0,9.43,10.34,22.15,3,3.15-1.82,6.21-8.91,7.12-12.54.87-3.46,1.39-4.34,3.55-5.35,1.94-.9,5.08-1.3,7.17.84,1.4,1.44,2,7.9,2,7.9S565.94,147.89,541,154.37Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M615.67,46.53a30,30,0,0,0-10.55.38c-11.16,2.77-39,15.37-39,55.73,0,38.14,23.67,51.09,36.21,52.67,8.5,1.08,13.26.55,18.17-1.22,11-3.94,26.61-16.86,24.35-56.17a27.9,27.9,0,0,0-.57-4.27c-2.39-11.07-8.11-8-8.11-8s-2.05.93-2,6.52,2.9,36.68-15.72,46c-19.77,9.89-34-42.57-18.91-64.86,14.69-21.73,23.44-6.87,25.06-1.45,1.12,3.77,3,12.13,6.89,12s6-4.88,5.3-12.41C636.23,64.72,629.94,48.19,615.67,46.53Z"
                            />
                            <circle
                                fill="#dc1e3d"
                                cx="653.03"
                                cy="142.93"
                                r="12.74"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M666.78,128.23V21.91a15.37,15.37,0,0,1,1.13-6,10.22,10.22,0,0,1,10.29-6.7C688.88,9.5,689,20.42,689,20.42V123a15.88,15.88,0,0,0,3.22,9.72c2.14,2.76,5.34,5.55,9.56,5.63,8.44.17,7.32-5.3,13.2-5.21s7.37,8.94,2.19,14.11-9.72,9.35-21.14,9.35c-6.08,0-13.42-2.87-19.25-7.41A26.48,26.48,0,0,1,666.78,128.23Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M154.58,128.23V21.91a15.37,15.37,0,0,1,1.13-6A10.22,10.22,0,0,1,166,9.25c10.68.25,10.8,11.17,10.8,11.17V123a15.88,15.88,0,0,0,3.22,9.72c2.14,2.76,5.34,5.55,9.56,5.63,8.44.17,7.32-5.3,13.2-5.21s7.37,8.94,2.19,14.11-9.72,9.35-21.14,9.35c-6.08,0-13.42-2.87-19.25-7.41A26.51,26.51,0,0,1,154.58,128.23Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M745.81,80.6V19.27s0-10-10.39-10c-11.79,0-11.71,10-11.71,10l-.08,127.9s0,8.69,11.92,8.69c10.26,0,10.18-10.18,10.18-10.18v-36.4s21.4,29.4,24.08,32.72c3,3.68,11.09,13.49,21.93,13.86,9.35,0,14.36-10.57,13.9-15.52-.41-4.47-5-5.05-5.88-4.14s-3.56,3.72-10.34.25-16.3-13.24-36.58-40l35.42-38.32S798,47.71,788,44.76c-5.48-1.62-9.77,2.81-9.77,2.81l-32.43,33"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M120.82,59.53l-87.5,0H5.22A4.47,4.47,0,0,0,.65,64.25V90.19l7.94,7.94v47.42s-.37,6.22,4.23,6.22h98.94s5.46-.62,5.46-5.59V98.39l8.26-8.26V64A4.49,4.49,0,0,0,120.82,59.53Zm-72.5,84.29H16.91V94.33H48.32Zm0-57.84H7.85V67.73H48.32Zm20.61,57.85H57V67.73H68.93Zm39.41-.13H76.93V94.21h31.41Zm9.06-57.85H76.93V67.6H117.4Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M111.21,3.35c-5.36-5.19-11.28-4-16.57,1.14S77.79,18,77.79,18,64.46-4.89,45,18.82c0,0-32.69-22-41.46-8S4.22,58,10.93,59.57H11a57,57,0,0,0,22.2,0h.12a55.85,55.85,0,0,0,21-9s1.1-.58-.41-4.63c-1.63-4.38-6.88-20.66-1.49-26.57,2.61-2.86,9-5.88,14.47-3.83,0,0,8.42,3.46,4.11,8.51S57.89,31.56,57.73,39.42s3.1,15.77,13.57,16.22c0,0,11.83.5,9.19-11.88,0,0,22.59,17.83,30.66,6.66S117.85,9.78,111.21,3.35ZM21.64,55C1.84,56.81,6.52,19,6.52,19c1-8.42,11.38-5.93,11.38-5.93,13.17,2.83,25.83,12.42,25.83,12.42l-.28,2.11c-6.52-2.36-18.34-.58-18.34-.58-4.1.63-10.14,5-6,12.75s26-1,26-1,2.19,9,2.19,9.23C35.79,54,21.64,55,21.64,55ZM40.5,33.25c-5.18,2.6-16.57,5.49-16.48,1.49S40.5,33.25,40.5,33.25ZM65.05,44.54a6.71,6.71,0,0,1-.21-4.81,10.35,10.35,0,0,1,3.21-4.54C73,31.07,73,31,73,31L74.51,48S68.16,51.84,65.05,44.54ZM79,30.8s7.17-3.18,18.66-1.9C104.18,29.62,77.87,31.56,79,30.8ZM107,45.39s-1.63,4.28-9.88,1.12c0,0-12.22-4.9-13.77-9.12,0,0-.76-1.12,13.77-1.12,0,0,8.29.23,6.34-9,0,0-1-6.5-13.1-4.84-1.24.16-10.36,2.1-10.36,2.1l21.1-17.81S105.05,3.43,108,9C108,9,115.42,27.08,107,45.39Z"
                            />
                        </g>
                    </g>
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

        <router-link
            to="/seller/dashboard"
            class="dashboard-link"
            id="seller-dashboard-main"
        >
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

        <router-link
            to="/seller/shop"
            class="dashboard-link"
            id="seller-dashboard-store"
        >
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
        <router-link
            to="/seller/sellerprofile"
            class="dashboard-link"
            id="seller-dashboard-profile"
        >
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

        <router-link
            to="/seller/products"
            class="dashboard-link"
            id="seller-dashboard-product"
        >
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

        <router-link
            to="/seller/orders"
            class="dashboard-link"
            id="seller-dashboard-order"
        >
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
        <router-link
            to="/seller/transactions"
            class="dashboard-link"
            id="seller-dashboard-transaction"
        >
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
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 805.67 156.56"
                >
                    <title>lavisco logo</title>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <path
                                fill="#dc1e3d"
                                d="M290.5,148.5c-4.5-0.7-5.1-7.9-5.1-7.9v-66c0.3-5.5-6.8-28.2-37.3-29.1c-30.5-0.9-32.7,26.1-32.7,28.4
                                                    c0.1,4.9,3.3,5.5,6,5.5c3.2-0.1,6-2.1,7.2-5.1c1-2.3,3.7-14.9,18.7-14.9c15,0,15.8,15,15.8,15v22.9c0,0-2.3-7.9-18.1-7.9
                                                    c-15.8,0-34.8,11.2-34.8,32.4s17.4,34.2,33.9,34.2s20.2-7.2,20.2-7.2s3.8,6.6,15.7,7.2C288.4,156.7,295,149.2,290.5,148.5z
                                                    M263.3,132.1c0,0-4.4,10.2-15.3,10.2s-19.1-7.9-19.1-17.7s9.6-18.1,17.2-18.1c7.6,0,14.2,3.1,17.2,8.8V132.1z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M293.29,62.66l32.5,89.18s1,4.14,11.77,4.39c0,0,5.17.5,5.17-2.78,0-1.24-2.11-3.32,10.39-27s22.75-44.37,22.75-44.37,4.14-8,.64-20.41C374,54.5,370.33,46.23,354,45.59c-6.32-.25-.76,6.35.53,7.6.2.2.35.42.54.63,2.11,2.38,8.71,15.46.28,36.83-13.08,28.47-16,35.82-16,35.82L312.81,54.14s-4.08-11.3-15-7.89C288.6,49.14,293.29,62.66,293.29,62.66Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M384.73,54.18v90.21s1.08,11.45,10.92,11.45,10.92-8,10.92-12V54.18a11.14,11.14,0,0,0-21.84,0Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M395.66,15.71s-12.33-.08-12.33,12.08,12.33,12.33,12.33,12.33S407.8,39.83,407.8,28C407.8,28,407.91,15.71,395.66,15.71Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M418.25,72S418.06,46.38,451,45.78c25.94,1.2,27.87,24.37,27.87,24.37s.7,13.77-6,13.84c-4.16.05-3.8-6.44-3.8-6.44s1.6-16.15-14.29-16.77c-9.33.25-11.82,4.92-12.35,8.48A8.26,8.26,0,0,0,444,75.39c2.56,3.42,9.69,10.46,17.18,15.8,13.08,9.85,20.9,21.09,20.88,31.93-.08,5.77,1.26,23.37-25.35,31.79-30.46,6.64-41.62-15.56-44-21.75a12.17,12.17,0,0,1-.79-3.37c-.33-3.78-.42-11.75,7.83-13.54,5.07-1.1,7.6,2.23,7.55,6.8,0,1.45,0,.62,0,4.14a12.12,12.12,0,0,0,.29,3c1,4.26,4.12,10.65,13.53,10.89,14.15.37,18.12-6.08,18.5-13.16s-5-14.77-12.69-20.36S418,88.46,418.25,72Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M541,154.37a40.16,40.16,0,0,1-25-1.53c-11.55-4.6-27-16.11-27.23-42.66-.38-45.81,24.14-58.76,24.14-58.76s17-11.85,33.34-.09C558.86,60.42,560,71.44,560,71.44s2.36,10.92-5.34,12.29c-6.49,1.15-7.77-6.8-8-9.31a6.81,6.81,0,0,0-.43-1.78c-.94-2.33-3.63-7.77-8.31-7.77-6,0-11.42.5-18.74,14.28s-4.91,43.57,1.57,51.45c0,0,9.43,10.34,22.15,3,3.15-1.82,6.21-8.91,7.12-12.54.87-3.46,1.39-4.34,3.55-5.35,1.94-.9,5.08-1.3,7.17.84,1.4,1.44,2,7.9,2,7.9S565.94,147.89,541,154.37Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M615.67,46.53a30,30,0,0,0-10.55.38c-11.16,2.77-39,15.37-39,55.73,0,38.14,23.67,51.09,36.21,52.67,8.5,1.08,13.26.55,18.17-1.22,11-3.94,26.61-16.86,24.35-56.17a27.9,27.9,0,0,0-.57-4.27c-2.39-11.07-8.11-8-8.11-8s-2.05.93-2,6.52,2.9,36.68-15.72,46c-19.77,9.89-34-42.57-18.91-64.86,14.69-21.73,23.44-6.87,25.06-1.45,1.12,3.77,3,12.13,6.89,12s6-4.88,5.3-12.41C636.23,64.72,629.94,48.19,615.67,46.53Z"
                            />
                            <circle
                                fill="#dc1e3d"
                                cx="653.03"
                                cy="142.93"
                                r="12.74"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M666.78,128.23V21.91a15.37,15.37,0,0,1,1.13-6,10.22,10.22,0,0,1,10.29-6.7C688.88,9.5,689,20.42,689,20.42V123a15.88,15.88,0,0,0,3.22,9.72c2.14,2.76,5.34,5.55,9.56,5.63,8.44.17,7.32-5.3,13.2-5.21s7.37,8.94,2.19,14.11-9.72,9.35-21.14,9.35c-6.08,0-13.42-2.87-19.25-7.41A26.48,26.48,0,0,1,666.78,128.23Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M154.58,128.23V21.91a15.37,15.37,0,0,1,1.13-6A10.22,10.22,0,0,1,166,9.25c10.68.25,10.8,11.17,10.8,11.17V123a15.88,15.88,0,0,0,3.22,9.72c2.14,2.76,5.34,5.55,9.56,5.63,8.44.17,7.32-5.3,13.2-5.21s7.37,8.94,2.19,14.11-9.72,9.35-21.14,9.35c-6.08,0-13.42-2.87-19.25-7.41A26.51,26.51,0,0,1,154.58,128.23Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M745.81,80.6V19.27s0-10-10.39-10c-11.79,0-11.71,10-11.71,10l-.08,127.9s0,8.69,11.92,8.69c10.26,0,10.18-10.18,10.18-10.18v-36.4s21.4,29.4,24.08,32.72c3,3.68,11.09,13.49,21.93,13.86,9.35,0,14.36-10.57,13.9-15.52-.41-4.47-5-5.05-5.88-4.14s-3.56,3.72-10.34.25-16.3-13.24-36.58-40l35.42-38.32S798,47.71,788,44.76c-5.48-1.62-9.77,2.81-9.77,2.81l-32.43,33"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M120.82,59.53l-87.5,0H5.22A4.47,4.47,0,0,0,.65,64.25V90.19l7.94,7.94v47.42s-.37,6.22,4.23,6.22h98.94s5.46-.62,5.46-5.59V98.39l8.26-8.26V64A4.49,4.49,0,0,0,120.82,59.53Zm-72.5,84.29H16.91V94.33H48.32Zm0-57.84H7.85V67.73H48.32Zm20.61,57.85H57V67.73H68.93Zm39.41-.13H76.93V94.21h31.41Zm9.06-57.85H76.93V67.6H117.4Z"
                            />
                            <path
                                fill="#dc1e3d"
                                d="M111.21,3.35c-5.36-5.19-11.28-4-16.57,1.14S77.79,18,77.79,18,64.46-4.89,45,18.82c0,0-32.69-22-41.46-8S4.22,58,10.93,59.57H11a57,57,0,0,0,22.2,0h.12a55.85,55.85,0,0,0,21-9s1.1-.58-.41-4.63c-1.63-4.38-6.88-20.66-1.49-26.57,2.61-2.86,9-5.88,14.47-3.83,0,0,8.42,3.46,4.11,8.51S57.89,31.56,57.73,39.42s3.1,15.77,13.57,16.22c0,0,11.83.5,9.19-11.88,0,0,22.59,17.83,30.66,6.66S117.85,9.78,111.21,3.35ZM21.64,55C1.84,56.81,6.52,19,6.52,19c1-8.42,11.38-5.93,11.38-5.93,13.17,2.83,25.83,12.42,25.83,12.42l-.28,2.11c-6.52-2.36-18.34-.58-18.34-.58-4.1.63-10.14,5-6,12.75s26-1,26-1,2.19,9,2.19,9.23C35.79,54,21.64,55,21.64,55ZM40.5,33.25c-5.18,2.6-16.57,5.49-16.48,1.49S40.5,33.25,40.5,33.25ZM65.05,44.54a6.71,6.71,0,0,1-.21-4.81,10.35,10.35,0,0,1,3.21-4.54C73,31.07,73,31,73,31L74.51,48S68.16,51.84,65.05,44.54ZM79,30.8s7.17-3.18,18.66-1.9C104.18,29.62,77.87,31.56,79,30.8ZM107,45.39s-1.63,4.28-9.88,1.12c0,0-12.22-4.9-13.77-9.12,0,0-.76-1.12,13.77-1.12,0,0,8.29.23,6.34-9,0,0-1-6.5-13.1-4.84-1.24.16-10.36,2.1-10.36,2.1l21.1-17.81S105.05,3.43,108,9C108,9,115.42,27.08,107,45.39Z"
                            />
                        </g>
                    </g>
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
