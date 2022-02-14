<template>
    <div>
        <!-- Body -->
        <div class="container mt-3 mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card">
                        <!-- Form start -->
                        <form
                            class="input-form"
                            @submit.prevent="updateSellerprofile()"
                        >
                            <div class="input-form-compact">
                                <h4 class="mb-3">Seller Information</h4>
                                <p class="mb-4">
                                    Please make sure you add the most recent
                                    address.
                                </p>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="first_name"
                                            >First Name
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="first_name"
                                            v-model="form.first_name"
                                            type="text"
                                            name="first_name"
                                            class="form-control"
                                            placeholder="First Name"
                                        />
                                        <HasError
                                            :form="form"
                                            field="first_name"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="last_name"
                                            >Last Name
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="last_name"
                                            v-model="form.last_name"
                                            type="text"
                                            name="last_name"
                                            class="form-control"
                                            placeholder="Last Name"
                                        />
                                        <HasError
                                            :form="form"
                                            field="last_name"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label
                                            class="col-form-label"
                                            for="address"
                                            >Address
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <textarea
                                            id="address"
                                            class="form-control"
                                            name="address"
                                            rows="3"
                                            cols="50"
                                            v-model="form.address"
                                        >
                                        </textarea>
                                        <HasError
                                            :form="form"
                                            field="address"
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="country"
                                            >Country
                                            <strong class="text-danger">
                                                *</strong
                                            >
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
                                        <HasError
                                            :form="form"
                                            field="country"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="province"
                                            >Province
                                            <strong class="text-danger">
                                                *</strong
                                            >
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
                                        <HasError
                                            :form="form"
                                            field="province"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="zipcode"
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
                                        <HasError
                                            :form="form"
                                            field="zipcode"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="district"
                                            >District
                                            <strong class="text-danger">
                                                *</strong
                                            >
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
                                        <HasError
                                            :form="form"
                                            field="district"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="city"
                                            >City
                                            <strong class="text-danger">
                                                *</strong
                                            >
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

                                <!-- Contact -->
                                <h4 class="mt-5 mb-4">Contact Details</h4>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="phone"
                                            >Phone
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="phone"
                                            v-model="form.phone"
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            placeholder="Phone"
                                        />
                                        <HasError :form="form" field="phone" />
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="email"
                                            >Email
                                            <strong class="text-danger">
                                                *</strong
                                            >
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

                                <!-- Billing -->
                                <h4 class="mt-5 mb-4">Billing Address</h4>

                                <div
                                    class="input-form-compact"
                                    id="billingSection"
                                >
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="billing_address"
                                                >Billing Address
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <textarea
                                                id="billing_address"
                                                class="form-control"
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

                                <h4 class="mt-5 mb-3">
                                    Earnings Deposit Account Information
                                </h4>
                                <p class="mb-4">
                                    Please make sure the details you provide is
                                    accurate and updated. All payments will be
                                    made weekly into this account and lavisco.lk
                                    will not deposit into any other accounts not
                                    stated below
                                </p>

                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <label
                                            class="col-form-label"
                                            for="deposit_account"
                                            >Account no.
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="deposit_account"
                                            v-model="form.deposit_account"
                                            type="text"
                                            name="deposit_account"
                                            class="form-control"
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
                                            <strong class="text-danger">
                                                *
                                            </strong>
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
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="deposit_name"
                                            v-model="form.deposit_name"
                                            type="text"
                                            name="deposit_name"
                                            class="form-control"
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
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="deposit_bank"
                                            v-model="form.deposit_bank"
                                            type="text"
                                            name="deposit_bank"
                                            class="form-control"
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
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="deposit_bank_branch"
                                            v-model="form.deposit_bank_branch"
                                            type="text"
                                            name="deposit_bank_branch"
                                            class="form-control"
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

                            <div
                                class="
                                    d-flex
                                    justify-content-center
                                    align-items-center
                                    mt-5
                                "
                            >
                                <button type="submit" class="btn">
                                    <i
                                        class="fas fa-pen-nib mr-2"
                                        aria-hidden="true"
                                    ></i>
                                    Update
                                </button>
                            </div>
                        </form>
                        <!-- Form end -->
                    </div>
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
        sellerprofile: {},
        loading: true,
        //location data
        countries: [],
        provinces: [],
        districts: [],
        cities: [],
        areas: [],
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
        }),
    }),

    methods: {
        loadSellerprofile() {
            axios
                .get("/api/seller/sellerprofile")
                .then(({ data }) => {
                    this.sellerprofile = data;
                    this.form.fill(this.sellerprofile);
                    this.loadCountries();
                    this.loadProvinces();
                    this.loadDistricts();
                    this.loadCities();
                    this.loading = false;
                })
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
                .get("/api/locations/provinces/" + this.form.country)
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

        updateSellerprofile() {
            this.form
                .put("/api/seller/sellerprofile/" + this.form.id)
                .then(() => {
                    this.loadSellerprofile();
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadSellerprofile();
    },
};
</script>
