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
                        name: 'products/product',
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
            <!-- Pagination Start -->

            <pagination
                class="mt-4"
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="filterData()"
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
                            Select product delivery location
                        </h4>
                        <button
                            type="button"
                            class="btn-modal-close close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                role="img"
                                width="30"
                                height="30"
                                preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 48 48"
                            >
                                <mask id="svgIDa">
                                    <g
                                        fill="none"
                                        stroke-linejoin="round"
                                        stroke-width="4"
                                    >
                                        <path
                                            fill="#fff"
                                            stroke="#fff"
                                            d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z"
                                        />
                                        <path
                                            stroke="#000"
                                            stroke-linecap="round"
                                            d="M29.657 18.343L18.343 29.657m0-11.314l11.314 11.314"
                                        />
                                    </g>
                                </mask>
                                <path
                                    fill="white"
                                    d="M0 0h48v48H0z"
                                    mask="url(#svgIDa)"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>
                            Display products available in
                            <strong>{{ locationActive }}</strong>
                        </h6>
                        <hr />
                        <div class="d-flex row">
                            <div
                                class="col-6 d-flex flex-column"
                                v-for="districts in chunkedDistricts"
                            >
                                <a
                                    class="nav-link-currency"
                                    @click.prevent="saveLocation(district.name)"
                                    v-for="district in districts"
                                    :key="district.id"
                                    :class="{
                                        active:
                                            locationActive === district.name,
                                    }"
                                >
                                    {{ district.name }}
                                </a>
                            </div>
                        </div>
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
        districts: [],
        //filter data
        sortValue: "created_at",
        subCategoryValue: "",
        pagination: { current_page: 1 },
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get("/api/categories/" + to.params.categoryId + "?page=" + 1)
            .then((response) => {
                next((vm) => {
                    vm.setData(response, to.params.categoryId);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get("/api/categories/" + to.params.categoryId + "?page=" + 1)
            .then((response) => {
                this.setData(response, to.params.categoryId);
                next();
            });
    },

    watch: {
        sortValue(after, before) {
            //Fire.$emit("reloadRecords");
            this.subCategoryValue == ""
                ? Fire.$emit("reloadRecords")
                : this.loadSubCategory();
        },
        locationActive(after, before) {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                Fire.$emit("reloadLocalizedRecords");
            }
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        chunkedDistricts() {
            return _.chunk(this.districts, 13);
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

            this.pagination.last_page = response.data.products.last_page;
            this.pagination.current_page = response.data.products.current_page;

            this.loading = false;
        },

        saveLocation(district) {
            this.$store.dispatch("saveLocation", district);
            Fire.$emit("reloadLocalizedRecords");
        },

        loadDistricts() {
            axios
                .get("/api/locations/districts")
                .then(({ data }) => {
                    this.districts = data;
                })
                .catch((error) => console.log(error));
        },

        filterData() {
            //this.pagination.current_page = 1;
            this.subCategoryValue == ""
                ? this.loadData()
                : this.loadSubCategory();
        },

        loadData() {
            axios
                .get(
                    "/api/categories/" +
                        this.$route.params.categoryId +
                        "?page=" +
                        this.pagination.current_page,
                    {
                        params: { sortValue: this.sortValue },
                    }
                )
                .then((response) => {
                    this.category = response.data.category;
                    this.products = response.data.products.data;
                    this.pagination.last_page =
                        response.data.products.last_page;
                    this.pagination.current_page =
                        response.data.products.current_page;
                })
                .catch((error) => console.log(error));
        },

        loadSubCategory() {
            axios
                .get(
                    "/api/categories/sub_category/" +
                        this.$route.params.categoryId +
                        "?page=" +
                        this.pagination.current_page,
                    {
                        params: {
                            sortValue: this.sortValue,
                            subCategoryValue: this.subCategoryValue,
                        },
                    }
                )
                .then((response) => {
                    this.products = response.data.products.data;
                    this.pagination.last_page =
                        response.data.products.last_page;
                    this.pagination.current_page =
                        response.data.products.current_page;
                })
                .catch((error) => console.log(error));
        },

        loadLocationSelector() {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                this.loadDistricts();
                $("#locationPopup").modal("show");
            }
        },

        loadLocalizedProducts(route) {
            axios
                .get(
                    "/api/categories/products/" +
                        route +
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
                    $("#locationPopup").modal("hide");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadLocationSelector();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadData();
        });
        Fire.$on("reloadLocalizedRecords", () => {
            this.pagination.current_page = 1;
            this.loadLocalizedProducts(this.category.id);
        });
    },
};
</script>
