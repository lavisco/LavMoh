<template>
    <div>
        <!-- Body -->
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Form start -->
                        <form
                            class="input-form"
                            @submit.prevent="updateSellerprofile()"
                        >
                            <div class="input-form-compact">
                                <h4 class="mb-4">Account Information</h4>

                                <div class="form-group row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="apt_no"
                                            >Apt No.
                                        </label>
                                        <input
                                            id="apt_no"
                                            v-model="form.apt_no"
                                            type="text"
                                            name="apt_no"
                                            class="form-control"
                                            placeholder="Apt no."
                                        />
                                        <HasError :form="form" field="apt_no" />
                                    </div>
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
                                            class="form-control"
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
                                            for="state"
                                            >State
                                        </label>
                                        <input
                                            id="state"
                                            v-model="form.state"
                                            type="text"
                                            name="state"
                                            class="form-control"
                                            placeholder="State"
                                        />
                                        <HasError :form="form" field="state" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="city"
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
                                            class="form-control"
                                            placeholder="City"
                                        />
                                        <HasError :form="form" field="city" />
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
                                            class="form-control"
                                            placeholder="Country"
                                        />
                                        <HasError
                                            :form="form"
                                            field="country"
                                        />
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
                                                >Address
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
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="billing_apt_no"
                                                >Apt No.
                                            </label>
                                            <input
                                                id="billing_apt_no"
                                                v-model="form.billing_apt_no"
                                                type="text"
                                                name="billing_apt_no"
                                                class="form-control"
                                                placeholder="Apt no."
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_apt_no"
                                            />
                                        </div>
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
                                                class="form-control"
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
                                                for="billing_state"
                                                >State
                                            </label>
                                            <input
                                                id="billing_state"
                                                v-model="form.billing_state"
                                                type="text"
                                                name="billing_state"
                                                class="form-control"
                                                placeholder="State"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_state"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
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
                                                class="form-control"
                                                placeholder="City"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_city"
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
                                                class="form-control"
                                                placeholder="Country"
                                            />
                                            <HasError
                                                :form="form"
                                                field="billing_country"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing end -->

                                <!-- Account -->

                                <h4 class="mt-5 mb-4">Deposit Account</h4>

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
                                    mt-4
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
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            phone: "",
            country: "",
            address: "",
            apt_no: "",
            zipcode: "",
            city: "",
            state: "",
            billing_country: "",
            billing_address: "",
            billing_apt_no: "",
            billing_zipcode: "",
            billing_city: "",
            billing_state: "",
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
                })
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
