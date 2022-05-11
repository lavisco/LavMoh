<template>
    <div class="container">
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
                                    class="btn btn-sm"
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
                                    class="btn btn-sm"
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
                                Ingredients
                                <p class="text-xs mt-2">
                                    Mention the ingredients used in your
                                    product, seperated by a comma. E.g. milk,
                                    sugar, honey
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

                            <div class="col-md-3 col-6">
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
                                    placeholder="Length"
                                />
                                <HasError :form="form" field="length" />
                            </div>
                            <div class="col-md-3 col-6">
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
                                    placeholder="Breadth"
                                />
                                <HasError :form="form" field="width" />
                            </div>
                            <div class="col-md-3 col-6 mt-2 mt-md-0">
                                <label class="col-form-label" for="height">
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
                                    placeholder="Height"
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
                        <hr class="mt-0" />
                        <p class="mb-3 mb-md-4 note">
                            Add atleast 3 photos showcasing your product. The
                            Primary photo is the first image customers see in
                            the product page.
                        </p>

                        <div class="form-group row">
                            <div class="col">
                                <div
                                    class="
                                        d-flex
                                        align-items-start
                                        justify-content-center
                                        flex-row flex-wrap
                                        gap
                                    "
                                >
                                    <div
                                        class="img-full"
                                        v-for="(n, index) in 6"
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

                                            <HasError
                                                :form="form"
                                                :field="`image_path.${index}`"
                                            />

                                            <p
                                                class="
                                                    image-upload-filename
                                                    my-0
                                                "
                                            >
                                                {{
                                                    form.photoName[index]
                                                        ? form.photoName[index]
                                                        : `Select Image`
                                                }}
                                                {{
                                                    index == 0
                                                        ? `: Primary (shows up on thumbnail)`
                                                        : ""
                                                }}
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
                        <hr class="mt-0" />
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
                        <hr class="mt-0" />
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
                                    <option>lb</option>
                                    <option>kg</option>
                                    <option>gm</option>
                                    <option>oz</option>
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
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="">
                                    Add new Variations
                                    <strong class="text-danger"> *</strong>
                                    <p class="text-grey text-xs mt-2 mb-0">
                                        You may add upto
                                        <strong>3</strong> variation types. Each
                                        type may have upto
                                        <strong>3</strong> options.
                                    </p>
                                </label>
                                <div class="col-md-9">
                                    <button
                                        class="btn btn-sm"
                                        type="button"
                                        @click.prevent="setVariationMode"
                                    >
                                        Add a Variation
                                    </button>
                                </div>
                            </div>
                            <div
                                class="
                                    card
                                    dashboard-info-card dashboard-var-card
                                    mt-2
                                    mb-3
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
                                        Variation
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
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for=""
                                    >
                                        Variation Options
                                        <strong class="text-danger"> *</strong>
                                        <p class="text-grey text-xs mt-2 mb-0">
                                            Variation will not be saved if no
                                            options are given.
                                        </p>
                                        <p class="text-grey text-xs mt-1 mb-0">
                                            If options don't have individual
                                            prices, then input 0 in price.
                                        </p>
                                    </label>
                                    <div class="col-md-9">
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
                                                        <th class="smwidth">
                                                            Price
                                                            <strong
                                                                class="
                                                                    text-danger
                                                                "
                                                            >
                                                                *
                                                            </strong>
                                                        </th>
                                                        <th class="smwidth">
                                                            Inventory
                                                        </th>
                                                        <th>SKU</th>
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
                                                        <td>
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
                                                        <td>
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
                                                                    btn btn-sm
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
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Shipping</h4>
                        <hr class="mt-0" />
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
                    </div>

                    <div class="input-form text-center mt-4">
                        <button
                            type="button"
                            class="btn btn-grey mr-3"
                            @click="cancel()"
                        >
                            <i class="fas fa-times mr-2" aria-hidden="true"></i>
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn"
                            :disabled="submitButtonDisabled"
                        >
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
        submitButtonText: "Save & Continue",
        submitButtonDisabled: false,
        occasionMode: false,
        recipientMode: false,
        categories: [],
        occasions: [],
        recipients: [],
        sellers: [],
        url: [],
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
        /*
         * Image
         */

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
                    this.submitButtonText = "Save & Continue";
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
