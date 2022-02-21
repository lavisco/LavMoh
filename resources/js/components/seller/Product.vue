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
                        <div class="row align-items-center">
                            <div
                                class="
                                    col-lg-4 col-7
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
                            <div class="col-lg-8 col-5 text-right">
                                <router-link to="/seller/products/listing">
                                    <button type="button" class="btn">
                                        <i
                                            class="fas fa-plus mr-2"
                                            aria-hidden="true"
                                        ></i>
                                        Add
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive dashboard-table">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">State</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container-sm"
                                                :src="
                                                    product.product_image
                                                        ? product.product_image
                                                              .path
                                                        : '/images/lavisco/img-bg.jpg'
                                                "
                                            />
                                        </td>
                                        <td>{{ product.sku }}</td>
                                        <td>{{ product.title }}</td>
                                        <td>{{ product.quantity }}</td>
                                        <td>{{ product.base_price }}</td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
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
                                            <div class="d-flex">
                                                <div
                                                    class="
                                                        dropdown
                                                        dropdown-seller-product-edit
                                                        mr-md-3
                                                    "
                                                >
                                                    <a
                                                        class="btn btn-sm"
                                                        href="#"
                                                        role="button"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        Edit
                                                    </a>
                                                    <div
                                                        class="
                                                            dropdown-menu
                                                            dropdown-menu-right
                                                            dropdown-menu-arrow
                                                        "
                                                    >
                                                        <router-link
                                                            class="
                                                                dropdown-item
                                                            "
                                                            :to="{
                                                                name: 'seller/products/listing/edit',
                                                                params: {
                                                                    productId:
                                                                        product.id,
                                                                },
                                                            }"
                                                            >Details
                                                        </router-link>
                                                        <router-link
                                                            class="
                                                                dropdown-item
                                                            "
                                                            :to="{
                                                                name: 'seller/products/listing/image/edit',
                                                                params: {
                                                                    productId:
                                                                        product.id,
                                                                },
                                                            }"
                                                            >Images
                                                        </router-link>
                                                        <router-link
                                                            class="
                                                                dropdown-item
                                                            "
                                                            :to="{
                                                                name: 'seller/products/listing/variation/edit',
                                                                params: {
                                                                    productId:
                                                                        product.id,
                                                                },
                                                            }"
                                                            >Variation
                                                        </router-link>
                                                    </div>
                                                </div>
                                                <a
                                                    class="btn btn-sm"
                                                    href="#"
                                                    @click.prevent="
                                                        newModal(product)
                                                    "
                                                    >View
                                                </a>
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
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            {{ form.title }}
                        </h4>
                        <button
                            type="button"
                            class="btn-modal-close close"
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
                    <div class="modal-body modal-view">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label" for="name"
                                    >Images
                                </label>
                                <div class="card product-display-card">
                                    <div class="d-flex flex-row gap">
                                        <div
                                            class="image-upload-box"
                                            :class="{
                                                'image-upload-box-primary':
                                                    image.primary_image === 1,
                                            }"
                                            v-for="image in form.product_images"
                                        >
                                            <img
                                                class="
                                                    banner-container
                                                    seller-banner-container
                                                "
                                                :src="
                                                    image
                                                        ? image.path
                                                        : '/images/lavisco/img-bg.jpg'
                                                "
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >SKU
                            </label>
                            <div class="col-md-9">{{ form.sku }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Price
                            </label>
                            <div class="col-md-9">{{ form.base_price }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Quantity
                            </label>
                            <div class="col-md-9">{{ form.quantity }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Description
                            </label>
                            <div class="col-md-9">{{ form.description }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Dimensions
                            </label>
                            <div class="col-md-9">
                                {{
                                    form.dimensions_unit
                                        ? `${form.length} * ${form.width} * ${form.height} ${form.dimensions_unit}`
                                        : ""
                                }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Weight
                            </label>
                            <div class="col-md-9">
                                {{
                                    form.weight
                                        ? `${form.weight} ${form.weight_unit}`
                                        : ""
                                }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name"
                                >Category
                            </label>
                            <div class="col-md-9">
                                {{ form.category.name }}
                            </div>
                        </div>
                        <div
                            class="form-group row"
                            v-show="form.product_variations"
                        >
                            <div class="col-md-12">
                                <label class="col-form-label" for="name"
                                    >Variations
                                </label>
                                <div class="card product-display-card">
                                    <div
                                        class="
                                            table-responsive
                                            variation-display-table
                                        "
                                    >
                                        <table class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Option</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">
                                                        Quantity
                                                    </th>
                                                    <th scope="col">
                                                        Description
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="variation in form.product_variations"
                                                >
                                                    <td>
                                                        {{ variation.type }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            variation.type_option
                                                        }}
                                                    </td>
                                                    <td>{{ variation.sku }}</td>
                                                    <td>
                                                        {{ variation.price }}
                                                    </td>
                                                    <td>
                                                        {{ variation.quantity }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            variation.description
                                                        }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle mr-2"
                                aria-hidden="true"
                            ></i>
                            Close
                        </button>
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
        loading: true,
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
            category: "",
            product_image: null,
            product_images: null,
            product_variations: null,
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    methods: {
        newModal(product) {
            $("#addRecord").modal("show");
            this.form.fill(product);
        },

        loadProducts() {
            axios
                .get("/api/seller/products", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.products = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadProductStates() {
            axios
                .get("/api/seller/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
        },

        setCurrentState(product, event) {
            this.form.product_state_id = event.target.value;
            this.form
                .put("/api/seller/products/updateState/" + product)
                .then(() => {
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
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
