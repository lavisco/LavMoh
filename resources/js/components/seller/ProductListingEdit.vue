<template>
    <div class="container mt-3 mb-5">
        <div
            v-if="loading"
            class="my-5 d-flex align-items-center justify-content-center"
        >
            <img src="/images/lavisco/loading.gif" />
        </div>
        <div v-else class="row">
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
                            {{ form.title }}
                        </li>
                    </ol>
                </nav>

                <!-- Form start -->
                <form class="input-form" @submit.prevent="updateProduct()">
                    <!-- Listing -->
                    <div class="card dashboard-info-card">
                        <!-- Header -->
                        <h4 class="mb-3">
                            Listing Details of {{ form.title }}
                        </h4>
                        <hr class="mt-0" />
                        <p class="mb-3 mb-md-4 note">
                            Update your product's information here.
                        </p>

                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="title">
                                Title
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
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
                                <p class="mt-2 mb-0">
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
                                <p class="mt-2 mb-0">
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
                                <p class="text-grey text-xs mt-2">
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
                        <div class="form-group row">
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
                                    placeholder="Ingredient"
                                />
                                <HasError :form="form" field="material" />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <label class="col-md-3 col-form-label" for="length">
                                Item Dimensions
                                <p class="text-grey text-xs mt-2">
                                    Enter a rough estimation of your item size.
                                </p>
                            </label>

                            <div class="col-md-2 col-6">
                                <label class="col-form-label" for="length">
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
                            <div class="col-md-2 col-6">
                                <label class="col-form-label" for="width">
                                    Width
                                </label>
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
                            <div class="col-md-2 col-6 mt-2 mt-md-0">
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
                            <div class="col-md-3 col-6 mt-2 mt-md-0">
                                <label
                                    class="col-form-label"
                                    for="dimensions_unit"
                                >
                                    Unit
                                </label>
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
                        <p class="mb-4 note">
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
                                        flex-column flex-md-row flex-wrap
                                    "
                                >
                                    <div
                                        class="mr-md-3 img-full"
                                        v-for="(image, index) in images"
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

                                            <HasError
                                                :form="form"
                                                :field="`image_path.${index}`"
                                            />

                                            <button
                                                class="image-upload-box"
                                                :class="{
                                                    'image-upload-box-primary':
                                                        image.primary_image ==
                                                        '1',
                                                }"
                                                @click.prevent="
                                                    $refs.fileInput[
                                                        index
                                                    ].click()
                                                "
                                            >
                                                <img
                                                    class="banner-container"
                                                    :src="
                                                        form.path[index]
                                                            ? form.path[index]
                                                            : '/images/lavisco/img-bg.jpg'
                                                    "
                                                />
                                            </button>

                                            <p
                                                class="
                                                    image-upload-filename
                                                    my-0
                                                "
                                            >
                                                {{ form.image_title[index] }}
                                                {{
                                                    image.primary_image == "1"
                                                        ? `: Primary (shows up on thumbnail)`
                                                        : ""
                                                }}
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="mr-md-3 img-full"
                                        v-for="(n, index) in emptyImageSlot"
                                    >
                                        <div>
                                            <input
                                                type="file"
                                                style="display: none"
                                                @change.prevent="
                                                    fileSelectedNew(
                                                        $event,
                                                        `${index}`
                                                    )
                                                "
                                                ref="fileInput2"
                                                name="product_image_path2"
                                            />

                                            <button
                                                class="image-upload-box"
                                                @click.prevent="
                                                    $refs.fileInput2[
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
                                                    my-0
                                                "
                                            >
                                                {{
                                                    form.photoName[index]
                                                        ? form.photoName[index]
                                                        : `Select Image`
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
                            <div class="col-md-4">
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

                        <div
                            class="card px-4 pb-4 my-2"
                            v-for="(item, i) in variations"
                        >
                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    align-items-center
                                "
                            >
                                <h5 class="mb-4">Variation {{ i + 1 }}</h5>
                                <a
                                    class="btn btn-light btn-sm"
                                    href=""
                                    @click.prevent="
                                        deleteProductVariations(
                                            form.variation_id[i]
                                        )
                                    "
                                >
                                    Delete
                                </a>
                            </div>

                            <div class="form-group row mb-md-1">
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="variation_type"
                                        >Type
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="variation_type"
                                        v-model="form.variation_type[i]"
                                        type="text"
                                        name="variation_type"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Type"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_type.${i}`"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="variation_type_option"
                                        >Type Option
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="variation_type_option"
                                        v-model="form.variation_type_option[i]"
                                        type="text"
                                        name="variation_type_option"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Option"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_type_option.${i}`"
                                    />
                                </div>
                                <div class="col-md-2">
                                    <label
                                        class="col-form-label"
                                        for="variation_price"
                                        >Price
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="variation_price"
                                        v-model="form.variation_price[i]"
                                        type="text"
                                        name="variation_price"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Price"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_price.${i}`"
                                    />
                                </div>
                                <div class="col-md-2">
                                    <label
                                        class="col-form-label"
                                        for="variation_quantity"
                                        >Inventory
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="variation_quantity"
                                        v-model="form.variation_quantity[i]"
                                        type="number"
                                        name="variation_quantity"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Qty"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_quantity.${i}`"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-md-1">
                                <div class="col-md-8">
                                    <label
                                        class="col-form-label"
                                        for="variation_description"
                                        >Description
                                    </label>
                                    <input
                                        id="variation_description"
                                        v-model="form.variation_description[i]"
                                        type="text"
                                        name="variation_description"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Variation Description"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_description.${i}`"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="variation_sku"
                                        >SKU
                                    </label>
                                    <input
                                        id="variation_sku"
                                        v-model="form.variation_sku[i]"
                                        type="text"
                                        name="variation_sku"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="SKU"
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`variation_sku.${i}`"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p v-for="(n, index) in emptyVariationSlot">oho</p>

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
                            class="btn btn-primary"
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
            id="addRecord"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
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
                        <button
                            type="button"
                            class="close"
                            @click.prevent="closeModal"
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
                    <div class="modal-footer pt-0">
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
            msgTitle="Product Listing Update Successful"
            msg="Your product has been updated. Changes will reflect on the website."
            gotoRoute="noroute"
        />
        <fail-modal
            id="fail-modal"
            msgTitle="Product Listing Update Failed"
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
        submitButtonText: "Update",
        submitButtonDisabled: false,
        hasError: false,
        occasionMode: false,
        recipientMode: false,
        loading: true,
        productStates: [],
        categories: [],
        occasions: [],
        recipients: [],
        shippings: [],
        product: "",
        images: {},
        emptyImageSlot: "",
        variations: {},
        occasionName: [],
        recipientName: [],
        url: [],

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
            has_custom_image: "",
            has_variations: "",
            has_inventory: "",
            has_giftwrap: "",
            quantity: "",
            product_state_id: "",
            category_id: "",
            user_id: "",
            occasions: [],
            recipients: [],
            shippings: [],
            product_occasion: [],
            product_recipient: [],
            product_shipping: [],

            image_path_new: [],
            photoName: [],

            //image
            image_id: [],
            image_path: [],
            path: [],
            image_title: [],
            primary_image: [],

            //variations
            variation_id: [],
            variation_type: [],
            variation_type_option: [],
            variation_sku: [],
            variation_description: [],
            variation_price: [],
            variation_quantity: [],
        }),
    }),

    computed: {
        existingVariations() {
            return _.groupBy(this.variations, (variation) => variation.type);
        },
        emptyVariationSlot() {
            let existingVariationsArray = [];
            for (let x in this.existingVariations) {
                existingVariationsArray.push(x);
            }
            return 3 - existingVariationsArray.length;
        },
    },

    methods: {
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
                    this.form.image_title,
                    imagenum,
                    e.target.files[0].name
                );
                this.$set(this.form.primary_image, imagenum, 0);
                this.$set(
                    this.form.path,
                    imagenum,
                    URL.createObjectURL(e.target.files[0])
                );
            };
            reader.readAsDataURL(file);
        },

        fileSelectedNew(e, imagenum) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }

            reader.onloadend = (file) => {
                this.$set(this.form.image_path_new, imagenum, reader.result);
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

        loadProductImages() {
            axios
                .get("/api/seller/product_images/", {
                    params: { productId: this.$route.params.productId },
                })
                .then(({ data }) => {
                    this.images = data;

                    this.emptyImageSlot = 6 - this.images.length;

                    this.form.image_path_new = [];
                    this.form.photoName = [];

                    this.form.image_id = [];
                    this.form.image_path = [];
                    this.form.primary_image = [];
                    this.form.path = [];
                    this.form.image_title = [];

                    this.images.forEach((value, index) => {
                        this.form.image_id.push(value.id);
                        this.form.image_path.push(value.image_path);
                        this.form.primary_image.push(value.primary_image);
                        this.form.path.push(value.path);
                        this.form.image_title.push(value.title);
                    });
                })
                .catch((error) => console.log(error));
        },

        updateProductImages() {
            this.form
                .put(
                    "/api/seller/product_images/" + this.$route.params.productId
                )
                .then(() => {
                    this.hasError = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.hasError = true;
                    $("#fail-modal").modal("show");
                });
        },

        storeNewImage() {
            this.form
                .put("/api/seller/products/storeNewImage/" + this.form.id)
                .then(() => {
                    this.hasError = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.hasError = true;
                    $("#fail-modal").modal("show");
                });
        },

        /*
         * Variation
         */

        loadProductVariations() {
            this.form.variation_id = [];
            this.form.variation_type = [];
            this.form.variation_type_option = [];
            this.form.variation_sku = [];
            this.form.variation_description = [];
            this.form.variation_price = [];
            this.form.variation_quantity = [];

            axios
                .get(
                    "/api/seller/product_variations/" +
                        this.$route.params.productId
                )
                .then(({ data }) => {
                    this.variations = data;

                    this.variations.forEach((value, index) => {
                        this.$set(this.form.variation_id, index, value.id);
                        this.$set(this.form.variation_type, index, value.type);
                        this.$set(
                            this.form.variation_type_option,
                            index,
                            value.type_option
                        );
                        this.$set(this.form.variation_sku, index, value.sku);
                        this.$set(
                            this.form.variation_description,
                            index,
                            value.description
                        );
                        this.$set(
                            this.form.variation_price,
                            index,
                            value.price
                        );
                        this.$set(
                            this.form.variation_quantity,
                            index,
                            value.quantity
                        );
                    });

                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        updateProductVariations() {
            this.form
                .put(
                    "/api/seller/product_variations/" +
                        this.$route.params.productId
                )
                .then(() => {
                    this.hasError = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.hasError = true;
                    $("#fail-modal").modal("show");
                });
        },

        deleteProductVariations(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/seller/product_variations/" + id)
                    .then(() => {
                        this.loadProduct();
                        this.hasError = false;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.hasError = true;
                        $("#fail-modal").modal("show");
                    });
            }
        },

        /*
         * Product
         */

        loadProductStates() {
            axios
                .get("/api/seller/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
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

        loadProduct() {
            axios
                .get("/api/seller/products/" + this.$route.params.productId)
                .then(({ data }) => {
                    this.form.fill(data);
                    this.loadPivotVariables();
                    this.loadProductImages();
                    this.loadProductVariations();
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadPivotVariables() {
            this.form.product_occasion = [];
            this.form.product_recipient = [];
            this.form.product_shipping = [];

            if (this.form.occasions != null) {
                this.form.occasions.forEach((value) => {
                    this.form.product_occasion.push(value.id);
                    this.occasionName.push(value.name);
                });
            }
            if (this.form.recipients != null) {
                this.form.recipients.forEach((value) => {
                    this.form.product_recipient.push(value.id);
                    this.recipientName.push(value.name);
                });
            }
            if (this.form.shippings != null) {
                this.form.shippings.forEach((value) => {
                    this.form.product_shipping.push(value.id);
                });
            }
        },

        updateProduct() {
            if (this.form.has_inventory == 0) {
                this.form.quantity == "";
            }

            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.updateProductImages();
            this.storeNewImage();
            this.updateProductVariations();

            this.form
                .put("/api/seller/products/" + this.form.id)
                .then(() => {
                    this.submitButtonText = "Update";
                    this.submitButtonDisabled = false;
                    this.hasError == false
                        ? $("#success-modal").modal("show")
                        : "";
                })
                .catch((error) => {
                    this.submitButtonText = "Update";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },
    },
    mounted() {
        this.loadProduct();
        this.loadProductStates();
        this.loadDetails();
    },
};
</script>
