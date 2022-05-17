<template>
    <div class="container-fluid">
        <div
            class="hero hero-default"
            v-bind:style="{ 'background-image': 'url(' + occasion.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">Browse {{ occasion.name }}</h1>
                <h1 class="sub-title">
                    {{ occasion.description }}
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

                <div
                    v-else
                    v-for="product in products"
                    class="card item-card-2"
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
                            <router-link
                                class="card-title-2"
                                :to="{
                                    name: 'products/product',
                                    params: {
                                        productId: product.id,
                                        slug: product.slug,
                                    },
                                }"
                            >
                                {{ product.title }}
                            </router-link>
                        </div>
                        <div class="card-price">
                            {{ product.base_price }}
                        </div>
                        <div class="card-secondary-text">
                            {{ product.user.shop.name }}
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!loading" class="d-flex justify-content-center mt-5">
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
