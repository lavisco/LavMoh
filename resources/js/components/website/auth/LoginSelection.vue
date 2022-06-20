<template>
    <!-- Body -->
    <div class="container-fluid login">
        <div class="card bg-light-grey px-4 pb-4">
            <h1 class="pb-2">Sign in as Seller</h1>
            <router-link to="/merchant/login">
                <button type="button" class="btn-full">Seller Sign In</button>
            </router-link>
        </div>
        <h2 class="my-3">or</h2>
        <div class="card bg-light-grey px-4 pb-4">
            <h1 class="pb-2">Sign in as Shopper</h1>
            <router-link to="/login">
                <button type="button" class="btn-full bg-pink">Shopper Sign In</button>
            </router-link>
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
