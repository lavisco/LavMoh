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
                        name:
                            product.category_id == 7
                                ? 'giftboxes/product'
                                : 'products/product',
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
