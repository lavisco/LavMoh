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
                                        <th
                                            scope="col"
                                            class="
                                                d-flex
                                                flex-row
                                                justify-content-between
                                                align-items-start
                                            "
                                        >
                                            Products <span>Quantity</span>
                                        </th>
                                        <th scope="col">Shipping Details</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" class="table-col-sm">
                                            Status
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="order in orders">
                                        <td>{{ order.code }}</td>
                                        <td>{{ order.created_at }}</td>
                                        <td>
                                            <div
                                                v-for="parent_product in order.order_products"
                                                class="
                                                    d-flex
                                                    flex-row
                                                    justify-content-between
                                                    align-items-start
                                                    py-2
                                                    border-bottom
                                                "
                                            >
                                                <a
                                                    class="
                                                        btn btn-sm btn-xs
                                                        mr-2
                                                    "
                                                    @click.prevent="
                                                        newModal(parent_product)
                                                    "
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-expand-arrows-alt
                                                        "
                                                    ></i>
                                                </a>
                                                <div class="fixed-title mr-3">
                                                    {{
                                                        parent_product.product
                                                            .title
                                                    }}
                                                </div>
                                                {{ parent_product.quantity }}
                                            </div>
                                        </td>
                                        <td>
                                            {{
                                                order.address +
                                                ", " +
                                                order.city +
                                                " " +
                                                order.zipcode +
                                                ", " +
                                                order.district +
                                                ", " +
                                                order.province +
                                                ", " +
                                                order.country
                                            }}
                                        </td>
                                        <td>
                                            LKR {{ order.total }}
                                            <div class="text-sm text-grey">
                                                <div>
                                                    Subtotal:
                                                    {{ order.subtotal }} +
                                                </div>
                                                <div>
                                                    Tax : {{ order.tax }} +
                                                </div>
                                                <div>
                                                    Shipping :
                                                    {{ order.shipping_price }} +
                                                </div>
                                                <div>
                                                    Giftwrap :
                                                    {{
                                                        order.giftwrap_price
                                                            ? order.giftwrap_price
                                                            : "0.00"
                                                    }}
                                                    -
                                                </div>
                                                <div>
                                                    Discount :
                                                    {{
                                                        order.discount_price
                                                            ? order.discount_price
                                                            : "0.00"
                                                    }}
                                                </div>
                                            </div>
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
                                                <option value="pending">
                                                    Pending
                                                </option>
                                                <option value="confirmed">
                                                    Confirmed
                                                </option>
                                                <option value="paid">
                                                    Paid
                                                </option>
                                                <option value="shipped">
                                                    Shipped
                                                </option>
                                                <option value="delivered">
                                                    Delivered
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <a
                                                class="btn btn-sm"
                                                href="#"
                                                @click.prevent="
                                                    viewModal(order)
                                                "
                                            >
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table end -->
                        <h4
                            class="text-center mt-4"
                            v-show="orders.length == 0"
                        >
                            No orders have been placed yet
                        </h4>
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
                <div class="modal-content" v-if="parent_product_mode">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            {{ parent_product.product.title }}
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
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h6 class="mb-3">Details</h6>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Code
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.product.code }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Title
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.product.title }}
                                </div>
                            </div>
                            <div
                                class="form-group row"
                                v-show="parent_product.product.sku"
                            >
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >SKU
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.product.sku }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Base Price
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.base_price }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Net Total Price
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.total }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Total Price
                                </label>
                                <div class="col-md-9">
                                    {{
                                        parent_product.total *
                                        parent_product.quantity
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Quantity
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.quantity }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Dimensions
                                </label>
                                <div class="col-md-9">
                                    {{
                                        parent_product.product.dimensions_unit
                                            ? `${parent_product.product.length} * ${parent_product.product.width} * ${parent_product.product.height} ${parent_product.product.dimensions_unit}`
                                            : ""
                                    }}
                                </div>
                            </div>
                            <div
                                class="form-group row"
                                v-show="parent_product.product.weight"
                            >
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Weight
                                </label>
                                <div class="col-md-9">
                                    {{
                                        parent_product.product.weight
                                            ? `${parent_product.product.weight} ${parent_product.product.weight_unit}`
                                            : ""
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Processing Time
                                </label>
                                <div class="col-md-9">
                                    {{ parent_product.product.processing_time }}
                                </div>
                            </div>
                        </div>

                        <div
                            class="card dashboard-info-card mt-4"
                            v-if="
                                parent_product.order_product_variations.length >
                                0
                            "
                        >
                            <!-- Header -->
                            <h6 class="mb-3">Variations</h6>
                            <div>
                                <div class="table-responsive form-table">
                                    <table class="table align-items-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Option Name</th>
                                                <th scope="col" class="smwidth">
                                                    Price
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="variation in parent_product.order_product_variations"
                                            >
                                                <td>
                                                    {{
                                                        variation
                                                            .variation_option
                                                            .variation.name
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        variation
                                                            .variation_option
                                                            .name
                                                    }}
                                                </td>
                                                <td>{{ variation.price }}</td>
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
                <div class="modal-content" v-if="current_order_mode">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            {{ current_order.code }}
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
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h6 class="mb-3">Summary</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Code
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.code }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Date
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.created_at }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Total
                                </label>
                                <div class="col-md-9">
                                    LKR {{ current_order.total }}
                                    <div class="text-sm">
                                        <div>
                                            Subtotal:
                                            {{ current_order.subtotal }} +
                                        </div>
                                        <div>Tax : {{ current_order.tax }} +</div>
                                        <div>
                                            Shipping :
                                            {{ current_order.shipping_price }} +
                                        </div>
                                        <div>
                                            Giftwrap :
                                            {{
                                                current_order.giftwrap_price
                                                    ? current_order.giftwrap_price
                                                    : "0.00"
                                            }}
                                            -
                                        </div>
                                        <div>
                                            Discount :
                                            {{
                                                current_order.discount_price
                                                    ? current_order.discount_price
                                                    : "0.00"
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h6 class="mb-3">Customer Information</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Name
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.name }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Email
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.email }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Phone
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.phone }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Address
                                </label>
                                <div class="col-md-9">
                                    {{ current_order.address }}<br />
                                    {{ current_order.city }}
                                    {{ current_order.zipcode }}<br />
                                    {{ current_order.district }}<br />
                                    {{ current_order.province }},
                                    {{ current_order.country }}
                                </div>
                            </div>
                        </div>
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h6 class="mb-3">Products</h6>
                            <div>
                                <div class="table-responsive form-table">
                                    <table class="table align-items-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Code</th>
                                                <th scope="col">Variations</th>
                                                <th scope="col" class="smwidth">
                                                    Net Price
                                                </th>
                                                <th scope="col" class="smwidth">
                                                    Quantity
                                                </th>
                                                <th scope="col" class="smwidth">
                                                    Total Price
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="productParent in current_order.order_products"
                                            >
                                                <td>
                                                    {{
                                                        productParent.product
                                                            .code
                                                    }}
                                                    <div class="text-sm">
                                                        {{
                                                            productParent
                                                                .product.title
                                                        }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        v-for="variation in productParent.order_product_variations"
                                                    >
                                                        {{
                                                            variation
                                                                .variation_option
                                                                .variation.name
                                                        }}
                                                        :
                                                        {{
                                                            variation
                                                                .variation_option
                                                                .name
                                                        }}
                                                        <span class="text-sm">{{
                                                            variation.price
                                                        }}</span>
                                                        <hr />
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ productParent.total }}
                                                </td>
                                                <td>
                                                    {{ productParent.quantity }}
                                                </td>
                                                <td>
                                                    {{
                                                        productParent.total *
                                                        productParent.quantity
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

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        orders: [],
        searchText: null,
        loading: true,
        parent_product: "",
        parent_product_mode: false,
        current_order: "",
        current_order_mode: false,
        form: new Form({
            id: "",
            status: "",
        }),
    }),

    methods: {
        newModal(product) {
            this.parent_product = product;
            this.current_order_mode = false;
            this.parent_product_mode = true;
            $("#addRecord").modal("show");
        },
        viewModal(order) {
            this.current_order = order;
            this.parent_product_mode = false;
            this.current_order_mode = true;
            $("#addRecord").modal("show");
        },
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
