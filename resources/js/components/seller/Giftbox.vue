<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card pb-3 pb-md-1 pt-0">
                        <div class="row align-items-center">
                            <div
                                class="
                                    col-lg-4 col-9
                                    input-form
                                    input-group
                                    input-group-alternative
                                    search-input
                                    mb-0 mb-md-0
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
                            <div class="col-lg-8 col-3 text-right">
                                <router-link to="/seller/giftboxes/listing">
                                    <button
                                        type="button"
                                        class="btn btn-primary mobile-add-btn"
                                    >
                                        <i
                                            class="fas fa-plus mr-md-2"
                                            aria-hidden="true"
                                        ></i>
                                        <span class="hide-content-sm-inline">
                                            Add
                                        </span>
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- Table start -->
                        <div
                            class="
                                table-responsive
                                dashboard-table
                                vertical-scroll
                                hide-content-sm
                            "
                        >
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Code</th>
                                        <th scope="col" class="table-col-lg">
                                            Title
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Minimum Price
                                        </th>
                                        <th class="table-col-sm">Status</th>
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
                                        <td>{{ product.code }}</td>
                                        <td>{{ product.title }}</td>
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
                                                <router-link
                                                    class="btn-sm mr-3"
                                                    :to="{
                                                        name: 'seller/giftboxes/listing/edit',
                                                        params: {
                                                            productId:
                                                                product.id,
                                                        },
                                                    }"
                                                >
                                                    Edit
                                                </router-link>
                                                <a
                                                    class="btn-sm"
                                                    href="#"
                                                    @click.prevent="
                                                        newModal(product)
                                                    "
                                                >
                                                    View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table end -->

                        <!-- Mobile View start -->
                        <div class="hide-content">
                            <div
                                class="card dashboard-info-card mb-4 pb-3"
                                v-for="product in products"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-4
                                    "
                                >
                                    <div class="d-flex flex-row mr-3">
                                        <img
                                            width="150px"
                                            height="150px"
                                            class="
                                                mobile-card-banner-container
                                                banner-container-xs
                                                mr-3
                                            "
                                            :src="
                                                product.product_image
                                                    ? product.product_image.path
                                                    : '/images/lavisco/img-bg.jpg'
                                            "
                                        />
                                        <div>
                                            <div class="mobile-card-title mb-3">
                                                {{ product.code }}
                                            </div>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    mobile-btn-sm
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
                                        </div>
                                    </div>
                                    <div class="mobile-card-dropdown">
                                        <button
                                            type="button"
                                            class="btn-sm mobile-btn-sm"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                aria-hidden="true"
                                                role="img"
                                                width="23px"
                                                height="23px"
                                                preserveAspectRatio="xMidYMid meet"
                                                viewBox="0 0 16 16"
                                            >
                                                <g
                                                    fill="none"
                                                    stroke="#976aff"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                >
                                                    <circle
                                                        cx="8"
                                                        cy="2.5"
                                                        r=".75"
                                                    />
                                                    <circle
                                                        cx="8"
                                                        cy="8"
                                                        r=".75"
                                                    />
                                                    <circle
                                                        cx="8"
                                                        cy="13.5"
                                                        r=".75"
                                                    />
                                                </g>
                                            </svg>
                                        </button>
                                        <div
                                            class="
                                                dropdown-menu
                                                dropdown-menu-right
                                            "
                                        >
                                            <router-link
                                                class="
                                                    dropdown-item
                                                    mobile-dropdown-item
                                                "
                                                :to="{
                                                    name: 'seller/giftboxes/listing/edit',
                                                    params: {
                                                        productId: product.id,
                                                    },
                                                }"
                                            >
                                                Edit
                                            </router-link>
                                            <button
                                                class="
                                                    dropdown-item
                                                    mobile-dropdown-item
                                                "
                                                type="button"
                                                @click.prevent="
                                                    newModal(product)
                                                "
                                            >
                                                View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        align-items-center
                                        justify-content-between
                                    "
                                >
                                    <div>
                                        <div class="mobile-card-sub-title mr-3">
                                            Title
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ product.title }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Base Price
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ product.base_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile View end -->

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
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            {{ form.title }}
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle white"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- Form start -->
                    <div class="modal-body modal-view">
                        <div class="card dashboard-info-card">
                            <!-- Header -->
                            <h4 class="mb-3">Image</h4>
                            <hr class="mt-0" />
                            <div class="d-flex flex-row flex-wrap gap">
                                <div class="image-upload-box">
                                    <img
                                        class="
                                            banner-container
                                            seller-banner-container
                                        "
                                        :src="
                                            form.product_image
                                                ? form.product_image.path
                                                : '/images/lavisco/img-bg.jpg'
                                        "
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Details</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Title</div>
                                <div class="col-md-9">
                                    {{ form.title }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Date created
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(form.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Category</div>
                                <div class="col-md-9">
                                    {{ form.category.name }}
                                </div>
                            </div>
                            <div class="row mb-3" v-show="form.sku">
                                <div class="col-md-3 modal-label">SKU</div>
                                <div class="col-md-9">
                                    {{ form.sku }}
                                </div>
                            </div>
                            <div class="row mb-3" v-show="form.base_price">
                                <div class="col-md-3 modal-label">
                                    Minimum Base Price
                                </div>
                                <div class="col-md-9">
                                    {{ form.base_price }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Short Description
                                </div>
                                <div class="col-md-9">
                                    {{ form.short_description }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Processing Time
                                </div>
                                <div class="col-md-9">
                                    {{ form.processing_time }}
                                </div>
                            </div>
                        </div>

                        <div v-if="form.giftbox_products">
                            <div class="card dashboard-info-card mt-4">
                                <!-- Header -->
                                <h4 class="mb-3">Products</h4>
                                <hr class="mt-0" />
                                <div class="table-responsive form-table">
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
                                                    style="
                                                        min-width: fit-content;
                                                    "
                                                >
                                                    Code
                                                </th>
                                                <th
                                                    scope="col"
                                                    style="
                                                        min-width: fit-content;
                                                    "
                                                >
                                                    Quantity
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    giftbox_product, index
                                                ) in form.giftbox_products"
                                                :key="giftbox_product.id"
                                            >
                                                <td>
                                                    {{
                                                        giftbox_product
                                                            .child_product.code
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        giftbox_product.quantity
                                                    }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-black">
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
import _ from "lodash";
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        moment: moment,
        products: [],
        productStates: [],
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            sku: "",
            title: "",
            short_description: "",
            description: "",
            length: "",
            width: "",
            height: "",
            dimensions_unit: "",
            weight: "",
            weight_unit: "",
            base_price: "",
            processing_time: "",
            has_custom_text: "",
            has_custom_image: "",
            has_variations: "",
            has_inventory: "",
            quantity: "",
            product_state_id: "",
            category: "",
            product_image: null,
            giftbox_products: null,
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        newModal(product) {
            $("#addRecord").modal("show");
            this.form.fill(product);
        },

        loadProducts() {
            axios
                .get(
                    "/api/seller/giftboxes?page=" +
                        this.pagination.current_page,
                    {
                        params: { searchText: this.searchText },
                    }
                )
                .then(({ data }) => {
                    this.products = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
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
            if (confirm("Are you sure you want to change product status?")) {
                this.form.product_state_id = event.target.value;
                this.form
                    .put("/api/seller/giftboxes/updateState/" + product)
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
