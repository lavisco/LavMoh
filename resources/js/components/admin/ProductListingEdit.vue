<template>
    <div class="container-fluid mt-4 mb-5">
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-sm">
                            <router-link to="/admin/products">
                                Products
                            </router-link>
                        </li>
                        <li
                            class="breadcrumb-item text-sm active"
                            aria-current="page"
                        >
                            {{ form.title }}
                        </li>
                    </ol>
                </nav>

                <!-- Form start -->
                <form class="input-form" @submit.prevent="updateProduct()">
                    <!-- Listing -->
                    <div class="card px-4 py-4">
                        <!-- Header -->
                        <h3 class="mb-3">
                            Listing Details of {{ form.title }}
                        </h3>
                        <hr class="mt-0 mb-2" />
                        <p class="text-grey text-sm mb-4 mt-0">
                            Update your product's information here.
                        </p>

                        <div class="form-group row">
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
                            <label class="col-md-3 col-form-label" for="slug">
                                Slug
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Only edit if there's no slug
                                </p>
                            </label>

                            <div class="col-md-9">
                                <input
                                    id="slug"
                                    v-model="form.slug"
                                    type="text"
                                    name="slug"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="slug"
                                />
                                <HasError :form="form" field="slug" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="user_id"
                                >Seller & Product State
                                <strong class="text-danger"> *</strong>
                            </label>

                            <div class="col-md-4 col-sm-6">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="user_id"
                                    id="user_id"
                                    v-model="form.user_id"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Seller
                                    </option>
                                    <option
                                        v-for="seller in sellers"
                                        :value="seller.user_id"
                                    >
                                        {{ seller.name }}
                                    </option>
                                </select>
                                <HasError :form="form" field="user_id" />
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    name="product_state_id"
                                    id="product_state_id"
                                    v-model="form.product_state_id"
                                >
                                    <option value="" disabled selected hidden>
                                        Select State
                                    </option>
                                    <option
                                        v-for="productState in productStates"
                                        :value="productState.id"
                                    >
                                        {{ productState.state }}
                                    </option>
                                </select>
                                <HasError
                                    :form="form"
                                    field="product_state_id"
                                />
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
                                    v-model="form.product_sub_category[0]"
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
                        <div class="form-group row">
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
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Occasions
                                <p class="text-grey text-xs mt-2">
                                    Select the occasions your item is suitable
                                    for gifting
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn"
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
                                            badge badge-pill badge-info
                                            text-dark
                                            mr-2
                                        "
                                        v-for="occasion in occasionName"
                                    >
                                        {{ occasion }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Recipients
                                <p class="text-grey text-xs mt-2">
                                    Select the people to whom your item would be
                                    suitable for as a gift
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn"
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
                                            badge badge-pill badge-info
                                            text-dark
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
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="length">
                                Package Dimensions
                                <p class="text-grey text-xs mt-2">
                                    If applicable, enter a rough estimation of
                                    your product size when it's packaged.
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
                                <p>inches</p>
                            </div>
                        </div>

                        <div class="form-group row">
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
                    <div class="card px-4 py-4 mt-4">
                        <!-- Header -->
                        <h3 class="mb-3">Product Photos</h3>
                        <hr class="mt-0 mb-2" />
                        <p class="text-grey text-sm mb-4 mt-0">
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

                                            <HasError
                                                :form="form"
                                                :field="`image_path.${index}`"
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
                                                        d="M36.25 29C36.25 30.9228 35.4862 32.7669 34.1265 34.1265C32.7669 35.4862 30.9228 36.25 29 36.25C27.0772 36.25 25.2331 35.4862 23.8735 34.1265C22.5138 32.7669 21.75 30.9228 21.75 29C21.75 27.0772 22.5138 25.2331 23.8735 23.8735C25.2331 22.5138 27.0772 21.75 29 21.75C30.9228 21.75 32.7669 22.5138 34.1265 23.8735C35.4862 25.2331 36.25 27.0772 36.25 29ZM19.1255 10.2587C19.5768 9.3548 20.271 8.59445 21.1303 8.06301C21.9896 7.53156 22.9799 7.25003 23.9902 7.25H34.0098C35.0201 7.25003 36.0104 7.53156 36.8697 8.06301C37.729 8.59445 38.4232 9.3548 38.8745 10.2587L40.9951 14.5h33.5C45.4228 14.5 47.2669 15.2638 48.6265 16.6235C49.9862 17.9831 50.75 19.8272 50.75 21.75V39.875C50.75 41.7978 49.9862 43.6419 48.6265 45.0015C47.2669 46.3612 45.4228 47.125 43.5 47.125H14.5C12.5772 47.125 10.7331 46.3612 9.37348 45.0015C8.01384 43.6419 7.25 41.7978 7.25 39.875V21.75C7.25 19.8272 8.01384 17.9831 9.37348 16.6235C10.7331 15.2638 12.5772 14.5 14.5 14.5H17.0049L19.1255 10.2587ZM39.875 29C39.875 26.1158 38.7292 23.3497 36.6898 21.3102C34.6503 19.2708 31.8842 18.125 29 18.125C26.1158 18.125 23.3497 19.2708 21.3102 21.3102C19.2708 23.3497 18.125 26.1158 18.125 29C18.125 31.8842 19.2708 34.6503 21.3102 36.6898C23.3497 38.7292 26.1158 39.875 29 39.875C31.8842 39.875 34.6503 38.7292 36.6898 36.6898C38.7292 34.6503 39.875 31.8842 39.875 29Z"
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
                    <div class="card px-4 py-4 mt-4">
                        <!-- Header -->
                        <h3 class="mb-3">Inventory & Pricing</h3>
                        <hr class="mt-0 mb-2" />
                        <div class="form-group row">
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
                        <div class="form-group row">
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
                    <div class="card px-4 py-4 mt-4">
                        <!-- Header -->
                        <h3 class="mb-3">Variations</h3>
                        <hr class="mt-0 mb-2" />
                        <p class="text-grey text-sm mb-4 mt-0">
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

                        <div v-show="form.has_variations == 1">
                            <div
                                class="card border-light px-4 py-4 mt-2 mb-3"
                                v-for="(item, index) in variations"
                            >
                                <h4>
                                    Variation {{ index + 1 }} :
                                    {{ form.variation_name[index] }}
                                </h4>
                                <hr class="mt-2" />

                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="variation_name"
                                    >
                                        Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <div class="col-md-9">
                                        <input
                                            id="variation_name"
                                            v-model="form.variation_name[index]"
                                            type="text"
                                            name="variation_name"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Type"
                                        />
                                        <HasError
                                            :form="form"
                                            :field="`variation_name.${index}`"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for="variation_status"
                                    >
                                        Status
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <div class="col-md-4">
                                        <select
                                            class="
                                                custom-select
                                                form-control
                                                form-control-alternative
                                            "
                                            name="variation_state"
                                            id="variation_state"
                                            v-model="
                                                form.variation_state[index]
                                            "
                                        >
                                            <option
                                                value=""
                                                disabled
                                                selected
                                                hidden
                                            >
                                                Select State
                                            </option>
                                            <option
                                                v-for="productState in productStates"
                                                :value="productState.id"
                                            >
                                                {{ productState.state }}
                                            </option>
                                        </select>
                                        <HasError
                                            :form="form"
                                            :field="`variation_state.${index}`"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
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
                                                form.variation_description[
                                                    index
                                                ]
                                            "
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
                                            :field="`variation_description.${index}`"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row mb-md-1">
                                    <label
                                        class="col-md-3 col-form-label"
                                        for=""
                                    >
                                        Variation Options
                                        <strong class="text-danger"> *</strong>
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
                                                card
                                                mt-md-2
                                            "
                                        >
                                            <table
                                                class="table align-items-center"
                                            >
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Option Name
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
                                                        ) in variation_options"
                                                        v-show="
                                                            form
                                                                .option_variation_id[
                                                                i
                                                            ] ==
                                                            form.variation_id[
                                                                index
                                                            ]
                                                        "
                                                    >
                                                        <td>
                                                            <input
                                                                id="option_name"
                                                                v-model="
                                                                    form
                                                                        .option_name[
                                                                        i
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="option_name"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="Option"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`option_name.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="option_price"
                                                                v-model="
                                                                    form
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
                                                                placeholder="Price"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`option_price.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="option_quantity"
                                                                v-model="
                                                                    form
                                                                        .option_quantity[
                                                                        i
                                                                    ]
                                                                "
                                                                type="number"
                                                                name="option_quantity"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="Qty"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`option_quantity.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="option_sku"
                                                                v-model="
                                                                    form
                                                                        .option_sku[
                                                                        i
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="option_sku"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                placeholder="SKU"
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`option_sku.${i}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <select
                                                                class="
                                                                    custom-select
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                                name="option_state"
                                                                id="option_state"
                                                                v-model="
                                                                    form
                                                                        .option_state[
                                                                        i
                                                                    ]
                                                                "
                                                            >
                                                                <option
                                                                    value=""
                                                                    disabled
                                                                    selected
                                                                    hidden
                                                                >
                                                                    Select State
                                                                </option>
                                                                <option
                                                                    v-for="productState in productStates"
                                                                    :value="
                                                                        productState.id
                                                                    "
                                                                >
                                                                    {{
                                                                        productState.state
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        v-for="(
                                                            newOption,
                                                            optionIndex
                                                        ) in form
                                                            .productNewOption[
                                                            index
                                                        ].new_option_list"
                                                    >
                                                        <td>
                                                            <input
                                                                id="new_option_name"
                                                                v-model="
                                                                    form
                                                                        .productNewOption[
                                                                        index
                                                                    ]
                                                                        .new_option_name[
                                                                        optionIndex
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="new_option_name"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productNewOption.${index}.new_option_name.${optionIndex}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="new_option_price"
                                                                v-model="
                                                                    form
                                                                        .productNewOption[
                                                                        index
                                                                    ]
                                                                        .new_option_price[
                                                                        optionIndex
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="new_option_price"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productNewOption.${index}.new_option_price.${optionIndex}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="new_option_quantity"
                                                                v-model="
                                                                    form
                                                                        .productNewOption[
                                                                        index
                                                                    ]
                                                                        .new_option_quantity[
                                                                        optionIndex
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="new_option_quantity"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                            />
                                                            <HasError
                                                                :form="form"
                                                                :field="`productNewOption.${index}.new_option_quantity.${optionIndex}`"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                id="new_option_sku"
                                                                v-model="
                                                                    form
                                                                        .productNewOption[
                                                                        index
                                                                    ]
                                                                        .new_option_sku[
                                                                        optionIndex
                                                                    ]
                                                                "
                                                                type="text"
                                                                name="new_option_sku"
                                                                class="
                                                                    form-control
                                                                    form-control-alternative
                                                                "
                                                            />

                                                            <HasError
                                                                :form="form"
                                                                :field="`productNewOption.${index}.new_option_sku.${optionIndex}`"
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
                                                                    delNewOptionRow(
                                                                        index,
                                                                        optionIndex
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
                                                    <tr
                                                        v-show="
                                                            emptyOptionSlot[
                                                                index
                                                            ][1] > 0
                                                        "
                                                    >
                                                        <td colspan="5">
                                                            <button
                                                                type="button"
                                                                class="
                                                                    btn btn-sm
                                                                "
                                                                @click.prevent="
                                                                    addNewOptionRow(
                                                                        index
                                                                    )
                                                                "
                                                                v-show="
                                                                    form
                                                                        .productNewOption[
                                                                        index
                                                                    ]
                                                                        .new_option_list
                                                                        .length <
                                                                    emptyOptionSlot[
                                                                        index
                                                                    ][1]
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

                    <!-- New Options -->

                    <!-- New Variation -->
                    <div
                        class="card px-4 py-4 mt-4"
                        v-show="
                            form.has_variations == 1 && emptyVariationSlot > 0
                        "
                    >
                        <!-- Header -->
                        <h3 class="mb-3">
                            Add upto {{ emptyVariationSlot }} New Variations
                        </h3>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Add new Variations
                                <p class="text-grey text-xs mt-2 mb-0">
                                    You may add upto
                                    <strong>{{ emptyVariationSlot }}</strong>
                                    variation types. Each type may have upto
                                    <strong>3</strong> options.
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn"
                                    type="button"
                                    @click.prevent="setVariationMode"
                                >
                                    Add a Variation
                                </button>
                            </div>
                        </div>

                        <div
                            class="card px-4 py-4 border-light mt-2 mb-3"
                            v-show="variation.variationMode"
                            v-for="(variation, index) in form.productVariation"
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
                                <h4>
                                    Variation
                                    {{ variation.new_variation_name }}
                                </h4>
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
                                <label class="col-md-3 col-form-label" for="">
                                    Type
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <div class="col-md-4">
                                    <input
                                        id="productVariation.new_variation_name"
                                        v-model="variation.new_variation_name"
                                        type="text"
                                        name="productVariation.new_variation_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`productVariation.${index}.new_variation_name`"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="new_variation_description"
                                >
                                    Description
                                    <p class="text-grey text-xs mt-2 mb-0">
                                        Explain your variation shortly if
                                        neccessary.
                                    </p>
                                </label>
                                <div class="col-md-9">
                                    <input
                                        id="new_variation_description"
                                        v-model="
                                            variation.new_variation_description
                                        "
                                        type="text"
                                        name="new_variation_description"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        :field="`productVariation.${index}.new_variation_description`"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-md-1">
                                <label class="col-md-3 col-form-label" for="">
                                    Variation Options
                                    <strong class="text-danger"> *</strong>
                                    <p class="text-grey text-xs mt-2 mb-0">
                                        Variation will not be saved if no
                                        options are given.
                                    </p>
                                    <p class="text-grey text-xs mt-1 mb-0">
                                        If options don't have individual prices,
                                        then input 0 in price.
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
                                        <table class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Option
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </th>
                                                    <th class="smwidth">
                                                        Price
                                                        <strong
                                                            class="text-danger"
                                                        >
                                                            *
                                                        </strong>
                                                    </th>
                                                    <th class="smwidth">
                                                        Inventory
                                                    </th>
                                                    <th>SKU</th>
                                                    <th class="tiny-col"></th>
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
                                                            name="new_variation_option_name"
                                                            id="new_variation_option_name"
                                                            v-model="
                                                                variation
                                                                    .new_variation_option_name[
                                                                    i
                                                                ]
                                                            "
                                                            type="text"
                                                            class="
                                                                form-control
                                                                form-control-alternative
                                                            "
                                                        />
                                                        <HasError
                                                            :form="form"
                                                            :field="`productVariation.${index}.new_variation_option_name.${i}`"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            id="new_variation_option_price"
                                                            v-model="
                                                                variation
                                                                    .new_variation_option_price[
                                                                    i
                                                                ]
                                                            "
                                                            type="text"
                                                            name="new_variation_option_price"
                                                            class="
                                                                form-control
                                                                form-control-alternative
                                                            "
                                                        />
                                                        <HasError
                                                            :form="form"
                                                            :field="`productVariation.${index}.new_variation_option_price.${i}`"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            id="new_variation_option_quantity"
                                                            v-model="
                                                                variation
                                                                    .new_variation_option_quantity[
                                                                    i
                                                                ]
                                                            "
                                                            type="text"
                                                            name="new_variation_option_quantity"
                                                            class="
                                                                form-control
                                                                form-control-alternative
                                                            "
                                                        />
                                                        <HasError
                                                            :form="form"
                                                            :field="`productVariation.${index}.new_variation_option_quantity.${i}`"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            id="productVariation.new_variation_option_sku"
                                                            v-model="
                                                                variation
                                                                    .new_variation_option_sku[
                                                                    i
                                                                ]
                                                            "
                                                            type="text"
                                                            name="productVariation.new_variation_option_sku"
                                                            class="
                                                                form-control
                                                                form-control-alternative
                                                            "
                                                        />
                                                        <HasError
                                                            :form="form"
                                                            :field="`productVariation.${index}.new_variation_option_sku.${i}`"
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
                                                                delRow(index, i)
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
                                                            class="btn btn-sm"
                                                            @click.prevent="
                                                                addRow(index)
                                                            "
                                                            v-show="
                                                                variation.new_variation_name &&
                                                                variation
                                                                    .option_list
                                                                    .length < 3
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

                    <!-- Shipping -->
                    <div class="card px-4 py-4 mt-4">
                        <!-- Header -->
                        <h3 class="mb-3">Shipping</h3>
                        <hr class="mt-0 mb-2" />
                        <p class="text-grey text-sm mb-4 mt-0">
                            Set clear and realistic shipping expectations for
                            shoppers
                        </p>

                        <div class="form-group row">
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
                            class="btn btn-secondary mr-3"
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
                        <h3
                            v-show="occasionMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add Occasions
                        </h3>
                        <h3
                            v-show="recipientMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add Recipients
                        </h3>
                        <button
                            type="button"
                            class="close"
                            @click.prevent="closeModal"
                        >
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                    <div v-show="occasionMode" class="modal-body">
                        <div class="d-flex flex-wrap badge-container">
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
                        <div class="d-flex flex-wrap badge-container">
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
        sellers: [],
        categories: [],
        sub_categories: [],
        occasions: [],
        recipients: [],
        product: "",
        images: {},
        emptyImageSlot: "",
        variations: {},
        variation_options: {},
        emptyOptionSlot: [],
        occasionName: [],
        recipientName: [],
        url: [],

        form: new Form({
            id: "",
            sku: "",
            title: "",
            slug: "",
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
            product_occasion: [],
            product_recipient: [],
            product_sub_category: [],
            sub_categories: [],

            //new image
            image_path_new: [],
            photoName: [],

            //existing image
            image_id: [],
            image_path: [],
            path: [],
            image_title: [],
            primary_image: [],

            //existing variations
            variation_id: [],
            variation_name: [],
            variation_state: [],
            variation_description: [],

            //existing options
            option_id: [],
            option_variation_id: [],
            option_name: [],
            option_sku: [],
            option_price: [],
            option_quantity: [],
            option_state: [],

            //existing variations new options
            productNewOption: [
                {
                    new_option_list: [],
                    new_option_variation_id: "",
                    new_option_name: [],
                    new_option_sku: [],
                    new_option_price: [],
                    new_option_quantity: [],
                },
                {
                    new_option_list: [],
                    new_option_variation_id: "",
                    new_option_name: [],
                    new_option_sku: [],
                    new_option_price: [],
                    new_option_quantity: [],
                },
                {
                    new_option_list: [],
                    new_option_variation_id: "",
                    new_option_name: [],
                    new_option_sku: [],
                    new_option_price: [],
                    new_option_quantity: [],
                },
            ],

            //new variations
            productVariation: [
                {
                    variationMode: false,
                    new_variation_name: "",
                    new_variation_description: "",
                    option_list: [],
                    new_variation_option_name: [],
                    new_variation_option_sku: [],
                    new_variation_option_price: [],
                    new_variation_option_quantity: [],
                },
                {
                    variationMode: false,
                    new_variation_name: "",
                    new_variation_description: "",
                    option_list: [],
                    new_variation_option_name: [],
                    new_variation_option_sku: [],
                    new_variation_option_price: [],
                    new_variation_option_quantity: [],
                },
                {
                    variationMode: false,
                    new_variation_name: "",
                    new_variation_description: "",
                    option_list: [],
                    new_variation_option_name: [],
                    new_variation_option_sku: [],
                    new_variation_option_price: [],
                    new_variation_option_quantity: [],
                },
            ],
        }),
    }),

    computed: {
        emptyVariationSlot() {
            return 3 - this.form.variation_id.length;
        },
    },

    methods: {
        /*
         * Variation
         */

        setVariationMode() {
            switch (false) {
                case this.form.productVariation[0].variationMode:
                    this.form.productVariation[0].variationMode = true;
                    break;
                case this.form.productVariation[1].variationMode:
                    if (this.emptyVariationSlot > 1) {
                        this.form.productVariation[1].variationMode = true;
                    }
                    break;
                case this.form.productVariation[2].variationMode:
                    if (this.emptyVariationSlot > 2) {
                        this.form.productVariation[2].variationMode = true;
                    }
                    break;
            }
        },

        addRow(count) {
            this.form.productVariation[count].option_list.push("1");
        },

        addNewOptionRow(count) {
            this.form.productNewOption[count].new_option_list.push("1");
            this.form.productNewOption[count].new_option_variation_id =
                this.form.variation_id[count];
        },

        delRow(count, i) {
            let variant = this.form.productVariation[count];
            variant.option_list.splice(i, 1);
            variant.new_variation_option_name.splice(i, 1);
            variant.new_variation_option_sku.splice(i, 1);
            variant.new_variation_option_price.splice(i, 1);
            variant.new_variation_option_quantity.splice(i, 1);
        },

        delNewOptionRow(count, i) {
            let option = this.form.productNewOption[count];
            option.new_option_list.splice(i, 1);
            option.new_option_name.splice(i, 1);
            option.new_option_sku.splice(i, 1);
            option.new_option_price.splice(i, 1);
            option.new_option_quantity.splice(i, 1);
        },

        delVariation(count) {
            let variant = this.form.productVariation[count];
            variant.variationMode = false;
            variant.new_variation_name = "";
            variant.new_variation_description = "";
            variant.option_list = [];
            variant.new_variation_option_name = [];
            variant.new_variation_option_sku = [];
            variant.new_variation_option_price = [];
            variant.new_variation_option_quantity = [];
        },

        /*
         * Form Functions
         */

        cancel() {
            this.$router.push("/admin/products");
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

        /*
         * Load Data
         */

        resetVariations() {
            //existing variation data
            this.form.variation_id = [];
            this.form.variation_name = [];
            this.form.variation_state = [];
            this.form.variation_description = [];

            //existing options data
            this.form.option_id = [];
            this.form.option_variation_id = [];
            this.form.option_name = [];
            this.form.option_sku = [];
            this.form.option_price = [];
            this.form.option_quantity = [];
            this.form.option_state = [];

            for (let i = 0; i < 3; i++) {
                //new variation data
                this.form.productVariation[i].variationMode = false;
                this.form.productVariation[i].new_variation_name = "";
                this.form.productVariation[i].new_variation_description = "";
                this.form.productVariation[i].option_list = [];
                this.form.productVariation[i].new_variation_option_name = [];
                this.form.productVariation[i].new_variation_option_sku = [];
                this.form.productVariation[i].new_variation_option_price = [];
                this.form.productVariation[i].new_variation_option_quantity =
                    [];

                //new options for existing variation data
                this.form.productNewOption[i].new_option_list = [];
                this.form.productNewOption[i].new_option_variation_id = "";
                this.form.productNewOption[i].new_option_name = [];
                this.form.productNewOption[i].new_option_sku = [];
                this.form.productNewOption[i].new_option_price = [];
                this.form.productNewOption[i].new_option_quantity = [];
            }

            this.emptyOptionSlot = [];
        },

        resetImages() {
            //new image data
            this.url = [];
            this.form.image_path_new = [];
            this.form.photoName = [];

            //existing image data
            this.form.image_id = [];
            this.form.image_path = [];
            this.form.path = [];
            this.form.image_title = [];
            this.form.primary_image = [];

            this.emptyImageSlot = 6 - this.images.length;
        },

        loadSubcategories(event) {
            axios
                .get("/api/admin/products/sub_categories/" + event.target.value)
                .then((response) => {
                    this.sub_categories = response.data.sub_categories;
                })
                .catch((error) => console.log(error));
        },

        loadCurrentSubcategories() {
            axios
                .get(
                    "/api/admin/products/sub_categories/" +
                        this.form.category_id
                )
                .then((response) => {
                    this.sub_categories = response.data.sub_categories;
                })
                .catch((error) => console.log(error));
        },

        loadDetails() {
            axios
                .get("/api/admin/products/details")
                .then((response) => {
                    this.categories = response.data.categories;
                    this.occasions = response.data.occasions;
                    this.recipients = response.data.recipients;
                })
                .catch((error) => console.log(error));
        },

        loadPivotVariables() {
            //reset data
            this.form.product_occasion = [];
            this.occasionName = [];
            this.form.product_recipient = [];
            this.recipientName = [];

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

            if (this.form.sub_categories != null) {
                this.form.sub_categories.forEach((value) => {
                    this.form.product_sub_category.push(value.id);
                });
            }
        },

        loadProductImages() {
            axios
                .get("/api/admin/product_images", {
                    params: { productId: this.$route.params.productId },
                })
                .then(({ data }) => {
                    this.images = data;

                    this.resetImages();

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

        loadProductVariations() {
            axios
                .get("/api/admin/variations/" + this.$route.params.productId)
                .then(({ data }) => {
                    this.variations = data.variations;
                    this.variation_options = data.variation_options;

                    this.variations.forEach((value, index) => {
                        this.$set(this.form.variation_id, index, value.id);
                        this.$set(this.form.variation_name, index, value.name);
                        this.$set(
                            this.form.variation_state,
                            index,
                            value.product_state_id
                        );
                        this.$set(
                            this.form.variation_description,
                            index,
                            value.description
                        );
                    });

                    this.variation_options.forEach((value, index) => {
                        this.$set(this.form.option_id, index, value.id);
                        this.$set(
                            this.form.option_variation_id,
                            index,
                            value.variation_id
                        );
                        this.$set(this.form.option_name, index, value.name);
                        this.$set(this.form.option_sku, index, value.sku);
                        this.$set(this.form.option_price, index, value.price);
                        this.$set(
                            this.form.option_quantity,
                            index,
                            value.quantity
                        );
                        this.$set(
                            this.form.option_state,
                            index,
                            value.product_state_id
                        );
                    });

                    for (let i = 0; i < this.form.variation_id.length; i++) {
                        let count = 0;
                        for (
                            let j = 0;
                            j < this.form.option_variation_id.length;
                            j++
                        ) {
                            if (
                                this.form.variation_id[i] ==
                                this.form.option_variation_id[j]
                            ) {
                                count = count + 1;
                            }
                        }
                        this.emptyOptionSlot.push([
                            this.form.variation_id[i],
                            3 - count,
                        ]);
                    }

                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadProduct() {
            axios
                .get("/api/admin/products/" + this.$route.params.productId)
                .then(({ data }) => {
                    //this.form.fill(data);
                    Object.keys(data).forEach((key) => {
                        this.form[key] = data[key];
                    });
                })
                .then(() => {
                    this.loadDetails();
                    this.loadPivotVariables();
                    this.loadProductImages();
                    this.resetVariations();
                    this.loadProductVariations();
                    this.loadCurrentSubcategories();
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadSellers() {
            axios
                .get("/api/admin/users/seller")
                .then(({ data }) => (this.sellers = data))
                .catch((error) => console.log(error));
        },
        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
        },

        /*
         * Update/ Store Data
         */

        updateProduct() {
            if (this.form.has_inventory == 0) {
                this.form.quantity == "";
            }

            if (this.form.length != "") {
                this.form.dimensions_unit = "in";
            }

            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.form
                .put("/api/admin/products/" + this.form.id)
                .then(() => {
                    //update existing variations
                    return this.form.put(
                        "/api/admin/variations/" + this.form.id
                    );
                })
                .then(() => {
                    //update existing variation options
                    return this.form.put(
                        "/api/admin/variation_options/" + this.form.id
                    );
                })
                .then(() => {
                    //create new variations
                    return this.form.post("/api/admin/variations");
                })
                .then(() => {
                    //create new variation options
                    return this.form.post("/api/admin/variation_options");
                })
                .then(() => {
                    //create new images
                    return this.form.put(
                        "/api/admin/products/storeNewImage/" + this.form.id
                    );
                })
                .then(() => {
                    //update existing images
                    return this.form.put(
                        "/api/admin/product_images/" + this.form.id
                    );
                })
                .then(() => {
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                    return this.loadProduct();
                })
                .catch((error) => {
                    console.log(error);
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    $("#fail-modal").modal("show");
                });
        },
    },
    mounted() {
        this.loadProduct();
        this.loadProductStates();
        this.loadSellers();
    },
};
</script>
