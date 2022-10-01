<template>
    <div>
        <!-- Body -->
        <div class="container-fluid">
            <div class="col no-padding-sm">
                <div class="row">
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm h-100">
                            <h4 class="mb-2">
                                {{
                                    buyerprofile.first_name +
                                    " " +
                                    buyerprofile.last_name
                                }}
                            </h4>
                            <p class="mb-2">{{ buyerprofile.phone }}</p>
                            <p class="mb-2">{{ buyerprofile.address }}</p>
                            <p class="mb-2">{{ buyerprofile.country }}</p>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm h-100">
                            <h4 class="mb-0">Your Orders</h4>
                            <h6 class="mb-3">This month</h6>
                            <div
                                class="
                                    d-flex
                                    flex-row
                                    align-items-end
                                    justify-content-between
                                "
                            >
                                <h2>{{ orderCount }}</h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col my-4 no-padding-sm">
                <div class="row">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm">
                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    mb-3
                                    align-items-center
                                "
                            >
                                <div>
                                    <h4 class="mb-0">Latest Orders</h4>
                                    <router-link
                                        class="dashboard-link-sm"
                                        to="/buyer/orders"
                                    >
                                        View
                                    </router-link>
                                </div>
                            </div>
                            <!-- Table start -->
                            <div
                                class="
                                    table-responsive
                                    dashboard-table
                                    vertical-scroll
                                "
                            >
                                <table
                                    class="table align-items-center table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col">Code</th>
                                            <th scope="col">Dispatch</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="order in orders">
                                            <td>
                                                {{ order.code }}
                                            </td>
                                            <td>
                                                {{
                                                    moment(
                                                        order.delivery_date
                                                    ).format("DD-MM-YYYY")
                                                }}
                                            </td>
                                            <td>{{ order.total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        buyerprofile: {},
        orders: "",
        orderCount: "",
    }),

    methods: {
        loadBuyerprofile() {
            axios
                .get("/api/buyer/dashboard")
                .then(({ data }) => {
                    this.buyerprofile = data.buyerprofile;
                    this.orders = data.orders.data;
                    this.orderCount = data.orderCount;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadBuyerprofile();
    },
};
</script>
