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
                    v-model="subCategoryValue"
                >
                    <option value="" selected>All</option>
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
                            location: locationActive,
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
                    <div class="card-body">
                        <div class="card-title">
                            {{ product.title }}
                        </div>
                        <div
                            class="
                                d-flex
                                flex-row
                                justify-content-between
                                align-items-end
                            "
                        >
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
                @paginate="paginateData()"
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
            data-backdrop="static"
            data-keyboard="false"
        >
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="locationPopupLabel">
                            Select product delivery location
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p class="mb-4">
                            Displaying products available in
                            <strong>{{ locationActive }}</strong>
                        </p>
                        <div class="d-flex flex-row">
                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                id="filter"
                                name="filter"
                                @change.prevent="saveLocation(cityName)"
                                v-model="cityName"
                            >
                                <option value="" disabled selected hidden>
                                    Select City
                                </option>
                                <option
                                    v-for="city in cities"
                                    :key="city.id"
                                    :value="city.name"
                                >
                                    {{ city.name }}
                                </option>
                            </select>
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
        cities: [],
        //filter data
        sortValue: "created_at",
        subCategoryValue: "",
        cityName: "",
        pagination: { current_page: 1 },
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get(
                "/api/categories/" +
                    to.params.categoryId +
                    "/" +
                    to.params.location +
                    "?page=" +
                    1
            )
            .then((response) => {
                next((vm) => {
                    vm.setData(response, to.params.categoryId);
                });
            });
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get(
                "/api/categories/" +
                    to.params.categoryId +
                    "/" +
                    to.params.location +
                    "?page=" +
                    1
            )
            .then((response) => {
                this.setData(response, to.params.categoryId);
                next();
            });
    },

    watch: {
        sortValue(after, before) {
            this.subCategoryValue == ""
                ? Fire.$emit("reloadRecords")
                : Fire.$emit("reloadSubCategoryRecords");
        },

        subCategoryValue(after, before) {
            this.subCategoryValue == ""
                ? Fire.$emit("reloadRecords")
                : Fire.$emit("reloadSubCategoryRecords");
        },

        locationActive(after, before) {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                this.sortValue = "created_at";
                this.subCategoryValue = "";

                this.$router.push({
                    name: "categories/category",
                    params: {
                        categoryId: this.category.id,
                        slug: this.category.slug,
                        location: this.locationActive,
                    },
                });
            }
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        chunkedCities() {
            return _.chunk(this.cities, 13);
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

            this.sortValue = "created_at";
            this.subCategoryValue = "";

            this.loading = false;
        },

        loadLocationSelector() {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "Fresh Flowers"
            ) {
                this.loadCities();
                $("#locationPopup").modal("show");
            }
        },

        saveLocation(city) {
            this.$store.dispatch("saveLocation", city);

            $("#locationPopup").modal("hide");

            this.$router.replace({
                name: "categories/category",
                params: {
                    categoryId: this.category.id,
                    slug: this.category.slug,
                    location: this.locationActive,
                },
            });
        },

        loadCities() {
            axios
                .get("/api/locations/cities")
                .then(({ data }) => {
                    this.cities = data;
                })
                .catch((error) => console.log(error));
        },

        paginateData() {
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
                        "/" +
                        this.locationActive +
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
                        "/" +
                        this.locationActive +
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
    },
    mounted() {
        this.loadLocationSelector();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadData();
        });
        Fire.$on("reloadSubCategoryRecords", () => {
            this.pagination.current_page = 1;
            this.loadSubCategory();
        });
    },
};
</script>
