<template>
    <div class="container-fluid">
        <div class="hero hero-default">
            <div class="slide-content">
                <h1 class="title mb-3">Browse All Products</h1>
                <h1 class="sub-title">
                    From cakes to bags, we offer everything you are looking for!
                </h1>
            </div>
        </div>
        <div class="sort-section">
            <select
                class="custom-select form-control form-control-alternative"
                id="filter"
                name="filter"
                v-model="sortValue"
            >
                <option value="" disabled selected hidden>Sort by</option>
                <option value="base_price_low">Price low to high</option>
                <option value="base_price">Price high to low</option>
                <option value="created_at">Latest</option>
            </select>
        </div>
        <section class="section-best-seller mb-5 mt-4">
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
                            :alt="product.title"
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
                            <button class="bag-sm" type="button" name="add to cart">
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
                @paginate="loadProducts()"
            ></pagination>

            <!-- Pagination end -->
        </section>
    </div>
</template>

<script>
export default {
    data: () => ({
        products: [],
        searchText: null,
        loading: true,
        sortValue: "created_at",
        pagination: { current_page: 1 },
    }),

    watch: {
        sortValue(after, before) {
            Fire.$emit("reloadRecords");
        },
        locationActive(after, before) {
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
        loadProducts() {
            axios
                .get("/api/products?page=" + this.pagination.current_page, {
                    params: {
                        sortValue: this.sortValue,
                        location: this.locationActive,
                    },
                })
                .then(({ data }) => {
                    this.products = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadProducts();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadProducts();
        });
    },
};
</script>
