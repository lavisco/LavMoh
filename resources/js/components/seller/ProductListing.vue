<template>
    <div class="container mb-5">
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
                        <p class="mb-3 mb-md-4 note">
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
                                    @change.prevent="loadSubcategories($event)"
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
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="product_sub_category"
                            >
                                Sub-Category
                                <strong class="text-danger"> *</strong>
                            </label>

                            <div class="col-md-4">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="product_sub_category"
                                    id="product_sub_category"
                                    v-model="form.product_sub_category"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Sub-Category
                                    </option>
                                    <option
                                        v-for="sub_category in sub_categories"
                                        :value="sub_category.id"
                                    >
                                        {{ sub_category.name }}
                                    </option>
                                </select>
                                <HasError
                                    :form="form"
                                    field="product_sub_category"
                                />
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
                                    class="btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('occasionMode')
                                    "
                                >
                                    Add Occasions
                                </button>
                                <p class="mt-2 mb-3">
                                    <span
                                        class="
                                            badge badge-pill badge-secondary
                                            mr-2
                                        "
                                        v-for="occasion in occasionName"
                                    >
                                        {{ occasion }}
                                    </span>
                                </p>
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
                                    class="btn-sm"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('recipientMode')
                                    "
                                >
                                    Add Recipients
                                </button>
                                <p class="mt-2 mb-3">
                                    <span
                                        class="
                                            badge badge-pill badge-secondary
                                            mr-2
                                        "
                                        v-for="recipient in recipientName"
                                    >
                                        {{ recipient }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="short_description"
                            >
                                Short Description
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Write a brief overview that describes your
                                    item's finest feature. Shoppers will see
                                    your short description first, so make it
                                    count!
                                </p>
                                <p class="text-grey text-xs">
                                    Maximum <strong>500</strong> characters
                                </p>
                            </label>

                            <div class="col-md-9">
                                <textarea
                                    id="short_description"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    name="short_description"
                                    rows="5"
                                    cols="50"
                                    v-model="form.short_description"
                                >
                                </textarea>
                                <HasError
                                    :form="form"
                                    field="short_description"
                                />
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
                                    Describe your product's features and
                                    benefits in a concise and honest manner.
                                    Focus on its unique properties.
                                </p>
                                <p class="text-grey text-xs">
                                    Maximum <strong>2000</strong> characters
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
                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="material"
                            >
                                Ingredients/ Materials
                                <p class="text-xs mt-2">
                                    If your product is a food item, then list
                                    it's ingredients, else list the materials
                                    that went into making it. E.g. milk, sugar,
                                    honey
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
                                    placeholder="Ingredients"
                                />
                                <HasError :form="form" field="material" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="length">
                                Package Dimensions (inch)
                                <p class="text-grey text-xs mt-2">
                                    If applicable, enter a rough estimation of
                                    your product size in inches when it's
                                    packaged.
                                </p>
                            </label>

                            <div class="col-md-3 col-4 pr-1 pr-md-2">
                                <label
                                    class="col-form-label pt-md-auto pt-0"
                                    for="length"
                                >
                                    Length
                                </label>
                                <input
                                    id="length"
                                    v-model="form.length"
                                    type="text"
                                    name="length"
                                    class="
                                        form-control form-control-alternative
                                    "
                                />
                                <HasError :form="form" field="length" />
                            </div>
                            <div class="col-md-3 col-4 px-1 px-md-2">
                                <label
                                    class="col-form-label pt-md-auto pt-0"
                                    for="width"
                                >
                                    Breadth
                                </label>
                                <input
                                    id="width"
                                    v-model="form.width"
                                    type="text"
                                    name="width"
                                    class="
                                        form-control form-control-alternative
                                    "
                                />
                                <HasError :form="form" field="width" />
                            </div>
                            <div class="col-md-3 col-4 pl-1 pl-md-2">
                                <label
                                    class="col-form-label pt-md-auto pt-0"
                                    for="height"
                                >
                                    Height
                                </label>
                                <input
                                    id="height"
                                    v-model="form.height"
                                    type="text"
                                    name="height"
                                    class="
                                        form-control form-control-alternative
                                    "
                                />
                                <HasError :form="form" field="height" />
                            </div>
                        </div>

                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="">
                                Will this product have Lavisco packaging
                                materials?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="
                                        custom-control
                                        custom-radio
                                        custom-control-inline
                                    "
                                >
                                    <input
                                        type="radio"
                                        id="has_giftwrap1"
                                        name="has_giftwrap"
                                        class="custom-control-input"
                                        v-model="form.has_giftwrap"
                                        value="1"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_giftwrap1"
                                        >Yes
                                    </label>
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
                                        id="has_giftwrap2"
                                        name="has_giftwrap"
                                        class="custom-control-input"
                                        v-model="form.has_giftwrap"
                                        value="0"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_giftwrap2"
                                        >No
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

                        <p class="mb-3 mb-md-4 note">
                            Add atleast 3 photos showcasing your product. The
                            Primary photo is the first image customers see on
                            the website.
                        </p>

                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="category_id"
                            >
                                Primary Photo
                                <strong class="text-danger"> *</strong>
                                <p class="text-xs mt-2">
                                    The primary photo is the first image
                                    customers see on the website.
                                </p>
                            </label>

                            <div class="col-md-9">
                                <div>
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelectedPrimary"
                                        ref="fileInputPrimary"
                                        name="product_image_path"
                                    />

                                    <button
                                        class="
                                            image-upload-box
                                            image-upload-box-primary
                                        "
                                        :style="{
                                            'background-image':
                                                'url(' + urlPrimary + ')',
                                        }"
                                        @click.prevent="
                                            $refs.fileInputPrimary.click()
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="48"
                                            height="48"
                                            preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 20 20"
                                            v-show="!form.image_path_primary"
                                        >
                                            <path
                                                fill="#dd1e50"
                                                d="M10 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-4-2a.5.5 0 0 0-1 0V5H3.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V6h1.5a.5.5 0 0 0 0-1H6V3.5Zm8 .5h-3.207a5.466 5.466 0 0 0-.393-1H14a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-3.6c.317.162.651.294 1 .393V14c0 .373.102.722.28 1.02l4.669-4.588a1.5 1.5 0 0 1 2.102 0l4.67 4.588A1.99 1.99 0 0 0 16 14V6a2 2 0 0 0-2-2Zm0 3.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm-1 0a.5.5 0 1 0-1 0a.5.5 0 0 0 1 0Zm-8.012 8.226A1.99 1.99 0 0 0 6 16h8c.37 0 .715-.1 1.012-.274l-4.662-4.58a.5.5 0 0 0-.7 0l-4.662 4.58Z"
                                            />
                                        </svg>
                                        <p class="text-xs mt-3 mb-0">
                                            {{
                                                form.photoNamePrimary
                                                    ? ``
                                                    : `Select image by`
                                            }}
                                            <br />
                                            <strong>{{
                                                form.photoNamePrimary
                                                    ? ``
                                                    : `clicking here`
                                            }}</strong>
                                        </p>
                                    </button>

                                    <HasError
                                        :form="form"
                                        :field="`image_path_primary`"
                                    />

                                    <p
                                        class="text-xs mt-1"
                                        v-show="form.photoNamePrimary"
                                    >
                                        {{ form.photoNamePrimary }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label"
                                for="category_id"
                            >
                                Secondary Photos
                                <strong class="text-danger"> *</strong>
                                <p class="text-xs mt-2">
                                    Add atleast 2 photos showcasing your
                                    product.
                                </p>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="
                                        d-flex
                                        align-items-start
                                        flex-row flex-wrap
                                        gap
                                    "
                                >
                                    <div
                                        class="img-full"
                                        v-for="(n, index) in 5"
                                    >
                                        <div>
                                            <input
                                                type="file"
                                                style="display: none"
                                                @change.prevent="
                                                    fileSelected(
                                                        $event,
                                                        `${index}`
                                                    )
                                                "
                                                ref="fileInput"
                                                name="product_image_path"
                                            />

                                            <button
                                                class="image-upload-box"
                                                :style="{
                                                    'background-image':
                                                        'url(' +
                                                        url[index] +
                                                        ')',
                                                }"
                                                @click.prevent="
                                                    $refs.fileInput[
                                                        index
                                                    ].click()
                                                "
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="48"
                                                    height="48"
                                                    preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 20 20"
                                                    v-show="
                                                        !form.image_path[index]
                                                    "
                                                >
                                                    <path
                                                        fill="#dd1e50"
                                                        d="M10 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-4-2a.5.5 0 0 0-1 0V5H3.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V6h1.5a.5.5 0 0 0 0-1H6V3.5Zm8 .5h-3.207a5.466 5.466 0 0 0-.393-1H14a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-3.6c.317.162.651.294 1 .393V14c0 .373.102.722.28 1.02l4.669-4.588a1.5 1.5 0 0 1 2.102 0l4.67 4.588A1.99 1.99 0 0 0 16 14V6a2 2 0 0 0-2-2Zm0 3.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0Zm-1 0a.5.5 0 1 0-1 0a.5.5 0 0 0 1 0Zm-8.012 8.226A1.99 1.99 0 0 0 6 16h8c.37 0 .715-.1 1.012-.274l-4.662-4.58a.5.5 0 0 0-.7 0l-4.662 4.58Z"
                                                    />
                                                </svg>
                                                <p class="text-xs mt-3 mb-0">
                                                    {{
                                                        form.photoName[index]
                                                            ? ``
                                                            : `Select image by`
                                                    }}
                                                    <br />
                                                    <strong>{{
                                                        form.photoName[index]
                                                            ? ``
                                                            : `clicking here`
                                                    }}</strong>
                                                </p>
                                            </button>

                                            <HasError
                                                :form="form"
                                                :field="`image_path.${index}`"
                                            />

                                            <p
                                                class="text-xs mt-1"
                                                v-show="form.photoName[index]"
                                            >
                                                {{ form.photoName[index] }}
                                            </p>
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

                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="base_price"
                            >
                                Base Price
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Remember to factor in the cost of materials,
                                    labor, and other business expenses.
                                </p>
                                <p class="text-grey text-xs mt-1">
                                    If you don't have a base price, please input
                                    <strong>0.00</strong>
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
                                <HasError :form="form" field="has_inventory" />
                            </div>
                        </div>
                        <div
                            class="form-group row"
                            v-show="form.has_inventory == 1"
                        >
                            <label
                                class="col-md-3 col-form-label"
                                for="quantity"
                            >
                                Inventory
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
                    </div>

                    <!-- Variation -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Variations</h4>

                        <p class="mb-3 mb-md-4 note">
                            Add available options like color or size, and give
                            your customers the opportunity to customize their
                            products.
                        </p>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Do you allow the buyers to add a small message
                                on your product?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="
                                        custom-control
                                        custom-radio
                                        custom-control-inline
                                    "
                                >
                                    <input
                                        type="radio"
                                        id="has_custom_text1"
                                        name="has_custom_text"
                                        class="custom-control-input"
                                        v-model="form.has_custom_text"
                                        value="1"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_custom_text1"
                                        >Yes
                                    </label>
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
                                        id="has_custom_text2"
                                        name="has_custom_text"
                                        class="custom-control-input"
                                        v-model="form.has_custom_text"
                                        value="0"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_custom_text2"
                                        >No
                                    </label>
                                </div>
                                <HasError
                                    :form="form"
                                    field="has_custom_text"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Will this item have weight as a variation?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="
                                        custom-control
                                        custom-radio
                                        custom-control-inline
                                    "
                                >
                                    <input
                                        type="radio"
                                        id="has_weight1"
                                        name="has_weight"
                                        class="custom-control-input"
                                        v-model="has_weight"
                                        :value="true"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_weight1"
                                        >Yes
                                    </label>
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
                                        id="has_weight2"
                                        name="has_weight"
                                        class="custom-control-input"
                                        v-model="has_weight"
                                        :value="false"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_weight2"
                                        >No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div
                            class="form-group row"
                            v-show="has_weight === false"
                        >
                            <label class="col-md-3 col-form-label" for="weight">
                                Item weight
                            </label>

                            <div class="col-md-4 col-6">
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
                            <div class="col-md-4 col-6">
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
                                    <option value="lb">Pounds (lb)</option>
                                    <option value="kg">Kilograms (kg)</option>
                                    <option value="gm">Grams (gm)</option>
                                </select>
                                <HasError :form="form" field="weight_unit" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Will this item have variations?
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-9">
                                <div
                                    class="
                                        custom-control
                                        custom-radio
                                        custom-control-inline
                                    "
                                >
                                    <input
                                        type="radio"
                                        id="has_variations1"
                                        name="has_variations"
                                        class="custom-control-input"
                                        v-model="form.has_variations"
                                        value="1"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_variations1"
                                        >Yes
                                    </label>
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
                                        id="has_variations2"
                                        name="has_variations"
                                        class="custom-control-input"
                                        v-model="form.has_variations"
                                        value="0"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="has_variations2"
                                        >No
                                    </label>
                                </div>
                                <HasError :form="form" field="has_variations" />
                            </div>
                        </div>
                        <div v-show="form.has_variations == 1">
                            <div class="form-group">
                                <label class="col-form-label" for="">
                                    Add new Variations
                                    <strong class="text-danger"> *</strong>
                                    <p class="text-grey text-xs mt-2 mb-0">
                                        You may add upto
                                        <strong>3</strong> variation types. Each
                                        type may have upto
                                        <strong>3</strong> options.
                                    </p>
                                </label>
                            </div>
                            <div
                                class="
                                    card
                                    dashboard-info-card dashboard-var-card
                                    mb-4
                                "
                                v-show="variation.variationMode"
                                v-for="(
                                    variation, index
                                ) in form.productVariation"
                            >
                                <!-- Header -->
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        align-items-center
                                        justify-content-between
                                    "
                                >
                                    <h5>
                                        Variation {{ index + 1 }}
                                        {{ variation.variation_name }}
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn btn-light btn-sm"
                                        @click.prevent="delVariation(index)"
                                    >
                                        <i class="fas fa-times mr-2"></i>
                                        Remove
                                    </button>
                                </div>

                                <hr class="mt-2" />
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for=""
                                    >
                                        Type
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <div class="col-md-4">
                                        <input
                                            id="productVariation.variation_name"
                                            v-model="variation.variation_name"
                                            type="text"
                                            name="productVariation.variation_name"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Variation Type"
                                        />
                                        <HasError
                                            :form="form"
                                            :field="`productVariation.${index}.variation_name`"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row mb-md-1">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="variation_description"
                                    >
                                        Description
                                        <p class="text-grey text-xs mt-2 mb-0">
                                            Explain your variation shortly if
                                            neccessary.
                                        </p>
                                    </label>
                                    <div class="col-md-9">
                                        <input
                                            id="variation_description"
                                            v-model="
                                                variation.variation_description
                                            "
                                            type="text"
                                            name="variation_description"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Description"
                                        />
                                        <HasError
                                            :form="form"
                                            :field="`productVariation.${index}.variation_description`"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">
                                        Variation Options
                                        <strong class="text-danger"> *</strong>
                                        <p class="text-grey text-xs mt-2 mb-0">
                                            Variation will not be saved if no
                                            options are given. If options don't
                                            have individual prices, then input 0
                                            in price.
                                        </p>
                                    </label>
                                    <div class="">
                                        <div
                                            class="
                                                table-responsive
                                                form-table
                                                mt-md-2
                                            "
                                        >
                                            <table
                                                class="table align-items-center"
                                            >
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Option
                                                            <strong
                                                                class="
                                                                    text-danger
                                                                "
                                                            >
                                                                *
                                                            </strong>
                                                        </th>
                                                        <th>
                                                            Price
                                                            <strong
                                                                class="
                                                                    text-danger
                                                                "
                                                            >
                                                                *
                                                            </strong>
                                                            <i
                                                                class="
                                                                    fas
                                                                    fa-info-circle
                                                                    ml-2
                                                                "
                                                                data-toggle="modal"
                                                                data-target="#infoModalPricing"
                                                            ></i>
                                                        </th>
                                                        <th
                                                            class="smwidth"
                                                            v-show="
                                                                form.has_inventory ==
                                                                1
                                                            "
                                                        >
                                                            Inventory
                                                        </th>
                                                        <th class="smwidth">
                                                            SKU
                                                        </th>
                                                        <th
                                                            class="tiny-col"
                                                        ></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            item, i
                                                        ) in variation.option_list"
                                                    >
                                                        <td>
                                                            <input
                                                                name="option_name"
                                                                id="option_name"
                                                                v-model="
                                                                    variation
                                                                        .option_name[
                                                                        i
                                                                    ]
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
                                                                :field="`productVariation.${index}.option_name.${i}`"
                                                            />
                                                        </td>
                                                        <td
                                                            class="
                                                                d-flex
                                                                align-items-center
                                                            "
                                                        >
                                                            <p
                                                                class="
                                                                    text-grey
                                                                    text-xs
                                                                    mb-0
                                                                    mr-1
                                                                "
                                                            >
                                                                {{
                                                                    form.base_price
                                                                }}
                                                            </p>
                                                            <p
                                                                class="
                                                                    text-grey
                                                                    text-xs
                                                                    mb-0
                                                                    mr-2
                                                                "
                                                            >
                                                                +
                                                            </p>

                                                            <input
                                                                id="option_price"
                                                                v-model="
                                                                    variation
                                                                        .option_price[
                                                                        i
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="option_price"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="price"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productVariation.${index}.option_price.${i}`"
                                                            />
                                                        </td>
                                                        <td
                                                            v-show="
                                                                form.has_inventory ==
                                                                1
                                                            "
                                                        >
                                                            <input
                                                                id="option_quantity"
                                                                v-model="
                                                                    variation
                                                                        .option_quantity[
                                                                        i
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="option_quantity"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="qty"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productVariation.${index}.option_quantity.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="productVariation.option_sku"
                                                                v-model="
                                                                    variation
                                                                        .option_sku[
                                                                        i
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="productVariation.option_sku"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="option sku"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productVariation.${index}.option_sku.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="
                                                                    btn
                                                                    btn-light
                                                                    btn-sm
                                                                "
                                                                href=""
                                                                @click.prevent="
                                                                    delRow(
                                                                        index,
                                                                        i
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="
                                                                        fas
                                                                        fa-times
                                                                    "
                                                                ></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <button
                                                                type="button"
                                                                class="
                                                                    btn-sm
                                                                "
                                                                @click.prevent="
                                                                    addRow(
                                                                        index
                                                                    )
                                                                "
                                                                v-show="
                                                                    variation.variation_name &&
                                                                    variation
                                                                        .option_list
                                                                        .length <
                                                                        3
                                                                "
                                                            >
                                                                <i
                                                                    class="
                                                                        fas
                                                                        fa-plus
                                                                    "
                                                                ></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="form-group"
                                v-show="showAddVariationBtn()"
                            >
                                <button
                                    class="btn-sm"
                                    type="button"
                                    @click.prevent="setVariationMode"
                                >
                                    Add a Variation
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Shipping</h4>

                        <p class="mb-3 mb-md-4 note">
                            Set clear and realistic shipping expectations for
                            shoppers
                        </p>

                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="processing_time"
                            >
                                Processing Time
                                <strong class="text-danger"> *</strong>
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
                                    <option value="1">1 day</option>
                                    <option value="2">2 days</option>
                                    <option value="3">3 days</option>
                                    <option value="4">4 days</option>
                                    <option value="5">5 days</option>
                                    <option value="6">6 days</option>
                                    <option value="7">7 days</option>
                                    <option value="8">8 days</option>
                                    <option value="9">9 days</option>
                                </select>
                                <HasError
                                    :form="form"
                                    field="processing_time"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="input-form text-center mt-4">
                        <button
                            type="button"
                            class="btn-grey mr-3"
                            @click="cancel()"
                        >
                            <i class="fas fa-times mr-2" aria-hidden="true"></i>
                            Cancel
                        </button>
                        <button type="submit" :disabled="submitButtonDisabled">
                            <i class="fas fa-save mr-2" aria-hidden="true"></i>
                            {{ submitButtonText }}
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
            <div class="modal-dialog modal-dialog-centered" role="document">
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
                                        @change.prevent="
                                            storeOccasionName(occasion.name)
                                        "
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
                                        @change.prevent="
                                            storeRecipientName(recipient.name)
                                        "
                                    />
                                    {{ recipient.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn"
                            @click.prevent="closeModal"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Product Listed Successfully"
            msg="Your product has been saved. It will now display on the website."
            gotoRoute="/seller/products"
        />
        <fail-modal
            id="fail-modal"
            msgTitle="Product Listing Failed"
            msg="There are errors in your form input. Please double check."
        />
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
        submitButtonText: "Save",
        submitButtonDisabled: false,
        occasionMode: false,
        recipientMode: false,
        categories: [],
        sub_categories: [],
        occasions: [],
        recipients: [],
        sellers: [],
        url: [],
        urlPrimary: "",
        occasionName: [],
        recipientName: [],
        has_weight: "",

        form: new Form({
            id: "",
            sku: "",
            title: "",
            short_description: "",
            description: "",
            material: "",
            length: "",
            width: "",
            height: "",
            dimensions_unit: "",
            weight: "",
            weight_unit: "",
            base_price: "",
            processing_time: "",
            has_custom_text: "",
            has_custom_image: false,
            has_variations: "",
            has_inventory: "",
            has_giftwrap: "",
            quantity: "",
            category_id: "",
            image_path: [],
            photoName: [],
            image_path_primary: "",
            photoNamePrimary: "",

            //pivot table arrays
            product_occasion: [],
            product_recipient: [],
            product_sub_category: [],

            //variation fields
            productVariation: [
                {
                    variationMode: false,
                    variation_name: "",
                    variation_description: "",
                    option_list: [],
                    option_name: [],
                    option_sku: [],
                    option_price: [],
                    option_quantity: [],
                },
                {
                    variationMode: false,
                    variation_name: "",
                    variation_description: "",
                    option_list: [],
                    option_name: [],
                    option_sku: [],
                    option_price: [],
                    option_quantity: [],
                },
                {
                    variationMode: false,
                    variation_name: "",
                    variation_description: "",
                    option_list: [],
                    option_name: [],
                    option_sku: [],
                    option_price: [],
                    option_quantity: [],
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
        displayInfoBox(name) {
            if (document.getElementById(name).style.display == "inline-block") {
                document.getElementById(name).style.display = "none";
            } else {
                document.getElementById(name).style.display = "inline-block";
            }
        },

        /*
         * Image
         */

        fileSelectedPrimary(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.image_path_primary = reader.result;
                this.form.photoNamePrimary = e.target.files[0].name;
                this.urlPrimary = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
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
                this.$set(this.form.image_path, imagenum, reader.result);
                this.$set(
                    this.form.photoName,
                    imagenum,
                    e.target.files[0].name
                );
                this.$set(
                    this.url,
                    imagenum,
                    URL.createObjectURL(e.target.files[0])
                );
            };
            reader.readAsDataURL(file);
        },

        /*
         * Variation
         */
        setVariationMode() {
            switch (false) {
                case this.form.productVariation[0].variationMode:
                    this.form.productVariation[0].variationMode = true;
                    break;
                case this.form.productVariation[1].variationMode:
                    this.form.productVariation[1].variationMode = true;
                    break;
                case this.form.productVariation[2].variationMode:
                    this.form.productVariation[2].variationMode = true;
                    break;
            }
        },

        showAddVariationBtn() {
            if (
                this.form.productVariation[0].variationMode == false ||
                this.form.productVariation[1].variationMode == false ||
                this.form.productVariation[2].variationMode == false
            ) {
                return true;
            } else return false;
        },

        addRow(count) {
            this.form.productVariation[count].option_list.push("1");
        },

        delRow(count, i) {
            let variant = this.form.productVariation[count];
            variant.option_list.splice(i, 1);
            variant.option_name.splice(i, 1);
            variant.option_sku.splice(i, 1);
            variant.option_price.splice(i, 1);
            variant.option_quantity.splice(i, 1);
        },

        delVariation(count) {
            let variant = this.form.productVariation[count];
            variant.variationMode = false;
            variant.variation_name = "";
            variant.variation_description = "";
            variant.option_list = [];
            variant.option_name = [];
            variant.option_sku = [];
            variant.option_price = [];
            variant.option_quantity = [];
            $("#addRecord").modal("hide");
        },

        /*
         * Form Functions
         */

        cancel() {
            this.$router.push("/seller/products");
        },

        storeOccasionName(name) {
            if (this.occasionName.includes(name)) {
                let index = this.occasionName.indexOf(name);
                this.occasionName.splice(index, 1);
            } else {
                this.occasionName.push(name);
            }
        },

        storeRecipientName(name) {
            if (this.recipientName.includes(name)) {
                let index = this.recipientName.indexOf(name);
                this.recipientName.splice(index, 1);
            } else {
                this.recipientName.push(name);
            }
        },

        check(event) {
            event.target.value = true;
        },

        subcategoryModal(mode) {
            this[mode] = true;
            $("#addRecord").modal("show");
        },

        closeModal() {
            this.occasionMode = false;
            this.recipientMode = false;
            $("#addRecord").modal("hide");
        },

        loadDetails() {
            axios
                .get("/api/seller/products/details")
                .then((response) => {
                    this.categories = response.data.categories;
                    this.occasions = response.data.occasions;
                    this.recipients = response.data.recipients;
                })
                .catch((error) => console.log(error));
        },

        loadSubcategories(event) {
            axios
                .get(
                    "/api/seller/products/sub_categories/" + event.target.value
                )
                .then((response) => {
                    this.sub_categories = response.data.sub_categories;
                })
                .catch((error) => console.log(error));
        },

        createProduct() {
            if (this.form.has_inventory == "0") {
                this.form.quantity = "0";
            }

            if (this.form.length != "") {
                this.form.dimensions_unit = "in";
            }

            if (this.has_weight === true) {
                this.form.weight = "";
                this.form.weight_unit = "";
            }

            if (this.form.has_variations == 0) {
                for (let i = 0; i < this.form.productVariation.length; i++) {
                    let variant = this.form.productVariation[i];
                    variant.variationMode = false;
                    variant.variation_name = "";
                    variant.variation_description = "";
                    variant.option_list = [];
                    variant.option_name = [];
                    variant.option_sku = [];
                    variant.option_price = [];
                    variant.option_quantity = [];
                }
            }

            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.form
                .post("/api/seller/products")
                .then(() => {
                    this.submitButtonText = "Saved";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                    this.sendProductListingConfirmedMail();
                })
                .catch((error) => {
                    this.submitButtonText = "Save";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },

        sendProductListingConfirmedMail() {
            axios
                .get("/api/email/new_product_listed")
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.loadDetails();
    },
};
</script>
