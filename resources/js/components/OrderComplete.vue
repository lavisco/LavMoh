<template>
    <div class="container-fluid login shipping">
        <h1>Thank You For Your Order</h1>
        <h5>
            Browse more
            <router-link to="/products">
                <u>products</u>
            </router-link>
        </h5>

        <div class="card d-flex flex-comlumn">
            <div
                class="card d-flex flex-row justify-content-between"
                v-for="product in shopProducts"
            >
                <div>{{ product.title }}<br />{{ product.quantity }}</div>
                <div>{{ product.price * product.quantity }}</div>
            </div>
        </div>
        <div class="card d-flex flex-row justify-content-between">
            Total <span>{{ total }}</span>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        shopProducts() {
            return this.$store.getters.currentCartProducts;
        },
        total() {
            return this.$store.getters.shopCartTotal;
        },
    },

    methods: {},

    mounted() {},
};
</script>
