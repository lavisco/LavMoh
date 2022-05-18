<template>
    <div class="container login">
        <div class="progress-bar mb-3 mb-md-5">
            <div class="progress-line">
                <div class="now"></div>
                <div class=""></div>
                <div class=""></div>
                <div class=""></div>
            </div>
            <div class="d-flex align-items-center">
                <div class="part activated">
                    <div class="check-sign mr-2"></div>
                    Choose Cart
                </div>
                <div class="part">
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
        <div class="col-12">
            <div
                class="
                    d-flex
                    flex-md-row flex-column
                    align-items-center
                    justify-content-between
                    mb-4
                "
            >
                <h1 class="text-left">
                    {{ products.length }} items in your Cart
                </h1>

                <h5 class="black">
                    <router-link to="/products">Keep Shopping</router-link>
                </h5>
            </div>

            <h5 class="text-left" v-show="!products[0]">
                Your cart is empty. Add
                <router-link to="/products">
                    <u>Products</u>
                </router-link>
            </h5>
        </div>

        <div class="col-12" v-show="products[0]">
            <div v-for="shop in shopProducts" class="mb-5">
                <div class="cart-items-card">
                    <h3 class="text-left d-flex flex-row align-items-center">
                        <img
                            class="cart-shop-banner mr-2"
                            :src="
                                shop[0].shop_image
                                    ? shop[0].shop_image
                                    : '/images/lavisco/img-bg.jpg'
                            "
                        />
                        {{ shop[0].shop }}
                    </h3>
                    <hr />
                    <div v-for="product in shop">
                        <div
                            class="
                                d-flex
                                flex-row
                                justify-content-between
                                my-2
                                cart-table
                            "
                        >
                            <div class="d-flex flex-row gap">
                                <img
                                    class="banner-container"
                                    :src="
                                        product.image_path
                                            ? product.image_path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                />
                                <div class="d-flex flex-column gap">
                                    <div>
                                        <div class="cart-title mb-2">
                                            {{ product.title }}
                                        </div>
                                        <div class="mb-2 cart-price hide-lg">
                                            {{ currency }}
                                            {{
                                                product.price * product.quantity
                                            }}
                                        </div>
                                        <div class="cart-body-text">
                                            <div
                                                v-for="variation in product.variations"
                                            >
                                                {{ variation.parent }} :
                                                {{ variation.name }}
                                            </div>
                                            <div v-show="product.custom_text">
                                                Custom Text:
                                                {{ product.custom_text }}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="
                                            d-flex
                                            flex-row
                                            align-items-center
                                        "
                                    >
                                        <div class="cart-qty-body">
                                            <div>
                                                <button
                                                    href=""
                                                    class="
                                                        mr-2
                                                        cart-qty-control
                                                    "
                                                    @click.prevent="
                                                        decreaseProductQuantity(
                                                            product
                                                        )
                                                    "
                                                >
                                                    -
                                                </button>
                                                {{ product.quantity }}
                                                <button
                                                    href=""
                                                    class="
                                                        ml-2
                                                        cart-qty-control
                                                    "
                                                    @click.prevent="
                                                        increaseProductQuantity(
                                                            product
                                                        )
                                                    "
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <a
                                            class="cart-remove-btn ml-4"
                                            title="Remove from cart"
                                            @click.prevent="
                                                removeProductFromCart(product)
                                            "
                                        >
                                            Remove
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="ml-4 cart-price hide">
                                {{ currency }}
                                {{ product.price * product.quantity }}
                            </div>
                        </div>
                        <hr />
                    </div>
                    <div class="cart-price text-right">
                        <span class="text-lighter"
                            >Subtotal {{ currency }} </span
                        >{{ cartTotal(shop) }}
                    </div>
                </div>

                <p class="mt-4">
                    *Shipping calculations and discounts on next step
                </p>
                <div class="text-right my-2">
                    <button
                        class="checkout-btn"
                        @click.prevent="saveShopCartTotal(shop)"
                    >
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4
                            class="modal-title mb-0 text-center"
                            id="addRecordLabel"
                        >
                            Login or Continue as Guest
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- Form start -->
                    <div class="modal-body modal-view">
                        <div class="card">
                            <router-link to="/shipping">
                                <button
                                    class="checkout-btn btn-full btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Continue as Guest
                                </button>
                            </router-link>
                            <h4 class="my-3 text-center">OR</h4>
                            <form class="input-form" @submit.prevent="login()">
                                <div class="form-group">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        placeholder="Email"
                                        v-model="form.email"
                                    />
                                </div>

                                <div class="form-group">
                                    <div class="password-input">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            required
                                            placeholder="Password"
                                            v-model="form.password"
                                        />
                                        <i
                                            class="fas fa-eye"
                                            onclick="showPasswordFunction()"
                                        ></i>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <button
                                        type="submit"
                                        class="checkout-btn btn-full"
                                    >
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
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
        form: new Form({
            id: "",
            email: "",
            password: "",
        }),
    }),

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        products() {
            return this.$store.getters.cartProducts;
        },
        total() {
            return this.$store.getters.cartTotal;
        },
        shopProducts() {
            return this.$store.getters.cartProductsByShop;
        },
    },

    methods: {
        login() {
            this.form
                .post("/login")
                .then(() => {
                    $("#addRecord").modal("hide");
                    this.$router.push("/shipping");
                })
                .catch((error) => console.log(error));
        },

        removeProductFromCart(product) {
            this.$store.dispatch("removeProductFromCart", product);
        },

        increaseProductQuantity(product) {
            this.$store.dispatch("increaseProductQuantity", product);
        },

        decreaseProductQuantity(product) {
            this.$store.dispatch("decreaseProductQuantity", product);
        },

        saveShopCartTotal(shop) {
            this.$store.dispatch("saveShopCartTotal", this.cartTotal(shop));
            this.$store.dispatch("addProductToCurrentCart", shop);
            $("#addRecord").modal("show");
            //this.$router.push("/shipping");
        },

        refreshCurrentCart() {
            this.$store.dispatch("emptyCurrentCart");
        },

        cartTotal(shop) {
            let sum = 0;
            shop.map((cartItem) => {
                sum += cartItem.price * cartItem.quantity;
            });

            return sum.toFixed(2);
        },
    },

    mounted() {
        this.refreshCurrentCart();
    },
};
</script>
