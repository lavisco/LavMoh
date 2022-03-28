<template>
    <div class="container login">
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
                                            LKR.
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

                            <div class="ml-3 cart-price hide">
                                LKR. {{ product.price * product.quantity }}
                            </div>
                        </div>
                        <hr />
                    </div>
                    <div class="cart-price text-right">
                        <span class="text-lighter">Subtotal LKR. </span
                        >{{ cartTotal(shop) }}
                    </div>
                </div>

                <p class="mt-4">*Shipping calculations and discounts on next step</p>
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
    </div>
</template>

<script>
export default {
    computed: {
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
            this.$router.push("/shipping");
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
