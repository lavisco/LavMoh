<template>
    <div class="container-fluid">
        <div class="hero hero-default">
            <div class="slide-content">
                <h1 class="title mb-3">All Categories</h1>
                <h1 class="sub-title mb-5">
                    From cakes to flowers, Lavisco has everything you are
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
        <section
            v-else
            class="section-best-seller mb-5"
            v-for="category in categories"
            :key="category.id"
        >
            <h1 class="text-left">{{ category.name }}</h1>
            <div
                class="
                    d-flex
                    swiper-index-product
                    card-container-display
                    align-items-center
                "
            >
                <router-link
                    :to="{
                        name: product.category_id == 7 ? 'giftboxes/product' : 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
                        },
                    }"
                    class="card item-card"
                    v-for="product in category.latest_products"
                    :key="product.id"
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
                        <div class="card-title">
                            {{ product.title }}
                        </div>
                        <div class="card-price">
                            {{ currency.symbol }}
                            {{ product.base_price * currency.exchange_rate }}
                        </div>
                    </div>
                </router-link>

                <router-link
                    class="view-more-link"
                    :to="{
                        name: 'categories/category',
                        params: {
                            categoryId: category.id,
                            slug: category.slug,
                        },
                    }"
                >
                    View More
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
                </router-link>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data: () => ({
        categories: [],
        searchText: null,
        loading: true,
    }),

    watch: {
        searchText(after, before) {
            this.loadCategories();
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

    methods: {
        loadCategories() {
            axios
                .get("/api/categories")
                .then(({ data }) => {
                    this.categories = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadCategories();
        Fire.$on("reloadRecords", () => {
            this.loadCategories();
        });
    },
};
</script>
