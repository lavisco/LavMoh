<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-3 mb-5">
            <div class="row">
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
                                    <tr>
                                        <td>#82034</td>
                                        <td>2021-12-11 12:16:56</td>
                                        <td>
                                            <div>
                                                YOP1G3LL38
                                                <a
                                                    class="btn btn-sm btn-xs ml-2 mb-2"
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
                                                    class="btn btn-sm btn-xs ml-2"
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
                                        <td>
                                            20 <br />
                                            100
                                        </td>
                                        <td>
                                            Address: 683, Sudharshana Mawatha,
                                            Kandy Road
                                        </td>
                                        <td>LKR 000.00</td>
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
        products: [],
        productStates: [],
        searchText: null,
        form: new Form({
            id: "",
            sku: "",
            title: "",
            description: "",
            length: "",
            width: "",
            height: "",
            dimensions_unit: "",
            weight: "",
            weight_unit: "",
            base_price: "",
            production_time: "",
            cut_off_time: "",
            processing_time: "",
            has_custom_text: "",
            has_custom_image: "",
            has_variations: "",
            has_inventory: "",
            quantity: "",
            product_state_id: "",
            category_id: "",
            user_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    methods: {
        loadProducts() {
            axios
                .get("/api/seller/products", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.products = data.data))
                .catch((error) => console.log(error));
        },

        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data.data))
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

        deleteProduct(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/seller/products/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadProducts();
        this.loadProductStates();
        Fire.$on("reloadRecords", () => {
            this.loadProducts();
        });
    },
};
</script>
