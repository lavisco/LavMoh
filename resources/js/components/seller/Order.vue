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
                    <div class="card pb-3 pb-md-1">
                        <div class="row align-items-center">
                            <div
                                class="
                                    col-lg-4 col-8
                                    input-form
                                    input-group
                                    input-group-alternative
                                    search-input
                                "
                            >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Search"
                                    type="text"
                                    v-model="searchText"
                                />
                            </div>
                        </div>
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
                                    <tr v-for="order in orders">
                                        <td>{{ order.code }}</td>
                                        <td>{{ order.created_at }}</td>
                                        <td>
                                            <div
                                                v-for="product in order.products"
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
                                            {{ order.receipt.address }},
                                            {{ order.receipt.country }}
                                        </td>
                                        <td>
                                            LKR {{ order.total }}
                                            <br />
                                            LKR {{ order.subtotal }} +<br />
                                            LKR {{ order.tax }} +<br />
                                            LKR
                                            {{ order.shipping_price }} +<br />
                                            LKR
                                            {{ order.giftwrap_price }} -<br />
                                            LKR {{ order.discount_price }}
                                        </td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                "
                                                name="status"
                                                id="status"
                                                v-model="order.status"
                                                @change.prevent="
                                                    setCurrentState(
                                                        order.id,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option>Confirmed</option>
                                                <option>Paid</option>
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
                        <h4 class="text-center mt-4" v-show="orders.length == 0">
                            No orders have been placed yet
                        </h4>
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
        orders: [],
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            status: "",
        }),
    }),

    watch: {
        // searchText(after, before) {
        //     this.loadOrders();
        // },
    },

    methods: {
        loadOrders() {
            axios
                .get("/api/seller/orders", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.orders = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        setCurrentState(order, event) {
            this.form.status = event.target.value;
            this.form
                .put("/api/seller/orders/" + order)
                .then(() => {
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadOrders();
        Fire.$on("reloadRecords", () => {
            this.loadOrders();
        });
    },
};
</script>
