<template>
    <nav class="navbar navbar-expand-lg d-flex justify-content-between" style="z-index:9999;">
        <router-link to="/lavisco/home" class="navbar-brand">
            <img src="/images/lavisco/logo.png" />
        </router-link>

        <div class="navbar-main-menu" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item mr-3">
                    <div class="dropdown show">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            id="dropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Browse Products
                        </a>

                        <div
                            style="z-index:-1;"
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuLink"
                        >
                            <div class="d-flex flex-row align-items-start">
                                <div class="dropdown-menu-col-1">
                                    <h6 class="dropdown-header">
                                        <a href="/lavisco/categories"
                                            >Browse by Nature</a
                                        >
                                    </h6>

                                    <router-link
                                        class="dropdown-item"
                                        v-for="category in categories"
                                        :key="category.id"
                                        :to="{
                                            name: 'categories/category',
                                            params: {
                                                categoryId: category.id,
                                            },
                                        }"
                                    >
                                        {{ category.name }}
                                        <span class="dropdown-item-arrow">
                                            >
                                        </span>
                                    </router-link>
                                </div>
                                <div class="dropdown-menu-col-2">
                                    <h6 class="dropdown-header">
                                        <a href="/lavisco/recipients">
                                            Browse by Recipient
                                        </a>
                                    </h6>
                                    <div class="row">
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
                                                        recipientId:
                                                            recipient.id,
                                                    },
                                                }"
                                            >
                                                {{ recipient.name }}
                                                <span
                                                    class="dropdown-item-arrow"
                                                >
                                                    >
                                                </span>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lavisco/seller/onboard"
                        >Sell on Lavisco</a
                    >
                </li>
            </ul>
        </div>

        <div class="d-flex nav-user-options justify-content-end">
            <div class="dropdown show">
                <a
                    href="#"
                    role="button"
                    id="dropdownCartLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        width="78"
                        height="79"
                        viewBox="0 0 78000 79000"
                    >
                        <g filter="url(#a)">
                            <rect
                                fill="#fff"
                                width="58000"
                                height="59000"
                                x="10000"
                                y="10000"
                                rx="12000"
                            />
                        </g>
                        <path
                            d="M24558 21520a2063 2063 0 10 0 4127h2517l630 2521c5 30 12 58 20 87l2802 11204-1843 1840c-2600 2600-760 7043 2918 7043h17716a2064 2064 0 00 0-4127H31602l2063-2063h13590a2063 2063 0 00 1844-1141l6189-12380a2064 2064 0 00-1845-2986h-22120l-640-2565a2063 2063 0 00-2000-1562h-4127zM51380 53502a3095 3095 0 11-6190 0 3095 3095 0 01 6190 0zm-19600 3095a3095 3095 0 10 0-6189 3095 3095 0 00 0 6190"
                            fill="#333"
                        />
                        <defs>
                            <filter
                                id="a"
                                width="78000"
                                height="79000"
                                x="0"
                                y="0"
                                color-interpolation-filters="sRGB"
                                filterUnits="userSpaceOnUse"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feColorMatrix
                                    in="SourceAlpha"
                                    result="hardAlpha"
                                    type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                />
                                <feOffset />
                                <feGaussianBlur stdDeviation="5" />
                                <feColorMatrix
                                    type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"
                                />
                                <feBlend
                                    in2="BackgroundImageFix"
                                    mode="normal"
                                    result="effect1_dropShadow_2202_1029"
                                />
                                <feBlend
                                    in="SourceGraphic"
                                    in2="effect1_dropShadow_2202_1029"
                                    mode="normal"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                </a>

                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="dropdownCartLink"
                >
                    <menu-cart></menu-cart>
                </div>
            </div>
            <a href="/login">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    width="78"
                    height="79"
                    viewBox="0 0 780 790"
                >
                    <g filter="url(#a)">
                        <rect
                            fill="#fff"
                            width="580"
                            height="590"
                            x="100"
                            y="100"
                            rx="120"
                        />
                    </g>
                    <path
                        d="M246.25 562.5s-28.75 0-28.75-28.75 28.75-115 172.5-115 172.5 86.25 172.5 115-28.75 28.75-28.75 28.75h-287.5zM390 390a86.25 86.25 0 10 0-172.5A86.25 86.25 0 00 390 390"
                        fill="#333"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                    />
                    <defs>
                        <filter
                            id="a"
                            width="780"
                            height="790"
                            x="0"
                            y="0"
                            color-interpolation-filters="sRGB"
                            filterUnits="userSpaceOnUse"
                        >
                            <feFlood
                                flood-opacity="0"
                                result="BackgroundImageFix"
                            />
                            <feColorMatrix
                                in="SourceAlpha"
                                result="hardAlpha"
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                            />
                            <feOffset />
                            <feGaussianBlur stdDeviation="5" />
                            <feColorMatrix
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"
                            />
                            <feBlend
                                in2="BackgroundImageFix"
                                mode="normal"
                                result="effect1_dropShadow_2202_1045"
                            />
                            <feBlend
                                in="SourceGraphic"
                                in2="effect1_dropShadow_2202_1045"
                                mode="normal"
                                result="shape"
                            />
                        </filter>
                    </defs>
                </svg>
            </a>
        </div>
    </nav>
</template>

<script>
export default {
    data: () => ({
        recipients: [],
        categories: [],
    }),

    computed: {
        chunkedRecipients() {
            return _.chunk(this.recipients, 11);
        },
    },

    methods: {
        loadData() {
            axios
                .get("/api/home")
                .then((response) => {
                    this.recipients = response.data.recipients;
                    this.categories = response.data.categories;
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
