<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Banner</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="table-col-sm">
                                            Status
                                        </th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="shop in shops">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container"
                                                :src="shop.path"
                                            />
                                        </td>
                                        <th>{{ shop.name }}</th>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                name="status"
                                                id="status"
                                                v-model="shop.status"
                                                @change.prevent="
                                                    setCurrentState(
                                                        shop,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option value="1">
                                                    Active
                                                </option>
                                                <option value="0">
                                                    Inactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            {{ shop.address }}<br />
                                            {{ shop.city }},
                                            {{ shop.district }},
                                            {{ shop.province }},
                                            {{ shop.country }}
                                        </td>
                                        <td>{{ shop.user.name }}</td>
                                        <td>
                                            <span
                                                v-html="shopRating(shop.rating)"
                                            ></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a
                                                    class="
                                                        btn btn-sm btn-icon-only
                                                        text-primary
                                                    "
                                                    href="#"
                                                    role="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-ellipsis-v
                                                        "
                                                    ></i>
                                                </a>
                                                <div
                                                    class="
                                                        dropdown-menu
                                                        dropdown-menu-right
                                                        dropdown-menu-arrow
                                                    "
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editModal(shop)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteShop(shop.id)
                                                        "
                                                    >
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-secondary">
                    <!-- Modal Header -->
                    <div class="modal-header bg-neutral">
                        <h4
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Shop
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Shop
                        </h4>
                        <button
                            type="button"
                            class="close"
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

                    <form
                        class="input-form"
                        @submit.prevent="editMode ? updateShop() : createShop()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        name="name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Name"
                                    />
                                    <HasError :form="form" field="name" />
                                </div>
                            </div>
                            <div class="form-group row" v-show="editMode">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="slug"
                                    >Slug
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="slug"
                                        v-model="form.slug"
                                        type="text"
                                        name="slug"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="slug" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="url"
                                    >URL
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="url"
                                        v-model="form.url"
                                        type="text"
                                        name="url"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="url"
                                    />
                                    <HasError :form="form" field="url" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="status"
                                >
                                    Status
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <div class="col-md-9">
                                    <div
                                        class="
                                            custom-control
                                            custom-radio
                                            custom-control-inline
                                        "
                                    >
                                        <input
                                            type="radio"
                                            id="active"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="1"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="active"
                                            >Active</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control
                                            custom-radio
                                            custom-control-inline
                                        "
                                    >
                                        <input
                                            type="radio"
                                            id="inactive"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="0"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="inactive"
                                            >Inactive</label
                                        >
                                    </div>
                                    <HasError :form="form" field="status" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="about"
                                    >About
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <textarea
                                        id="about"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        name="about"
                                        rows="3"
                                        cols="50"
                                        v-model="form.about"
                                    >
                                    </textarea>
                                    <HasError :form="form" field="about" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="rating"
                                    >Rating
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="rating"
                                        id="rating"
                                        v-model="form.rating"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Null
                                        </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <HasError :form="form" field="rating" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="user_id"
                                    >Seller
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="user_id"
                                        id="user_id"
                                        v-model="form.user_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Seller
                                        </option>
                                        <option
                                            v-for="seller in sellers"
                                            :value="seller.user_id"
                                        >
                                            {{ seller.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="user_id" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="banner"
                                    >Upload banner
                                </label>

                                <div class="col-md-9">
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelected"
                                        ref="fileInput"
                                        name="banner"
                                    />

                                    <button
                                        class="image-upload-box"
                                        @click.prevent="$refs.fileInput.click()"
                                    >
                                        <i
                                            v-show="!this.form.banner"
                                            class="fas fa-plus"
                                        ></i>
                                        <i
                                            v-show="this.form.banner"
                                            class="fas fa-check"
                                        ></i>
                                    </button>
                                    <p class="image-upload-filename mt-2">
                                        {{
                                            this.form.banner
                                                ? this.form.photoName
                                                : `Choose file`
                                        }}
                                    </p>
                                    <HasError :form="form" field="banner" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="address"
                                    >Address
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <textarea
                                        id="address"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        name="address"
                                        rows="3"
                                        cols="50"
                                        v-model="form.address"
                                    >
                                    </textarea>
                                    <HasError :form="form" field="address" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="country"
                                    >Country
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="country"
                                        id="country"
                                        v-model="form.country"
                                        @change.prevent="loadProvinces()"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Country
                                        </option>
                                        <option
                                            v-for="country in countries"
                                            :value="country.name"
                                        >
                                            {{ country.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="country" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="province"
                                    >Province
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="province"
                                        v-model="form.province"
                                        name="province"
                                        @change.prevent="loadDistricts()"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Province
                                        </option>
                                        <option
                                            v-for="province in provinces"
                                            :value="province.name"
                                        >
                                            {{ province.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="province" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="district"
                                    >District
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="district"
                                        v-model="form.district"
                                        name="district"
                                        @change.prevent="loadCities()"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select District
                                        </option>
                                        <option
                                            v-for="district in districts"
                                            :value="district.name"
                                        >
                                            {{ district.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="district" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="zipcode"
                                    >Zipcode
                                </label>

                                <div class="col-md-4">
                                    <input
                                        id="zipcode"
                                        v-model="form.zipcode"
                                        type="text"
                                        name="zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="zipcode"
                                    />
                                    <HasError :form="form" field="zipcode" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="city"
                                    >City
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="city"
                                        v-model="form.city"
                                        name="city"
                                        @change.prevent="loadAreas()"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select City
                                        </option>
                                        <option
                                            v-for="city in cities"
                                            :value="city.name"
                                        >
                                            {{ city.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="city" />
                                </div>
                            </div>
                            <div
                                class="form-group row"
                                v-show="areas[0] != null"
                            >
                                <label
                                    class="col-md-3 col-form-label"
                                    for="area"
                                    >Area
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="area"
                                        v-model="form.area"
                                        name="area"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Area
                                        </option>
                                        <option
                                            v-for="area in areas"
                                            :value="area.name"
                                        >
                                            {{ area.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="area" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button
                                v-show="editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-pen-nib mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                            <button
                                v-show="!editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>
                    </form>

                    <!-- Form end -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        editMode: false,
        loading: true,
        shops: [],
        sellers: [],
        //location data
        countries: [],
        provinces: [],
        districts: [],
        cities: [],
        areas: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            banner: "",
            url: "",
            about: "",
            rating: "",
            country: "",
            province: "",
            district: "",
            city: "",
            area: "",
            address: "",
            zipcode: "",
            status: "",
            user_id: "",
            user: "",
            slug: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadShops();
        },
    },

    methods: {
        fileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.banner = reader.result;
                this.form.photoName = e.target.files[0].name;
            };
            reader.readAsDataURL(file);
        },

        shopRating(rating) {
            var result = "";
            if (rating < 1) {
                return (result = "No rating");
            } else {
                for (var j = 1; j <= rating; j++) {
                    result += `<i class="fas fa-star text-yellow"></i>`;
                }
                for (var j = 5; j > rating; j--) {
                    result += `<i class="fas fa-star text-lighter"></i>`;
                }
                return result;
            }
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadSellers();
            this.loadCountries();
            $("#addRecord").modal("show");
        },

        editModal(shop) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.form.fill(shop);
            this.loadSellers();
            this.loadCountries();
            this.loadProvinces();
            this.loadDistricts();
            this.loadCities();
            $("#addRecord").modal("show");
        },

        loadShops() {
            axios
                .get("/api/admin/shops", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.shops = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadSellers() {
            axios
                .get("/api/admin/users/seller")
                .then(({ data }) => (this.sellers = data))
                .catch((error) => console.log(error));
        },

        loadCountries() {
            axios
                .get("/api/locations/countries")
                .then(({ data }) => (this.countries = data))
                .catch((error) => console.log(error));
        },

        loadProvinces() {
            axios
                .get("/api/locations/provinces")
                .then(({ data }) => (this.provinces = data))
                .catch((error) => console.log(error));
        },

        loadDistricts() {
            axios
                .get("/api/locations/districts/" + this.form.province)
                .then(({ data }) => (this.districts = data))
                .catch((error) => console.log(error));
        },

        loadCities() {
            axios
                .get("/api/locations/cities/" + this.form.district)
                .then(({ data }) => (this.cities = data))
                .catch((error) => console.log(error));
        },

        loadAreas() {
            axios
                .get("/api/locations/areas/" + this.form.city)
                .then(({ data }) => (this.areas = data))
                .catch((error) => console.log(error));
        },

        createShop() {
            this.form
                .post("/api/admin/shops")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteShop(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/shops/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateShop() {
            this.form
                .put("/api/admin/shops/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    if (this.form.status == 1) {
                        this.sendStoreActiveMail(this.form.user.email);
                    }
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        setCurrentState(shop, event) {
            if (confirm("Are you sure you want to update Status?")) {
                this.form.status = event.target.value;
                this.form
                    .put("/api/admin/shops/updateState/" + shop.id)
                    .then(() => {
                        if (this.form.status == 1) {
                            this.sendStoreActiveMail(shop.user.email);
                        }
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        sendStoreActiveMail(email) {
            axios
                .get("/api/email/store_active/" + email)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        this.loadShops();
        Fire.$on("reloadRecords", () => {
            this.loadShops();
        });
    },
};
</script>
