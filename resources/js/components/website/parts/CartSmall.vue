<template>
    <div class="dropdown show cart-icon">
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
                width="32"
                height="32"
                preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 1024 1024"
                title="cart"
            >
                <path
                    fill="#4e4e4e"
                    d="M832 312H696v-16c0-101.6-82.4-184-184-184s-184 82.4-184 184v16H192c-17.7 0-32 14.3-32 32v536c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V344c0-17.7-14.3-32-32-32zm-432-16c0-61.9 50.1-112 112-112s112 50.1 112 112v16H400v-16zm392 544H232V384h96v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h224v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h96v456z"
                />
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
                        class="checkout-btn btn-full mt-auto"
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
        products_detail: [],
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
                    this.products_detail = data;
                    this.$store.dispatch("refreshPrice", this.products_detail);
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.reloadPrice();
    },
};
</script>
