<template>
    <div class="input-form-compact">
        <!-- Contact Info -->
        <div class="cart-items-card">
            <h4 class="text-left header">Your Contact Details</h4>
            <div class="row-content">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="first_name"
                            >First Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            name="first_name"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_first_name }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="last_name"
                            >Last Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            name="last_name"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_last_name }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
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
                        <span class="error-msg">
                            <strong>{{ error_msg_email }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
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
                        <span class="error-msg">
                            <strong>{{ error_msg_phone }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Address -->
        <div class="cart-items-card mt-5">
            <h4 class="text-left header">Your Address</h4>

            <div class="row-content">
                <p class="note">This is the billing address.</p>

                <div class="form-group">
                    <label class="col-form-label" for="billing_address_line_one"
                        >Billing Address Line 1
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="billing_address_line_one"
                        v-model="form.billing_address_line_one"
                        type="text"
                        name="billing_address_line_one"
                        class="form-control"
                    />
                    <span class="error-msg">
                        <strong>{{ error_msg_billing_address_line_one }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="billing_address_line_two"
                        >Billing Address Line 2
                    </label>
                    <input
                        id="billing_address_line_two"
                        v-model="form.billing_address_line_two"
                        type="text"
                        name="billing_address_line_two"
                        class="form-control"
                    />
                    <span class="error-msg">
                        <strong>{{ error_msg_billing_address_line_two }}</strong>
                    </span>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="billing_state"
                            >Billing Province/ State
                        </label>
                        <input
                            id="billing_state"
                            v-model="form.billing_state"
                            type="text"
                            name="billing_state"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_billing_state }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="billing_district"
                            >Billing District
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="billing_district"
                            v-model="form.billing_district"
                            type="text"
                            name="billing_district"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_billing_district }}</strong>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="billing_city"
                            >Billing City
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="billing_city"
                            v-model="form.billing_city"
                            type="text"
                            name="billing_city"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_billing_city }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="billing_zipcode"
                            >Billing Zip Code
                        </label>
                        <input
                            id="billing_zipcode"
                            v-model="form.billing_zipcode"
                            type="text"
                            name="billing_zipcode"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_billing_zipcode }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Self delivery -->
        <div class="cart-items-card mt-5">
            <h4 class="text-left header">Are you the recipient?</h4>

            <div class="row-content">
                <div class="form-group">
                    <label class="col-form-label" for="self_delivery"
                        >Billing and Shipping information will be the same.
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
                        <label class="custom-control-label" for="self_delivery1"
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
                        <label class="custom-control-label" for="self_delivery2"
                            >No
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipient Contact info -->
        <div class="cart-items-card mt-5" v-show="self_delivery === false">
            <h4 class="text-left header">Recipient's Contact Details</h4>

            <div class="row-content">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="recipient_first_name"
                            >First Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="recipient_first_name"
                            v-model="form.recipient_first_name"
                            type="text"
                            name="recipient_first_name"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_recipient_first_name }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="recipient_last_name"
                            >Last Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="recipient_last_name"
                            v-model="form.recipient_last_name"
                            type="text"
                            name="recipient_last_name"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_recipient_last_name }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="recipient_email"
                            >Email
                        </label>
                        <input
                            id="recipient_email"
                            v-model="form.recipient_email"
                            type="email"
                            name="recipient_email"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_recipient_email }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="recipient_phone"
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
                        <span class="error-msg">
                            <strong>{{ error_msg_recipient_phone }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipient Address -->
        <div class="cart-items-card mt-5" v-show="self_delivery === false">
            <h4 class="text-left header">Recipient's Shipping Address</h4>

            <div class="row-content">
                <p class="note">
                    This is the recipients address, the product will be
                    delivered here.
                </p>

                <div class="form-group">
                    <label class="col-form-label" for="address_line_one"
                        >Address line 1
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="address_line_one"
                        v-model="form.address_line_one"
                        type="text"
                        name="address_line_one"
                        class="form-control"
                    />
                    <span class="error-msg">
                        <strong>{{ error_msg_address_line_one }}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="address_line_two"
                        >Address line 2
                    </label>
                    <input
                        id="address_line_two"
                        v-model="form.address_line_two"
                        type="text"
                        name="address_line_two"
                        class="form-control"
                    />
                    <span class="error-msg">
                        <strong>{{ error_msg_address_line_two }}</strong>
                    </span>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="state"
                            >Province/ State
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="state"
                            v-model="form.state"
                            type="text"
                            name="state"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_state }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="district"
                            >District
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="district"
                            v-model="form.district"
                            type="text"
                            name="district"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_district }}</strong>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
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
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_city }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="zipcode"
                            >Zip Code
                        </label>
                        <input
                            id="zipcode"
                            v-model="form.zipcode"
                            type="text"
                            name="zipcode"
                            class="form-control"
                        />
                        <span class="error-msg">
                            <strong>{{ error_msg_zipcode }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shipping Method -->
        <div class="cart-items-card my-5">
            <h4 class="text-left header">Delivery & Shipping Details</h4>
            <div class="row-content">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="delivery_date"
                            >Delivery Date
                            <strong class="text-danger"> * </strong>
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
                        <span class="error-msg">
                            <strong>{{ error_msg_delivery_date }}</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="shipping_id"
                            >Shipping Method
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select
                            class="
                                custom-select
                                form-control form-control-alternative
                            "
                            id="shipping_id"
                            v-model="form.shipping_id"
                            name="shipping_id"
                        >
                            <option value="" disabled selected hidden>
                                Select Shipping Method
                            </option>
                            <option
                                v-for="shipping in shippings"
                                :value="shipping.id"
                            >
                                {{ shipping.type }} -
                                {{ currency.code }}
                                {{
                                    (
                                        shipping.price * currency.exchange_rate
                                    ).toFixed(2)
                                }}
                            </option>
                        </select>
                        <span class="error-msg">
                            <strong>{{ error_msg_shipping_id }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            <input
                type="hidden"
                id="cartItems"
                name="cartItems"
                v-model="form.products"
            />
            <input
                type="hidden"
                id="exchange_rate"
                name="exchange_rate"
                v-model="form.exchange_rate"
            />
            <input
                type="hidden"
                id="currency_code"
                name="currency_code"
                v-model="form.currency_code"
            />
        </div>
    </div>
</template>
<script>
import Form from "vform";
import moment from "moment";

export default {
    props: [
        "error_msg_delivery_date",
        "error_msg_shipping_id",
        "error_msg_first_name",
        "error_msg_last_name",
        "error_msg_email",
        "error_msg_phone",
        "error_msg_address_line_one",
        "error_msg_address_line_two",
        "error_msg_zipcode",
        "error_msg_city",
        "error_msg_district",
        "error_msg_state",
        "error_msg_recipient_first_name",
        "error_msg_recipient_last_name",
        "error_msg_recipient_email",
        "error_msg_recipient_phone",
        "error_msg_billing_address_line_one",
        "error_msg_billing_address_line_two",
        "error_msg_billing_zipcode",
        "error_msg_billing_city",
        "error_msg_billing_district",
        "error_msg_billing_state",
    ],

    data: () => ({
        moment: moment,
        shippings: [],
        dateTo: "",
        dateFrom: "",
        self_delivery: false,

        form: new Form({
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
            address_line_one: "",
            address_line_two: "",
            zipcode: "",
            city: "",
            district: "",
            state: "",

            recipient_first_name: "",
            recipient_last_name: "",
            recipient_email: "",
            recipient_phone: "",

            billing_address_line_one: "",
            billing_address_line_two: "",
            billing_zipcode: "",
            billing_city: "",
            billing_district: "",
            billing_state: "",

            delivery_date: "",
            shipping: "",
            shipping_id: "",
            shipping_price: 0.0,
            exchange_rate: "",
            currency_code: "",
            products: [],
        }),
    }),

    watch: {
        self_delivery(after, before) {
            if (this.self_delivery === true) {
                this.form.recipient_first_name = this.form.first_name;
                this.form.recipient_last_name = this.form.last_name;
                this.form.recipient_email = this.form.email;
                this.form.recipient_phone = this.form.phone;
                this.form.address_line_one = this.form.billing_address_line_one;
                this.form.address_line_two = this.form.billing_address_line_two;
                this.form.zipcode = this.form.billing_zipcode;
                this.form.state = this.form.billing_state;
                this.form.district = this.form.billing_district;
                this.form.city = this.form.billing_city;
            }
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

    methods: {
        setDateRange() {
            let minTimeArray = [];

            this.$store.getters.currentCartProducts.map((cartItem) => {
                minTimeArray.push(cartItem.processing_time);
            });

            let minTime = Math.max(...minTimeArray);

            this.dateFrom = moment().add(minTime, "d").format("YYYY-MM-DD");
            this.dateTo = moment().add(30, "d").format("YYYY-MM-DD");
        },

        loadProducts() {
            let item = this.$store.getters.currentCartProducts;

            this.form.products = JSON.stringify(item);
            this.form.exchange_rate = this.currency.exchange_rate;
            this.form.currency_code = this.currency.code;
        },

        loadShippings() {
            axios
                .get(
                    "/api/orders/shippings/" +
                        this.$store.getters.currentCartProducts[0].shop_id
                )
                .then((response) => {
                    this.shippings = response.data.shippings;
                })
                .catch((error) => console.log(error));
        },

        setShipping() {
            this.form.shipping_id = JSON.stringify(this.form.shipping.id);
            this.form.shipping_price = this.form.shipping.price;
        },
    },

    mounted() {
        this.loadProducts();
        this.setDateRange();
        this.loadShippings();
    },
};
</script>
