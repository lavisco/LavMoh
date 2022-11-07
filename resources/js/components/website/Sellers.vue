<template>
    <div class="container-fluid">
        <div class="hero hero-default">
            <div class="slide-content">
                <h1 class="title mb-3">Browse All Sellers</h1>
                <h1 class="sub-title mb-5">
                    From cakes to flowers, our Sellers offer everything you are
                    looking for!
                </h1>
            </div>
        </div>

        <section
            v-if="loading"
            class="my-5 d-flex align-items-center justify-content-center"
        >
            <img src="/images/lavisco/loading.gif" />
        </section>
        <section v-else class="section-best-seller mb-5">
            <div class="seller-card" v-for="shop in shops">
                <div class="d-flex flex-row align-items-md-center header">
                    <div
                        class="seller-logo"
                        v-bind:style="{
                            'background-image': 'url(' + shop.path + ')',
                        }"
                    ></div>
                    <div
                        class="
                            d-flex
                            flex-column flex-md-row
                            align-items-md-center
                            justify-content-between
                            w-100
                        "
                    >
                        <div>
                            <h1 class="mb-0">{{ shop.name }}</h1>
                            <span v-html="shopRating(shop.rating)"></span>
                        </div>
                        <router-link
                            :to="{
                                name: 'shop',
                                params: {
                                    shopId: shop.id,
                                    slug: shop.slug,
                                    location: locationActive,
                                },
                            }"
                        >
                            <button class="btn-sm mt-3 mt-md-0">View Seller</button>
                        </router-link>
                    </div>
                </div>
                <div v-if="shop.products">
                    <h4 class="text-left">Latest Products</h4>
                    <div class="d-flex card-container-display mt-3">
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
                            v-for="product in shop.products.latest_products"
                            :key="product.id"
                        >
                            <div class="card-img">
                                <img :src="productImg(product.product_image)" />
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
                                        <span
                                            v-show="product.has_variations == 1"
                                        >
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
                    </div>
                </div>
            </div>

            <!-- Pagination Start -->

            <pagination
                class="mt-4"
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="loadShops()"
            ></pagination>

            <!-- Pagination end -->
        </section>
    </div>
</template>
<script>
export default {
    data: () => ({
        shops: [],
        searchText: null,
        loading: true,
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText(after, before) {
            Fire.$emit("reloadRecords");
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
        loadShops() {
            axios
                .get("/api/shops?page=" + this.pagination.current_page)
                .then(({ data }) => {
                    this.shops = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
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
        productImg(image) {
            return image ? image.path : `/images/lavisco/img-bg.jpg`;
        },
    },
    mounted() {
        this.loadShops();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadShops();
        });
    },
};
</script>
