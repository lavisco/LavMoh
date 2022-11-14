<template>
    <div class="container login">
        <div class="progress-bar mb-5 mb-md-5">
            <div class="progress-line">
                <div class="now"></div>
                <div class=""></div>
                <div class=""></div>
                <div class=""></div>
            </div>
            <div class="d-flex align-items-center progress-content">
                <div class="part activated">
                    <div class="check-sign">1</div>
                    Choose Cart
                </div>
                <div class="part">
                    <div class="check-sign">2</div>
                    Shipping
                </div>
                <div class="part">
                    <div class="check-sign">3</div>
                    Payment
                </div>
                <div class="part">
                    <div class="check-sign">4</div>
                    Order Placed
                </div>
            </div>
        </div>
        <div class="col-12 no-padding-sm">
            <div
                class="
                    d-flex
                    flex-row
                    align-items-center
                    justify-content-between
                    mb-4
                "
            >
                <h1 class="text-left mb-0">Your Cart</h1>

                <router-link class="view-more-link" to="/products">
                    Keep Shopping
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        role="img"
                        width="24"
                        height="24"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24"
                        class="hide-content-sm-inline"
                    >
                        <path
                            fill="#666"
                            d="M12 11V8l4 4l-4 4v-3H8v-2h4zm0-9c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8s-8 3.58-8 8s3.58 8 8 8z"
                        />
                    </svg>
                </router-link>
            </div>

            <h5 class="text-left" v-show="!products[0]">
                Your cart is empty. Add
                <router-link to="/products">
                    <u>Products</u>
                </router-link>
            </h5>
        </div>

        <div class="col-12 no-padding-sm" v-show="products[0]">
            <div v-for="shop in shopProducts" class="mb-5">
                <div class="cart-items-card">
                    <h4
                        class="
                            header
                            text-left
                            d-flex
                            flex-row
                            align-items-center
                            mb-0
                        "
                    >
                        <img
                            class="cart-shop-banner mr-2"
                            :src="
                                shop[0].shop_image
                                    ? shop[0].shop_image
                                    : '/images/lavisco/img-bg.jpg'
                            "
                        />
                        {{ shop[0].shop }} ({{ shop.length }} items)
                    </h4>
                    <div class="row-content">
                        <div v-for="product in shop">
                            <div
                                class="
                                    d-flex
                                    flex-row
                                    justify-content-between
                                    my-4
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
                                                <router-link
                                                    :to="{
                                                        name: 'products/product',
                                                        params: {
                                                            productId:
                                                                product.id,
                                                            slug: product.slug,
                                                            location:
                                                                locationActive,
                                                        },
                                                    }"
                                                >
                                                    {{ product.title }}
                                                </router-link>
                                            </div>
                                            <div
                                                class="mb-2 cart-price hide-lg"
                                            >
                                                {{ currency.symbol }}
                                                {{
                                                    (
                                                        product.price *
                                                        product.quantity *
                                                        currency.exchange_rate
                                                    ).toFixed(2)
                                                }}
                                            </div>
                                            <div class="cart-body-text">
                                                <div
                                                    v-if="
                                                        product.category ==
                                                        'Gift Boxes'
                                                    "
                                                >
                                                    <div
                                                        v-for="giftItems in product.variations"
                                                    >
                                                        {{ giftItems.quantity }}
                                                        x
                                                        {{ giftItems.name }}
                                                    </div>
                                                </div>
                                                <div v-else>
                                                    <div
                                                        v-for="variation in product.variations"
                                                    >
                                                        {{ variation.parent }} :
                                                        {{ variation.name }}
                                                    </div>
                                                </div>

                                                <div
                                                    v-show="product.custom_text"
                                                >
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
                                            <div class="product-card-counter">
                                                <div
                                                    class="counter-minus"
                                                    @click.prevent="
                                                        decreaseProductQuantity(
                                                            product
                                                        )
                                                    "
                                                >
                                                    -
                                                </div>
                                                <div class="counter-num">
                                                    {{ product.quantity }}
                                                </div>
                                                <div
                                                    class="counter-plus"
                                                    @click.prevent="
                                                        increaseProductQuantity(
                                                            product
                                                        )
                                                    "
                                                >
                                                    +
                                                </div>
                                            </div>
                                            <a
                                                class="cart-remove-btn ml-4"
                                                title="Remove from cart"
                                                @click.prevent="
                                                    removeProductFromCart(
                                                        product
                                                    )
                                                "
                                            >
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="ml-4 cart-price hide">
                                    {{ currency.symbol }}
                                    {{
                                        (
                                            product.price *
                                            product.quantity *
                                            currency.exchange_rate
                                        ).toFixed(2)
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="bottom text-right mb-0">
                        <span class="darkgrey"> Subtotal </span>
                        {{ currency.symbol }}
                        {{
                            (cartTotal(shop) * currency.exchange_rate).toFixed(
                                2
                            )
                        }}
                    </h4>
                </div>

                <p class="mt-4">
                    *Shipping calculations and discounts on next step
                </p>
                <div class="text-right my-2">
                    <button
                        class="checkout-btn"
                        @click.prevent="saveShopCartTotal(shop)"
                        name="Proceed to Checkout"
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
                        <h4 class="modal-title" id="addRecordLabel">
                            Login or Continue as Guest
                        </h4>
                        <a
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 34 34"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="34"
                                    height="34"
                                    rx="17"
                                    fill="#333333"
                                />
                                <g clip-path="url(#clip0_355_858)">
                                    <path
                                        d="M21.5803 10.9735L23.0266 12.4199C23.2275 12.6208 23.328 12.8618 23.328 13.1431C23.328 13.4243 23.2275 13.6653 23.0266 13.8662L19.8929 17L23.0266 20.1338C23.2275 20.3347 23.328 20.5757 23.328 20.8569C23.328 21.1382 23.2275 21.3792 23.0266 21.5801L21.5803 23.0265C21.3794 23.2274 21.1383 23.3278 20.8571 23.3278C20.5759 23.3278 20.3348 23.2274 20.1339 23.0265L17.0002 19.8927L13.8664 23.0265C13.6655 23.2274 13.4244 23.3278 13.1432 23.3278C12.862 23.3278 12.6209 23.2274 12.42 23.0265L10.9737 21.5801C10.7728 21.3792 10.6724 21.1382 10.6724 20.8569C10.6724 20.5757 10.7728 20.3347 10.9737 20.1338L14.1074 17L10.9737 13.8662C10.7728 13.6653 10.6724 13.4243 10.6724 13.1431C10.6724 12.8618 10.7728 12.6208 10.9737 12.4199L12.42 10.9735C12.6209 10.7726 12.862 10.6722 13.1432 10.6722C13.4244 10.6722 13.6655 10.7726 13.8664 10.9735L17.0002 14.1073L20.1339 10.9735C20.3348 10.7726 20.5759 10.6722 20.8571 10.6722C21.1383 10.6722 21.3794 10.7726 21.5803 10.9735Z"
                                        fill="#f7f7f7"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_355_858">
                                        <rect
                                            width="15"
                                            height="15"
                                            fill="#333333"
                                            transform="translate(9.5 9.5)"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>

                    <!-- Form start -->
                    <div class="modal-body modal-view py-4">
                        <button
                            class="checkout-btn btn-full"
                            data-dismiss="modal"
                            @click.prevent="guestLogin()"
                            name="Continue as Guest"
                        >
                            Continue as Guest
                        </button>
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
                                <HasError :form="form" field="email" />
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
                                <HasError :form="form" field="password" />
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button
                                    type="submit"
                                    class="checkout-btn btn-full btn-secondary"
                                    name="Login"
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
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        login() {
            this.form
                .post("/buyer-login")
                .then(() => {
                    $("#addRecord").modal("hide");
                    window.location.replace("/payment");
                })
                .catch((error) => console.log(error));
        },

        guestLogin() {
            this.form
                .post("/guest-logout")
                .then(() => {
                    $("#addRecord").modal("hide");
                    window.location.replace("/payment");
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
            this.$store.dispatch("saveShippingPrice", 0.0);
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
