<template>
    <!-- Shipping Method -->
    <div class="cart-items-card my-5">
        <h3 class="text-left">Delivery & Shipping Details</h3>
        <hr />

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
                    class="custom-select form-control form-control-alternative"
                    id="shipping_id"
                    v-model="form.shipping_id"
                    name="shipping_id"
                >
                    <option value="" disabled selected hidden>
                        Select Shipping Method
                    </option>
                    <option v-for="shipping in shippings" :value="shipping.id">
                        {{ shipping.type }} -
                        {{ currency.code }}
                        {{
                            (shipping.price * currency.exchange_rate).toFixed(2)
                        }}
                    </option>
                </select>
                <span class="error-msg">
                    <strong>{{ error_msg_shipping_id }}</strong>
                </span>
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
</template>
<script>
import Form from "vform";
import moment from "moment";

export default {
    props: ["error_msg_delivery_date", "error_msg_shipping_id"],

    data: () => ({
        moment: moment,
        shippings: [],
        dateTo: "",
        dateFrom: "",
        form: new Form({
            delivery_date: "",
            shipping: "",
            shipping_id: "",
            shipping_price: 0.0,
            exchange_rate: "",
            currency_code: "",
            products: [],
        }),
    }),

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
                .get("/api/orders/shippings/" + this.$store.getters.currentCartProducts[0].shop_id)
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
