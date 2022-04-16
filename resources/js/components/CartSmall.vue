<template>
    <div class="dropdown show nav-link">
        <a
            href="#"
            role="button"
            id="dropdownCartLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <div class="cart-notif" v-show="cartProductQuantity > 0">
                {{ cartProductQuantity }}
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
                role="img"
                width="34"
                height="34"
                preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 24 24"
            >
                <path
                    fill="#333"
                    d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"
                />
                <circle cx="10.5" cy="19.5" r="1.5" fill="#333" />
                <circle cx="17.5" cy="19.5" r="1.5" fill="#333" />
            </svg>
        </a>

        <div
            class="dropdown-menu dropdown-menu-right"
            style="border-radius: 8px"
            aria-labelledby="dropdownCartLink"
        >
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
                            <div class="d-flex flex-row">
                                <img
                                    class="banner-container-xs mr-2"
                                    :src="
                                        product.image_path
                                            ? product.image_path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                />
                                <div>
                                    <div class="menu-cart-item-title">
                                        {{ product.title }}
                                    </div>
                                    <div>x {{ product.quantity }}</div>
                                </div>
                            </div>
                            <div class="menu-cart-item-price">
                                Lkr {{ product.price * product.quantity }}
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
                    <h5 class="p-0 my-3">
                        Total LKR<span class="font-weight-bold ml-2">
                            {{ total }}</span
                        >
                    </h5>
                    <router-link to="/cart">
                        <button
                            class="btn-sm btn-full btn-sm-cart purple mt-auto"
                        >
                            Open Cart Page
                        </button>
                    </router-link>
                </div>

                <div v-show="products[0] == null" class="text-center">
                    <p>No items in cart</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({}),

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
        cartProductQuantity() {
            return this.$store.getters.cartProductQuantity;
        },
    },

    methods: {
        removeProductFromCart(product) {
            this.$store.dispatch("removeProductFromCart", product);
        },
    },

    mounted() {},
};
</script>
