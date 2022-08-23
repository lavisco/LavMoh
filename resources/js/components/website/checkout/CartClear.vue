<template>
    <div></div>
</template>
<script>
export default {
    data: () => ({}),

    methods: {
        clearCurrentCart() {
            this.$store.dispatch("clearOrderedProductFromCart");
        },
    },

    mounted() {
        this.clearCurrentCart();
    },
};
</script>
