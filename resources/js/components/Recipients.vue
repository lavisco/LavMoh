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
                        },
                    }"
                >
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
                        /></svg
                ></router-link>
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
