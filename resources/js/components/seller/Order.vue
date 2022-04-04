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
                                    col-lg-4 col-12
                                    input-form
                                    input-group
                                    input-group-alternative
                                    search-input
                                    mr-md-2
                                    mb-3 mb-md-0
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
                            <div class="col-lg-2 col-12 input-form">
                                <select
                                    class="custom-select form-control"
                                    name="status"
                                    id="status"
                                    v-model="statusFilter"
                                >
                                    <option value="">all</option>
                                    <option value="not acknowledged">
                                        not acknowledged
                                    </option>
                                    <option value="acknowledged">
                                        acknowledged
                                    </option>
                                    <option value="in production">
                                        in production
                                    </option>
                                    <option value="ready for delivery">
                                        ready for delivery
                                    </option>
                                    <option value="order dispatched">
                                        order dispatched
                                    </option>
                                    <option value="delivery in progress">
                                        delivery in progress
                                    </option>
                                    <option value="delivery completed">
                                        delivery completed
                                    </option>
                                </select>
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
                                        <th scope="col" class="table-col-lg">
                                            Date
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Items
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Amount
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Status
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="order in orders"
                                        :class="{
                                            'bg-dull-red':
                                                order.status ===
                                                'not acknowledged',
                                            'bg-dull-green':
                                                order.status === 'acknowledged',
                                            'bg-dull-yellow':
                                                order.status ===
                                                'in production',
                                            'bg-dull-orange':
                                                order.status ===
                                                'ready for delivery',
                                            'bg-dull-dark-orange':
                                                order.status ===
                                                    'order dispatched' ||
                                                order.status ===
                                                    'delivery in progress',
                                            'bg-dull-dark-green':
                                                order.status ===
                                                'delivery completed',
                                        }"
                                    >
                                        <td>{{ order.code }}</td>
                                        <td>
                                            <div>
                                                <span
                                                    class="
                                                        badge badge-pill
                                                        dark-purple
                                                        bg-white
                                                        border-grey
                                                        mr-2
                                                    "
                                                >
                                                    Dispatch
                                                </span>
                                                {{
                                                    moment(order.delivery_date)
                                                        .subtract(
                                                            order.shipping
                                                                .delivery_time,
                                                            "days"
                                                        )
                                                        .format("DD-MM-YYYY")
                                                }}
                                                9:30am
                                            </div>
                                            <div>
                                                <span
                                                    class="
                                                        badge badge-pill
                                                        dark-purple
                                                        bg-white
                                                        border-grey
                                                        mr-2
                                                    "
                                                >
                                                    Delivery
                                                </span>
                                                {{
                                                    moment(
                                                        order.delivery_date
                                                    ).format("DD-MM-YYYY")
                                                }}
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                v-for="parent_product in order.order_products"
                                            >
                                                <div
                                                    class="
                                                        d-flex
                                                        flex-row
                                                        justify-content-between
                                                        align-items-start
                                                    "
                                                >
                                                    <div
                                                        class="fixed-title mr-3"
                                                    >
                                                        {{
                                                            parent_product
                                                                .product.title
                                                        }}
                                                    </div>
                                                    {{
                                                        parent_product.quantity
                                                    }}
                                                </div>
                                                <hr class="my-1 py-0" />
                                            </div>
                                            <a
                                                href=""
                                                @click.prevent="newModal(order)"
                                                class="simple-link"
                                            >
                                                View Items Summary
                                            </a>
                                        </td>
                                        <td>LKR {{ order.total }}</td>
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
                                                <option
                                                    value="not acknowledged"
                                                >
                                                    not acknowledged
                                                </option>
                                                <option
                                                    value="acknowledged"
                                                    v-show="
                                                        order.status ==
                                                        'not acknowledged'
                                                    "
                                                >
                                                    acknowledged
                                                </option>
                                                <option
                                                    value="in production"
                                                    v-show="
                                                        order.status ==
                                                        'acknowledged'
                                                    "
                                                >
                                                    in production
                                                </option>
                                                <option
                                                    value="ready for delivery"
                                                    v-show="
                                                        order.status ==
                                                        'in production'
                                                    "
                                                >
                                                    ready for delivery
                                                </option>
                                                <option
                                                    value="order dispatched"
                                                >
                                                    order dispatched
                                                </option>
                                                <option
                                                    value="delivery in progress"
                                                >
                                                    delivery in progress
                                                </option>
                                                <option
                                                    value="delivery completed"
                                                    hidden
                                                >
                                                    delivery completed
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
                <!-- Item Summary -->
                <div class="modal-content" v-if="parent_product_mode">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            Item Summary of Order #{{ current_order.code }}
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

                    <div class="modal-body modal-view">
                        <div
                            class="card dashboard-info-card mt-4"
                            v-for="(
                                parent_product, index
                            ) in current_order.order_products"
                        >
                            <!-- Header -->
                            <h4 class="mb-3">Item {{ index + 1 }}</h4>
                            <hr class="mt-0" />
                            <div class="row mb-2">
                                <div class="col-md-3 modal-label">Title</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.title }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.code }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 modal-label">Quantity</div>
                                <div class="col-md-9">
                                    {{ parent_product.quantity }}
                                </div>
                            </div>
                            <div
                                class="row mb-2"
                                v-if="
                                    parent_product.order_product_variations
                                        .length > 0
                                "
                            >
                                <div class="col-md-3 modal-label">
                                    Specification
                                </div>
                                <div class="col-md-9">
                                    <div
                                        v-for="variation in parent_product.order_product_variations"
                                    >
                                        {{
                                            variation.variation_option.variation
                                                .name
                                        }}
                                        :
                                        {{ variation.variation_option.name }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 modal-label">Amount</div>
                                <div class="col-md-9">
                                    LKR
                                    {{
                                        parent_product.total *
                                        parent_product.quantity
                                    }}
                                    <div class="darkgrey">
                                        Base Price : LKR
                                        {{ parent_product.product.base_price }}
                                    </div>
                                    <div
                                        class="darkgrey"
                                        v-for="variation in parent_product.order_product_variations"
                                    >
                                        {{
                                            variation.variation_option.variation
                                                .name
                                        }}
                                        ({{ variation.variation_option.name }})
                                        : + LKR
                                        {{ variation.variation_option.price }}
                                    </div>
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

                <!-- Order Summary -->
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
                                        <div>
                                            Tax : {{ current_order.tax }} +
                                        </div>
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
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        moment: moment,
        orders: [],
        searchText: null,
        statusFilter: "",
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

    watch: {
        statusFilter(after, before) {
            Fire.$emit("reloadRecords");
        },
    },

    methods: {
        newModal(order) {
            this.current_order = order;
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
                    params: {
                        searchText: this.searchText,
                        statusFilter: this.statusFilter,
                    },
                })
                .then(({ data }) => {
                    this.orders = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        setCurrentState(order, event) {
            if (confirm("Are you sure you want to change order status?")) {
                this.form.status = event.target.value;
                this.form
                    .put("/api/seller/orders/" + order)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
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
