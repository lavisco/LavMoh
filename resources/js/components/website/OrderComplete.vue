<template>
    <div class="container login">
        <div class="progress-bar mb-3 mb-md-5">
            <div class="progress-line">
                <div class="done"></div>
                <div class="done"></div>
                <div class="done"></div>
                <div class="now"></div>
            </div>
            <div class="d-flex align-items-center">
                <div class="part completed">
                    <div class="check-sign mr-2"></div>
                    Choose Cart
                </div>
                <div class="part completed">
                    <div class="check-sign mr-2"></div>
                    Shipping
                </div>
                <div class="part completed">
                    <div class="check-sign mr-2"></div>
                    Payment
                </div>
                <div class="part activated">
                    <div class="check-sign mr-2"></div>
                    Order Complete
                </div>
            </div>
        </div>
        <h1>Thank You For Your Order</h1>
        <h5>
            Browse more
            <router-link to="/products">
                <u>products</u>
            </router-link>
        </h5>

        <div class="card cart-order-complete d-flex flex-comlumn">
            <div
                class="
                    cart-order-complete-item
                    d-flex
                    flex-row
                    justify-content-between
                "
                v-for="product in shopProducts"
            >
                <div class="col-md-9">
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
                            {{ product.title }}<br />{{ product.quantity }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="price text-right">
                        {{ currency.code }}
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
            <div
                class="
                    cart-order-complete-item cart-order-item-last
                    d-flex
                    flex-row
                    justify-content-between
                "
            >
                Total
                <div class="price">
                    {{ currency.code }}
                    {{ (total * currency.exchange_rate).toFixed(2) }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        shopProducts() {
            return this.$store.getters.currentCartProducts;
        },
        total() {
            return this.$store.getters.shopCartTotal;
        },
    },

    methods: {
        showOrder() {},
    },

    mounted() {
        this.showOrder();
    },
};
</script>
