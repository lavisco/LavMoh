<template>
    <div class="container-fluid">
        <div
            class="hero"
            v-bind:style="{ 'background-image': 'url(' + occasion.path + ')' }"
        >
            <h1 class="title text-center">Browse {{ occasion.name }}</h1>
            <h1 class="sub-title mb-5 text-center">
                {{ occasion.description }}
            </h1>
        </div>
        <section class="section-best-seller mb-5">
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
                            Made by {{ product.user.shop.name }}
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
        occasion: [],
        products: [],
        searchText: null,
        loading: true,
    }),

    beforeRouteEnter: function (to, from, next) {
        let uri = "/api/occasions/" + to.params.occasionId;

        axios.get(uri).then((response) => {
            next((vm) => {
                vm.setData(response);
            });
        });
    },

    beforeRouteUpdate: function (to, from, next) {
        let uri = "/api/occasions/" + to.params.occasionId;
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
            this.occasion = response.data.occasion;
            this.loading = false;
        },
        loadData() {
            axios
                .get("/api/occasions/" + this.$route.params.occasionId)
                .then((response) => {
                    this.products = response.data.products.data;
                    this.occasion = response.data.occasion;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {},
};
</script>
