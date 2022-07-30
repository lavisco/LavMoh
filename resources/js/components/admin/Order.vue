<template>
    <div>
        <!-- Header -->
        <div class="header bg-blue pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-4 col-7">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        ><i class="ni ni-zoom-split-in"></i
                                    ></span>
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
                        <div class="col-lg-3 col-5 text-right">
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
            </div>
        </div>

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
                                        <th scope="col" class="table-col-lg">
                                            Date
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Seller
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Items
                                        </th>
                                        <th scope="col" class="table-col-sm">
                                            Amount
                                        </th>
                                        <th scope="col" class="table-col-lg">
                                            Status
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
                                                <div
                                                    class="
                                                        badge badge-pill
                                                        bg-light
                                                    "
                                                >
                                                    Dispatch
                                                </div>
                                                <br />
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
                                                <div
                                                    class="
                                                        badge badge-pill
                                                        bg-light
                                                    "
                                                >
                                                    Delivery
                                                </div>
                                                <br />
                                                {{
                                                    moment(
                                                        order.delivery_date
                                                    ).format("DD-MM-YYYY")
                                                }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ order.seller.shop.name }}
                                            <p class="text-sm mt-2">
                                                {{ order.seller.name }}
                                            </p>
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
                                        </td>
                                        <td>
                                            {{ order.currency_code }}
                                            {{ order.total }}
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
                                                    setCurrentStatus(
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
                                                <option value="acknowledged">
                                                    acknowledged
                                                </option>
                                                <option value="in production">
                                                    in production
                                                </option>
                                                <option
                                                    value="ready for delivery"
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
                                                >
                                                    delivery completed
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
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            viewModal(order)
                                                        "
                                                    >
                                                        View
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editModal(order)
                                                        "
                                                    >
                                                        Edit
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
                            @paginate="loadOrders()"
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
                            Update the Order
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            View Order {{ current_order.code }}
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

                    <!-- Current Order View start -->

                    <div class="modal-body" v-show="!editMode">
                        <div class="card p-3">
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
                                <div class="col-md-3 modal-label">Status</div>
                                <div class="col-md-9">
                                    {{ current_order.status }}
                                </div>
                            </div>
                            <div class="row mb-3" v-if="current_order.seller">
                                <div class="col-md-3 modal-label">Seller</div>
                                <div class="col-md-9">
                                    {{ current_order.seller.shop.name }}
                                    <div class="text-sm mt-2">
                                        {{ current_order.seller.name }}
                                    </div>
                                    <div class="text-sm mt-2">
                                        {{ current_order.seller.email }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Buyer</div>
                                <div class="col-md-9">
                                    {{ current_order.buyer_id }}
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
                                <div
                                    class="col-md-9"
                                    v-if="current_order.shipping"
                                >
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
                            <div class="row mb-3" v-if="current_order.shipping">
                                <div class="col-md-3 modal-label">
                                    Shipping Method
                                </div>
                                <div class="col-md-9">
                                    {{ current_order.shipping.type }}
                                    <div class="text-sm mt-2">
                                        LKR {{ current_order.shipping.price }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Total</div>
                                <div class="col-md-9">
                                    {{ current_order.currency_code }}
                                    {{ current_order.total }}
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
                        <div class="card p-3 mt-4">
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
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Billing Address
                                </div>
                                <div class="col-md-9">
                                    {{
                                        current_order.billing_address_line_one
                                    }},
                                    {{
                                        current_order.billing_address_line_two
                                    }}, {{ current_order.billing_zipcode }},
                                    {{ current_order.billing_city }} <br />
                                    {{ current_order.billing_district }},
                                    {{ current_order.billing_state }},
                                    {{ current_order.billing_country }}
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mt-4">
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
                            <div class="row mb-3">
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
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Address</div>
                                <div class="col-md-9">
                                    {{ current_order.address_line_one }},
                                    {{ current_order.address_line_two }},
                                    {{ current_order.zipcode }},
                                    {{ current_order.city }} <br />
                                    {{ current_order.district }},
                                    {{ current_order.state }},
                                    {{ current_order.country }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="card p-3 mt-4"
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
                    <div class="modal-footer pt-0" v-show="!editMode">
                        <button
                            v-show="!editMode"
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

                    <!-- Current Order View end -->

                    <!-- Form start -->

                    <form
                        v-show="editMode"
                        class="input-form"
                        @submit.prevent="updateOrder()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="first_name"
                                    >First Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        name="first_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="first_name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="last_name"
                                    >Last Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        name="last_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="last_name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="email"
                                    >Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="phone"
                                    >Phone
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="phone"
                                        v-model="form.phone"
                                        type="text"
                                        name="phone"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="phone" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="recipient_first_name"
                                    >Recipient's First Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="recipient_first_name"
                                        v-model="form.recipient_first_name"
                                        type="text"
                                        name="recipient_first_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_first_name"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="recipient_last_name"
                                    >Recipient's Last Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="recipient_last_name"
                                        v-model="form.recipient_last_name"
                                        type="text"
                                        name="recipient_last_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_last_name"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="recipient_email"
                                    >Recipient's Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="recipient_email"
                                        v-model="form.recipient_email"
                                        type="email"
                                        name="recipient_email"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_email"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="recipient_phone"
                                    >Recipient's Phone
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="recipient_phone"
                                        v-model="form.recipient_phone"
                                        type="text"
                                        name="recipient_phone"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="recipient_phone"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="country"
                                    >Country
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="country"
                                        v-model="form.country"
                                        type="text"
                                        name="country"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="country" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="address_line_one"
                                    >Address line 1
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="address_line_one"
                                        v-model="form.address_line_one"
                                        type="text"
                                        name="address_line_one"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="address_line_one"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="address_line_two"
                                    >Address line 2
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="address_line_two"
                                        v-model="form.address_line_two"
                                        type="text"
                                        name="address_line_two"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="address_line_two"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="zipcode"
                                    >zipcode
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="zipcode"
                                        v-model="form.zipcode"
                                        type="text"
                                        name="zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="zipcode" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="city"
                                    >city
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="city"
                                        v-model="form.city"
                                        type="text"
                                        name="city"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="city" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="district"
                                    >district
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="district"
                                        v-model="form.district"
                                        type="text"
                                        name="district"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="district" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="state"
                                    >state
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="state"
                                        v-model="form.state"
                                        type="text"
                                        name="state"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="state" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing country"
                                    >billing_country
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_country"
                                        v-model="form.billing_country"
                                        type="text"
                                        name="billing_country"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_country"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_address_line_one"
                                    >billing address line 1
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_address_line_one"
                                        v-model="form.billing_address_line_one"
                                        type="text"
                                        name="billing_address_line_one"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_address_line_one"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_address_line_two"
                                    >billing address line 2
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_address_line_two"
                                        v-model="form.billing_address_line_two"
                                        type="text"
                                        name="billing_address_line_two"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_address_line_two"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_zipcode"
                                    >billing zipcode
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_zipcode"
                                        v-model="form.billing_zipcode"
                                        type="text"
                                        name="billing_zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_zipcode"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_city"
                                    >billing city
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_city"
                                        v-model="form.billing_city"
                                        type="text"
                                        name="billing_city"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_city"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_district"
                                    >billing district
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_district"
                                        v-model="form.billing_district"
                                        type="text"
                                        name="billing_district"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_district"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="billing_state"
                                    >billing state
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="billing_state"
                                        v-model="form.billing_state"
                                        type="text"
                                        name="billing_state"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="billing_state"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="currency_code"
                                    >Currency Code
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="currency_code"
                                        v-model="form.currency_code"
                                        type="text"
                                        name="currency_code"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="currency_code"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="current_exchange_rate"
                                    >Exchange rate
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="current_exchange_rate"
                                        v-model="form.current_exchange_rate"
                                        type="text"
                                        name="current_exchange_rate"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="current_exchange_rate"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="delivery date"
                                    >delivery date
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="delivery_date"
                                        v-model="form.delivery_date"
                                        type="date"
                                        name="delivery_date"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="delivery_date"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="total"
                                    >total
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
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

                                <label
                                    class="col-md-3 col-form-label"
                                    for="subtotal"
                                    >subtotal
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <input
                                        id="subtotal"
                                        v-model="form.subtotal"
                                        type="text"
                                        name="subtotal"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="subtotal" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="tax"
                                    >tax
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <input
                                        id="tax"
                                        v-model="form.tax"
                                        type="text"
                                        name="tax"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="tax" />
                                </div>

                                <label
                                    class="col-md-3 col-form-label"
                                    for="giftwrap_price"
                                    >giftwrap price
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <input
                                        id="giftwrap_price"
                                        v-model="form.giftwrap_price"
                                        type="text"
                                        name="giftwrap_price"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="giftwrap_price"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="shipping_price"
                                    >shipping price
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <input
                                        id="shipping_price"
                                        v-model="form.shipping_price"
                                        type="text"
                                        name="shipping_price"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="shipping_price"
                                    />
                                </div>

                                <label
                                    class="col-md-3 col-form-label"
                                    for="discount_price"
                                    >discount price
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <input
                                        id="discount_price"
                                        v-model="form.discount_price"
                                        type="text"
                                        name="discount_price"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="discount_price"
                                    />
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
        editMode: false,
        parent_product: "",
        parent_product_mode: false,
        current_order: "",
        current_order_mode: false,
        form: new Form({
            id: "",
            status: "",
            code: "",
            first_name: "",
            last_name: "",
            email: "",
            phone: "",

            address_line_one: "",
            address_line_two: "",
            zipcode: "",
            city: "",
            district: "",
            state: "",
            country: "",

            recipient_first_name: "",
            recipient_last_name: "",
            recipient_email: "",
            recipient_phone: "",

            billing_address_line_one: "",
            billing_address_line_two: "",
            billing_zipcode: "",
            billing_city: "",
            billing_district: "",
            billing_state: "",
            billing_country: "",

            currency_code: "",
            current_exchange_rate: "",
            delivery_date: "",
            total: "",
            subtotal: "",
            tax: "",
            giftwrap_price: "",
            shipping_price: "",
            discount_price: "",

            shop_id: "",
            shipping_id: "",
            discount_id: "",
            giftwrap_id: "",
            seller_id: "",
            buyer_id: "",
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        statusFilter(after, before) {
            Fire.$emit("reloadRecords");
        },
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        viewModal(order) {
            this.editMode = false;
            this.current_order = order;
            $("#addRecord").modal("show");
        },

        editModal(order) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(order);
        },

        setCurrentStatus(order, event) {
            if (confirm("Are you sure you want to change order status?")) {
                this.form.status = event.target.value;
                this.form
                    .put("/api/admin/orders/updateStatus/" + order)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        loadOrders() {
            axios
                .get("/api/admin/orders?page=" +
                        this.pagination.current_page, {
                    params: {
                        searchText: this.searchText,
                        statusFilter: this.statusFilter,
                    },
                })
                .then(({ data }) => {
                    this.orders = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        deleteOrder(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/orders/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateOrder() {
            this.form
                .put("/api/admin/orders/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadOrders();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadOrders();
        });
    },
};
</script>
