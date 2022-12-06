<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card">
                        <!-- Table start -->

                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Title</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="topProduct in topProducts">
                                        <th>{{ topProduct.order }}</th>
                                        <td>
                                            <img
                                                width="70px"
                                                height="70px"
                                                class="banner-container-xs"
                                                :src="
                                                    topProduct.product.product_image
                                                        ? topProduct.product.product_image
                                                              .path
                                                        : '/images/lavisco/img-bg.jpg'
                                                "
                                            />
                                        </td>
                                        <td>{{ topProduct.product.title }}</td>
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
                                                            editModal(
                                                                topProduct
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteTopProduct(
                                                                topProduct.id
                                                            )
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

                        <!-- Pagination Start -->

                        <pagination
                            v-if="pagination.last_page > 1"
                            :pagination="pagination"
                            :offset="5"
                            @paginate="loadTopProducts()"
                        ></pagination>

                        <!-- Pagination end -->
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
                            Update the Top Products
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Top Products
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
                        @submit.prevent="
                            editMode ? updateTopProduct() : createTopProduct()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="order"
                                    >Order number
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="order"
                                        v-model="form.order"
                                        type="number"
                                        name="order"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="order" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="product_id"
                                    >Product ID
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="product_id"
                                        v-model="form.product_id"
                                        type="text"
                                        name="product_id"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="product_id" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Search Product
                                </label>

                                <div class="col-md-9">
                                    <div
                                        class="
                                            input-group input-group-alternative
                                        "
                                    >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                ><i
                                                    class="ni ni-zoom-split-in"
                                                ></i
                                            ></span>
                                        </div>
                                        <input
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Search"
                                            type="text"
                                            v-model="searchProduct"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Products -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="">
                                    Select Product
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <div
                                        class="
                                            table-responsive
                                            form-table
                                            mt-md-2
                                        "
                                    >
                                        <table
                                            class="
                                                table
                                                align-items-center
                                                table-hover
                                            "
                                        >
                                            <thead>
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="tiny-col"
                                                    ></th>
                                                    <th scope="col">Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="product in products"
                                                    :key="product.id"
                                                >
                                                    <th scope="row">
                                                        <input
                                                            class="
                                                                shop_cities_checkbox
                                                            "
                                                            type="radio"
                                                            name="product_id"
                                                            v-model="
                                                                form.product_id
                                                            "
                                                            :value="product.id"
                                                        />
                                                    </th>
                                                    <td>
                                                        <img
                                                            width="70px"
                                                            height="70px"
                                                            class="
                                                                banner-container-xs
                                                            "
                                                            :src="
                                                                product.product_image
                                                                    ? product
                                                                          .product_image
                                                                          .path
                                                                    : '/images/lavisco/img-bg.jpg'
                                                            "
                                                        />
                                                    </td>
                                                    <td>
                                                        {{ product.title }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
import _ from "lodash";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        editMode: false,
        loading: true,
        topProducts: [],
        products: [],
        searchText: null,
        searchProduct: null,
        form: new Form({
            id: "",
            order: "",
            product_id: "",
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText(after, before) {
            this.loadTopProducts();
        },
        searchProduct: _.debounce(function (after, before) {
            this.loadProducts();
        }, 900),
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(topProduct) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(topProduct);
        },
        loadTopProducts() {
            axios
                .get(
                    "/api/admin/topProducts?page=" +
                        this.pagination.current_page,
                    {
                        params: { searchText: this.searchText },
                    }
                )
                .then(({ data }) => {
                    this.topProducts = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        loadProducts() {
            axios
                .get("/api/admin/topProducts/products")
                .then(({ data }) => (this.products = data))
                .catch((error) => console.log(error));
        },
        createTopProduct() {
            this.form
                .post("/api/admin/topProducts")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteTopProduct(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/topProducts/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateTopProduct() {
            this.form
                .put("/api/admin/topProducts/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadTopProducts();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadTopProducts();
        });
    },
};
</script>
