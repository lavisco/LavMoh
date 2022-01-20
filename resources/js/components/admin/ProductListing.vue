<template>
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col">
                <!-- Form start -->
                <form class="input-form" @submit.prevent="createProduct()">
                    <!-- Listing -->
                    <div class="card px-4 py-4">
                        <!-- Header -->
                        <h3>Listing Details</h3>
                        <p class="text-grey text-sm mb-4 mt-0">
                            Tell the world all about your item and why they will
                            love it
                        </p>

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
                                        :value="seller.id"
                                    >
                                        {{ seller.name }}
                                    </option>
                                </select>
                                <HasError :form="form" field="user_id" />
                            </div>
                            <div class="col-md-4 col-sm-6">
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
                            <label class="col-md-3 col-form-label" for="">
                                Materials
                                <p class="text-grey text-xs mt-2">
                                    Select all materials your item is made of
                                </p>
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('materialMode')
                                    "
                                >
                                    Add Materials
                                </button>
                                <div v-for="item in form.product_material">
                                    <span>{{ item.name }}</span>
                                </div>
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
                                    class="btn"
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
                                    class="btn"
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

                    <!-- Inventory -->
                    <div class="card px-4 py-4 my-4">
                        <!-- Header -->
                        <h3>Inventory & Pricing</h3>
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
                                <strong class="text-danger"> *</strong>
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
                    <div class="card px-4 py-4 my-4">
                        <!-- Header -->
                        <h3>Variations</h3>
                        <p class="text-grey text-sm mb-4 mt-0">
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
                            </label>
                            <div class="col-md-9">
                                <button
                                    class="btn"
                                    type="button"
                                    @click.prevent="
                                        subcategoryModal('variationMode', 0)
                                    "
                                >
                                    Add a Variation
                                </button>
                                <button
                                    class="btn"
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
                                    class="btn"
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

                    <!-- Photo -->
                    <div class="card px-4 py-4 my-4">
                        <!-- Header -->
                        <h3>Product Photos</h3>
                        <p class="text-grey text-sm mb-4 mt-0">
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
                                                <i
                                                    v-show="
                                                        !form.image_path[index]
                                                    "
                                                    class="fas fa-plus"
                                                ></i>
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
                                                        : `Select file`
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

                    <!-- Shipping -->
                    <div class="card px-4 py-4 my-4">
                        <!-- Header -->
                        <h3>Shipping</h3>
                        <p class="text-grey text-sm mb-4 mt-0">
                            Set clear and realistic shipping expectations for
                            shoppers
                        </p>

                        <div class="form-group row mb-md-1">
                            <label
                                class="col-md-3 col-form-label"
                                for="processing_time"
                            >
                                Processing Time<strong class="text-danger">
                                    *</strong
                                >
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
                                <div class="card">
                                    <div class="table-responsive">
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
                                                    <th scope="col">
                                                        Locations
                                                    </th>
                                                    <th scope="col">
                                                        Tracking opt
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="shipping in shippings"
                                                >
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
                                                        {{
                                                            shipping.delivery_time
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ shipping.locations }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            shipping.tracking_opt
                                                        }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-form text-right">
                            <button
                                type="button"
                                class="btn btn-secondary mr-3"
                                @click="cancel()"
                            >
                                <i
                                    class="fas fa-times mr-2"
                                    aria-hidden="true"
                                ></i>
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>
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
        >
            <div
                class="modal-dialog modal-dialog-centered"
                :class="{ 'modal-lg': variationMode }"
                role="document"
            >
                <div class="modal-content bg-secondary">
                    <div class="modal-header bg-neutral">
                        <h4
                            v-show="materialMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Add Materials
                        </h4>
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
                    <div v-show="materialMode" class="modal-body">
                        <div class="d-flex flex-wrap badge-container">
                            <div
                                class="badge option-badge"
                                v-for="material in materials"
                            >
                                <div class="d-flex align-items-center">
                                    <input
                                        type="checkbox"
                                        class="mr-2"
                                        name="product_material"
                                        v-model="form.product_material"
                                        :value="material.id"
                                    />
                                    {{ material.name }}
                                </div>
                            </div>
                        </div>
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
                                id="productVariation.sku"
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
                                    class="btn btn-info ml-2"
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
                                class="card"
                                v-show="
                                    form.productVariation[variationCount]
                                        .option_list[0] != null
                                "
                            >
                                <div class="table-responsive">
                                    <table
                                        class="
                                            table
                                            align-items-center
                                            table-hover
                                        "
                                    >
                                        <thead>
                                            <tr>
                                                <th scope="col">Option</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(item, i) in form
                                                    .productVariation[
                                                    variationCount
                                                ].option_list"
                                            >
                                                <td>
                                                    <input
                                                        name="var_option_id_array"
                                                        id="var_option_id_array"
                                                        v-model="
                                                            form
                                                                .productVariation[
                                                                variationCount
                                                            ]
                                                                .var_option_id_array[
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
                                                        field="var_option_id_array"
                                                    />
                                                </td>
                                                <td>
                                                    <input
                                                        id="productVariation.sku"
                                                        v-model="
                                                            form
                                                                .productVariation[
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
                                                </td>
                                                <td>
                                                    <input
                                                        id="var_price_array"
                                                        v-model="
                                                            form
                                                                .productVariation[
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
                                                </td>
                                                <td>
                                                    <input
                                                        id="var_quantity_array"
                                                        v-model="
                                                            form
                                                                .productVariation[
                                                                variationCount
                                                            ]
                                                                .var_quantity_array[
                                                                i
                                                            ]
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
                                                </td>
                                                <td>
                                                    <input
                                                        id="var_description_array"
                                                        v-model="
                                                            form
                                                                .productVariation[
                                                                variationCount
                                                            ]
                                                                .var_description_array[
                                                                i
                                                            ]
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
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="
                                                            btn btn-light btn-sm
                                                        "
                                                        @click.prevent="
                                                            delRow(
                                                                variationCount,
                                                                i
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fas fa-times"
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
                    <div class="modal-footer pt-0">
                        <button
                            type="button"
                            class="btn btn-light mr-2"
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
        materialMode: false,
        variationMode: false,
        occasionMode: false,
        recipientMode: false,
        productStates: [],
        categories: [],
        materials: [],
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
            quantity: "",
            has_giftwrap: false,
            product_state_id: "",
            category_id: "",
            user_id: "",
            image_path: [],
            photoName: [],

            //pivot table arrays
            product_material: [],
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

        cancel() {
            this.$router.push("/admin/products");
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
                case this.materialMode:
                    this.materials == "" ? this.loadMaterials() : "";
                    break;
                case this.occasionMode:
                    this.occasions == "" ? this.loadOccasions() : "";
                    break;
                case this.recipientMode:
                    this.recipients == "" ? this.loadRecipients() : "";
                    break;
                case this.variationMode:
                    this.variationCount = count;
                    break;
            }
            $("#addRecord").modal("show");
        },

        closeModal() {
            this.materialMode = false;
            this.occasionMode = false;
            this.recipientMode = false;
            this.variationMode = false;
            $("#addRecord").modal("hide");
        },
        // loadVariations() {
        //     axios
        //         .get("/api/admin/variations")
        //         .then(({ data }) => (this.variations = data.data))
        //         .catch((error) => console.log(error));
        // },
        // loadOptions() {
        //     axios
        //         .get("/api/admin/variations/options", {
        //             params: {
        //                 variation_id:
        //                     this.form.productVariation[this.variationCount]
        //                         .variationId,
        //             },
        //         })
        //         .then(
        //             ({ data }) =>
        //                 (this.form.productVariation[
        //                     this.variationCount
        //                 ].options = data)
        //         )
        //         .catch((error) => console.log(error));
        // },
        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data.data))
                .catch((error) => console.log(error));
        },
        loadCategories() {
            axios
                .get("/api/admin/categories")
                .then(({ data }) => (this.categories = data.data))
                .catch((error) => console.log(error));
        },
        loadMaterials() {
            axios
                .get("/api/admin/materials")
                .then(({ data }) => (this.materials = data.data))
                .catch((error) => console.log(error));
        },
        loadOccasions() {
            axios
                .get("/api/admin/occasions")
                .then(({ data }) => (this.occasions = data.data))
                .catch((error) => console.log(error));
        },
        loadRecipients() {
            axios
                .get("/api/admin/recipients")
                .then(({ data }) => (this.recipients = data.data))
                .catch((error) => console.log(error));
        },
        loadShippings() {
            axios
                .get("/api/admin/shippings")
                .then(({ data }) => (this.shippings = data.data))
                .catch((error) => console.log(error));
        },
        loadSellers() {
            axios
                .get("/api/admin/users/seller")
                .then(({ data }) => (this.sellers = data))
                .catch((error) => console.log(error));
        },

        createProduct() {
            if (this.form.has_inventory == "0") {
                this.form.quantity = "0";
            }

            this.form
                .post("/api/admin/products")
                .then(() => {
                    this.$router.push("/admin/products");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadProductStates();
        this.loadSellers();
        this.loadShippings();
        this.loadCategories();
        $(this.$refs.vuemodal).on("hidden.bs.modal", this.closeModal);
    },
};
</script>
