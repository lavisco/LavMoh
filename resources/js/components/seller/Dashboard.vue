<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-5 mb-5">
            <div class="col">
                <div class="row d-flex justify-content-center gap">
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Products</h4>
                        <p class="mb-2">All the listed products</p>
                        <h2>{{ products }}</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">New Order</h4>
                        <p class="mb-2">Orders placed this week</p>
                        <h2>{{ orders }}</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Revenue</h4>
                        <p class="mb-2">Total amount earned this month</p>
                        <h2>{{ revenue }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        revenue: "",
        orders: "",
        products: "",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/seller/dashboard")
                .then(({ data }) => {
                    //this.revenue = data.revenue;
                    this.orders = data.orders;
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
