<template>
    <div class="container login">
        <h1 class="mb-4">{{ products.length }} Items in your Cart</h1>
        <h5 v-show="!products[0]">
            Add
            <router-link to="/lavisco/products">
                <u>Products</u>
            </router-link>
        </h5>
        <div class="col-12" v-show="products[0]">
            <table class="table table-bordered cart-table">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col" class="cart-qty">Quantity</th>
                        <th scope="col" class="cart-total">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products">
                        <th scope="row" class="cart-title">
                            {{ product.title }}
                        </th>
                        <td class="cart-qty-body">
                            <button
                                href=""
                                class="mr-3 cart-qty-control"
                                @click.prevent="
                                    decreaseProductQuantity(product)
                                "
                            >
                                -
                            </button>
                            {{ product.quantity }}
                            <button
                                href=""
                                class="ml-3 cart-qty-control"
                                @click.prevent="addProductToCart(product)"
                            >
                                +
                            </button>
                            <br />
                            <a
                                class="cart-remove-btn pt-3"
                                title="Remove from cart"
                                @click.prevent="removeProductFromCart(product)"
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
                        <td class="cart-price">Rs. {{ total }}</td>
                    </tr>
                </tbody>
            </table>
            <p>*Shipping calculations and discounts on next step</p>
            <div class="text-right my-4">
                <router-link to="/lavisco/shipping">
                    <button class="checkout-btn">Checkout</button>
                </router-link>
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
    },

    mounted() {
        console.log("cart mounted.");
    },
};
</script>
