<template>
    <div class="dropdown show">
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
                fill="none"
                width="78"
                height="79"
                viewBox="0 0 78000 79000"
            >
                <g filter="url(#a)">
                    <rect
                        fill="#fff"
                        width="58000"
                        height="59000"
                        x="10000"
                        y="10000"
                        rx="12000"
                    />
                </g>
                <path
                    d="M24558 21520a2063 2063 0 10 0 4127h2517l630 2521c5 30 12 58 20 87l2802 11204-1843 1840c-2600 2600-760 7043 2918 7043h17716a2064 2064 0 00 0-4127H31602l2063-2063h13590a2063 2063 0 00 1844-1141l6189-12380a2064 2064 0 00-1845-2986h-22120l-640-2565a2063 2063 0 00-2000-1562h-4127zM51380 53502a3095 3095 0 11-6190 0 3095 3095 0 01 6190 0zm-19600 3095a3095 3095 0 10 0-6189 3095 3095 0 00 0 6190"
                    fill="#333"
                />
                <defs>
                    <filter
                        id="a"
                        width="78000"
                        height="79000"
                        x="0"
                        y="0"
                        color-interpolation-filters="sRGB"
                        filterUnits="userSpaceOnUse"
                    >
                        <feFlood
                            flood-opacity="0"
                            result="BackgroundImageFix"
                        />
                        <feColorMatrix
                            in="SourceAlpha"
                            result="hardAlpha"
                            type="matrix"
                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                        />
                        <feOffset />
                        <feGaussianBlur stdDeviation="5" />
                        <feColorMatrix
                            type="matrix"
                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"
                        />
                        <feBlend
                            in2="BackgroundImageFix"
                            mode="normal"
                            result="effect1_dropShadow_2202_1029"
                        />
                        <feBlend
                            in="SourceGraphic"
                            in2="effect1_dropShadow_2202_1029"
                            mode="normal"
                            result="shape"
                        />
                    </filter>
                </defs>
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
