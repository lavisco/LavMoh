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
            <div class="card seller-card mb-5" v-for="shop in shops">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <img
                            :src="shop.path"
                            class="product-seller-img"
                            :alt="shop.name"
                        />
                    </div>
                    <div class="col-md-8">
                        <h1 class="mb-0 text-left">{{ shop.name }}</h1>
                        <span v-html="shopRating(shop.rating)"></span>
                        <p class="my-4 seller-card-about">
                            {{ shop.about }}
                        </p>
                        <div v-if="shop.products">
                            <h6>Top selling products</h6>
                            <div class="d-flex topseller-products">
                                <img
                                    :src="productImg(product.product_image)"
                                    class="topseller-product-img"
                                    :alt="product.title"
                                    :title="product.title"
                                    v-for="product in shop.products
                                        .latest_products"
                                    :key="product.id"
                                />
                            </div>
                        </div>

                        <router-link
                            :to="{
                                name: 'shop',
                                params: {
                                    shopId: shop.id,
                                    slug: shop.slug,
                                },
                            }"
                        >
                            <button class="btn btn-primary mt-4 btn-md-full">
                                View Seller
                            </button>
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
