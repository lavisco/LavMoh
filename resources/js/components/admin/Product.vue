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
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th class="table-col-lg">Title</th>
                                        <th>Created at</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th class="table-col-sm">Shop</th>
                                        <th class="table-col-sm">State</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container"
                                                :src="
                                                    product.product_image
                                                        ? product.product_image
                                                              .path
                                                        : '/images/lavisco/img-bg.jpg'
                                                "
                                            />
                                        </td>
                                        <th>
                                            {{ product.id }}
                                        </th>
                                        <td class="table-col-lg">
                                            {{ product.title }}
                                            <p class="text-sm mt-2">
                                                {{ product.category.name }}
                                                <i
                                                    class="fas fa-angle-right"
                                                ></i>
                                                {{
                                                    product.sub_categories[0]
                                                        ? product
                                                              .sub_categories[0]
                                                              .name
                                                        : ""
                                                }}
                                            </p>
                                        </td>
                                        <td>
                                            {{
                                                moment(
                                                    product.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </td>
                                        <td>{{ product.quantity }}</td>
                                        <td>{{ product.base_price }}</td>
                                        <td>
                                            {{
                                                product.user.shop
                                                    ? product.user.shop.name
                                                    : "no shop"
                                            }}
                                        </td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                name="product_state_id"
                                                id="product_state_id"
                                                v-model="
                                                    product.product_state_id
                                                "
                                                @change.prevent="
                                                    setCurrentState(
                                                        product.id,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option
                                                    v-for="productState in productStates"
                                                    :value="productState.id"
                                                >
                                                    {{ productState.state }}
                                                </option>
                                            </select>
                                        </td>
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
                                                    <router-link
                                                        class="dropdown-item"
                                                        :to="{
                                                            name: 'admin/products/listing/edit',
                                                            params: {
                                                                productId:
                                                                    product.id,
                                                            },
                                                        }"
                                                        >Edit
                                                    </router-link>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editThumbnail(
                                                                product
                                                            )
                                                        "
                                                    >
                                                        Add thumbnail
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteProduct(
                                                                product.id
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
                            @paginate="loadProducts()"
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
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            New Thumbnail for {{ form.id }} - {{ form.title }}
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
                        @submit.prevent="createThumbnail()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="thumbnail"
                                    >Upload thumbnail
                                </label>

                                <div class="col-md-9">
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelected"
                                        ref="fileInput"
                                        name="thumbnail"
                                    />

                                    <button
                                        class="image-upload-box"
                                        @click.prevent="$refs.fileInput.click()"
                                    >
                                        <i
                                            v-show="!form.thumbnail"
                                            class="fas fa-plus"
                                        ></i>
                                        <i
                                            v-show="form.thumbnail"
                                            class="fas fa-check"
                                        ></i>
                                    </button>
                                    <p class="image-upload-filename mt-2">
                                        {{
                                            form.thumbnail
                                                ? form.photoName
                                                    ? form.photoName
                                                    : form.thumbnail
                                                : `Choose thumbnail image`
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button type="submit" class="btn btn-primary">
                                <i
                                    class="fas fa-pen-nib mr-2"
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
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        moment: moment,
        editMode: false,
        loading: true,
        products: [],
        productStates: [],
        searchText: null,
        productimage: "",
        form: new Form({
            id: "",
            title: "",
            thumbnail: "",
            product_state_id: "",
            category_id: "",
            user_id: "",
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    methods: {
        editThumbnail(product) {
            this.form.clear();
            this.form.reset();
            this.form.fill(product);
            $("#addRecord").modal("show");
        },

        fileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 4;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.thumbnail = reader.result;
                this.form.photoName = e.target.files[0].name;
            };
            reader.readAsDataURL(file);
        },

        newModal() {
            this.$router.push("/admin/products/listing");
        },

        createThumbnail() {
            this.form
                .post("/api/admin/product_thumbnails")
                .then(() => {
                    $("#addRecord").modal("hide");
                    this.loadProducts();
                })
                .catch((error) => console.log(error));
        },

        loadProducts() {
            axios
                .get(
                    "/api/admin/products?page=" + this.pagination.current_page,
                    {
                        params: { searchText: this.searchText },
                    }
                )
                .then(({ data }) => {
                    this.products = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                    this.form.clear();
                })
                .catch((error) => console.log(error));
        },

        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
        },

        setCurrentState(product, event) {
            if (confirm("Are you sure you want to delete?")) {
                this.form.product_state_id = event.target.value;
                this.form
                    .put("/api/admin/products/updateState/" + product)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        deleteProduct(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/products/" + id)
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
            this.pagination.current_page = 1;
            this.loadProducts();
        });
    },
};
</script>
