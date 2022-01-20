<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-5 mb-5">
            <div class="col">
                <div class="row d-flex justify-content-center gap">
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Products</h4>
                        <p class="mb-2">All the listed products</p>
                        <h2>7</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">New Order</h4>
                        <p class="mb-2">Orders placed this week</p>
                        <h2>1</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Revenue</h4>
                        <p class="mb-2">Total amount earned this month</p>
                        <h2>100,000</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        users: "",
        sellers: "",
        buyers: "",
        products: "",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/admin/dashboard")
                .then(({ data }) => {
                    this.users = data.users;
                    this.sellers = data.sellers;
                    this.buyers = data.buyers;
                    this.products = data.products;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
