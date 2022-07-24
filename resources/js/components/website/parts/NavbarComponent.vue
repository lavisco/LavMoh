<template>
    <div style="z-index: 9999" class="main-top-nav">
        <nav
            class="
                navbar navbar-expand-lg
                d-flex
                justify-content-between
                align-items-center
                w-100
            "
        >
            <router-link to="/" class="navbar-brand mr-4">
                <svg
                    height="55"
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

            <!-- search bar -->
            <searchbar></searchbar>

            <!-- account, location & cart -->
            <div
                class="
                    d-flex
                    justify-content-end
                    align-items-center
                    order-1 order-lg-2
                "
            >
                <!-- desktop location -->
                <div class="dropdown show hide-content-md-flex">
                    <a
                        href="#"
                        role="button"
                        id="dropdownLocation"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        class="nav-link nav-link-account mr-2 mr-sm-3"
                        @click.prevent="loadDistricts()"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true"
                            role="img"
                            width="20"
                            height="20"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                            class="mr-md-1"
                        >
                            <circle cx="12" cy="9.5" r="1.5" fill="#333" />
                            <path
                                fill="#4e4e4e"
                                d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 3.5-3.5A3.5 3.5 0 0 1 12 13Z"
                            />
                        </svg>
                        <div
                            class="
                                nav-link-account-text
                                d-flex
                                flex-column
                                align-items-start
                                line-height-min
                            "
                        >
                            <span class="nav-tiny-text">Deliver to</span>
                            {{ locationActive }}
                        </div>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-right"
                        style="border-radius: 8px"
                        aria-labelledby="dropdownLocation"
                        id="dropdownLocation"
                        @click.prevent="preventDropdownClose($event)"
                    >
                        <h6 class="dropdown-header">
                            Select product delivery location
                        </h6>
                        <div class="col-12 px-3 pt-2 pb-3">
                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                id="filter"
                                name="filter"
                                @change.prevent="saveLocation(districtName)"
                                v-model="districtName"
                            >
                                <option value="" disabled selected hidden>
                                    Select District
                                </option>
                                <option
                                    v-for="district in districts"
                                    :key="district.id"
                                    :value="district.name"
                                >
                                    {{ district.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- login -->
                <router-link
                    class="nav-link nav-link-account mr-2 mr-sm-3"
                    to="/select_login"
                >
                    <span class="hide-content nav-tiny-text mr-1">Sign In</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        role="img"
                        width="23"
                        height="23"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24"
                        class="mr-md-1"
                    >
                        <path
                            fill="#4e4e4e"
                            d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z"
                        />
                    </svg>
                    <div
                        class="
                            nav-link-account-text
                            d-flex
                            flex-column
                            align-items-start
                            line-height-min
                        "
                    >
                        <span class="nav-tiny-text">Sign In</span>
                        Account
                    </div>
                </router-link>

                <!-- cart -->
                <menu-cart></menu-cart>

                <!-- mobile menu -->
                <div
                    class="
                        hide-content
                        navbar-main-menu navbar-main-menu-mobile
                        ml-2 ml-sm-3
                    "
                >
                    <a
                        class="nav-link hamburger"
                        role="button"
                        id="toggle-sidenav"
                        @click.prevent="displayMenu"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true"
                            role="img"
                            width="36"
                            height="36"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="#333"
                                d="M15 18H3v-2h12v2Zm6-5H3v-2h18v2Zm-6-5H3V6h12v2Z"
                            />
                        </svg>
                    </a>
                    <div class="dashboard-side-nav">
                        <div
                            class="
                                d-flex d-flex
                                flex-column
                                justify-content-center
                                align-items-center
                                w-100
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
                                <router-link to="/" class="navbar-brand mr-4">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 805.67 156.56"
                                    >
                                        <title>lavisco logo</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                            <g
                                                id="Layer_1-2"
                                                data-name="Layer 1"
                                            >
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
                                <button
                                    class="navbar-close"
                                    id="close-sidenav"
                                    @click.prevent="displayMenu"
                                >
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

                            <div class="d-flex align-items-center w-100 mb-2">
                                <router-link
                                    @click.native="displayMenu"
                                    to="/select_login"
                                >
                                    <button
                                        class="mr-3 btn-sm btn bg-red white"
                                    >
                                        Login
                                    </button>
                                </router-link>

                                <router-link
                                    @click.native="displayMenu"
                                    to="/sell_on_lavisco"
                                >
                                    <button class="btn-sm btn">
                                        Sell on Lavisco
                                    </button>
                                </router-link>
                            </div>

                            <hr class="hr-red" />

                            <h6
                                class="dropdown-header"
                                data-toggle="collapse"
                                data-target="#collapseCat"
                            >
                                Browse Categories
                            </h6>
                            <div class="collapse w-100" id="collapseCat">
                                <a
                                    @click="displayMenu"
                                    class="dropdown-item"
                                    href="/categories"
                                >
                                    All Categories
                                    <span class="dropdown-item-arrow"> > </span>
                                </a>
                                <router-link
                                    @click.native="displayMenu"
                                    class="dropdown-item"
                                    v-for="category in categories"
                                    :key="category.id"
                                    :to="{
                                        name: 'categories/category',
                                        params: {
                                            categoryId: category.id,
                                            slug: category.slug,
                                        },
                                    }"
                                >
                                    {{ category.name }}
                                    <span class="dropdown-item-arrow"> > </span>
                                </router-link>
                            </div>
                            <h6
                                class="dropdown-header mt-2"
                                data-toggle="collapse"
                                data-target="#collapseRec"
                            >
                                Browse Recipients
                            </h6>
                            <div class="collapse w-100" id="collapseRec">
                                <a
                                    @click="displayMenu"
                                    class="dropdown-item"
                                    href="/recipients"
                                >
                                    All Recipients
                                    <span class="dropdown-item-arrow"> > </span>
                                </a>
                                <div
                                    class="w-100"
                                    v-for="chunkRecipient in chunkedRecipients"
                                >
                                    <router-link
                                        @click.native="displayMenu"
                                        class="dropdown-item"
                                        v-for="recipient in chunkRecipient"
                                        :key="recipient.id"
                                        :to="{
                                            name: 'recipients/recipient',
                                            params: {
                                                recipientId: recipient.id,
                                                slug: recipient.slug,
                                            },
                                        }"
                                    >
                                        {{ recipient.name }}
                                        <span class="dropdown-item-arrow">
                                            >
                                        </span>
                                    </router-link>
                                </div>
                            </div>

                            <h6
                                class="dropdown-header mt-2"
                                data-toggle="collapse"
                                data-target="#collapseOcc"
                            >
                                Browse Occasions
                            </h6>
                            <div class="collapse w-100" id="collapseOcc">
                                <a
                                    @click="displayMenu"
                                    class="dropdown-item"
                                    href="/occasions"
                                >
                                    All Occasions
                                    <span class="dropdown-item-arrow"> > </span>
                                </a>
                                <div
                                    class="w-100"
                                    v-for="chunkOccasion in chunkedOccasions"
                                >
                                    <router-link
                                        @click.native="displayMenu"
                                        class="dropdown-item"
                                        v-for="occasion in chunkOccasion"
                                        :key="occasion.id"
                                        :to="{
                                            name: 'occasions/occasion',
                                            params: {
                                                occasionId: occasion.id,
                                                slug: occasion.slug,
                                            },
                                        }"
                                    >
                                        {{ occasion.name }}
                                        <span class="dropdown-item-arrow">
                                            >
                                        </span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- desktop menu -->
        <nav
            class="navbar navbar-expand-lg w-100 pt-0 hide-content-md-flex"
            style="z-index: 100 !important"
        >
            <div class="navbar-main-menu order-3" id="navbarSupportedContent">
                <ul
                    class="
                        navbar-nav
                        d-flex
                        justify-content-center
                        align-items-center
                    "
                >
                    <li
                        class="nav-item mx-2"
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <router-link
                            class="nav-link"
                            :to="{
                                name: 'categories/category',
                                params: {
                                    categoryId: category.id,
                                    slug: category.slug,
                                },
                            }"
                        >
                            {{ category.name }}
                        </router-link>
                    </li>

                    <div class="vertical-divider"></div>

                    <li class="nav-item mx-2">
                        <div class="dropdown show">
                            <a
                                class="nav-link"
                                href="#"
                                role="button"
                                id="dropdownMenuLink1"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Recipients
                            </a>

                            <div
                                style="z-index: -1"
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuLink1"
                            >
                                <h6 class="dropdown-header">
                                    <router-link to="/recipients">
                                        Browse All Recipients
                                    </router-link>
                                </h6>
                                <div class="d-flex flex-column flex-md-row">
                                    <div
                                        class="col-md-6"
                                        v-for="chunkRecipient in chunkedRecipients"
                                    >
                                        <router-link
                                            class="dropdown-item"
                                            v-for="recipient in chunkRecipient"
                                            :key="recipient.id"
                                            :to="{
                                                name: 'recipients/recipient',
                                                params: {
                                                    recipientId: recipient.id,
                                                    slug: recipient.slug,
                                                },
                                            }"
                                        >
                                            {{ recipient.name }}
                                            <span class="dropdown-item-arrow">
                                                >
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <div class="vertical-divider"></div>

                    <li class="nav-item mx-2">
                        <div class="dropdown show">
                            <a
                                class="nav-link"
                                href="#"
                                role="button"
                                id="dropdownMenuLink2"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Occasions
                            </a>

                            <div
                                style="z-index: -1"
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuLink2"
                            >
                                <h6 class="dropdown-header">
                                    <router-link to="/occasions">
                                        Browse All Occasions
                                    </router-link>
                                </h6>
                                <div class="d-flex flex-column flex-md-row">
                                    <div
                                        class="col-md-6"
                                        v-for="chunkOccasion in chunkedOccasions"
                                    >
                                        <router-link
                                            class="dropdown-item"
                                            v-for="occasion in chunkOccasion"
                                            :key="occasion.id"
                                            :to="{
                                                name: 'occasions/occasion',
                                                params: {
                                                    occasionId: occasion.id,
                                                    slug: occasion.slug,
                                                },
                                            }"
                                        >
                                            {{ occasion.name }}
                                            <span class="dropdown-item-arrow">
                                                >
                                            </span>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <div class="vertical-divider"></div>

                    <li class="nav-item mx-2">
                        <router-link class="nav-link" to="/sell_on_lavisco">
                            Sell on Lavisco
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- mobile location picker -->
        <div class="hide-content">
            <div class="dropdown show mobile-location-picker">
                <a
                    href="#"
                    role="button"
                    id="dropdownLocation"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    class=""
                    @click.prevent="loadDistricts()"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        role="img"
                        width="18px"
                        height="17px"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24"
                        class="mr-1"
                    >
                        <circle cx="12" cy="9.5" r="1.5" fill="#333" />
                        <path
                            fill="#ffffff"
                            d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 3.5-3.5A3.5 3.5 0 0 1 12 13Z"
                        />
                    </svg>
                    Deliver to <strong>{{ locationActive }}</strong>
                </a>
                <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownLocation"
                    id="dropdownLocation"
                    @click.prevent="preventDropdownClose($event)"
                >
                    <h6 class="dropdown-header">
                        Select product delivery location
                    </h6>
                    <div class="col-12 px-3 pt-2 pb-3">
                        <select
                            class="
                                custom-select
                                form-control form-control-alternative
                            "
                            id="filter"
                            name="filter"
                            @change.prevent="saveLocation(districtName)"
                            v-model="districtName"
                        >
                            <option value="" disabled selected hidden>
                                Select District
                            </option>
                            <option
                                v-for="district in districts"
                                :key="district.id"
                                :value="district.name"
                            >
                                {{ district.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        recipients: [],
        occasions: [],
        categories: [],
        currencies: [],
        districts: [],
        user: "",
        districtName: "",
    }),

    computed: {
        chunkedRecipients() {
            return _.chunk(this.recipients, 6);
        },
        chunkedOccasions() {
            return _.chunk(this.occasions, 6);
        },
        chunkedDistricts() {
            return _.chunk(this.districts, 13);
        },
        currencyActive() {
            return this.$store.getters.selectedCurrency;
        },
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        saveCurrency(currency) {
            this.$store.dispatch("saveCurrency", currency);
        },
        saveLocation(district) {
            this.$store.dispatch("saveLocation", district);
            $("#dropdownLocation").dropdown("hide");
        },
        displayMenu() {
            let sidenav = document.querySelector(".dashboard-side-nav");
            sidenav.classList.toggle("show-nav");
        },

        preventDropdownClose(e) {
            e.stopPropagation();
        },

        loadData() {
            axios
                .get("/api/navdata")
                .then((response) => {
                    this.recipients = response.data.recipients;
                    this.occasions = response.data.occasions;
                    this.categories = response.data.categories;
                    this.currencies = response.data.currencies;
                    this.user = response.data.user;
                })
                .catch((error) => console.log(error));
        },

        loadDistricts() {
            axios
                .get("/api/locations/districts")
                .then(({ data }) => {
                    this.districts = data;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadData();
        Fire.$on("reloadRecords", () => {
            this.loadData();
        });
    },
};
</script>
