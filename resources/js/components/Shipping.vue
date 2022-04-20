<template>
    <div class="container-fluid shipping">
        <div class="progress-bar mb-3 mb-md-5">
            <div class="progress-line">
                <div class="done"></div>
                <div class="now"></div>
                <div class=""></div>
                <div class=""></div>
            </div>
            <div class="d-flex align-items-center">
                <div class="part completed">
                    <div class="check-sign mr-2"></div>
                    Choose Cart
                </div>
                <div class="part activated">
                    <div class="check-sign mr-2"></div>
                    Shipping
                </div>
                <div class="part">
                    <div class="check-sign mr-2"></div>
                    Payment
                </div>
                <div class="part">
                    <div class="check-sign mr-2"></div>
                    Order Complete
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <h1 class="text-left mb-4">Enter your Shipping Details</h1>

                <div class="card">
                    <!-- Form start -->
                    <form class="input-form" @submit.prevent="createOrder()">
                        <div class="input-form-compact">
                            <!-- Contact Info -->
                            <div class="cart-items-card">
                                <h3 class="text-left">Your Contact Details</h3>
                                <hr />
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
                                    />
                                    <HasError :form="form" field="phone" />
                                </div>
                            </div>

                            <!-- Billing Address -->
                            <div class="cart-items-card mt-5">
                                <h3 class="text-left">Your Address</h3>
                                <p class="mb-0 note">
                                    This is the billing address.
                                </p>
                                <hr />

                                <div class="form-group">
                                    <label
                                        class="col-form-label"
                                        for="billing_address"
                                        >Billing Street Address
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="billing_address"
                                        v-model="form.billing_address"
                                        type="text"
                                        name="billing_address"
                                        class="form-control"
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_address"
                                    />
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_province"
                                            >Billing Province
                                        </label>
                                        <input
                                            id="billing_province"
                                            v-model="form.billing_province"
                                            type="text"
                                            name="billing_province"
                                            class="form-control"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_province"
                                        />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_district"
                                            >Billing District
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="billing_district"
                                            v-model="form.billing_district"
                                            type="text"
                                            name="billing_district"
                                            class="form-control"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_district"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_city"
                                            >Billing City
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
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_city"
                                        />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_zipcode"
                                            >Billing Zip Code
                                        </label>
                                        <input
                                            id="billing_zipcode"
                                            v-model="form.billing_zipcode"
                                            type="text"
                                            name="billing_zipcode"
                                            class="form-control"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_zipcode"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Self delivery -->
                            <div class="cart-items-card mt-5">
                                <h3 class="text-left">
                                    Are you the recipient?
                                </h3>
                                <hr />

                                <div class="form-group">
                                    <label
                                        class="col-form-label"
                                        for="self_delivery"
                                        >Billing and Shipping details will be
                                        the same
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            id="self_delivery1"
                                            name="self_delivery"
                                            class="custom-control-input"
                                            v-model="self_delivery"
                                            :value="true"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="self_delivery1"
                                            >Yes
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            id="self_delivery2"
                                            name="self_delivery"
                                            class="custom-control-input"
                                            v-model="self_delivery"
                                            :value="false"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="self_delivery2"
                                            >No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Recipient Contact info -->
                            <div
                                class="cart-items-card mt-5"
                                v-show="self_delivery === false"
                            >
                                <h3 class="text-left">
                                    Recipient's Contact Details
                                </h3>
                                <hr />

                                <div class="form-group">
                                    <label
                                        class="col-form-label"
                                        for="recipient_name"
                                        >Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="recipient_name"
                                        v-model="form.recipient_name"
                                        type="text"
                                        name="recipient_name"
                                        class="form-control"
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_name"
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="col-form-label"
                                        for="recipient_email"
                                        >Email
                                    </label>
                                    <input
                                        id="recipient_email"
                                        v-model="form.recipient_email"
                                        type="email"
                                        name="recipient_email"
                                        class="form-control"
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_email"
                                    />
                                </div>
                                <div class="form-group">
                                    <label
                                        class="col-form-label"
                                        for="recipient_phone"
                                        >Phone
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="recipient_phone"
                                        v-model="form.recipient_phone"
                                        type="text"
                                        name="recipient_phone"
                                        class="form-control"
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_phone"
                                    />
                                </div>
                            </div>

                            <!-- Recipient Address -->
                            <div
                                class="cart-items-card mt-5"
                                v-show="self_delivery === false"
                            >
                                <h3 class="text-left">
                                    Recipient's Shipping Address
                                </h3>
                                <p class="mb-0 note">
                                    This is the recipients address, the product
                                    will be delivered here.
                                </p>
                                <hr />

                                <div class="form-group">
                                    <label class="col-form-label" for="address"
                                        >Street Address
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="address"
                                        v-model="form.address"
                                        type="text"
                                        name="address"
                                        class="form-control"
                                    />
                                    <HasError :form="form" field="address" />
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="province"
                                            >Province
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="province"
                                            v-model="form.province"
                                            type="text"
                                            name="province"
                                            class="form-control"
                                        />
                                        <HasError
                                            :form="form"
                                            field="province"
                                        />
                                    </div>
                                    <div class="form-group col-md-6">
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
                                            class="form-control"
                                        />
                                        <HasError
                                            :form="form"
                                            field="district"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
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
                                        />
                                        <HasError :form="form" field="city" />
                                    </div>
                                    <div class="form-group col-md-6">
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
                                        />
                                        <HasError
                                            :form="form"
                                            field="zipcode"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Method -->
                            <div class="cart-items-card mt-5">
                                <h3 class="text-left">
                                    Delivery & Shipping Details
                                </h3>
                                <hr />

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="delivery_date"
                                            >Delivery Date
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <input
                                            id="delivery_date"
                                            v-model="form.delivery_date"
                                            type="date"
                                            name="delivery_date"
                                            class="form-control"
                                            :max="dateTo"
                                            :min="dateFrom"
                                        />
                                        <HasError
                                            :form="form"
                                            field="delivery_date"
                                        />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="shipping_id"
                                            >Shipping Method
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>
                                        <select
                                            class="
                                                custom-select
                                                form-control
                                                form-control-alternative
                                            "
                                            id="shipping_id"
                                            v-model="form.shipping"
                                            name="shipping_id"
                                            @change.prevent="setShipping()"
                                        >
                                            <option
                                                value=""
                                                disabled
                                                selected
                                                hidden
                                            >
                                                Select Shipping Method
                                            </option>
                                            <option
                                                v-for="shipping in shippings"
                                                :value="shipping"
                                            >
                                                {{ shipping.type }} - LKR
                                                {{ shipping.price }}
                                            </option>
                                        </select>
                                        <HasError
                                            :form="form"
                                            field="shipping_id"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- shipping method -->
                        <div
                            class="
                                d-flex
                                flex-column
                                justify-content-center
                                align-items-center
                                my-5
                            "
                        >
                            <div class="price-card mb-5 hide-content">
                                <h4 class="mb-2">Total Payment</h4>
                                <p>
                                    Subtotal
                                    <span class="bold"
                                        >LKR {{ form.subtotal }}</span
                                    >
                                </p>
                                <hr />
                                <p>
                                    Discount
                                    <span class="bold"
                                        >LKR {{ form.discount_price }}</span
                                    >
                                </p>
                                <p>
                                    Shipping
                                    <span class="bold"
                                        >LKR {{ form.shipping_price }}</span
                                    >
                                </p>
                                <p>
                                    Total
                                    <span class="bold"
                                        >LKR {{ form.total }}</span
                                    >
                                </p>
                            </div>
                            <button
                                type="submit"
                                class="checkout-btn"
                                :disabled="submitButtonDisabled"
                            >
                                {{ submitButtonText }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 hide-content-sm">
                <div class="price-card mb-5">
                    <h4 class="mb-2">Total Payment</h4>
                    <p>
                        Subtotal
                        <span class="bold">LKR {{ form.subtotal }}</span>
                    </p>
                    <hr />
                    <p>
                        Discount
                        <span class="bold">LKR {{ form.discount_price }}</span>
                    </p>
                    <p>
                        Shipping
                        <span class="bold">LKR {{ form.shipping_price }}</span>
                    </p>
                    <p>
                        Total <span class="bold">LKR {{ form.total }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        submitButtonText: "Proceed to Payment",
        submitButtonDisabled: false,
        moment: moment,
        shippings: [],
        dateTo: "",
        dateFrom: "",
        self_delivery: false,

        form: new Form({
            id: "",
            name: "",
            email: "",
            phone: "",
            address: "",
            zipcode: "",
            province: "",
            district: "",
            city: "",

            recipient_name: "",
            recipient_email: "",
            recipient_phone: "",
            billing_address: "",
            billing_zipcode: "",
            billing_province: "",
            billing_district: "",
            billing_city: "",
            delivery_date: "",
            total: "",
            subtotal: "",
            giftwrap_price: 0.0,
            shipping_price: 0.0,
            discount_price: 0.0,
            shipping_id: "",
            discount_id: "",
            giftwrap_id: "",
            shipping: "",
            //product
            products: [],
        }),
    }),

    computed: {
        products() {
            return this.$store.getters.currentCartProducts;
        },
        total() {
            return this.$store.getters.shopCartTotal;
        },
    },

    methods: {
        setShipping() {
            this.form.shipping_id = this.form.shipping.id;
            this.form.shipping_price = this.form.shipping.price;
        },

        setDateRange() {
            this.dateFrom = moment().format("YYYY-MM-DD");
            this.dateTo = moment().add(30, "d").format("YYYY-MM-DD");
        },

        loadProducts() {
            this.form.products = this.$store.getters.currentCartProducts;
            this.form.subtotal = this.$store.getters.shopCartTotal;
            this.form.total = (
                this.form.subtotal +
                this.form.giftwrap_price +
                this.form.shipping_price -
                this.form.discount_price
            ).toFixed(2);
        },

        loadShippings() {
            axios
                .get("/api/orders/shippings/" + this.form.products[0].shop_id)
                .then((response) => {
                    this.shippings = response.data.shippings;
                })
                .catch((error) => console.log(error));
        },

        createOrder() {
            if (this.self_delivery === true) {
                this.form.recipient_name = this.form.name;
                this.form.recipient_email = this.form.email;
                this.form.recipient_phone = this.form.phone;
                this.form.address = this.form.billing_address;
                this.form.zipcode = this.form.billing_zipcode;
                this.form.province = this.form.billing_province;
                this.form.district = this.form.billing_district;
                this.form.city = this.form.billing_city;
            }

            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.form
                .post("/api/orders")
                .then(() => {
                    //this.$store.dispatch("emptyCurrentCart");
                    this.submitButtonText = "Saved";
                    this.submitButtonDisabled = false;
                    this.$router.push("/order_complete");
                })
                .catch((error) => {
                    this.submitButtonText = "Proceed to Payment";
                    this.submitButtonDisabled = false;
                    console.log(error);
                });
        },
    },

    mounted() {
        this.setDateRange();
        this.loadProducts();
        this.loadShippings();
    },
};
</script>
