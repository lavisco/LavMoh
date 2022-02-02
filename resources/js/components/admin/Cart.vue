<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Buyer</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Products</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts">
                                        <th>{{ cart.id }}</th>
                                        <td>
                                            {{ cart.shop.name }}
                                            <br />
                                            {{
                                                cart.seller.seller_profile
                                                    .first_name
                                            }}
                                            {{
                                                cart.seller.seller_profile
                                                    .last_name
                                            }}
                                        </td>
                                        <th>{{ cart.buyer.name }}</th>
                                        <th>
                                            {{ cart.total }}
                                            <br />
                                            {{ cart.subtotal }} +<br />
                                            {{ cart.tax }} +<br />
                                            {{ cart.shipping_price }} +<br />
                                            {{ cart.giftwrap_price }} -<br />
                                            {{ cart.discount_price }}
                                        </th>
                                        <th>
                                            <p v-for="product in cart.products">
                                                {{ product.base_price }} x
                                                {{ product.quantity }}<br />
                                                {{ product.total }} <br />
                                                {{ product.custom_text }}
                                            </p>
                                        </th>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a
                                                    class="
                                                        btn btn-sm btn-icon-only
                                                        text-primary
                                                    "
                                                    href="#"
                                                    role="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-ellipsis-v
                                                        "
                                                    ></i>
                                                </a>
                                                <div
                                                    class="
                                                        dropdown-menu
                                                        dropdown-menu-right
                                                        dropdown-menu-arrow
                                                    "
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editModal(cart)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteCart(cart.id)
                                                        "
                                                    >
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table end -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-secondary">
                    <!-- Modal Header -->
                    <div class="modal-header bg-neutral">
                        <h4
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Cart
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Cart
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- Form start -->

                    <form
                        class="input-form"
                        @submit.prevent="editMode ? updateCart() : createCart()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="total"
                                    >Total
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="total"
                                        v-model="form.total"
                                        type="text"
                                        name="total"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="total" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button
                                v-show="editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-pen-nib mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                            <button
                                v-show="!editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>
                    </form>

                    <!-- Form end -->
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
        editMode: false,
        carts: [],
        searchText: null,
        form: new Form({
            id: "",
            total: "",
            subtotal: "",
            tax: "",
            giftwrap_price: "",
            shipping_price: "",
            discount_price: "",
            discount_code: "",
            shop_id: "",
            shipping_id: "",
            order_id: "",
            giftwrap_id: "",
            seller_id: "",
            buyer_id: "",
            shop: "",
            seller: "",
            buyer: "",
            products: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadCarts();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(cart) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(cart);
        },
        loadCarts() {
            axios
                .get("/api/admin/carts", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.carts = data.data))
                .catch((error) => console.log(error));
        },
        createCart() {
            this.form
                .post("/api/admin/carts")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteCart(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/carts/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateCart() {
            this.form
                .put("/api/admin/carts/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
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
