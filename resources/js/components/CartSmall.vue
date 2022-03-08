<template>
    <div class="menu-cart">
        <div>
            <h5>Your cart</h5>
        </div>
        <div v-for="shop in shopProducts">
            <div class="menu-cart-shop-title">
                {{ shop[0].shop }}
            </div>
            <div v-for="product in shop">
                <div class="menu-cart-item">
                    <div>
                        <div class="menu-cart-item-title">
                            {{ product.title }}
                        </div>
                        <div>{{ product.quantity }}</div>
                    </div>
                    <div class="menu-cart-item-price">
                        Rs. {{ product.price * product.quantity }}
                    </div>
                </div>
                <a
                    class="menu-cart-remove-btn"
                    title="Remove from cart"
                    @click.prevent="removeProductFromCart(product)"
                >
                    remove
                </a>
                <hr class="my-0" />
            </div>
        </div>


        <div v-show="products[0] != null" class="text-center">
            <p>Total</p>
            <h5 class="pt-0 font-weight-bold mb-3">Rs. {{ total }}</h5>
            <button class="btn-sm btn-full btn-sm-cart green mt-auto mb-2">
                Checkout
            </button>
            <router-link to="/cart">
                <button class="btn-sm btn-full btn-sm-cart purple mt-auto">
                    Open Cart Page
                </button>
            </router-link>
        </div>

        <div v-show="products[0] == null" class="text-center">
            <p>No items in cart</p>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        grouped: "",
    }),
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
    },

    mounted() {
        console.log("Component mounted.");
    },
};
</script>
