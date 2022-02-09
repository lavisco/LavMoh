<template>
    <div class="container-fluid">
        <div
            class="hero"
            v-bind:style="{ 'background-image': 'url(' + category.path + ')' }"
        >
            <h1 class="title text-center">Browse {{ category.name }}</h1>
            <h1 class="sub-title mb-5 text-center">
                {{ category.description }}
            </h1>
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

                        <div class="card-title-2">
                            <router-link
                                class="card-title-2"
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
                        <div class="card-price">{{ product.base_price }}</div>
                        <div class="card-secondary-text">
                            Made by {{ product.user.shop.name }}
                        </div>
                        <button class="btn-sm btn-full btn-sm-cart mt-auto">
                            Add to Cart
                        </button>
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
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
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
                        <div class="form-group" v-if="countryMode">
                            <label class="col-form-label" for="countryId"
                                >Country
                                <strong class="text-danger"> *</strong>
                            </label>

                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                name="countryId"
                                id="countryId"
                                v-model="countryId"
                                @change.prevent="loadProvinces()"
                            >
                                <option value="" disabled selected hidden>
                                    Select Country
                                </option>
                                <option
                                    v-for="country in countries"
                                    :value="country.id"
                                >
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group" v-if="provinceMode">
                            <label class="col-form-label" for="provinceId"
                                >Province
                                <strong class="text-danger"> *</strong>
                            </label>

                            <select
                                class="
                                    custom-select
                                    form-control form-control-alternative
                                "
                                name="provinceId"
                                id="provinceId"
                                v-model="provinceId"
                                @change.prevent="loadDistricts()"
                            >
                                <option value="" disabled selected hidden>
                                    Select Province
                                </option>
                                <option
                                    v-for="province in provinces"
                                    :value="province.id"
                                >
                                    {{ province.name }}
                                </option>
                            </select>
                        </div>
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
                                @change.prevent="loadCities()"
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
                                @change.prevent="cityHasArea()"
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
        countries: [],
        provinces: [],
        districts: [],
        cities: [],
        areas: [],
        countryId: "",
        provinceId: "",
        districtId: "",
        city: "",

        countryMode: false,
        provinceMode: false,
        districtMode: false,
        cityMode: false,
        areaMode: false,
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
            this.loadCountries();
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

        loadCountries() {
            if (this.category.name == "Cake" || this.category.name == "cake") {
                axios
                    .get("/api/locations/countries")
                    .then(({ data }) => {
                        this.countries = data;
                        this.countryMode = true;
                        this.provinceMode = false;
                        this.districtMode = false;
                        this.cityMode = false;
                        this.areaMode = false;
                        $("#addRecord").modal("show");
                    })
                    .catch((error) => console.log(error));
            }
        },

        loadProvinces() {
            axios
                .get("/api/locations/provinces/" + this.countryId)
                .then(({ data }) => {
                    this.provinces = data;
                    this.provinceMode = true;
                    this.countryMode = false;
                    this.districtMode = false;
                    this.cityMode = false;
                    this.areaMode = false;
                })
                .catch((error) => console.log(error));
        },
        loadDistricts() {
            axios
                .get("/api/locations/districts/" + this.provinceId)
                .then(({ data }) => {
                    this.districts = data;
                    this.districtMode = true;
                    this.countryMode = false;
                    this.provinceMode = false;
                    this.cityMode = false;
                    this.areaMode = false;
                })
                .catch((error) => console.log(error));
        },
        loadCities() {
            axios
                .get("/api/locations/cities/" + this.districtId)
                .then(({ data }) => {
                    this.cities = data;
                    this.cityMode = true;
                    this.countryMode = false;
                    this.provinceMode = false;
                    this.districtMode = false;
                    this.areaMode = false;
                })
                .catch((error) => console.log(error));
        },
        cityHasArea() {
            if (this.city.has_area == true) {
                this.loadAreas();
            } else {
                axios
                    .get(
                        "/api/categories/products/" +
                            this.$route.params.categoryId +
                            "/" +
                            this.city.name
                    )
                    .then((response) => {
                        //this.category = response.data.category;
                        this.products = response.data.products.data;
                        $("#addRecord").modal("hide");
                    })
                    .catch((error) => console.log(error));
            }
        },
        loadAreas() {
            axios
                .get("/api/locations/areas/" + this.city.id)
                .then(({ data }) => {
                    this.areas = data;
                    this.areaMode = true;
                    this.countryMode = false;
                    this.provinceMode = false;
                    this.districtMode = false;
                    this.cityMode = false;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {},
};
</script>
