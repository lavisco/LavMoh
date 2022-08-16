<template>
    <div class="price-card mb-5">
        <h4 class="mb-2">Total Payment</h4>
        <p>
            Subtotal
            <span class="bold">
                {{ currency.code }}
                {{ (form.subtotal * currency.exchange_rate).toFixed(2) }}
            </span>
        </p>
        <hr />
        <p>
            Discount
            <span class="bold">
                {{ currency.code }}
                {{ (form.discount_price * currency.exchange_rate).toFixed(2) }}
            </span>
        </p>
        <p>
            Shipping
            <span class="bold">
                {{ currency.code }}
                {{ (form.shipping_price * currency.exchange_rate).toFixed(2) }}
            </span>
        </p>
        <p>
            Total
            <span class="bold">
                {{ currency.code }}
                {{ (form.total * currency.exchange_rate).toFixed(2) }}
            </span>
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
