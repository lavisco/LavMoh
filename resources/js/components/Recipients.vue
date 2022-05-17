<template>
    <div class="container-fluid">
        <div class="hero hero-default">
            <div class="slide-content">
                <h1 class="title mb-3">Browse All Recipients</h1>
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
        >
            <h1 class="text-left">{{ recipient.name }}</h1>
            <div class="d-flex card-container align-items-center">
                <div
                    class="card item-card"
                    v-for="product in recipient.latest_products"
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
                            <router-link
                                class="card-title"
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
                        <div class="card-title card-price">
                            {{ product.base_price }}
                        </div>
                    </div>
                </div>
                <router-link
                    class="view-more-link"
                    :to="{
                        name: 'recipients/recipient',
                        params: {
                            recipientId: recipient.id,
                            slug: recipient.slug,
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
