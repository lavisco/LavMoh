<template>
    <div class="container-fluid">
        <div class="hero hero-default">
            <div class="slide-content">
                <h1 class="title mb-3">All Recipients</h1>
                <h1 class="sub-title mb-5">
                    From cakes to bags, Lavisco has everything you are looking
                    for!
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
            v-for="recipient in recipients"
            :key="recipient.id"
        >
            <h1 class="text-left">{{ recipient.name }}</h1>
            <div
                class="
                    d-flex
                    swiper-index-product
                    card-container-display
                    align-items-center
                "
            >
                <router-link
                    class="card item-card"
                    v-for="product in recipient.latest_products"
                    :key="product.id"
                    :to="{
                        name: 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
                            location: locationActive,
                        },
                    }"
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
                            :alt="product.title"
                        />
                    </div>
                    <div class="card-body">
                        <div class="card-body-text">
                            <div class="card-title">
                                {{ product.title }}
                            </div>
                            <div class="card-price">
                                {{ currency.symbol }}
                                {{
                                    product.base_price * currency.exchange_rate
                                }}
                                <span v-show="product.has_variations == 1">
                                    +
                                </span>
                            </div>
                        </div>
                        <button class="bag-sm" type="button" name="add to cart">
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
                </router-link>
                <router-link
                    class="view-more-link"
                    :to="{
                        name: 'recipients/recipient',
                        params: {
                            recipientId: recipient.id,
                            slug: recipient.slug,
                            location: locationActive,
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
        recipients: [],
        searchText: null,
        loading: true,
    }),

    watch: {
        searchText(after, before) {
            this.loadOccasions();
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        loadOccasions() {
            axios
                .get("/api/recipients")
                .then(({ data }) => {
                    this.recipients = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadOccasions();
        Fire.$on("reloadRecords", () => {
            this.loadOccasions();
        });
    },
};
</script>
