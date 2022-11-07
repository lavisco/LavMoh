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
                                <router-link to="/seller/products/listing">
                                    <button
                                        type="button"
                                        class="mobile-add-btn"
                                    >
                                        <i
                                            class="fas fa-plus mr-md-2"
                                            aria-hidden="true"
                                        ></i>
                                        <span class="hide-content-sm-inline"
                                            >Add</span
                                        >
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
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="table-col-sm">
                                            Base Price
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
                                                <router-link
                                                    class="btn-sm mr-3"
                                                    :to="{
                                                        name: 'seller/products/listing/edit',
                                                        params: {
                                                            productId:
                                                                product.id,
                                                        },
                                                    }"
                                                >
                                                    <svg
                                                        class="mr-2"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        aria-hidden="true"
                                                        role="img"
                                                        width="21"
                                                        height="21"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill="#707070"
                                                            d="M5 1a.5.5 0 0 1 .5.5V2h2v-.5a.5.5 0 0 1 1 0V2h2v-.5a.5.5 0 0 1 1 0V2A1.5 1.5 0 0 1 13 3.5v2.536a2.547 2.547 0 0 0-1 .406V3.5a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h1.547v.002a1.59 1.59 0 0 0 .068.998H4.5A1.5 1.5 0 0 1 3 13.5v-10A1.5 1.5 0 0 1 4.5 2v-.5A.5.5 0 0 1 5 1Zm5 7c.107 0 .206.034.288.091L9.378 9H6a.5.5 0 0 1 0-1h4Zm-3.004 3.435A.5.5 0 0 0 6.5 11H6a.5.5 0 0 0 0 1h.5a.498.498 0 0 0 .157-.025c.097-.189.21-.37.339-.54ZM6 5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6Zm6.338 2.455a1.56 1.56 0 0 1 2.207 2.207l-4.289 4.288a2.777 2.777 0 0 1-1.29.731l-1.211.303a.61.61 0 0 1-.74-.74l.304-1.21c.122-.489.374-.935.73-1.29l4.289-4.289Z"
                                                        />
                                                    </svg>
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
                                <div class="d-flex flex-row mb-3">
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
                                        <div class="mobile-card-body">
                                            {{ product.code }}
                                        </div>
                                        <h5 class="text-left mb-0">
                                            {{ product.title }}
                                        </h5>
                                    </div>
                                </div>

                                <div class="d-flex flex-row mb-3">
                                    <div class="col-5 pl-0 pr-2">
                                        <div class="mobile-card-sub-title">
                                            Date created
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    product.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-4 pl-0 pr-2">
                                        <div class="mobile-card-sub-title">
                                            Base Price
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ product.base_price }}
                                        </div>
                                    </div>
                                    <div
                                        class="col-3 px-0"
                                        v-if="product.has_inventory == 1"
                                    >
                                        <div class="mobile-card-sub-title">
                                            Quantity
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ product.quantity }}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                    "
                                >
                                    <div class="col-5 pl-0 pr-3">
                                        <div class="mobile-card-sub-title">
                                            Status
                                        </div>
                                        <select
                                            class="custom-select form-control"
                                            name="product_state_id"
                                            id="product_state_id"
                                            v-model="product.product_state_id"
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
                                    <div class="col-7 px-0">
                                        <div class="mobile-card-sub-title">
                                            Actions
                                        </div>
                                        <div class="d-flex flex-row">
                                            <router-link
                                                class="btn-sm mr-2"
                                                :to="{
                                                    name: 'seller/products/listing/edit',
                                                    params: {
                                                        productId: product.id,
                                                    },
                                                }"
                                            >
                                                <svg
                                                    class="mr-2"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    aria-hidden="true"
                                                    role="img"
                                                    width="19"
                                                    height="19"
                                                    preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill="#707070"
                                                        d="M5 1a.5.5 0 0 1 .5.5V2h2v-.5a.5.5 0 0 1 1 0V2h2v-.5a.5.5 0 0 1 1 0V2A1.5 1.5 0 0 1 13 3.5v2.536a2.547 2.547 0 0 0-1 .406V3.5a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h1.547v.002a1.59 1.59 0 0 0 .068.998H4.5A1.5 1.5 0 0 1 3 13.5v-10A1.5 1.5 0 0 1 4.5 2v-.5A.5.5 0 0 1 5 1Zm5 7c.107 0 .206.034.288.091L9.378 9H6a.5.5 0 0 1 0-1h4Zm-3.004 3.435A.5.5 0 0 0 6.5 11H6a.5.5 0 0 0 0 1h.5a.498.498 0 0 0 .157-.025c.097-.189.21-.37.339-.54ZM6 5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6Zm6.338 2.455a1.56 1.56 0 0 1 2.207 2.207l-4.289 4.288a2.777 2.777 0 0 1-1.29.731l-1.211.303a.61.61 0 0 1-.74-.74l.304-1.21c.122-.489.374-.935.73-1.29l4.289-4.289Z"
                                                    />
                                                </svg>
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
                    <div class="modal-header">
                        <h4 class="modal-title" id="addRecordLabel">
                            {{ form.title }}
                        </h4>
                        <button
                            type="button"
                            class="btn-modal-close close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 34 34"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="34"
                                    height="34"
                                    rx="17"
                                    fill="white"
                                />
                                <g clip-path="url(#clip0_355_858)">
                                    <path
                                        d="M21.5803 10.9735L23.0266 12.4199C23.2275 12.6208 23.328 12.8618 23.328 13.1431C23.328 13.4243 23.2275 13.6653 23.0266 13.8662L19.8929 17L23.0266 20.1338C23.2275 20.3347 23.328 20.5757 23.328 20.8569C23.328 21.1382 23.2275 21.3792 23.0266 21.5801L21.5803 23.0265C21.3794 23.2274 21.1383 23.3278 20.8571 23.3278C20.5759 23.3278 20.3348 23.2274 20.1339 23.0265L17.0002 19.8927L13.8664 23.0265C13.6655 23.2274 13.4244 23.3278 13.1432 23.3278C12.862 23.3278 12.6209 23.2274 12.42 23.0265L10.9737 21.5801C10.7728 21.3792 10.6724 21.1382 10.6724 20.8569C10.6724 20.5757 10.7728 20.3347 10.9737 20.1338L14.1074 17L10.9737 13.8662C10.7728 13.6653 10.6724 13.4243 10.6724 13.1431C10.6724 12.8618 10.7728 12.6208 10.9737 12.4199L12.42 10.9735C12.6209 10.7726 12.862 10.6722 13.1432 10.6722C13.4244 10.6722 13.6655 10.7726 13.8664 10.9735L17.0002 14.1073L20.1339 10.9735C20.3348 10.7726 20.5759 10.6722 20.8571 10.6722C21.1383 10.6722 21.3794 10.7726 21.5803 10.9735Z"
                                        fill="#333333"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_355_858">
                                        <rect
                                            width="15"
                                            height="15"
                                            fill="white"
                                            transform="translate(9.5 9.5)"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>

                    <!-- Form start -->
                    <div class="modal-body modal-view">
                        <div class="card dashboard-info-card">
                            <!-- Header -->
                            <h4 class="mb-3">Images</h4>
                            <hr class="mt-0" />
                            <div class="d-flex flex-row flex-wrap gap">
                                <div
                                    class="image-upload-box"
                                    :class="{
                                        'image-upload-box-primary':
                                            image.primary_image == 1,
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
                                <div class="col-md-3 modal-label">Category</div>
                                <div class="col-md-9">
                                    {{ form.category.name }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Sub-Category
                                </div>
                                <div class="col-md-9">
                                    {{
                                        form.sub_categories[0]
                                            ? form.sub_categories[0].name
                                            : ""
                                    }}
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
                                    Base Price
                                </div>
                                <div class="col-md-9">
                                    {{ form.base_price }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Quantity</div>
                                <div class="col-md-9">
                                    {{ form.quantity }}
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
                                    Description
                                </div>
                                <div class="col-md-9">
                                    {{ form.description }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Dimensions
                                </div>
                                <div class="col-md-9">
                                    {{
                                        form.dimensions_unit
                                            ? `${form.length} * ${form.width} * ${form.height} ${form.dimensions_unit}`
                                            : ""
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3" v-show="form.weight">
                                <div class="col-md-3 modal-label">Weight</div>
                                <div class="col-md-9">
                                    {{
                                        form.weight
                                            ? `${form.weight} ${form.weight_unit}`
                                            : ""
                                    }}
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

                        <div v-if="form.variations">
                            <div
                                class="card dashboard-info-card mt-4"
                                v-for="(variation, index) in form.variations"
                            >
                                <!-- Header -->
                                <h4 class="mb-3">Variation {{ index + 1 }}</h4>
                                <hr class="mt-0" />
                                <div class="row mb-3">
                                    <div class="col-md-3 modal-label">Type</div>
                                    <div class="col-md-9">
                                        {{ variation.name }}
                                    </div>
                                </div>
                                <div
                                    class="row mb-3"
                                    v-if="variation.description"
                                >
                                    <div class="col-md-3 modal-label">
                                        Description
                                    </div>
                                    <div class="col-md-9">
                                        {{ variation.description }}
                                    </div>
                                </div>
                                <div
                                    class="row mb-3"
                                    v-for="(
                                        option, index
                                    ) in variation.variation_options"
                                >
                                    <div class="col-md-3 modal-label">
                                        Option {{ index + 1 }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ option.name }}
                                        <span class="grey">-</span>
                                        LKR {{ option.price }}
                                        <div>
                                            {{ option.quantity }}
                                            <span class="grey text-xxs">
                                                Quantity
                                            </span>
                                        </div>
                                        <div v-if="option.sku">
                                            {{ option.sku }}
                                            <span class="grey text-xxs">
                                                SKU
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn bg-black"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
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
            category_id: "",
            category: "",
            sub_categories: [],
            product_image: null,
            product_images: null,
            product_variations: null,
            variations: null,
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
                    "/api/seller/products?page=" + this.pagination.current_page,
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
                    .put("/api/seller/products/updateState/" + product)
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
