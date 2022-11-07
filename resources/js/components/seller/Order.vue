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
                                    <option value="">Filter by status</option>
                                    <option
                                        v-for="orderState in orderStates"
                                        :value="orderState.id"
                                    >
                                        {{ orderState.state }}
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
                                        <th scope="col">Code</th>
                                        <th scope="col" class="table-col-lg">
                                            Date Timeline
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Items
                                        </th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Update Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr v-for="order in orders">
                                        <td>
                                            {{ order.code }}
                                            <br />
                                            <span
                                                class="
                                                    badge badge-pill
                                                    bg-purple
                                                    white
                                                "
                                                :class="{
                                                    'bg-orange':
                                                        order.order_state_id ===
                                                        2,
                                                    'bg-yellow':
                                                        order.order_state_id ===
                                                        3,
                                                    'bg-purple':
                                                        order.order_state_id ===
                                                        4,
                                                    'bg-brown':
                                                        order.order_state_id ===
                                                        5,
                                                    'bg-blue':
                                                        order.order_state_id ===
                                                        6,
                                                    'bg-green':
                                                        order.order_state_id ===
                                                        7,
                                                }"
                                            >
                                                {{ order.order_state.state }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="timeline-card">
                                                <div class="name">
                                                    Ordered
                                                </div>
                                                {{
                                                moment(order.created_at).format(
                                                        "DD-MM-YYYY"
                                                    )
                                                }}
                                            </div>
                                            <div class="timeline-card">
                                                <div class="name">
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
                                            </div>
                                            <div class="timeline-card">
                                                <div class="name">
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
                                                        align-items-center
                                                        mb-1
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
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        aria-hidden="true"
                                                        role="img"
                                                        width="17"
                                                        height="17"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        viewBox="0 0 20 20"
                                                        class="mr-2"
                                                    >
                                                        <g
                                                            transform="rotate(45 10 10)"
                                                        >
                                                            <path
                                                                fill="#707070"
                                                                d="M10.5 2.75a.75.75 0 0 0-1.5 0V9H2.75a.75.75 0 0 0 0 1.5H9v6.25a.75.75 0 0 0 1.5 0V10.5h6.25a.75.75 0 0 0 0-1.5H10.5V2.75Z"
                                                            />
                                                        </g>
                                                    </svg>
                                                    {{
                                                        parent_product.quantity
                                                    }}
                                                </div>
                                            </div>
                                            <a
                                                @click.prevent="newModal(order)"
                                                class="dashboard-link-sm mt-2"
                                            >
                                                View Items
                                            </a>
                                        </td>
                                        <td>
                                            {{ order.currency_code }}
                                            {{ order.total }}
                                        </td>
                                        <td>
                                            <button
                                                @click.prevent="
                                                    setCurrentStatus(order)
                                                "
                                                class="btn-sm btn-fit-text"
                                                title="Change status"
                                                v-if="
                                                    statusUpdateActive(
                                                        order.order_state_id
                                                    ) == true
                                                "
                                            >
                                                {{
                                                    nextStatus(
                                                        order.order_state_id
                                                    )
                                                }}
                                            </button>
                                            <p v-else>Lavisco is shipping</p>
                                        </td>
                                        <td class="text-right">
                                            <a
                                                class="btn-sm"
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
                                v-for="order in orders"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        align-items-center
                                        mb-3
                                    "
                                >
                                    <div>
                                        <div class="mobile-card-body">
                                            {{ order.code }}
                                        </div>
                                        <h5 class="text-left mb-0">
                                            Rs {{ order.total }}
                                        </h5>
                                    </div>

                                    <span
                                        class="badge-special"
                                        :class="{
                                            'bg-orange':
                                                order.order_state_id === 2,
                                            'bg-yellow':
                                                order.order_state_id === 3,
                                            'bg-purple':
                                                order.order_state_id === 4,
                                            'bg-brown':
                                                order.order_state_id === 5,
                                            'bg-blue':
                                                order.order_state_id === 6,
                                            'bg-green':
                                                order.order_state_id === 7,
                                        }"
                                    >
                                        {{ order.order_state.state }}
                                    </span>
                                </div>

