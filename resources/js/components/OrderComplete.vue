<template>
    <div class="container login">
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
                <div class="
                    d-flex
                    flex-row
                ">
                    <img
                        class="banner-container-xs mr-2"
                        :src="
                            product.image_path
                                ? product.image_path
                                : '/images/lavisco/img-bg.jpg'
                        "
                    />
                    <div>{{ product.title }}<br />{{ product.quantity }}</div>
                </div>

                <div class="price">{{ product.price * product.quantity }}</div>
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
                <div class="price">{{ total }}</div>
            </div>
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

    methods: {
        showOrder(){

        }
    },

    mounted() {
        this.showOrder();
    },
};
</script>
