<template>
    <div class="container-fluid">
        <div class="seller-hero">
            <div
                class="seller-hero-img"
                v-bind:style="{ 'background-image': 'url(' + shop.path + ')' }"
            ></div>
            <div class="seller-hero-box container">
                <h1 class="mb-4 title black">{{ shop.name }}</h1>
                <span
                    class="seller-rating"
                    v-html="shopRating(shop.rating)"
                ></span>
                <p class="mt-5">
                    {{ shop.about }}
                </p>
            </div>
        </div>

        <section class="section-best-seller mb-5 mt-0">
            <div class="d-flex flex-wrap justify-content-center card-container">
                <img v-if="loading" src="/images/lavisco/loading.gif" />
                <div v-else v-for="product in products" class="product-list">
                    <div class="card item-card-2">
                        <div class="card-img card-img-2">
                            <img
                                :src="
                                    product.product_image
                                        ? product.product_image.path
                                        : '/images/lavisco/img-bg.jpg'
                                "
                            />
                        </div>

                        <div class="card-title-2">
                            <router-link
                                class="card-title-2"
                                :to="{
                                    name: 'products/product',
                                    params: {
                                        productId: product.id,
                                    },
                                }"
                            >
                                {{ product.title }}
                            </router-link>
                        </div>
                        <div class="card-price">{{ product.base_price }}</div>
                        <div class="card-secondary-text">
                            Made by {{ shop.name }}
                        </div>
                        <button class="btn-sm btn-full btn-sm-cart mt-auto">
                            Add to Cart
                        </button>
                    </div>
                </div>
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
