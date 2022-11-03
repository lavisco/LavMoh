<template>
    <div class="container-fluid">
        <div
            class="hero hero-default hero-seller"
            v-bind:style="{ 'background-image': 'url(' + shop.path + ')' }"
        ></div>
        <div class="seller-slide-content">
            <div
                class="seller-slide-logo"
                v-bind:style="{ 'background-image': 'url(' + shop.path + ')' }"
            ></div>
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">
                            <router-link to="/sellers">All Shops</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ shop.name }}
                        </li>
                    </ol>
                </nav>
                <div class="d-flex flex-row align-items-center mb-3">
                    <div
                        class="seller-slide-logo-sm"
                        v-bind:style="{
                            'background-image': 'url(' + shop.path + ')',
                        }"
                    ></div>
                    <h1>{{ shop.name }}</h1>
                </div>

                <span
                    class="seller-rating"
                    v-html="shopRating(shop.rating)"
                ></span>
                <h5>{{ shop.city }}, {{ shop.district }}</h5>
                <p>
                    {{ shop.about }}
                </p>
            </div>
        </div>

        <section class="section-best-seller">
            <h1>Featured Items</h1>
            <swiper class="swiper swiper-index-product" :options="swiperOption">
                <swiper-slide
                    v-for="product in productslimited"
                    :key="product.id"
                >
                    <router-link
                        :to="{
                            name: 'products/product',
                            params: {
                                productId: product.id,
                                slug: product.slug,
                                location: locationActive,
                            },
                        }"
                        class="card item-card"
                    >
                        <div class="card-img">
                            <img
                                :src="
                                    product.product_image
                                        ? product.product_image.path
                                        : '/images/lavisco/img-bg.jpg'
                                "
                                :class="{
                                    'img-cover': !product.product_image,
                                }"
                            />
                        </div>
                        <div class="card-body">
                            <div class="card-body-text">
                                <div class="card-title">
                                    {{ product.title }}
                                </div>
                                <div class="card-price">
                                    {{ currency.symbol }}
                                    {{
                                        product.base_price *
                                        currency.exchange_rate
                                    }}
                                    <span v-show="product.has_variations == 1">
                                        +
                                    </span>
                                </div>
                            </div>
                            <button class="bag-sm" type="button">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="29"
                                    height="29"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 1024 1024"
                                >
                                    <path
                                        fill="white"
                                        d="M832 312H696v-16c0-101.6-82.4-184-184-184s-184 82.4-184 184v16H192c-17.7 0-32 14.3-32 32v536c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V344c0-17.7-14.3-32-32-32zm-432-16c0-61.9 50.1-112 112-112s112 50.1 112 112v16H400v-16zm392 544H232V384h96v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h224v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h96v456z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </router-link>
                </swiper-slide>
            </swiper>
        </section>

        <section class="section-best-seller mb-5">
            <h1>All Items</h1>
            <div class="sort-section mb-4">
                <div class="filter-select">
                    <label>Sort by</label>
                    <select
                        class="
                            custom-select
                            form-control form-control-alternative
                        "
                        id="filter"
                        name="filter"
                        v-model="sortValue"
                    >
                        <option value="" disabled selected hidden>
                            Sort by
                        </option>
                        <option value="base_price_low">
                            Price low to high
                        </option>
                        <option value="base_price">Price high to low</option>
                        <option value="created_at">Latest</option>
                    </select>
                </div>
            </div>
            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-center
                    card-container
                    product-list
                "
            >
                <img v-if="loading" src="/images/lavisco/loading.gif" />
                <router-link
                    v-else
                    v-for="product in products"
                    :key="product.id"
                    class="card item-card-2"
                    :to="{
                        name: 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
                            location: locationActive,
                        },
                    }"
                >
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                product.product_image
                                    ? product.product_image.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                        />
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            {{ product.title }}
                        </div>
                        <div
                            class="
                                d-flex
                                flex-row
                                justify-content-between
                                align-items-end
                            "
                        >
                            <div class="card-body-text">
                                <div class="card-price mb-md-1">
                                    {{ currency.symbol }}
                                    {{
                                        product.base_price *
                                        currency.exchange_rate
                                    }}
                                    <span v-show="product.has_variations == 1">
                                        +
                                    </span>
                                </div>
                                <div class="card-secondary-text">
                                    {{
                                        product.user.shop
                                            ? product.user.shop.name
                                            : ""
                                    }}
                                </div>
                            </div>
                            <button class="bag-sm" type="button">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="29"
                                    height="29"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 1024 1024"
                                >
                                    <path
                                        fill="white"
                                        d="M832 312H696v-16c0-101.6-82.4-184-184-184s-184 82.4-184 184v16H192c-17.7 0-32 14.3-32 32v536c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V344c0-17.7-14.3-32-32-32zm-432-16c0-61.9 50.1-112 112-112s112 50.1 112 112v16H400v-16zm392 544H232V384h96v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h224v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h96v456z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </router-link>
            </div>
            <!-- Pagination Start -->

            <pagination
                class="mt-4"
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="loadData()"
            ></pagination>

            <!-- Pagination end -->
        </section>
    </div>
