<template>
    <div class="dropdown show">
        <a
            href="#"
            role="button"
            id="dropdownCartLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            class="nav-link nav-link-account"
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
                    fill="#4e4e4e"
                    d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"
                />
                <circle cx="10.5" cy="19.5" r="1.5" fill="#4e4e4e" />
                <circle cx="17.5" cy="19.5" r="1.5" fill="#4e4e4e" />
            </svg>
        </a>

        <div
            class="dropdown-menu dropdown-menu-right"
            style="border-radius: 8px"
            aria-labelledby="dropdownCartLink"
        >
            <div
                class="menu-cart"
                @click.prevent="preventDropdownClose($event)"
            >
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
                        Total {{ currency.symbol }}
                        <span class="font-weight-bold ml-2">
                            {{ (total * currency.exchange_rate).toFixed(2) }}
                        </span>
                    </h5>
                    <button
                        class="btn-sm btn-full btn-sm-cart purple mt-auto"
                        @click.prevent="goToCart()"
                    >
                        Go to Cart
                    </button>
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
    data: () => ({
        product_ids: [],
        variation_option_ids: [],
        product_prices: [],
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
        cartProductQuantity() {
            return this.$store.getters.cartProductQuantity;
        },
    },

    methods: {
        removeProductFromCart(product) {
            this.$store.dispatch("removeProductFromCart", product);
        },
        preventDropdownClose(e) {
            e.stopPropagation();
        },
        goToCart() {
            window.location.replace("/cart");
        },
        reloadPrice() {
            this.products.map((product) => {
                if (this.product_ids.indexOf(product.id) === -1) {
                    this.product_ids.push(product.id);
                }
                product.variations.map((variation_option) => {
                    if (
                        this.variation_option_ids.indexOf(
                            variation_option.id
                        ) === -1
                    ) {
                        this.variation_option_ids.push(variation_option.id);
                    }
                });
            });

            axios
                .get("/api/products/prices/" + JSON.stringify(this.product_ids))
                .then(({ data }) => {
                    this.product_prices = data;
                    this.$store.dispatch("refreshPrice", this.product_prices);
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.reloadPrice();
    },
};
</script>
