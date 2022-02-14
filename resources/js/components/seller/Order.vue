<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-3 mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card">
                        <div
                            class="
                                d-flex
                                justify-content-center
                                align-items-center
                            "
                        ></div>
                    </div>
                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive dashboard-table">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Products</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Shipping Details</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts">
                                        <td>#</td>
                                        <td>{{ cart.created_at }}</td>
                                        <td>
                                            <div
                                                v-for="product in cart.products"
                                            >
                                                {{ product.title }}
                                                <a
                                                    class="
                                                        btn btn-sm btn-xs
                                                        ml-2
                                                        mb-2
                                                    "
                                                    href="#"
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-expand-arrows-alt
                                                        "
                                                    ></i>
                                                </a>
                                            </div>
                                            <div>
                                                YOP1G3LL39
                                                <a
                                                    class="
                                                        btn btn-sm btn-xs
                                                        ml-2
                                                    "
                                                    href="#"
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-expand-arrows-alt
                                                        "
                                                    ></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            {{ cart.receipt.address }},
                                            {{ cart.receipt.country }}
                                        </td>
                                        <td>
                                            LKR {{ cart.total }}
                                            <br />
                                            LKR {{ cart.subtotal }} +<br />
                                            LKR {{ cart.tax }} +<br />
                                            LKR
                                            {{ cart.shipping_price }} +<br />
                                            LKR
                                            {{ cart.giftwrap_price }} -<br />
                                            LKR {{ cart.discount_price }}
                                        </td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                "
                                            >
                                                <option>Status</option>
                                                <option>Shipped</option>
                                                <option>Delivered</option>
                                            </select>
                                        </td>
                                        <td></td>
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
</template>

<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        carts: [],
        searchText: null,
        loading: true,
    }),

    watch: {
        searchText(after, before) {
            this.loadCarts();
        },
    },

    methods: {
        loadCarts() {
            axios
                .get("/api/seller/carts", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.carts = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        setCurrentState(product, event) {
            this.form.product_state_id = event.target.value;
            this.form
                .put("/api/admin/products/updateState/" + product)
                .then(() => {
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadCarts();
        Fire.$on("reloadRecords", () => {
            this.loadCarts();
        });
    },
};
</script>
