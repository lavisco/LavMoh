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
                                        <th scope="col" class="table-col-sm">
                                            Code
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Date
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Items
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Amount
                                        </th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="table-col-sm">
                                            Update Status
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="order in orders">
                                        <td>
                                            <div
                                                class="status-indicator"
                                                :class="{
                                                    'bg-danger':
                                                        order.status ===
                                                        'not acknowledged',
                                                    'bg-success':
                                                        order.status ===
                                                        'acknowledged',
                                                    'bg-warning':
                                                        order.status ===
                                                        'in production',
                                                    'bg-orange':
                                                        order.status ===
                                                        'ready for delivery',
                                                    'bg-dark-orange':
                                                        order.status ===
                                                            'order dispatched' ||
                                                        order.status ===
                                                            'delivery in progress',
                                                    'bg-dark-green':
                                                        order.status ===
                                                        'delivery completed',
                                                }"
                                            ></div>
                                            {{ order.code }}
                                        </td>
                                        <td>
                                            <div class="mb-2">
                                                <div class="text-xxs">
                                                    Dispatch
                                                </div>
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
                                                <div class="text-xxs">
                                                    Delivery
                                                </div>

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
                                        <td>
                                            {{ order.currency_code }}
                                            {{ order.total }}
                                        </td>
                                        <td>
                                            <span
                                                class="
                                                    badge badge-pill
                                                    bg-purple
                                                    white
                                                "
                                                :class="{
                                                    'bg-danger':
                                                        order.status ===
                                                        'not acknowledged',
                                                    'bg-success':
                                                        order.status ===
                                                        'acknowledged',
                                                    'bg-warning':
                                                        order.status ===
                                                        'in production',
                                                    'bg-orange':
                                                        order.status ===
                                                        'ready for delivery',
                                                    'bg-dark-orange':
                                                        order.status ===
                                                            'order dispatched' ||
                                                        order.status ===
                                                            'delivery in progress',
                                                    'bg-dark-green':
                                                        order.status ===
                                                        'delivery completed',
                                                }"
                                            >
                                                {{ order.status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button
                                                @click.prevent="
                                                    setCurrentStatus(order)
                                                "
                                                class="btn btn-sm"
                                                title="Change status"
                                                v-if="
                                                    statusUpdateActive(
                                                        order.status
                                                    ) == true
                                                "
                                            >
                                                {{ nextStatus(order.status) }}
                                            </button>
                                            <p v-else>Lavisco is shipping</p>
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

                        <!-- Mobile View start -->
                        <div class="hide-content">
                            <div
                                class="card dashboard-info-card mb-4 pb-3"
                                :class="{
                                    'border-dull-red':
                                        order.status === 'not acknowledged',
                                    'border-dull-green':
                                        order.status === 'acknowledged',
                                    'border-dull-yellow':
                                        order.status === 'in production',
                                    'border-dull-orange':
                                        order.status === 'ready for delivery',
                                    'border-dull-blue':
                                        order.status === 'order dispatched' ||
                                        order.status === 'delivery in progress',
                                    'border-dull-dark-green':
                                        order.status === 'delivery completed',
                                }"
                                v-for="order in orders"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        align-items-start
                                        mb-2
                                    "
                                >
                                    <div class="mobile-card-title mr-3">
                                        {{ order.code }}
                                    </div>

                                    <div
                                        class="
                                            d-flex
                                            flex-row
                                            align-items-start
                                        "
                                    >
                                        <span
                                            class="
                                                badge badge-pill
                                                bg-purple
                                                white
                                                text-xxs
                                                mr-2
                                            "
                                            :class="{
                                                'bg-danger':
                                                    order.status ===
                                                    'not acknowledged',
                                                'bg-success':
                                                    order.status ===
                                                    'acknowledged',
                                                'bg-warning':
                                                    order.status ===
                                                    'in production',
                                                'bg-orange':
                                                    order.status ===
                                                    'ready for delivery',
                                                'bg-dark-orange':
                                                    order.status ===
                                                        'order dispatched' ||
                                                    order.status ===
                                                        'delivery in progress',
                                                'bg-dark-green':
                                                    order.status ===
                                                    'delivery completed',
                                            }"
                                        >
                                            {{ order.status }}
                                        </span>

                                        <div class="mobile-card-dropdown">
                                            <button
                                                type="button"
                                                class="btn btn-sm mobile-btn-sm"
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
                                                <button
                                                    class="
                                                        dropdown-item
                                                        mobile-dropdown-item
                                                    "
                                                    type="button"
                                                    @click.prevent="
                                                        viewModal(order)
                                                    "
                                                >
                                                    View Order
                                                </button>
                                                <button
                                                    class="
                                                        dropdown-item
                                                        mobile-dropdown-item
                                                    "
                                                    type="button"
                                                    @click.prevent="
                                                        newModal(order)
                                                    "
                                                >
                                                    View Items
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mb-4"
                                    v-if="
                                        statusUpdateActive(order.status) == true
                                    "
                                >
                                    <div class="mobile-card-sub-title">
                                        Update Status
                                    </div>
                                    <button
                                        @click.prevent="setCurrentStatus(order)"
                                        class="btn btn-sm mobile-btn-sm"
                                        title="Change status"
                                    >
                                        {{ nextStatus(order.status) }}
                                    </button>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        align-items-center
                                        mb-4
                                    "
                                >
                                    <div class="mr-5">
                                        <div class="mobile-card-sub-title">
                                            Total
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ order.total }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Items
                                        </div>
                                        <div
                                            class="mobile-card-body d-flex"
                                            v-for="parent_product in order.order_products"
                                        >
                                            <div class="fixed-title mr-4">
                                                {{
                                                    parent_product.product.title
                                                }}
                                            </div>
                                            <span class="mobile-card-price">{{
                                                parent_product.quantity
                                            }}</span>
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
                                    <div class="mr-3">
                                        <div class="mobile-card-sub-title">
                                            Dispatch Date
                                        </div>
                                        <div class="mobile-card-body">
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
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Delivery Date
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    order.delivery_date
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile View end -->

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
                            class="card dashboard-info-card mb-4"
                            v-for="(
                                parent_product, index
                            ) in current_order.order_products"
                        >
                            <!-- Header -->
                            <h4 class="mb-3">Item {{ index + 1 }}</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Title</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.title }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.code }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Quantity</div>
                                <div class="col-md-9">
                                    {{ parent_product.quantity }}
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-if="
                                    parent_product
                                        .order_product_giftbox_variations
                                        .length > 0
                                "
                            >
                                <div class="col-md-3 modal-label">
                                    Specification
                                </div>
                                <div class="col-md-9">
                                    <div
                                        v-for="item in parent_product.order_product_giftbox_variations"
                                    >
                                        {{ item.product.title }}
                                        :
                                        {{ item.quantity }}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="row mb-3"
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
                                <div class="col-md-3 modal-label">Total Amount</div>
                                <div class="col-md-9">
                                    {{ current_order.currency_code }}
                                    {{
                                        parent_product.total *
                                        parent_product.quantity
                                    }}
                                    <div class="darkgrey">
                                        {{
                                            parent_product.product
                                                .category_id == 7
                                                ? "Minimum Price"
                                                : "Base Price"
                                        }}
                                        {{ current_order.currency_code }}
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
                                        : + {{ current_order.currency_code }}
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
                            Order {{ current_order.code }}
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

                    <!-- Modal Body start -->
                    <div class="modal-body modal-view">
                        <div class="card dashboard-info-card">
                            <!-- Header -->
                            <h4 class="mb-3">Summary</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ current_order.code }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Order placed on
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(current_order.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Dispatch Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(current_order.delivery_date)
                                            .subtract(
                                                current_order.shipping
                                                    .delivery_time,
                                                "days"
                                            )
                                            .format("DD-MM-YYYY")
                                    }}
                                    9:30am
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Delivery Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_order.delivery_date
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Total</div>
                                <div class="col-md-9">
                                    {{ current_order.currency_code }}
                                    {{ current_order.total }}
                                    ({{
                                        current_order.current_exchange_rate
                                            ? `LKR ${
                                                  current_order.total /
                                                  current_order.current_exchange_rate
                                              }`
                                            : ""
                                    }})
                                    <div class="darkgrey">
                                        Subtotal:
                                        {{ current_order.subtotal }} +
                                    </div>
                                    <div class="darkgrey">
                                        Tax : {{ current_order.tax }} +
                                    </div>
                                    <div class="darkgrey">
                                        Shipping :
                                        {{ current_order.shipping_price }} +
                                    </div>
                                    <div class="darkgrey">
                                        Giftwrap :
                                        {{
                                            current_order.giftwrap_price
                                                ? current_order.giftwrap_price
                                                : "0.00"
                                        }}
                                        -
                                    </div>
                                    <div class="darkgrey">
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
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Order placed by</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Name</div>
                                <div class="col-md-9">
                                    {{
                                        current_order.first_name +
                                        " " +
                                        current_order.last_name
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Email</div>
                                <div class="col-md-9">
                                    {{ current_order.email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Phone</div>
                                <div class="col-md-9">
                                    {{ current_order.phone }}
                                </div>
                            </div>
                        </div>
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Recipient Customer Details</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Name</div>
                                <div class="col-md-9">
                                    {{
                                        current_order.recipient_first_name +
                                        " " +
                                        current_order.recipient_last_name
                                    }}
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-show="current_order.recipient_email"
                            >
                                <div class="col-md-3 modal-label">Email</div>
                                <div class="col-md-9">
                                    {{ current_order.recipient_email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Phone</div>
                                <div class="col-md-9">
                                    {{ current_order.recipient_phone }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="card dashboard-info-card mt-4"
                            v-for="(
                                parent_product, index
                            ) in current_order.order_products"
                        >
                            <!-- Header -->
                            <h4 class="mb-3">Item {{ index + 1 }}</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Title</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.title }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ parent_product.product.code }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Quantity</div>
                                <div class="col-md-9">
                                    {{ parent_product.quantity }}
                                </div>
                            </div>
                            <div
                                class="row mb-3"
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
                                    {{ current_order.currency_code }}
                                    {{
                                        parent_product.total *
                                        parent_product.quantity
                                    }}
                                    <div class="darkgrey">
                                        Base Price :
                                        {{ current_order.currency_code }}
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
                                        : + {{ current_order.currency_code }}
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
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 500),
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

        statusUpdateActive(status) {
            if (
                status == "not acknowledged" ||
                status == "acknowledged" ||
                status == "in production"
            ) {
                return true;
            } else {
                return false;
            }
        },

        nextStatus(status) {
            switch (status) {
                case "not acknowledged":
                    return "acknowledge";
                    break;
                case "acknowledged":
                    return "in production";
                    break;
                case "in production":
                    return "ready for delivery";
                    break;
            }
        },

        setCurrentStatus(order) {
            switch (order.status) {
                case "":
                    this.form.status = "acknowledged";
                    break;
                case "not acknowledged":
                    this.form.status = "acknowledged";
                    break;
                case "acknowledged":
                    this.form.status = "in production";
                    break;
                case "in production":
                    this.form.status = "ready for delivery";
                    break;
            }

            if (confirm("Are you sure you want to change order status?")) {
                this.form
                    .put("/api/seller/orders/" + order.id)
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
