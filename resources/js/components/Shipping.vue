<template>
    <div class="container-fluid login shipping">
        <h1>Shipping Details</h1>
        <h5>Provide shipping address to complete purchase!</h5>

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
                                placeholder="Province"
                            />
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
                                class="form-control"
                                placeholder="Zip code"
                            />
                            <HasError :form="form" field="zipcode" />
                        </div>
                        <div class="col-md-4">
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
                                placeholder="District"
                            />
                            <HasError :form="form" field="district" />
                        </div>
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
                    </div>

                    <!-- shipping method -->
                    <h4 class="mt-5 mb-4 text-center">Shipping Method</h4>
                </div>

                <div
                    class="
                        d-flex
                        flex-column
                        justify-content-center
                        align-items-center
                        my-5
                    "
                >
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
        url: "",
        shippings: [],
        form: new Form({
            id: "",
            name: "Mohorima Islam",
            email: "islammohorima@gmail.com",
            phone: "96322369",
            address: "23 boulvard",
            zipcode: "",
            country: "Sri Lanka",
            province: "Central",
            district: "Colombo",
            city: "Colombo 6",
            //order
            total: "50.00",
            subtotal: "45.00",
            giftwrap_price: "5.00",
            shipping_price: "0.00",
            discount_price: "0.00",
            shop_id: "1",
            shipping_id: "1",
            discount_id: "1",
            giftwrap_id: "1",
            seller_id: "2",
            //product
            base_price: "22.50",
            quantity: "2",
            product_total: "45.00",
            custom_text: "",
            custom_image: "",
            has_variations: "0",
            product_id: "1",
            //product variation
            price: "",
            product_variation_id: "",
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
        createOrder() {
            this.form
                .post("/api/orders")
                .then(() => {
                    this.$router.push("/products");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {},
};
</script>
