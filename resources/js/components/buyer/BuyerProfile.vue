<template>
    <div>
        <!-- Body -->
        <div class="container mb-5">
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
                            @submit.prevent="updateBuyerprofile()"
                        >
                            <div class="input-form-compact">
                                <!-- Details -->
                                <div class="card dashboard-info-card">
                                    <h4 class="mb-3">Account Information</h4>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="first_name"
                                                >First Name
                                                <strong class="text-danger">
                                                    *</strong
                                                >
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
                                                    *</strong
                                                >
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
                                            <HasError
                                                :form="form"
                                                field="last_name"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Details -->
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Contact Information</h4>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="phone"
                                                >Phone
                                                <strong class="text-danger">
                                                    *</strong
                                                >
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
                                            <HasError
                                                :form="form"
                                                field="phone"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="email"
                                                >Email
                                                <strong class="text-danger">
                                                    *
                                                </strong>
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
                                                placeholder="email@gmail.com"
                                            />
                                            <HasError
                                                :form="form"
                                                field="email"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Your Delivery Address</h4>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="address_line_one"
                                                >Address line 1
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="address_line_one"
                                                v-model="form.address_line_one"
                                                type="text"
                                                name="address_line_one"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Address line one"
                                            />
                                            <HasError
                                                :form="form"
                                                field="address_line_one"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="address_line_two"
                                                >Address line 2
                                            </label>
                                            <input
                                                id="address_line_two"
                                                v-model="form.address_line_two"
                                                type="text"
                                                name="address_line_two"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Address line two"
                                            />
                                            <HasError
                                                :form="form"
                                                field="address_line_two"
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
                                                for="city"
                                                >City
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="city"
                                                v-model="form.city"
                                                type="text"
                                                name="city"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="City"
                                            />
                                            <HasError
                                                :form="form"
                                                field="city"
                                            />
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="district"
                                                >District
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="district"
                                                v-model="form.district"
                                                type="text"
                                                name="district"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="district"
                                            />
                                            <HasError
                                                :form="form"
                                                field="district"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="state"
                                                >State
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="state"
                                                v-model="form.state"
                                                type="text"
                                                name="state"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="State"
                                            />
                                            <HasError
                                                :form="form"
                                                field="state"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="country"
                                                >Country
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="country"
                                                v-model="form.country"
                                                type="text"
                                                name="country"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Country"
                                            />
                                            <HasError
                                                :form="form"
                                                field="country"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing -->
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Billing Address</h4>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="billing_address_line_one"
                                                >Address line 1
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="billing_address_line_one"
                                                v-model="
                                                    form.billing_address_line_one
                                                "
                                                type="text"
                                                name="billing_address_line_one"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Address line one"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_address_line_one"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="billing_address_line_two"
                                                >Address line 2
                                            </label>
                                            <input
                                                id="billing_address_line_two"
                                                v-model="
                                                    form.billing_address_line_two
                                                "
                                                type="text"
                                                name="billing_address_line_two"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Address line two"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_address_line_two"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="billing_zipcode"
                                                >Zip Code
                                            </label>
                                            <input
                                                id="billing_zipcode"
                                                v-model="form.billing_zipcode"
                                                type="text"
                                                name="billing_zipcode"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Zip code"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_zipcode"
                                            />
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="billing_city"
                                                >City
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="billing_city"
                                                v-model="form.billing_city"
                                                type="text"
                                                name="billing_city"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="City"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_city"
                                            />
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="billing_district"
                                                >District
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="billing_district"
                                                v-model="form.billing_district"
                                                type="text"
                                                name="billing_district"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="district"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_district"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="billing_state"
                                                >State
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="billing_state"
                                                v-model="form.billing_state"
                                                type="text"
                                                name="billing_state"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="State"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_state"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="billing_country"
                                                >Country
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="billing_country"
                                                v-model="form.billing_country"
                                                type="text"
                                                name="billing_country"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Country"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_country"
                                            />
                                        </div>
                                    </div>
                                </div>
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
        buyerprofile: {},
        loading: true,
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            phone: "",
            email: "",

            address_line_one: "",
            address_line_two: "",
            zipcode: "",
            city: "",
            district: "",
            state: "",
            country: "",

            billing_address_line_one: "",
            billing_address_line_two: "",
            billing_zipcode: "",
            billing_city: "",
            billing_district: "",
            billing_state: "",
            billing_country: "",
        }),
    }),

    methods: {
        loadBuyerprofile() {
            axios
                .get("/api/buyer/buyerprofile")
                .then(({ data }) => {
                    this.buyerprofile = data;
                    this.form.fill(this.buyerprofile);
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        updateBuyerprofile() {
            this.form
                .put("/api/buyer/buyerprofile/" + this.form.id)
                .then(() => {
                    this.loadBuyerprofile();
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadBuyerprofile();
    },
};
</script>
