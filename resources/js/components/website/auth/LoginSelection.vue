<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Select Sign in</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light-grey px-4 pb-4">
                    <h2 class="pb-2">Sign in as Seller</h2>
                    <router-link to="/merchant/login">
                        <button type="button" class="btn-full">
                            Seller
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light-grey px-4 pb-4">
                    <h2 class="pb-2">Sign in as Shopper</h2>
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
