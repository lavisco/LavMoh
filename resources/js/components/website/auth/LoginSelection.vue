<template>
    <!-- Body -->
    <div class="container my-5">
        <h5>Welcome back</h5>
        <h1 class="mb-4">Sign in as</h1>
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="card px-4 pt-3 pb-4 bg-dull-blue">
                    <h3 class="text-center mb-0">To manage your store</h3>
                    <p class="text-center mb-4">
                        Don't have a store yet?
                        <router-link to="/seller_register" class="pink">
                            Become a Seller
                        </router-link>
                    </p>
                    <router-link to="/merchant/login">
                        <button type="button" class="btn-full">Seller</button>
                    </router-link>
                </div>
            </div>
            <div class="col-md-2 py-3">
                <h3 class="text-center mb-0">Or</h3>
            </div>
            <div class="col-md-5">
                <div class="card px-4 pt-3 pb-4 bg-dull-pink">
                    <h3 class="text-center mb-0">To manage your purchases</h3>
                    <p class="text-center mb-4">
                        Don't have an account?
                        <router-link to="/register" class="pink">
                            Become a Shopper
                        </router-link>
                    </p>
                    <router-link to="/login">
                        <button type="button" class="btn-full bg-pink">
                            Shopper
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({}),

    methods: {},

    mounted() {},
};
</script>
