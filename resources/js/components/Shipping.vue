<template>
    <div class="container-fluid login shipping">
        <h1>Enter your Shipping Details</h1>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="createOrder()">
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
                        />
                        <HasError :form="form" field="phone" />
                    </div>
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
                            required
                        />
                        <HasError :form="form" field="address" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-form-label" for="province"
                                >Province
                                <strong class="text-danger"> * </strong>
                            </label>
                            <input
                                id="province"
                                v-model="form.province"
                                type="text"
                                name="province"
                                class="form-control"
                            />
                            <HasError :form="form" field="province" />
                        </div>
                        <div class="col-md-6">
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
                            <HasError :form="form" field="district" />
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
                            />
                            <HasError :form="form" field="city" />
                        </div>
                        <div class="col-md-6">
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
                            <HasError :form="form" field="zipcode" />
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
                    <h4 class="mb-5 text-center">Shipping Method</h4>
                    <div class="price-card mb-5">
                        <p>
                            Subtotal <span>{{ total }}</span>
                        </p>
                        <hr class="mt-0 mb-4" />
                        <p>Discount <span>0.00</span></p>
                        <p>Shipping <span>0.00</span></p>
                        <p>
                            Total <span>LKR {{ total }}</span>
                        </p>
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
        shippings: [],
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
            //order
            total: "",
            subtotal: "",
            giftwrap_price: 0.0,
            shipping_price: 0.0,
            discount_price: 0.0,
            shipping_id: "",
            discount_id: "",
            giftwrap_id: "",
            //product
            base_price: "",
            quantity: "",
            product_total: "",
            custom_text: "",
            custom_image: "",
            has_variations: "",
            product_id: "",
            //product variation
            price: "",
            variation_option_id: "",
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
        createOrder() {
            this.form
                .post("/orders")
                .then(() => {
                    //this.$store.dispatch("emptyCurrentCart");
                    this.$router.push("/order_complete");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadProducts();
    },
};
</script>
