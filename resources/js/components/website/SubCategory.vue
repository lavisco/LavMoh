<template>
    <div class="container-fluid">
        <div
            class="hero hero-default"
            v-bind:style="{ 'background-image': 'url(' + category.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">Browse {{ sub_category.name }}</h1>
                <h1 class="sub-title">
                    {{ category.name }}
                </h1>
            </div>
        </div>

        <div class="sort-section">
            <div class="filter-select">
                <label>Sort by</label>
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
                    <div class="card-body">
                        <div class="card-title">
                            {{ product.title }}
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-end">
                            <div class="card-body-text">
                                <div class="card-price mb-md-1">
                                    {{ currency.symbol }}
                                    {{
                                        product.base_price *
                                        currency.exchange_rate
                                    }}
                                    <span v-show="product.has_variations == 1">
                                        +
                                    </span>
                                </div>
                                <div class="card-secondary-text">
                                    {{
                                        product.user.shop
                                            ? product.user.shop.name
                                            : ""
                                    }}
                                </div>
                            </div>
                            <button class="bag-sm" type="button">
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
        sub_category: [],
        category: {},
        products: [],
        searchText: null,
        loading: true,
        //location data
        sortValue: "created_at",
        pagination: { current_page: 1 },
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get(
                "/api/sub_categories/" + to.params.subCategoryId + "?page=" + 1
            )
            .then((response) => {
                next((vm) => {
                    vm.setData(response);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get(
                "/api/sub_categories/" + to.params.subCategoryId + "?page=" + 1
            )
            .then((response) => {
                this.setData(response);
                next();
            });
    },

    watch: {
        sortValue(after, before) {
            Fire.$emit("reloadRecords");
        },
        locationActive(after, before) {
            this.pagination.current_page = 1;
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
        setData(response) {
            this.sub_category = response.data.sub_category;
            this.products = response.data.products.data;
            this.category = this.products[0].category;
            this.pagination.last_page = response.data.products.last_page;
            this.pagination.current_page = response.data.products.current_page;
            //this.loadLocalizedProducts();
            this.loading = false;
        },

        filterData() {
            this.loadData();
        },

        loadData() {
            axios
                .get(
                    "/api/sub_categories/" +
                        this.$route.params.subCategoryId +
                        "?page=" +
                        this.pagination.current_page,
                    {
                        params: { sortValue: this.sortValue },
                    }
                )
                .then((response) => {
                    this.sub_category = response.data.sub_category;
                    this.products = response.data.products.data;
                    this.pagination.last_page =
                        response.data.products.last_page;
                    this.pagination.current_page =
                        response.data.products.current_page;
                })
                .catch((error) => console.log(error));
        },

        loadLocalizedProducts() {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                axios
                    .get(
                        "/api/sub_categories/products/" +
                            this.$route.params.subCategoryId +
                            "/" +
                            this.locationActive +
                            "?page=" +
                            this.pagination.current_page
                    )
                    .then((response) => {
                        this.products = response.data.products.data;
                        this.pagination.last_page =
                            response.data.products.last_page;
                        this.pagination.current_page =
                            response.data.products.current_page;
                        $("#locationPopup").modal("show");
                    })
                    .catch((error) => console.log(error));
            }
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
