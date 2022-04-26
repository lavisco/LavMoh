<template>
    <div class="container-fluid">
        <div
            class="hero hero-default"
            v-bind:style="{ 'background-image': 'url(' + category.path + ')' }"
        >
            <div class="slide-content">
                <h1 class="title mb-3">Browse {{ category.name }}</h1>
                <h1 class="sub-title mb-5">
                    {{ category.description }}
                </h1>
            </div>
        </div>
        <section class="section-best-seller mb-5">
            <div class="d-flex flex-wrap justify-content-center card-container">
                <img v-if="loading" src="/images/lavisco/loading.gif" />
                <div v-else v-for="product in products" class="product-list">
                    <div class="card item-card-2">
                        <div class="card-img card-img-2">
                            <img
                                :src="
                                    product.product_image
                                        ? product.product_image.path
                                        : '/images/lavisco/img-bg.jpg'
                                "
                            />
                        </div>
                        <div class="px-3">
                            <div class="card-title-2">
                                <router-link
                                    class="card-title-2"
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
                            <div class="card-price">
                                {{ product.base_price }}
                            </div>
                            <div class="card-secondary-text">
                                Made by {{ product.user.shop.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4
                            class="modal-title text-uppercase"
                            id="locationPopupLabel"
                        >
                            Select Location
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

                    <!-- Form start -->
                    <div class="modal-body modal-view">
                        <div class="form-group" v-if="districtMode">
                            <label class="col-form-label" for="districtId"
                                >District
                                <strong class="text-danger"> *</strong>
                            </label>

                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                name="districtId"
                                id="districtId"
                                v-model="districtId"
                                @change.prevent="districtId ? loadCities() : ''"
                            >
                                <option value="" disabled selected hidden>
                                    Select District
                                </option>
                                <option
                                    v-for="district in districts"
                                    :value="district.id"
                                >
                                    {{ district.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group" v-if="cityMode">
                            <label class="col-form-label" for="city"
                                >City
                                <strong class="text-danger"> *</strong>
                            </label>

                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                name="city"
                                id="city"
                                v-model="city"
                                @change.prevent="loadLocationBasedProducts()"
                            >
                                <option value="" disabled selected hidden>
                                    Select City
                                </option>
                                <option v-for="city in cities" :value="city">
                                    {{ city.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click.prevent="resetLocation()"
                        >
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle mr-2"
                                aria-hidden="true"
                            ></i>
                            Close
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
        products: [],
        searchText: null,
        loading: true,
        //location data
        districts: [],
        cities: [],
        districtId: "",
        city: "",
        districtMode: false,
        cityMode: false,
    }),

    beforeRouteEnter: function (to, from, next) {
        let uri = "/api/categories/" + to.params.categoryId;

        axios.get(uri).then((response) => {
            next((vm) => {
                vm.setData(response);
            });
        });
    },

    beforeRouteUpdate: function (to, from, next) {
        let uri = "/api/categories/" + to.params.categoryId;
        axios.get(uri).then((response) => {
            this.setData(response);
            next();
        });
    },

    watch: {
        searchText(after, before) {
            this.loadData();
        },
    },

    methods: {
        setData(response) {
            this.category = response.data.category;
            this.products = response.data.products.data;
            this.loadDistricts();
            this.loading = false;
        },
        loadData() {
            axios
                .get("/api/categories/" + this.$route.params.categoryId)
                .then((response) => {
                    this.category = response.data.category;
                    this.products = response.data.products.data;
                })
                .catch((error) => console.log(error));
        },

        resetLocation() {
            this.districtMode = true;
            this.cityMode = false;
        },

        loadDistricts() {
            if (
                this.category.name == "Cakes" ||
                this.category.name == "cakes" ||
                this.category.name == "Cake" ||
                this.category.name == "cake"
            ) {
                axios
                    .get("/api/locations/districts")
                    .then(({ data }) => {
                        this.districts = data;
                        this.districtMode = true;
                        this.cityMode = false;
                        $("#locationPopup").modal("show");
                    })
                    .catch((error) => console.log(error));
            }
        },
        loadCities() {
            axios
                .get("/api/locations/cities/" + this.districtId)
                .then(({ data }) => {
                    this.cities = data;
                    this.cityMode = true;
                    this.districtMode = false;
                })
                .catch((error) => console.log(error));
        },
        loadLocationBasedProducts() {
            axios
                .get(
                    "/api/categories/products/" +
                        this.$route.params.categoryId +
                        "/" +
                        this.city.name
                )
                .then((response) => {
                    this.products = response.data.products.data;
                    $("#locationPopup").modal("hide");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {},
};
</script>
