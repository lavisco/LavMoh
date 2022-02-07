<template>
    <div class="container-fluid login shipping">
        <h1>Shipping Details</h1>
        <h5>Provide shipping address to complete purchase!</h5>

        <div class="card">
            <!-- Form start -->
            <form class="input-form">
                <div class="input-form-compact">
                    <!-- Address -->
                    <h4 class="mt-3 mb-4 text-center">Shipping Address</h4>
                    <div class="form-group">
                        <label class="col-form-label" for="name"
                            >Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            name="name"
                            class="form-control"
                            required
                            placeholder="Name"
                        />
                        <HasError :form="form" field="name" />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email"
                            >Email
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            name="email"
                            class="form-control"
                            required
                            placeholder="Email"
                        />
                        <HasError :form="form" field="email" />
                    </div>
                    <div class="form-group">
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
                            required
                            placeholder="Phone"
                        />
                        <HasError :form="form" field="phone" />
                    </div>
                    <div class="form-group">
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
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label" for="apt_no"
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
                            <label class="col-form-label" for="zipcode"
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
                            <HasError :form="form" field="zipcode" />
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label" for="state"
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
                                <strong class="text-danger"> * </strong>
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
                            <label class="col-form-label" for="country"
                                >Country
                                <strong class="text-danger"> * </strong>
                            </label>
                            <input
                                id="country"
                                v-model="form.country"
                                type="text"
                                name="country"
                                class="form-control"
                                placeholder="Country"
                            />
                            <HasError :form="form" field="country" />
                        </div>
                    </div>

                    <!-- shipping method -->
                    <h4 class="mt-5 mb-4 text-center">Shipping Method</h4>
                    <div class="form-group">
                        <label class="col-form-label" for="method"
                            >Method
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select
                            class="custom-select form-control"
                            name="method"
                            id="method"
                            v-model="form.method"
                        >
                            <option value="" disabled selected hidden>
                                Select Method
                            </option>
                            <option
                                v-for="method in methods"
                                :value="method.id"
                            >
                                {{ method.name }}
                            </option>
                        </select>
                        <HasError :form="form" field="method" />
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center my-5">
                    <div class="price-card mb-5">
                        <p>
                            Subtotal <span>{{ total }}</span>
                        </p>
                        <hr class="mt-0 mb-4" />
                        <p>Discount <span>0.00</span></p>
                        <p>Shipping <span>0.00</span></p>
                        <p>Total <span>LKR {{ total }}</span></p>
                    </div>

                    <button type="submit" class="checkout-btn">
                        Continue to Payment
                    </button>
                </div>
            </form>
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
        methods: [],
        form: new Form({
            id: "",
            name: "",
            email: "",
            phone: "",
            address: "",
            apt_no: "",
            zipcode: "",
            city: "",
            state: "",
            country: "",
            method: "",
        }),
    }),

    computed: {
        products() {
            return this.$store.getters.cartProducts;
        },
        total() {
            return this.$store.getters.shopCartTotal;
        },
    },

    methods: {},

    mounted() {},
};
</script>
