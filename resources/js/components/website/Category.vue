<template>
    <div class="container-fluid">
        <div
            class="hero hero-default"
            v-bind:style="{ 'background-image': 'url(' + category.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">Browse {{ category.name }}</h1>
                <h1 class="sub-title">
                    {{ category.description }}
                </h1>
            </div>
        </div>

        <div class="sort-section">
            <div class="filter-select">
                <label>Filter by</label>
                <select
                    class="custom-select form-control form-control-alternative"
                    id="filter"
                    name="filter"
                    @change.prevent="loadSubCategory()"
                    v-model="subCategoryValue"
                >
                    <option value="" disabled selected hidden>
                        Sub-category
                    </option>
                    <option
                        v-for="sub_category in sub_categories"
                        :value="sub_category.id"
                    >
                        {{ sub_category.name }}
                    </option>
                </select>
            </div>
            <div class="filter-select">
                <label>Sort by</label>
                <select
                    class="custom-select form-control form-control-alternative"
                    id="filter"
                    name="filter"
                    @change.prevent="filterData()"
                    v-model="sortValue"
                >
                    <option value="" disabled selected hidden>Sort by</option>
                    <option value="base_price_low">Price low to high</option>
                    <option value="base_price">Price high to low</option>
                    <option value="created_at">Latest</option>
                </select>
            </div>
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
                    :to="{
                        name: product.category_id == 7 ? 'giftboxes/product' : 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
                        },
                    }"
                    v-else
                    v-for="product in products"
                    :key="product.id"
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
                            {{ product.title }}
                        </div>
                        <div class="card-price">
                            {{ currency.symbol }}
                            {{ product.base_price * currency.exchange_rate }}
                            <span v-show="product.has_variations == 1">+</span>
                        </div>
                        <div class="card-secondary-text">
                            {{ product.user.shop.name }}
                        </div>
                    </div>
                </router-link>
            </div>
            <div v-if="!loading" class="d-flex justify-content-center mt-5">
                <a href="" class="view-more-link">View More</a>
            </div>
        </section>

        <!-- Modal -->
        <div
            class="modal fade"
            id="locationPopup"
            tabindex="-1"
            aria-labelledby="locationPopupLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="locationPopupLabel">
                            Showing products available in
                            <strong>{{ locationActive }}</strong>
                        </h4>
                        <button
                            type="button"
                            class="btn-modal-close close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        category: [],
        sub_categories: [],
        products: [],
        searchText: null,
        loading: true,
        //location data
        sortValue: "created_at",
        subCategoryValue: "",
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get("/api/categories/" + to.params.categoryId)
            .then((response) => {
                next((vm) => {
                    vm.setData(response, to.params.categoryId);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get("/api/categories/" + to.params.categoryId)
            .then((response) => {
                this.setData(response, to.params.categoryId);
                next();
            });
    },

    watch: {
        searchText(after, before) {
            this.loadData();
        },
        locationActive(after, before) {
            this.loadLocalizedProducts();
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
        setData(response, route) {
            this.category = response.data.category;
            this.sub_categories = response.data.sub_categories;
            this.products = response.data.products.data;
            this.loadLocalizedProducts(route);
            this.loading = false;
        },

        filterData() {
            this.subCategoryValue == ""
                ? this.loadData()
                : this.loadSubCategory();
        },

        loadData() {
            axios
                .get("/api/categories/" + this.$route.params.categoryId, {
                    params: { sortValue: this.sortValue },
                })
                .then((response) => {
                    this.category = response.data.category;
                    this.products = response.data.products.data;
                })
                .catch((error) => console.log(error));
        },

        loadSubCategory() {
            axios
                .get(
                    "/api/categories/sub_category/" +
                        this.$route.params.categoryId,
                    {
                        params: {
                            sortValue: this.sortValue,
                            subCategoryValue: this.subCategoryValue,
                        },
                    }
                )
                .then((response) => {
                    this.products = response.data.products.data;
                })
                .catch((error) => console.log(error));
        },

        loadLocalizedProducts(route) {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                axios
                    .get(
                        "/api/categories/products/" +
                            route +
                            "/" +
                            this.locationActive
                    )
                    .then((response) => {
                        this.products = response.data.products.data;
                        $("#locationPopup").modal("show");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
    },
};
</script>
