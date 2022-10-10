<template>
    <div class="container-fluid">
        <div
            class="hero hero-default hero-seller"
            v-bind:style="{ 'background-image': 'url(' + shop.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">{{ shop.name }}</h1>
                <span
                    class="seller-rating"
                    v-html="shopRating(shop.rating)"
                ></span>
                <h1 class="sub-title">
                    {{ shop.about }}
                </h1>
            </div>
        </div>

        <section class="section-best-seller mb-5">
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
                        <div class="d-flex flex-row justify-content-between align-items-end">
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
            <div class="d-flex justify-content-center mt-5">
                <a href="" class="view-more-link">View More</a>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data: () => ({
        shop: [],
        products: [],
        searchText: null,
        loading: true,
    }),

    beforeRouteEnter: function (to, from, next) {
        let uri = "/api/shops/" + to.params.shopId;

        axios.get(uri).then((response) => {
            next((vm) => {
                vm.setData(response);
            });
        });
    },

    beforeRouteUpdate: function (to, from, next) {
        let uri = "/api/shops/" + to.params.shopId;
        axios.get(uri).then((response) => {
            this.setData(response);
            next();
        });
    },

    watch: {
        searchText(after, before) {
            this.loadData();
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

    methods: {
        setData(response) {
            this.products = response.data.products.data;
            this.shop = response.data.shop;
            this.loading = false;
        },
        loadData() {
            axios
                .get("/api/shops/" + this.$route.params.shopId)
                .then((response) => {
                    this.products = response.data.products.data;
                    this.shop = response.data.shop;
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
    mounted() {},
};
</script>
