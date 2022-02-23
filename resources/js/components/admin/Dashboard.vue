<template>
    <div>
        <dashboard-cards></dashboard-cards>
        <div class="container-fluid mt--7 mb-5">
            <div class="row">
                <div class="col-xl-9 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6
                                        class="
                                            text-uppercase text-light
                                            ls-1
                                            mb-1
                                        "
                                    >
                                        Overview
                                    </h6>
                                    <h2 class="text-white mb-0">
                                        Latest Products
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="
                                        table
                                        align-items-center
                                        table-dark table-flush
                                    "
                                >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Code</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr v-for="product in latestProducts">
                                            <th scope="row">
                                                {{ product.id }}
                                            </th>
                                            <td>
                                                {{ product.title }}
                                            </td>
                                            <td>
                                                {{ product.base_price }}
                                            </td>
                                            <td>
                                                {{ product.user.name }}
                                            </td>
                                            <td>
                                                {{ product.quantity }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-9 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6
                                        class="
                                            text-uppercase
                                            ls-1
                                            mb-1
                                        "
                                    >
                                        Activation required
                                    </h6>
                                    <h2 class="mb-0">
                                        Inactive Stores
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">User</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr v-for="shop in inactiveShops">
                                        <th scope="row">
                                            {{ shop.name }}
                                        </th>
                                        <td>
                                            {{ shop.province }},
                                            {{ shop.district }},
                                            {{ shop.city }},
                                            {{ shop.address }}
                                        </td>
                                        <td>
                                            <span
                                                v-if="shop.status == 1"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-success
                                                "
                                            >
                                                Active
                                            </span>
                                            <span
                                                v-else-if="shop.status == 0"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-warning
                                                "
                                            >
                                                Inactive
                                            </span>
                                        </td>
                                        <td>
                                            {{ shop.user.name }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        latestProducts: "",
        inactiveShops: "",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/admin/dashboard")
                .then(({ data }) => {
                    this.latestProducts = data.latestProducts;
                    this.inactiveShops = data.inactiveShops;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