</template>
<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
import "swiper/css/swiper.css";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    directives: {
        swiper: directive,
    },

    data: () => ({
        shop: [],
        products: [],
        productslimited: [],
        searchText: null,
        loading: true,
        sortValue: "created_at",
        pagination: { current_page: 1 },
        swiperOption: {
            slidesPerView: 5,
            spaceBetween: 20,
            autoplay: {
                delay: 4600,
                disableOnInteraction: false,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
            },
        },
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get(
                "/api/shops/" +
                    to.params.shopId +
                    "/" +
                    to.params.location +
                    "?page=" +
                    1
            )
            .then((response) => {
                next((vm) => {
                    vm.setData(response);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get(
                "/api/shops/" +
                    to.params.shopId +
                    "/" +
                    to.params.location +
                    "?page=" +
                    1
            )
            .then((response) => {
                this.setData(response);
                next();
            });
    },

    watch: {
        searchText(after, before) {
            Fire.$emit("reloadRecords");
        },
        sortValue(after, before) {
            Fire.$emit("reloadRecords");
        },
        locationActive(after, before) {
            this.sortValue = "created_at";
            this.$router.push({
                name: "shop",
                params: {
                    shopId: this.shop.id,
                    slug: this.shop.slug,
                    location: this.locationActive,
                },
            });
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        setData(response) {
            this.products = response.data.products.data;
            this.productslimited = response.data.productslimited;
            this.shop = response.data.shop;
            this.pagination.last_page = response.data.products.last_page;
            this.pagination.current_page = response.data.products.current_page;
            this.sortValue = "created_at";
            this.loading = false;
        },
        loadData() {
            axios
                .get(
                    "/api/shops/" +
                        this.$route.params.shopId +
                        "/" +
                        this.locationActive +
                        "?page=" +
                        this.pagination.current_page,
                    {
                        params: { sortValue: this.sortValue },
                    }
                )
                .then((response) => {
                    this.products = response.data.products.data;
                    this.productslimited = response.data.productslimited;
                    this.shop = response.data.shop;
                    this.pagination.last_page =
                        response.data.products.last_page;
                    this.pagination.current_page =
                        response.data.products.current_page;
                })
                .catch((error) => console.log(error));
        },
        shopRating(rating) {
            var result = "";
            if (rating < 1) {
                return (result = "No rating");
            } else {
                for (var j = 1; j <= rating; j++) {
                    result += `<i class="fas fa-star text-yellow"></i>`;
                }
                for (var j = 5; j > rating; j--) {
                    result += `<i class="fas fa-star text-lighter"></i>`;
                }
                return result;
            }
        },
    },
    mounted() {
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadData();
        });
    },
};
</script>
