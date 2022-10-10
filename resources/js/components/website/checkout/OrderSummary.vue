<template>
    <div class="price-card mb-5">
        <h4 class="mb-2 text-center header">
            Your Order {{ currency.symbol }}
            {{ (total * currency.exchange_rate).toFixed(2) }}
        </h4>
        <h4 class="row-content">
            <span class="darkgrey">Subtotal</span>
            {{ currency.symbol }}
            {{ (subtotal * currency.exchange_rate).toFixed(2) }}
        </h4>

        <h4 class="row-content">
            <span class="darkgrey">Discount</span>
            {{ currency.symbol }}
            {{ (form.discount_price * currency.exchange_rate).toFixed(2) }}
        </h4>
        <h4 class="row-content">
            <span class="darkgrey">Shipping</span>
            {{ currency.symbol }}
            {{ (shipping_price * currency.exchange_rate).toFixed(2) }}
        </h4>
        <hr />
        <h4 class="row-content">
            <span class="darkgrey">Total</span>
            {{ currency.symbol }}
            {{ (total * currency.exchange_rate).toFixed(2) }}
        </h4>
        <p class="text-sm row-content">
            By continuing, you acknowledge that you have read and agree to
            Lavisco’s Terms of Use & Privacy Policy
        </p>
    </div>
</template>
<script>
export default {
    data: () => ({
        form: {
            giftwrap_price: 0.0,
            discount_price: 0.0,
        },
    }),

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        subtotal() {
            return this.$store.getters.shopCartTotal;
        },
        total() {
            let total = this.$store.getters.shopCartTotal;
            let shipping_price = this.$store.getters.currentShippingPrice;
            return (parseFloat(total) + parseFloat(shipping_price)).toFixed(2);
        },
        shipping_price() {
            return this.$store.getters.currentShippingPrice;
        },
    },

    methods: {},

    mounted() {},
};
</script>
