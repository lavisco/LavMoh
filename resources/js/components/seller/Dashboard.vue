<template>
    <div>
        <!-- Body -->
        <div class="container-fluid">
            <div class="col no-padding-sm">
                <div class="row">
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm h-100">
                            <h4 class="mb-0">Total Products</h4>
                            <h6 class="mb-3">All time</h6>

                            <div
                                class="
                                    d-flex
                                    flex-row
                                    align-items-end
                                    justify-content-between
                                "
                            >
                                <h2>{{ productCount }}</h2>
                                <router-link
                                    class="dashboard-link-sm"
                                    to="/seller/products"
                                >
                                    View
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm h-100">
                            <h4 class="mb-0">New Orders</h4>
                            <h6 class="mb-3">This month</h6>
                            <div
                                class="
                                    d-flex
                                    flex-row
                                    align-items-end
                                    justify-content-between
                                "
                            >
                                <h2>{{ orderCount }}</h2>
                                <router-link
                                    class="dashboard-link-sm"
                                    to="/seller/orders"
                                >
                                    View
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm h-100">
                            <h4 class="mb-0">Total Revenue</h4>
                            <h6 class="mb-3">This month</h6>
                            <div
                                class="
                                    d-flex
                                    flex-row
                                    align-items-end
                                    justify-content-between
                                "
                            >
                                <h2>{{ revenue }}</h2>
                                <router-link
                                    class="dashboard-link-sm"
                                    to="/seller/transactions"
                                >
                                    View
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card dashboard-card-sm">
                            <h4 class="mb-0">Add Product</h4>
                            <h6 class="mb-3">Quick listing</h6>
                            <router-link to="/seller/products/listing">
                                <button
                                    type="button"
                                    class="btn btn-sm mobile-add-btn"
                                >
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Product
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col my-4 no-padding-sm">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm">
                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    mb-3
                                    align-items-center
                                "
                            >
                                <div>
                                    <h4 class="mb-0">Latest Products</h4>
                                    <router-link
                                        class="dashboard-link-sm"
                                        to="/seller/products"
                                    >
                                        View
                                    </router-link>
                                </div>
                                <router-link to="/seller/products/listing">
                                    <button
                                        type="button"
                                        class="
                                            btn btn-sm btn-primary
                                            mobile-add-btn
                                        "
                                    >
                                        Add
                                    </button>
                                </router-link>
                            </div>

                            <!-- Table start -->
                            <div
                                class="
                                    table-responsive
                                    dashboard-table
                                    vertical-scroll
                                "
                            >
                                <table
                                    class="table align-items-center table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Title</th>
                                            <th
                                                scope="col"
                                                class="hide-content-sm"
                                            >
                                                Price
                                            </th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in products">
                                            <td>
                                                <img
                                                    class="
                                                        banner-container-xs
                                                        mr-2
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
                                                <div class="hide-content">
                                                    {{ product.base_price }}
                                                </div>
                                            </td>
                                            <td class="hide-content-sm">
                                                {{ product.base_price }}
                                            </td>
                                            <td class="text-right">
                                                <router-link
                                                    :to="{
                                                        name: 'seller/products/listing/edit',
                                                        params: {
                                                            productId:
                                                                product.id,
                                                        },
                                                    }"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        aria-hidden="true"
                                                        role="img"
                                                        width="20px"
                                                        height="20px"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <g
                                                            fill="none"
                                                            stroke="#4e4e4e"
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
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table end -->
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="dashboard-card dashboard-card-sm">
                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    mb-3
                                    align-items-center
                                "
                            >
                                <div>
                                    <h4 class="mb-0">Latest Orders</h4>
                                    <router-link
                                        class="dashboard-link-sm"
                                        to="/seller/orders"
                                    >
                                        View
                                    </router-link>
                                </div>
                            </div>
                            <!-- Table start -->
                            <div
                                class="
                                    table-responsive
                                    dashboard-table
                                    vertical-scroll
                                "
                            >
                                <table
                                    class="table align-items-center table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col">Code</th>
                                            <th scope="col">Dispatch</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="order in orders">
                                            <td>
                                                {{ order.code }}
                                            </td>
                                            <td>
                                                {{
                                                    moment(
                                                        order.delivery_date
                                                    ).format("DD-MM-YYYY")
                                                }}
                                            </td>
                                            <td>{{ order.total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table end -->
                        </div>
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
            data-backdrop="static"
            data-keyboard="false"
        >
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content shop-setup">
                    <!-- Form start -->
                    <div class="modal-body">
                        <div class="d-flex flex-md-row flex-column">
                            <div class="col-md-3 shop-setup-menu">
                                <h3 class="text-left white mb-4">
                                    Activation Form
                                </h3>
                                <p class="mb-4 white">
                                    Please fill out the form to setup your shop.
                                    Start selling today!
                                </p>

                                <h4 :class="{ pink: part1, white: part2 }">
                                    <div class="form-number mr-2">1</div>
                                    Your Details
                                </h4>
                                <h4 :class="{ red: part2, white: part1 }">
                                    <div class="form-number mr-2">2</div>
                                    Store Details
                                </h4>

                                <button
                                    type="button"
                                    class="
                                        btn-sm btn-sm-cart btn-sm-black btn-full
                                        white
                                        mt-4
                                    "
                                    @click.prevent="logout"
                                >
                                    Cancel
                                </button>
                            </div>
                            <div class="col-md-9 shop-setup-content">
                                <!-- Form start -->
                                <form
                                    class="input-form h-100"
                                    @submit.prevent="createSellerprofile()"
                                >
                                    <div
                                        class="input-form-compact"
                                        v-show="part1"
                                    >
                                        <h3 class="text-left mb-0">
                                            Your Details
                                        </h3>

                                        <!-- Contact -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-3
                                            "
                                        >
                                            <h4 class="mb-3">
                                                Contact Details
                                            </h4>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="first_name"
                                                        >First Name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="first_name"
                                                        v-model="
                                                            form.first_name
                                                        "
                                                        type="text"
                                                        name="first_name"
                                                        class="form-control"
                                                        placeholder="First Name"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="first_name"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="last_name"
                                                        >Last Name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="last_name"
                                                        v-model="form.last_name"
                                                        type="text"
                                                        name="last_name"
                                                        class="form-control"
                                                        placeholder="Last Name"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="last_name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="phone"
                                                        >Phone
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="phone"
                                                        v-model="form.phone"
                                                        type="text"
                                                        name="phone"
                                                        class="form-control"
                                                        placeholder="Phone"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="phone"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="email"
                                                        >Email
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <input
                                                        id="email"
                                                        v-model="form.email"
                                                        type="email"
                                                        name="email"
                                                        class="
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        placeholder="Email"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="email"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-2">Your Address</h4>
                                            <p class="text-xs mb-3">
                                                Please make sure you add the
                                                most recent address.
                                            </p>

                                            <div class="row">
                                                <div
                                                    class="form-group col-md-12"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="address"
                                                        >Address
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="address"
                                                        v-model="form.address"
                                                        type="text"
                                                        name="address"
                                                        class="form-control"
                                                        placeholder="Address"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="address"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="city"
                                                        >City
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="city"
                                                        v-model="form.city"
                                                        name="city"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select City
                                                        </option>
                                                        <option
                                                            v-for="city in cities"
                                                            :value="city.name"
                                                        >
                                                            {{ city.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="city"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="zipcode"
                                                        >Zip Code
                                                    </label>
                                                    <input
                                                        id="zipcode"
                                                        v-model="form.zipcode"
                                                        type="text"
                                                        name="zipcode"
                                                        class="
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        placeholder="Zip code"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="zipcode"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bank Details -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                my-4
                                            "
                                        >
                                            <h4 class="mb-2">
                                                Your Earnings Deposit Bank
                                                Account
                                            </h4>
                                            <p class="text-xs mb-3">
                                                Please make sure the details you
                                                provide is accurate and updated.
                                                All payments will be made weekly
                                                into this account and lavisco.lk
                                                will not deposit into any other
                                                accounts not stated below
                                            </p>

                                            <div class="row">
                                                <div
                                                    class="form-group col-md-8"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="deposit_account"
                                                        >Account no.
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="deposit_account"
                                                        v-model="
                                                            form.deposit_account
                                                        "
                                                        type="text"
                                                        name="deposit_account"
                                                        class="form-control"
                                                        placeholder="deposit account no."
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="deposit_account"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-4"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="deposit_account_status"
                                                        >Status
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <div>
                                                        <div
                                                            class="
                                                                custom-control
                                                                custom-radio
                                                                custom-control-inline
                                                            "
                                                        >
                                                            <input
                                                                type="radio"
                                                                id="status1"
                                                                name="deposit_account_status"
                                                                class="
                                                                    custom-control-input
                                                                "
                                                                v-model="
                                                                    form.deposit_account_status
                                                                "
                                                                value="1"
                                                            />
                                                            <label
                                                                class="
                                                                    custom-control-label
                                                                "
                                                                for="status1"
                                                                >Active</label
                                                            >
                                                        </div>
                                                        <div
                                                            class="
                                                                custom-control
                                                                custom-radio
                                                                custom-control-inline
                                                            "
                                                        >
                                                            <input
                                                                type="radio"
                                                                id="status2"
                                                                name="deposit_account_status"
                                                                class="
                                                                    custom-control-input
                                                                "
                                                                v-model="
                                                                    form.deposit_account_status
                                                                "
                                                                value="0"
                                                            />
                                                            <label
                                                                class="
                                                                    custom-control-label
                                                                "
                                                                for="status2"
                                                                >Inactive</label
                                                            >
                                                        </div>
                                                    </div>

                                                    <HasError
                                                        :form="form"
                                                        field="deposit_account_status"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-12"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="deposit_name"
                                                        >Account Name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="deposit_name"
                                                        v-model="
                                                            form.deposit_name
                                                        "
                                                        type="text"
                                                        name="deposit_name"
                                                        class="form-control"
                                                        placeholder="deposit account name"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="deposit_name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="deposit_bank"
                                                        >Bank name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="deposit_bank"
                                                        v-model="
                                                            form.deposit_bank
                                                        "
                                                        type="text"
                                                        name="deposit_bank"
                                                        class="form-control"
                                                        placeholder="Deposit bank name"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="deposit_bank"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="deposit_bank_branch"
                                                        >Branch name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="deposit_bank_branch"
                                                        v-model="
                                                            form.deposit_bank_branch
                                                        "
                                                        type="text"
                                                        name="deposit_bank_branch"
                                                        class="form-control"
                                                        placeholder="Deposit bank branch"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="deposit_bank_branch"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fail alert -->
                                        <div
                                            class="
                                                alert
                                                alert-danger
                                                alert-dismissible
                                                fade
                                                show
                                            "
                                            v-show="failed"
                                            role="alert"
                                        >
                                            Please re-check the form. There are
                                            errors in your input.
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="alert"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>

                                        <!-- Button -->
                                        <div
                                            class="
                                                d-flex
                                                justify-content-end
                                                mt-4
                                            "
                                        >
                                            <button
                                                type="button"
                                                class="btn"
                                                @click.prevent="
                                                    validateSellerprofile()
                                                "
                                            >
                                                Next
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Store -->
                                    <div
                                        class="input-form-compact"
                                        v-show="part2"
                                    >
                                        <h3 class="text-left mb-0">
                                            Your Store Details
                                        </h3>

                                        <!-- Info -->

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-3
                                            "
                                        >
                                            <h4 class="mb-2">
                                                Store Setup Information
                                            </h4>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_name"
                                                        >Store Name
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="shop_name"
                                                        v-model="form.shop_name"
                                                        type="text"
                                                        name="shop_name"
                                                        class="form-control"
                                                        placeholder="Store Name"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="shop_name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for="about"
                                                        >About
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                        <p
                                                            class="
                                                                text-xs
                                                                mt-2
                                                                mb-1
                                                            "
                                                        >
                                                            Maximum 500
                                                            characters. Tell
                                                            buyers more about
                                                            your store, for
                                                            example your store
                                                            history, goals, and
                                                            what kind of
                                                            products you sell,
                                                            this will entice
                                                            buyers and establish
                                                            a sense of trust.
                                                        </p>
                                                    </label>

                                                    <textarea
                                                        id="about"
                                                        class="form-control"
                                                        name="about"
                                                        rows="3"
                                                        cols="50"
                                                        v-model="form.about"
                                                    >
                                                    </textarea>

                                                    <HasError
                                                        :form="form"
                                                        field="about"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for="banner"
                                                        >Upload logo
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                        <p
                                                            class="
                                                                text-xs
                                                                mt-2
                                                                mb-1
                                                            "
                                                        >
                                                            Image must be under
                                                            2MB.
                                                        </p>
                                                    </label>
                                                    <div
                                                        class="
                                                            mb-2
                                                            logo-upload-box
                                                        "
                                                        :style="{
                                                            'background-image':
                                                                'url(' +
                                                                url +
                                                                ')',
                                                        }"
                                                        @click.prevent="
                                                            $refs.fileInput.click()
                                                        "
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48"
                                                            height="48"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            viewBox="0 0 20 20"
                                                            v-show="!url"
                                                        >
                                                            <path
                                                                fill="#dd1e50"
                                                                d="M10 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-4-2a.5.5 0 0 0-1 0V5H3.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V6h1.5a.5.5 0 0 0 0-1H6V3.5Zm8 .5h-3.207a5.466 5.466 0 0 0-.393-1H14a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-3.6c.317.162.651.294 1 .393V14c0 .373.102.722.28 1.02l4.669-4.588a1.5 1.5 0 0 1 2.102 0l4.67 4.588A1.99 1.99 0 0 0 16 14V6a2 2 0 0 0-2-2Zm0 3.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm-1 0a.5.5 0 1 0-1 0a.5.5 0 0 0 1 0Zm-8.012 8.226A1.99 1.99 0 0 0 6 16h8c.37 0 .715-.1 1.012-.274l-4.662-4.58a.5.5 0 0 0-.7 0l-4.662 4.58Z"
                                                            />
                                                        </svg>
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48"
                                                            height="48"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            viewBox="0 0 20 20"
                                                            v-show="url"
                                                        >
                                                            <path
                                                                fill="#333333"
                                                                d="M5.5 10a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9Zm-2-5h-.005A.5.5 0 0 1 3 4.372V3a.5.5 0 0 1 1 0v.195a2.75 2.75 0 1 1-.55 4.139a.5.5 0 0 1 .745-.667A1.75 1.75 0 1 0 4.597 4H5a.5.5 0 0 1 0 1H3.5ZM3 10.4c.317.162.651.294 1 .393V14c0 .373.102.722.28 1.02l4.669-4.588a1.5 1.5 0 0 1 2.102 0l4.67 4.588A1.99 1.99 0 0 0 16 14V6a2 2 0 0 0-2-2h-3.207a5.466 5.466 0 0 0-.393-1H14a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-3.6Zm11-2.9a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm-1 0a.5.5 0 1 0-1 0a.5.5 0 0 0 1 0Zm-8.012 8.226A1.99 1.99 0 0 0 6 16h8c.37 0 .715-.1 1.012-.274l-4.662-4.58a.5.5 0 0 0-.7 0l-4.662 4.58Z"
                                                            />
                                                        </svg>
                                                        <p
                                                            class="
                                                                text-xs
                                                                mt-4
                                                                mb-0
                                                            "
                                                        >
                                                            {{
                                                                form.photoName
                                                                    ? ``
                                                                    : `Select image by`
                                                            }}
                                                            <br />
                                                            <strong>{{
                                                                form.photoName
                                                                    ? ``
                                                                    : `clicking here`
                                                            }}</strong>
                                                        </p>
                                                    </div>
                                                    <input
                                                        type="file"
                                                        style="display: none"
                                                        @change.prevent="
                                                            fileSelected
                                                        "
                                                        ref="fileInput"
                                                        name="banner"
                                                    />
                                                    <p class="text-xs mt-0">
                                                        {{
                                                            form.photoName
                                                                ? `You have selected ${form.photoName}. To change image, click on the above box.`
                                                                : `Click on the above box to select image.`
                                                        }}
                                                    </p>
                                                    <HasError
                                                        :form="form"
                                                        field="banner"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Shipping -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-2 mb-3">
                                                Available Shipping Options
                                            </h4>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for=""
                                                    >
                                                        Shipping types
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                        <p
                                                            class="
                                                                text-grey
                                                                text-xs
                                                                mt-2
                                                            "
                                                        >
                                                            Select the shipping
                                                            options you provide.
                                                        </p>
                                                    </label>
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
                                                                        class="
                                                                            tiny-col
                                                                        "
                                                                    ></th>
                                                                    <th
                                                                        scope="col"
                                                                    >
                                                                        Type
                                                                        Details
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr
                                                                    v-for="shipping in shippings"
                                                                >
                                                                    <th
                                                                        scope="row"
                                                                    >
                                                                        <input
                                                                            type="checkbox"
                                                                            name="shop_shipping"
                                                                            v-model="
                                                                                form.shop_shipping
                                                                            "
                                                                            :value="
                                                                                shipping.id
                                                                            "
                                                                        />
                                                                    </th>
                                                                    <td>
                                                                        {{
                                                                            shipping.type
                                                                        }}
                                                                        <br />
                                                                        LKR
                                                                        {{
                                                                            shipping.price
                                                                        }}
                                                                        <br />
                                                                        <span
                                                                            class="
                                                                                text-sm
                                                                                text-grey
                                                                            "
                                                                            >Delivery
                                                                            Time
                                                                        </span>
                                                                        {{
                                                                            shipping.delivery_time
                                                                        }}
                                                                        day(s)
                                                                        <br />
                                                                        <span
                                                                            class="
                                                                                text-sm
                                                                                text-grey
                                                                            "
                                                                            v-if="
                                                                                shipping.locations
                                                                            "
                                                                            >Locations
                                                                        </span>
                                                                        {{
                                                                            shipping.locations
                                                                        }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-2">
                                                Same store address?
                                            </h4>
                                            <hr />

                                            <div class="form-group">
                                                <label
                                                    class="col-form-label"
                                                    for="same_address"
                                                    >Personal address and store
                                                    address will be the same.
                                                    <strong class="text-danger">
                                                        *
                                                    </strong>
                                                </label>
                                                <div
                                                    class="
                                                        custom-control
                                                        custom-radio
                                                    "
                                                >
                                                    <input
                                                        type="radio"
                                                        id="same_address1"
                                                        name="same_address"
                                                        class="
                                                            custom-control-input
                                                        "
                                                        v-model="same_address"
                                                        :value="true"
                                                    />
                                                    <label
                                                        class="
                                                            custom-control-label
                                                        "
                                                        for="same_address1"
                                                        >Yes
                                                    </label>
                                                </div>
                                                <div
                                                    class="
                                                        custom-control
                                                        custom-radio
                                                    "
                                                >
                                                    <input
                                                        type="radio"
                                                        id="same_address2"
                                                        name="same_address"
                                                        class="
                                                            custom-control-input
                                                        "
                                                        v-model="same_address"
                                                        :value="false"
                                                    />
                                                    <label
                                                        class="
                                                            custom-control-label
                                                        "
                                                        for="same_address2"
                                                        >No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                            v-show="same_address === false"
                                        >
                                            <h4 class="mb-2">Store Address</h4>
                                            <p class="text-xs mb-3">
                                                Please make sure you add the
                                                most recent address from where
                                                you will be operating the
                                                business because this will
                                                effect your store visibility to
                                                certain customers
                                            </p>

                                            <div class="row">
                                                <div
                                                    class="form-group col-md-12"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_address"
                                                        >Address
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input
                                                        id="shop_address"
                                                        v-model="
                                                            form.shop_address
                                                        "
                                                        type="text"
                                                        name="shop_address"
                                                        class="form-control"
                                                        placeholder="Address"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="shop_address"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_city"
                                                        >City
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="shop_city"
                                                        v-model="form.shop_city"
                                                        name="shop_city"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select City
                                                        </option>
                                                        <option
                                                            v-for="city in cities"
                                                            :value="city.name"
                                                        >
                                                            {{ city.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="shop_city"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_zipcode"
                                                        >Zip Code
                                                    </label>
                                                    <input
                                                        id="shop_zipcode"
                                                        v-model="
                                                            form.shop_zipcode
                                                        "
                                                        type="text"
                                                        name="shop_zipcode"
                                                        class="
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        placeholder="Zip code"
                                                    />
                                                    <HasError
                                                        :form="form"
                                                        field="shop_zipcode"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                my-4
                                            "
                                        >
                                            <h4 class="mb-2">Confirmation</h4>
                                            <p>
                                                Once you have submitted this
                                                form you may proceed to add a
                                                new product to your store. You
                                                can review & update your profile
                                                and store details at any moment
                                                from the dashboard.
                                            </p>
                                        </div>

                                        <!-- Fail alert -->
                                        <div
                                            class="
                                                alert
                                                alert-danger
                                                alert-dismissible
                                                fade
                                                show
                                            "
                                            v-show="failed2"
                                            role="alert"
                                        >
                                            Please re-check the form. There are
                                            errors in your input.
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="alert"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>

                                        <div
                                            class="
                                                d-flex
                                                justify-content-between
                                                align-items-center
                                                mt-4
                                            "
                                        >
                                            <button
                                                type="button"
                                                class="btn mr-4 btn-grey"
                                                @click.prevent="
                                                    toggleForm('part1')
                                                "
                                            >
                                                Previous
                                            </button>
                                            <button
                                                type="submit"
                                                class="btn"
                                                :disabled="submitButtonDisabled"
                                            >
                                                <i class="fas fa-save mr-2"></i>
                                                {{ submitButtonText }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Business Activation Form Submitted"
            msg="Your request for selling on Lavisco has been successfully submitted. You can proceed to add products now. Please refresh the page."
            gotoRoute="/seller/dashboard"
        />
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
        submitButtonText: "Submit",
        submitButtonDisabled: false,
        same_address: false,

        revenue: "",
        orders: "",
        orderCount: "",
        products: "",
        productCount: "",
        sellerShop: "",
        user: "",
        has_shop: "",
        shop_active: "",
        url: "",
        billingMode: false,

        //form parts
        part1: true,
        part2: false,
        part3: false,
        failed: false,
        failed2: false,

        shippings: [],
        cities: [],
        form: new Form({
            id: "",
            //shop
            shop_name: "",
            banner: "",
            about: "",
            shop_city: "",
            shop_address: "",
            shop_zipcode: "",
            //seller profile
            first_name: "",
            last_name: "",
            phone: "",
            email: "",
            city: "",
            address: "",
            zipcode: "",
            billing_address: "",
            deposit_account: "",
            deposit_name: "",
            deposit_bank: "",
            deposit_bank_branch: "",
            deposit_account_status: "",
            shop_shipping: [],
        }),
    }),

    methods: {
        toggleForm(formpart) {
            this.part1 = false;
            this.part2 = false;
            this.part3 = false;
            this[formpart] = true;
        },

        loadData() {
            axios
                .get("/api/seller/dashboard")
                .then(({ data }) => {
                    this.user = data.user;
                    this.form.first_name = this.user.name
                        .trim()
                        .split(/\s+/)[0];
                    this.form.last_name = this.user.name.trim().split(/\s+/)[1];
                    this.form.email = this.user.email;
                    this.form.phone = this.user.phone;

                    this.has_shop = data.hasShop;
                    this.shop_active = data.shopActive;
                    if (this.has_shop === false) {
                        $("#addRecord").modal("show");
                        this.loadCities();
                        this.loadShippings();
                        this.sendSellerWelcomeMail(this.user.email);
                    }
                    this.revenue = data.revenue;
                    this.orders = data.orders.data;
                    this.orderCount = data.orderCount;
                    this.products = data.products.data;
                    this.productCount = data.productCount;
                    this.sellerShop = data.sellerShop;
                })
                .catch((error) => console.log(error));
        },

        //shop setup

        fileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.banner = reader.result;
                this.form.photoName = e.target.files[0].name;
                this.url = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
        },

        loadShippings() {
            axios
                .get("/api/seller/shop/shippings")
                .then((response) => {
                    this.shippings = response.data.shippings;
                })
                .catch((error) => console.log(error));
        },

        loadCities() {
            axios
                .get("/api/seller/locations/cities")
                .then(({ data }) => (this.cities = data))
                .catch((error) => console.log(error));
        },

        validateSellerprofile() {
            this.form
                .post("/api/seller/user/shop_setup_validate_profile")
                .then(() => {
                    this.failed = false;
                    this.toggleForm("part2");
                })
                .catch((error) => {
                    console.log(error);
                    this.failed = true;
                });
        },

        createSellerprofile() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            //autofill if address is the same
            if (this.same_address === true) {
                this.form.shop_address = this.form.address;
                this.form.shop_city = this.form.city;
                this.form.shop_zipcode = this.form.zipcode;
            }

            this.form
                .post("/api/seller/user/shop_setup")
                .then(() => {
                    //this.submitButtonDisabled = false;
                    this.failed2 = false;
                    $("#addRecord").modal("hide");
                    $("#success-modal").modal("show");
                    this.sendStoreActiveApplicationMail();
                })
                .catch((error) => {
                    this.failed2 = true;
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    console.log(error);
                });
        },

        logout() {
            axios
                .post("/logout")
                .then((response) => {
                    window.location.replace("/merchant/login");
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        sendSellerWelcomeMail(email) {
            axios
                .get("/api/email/seller_welcome/" + email)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },

        sendStoreActiveApplicationMail() {
            axios
                .get("/api/email/store_active_application")
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
