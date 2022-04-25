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
                                name: 'seller_shop',
                                params: {
                                    slug: shop.slug,
                                    shopId: shop.id,
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
            <div class="d-flex justify-content-center mt-5">
                <a>
                    View More
                    <svg
                        width="70"
                        height="24"
                        viewBox="0 0 90 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="ml-3"
                    >
                        <path
                            d="M2 10.5C1.17157 10.5 0.5 11.1716 0.5 12C0.5 12.8284 1.17157 13.5 2 13.5L2 10.5ZM89.0607 13.0607C89.6464 12.4749 89.6464 11.5251 89.0607 10.9393L79.5147 1.39341C78.9289 0.807618 77.9792 0.807618 77.3934 1.3934C76.8076 1.97919 76.8076 2.92894 77.3934 3.51473L85.8787 12L77.3934 20.4853C76.8076 21.0711 76.8076 22.0208 77.3934 22.6066C77.9792 23.1924 78.9289 23.1924 79.5147 22.6066L89.0607 13.0607ZM2 13.5L88 13.5L88 10.5L2 10.5L2 13.5Z"
                            fill="black"
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
        shops: [],
        searchText: null,
        loading: true,
    }),

    watch: {
        searchText(after, before) {
            this.loadShops();
        },
    },

    methods: {
        loadShops() {
            axios
                .get("/api/shops")
                .then(({ data }) => {
                    this.shops = data.data;
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
            this.loadShops();
        });
    },
};
</script>
