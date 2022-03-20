<template>
    <div class="container login">
        <h1 class="mb-4">Your Cart</h1>
        <h5 v-show="!products[0]">
            Add
            <router-link to="/products">
                <u>Products</u>
            </router-link>
        </h5>
        <div class="col-12" v-show="products[0]">
            <div v-for="shop in shopProducts" class="mb-5">
                <h3 class="text-left">{{ shop[0].shop }}</h3>
                <p class="text-left mb-3">
                    {{ shop.length }} Items in your Cart
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered cart-table">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col" class="cart-qty">Quantity</th>
                                <th scope="col" class="cart-total">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in shop">
                                <th scope="row" class="cart-title">
                                    {{ product.title }}
                                    <div class="card-secondary-text">
                                        Category: {{ product.category }}
                                    </div>
                                </th>
                                <td class="cart-qty-body">
                                    <div class="mb-3">
                                        <button
                                            href=""
                                            class="
                                                mr-md-3 mr-1
                                                cart-qty-control
                                            "
                                            @click.prevent="
                                                decreaseProductQuantity(product)
                                            "
                                        >
                                            -
                                        </button>
                                        {{ product.quantity }}
                                        <button
                                            href=""
                                            class="
                                                ml-md-3 ml-1
                                                cart-qty-control
                                            "
                                            @click.prevent="
                                                addProductToCart(product)
                                            "
                                        >
                                            +
                                        </button>
                                    </div>

                                    <a
                                        class="cart-remove-btn"
                                        title="Remove from cart"
                                        @click.prevent="
                                            removeProductFromCart(product)
                                        "
                                    >
                                        Remove
                                    </a>
                                </td>
                                <td class="cart-price">
                                    Rs. {{ product.price * product.quantity }}
                                </td>
                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <th class="text-center align-middle">Total:</th>
                                <td class="cart-price">
                                    Rs. {{ cartTotal(shop) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>*Shipping calculations and discounts on next step</p>
                <div class="text-right my-2">
                    <button
                        class="checkout-btn"
                        @click.prevent="saveShopCartTotal(shop)"
                    >
                        Continue to Checkout
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
        decreaseProductQuantity(product) {
            this.$store.dispatch("decreaseProductQuantity", product);
        },
        addProductToCart(product) {
            this.$store.dispatch("addProductToCart", product);
        },
        saveShopCartTotal(shop) {
            this.$store.dispatch("saveShopCartTotal", this.cartTotal(shop));
            this.$store.dispatch("addProductToCurrentCart", shop);
            this.$router.push("/shipping");
        },

        cartTotal(shop) {
            let sum = 0;
            shop.map((cartItem) => {
                sum += cartItem.price * cartItem.quantity;
            });

            return sum.toFixed(2);
        },
    },

    mounted() {},
};
</script>
