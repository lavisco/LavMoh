<template>
    <!-- Body -->
    <div class="container seller-padding">
        <h1>Setup Your Shop</h1>
        <h5>Complete the form to start selling today!</h5>
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Form start -->
                    <form
                        class="input-form"
                        @submit.prevent="updateSellerprofile()"
                    >
                        <div class="input-form-compact">
                            <!-- Seller Profile -->
                            <h4 class="mt-3 mb-4 text-center">
                                Seller Information
                            </h4>
                            <p class="mb-4 darkgrey">
                                Please make sure you add the most recent
                                address.
                            </p>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="first_name"
                                        >First Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        name="first_name"
                                        class="form-control"
                                        placeholder="First Name"
                                    />
                                    <HasError :form="form" field="first_name" />
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="last_name"
                                        >Last Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        name="last_name"
                                        class="form-control"
                                        placeholder="Last Name"
                                    />
                                    <HasError :form="form" field="last_name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label" for="address"
                                        >Address
                                        <strong class="text-danger"> * </strong>
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

                            <!-- Contact -->
                            <h4 class="mt-5 mb-4">Contact Details</h4>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="phone"
                                        >Phone
                                        <strong class="text-danger"> * </strong>
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

                            <!-- Shop setup -->
                            <h4 class="mt-5 mb-4 text-center">
                                Store Setup Information
                            </h4>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label
                                        class="col-form-label"
                                        for="shop_name"
                                        >Store Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="shop_name"
                                        v-model="form.shop_name"
                                        type="text"
                                        name="shop_name"
                                        class="form-control"
                                        placeholder="Store Name"
                                    />
                                    <HasError :form="form" field="shop_name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="col-form-label" for="about"
                                        >About
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <textarea
                                        id="about"
                                        class="form-control"
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
                                <div class="col-12">
                                    <label class="col-form-label" for="banner"
                                        >Upload banner
                                        <p class="text-xs mt-2">
                                            Banner image must be under 2MB.
                                            Recommended resolution is 1920 x
                                            1080px.
                                        </p>
                                    </label>
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelected"
                                        ref="fileInput"
                                        name="banner"
                                    />
                                    <br />

                                    <button
                                        class="image-upload-box"
                                        @click.prevent="$refs.fileInput.click()"
                                    >
                                        <img
                                            v-if="url"
                                            :src="url"
                                            class="banner-container"
                                        />
                                        <img
                                            v-if="!url"
                                            src="/images/lavisco/img-bg.jpg"
                                            class="banner-container"
                                        />
                                    </button>
                                    <p class="image-upload-filename mt-2 mb-0">
                                        {{
                                            form.photoName
                                                ? form.photoName
                                                : `Upload image`
                                        }}
                                    </p>
                                    <HasError :form="form" field="banner" />
                                </div>
                            </div>

                            <!-- Shop setup -->
                            <h4 class="mt-5 mb-4 text-center">Store Address</h4>
                            <p class="mb-4 darkgrey">
                                Please make sure you add the most recent address
                                from where you will be operating the business
                                because this will effect your store visibility
                                to certain customers
                            </p>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label
                                        class="col-form-label"
                                        for="shop_address"
                                        >Address
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <textarea
                                        id="shop_address"
                                        class="form-control"
                                        name="shop_address"
                                        rows="3"
                                        cols="50"
                                        v-model="form.shop_address"
                                    >
                                    </textarea>
                                    <HasError
                                        :form="form"
                                        field="shop_address"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="shop_country"
                                        >Country
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="shop_country"
                                        id="shop_country"
                                        v-model="form.shop_country"
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
                                        field="shop_country"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="shop_province"
                                        >Province
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="shop_province"
                                        v-model="form.shop_province"
                                        name="shop_province"
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
                                        field="shop_province"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="shop_zipcode"
                                        >Zip Code
                                    </label>
                                    <input
                                        id="shop_zipcode"
                                        v-model="form.shop_zipcode"
                                        type="text"
                                        name="shop_zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Zip code"
                                    />
                                    <HasError
                                        :form="form"
                                        field="shop_zipcode"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="shop_district"
                                        >District
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="shop_district"
                                        v-model="form.shop_district"
                                        name="shop_district"
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
                                        field="shop_district"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="shop_city"
                                        >City
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="shop_city"
                                        v-model="form.shop_city"
                                        name="shop_city"
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
                                    <HasError :form="form" field="shop_city" />
                                </div>
                                <div class="col-md-4" v-show="areas[0] != null">
                                    <label
                                        class="col-form-label"
                                        for="shop_area"
                                        >Area
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        id="shop_area"
                                        v-model="form.shop_area"
                                        name="shop_area"
                                        @change.prevent="loadAreas()"
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
                                    <HasError :form="form" field="shop_area" />
                                </div>
                            </div>

                            <!-- Billing -->
                            <h4 class="mt-5 mb-4 text-center">
                                Billing Address
                            </h4>
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

                            <h4 class="mt-5 mb-4 text-center">
                                Earnings Deposit Account Information
                            </h4>
                            <p class="mb-4 darkgrey">
                                Please make sure the details you provide is
                                accurate and updated. All payments will be made
                                weekly into this account and lavisco.lk will not
                                deposit into any other accounts not stated below
                            </p>

                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label
                                        class="col-form-label"
                                        for="deposit_account"
                                        >Account no.
                                        <strong class="text-danger"> * </strong>
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
                                        <strong class="text-danger"> * </strong>
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
                                        <strong class="text-danger"> * </strong>
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
                                        <strong class="text-danger"> * </strong>
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
                                        <strong class="text-danger"> * </strong>
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

                        <div class="d-flex justify-content-center my-5">
                            <button type="submit" class="btn-full">
                                Setup Shop
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
        url: "",
        billingMode: false,
        //location data
        countries: [],
        provinces: [],
        districts: [],
        cities: [],
        areas: [],
        form: new Form({
            id: "",
            //shop
            shop_name: "",
            banner: "",
            about: "",
            shop_country: "",
            shop_province: "",
            shop_district: "",
            shop_city: "",
            shop_area: "",
            shop_address: "",
            shop_zipcode: "",
            //seller profile
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
                this.url = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
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
                .post("/api/seller/user/shop_setup")
                .then(() => {
                    window.location.replace("/login");
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

        loadAreas() {
            axios
                .get("/api/locations/areas/" + this.form.city)
                .then(({ data }) => (this.areas = data))
                .catch((error) => console.log(error));
        },
    },

    mounted() {},
};
</script>
