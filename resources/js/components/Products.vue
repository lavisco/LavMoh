<template>
    <div class="container-fluid">
        <div class="hero">
            <h1 class="title text-center">Browse All Products</h1>
            <h1 class="sub-title mb-3 text-center">
                From cakes to bags, we offer everything you are looking for!
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
                        <div class="px-3">
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
                            <div class="card-price">
                                {{ product.base_price }}
                            </div>
                            <div class="card-secondary-text">
                                {{ product.category.name }}
                            </div>
                            <div class="card-secondary-text">
                                Made by {{ product.user.shop.name }}
                            </div>
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
        products: [],
        searchText: null,
        loading: true,
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    methods: {
        loadProducts() {
            axios
                .get("/api/products", {
                    params: { searchText: this.searchText },
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
