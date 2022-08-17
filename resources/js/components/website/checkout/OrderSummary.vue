<template>
    <div class="price-card mb-5">
        <h4 class="mb-2 text-center header">
            Your Order {{ currency.symbol }}
            {{ (form.total * currency.exchange_rate).toFixed(2) }}
        </h4>
        <h4  class="row-content">
            <span class="darkgrey">Subtotal</span>
            {{ currency.symbol }}
            {{ (form.subtotal * currency.exchange_rate).toFixed(2) }}
        </h4>

        <h4  class="row-content">
            <span class="darkgrey">Discount</span>
            {{ currency.symbol }}
            {{ (form.discount_price * currency.exchange_rate).toFixed(2) }}
        </h4>
        <h4  class="row-content">
            <span class="darkgrey">Shipping</span>
            {{ currency.symbol }}
            {{ (form.shipping_price * currency.exchange_rate).toFixed(2) }}
        </h4>
        <hr />
        <h4  class="row-content">
            <span class="darkgrey">Total</span>
            {{ currency.symbol }}
            {{ (form.total * currency.exchange_rate).toFixed(2) }}
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
            total: "",
            subtotal: "",
            giftwrap_price: 0.0,
            shipping_price: 0.0,
            discount_price: 0.0,
        },
    }),

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        total() {
            return this.$store.getters.shopCartTotal;
        },
    },

    methods: {
        loadProducts() {
            this.form.subtotal = this.$store.getters.shopCartTotal;

            this.form.total = (
                this.form.subtotal +
                this.form.giftwrap_price +
                this.form.shipping_price -
                this.form.discount_price
            ).toFixed(2);
        },
    },

    mounted() {
        this.loadProducts();
    },
};
</script>
