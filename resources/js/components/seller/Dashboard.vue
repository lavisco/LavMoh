<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-5 mb-5">
            <div class="col">
                <div class="row d-flex justify-content-center gap">
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Products</h4>
                        <p class="mb-2">All the listed products</p>
                        <h2>{{ products }}</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">New Order</h4>
                        <p class="mb-2">Orders placed this week</p>
                        <h2>{{ orders }}</h2>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Total Revenue</h4>
                        <p class="mb-2">Total amount earned this month</p>
                        <h2>{{ revenue }}</h2>
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
                        <div class="d-flex flex-row">
                            <div class="col-3 shop-setup-menu">
                                <h3 class="text-left">Activation Form</h3>
                                <p>Setup your shop to start selling today!</p>
                                <hr />
                                <button
                                    type="button"
                                    class="btn-sm btn-sm-cart btn-full"
                                    :class="{ active: part1 }"
                                    @click.prevent="toggleForm('part1')"
                                >
                                    Your Details
                                </button>
                                <button
                                    type="button"
                                    class="btn-sm btn-sm-cart btn-full mt-3"
                                    :class="{ active: part2 }"
                                    @click.prevent="toggleForm('part2')"
                                >
                                    Store Details
                                </button>
                                <button
                                    type="button"
                                    class="btn-sm btn-sm-cart btn-full mt-3"
                                    :class="{ active: part3 }"
                                    @click.prevent="toggleForm('part3')"
                                >
                                    Remittance Bank Details
                                </button>
                                <button
                                    type="button"
                                    class="btn-sm btn-sm-cart btn-full mt-3"
                                    :class="{ active: part4 }"
                                    @click.prevent="toggleForm('part4')"
                                >
                                    Confirmation
                                </button>
                            </div>
                            <div class="col-9 shop-setup-content">
                                <!-- Form start -->
                                <form
                                    class="input-form h-100"
                                    @submit.prevent="updateSellerprofile()"
                                >
                                    <div
                                        class="input-form-compact"
                                        v-show="part1"
                                    >
                                        <h3 class="text-left mb-3">
                                            Your Details
                                        </h3>
                                        <!-- Contact -->
                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-3">
                                                Contact Details
                                            </h4>
                                            <div class="form-group row">
                                                <div class="col-md-6">
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
                                                <div class="col-md-6">
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
                                            <div class="form-group row">
                                                <div class="col-md-6">
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
                                                <div class="col-md-6">
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
                                            <div class="form-group row">
                                                <div class="col-md-12">
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
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="province"
                                                        >Province
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="province"
                                                        v-model="form.province"
                                                        name="province"
                                                        @change.prevent="
                                                            loadDistricts(
                                                                'districts',
                                                                form.province,
                                                                'city'
                                                            )
                                                        "
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select Province
                                                        </option>
                                                        <option
                                                            v-for="province in provinces"
                                                            :value="
                                                                province.name
                                                            "
                                                        >
                                                            {{ province.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="province"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="district"
                                                        >District
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="district"
                                                        v-model="form.district"
                                                        name="district"
                                                        @change.prevent="
                                                            loadCities(
                                                                'cities',
                                                                form.district
                                                            )
                                                        "
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select District
                                                        </option>
                                                        <option
                                                            v-for="district in districts"
                                                            :value="
                                                                district.name
                                                            "
                                                        >
                                                            {{ district.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="district"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="city"
                                                        >City
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
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
                                                <div class="col-md-6">
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

                                        <div
                                            class="
                                                d-flex
                                                justify-content-end
                                                align-items-center
                                                mt-4
                                            "
                                        >
                                            <button
                                                type="button"
                                                class="btn"
                                                @click.prevent="
                                                    toggleForm('part2')
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
                                        <h3 class="text-left mb-3">
                                            Your Store Details
                                        </h3>

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-2 mb-3">
                                                Store Setup Information
                                            </h4>

                                            <div class="form-group row">
                                                <div class="col-12">
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
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for="about"
                                                        >About
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
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
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label
                                                        class="col-form-label"
                                                        for="banner"
                                                        >Upload banner
                                                        <p class="text-xs mt-2">
                                                            Banner image must be
                                                            under 2MB.
                                                            Recommended
                                                            resolution is 1920 x
                                                            1080px.
                                                        </p>
                                                    </label>
                                                    <input
                                                        type="file"
                                                        style="display: none"
                                                        @change.prevent="
                                                            fileSelected
                                                        "
                                                        ref="fileInput"
                                                        name="banner"
                                                    />
                                                    <br />

                                                    <button
                                                        class="image-upload-box"
                                                        @click.prevent="
                                                            $refs.fileInput.click()
                                                        "
                                                    >
                                                        <img
                                                            v-if="url"
                                                            :src="url"
                                                            class="
                                                                banner-container
                                                            "
                                                        />
                                                        <img
                                                            v-if="!url"
                                                            src="/images/lavisco/img-bg.jpg"
                                                            class="
                                                                banner-container
                                                            "
                                                        />
                                                    </button>
                                                    <p
                                                        class="
                                                            image-upload-filename
                                                            mt-2
                                                            mb-0
                                                        "
                                                    >
                                                        {{
                                                            form.photoName
                                                                ? form.photoName
                                                                : `Upload image`
                                                        }}
                                                    </p>
                                                    <HasError
                                                        :form="form"
                                                        field="banner"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
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
                                            <div class="form-group row">
                                                <div class="col-md-12">
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
                                                    <textarea
                                                        id="shop_address"
                                                        class="form-control"
                                                        name="shop_address"
                                                        rows="3"
                                                        cols="50"
                                                        v-model="
                                                            form.shop_address
                                                        "
                                                    >
                                                    </textarea>
                                                    <HasError
                                                        :form="form"
                                                        field="shop_address"
                                                    />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_province"
                                                        >Province
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="shop_province"
                                                        v-model="
                                                            form.shop_province
                                                        "
                                                        name="shop_province"
                                                        @change.prevent="
                                                            loadDistricts(
                                                                'districtsShop',
                                                                form.shop_province,
                                                                'shop_city'
                                                            )
                                                        "
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select Province
                                                        </option>
                                                        <option
                                                            v-for="province in provinces"
                                                            :value="
                                                                province.name
                                                            "
                                                        >
                                                            {{ province.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="shop_province"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_district"
                                                        >District
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="shop_district"
                                                        v-model="
                                                            form.shop_district
                                                        "
                                                        name="shop_district"
                                                        @change.prevent="
                                                            loadCities(
                                                                'citiesShop',
                                                                form.shop_district
                                                            )
                                                        "
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select District
                                                        </option>
                                                        <option
                                                            v-for="district in districtsShop"
                                                            :value="
                                                                district.name
                                                            "
                                                        >
                                                            {{ district.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="shop_district"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_city"
                                                        >City
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
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
                                                        @change.prevent="
                                                            loadAreas()
                                                        "
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
                                                            v-for="city in citiesShop"
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
                                                <div class="col-md-6">
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
                                            <div
                                                class="form-group row"
                                                v-show="areasShop[0] != null"
                                            >
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        for="shop_area"
                                                        >Area
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *</strong
                                                        >
                                                    </label>
                                                    <select
                                                        class="
                                                            custom-select
                                                            form-control
                                                            form-control-alternative
                                                        "
                                                        id="shop_area"
                                                        v-model="form.shop_area"
                                                        name="shop_area"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                            selected
                                                            hidden
                                                        >
                                                            Select Area
                                                        </option>
                                                        <option
                                                            v-for="area in areasShop"
                                                            :value="area.name"
                                                        >
                                                            {{ area.name }}
                                                        </option>
                                                    </select>
                                                    <HasError
                                                        :form="form"
                                                        field="shop_area"
                                                    />
                                                </div>
                                            </div>
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
                                                class="btn mr-4 btn-secondary"
                                                @click.prevent="
                                                    toggleForm('part1')
                                                "
                                            >
                                                Previous
                                            </button>
                                            <button
                                                type="button"
                                                class="btn"
                                                @click.prevent="
                                                    toggleForm('part3')
                                                "
                                            >
                                                Next
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        class="input-form-compact"
                                        v-show="part3"
                                    >
                                        <h3 class="text-left mb-3">
                                            Your Remittance Bank Details
                                        </h3>
                                        <!-- Account -->

                                        <div
                                            class="
                                                card
                                                dashboard-info-card
                                                mt-4
                                            "
                                        >
                                            <h4 class="mb-2">
                                                Earnings Deposit Account
                                                Information
                                            </h4>
                                            <p class="text-xs mb-3">
                                                Please make sure the details you
                                                provide is accurate and updated.
                                                All payments will be made weekly
                                                into this account and lavisco.lk
                                                will not deposit into any other
                                                accounts not stated below
                                            </p>

                                            <div class="form-group row">
                                                <div class="col-md-8">
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
                                                <div class="col-md-4">
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
                                            <div class="form-group row">
                                                <div class="col-md-12">
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
                                            <div class="form-group row">
                                                <div class="col-md-6">
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
                                                <div class="col-md-6">
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
                                                class="btn mr-4 btn-secondary"
                                                @click.prevent="
                                                    toggleForm('part2')
                                                "
                                            >
                                                Previous
                                            </button>
                                            <button
                                                type="button"
                                                class="btn"
                                                @click.prevent="
                                                    toggleForm('part4')
                                                "
                                            >
                                                Next
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        class="input-form-compact"
                                        v-show="part4"
                                    >
                                        <div
                                            class="
                                                h-100
                                                d-flex
                                                flex-column
                                                justify-content-between
                                            "
                                        >
                                            <div>
                                                <h3 class="text-left mb-3">
                                                    Confirmation
                                                </h3>
                                                <h4 class="mb-2">
                                                    We'll review your business &
                                                    activation agreement once
                                                    you Save changes.
                                                </h4>
                                                <p>
                                                    Review will take upto 4
                                                    days. Once your store is
                                                    activated you will receive
                                                    an email.
                                                </p>
                                            </div>

                                            <div>
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
                                                    <h4>
                                                        Activation Failed!
                                                        <button
                                                            type="button"
                                                            class="close"
                                                            data-dismiss="alert"
                                                            aria-label="Close"
                                                        >
                                                            <span
                                                                aria-hidden="true"
                                                                >&times;</span
                                                            >
                                                        </button>
                                                    </h4>
                                                    <hr />
                                                    <p class="mb-0">
                                                        There are errors in your
                                                        input. You should
                                                        re-check the entire
                                                        form.
                                                    </p>
                                                </div>

                                                <div
                                                    class="
                                                        d-flex
                                                        justify-content-between
                                                        align-items-center
                                                        mt-auto
                                                    "
                                                >
                                                    <button
                                                        type="button"
                                                        class="
                                                            btn
                                                            mr-4
                                                            btn-secondary
                                                        "
                                                        @click.prevent="
                                                            toggleForm('part3')
                                                        "
                                                    >
                                                        Previous
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        class="btn"
                                                    >
                                                        <i
                                                            class="
                                                                fas
                                                                fa-pen-nib
                                                                mr-2
                                                            "
                                                            aria-hidden="true"
                                                        ></i>
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        revenue: "",
        orders: "",
        products: "",
        has_shop: "",
        url: "",
        billingMode: false,

        //form parts
        part1: true,
        part2: false,
        part3: false,
        part4: false,
        failed: false,

        //location data
        provinces: [],
        districts: [],
        cities: [],
        districtsShop: [],
        citiesShop: [],
        areasShop: [],
        form: new Form({
            id: "",
            //shop
            shop_name: "",
            banner: "",
            about: "",
            shop_country: "",
            shop_province: "",
            shop_district: "",
            shop_city: "",
            shop_area: "",
            shop_address: "",
            shop_zipcode: "",
            //seller profile
            first_name: "",
            last_name: "",
            phone: "",
            email: "",
            country: "",
            province: "",
            district: "",
            city: "",
            address: "",
            zipcode: "",
            billing_address: "",
            deposit_account: "",
            deposit_name: "",
            deposit_bank: "",
            deposit_bank_branch: "",
            deposit_account_status: "",
        }),
    }),

    methods: {
        toggleForm(formpart) {
            this.part1 = false;
            this.part2 = false;
            this.part3 = false;
            this.part4 = false;
            this[formpart] = true;
        },

        loadData() {
            axios
                .get("/api/seller/dashboard")
                .then(({ data }) => {
                    this.has_shop = data.hasShop;
                    if (this.has_shop === false) {
                        $("#addRecord").modal("show");
                        this.loadProvinces();
                    }
                    this.orders = data.orders;
                    this.products = data.products;
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

        updateSellerprofile() {
            this.form
                .post("/api/seller/user/shop_setup")
                .then(() => {
                    window.location.replace("/login");
                })
                .catch((error) => {
                    console.log(error);
                    this.failed = true;
                });
        },

        loadProvinces() {
            axios
                .get("/api/locations/provinces")
                .then(({ data }) => (this.provinces = data))
                .catch((error) => console.log(error));
        },

        loadDistricts(districts, province, city) {
            axios
                .get("/api/locations/districts/" + province)
                .then(({ data }) => {
                    this[districts] = data;
                    city == "city"
                        ? (this.form.city = "")
                        : (this.form.shop_city = "");
                })
                .catch((error) => console.log(error));
        },

        loadCities(cities, district) {
            axios
                .get("/api/locations/cities/" + district)
                .then(({ data }) => (this[cities] = data))
                .catch((error) => console.log(error));
        },

        loadAreas() {
            axios
                .get("/api/locations/areas/" + this.form.shop_city)
                .then(({ data }) => (this.areasShop = data))
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
