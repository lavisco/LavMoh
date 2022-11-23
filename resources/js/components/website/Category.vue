<template>
    <div class="container-fluid">
        <div class="hero-with-slider">
            <div class="slide-content">
                <h1 class="title mb-3">Browse {{ category.name }}</h1>
                <h1 class="sub-title">
                    {{ category.description }}
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">
                            <router-link to="/categories">
                                Categories
                            </router-link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ category.name }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="hero-mini-slider">
                <swiper
                    class="swiper swiper-index-product"
                    :options="swiperOption"
                >
                    <swiper-slide
                        v-for="sub_category in sub_categories"
                        :key="sub_category.id"
                    >
                        <router-link
                            :to="{
                                name: 'sub_category',
                                params: {
                                    subCategoryId: sub_category.id,
                                    slug: sub_category.slug,
                                    location: locationActive,
                                },
                            }"
                            class="card-chip"
                        >
                            <img :src="sub_category.path" />
                            <div class="name">{{ sub_category.name }}</div>
                        </router-link>
                    </swiper-slide>
                    <div class="swiper-button-next">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                        >
                            <g transform="translate(24 0) scale(-1 1)">
                                <path
                                    fill="white"
                                    fill-rule="evenodd"
                                    d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18zm1.707-11.293a1 1 0 0 0-1.414-1.414l-3 3a1 1 0 0 0 0 1.414l3 3a1 1 0 0 0 1.414-1.414L11.414 12l2.293-2.293z"
                                    clip-rule="evenodd"
                                />
                            </g>
                        </svg>
                    </div>
                    <div class="swiper-button-prev">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="white"
                                fill-rule="evenodd"
                                d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18zm1.707-11.293a1 1 0 0 0-1.414-1.414l-3 3a1 1 0 0 0 0 1.414l3 3a1 1 0 0 0 1.414-1.414L11.414 12l2.293-2.293z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                </swiper>
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
                            :alt="product.title"
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
                            <button
                                class="bag-sm"
                                type="button"
                                name="add to cart"
                            >
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
        >
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="locationPopupLabel">
                            Select product delivery location
                        </h4>
                        <a
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 34 34"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="34"
                                    height="34"
                                    rx="17"
                                    fill="#333333"
                                />
                                <g clip-path="url(#clip0_355_858)">
                                    <path
                                        d="M21.5803 10.9735L23.0266 12.4199C23.2275 12.6208 23.328 12.8618 23.328 13.1431C23.328 13.4243 23.2275 13.6653 23.0266 13.8662L19.8929 17L23.0266 20.1338C23.2275 20.3347 23.328 20.5757 23.328 20.8569C23.328 21.1382 23.2275 21.3792 23.0266 21.5801L21.5803 23.0265C21.3794 23.2274 21.1383 23.3278 20.8571 23.3278C20.5759 23.3278 20.3348 23.2274 20.1339 23.0265L17.0002 19.8927L13.8664 23.0265C13.6655 23.2274 13.4244 23.3278 13.1432 23.3278C12.862 23.3278 12.6209 23.2274 12.42 23.0265L10.9737 21.5801C10.7728 21.3792 10.6724 21.1382 10.6724 20.8569C10.6724 20.5757 10.7728 20.3347 10.9737 20.1338L14.1074 17L10.9737 13.8662C10.7728 13.6653 10.6724 13.4243 10.6724 13.1431C10.6724 12.8618 10.7728 12.6208 10.9737 12.4199L12.42 10.9735C12.6209 10.7726 12.862 10.6722 13.1432 10.6722C13.4244 10.6722 13.6655 10.7726 13.8664 10.9735L17.0002 14.1073L20.1339 10.9735C20.3348 10.7726 20.5759 10.6722 20.8571 10.6722C21.1383 10.6722 21.3794 10.7726 21.5803 10.9735Z"
                                        fill="#f7f7f7"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_355_858">
                                        <rect
                                            width="15"
                                            height="15"
                                            fill="#333333"
                                            transform="translate(9.5 9.5)"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <div class="modal-body">
                        <p class="mb-4">
                            Displaying products available in
                            <strong class="red">{{ locationActive }}</strong>
                        </p>
                        <div class="d-flex flex-column">
                            <location-search
                                v-model="searchText"
                                class="px-0"
                            />
                            <div class="col-12 mt-4 px-0">
                                <a
                                    class="btn btn-sm mb-2"
                                    v-for="city in cities"
                                    :key="city.id"
                                    :value="city.name"
                                    @click.prevent="saveLocation(city.name)"
                                >
                                    {{ city.name }}
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
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
import "swiper/css/swiper.css";
import _ from "lodash";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    directives: {
        swiper: directive,
    },

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
        swiperOption: {
            slidesPerView: 6,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
            },
        },
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
        searchText: _.debounce(function (after, before) {
            this.loadCities();
        }, 300),

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
            if (this.category.id == 1 || this.category.id == 8) {
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
                .get("/api/locations/cities", {
                    params: { searchText: this.searchText },
                })
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
