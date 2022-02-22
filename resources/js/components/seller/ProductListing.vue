<template>
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item">
                            <router-link to="/seller/products">
                                Products
                            </router-link>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New Product
                        </li>
                    </ol>
                </nav>

                <!-- Form start -->
                <form class="input-form" @submit.prevent="createProduct()">
                    <!-- Listing -->
                    <div class="card dashboard-info-card">
                        <!-- Header -->
                        <h4 class="mb-3">Add a new product</h4>
                        <hr class="mt-0" />
                        <p class="mb-4 note">
                            Setup your product details and other specifications
                            as you require. Remember to tell all about your item
                            to the world and why they will love it.
                        </p>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="title">
                                Title
                                <strong class="text-danger"> *</strong>
                                <p class="text-xs mt-2">
                                    Include keywords that buyers would use to
                                    search for your item
                                </p>
                            </label>

                            <div class="col-md-9">
                                <input
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    name="title"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Title"
                                />
                                <HasError :form="form" field="title" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="category_id"
                            >
                                Category
                                <strong class="text-danger"> *</strong>
                            </label>

                            <div class="col-md-4">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="category_id"
                                    id="category_id"
                                    v-model="form.category_id"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Category
                                    </option>
                                    <option
                                        v-for="category in categories"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                                <HasError :form="form" field="category_id" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Occasions
                                <p class="text-grey text-xs mt-2">
                                    Select the occasions your item is suitable
                                    for gifting
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('occasionMode')
                                    "
                                >
                                    Add Occasions
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Recipients
                                <p class="text-grey text-xs mt-2">
                                    Select the people to whom your item would be
                                    suitable for as a gift
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('recipientMode')
                                    "
                                >
                                    Add Recipients
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="description"
                            >
                                Description
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Write a brief overview that describes your
                                    item's finest feature. Shoppers will only
                                    see the first few lines of your description
                                    at first, so make it count!
                                </p>
                                <p class="text-grey text-xs mt-2">
                                    Maximum 1000 characters
                                </p>
                            </label>

                            <div class="col-md-9">
                                <textarea
                                    id="description"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    name="description"
                                    rows="9"
                                    cols="50"
                                    v-model="form.description"
                                >
                                </textarea>
                                <HasError :form="form" field="description" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="material"
                            >
                                Ingredients
                                <p class="text-xs mt-2">
                                    Ingredients used to make your product
                                </p>
                            </label>

                            <div class="col-md-9">
                                <input
                                    id="material"
                                    v-model="form.material"
                                    type="text"
                                    name="material"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Ingredient"
                                />
                                <HasError :form="form" field="material" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="weight">
                                Item weight
                            </label>

                            <div class="col-md-2 col-sm-6">
                                <input
                                    id="weight"
                                    v-model="form.weight"
                                    type="text"
                                    name="weight"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Weight"
                                />
                                <HasError :form="form" field="weight" />
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="weight_unit"
                                    id="weight_unit"
                                    v-model="form.weight_unit"
                                >
                                    <option value="" disabled selected hidden>
                                        Select unit
                                    </option>
                                    <option>lb</option>
                                    <option>kg</option>
                                    <option>gm</option>
                                    <option>oz</option>
                                </select>
                                <HasError :form="form" field="weight_unit" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="length">
                                Item size
                                <p class="text-grey text-xs mt-2">
                                    Enter size of the item plus packaging
                                    material
                                </p>
                            </label>

                            <div class="col-md-2 col-sm-3">
                                <input
                                    id="length"
                                    v-model="form.length"
                                    type="text"
                                    name="length"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Length"
                                />
                                <HasError :form="form" field="length" />
                            </div>
                            <div class="col-md-2 col-sm-3">
                                <input
                                    id="width"
                                    v-model="form.width"
                                    type="text"
                                    name="width"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Width"
                                />
                                <HasError :form="form" field="width" />
                            </div>
                            <div class="col-md-2 col-sm-3">
                                <input
                                    id="height"
                                    v-model="form.height"
                                    type="text"
                                    name="height"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Height"
                                />
                                <HasError :form="form" field="height" />
                            </div>
                            <div class="col-md-2 col-sm-3">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="dimensions_unit"
                                    id="dimensions_unit"
                                    v-model="form.dimensions_unit"
                                >
                                    <option value="" disabled selected hidden>
                                        Select unit
                                    </option>
                                    <option>cm</option>
                                    <option>in</option>
                                    <option>m</option>
                                    <option>oz</option>
                                </select>
                                <HasError
                                    :form="form"
                                    field="dimensions_unit"
                                />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Item allows customization?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="has_custom_text"
                                        v-model="form.has_custom_text"
                                        name="has_custom_text"
                                        @change="check($event)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_custom_text"
                                        >Custom Text Available</label
                                    >
                                </div>
                                <HasError
                                    :form="form"
                                    field="has_custom_text"
                                />
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="has_custom_image"
                                        v-model="form.has_custom_image"
                                        name="has_custom_image"
                                        @change="check($event)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_custom_image"
                                        >Custom Image Available</label
                                    >
                                </div>
                                <HasError
                                    :form="form"
                                    field="has_custom_image"
                                />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Can this item be wrapped for gifting?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="has_giftwrap"
                                        v-model="form.has_giftwrap"
                                        name="has_giftwrap"
                                        @change="check($event)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_giftwrap"
                                        >Yes
                                    </label>
                                </div>
                                <HasError :form="form" field="has_giftwrap" />
                            </div>
                        </div>
                    </div>

                    <!-- Photo -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Product Photos</h4>
                        <hr class="mt-0" />
                        <p class="mb-4 note">
                            Add atleast 3 photos showcasing your product. The
                            Primary photo is the first image customers see in
                            the product page.
                        </p>

                        <div class="form-group row">
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <div
                                        class="mr-md-3"
                                        v-for="(n, index) in 3"
                                    >
                                        <div>
                                            <input
                                                type="file"
                                                style="display: none"
                                                @change.prevent="
                                                    fileSelected(
                                                        $event,
                                                        `image${index}`
                                                    )
                                                "
                                                ref="fileInput"
                                                name="product_image_path"
                                            />

                                            <button
                                                class="image-upload-box"
                                                :class="{
                                                    'image-upload-box-primary':
                                                        index == 0,
                                                }"
                                                @click.prevent="
                                                    $refs.fileInput[
                                                        index
                                                    ].click()
                                                "
                                            >
                                                <img
                                                    v-if="url[index]"
                                                    :src="url[index]"
                                                    class="banner-container"
                                                />
                                                <svg
                                                    v-show="
                                                        !form.image_path[index]
                                                    "
                                                    width="45"
                                                    height="45"
                                                    viewBox="0 0 58 58"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M36.25 29C36.25 30.9228 35.4862 32.7669 34.1265 34.1265C32.7669 35.4862 30.9228 36.25 29 36.25C27.0772 36.25 25.2331 35.4862 23.8735 34.1265C22.5138 32.7669 21.75 30.9228 21.75 29C21.75 27.0772 22.5138 25.2331 23.8735 23.8735C25.2331 22.5138 27.0772 21.75 29 21.75C30.9228 21.75 32.7669 22.5138 34.1265 23.8735C35.4862 25.2331 36.25 27.0772 36.25 29ZM19.1255 10.2587C19.5768 9.3548 20.271 8.59445 21.1303 8.06301C21.9896 7.53156 22.9799 7.25003 23.9902 7.25H34.0098C35.0201 7.25003 36.0104 7.53156 36.8697 8.06301C37.729 8.59445 38.4232 9.3548 38.8745 10.2587L40.9951 14.5H43.5C45.4228 14.5 47.2669 15.2638 48.6265 16.6235C49.9862 17.9831 50.75 19.8272 50.75 21.75V39.875C50.75 41.7978 49.9862 43.6419 48.6265 45.0015C47.2669 46.3612 45.4228 47.125 43.5 47.125H14.5C12.5772 47.125 10.7331 46.3612 9.37348 45.0015C8.01384 43.6419 7.25 41.7978 7.25 39.875V21.75C7.25 19.8272 8.01384 17.9831 9.37348 16.6235C10.7331 15.2638 12.5772 14.5 14.5 14.5H17.0049L19.1255 10.2587ZM39.875 29C39.875 26.1158 38.7292 23.3497 36.6898 21.3102C34.6503 19.2708 31.8842 18.125 29 18.125C26.1158 18.125 23.3497 19.2708 21.3102 21.3102C19.2708 23.3497 18.125 26.1158 18.125 29C18.125 31.8842 19.2708 34.6503 21.3102 36.6898C23.3497 38.7292 26.1158 39.875 29 39.875C31.8842 39.875 34.6503 38.7292 36.6898 36.6898C38.7292 34.6503 39.875 31.8842 39.875 29Z"
                                                        fill="#4e4e4e"
                                                    />
                                                </svg>
                                            </button>

                                            <p
                                                class="
                                                    image-upload-filename
                                                    mt-2
                                                "
                                            >
                                                {{
                                                    form.photoName[index]
                                                        ? form.photoName[index]
                                                        : `Select image`
                                                }}
                                                <br />
                                                {{
                                                    index == 0
                                                        ? `Primary Image`
                                                        : ""
                                                }}
                                            </p>
                                            <HasError
                                                :form="form"
                                                field="image_path.0"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Inventory & Pricing</h4>
                        <hr class="mt-0" />
                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="base_price"
                            >
                                Price
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Remember to factor in the cost of materials,
                                    labor, and other business expenses.
                                </p>
                            </label>

                            <div class="col-md-4">
                                <input
                                    id="base_price"
                                    v-model="form.base_price"
                                    type="text"
                                    name="base_price"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Price"
                                />
                                <HasError :form="form" field="base_price" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="has_inventory"
                            >
                                Will you maintain Inventory for this Item?
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Select 'No' if this is a made to order item.
                                </p>
                            </label>
                            <div class="col-md-5">
                                <div
                                    class="
                                        custom-control
                                        custom-radio
                                        custom-control-inline
                                    "
                                >
                                    <input
                                        type="radio"
                                        id="inventory1"
                                        name="has_inventory"
                                        class="custom-control-input"
                                        v-model="form.has_inventory"
                                        value="1"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="inventory1"
                                        >Yes</label
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
                                        id="inventory2"
                                        name="has_inventory"
                                        class="custom-control-input"
                                        v-model="form.has_inventory"
                                        value="0"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="inventory2"
                                        >No</label
                                    >
                                </div>
                            </div>

                            <HasError :form="form" field="has_inventory" />
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="quantity"
                            >
                                Quantity
                            </label>

                            <div class="col-md-4">
                                <input
                                    id="quantity"
                                    v-model="form.quantity"
                                    type="text"
                                    name="quantity"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Quantity"
                                    :disabled="isDisabled"
                                />
                                <HasError :form="form" field="quantity" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="sku">
                                SKU
                                <p class="text-grey text-xs mt-2">
                                    SKUs are for your use only, buyers won't see
                                    them.
                                </p>
                            </label>

                            <div class="col-md-4">
                                <input
                                    id="sku"
                                    v-model="form.sku"
                                    type="text"
                                    name="sku"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="SKU"
                                />
                                <HasError :form="form" field="sku" />
                            </div>
                        </div>
                    </div>

                    <!-- Variation -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Variations</h4>
                        <hr class="mt-0" />
                        <p class="mb-4 note">
                            Add available options like color or size. Buyers
                            will choose from these during checkout.
                        </p>

                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Will this item have variations?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="has_variations"
                                        v-model="form.has_variations"
                                        name="has_variations"
                                        @change="check($event)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_variations"
                                        >Yes
                                    </label>
                                </div>
                                <HasError :form="form" field="has_variations" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Add new Variations
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('variationMode', 0)
                                    "
                                >
                                    Add a Variation
                                </button>
                                <button
                                    class="btn btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('variationMode', 1)
                                    "
                                    v-show="
                                        form.productVariation[0].variationId
                                    "
                                >
                                    Add 2nd Variations
                                </button>
                                <button
                                    class="btn btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('variationMode', 2)
                                    "
                                    v-show="
                                        form.productVariation[1].variationId
                                    "
                                >
                                    Add 3rd Variations
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Shipping</h4>
                        <hr class="mt-0" />
                        <p class="mb-4 note">
                            Set clear and realistic shipping expectations for
                            shoppers
                        </p>

                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="processing_time"
                            >
                                Processing Time
                                <p class="text-grey text-xs mt-2">
                                    Once order has been placed, how long does it
                                    take you to prepare, package & ship?
                                </p>
                            </label>
                            <div class="col-md-4">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="processing_time"
                                    id="processing_time"
                                    v-model="form.processing_time"
                                >
                                    <option value="" disabled selected hidden>
                                        Select processing time
                                    </option>
                                    <option>12 hours</option>
                                    <option>24 hours</option>
                                    <option>48 hours</option>
                                    <option>72 hours</option>
                                    <option>1 week</option>
                                    <option>2 weeks</option>
                                    <option>3 weeks</option>
                                    <option>1 month</option>
                                </select>
                                <HasError
                                    :form="form"
                                    field="processing_time"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="production_time"
                            >
                                Production Time
                            </label>
                            <div class="col-md-4 col-sm-6">
                                <input
                                    id="production_time"
                                    v-model="form.production_time"
                                    type="text"
                                    name="production_time"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Production time"
                                />
                                <HasError
                                    :form="form"
                                    field="production_time"
                                />
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <input
                                    id="cut_off_time"
                                    v-model="form.cut_off_time"
                                    type="text"
                                    name="cut_off_time"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Cut-off time"
                                />
                                <HasError :form="form" field="cut_off_time" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Shipping types
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Select the shipping options you provide.
                                </p>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="table-responsive form-table mt-md-2"
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
                                                <th scope="col"></th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">
                                                    Delivery Time
                                                </th>
                                                <th scope="col">Locations</th>
                                                <th scope="col">
                                                    Tracking opt
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="shipping in shippings">
                                                <th scope="row">
                                                    <input
                                                        type="checkbox"
                                                        name="product_shipping"
                                                        v-model="
                                                            form.product_shipping
                                                        "
                                                        :value="shipping.id"
                                                    />
                                                </th>
                                                <td>{{ shipping.type }}</td>
                                                <td>
                                                    {{ shipping.price }}
                                                </td>
                                                <td>
                                                    {{ shipping.delivery_time }}
                                                </td>
                                                <td>
                                                    {{ shipping.locations }}
                                                </td>
                                                <td>
                                                    {{ shipping.tracking_opt }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-form text-right mt-4">
                        <button
                            type="button"
                            class="btn btn-secondary mr-3"
                            @click="cancel()"
                        >
                            <i class="fas fa-times mr-2" aria-hidden="true"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn">
                            <i class="fas fa-save mr-2" aria-hidden="true"></i>
                            Save & Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            ref="vuemodal"
            id="addRecord"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
            data-backdrop="static"
            data-keyboard="false"
        >
            <div
                class="modal-dialog modal-dialog-centered"
                :class="{ 'modal-xl': variationMode }"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4
                            v-show="occasionMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add Occasions
                        </h4>
                        <h4
                            v-show="recipientMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add Recipients
                        </h4>
                        <h4
                            v-show="variationMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add a Variation
                        </h4>
                        <button
                            type="button"
                            class="close"
                            @click.prevent="closeModal"
                            v-show="!variationMode"
                        >
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                    <div v-show="occasionMode" class="modal-body">
                        <div class="d-flex flex-wrap gap">
                            <div
                                class="badge option-badge"
                                v-for="occasion in occasions"
                            >
                                <div class="d-flex align-items-center">
                                    <input
                                        type="checkbox"
                                        class="mr-2"
                                        name="product_occasion"
                                        v-model="form.product_occasion"
                                        :value="occasion.id"
                                    />
                                    {{ occasion.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-show="recipientMode" class="modal-body">
                        <div class="d-flex flex-wrap gap">
                            <div
                                class="badge option-badge"
                                v-for="recipient in recipients"
                            >
                                <div class="d-flex align-items-center">
                                    <input
                                        type="checkbox"
                                        class="mr-2"
                                        name="product_recipient"
                                        v-model="form.product_recipient"
                                        :value="recipient.id"
                                    />
                                    {{ recipient.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="variationMode" class="modal-body input-form">
                        <div class="form-group">
                            <label class="col-form-label" for="variation_id">
                                Select Variation Type
                            </label>
                            <input
                                id="productVariation.variation_id"
                                v-model="
                                    form.productVariation[variationCount]
                                        .variationId
                                "
                                type="text"
                                name="productVariation.variation_id"
                                class="form-control form-control-alternative"
                                placeholder="variation type"
                                :disabled="
                                    form.productVariation[variationCount]
                                        .option_list[0] != null
                                "
                            />
                        </div>
                        <div class="form-group">
                            <div
                                class="
                                    d-flex
                                    align-items-center
                                    justify-content-between
                                "
                            >
                                <label class="col-form-label" for="">
                                    Add Option Details
                                    <p class="text-grey text-xs mt-2">
                                        Add any extra information for the
                                        options you provide.
                                    </p>
                                </label>
                                <button
                                    type="button"
                                    class="btn btn-sm ml-2"
                                    @click.prevent="addRow(variationCount)"
                                    v-show="
                                        form.productVariation[variationCount]
                                            .variationId
                                    "
                                >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <div
                                v-show="
                                    form.productVariation[variationCount]
                                        .option_list[0] != null
                                "
                            >
                                <div
                                    class="card dashboard-info-card p-3 mb-2"
                                    v-for="(item, i) in form.productVariation[
                                        variationCount
                                    ].option_list"
                                >
                                    <div
                                        class="
                                            d-flex
                                            justify-content-between
                                            align-items-center
                                        "
                                    >
                                        <h5>Option {{ i + 1 }}</h5>
                                        <a
                                            class="btn btn-light btn-sm"
                                            href=""
                                            @click.prevent="
                                                delRow(variationCount, i)
                                            "
                                        >
                                            Delete
                                        </a>
                                    </div>

                                    <div class="form-group row mb-md-1">
                                        <div class="col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="var_option_id_array"
                                                >Option Name
                                                <strong class="text-danger">
                                                    *</strong
                                                >
                                            </label>
                                            <input
                                                name="var_option_id_array"
                                                id="var_option_id_array"
                                                v-model="
                                                    form.productVariation[
                                                        variationCount
                                                    ].var_option_id_array[i]
                                                "
                                                type="text"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Option"
                                            />
                                            <HasError
                                                :form="form"
                                                field="var_option_id_array"
                                            />
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="col-form-label"
                                                for="var_price_array"
                                                >Price
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="var_price_array"
                                                v-model="
                                                    form.productVariation[
                                                        variationCount
                                                    ].var_price_array[i]
                                                "
                                                type="text"
                                                name="var_price_array"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="price"
                                            />
                                            <HasError
                                                :form="form"
                                                field="var_price_array"
                                            />
                                        </div>
                                        <div class="col-md-3">
                                            <label
                                                class="col-form-label"
                                                for="var_quantity_array"
                                                >Quantity
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="var_quantity_array"
                                                v-model="
                                                    form.productVariation[
                                                        variationCount
                                                    ].var_quantity_array[i]
                                                "
                                                type="text"
                                                name="var_quantity_array"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="qty"
                                            />
                                            <HasError
                                                :form="form"
                                                field="productVariation.0.var_quantity_array.0"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-md-1">
                                        <div class="col-md-8">
                                            <label
                                                class="col-form-label"
                                                for="var_description_array"
                                                >Description
                                            </label>
                                            <input
                                                id="var_description_array"
                                                v-model="
                                                    form.productVariation[
                                                        variationCount
                                                    ].var_description_array[i]
                                                "
                                                type="text"
                                                name="var_description_array"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="description"
                                            />
                                            <HasError
                                                :form="form"
                                                field="var_description_array"
                                            />
                                        </div>
                                        <div class="col-md-4">
                                            <label
                                                class="col-form-label"
                                                for="productVariation.sku"
                                                >SKU
                                            </label>
                                            <input
                                                id="productVariation.sku"
                                                v-model="
                                                    form.productVariation[
                                                        variationCount
                                                    ].sku[i]
                                                "
                                                type="text"
                                                name="productVariation.sku"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="sku"
                                            />
                                            <HasError
                                                :form="form"
                                                field="productVariation.0.sku"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-grey mr-2"
                            @click.prevent="delVariation(variationCount)"
                            v-show="variationMode"
                        >
                            <i class="fas fa-times mr-2"></i>
                            Remove
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click.prevent="closeModal"
                        >
                            <i class="fas fa-pen-nib mr-2"></i>
                            Save
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
        variationMode: false,
        occasionMode: false,
        recipientMode: false,
        categories: [],
        occasions: [],
        recipients: [],
        shippings: [],
        sellers: [],
        variationCount: "0",
        url: [],
        form: new Form({
            id: "",
            sku: "",
            title: "",
            description: "",
            material: "",
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
            has_custom_text: false,
            has_custom_image: false,
            has_variations: false,
            has_inventory: "",
            has_giftwrap: false,
            quantity: "",
            product_state_id: "",
            category_id: "",
            user_id: "",
            image_path: [],
            photoName: [],

            //pivot table arrays
            product_occasion: [],
            product_recipient: [],
            product_shipping: [],

            //variation fields
            productVariation: [
                {
                    variationId: "",
                    variationIds: [],
                    option_list: [],
                    var_option_id_array: [],
                    sku: [],
                    var_price_array: [],
                    var_quantity_array: [],
                    var_description_array: [],
                },
                {
                    variationId: "",
                    variationIds: [],
                    option_list: [],
                    var_option_id_array: [],
                    sku: [],
                    var_price_array: [],
                    var_quantity_array: [],
                    var_description_array: [],
                },
                {
                    variationId: "",
                    variationIds: [],
                    option_list: [],
                    var_option_id_array: [],
                    sku: [],
                    var_price_array: [],
                    var_quantity_array: [],
                    var_description_array: [],
                },
            ],
        }),
    }),

    computed: {
        isDisabled() {
            return this.form.has_inventory == 1 ? false : true;
        },
    },

    methods: {
        cancel() {
            this.$router.push("/seller/products");
        },

        fileSelected(e, imagenum) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }

            reader.onloadend = (file) => {
                if (imagenum == "image0") {
                    this.$set(this.form.image_path, 0, reader.result);
                    this.$set(this.form.photoName, 0, e.target.files[0].name);
                    this.$set(
                        this.url,
                        0,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image1") {
                    this.$set(this.form.image_path, 1, reader.result);
                    this.$set(this.form.photoName, 1, e.target.files[0].name);
                    this.$set(
                        this.url,
                        1,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image2") {
                    this.$set(this.form.image_path, 2, reader.result);
                    this.$set(this.form.photoName, 2, e.target.files[0].name);
                    this.$set(
                        this.url,
                        2,
                        URL.createObjectURL(e.target.files[0])
                    );
                }
            };
            reader.readAsDataURL(file);
        },

        addRow(count) {
            this.form.productVariation[count].option_list.push("1");
            this.form.productVariation[count].variationIds.push(
                this.form.productVariation[count].variationId
            );
        },

        delRow(count, i) {
            let variant = this.form.productVariation[count];
            variant.option_list.splice(i, 1);
            variant.var_option_id_array.splice(i, 1);
            variant.sku.splice(i, 1);
            variant.var_price_array.splice(i, 1);
            variant.var_quantity_array.splice(i, 1);
            variant.var_description_array.splice(i, 1);
        },

        delVariation(count) {
            let variant = this.form.productVariation[count];
            this.variationMode = false;
            variant.variationId = "";
            variant.variationIds = [];
            variant.option_list = [];
            variant.var_option_id_array = [];
            variant.sku = [];
            variant.var_price_array = [];
            variant.var_quantity_array = [];
            variant.var_description_array = [];
            $("#addRecord").modal("hide");
        },

        check(event) {
            event.target.value = true;
        },

        subcategoryModal(mode, count) {
            this[mode] = true;
            switch (true) {
                case this.variationMode:
                    this.variationCount = count;
                    break;
            }
            $("#addRecord").modal("show");
        },

        closeModal() {
            this.occasionMode = false;
            this.recipientMode = false;
            this.variationMode = false;
            $("#addRecord").modal("hide");
        },

        loadDetails() {
            axios
                .get("/api/seller/products/details")
                .then((response) => {
                    this.categories = response.data.categories;
                    this.occasions = response.data.occasions;
                    this.recipients = response.data.recipients;
                    this.shippings = response.data.shippings;
                })
                .catch((error) => console.log(error));
        },

        createProduct() {
            if (this.form.has_inventory == "0") {
                this.form.quantity = "0";
            }

            this.form
                .post("/api/seller/products")
                .then(() => {
                    this.$router.push("/seller/products");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadDetails();
    },
};
</script>