<div
                                    class="
                                        d-flex
                                        flex-row
                                        align-items-center
                                        justify-content-between
                                        mb-3
                                    "
                                >
                                    <div class="mr-3 text-center">
                                        <div class="mobile-card-chip">
                                            Ordered on
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    order.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                    <div class="mr-3 text-center">
                                        <div class="mobile-card-chip">
                                            Dispatch
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
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-chip">
                                            Delivery
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
                                
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-3
                                    "
                                >
                                    <div class="mr-5">
                                        <div class="mobile-card-sub-title">
                                            Items
                                        </div>
                                        <div
                                            class="mobile-card-body d-flex"
                                            v-for="parent_product in order.order_products"
                                        >
                                            <span
                                                class="mobile-card-price mr-2"
                                            >
                                                {{ parent_product.quantity }} x
                                            </span>
                                            <div class="fixed-title">
                                                {{
                                                    parent_product.product.title
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Total
                                        </div>
                                        <div class="mobile-card-body">
                                            Rs {{ order.total }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-row">
                                    <div
                                        v-if="
                                            statusUpdateActive(
                                                order.order_state_id
                                            ) == true
                                        "
                                        class="mr-3"
                                    >
                                        <div class="mobile-card-sub-title">
                                            Update Status
                                        </div>
                                        <button
                                            @click.prevent="
                                                setCurrentStatus(order)
                                            "
                                            class="btn-sm"
                                            title="Change status"
                                        >
                                            {{
                                                nextStatus(order.order_state_id)
                                            }}
                                        </button>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Actions
                                        </div>
                                        <a
                                            class="btn-sm"
                                            href="#"
                                            @click.prevent="viewModal(order)"
                                        >
                                            View
                                        </a>
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
                            @paginate="loadOrders()"
                        ></pagination>

                        <!-- Pagination end -->

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
                    <div class="modal-header">
                        <h4 class="modal-title" id="addRecordLabel">
                            Item Summary of Order #{{ current_order.code }}
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
                                v-if="parent_product.custom_text"
                            >
                                <div class="col-md-3 modal-label">
                                    Custom Message
                                </div>
                                <div class="col-md-9">
                                    {{ parent_product.custom_text }}
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
                                <div class="col-md-3 modal-label">
                                    Total Amount
                                </div>
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
                            class="btn"
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
                    <div class="modal-header">
                        <h4 class="modal-title" id="addRecordLabel">
                            Order {{ current_order.code }}
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
                                v-if="parent_product.custom_text"
                            >
                                <div class="col-md-3 modal-label">
                                    Custom Message
                                </div>
                                <div class="col-md-9">
                                    {{ parent_product.custom_text }}
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
        orders: [],
        orderStates: [],
        searchText: null,
        statusFilter: "",
        loading: true,
        parent_product: "",
        parent_product_mode: false,
        current_order: "",
        current_order_mode: false,
        form: new Form({
            id: "",
            order_state_id: "",
        }),
        pagination: { current_page: 1 },
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
                .get(
                    "/api/seller/orders?page=" + this.pagination.current_page,
                    {
                        params: {
                            searchText: this.searchText,
                            statusFilter: this.statusFilter,
                        },
                    }
                )
                .then(({ data }) => {
                    this.orders = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadOrderStates() {
            axios
                .get("/api/seller/order_states")
                .then(({ data }) => {
                    this.orderStates = data;
                })
                .catch((error) => console.log(error));
        },

        statusUpdateActive(state_id) {
            if (state_id == 2 || state_id == 3) {
                return true;
            } else {
                return false;
            }
        },

        nextStatus(state_id) {
            switch (state_id) {
                case 2:
                    return "Start Production";
                    break;
                case 3:
                    return "Ready for Delivery";
                    break;
            }
        },

        setCurrentStatus(order) {
            /*
            1 -Pending Order
            2 -Accept & Start Production -org
            3 -In Production -yel
            4 -Ready for Delivery -pur
            5 -Order Dispatched -brown
            6 -Delivery in Progress -blu
            7 -Order Delivered -grn
            */

            switch (order.order_state_id) {
                case 2:
                    this.form.order_state_id = 3;
                    break;
                case 3:
                    this.form.order_state_id = 4;
                    break;
            }

            if (confirm("Are you sure you want to change order status?")) {
                this.form
                    .put("/api/seller/orders/" + order.id)
                    .then(() => {
                        if (order.order_state_id == 3) {
                            this.sendBuyerOrderProductionMail(order.id);
                        }
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
        sendBuyerOrderProductionMail(orderId) {
            axios
                .get("/api/email/buyer_order_production/" + orderId)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.loadOrders();
        this.loadOrderStates();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadOrders();
        });
    },
};
</script>
