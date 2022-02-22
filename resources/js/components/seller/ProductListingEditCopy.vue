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
                <!-- Form start -->
                <form class="input-form" @submit.prevent="updateProduct()">
                    <!-- Listing -->
                    <div class="card dashboard-info-card">
                        <!-- Header -->
                        <h4 class="mb-4">Listing Details of {{ form.title }}</h4>
                        <p class="mb-5">
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
                                <strong class="text-danger"> *</strong>
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
                                        v-for="(image, index) in images"
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
                                                    width="150px"
                                                    height="150px"
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
                                                    mt-2
                                                "
                                            >
                                                {{ form.image_title[index] }}
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
                        <h4 class="mb-4">Inventory & Pricing</h4>
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
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-4">Variations</h4>
                        <p class="mb-5">
                            Add available options like color or size. Buyers
                            will choose from these during checkout.
                        </p>
                    </div>

                    <!-- Shipping -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-4">Shipping</h4>
                        <p class="mb-5">
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2" aria-hidden="true"></i>
                            Update
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
                        <div class="card">
                            <div class="table-responsive">
                                <table
                                    class="table align-items-center table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="occasion in occasions">
                                            <th scope="row">
                                                <input
                                                    type="checkbox"
                                                    name="product_occasion"
                                                    v-model="
                                                        form.product_occasion
                                                    "
                                                    :value="occasion.id"
                                                />
                                            </th>
                                            <td>{{ occasion.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div v-show="recipientMode" class="modal-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table
                                    class="table align-items-center table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="recipient in recipients">
                                            <th scope="row">
                                                <input
                                                    type="checkbox"
                                                    name="product_recipient"
                                                    v-model="
                                                        form.product_recipient
                                                    "
                                                    :value="recipient.id"
                                                />
                                            </th>
                                            <td>{{ recipient.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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

        <!-- Notification Toast -->
        <success-toast
            id="success-toast"
            msg="Store details have been updated"
        />
        <fail-toast
            id="fail-toast"
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

            //image
            image_id: [],
            image_path: [],
            path: [],
            image_title: [],
            primary_image: [],
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
                });
            }
            if (this.form.recipients != null) {
                this.form.recipients.forEach((value) => {
                    this.form.product_recipient.push(value.id);
                });
            }
            if (this.form.shippings != null) {
                this.form.shippings.forEach((value) => {
                    this.form.product_shipping.push(value.id);
                });
            }
        },

        //image

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
                    this.$set(this.form.image_title, 0, e.target.files[0].name);
                    this.$set(this.form.primary_image, 0, 1);
                    this.$set(
                        this.form.path,
                        0,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image1") {
                    this.$set(this.form.image_path, 1, reader.result);
                    this.$set(this.form.image_title, 1, e.target.files[0].name);
                    this.$set(this.form.primary_image, 1, 0);
                    this.$set(
                        this.form.path,
                        1,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image2") {
                    this.$set(this.form.image_path, 2, reader.result);
                    this.$set(this.form.image_title, 2, e.target.files[0].name);
                    this.$set(this.form.primary_image, 2, 0);
                    this.$set(
                        this.form.path,
                        2,
                        URL.createObjectURL(e.target.files[0])
                    );
                }
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
                .then(() => {})
                .catch((error) => console.log(error));
        },

        updateProduct() {
            if (this.form.has_inventory == 0) {
                this.form.quantity == "";
            }
            this.updateProductImages();
            this.form
                .put("/api/seller/products/" + this.form.id)
                .then(() => {
                    $("#success-toast").toast("show");
                    //this.$router.push("/seller/products");
                })
                .catch((error) => {
                    console.log(error);
                    $("#fail-toast").toast("show");
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
