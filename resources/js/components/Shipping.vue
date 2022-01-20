<template>
    <div class="container-fluid login">
        <h1 class="pb-4">Shipping Address</h1>
        <form class="col-md-8">
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="First Name"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="Last Name"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="Company"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="Address Line 1"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="City"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="State"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="Postal Code"
                    />
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="Country"
                    />
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="checkout-btn">
                    Continue to Payment
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    computed: {
        products() {
            return this.$store.getters.cartProducts;
        },
        total() {
            return this.$store.getters.cartTotal;
        },
    },

    methods: {
        removeProductFromCart(product) {
            this.$store.dispatch("removeProductFromCart", product);
        },
        decreaseProductQuantity(product) {
            this.$store.dispatch("decreaseProductQuantity", product);
        },
        addProductToCart(product) {
            this.$store.dispatch("addProductToCart", product);
        },
    },

    mounted() {
        console.log("cart mounted.");
    },
};
</script>
