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
                @change.prevent="loadProducts()"
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
                        name: product.category_id == 7 ? 'giftboxes/product' : 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
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
                    <div class="px-2 px-md-3">
                        <div class="card-title-2">
                            {{ product.title }}
                        </div>
                        <div class="card-price">
                            {{ currency.symbol }}
                            {{ product.base_price * currency.exchange_rate }}
                        </div>
                        <div class="card-secondary-text">
                            {{
                                product.user.shop ? product.user.shop.name : ""
                            }}
                        </div>
                    </div>
                </router-link>
            </div>
            <div v-if="!loading" class="d-flex justify-content-center mt-5">
                <a href="" class="view-more-link"
                    >View More
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
                            d="M12 11V8l4 4l-4 4v-3H8v-2h4zm0-9c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8s-8 3.58-8 8s3.58 8 8 8z"
                        />
                    </svg>
                </a>
            </div>
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
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

    methods: {
        loadProducts() {
            axios
                .get("/api/products", {
                    params: { sortValue: this.sortValue },
                })
                .then(({ data }) => {
                    this.products = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadProducts();
        Fire.$on("reloadRecords", () => {
            this.loadProducts();
        });
    },
};
</script>
