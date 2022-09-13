<template>
    <div class="container-fluid">
        <div
            class="hero hero-default"
            v-bind:style="{ 'background-image': 'url(' + occasion.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">{{ occasion.name }} gifts</h1>
                <h1 class="sub-title">
                    {{ occasion.description }}
                </h1>
            </div>
        </div>

        <div class="sort-section">
            <select
                class="custom-select form-control form-control-alternative"
                id="filter"
                name="filter"
                v-model="sortValue"
            >
                <option value="" disabled selected hidden>Sort by</option>
                <option value="base_price_low">Price low to high</option>
                <option value="base_price">Price high to low</option>
                <option value="created_at">Latest</option>
            </select>
        </div>

        <section class="section-best-seller mb-5 mt-4">
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
                        name: 'products/product',
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
                    <div class="px-md-3">
                        <div class="card-price">
                            {{ currency.symbol }}
                            {{ product.base_price * currency.exchange_rate }}
                            <span v-show="product.has_variations == 1">+</span>
                        </div>
                        <div class="card-title-2">
                            {{ product.title }}
                        </div>
                        <div class="card-secondary-text">
                            {{ product.user.shop.name }}
                        </div>
                        <button class="btn-secondary btn-sm btn-full mt-3">View</button>
                    </div>
                </router-link>
            </div>
            <!-- Pagination Start -->

            <pagination
                class="mt-4"
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="loadData()"
            ></pagination>

            <!-- Pagination end -->
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
        sortValue: "created_at",
        pagination: { current_page: 1 },
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get("/api/occasions/" + to.params.occasionId + "?page=" + 1)
            .then((response) => {
                next((vm) => {
                    vm.setData(response);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get("/api/occasions/" + to.params.occasionId + "?page=" + 1)
            .then((response) => {
                this.setData(response);
                next();
            });
    },

    watch: {
        sortValue(after, before) {
            Fire.$emit("reloadRecords");
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
            this.occasion = response.data.occasion;
            this.pagination.last_page = response.data.products.last_page;
            this.pagination.current_page = response.data.products.current_page;
            this.loading = false;
        },
        loadData() {
            axios
                .get(
                    "/api/occasions/" +
                        this.$route.params.occasionId +
                        "?page=" +
                        this.pagination.current_page,
                    {
                        params: { sortValue: this.sortValue },
                    }
                )
                .then((response) => {
                    this.products = response.data.products.data;
                    this.occasion = response.data.occasion;
                    this.pagination.last_page =
                        response.data.products.last_page;
                    this.pagination.current_page =
                        response.data.products.current_page;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadData();
        });
    },
};
</script>
