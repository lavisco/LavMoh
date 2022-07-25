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
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">District</th>
                                        <th scope="col">Shop</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sellerprofile in sellerprofiles">
                                        <th scope="row">
                                            {{ sellerprofile.first_name }}
                                            {{ sellerprofile.last_name }}
                                        </th>
                                        <td>
                                            {{ sellerprofile.phone }} <br />
                                            {{ sellerprofile.email }}
                                        </td>
                                        <td>
                                            {{ sellerprofile.address }},
                                            {{ sellerprofile.zipcode }}<br />
                                            {{ sellerprofile.city }},
                                            {{ sellerprofile.district }},
                                            {{ sellerprofile.province }},
                                            {{ sellerprofile.country }}
                                        </td>
                                        <td>
                                            {{ sellerprofile.district }}
                                        </td>
                                        <td>
                                            {{
                                                sellerprofile.user.shop
                                                    ? sellerprofile.user.shop
                                                          .name
                                                    : "No shop"
                                            }}
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
                                                            editModal(
                                                                sellerprofile
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteSellerprofile(
                                                                sellerprofile.id
                                                            )
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
                            Update the Seller Profile
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Seller Profile
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
                        @submit.prevent="
                            editMode
                                ? updateSellerprofile()
                                : createSellerprofile()
                        "
                    >
                        <div class="modal-body input-form-compact">
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
                            <hr class="mb-0" />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="first_name"
                                        >First Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        name="first_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="First Name"
                                    />
                                    <HasError :form="form" field="first_name" />
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="last_name"
                                        >Last Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        name="last_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Last Name"
                                    />
                                    <HasError :form="form" field="last_name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="phone"
                                        >Phone
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="phone"
                                        v-model="form.phone"
                                        type="text"
                                        name="phone"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Phone"
                                    />
                                    <HasError :form="form" field="phone" />
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="email"
                                        >Email
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Email"
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label" for="address"
                                        >Address
                                        <strong class="text-danger"> *</strong>
                                    </label>
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
                                <div class="col-md-6">
                                    <label class="col-form-label" for="country"
                                        >Country
                                        <strong class="text-danger"> *</strong>
                                    </label>
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
                                <div class="col-md-6">
                                    <label class="col-form-label" for="province"
                                        >Province
                                        <strong class="text-danger"> *</strong>
                                    </label>
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
                                <div class="col-md-4">
                                    <label class="col-form-label" for="zipcode"
                                        >Zip Code
                                    </label>
                                    <input
                                        id="zipcode"
                                        v-model="form.zipcode"
                                        type="text"
                                        name="zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Zip code"
                                    />
                                    <HasError :form="form" field="zipcode" />
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="district"
                                        >District
                                        <strong class="text-danger"> *</strong>
                                    </label>
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
                                <div class="col-md-4">
                                    <label class="col-form-label" for="city"
                                        >City
                                        <strong class="text-danger"> *</strong>
                                    </label>
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

                            <!-- Billing -->
                            <h4 class="text-gray mt-4">Billing</h4>
                            <hr class="mt-0 mb-2" />

                            <div class="custom-control custom-checkbox">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="customCheck1"
                                    v-model="billingMode"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customCheck1"
                                    >Billing Address same as above</label
                                >
                            </div>

                            <div
                                class="input-form-compact"
                                id="billingSection"
                                v-show="!billingMode"
                            >
                                <hr class="my-2" />
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label
                                            class="col-form-label"
                                            for="billing_address"
                                            >Address
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>
                                        <textarea
                                            id="billing_address"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            name="billing_address"
                                            rows="3"
                                            cols="50"
                                            v-model="form.billing_address"
                                        >
                                        </textarea>
                                        <HasError
                                            :form="form"
                                            field="billing_address"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Billing end -->

                            <!-- Account -->

                            <h4 class="text-gray mt-4">Deposit Account</h4>
                            <hr class="mt-0 mb-2" />

                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label
                                        class="col-form-label"
                                        for="deposit_account"
                                        >Account no.
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="deposit_account"
                                        v-model="form.deposit_account"
                                        type="text"
                                        name="deposit_account"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="deposit account no."
                                    />
                                    <HasError
                                        :form="form"
                                        field="deposit_account"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <label
                                        class="col-form-label"
                                        for="deposit_account_status"
                                        >Status
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <div>
                                        <div
                                            class="
                                                custom-control
                                                custom-radio
                                                custom-control-inline
                                            "
                                        >
                                            <input
                                                type="radio"
                                                id="status1"
                                                name="deposit_account_status"
                                                class="custom-control-input"
                                                v-model="
                                                    form.deposit_account_status
                                                "
                                                value="1"
                                            />
                                            <label
                                                class="custom-control-label"
                                                for="status1"
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
                                                id="status2"
                                                name="deposit_account_status"
                                                class="custom-control-input"
                                                v-model="
                                                    form.deposit_account_status
                                                "
                                                value="0"
                                            />
                                            <label
                                                class="custom-control-label"
                                                for="status2"
                                                >Inactive</label
                                            >
                                        </div>
                                    </div>

                                    <HasError
                                        :form="form"
                                        field="deposit_account_status"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label
                                        class="col-form-label"
                                        for="deposit_name"
                                        >Account Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="deposit_name"
                                        v-model="form.deposit_name"
                                        type="text"
                                        name="deposit_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="deposit account name"
                                    />
                                    <HasError
                                        :form="form"
                                        field="deposit_name"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="deposit_bank"
                                        >Bank name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="deposit_bank"
                                        v-model="form.deposit_bank"
                                        type="text"
                                        name="deposit_bank"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Deposit bank name"
                                    />
                                    <HasError
                                        :form="form"
                                        field="deposit_bank"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="deposit_bank_branch"
                                        >Branch name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="deposit_bank_branch"
                                        v-model="form.deposit_bank_branch"
                                        type="text"
                                        name="deposit_bank_branch"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Deposit bank branch"
                                    />
                                    <HasError
                                        :form="form"
                                        field="deposit_bank_branch"
                                    />
                                </div>
                            </div>

                            <!-- Account end -->
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
        billingMode: false,
        loading: true,
        sellerprofiles: [],
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
            first_name: "",
            last_name: "",
            phone: "",
            email: "",
            country: "",
            province: "",
            district: "",
            city: "",
            address: "",
            zipcode: "",
            billing_address: "",
            deposit_account: "",
            deposit_name: "",
            deposit_bank: "",
            deposit_bank_branch: "",
            deposit_account_status: "",
            user_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadSellerprofiles();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadSellers();
            this.loadCountries();
            $("#addRecord").modal("show");
        },

        editModal(sellerprofile) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.form.fill(sellerprofile);
            this.loadSellers();
            this.loadCountries();
            this.loadProvinces();
            this.loadDistricts();
            this.loadCities();
            $("#addRecord").modal("show");
        },

        loadSellerprofiles() {
            axios
                .get("/api/admin/sellerprofiles", {
                    params: { searchText: this.searchText },
                })
                .then((response) => {
                    this.sellerprofiles = response.data.sellerprofiles;
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

        createSellerprofile() {
            if ((this.billingMode = true)) {
                this.form.billing_address =
                    this.form.address +
                    "," +
                    this.form.city +
                    "," +
                    this.form.district +
                    "," +
                    this.form.province +
                    "," +
                    this.form.country;
            }
            this.form
                .post("/api/admin/sellerprofiles")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteSellerprofile(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/sellerprofiles/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateSellerprofile() {
            if ((this.billingMode = true)) {
                this.form.billing_address =
                    this.form.address +
                    "," +
                    this.form.city +
                    "," +
                    this.form.district +
                    "," +
                    this.form.province +
                    "," +
                    this.form.country;
            }
            this.form
                .put("/api/admin/sellerprofiles/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadSellerprofiles();
        Fire.$on("reloadRecords", () => {
            this.loadSellerprofiles();
        });
    },
};
</script>
