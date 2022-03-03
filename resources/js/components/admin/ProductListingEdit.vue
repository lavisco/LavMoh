<template>
    <div class="container-fluid mt-5 mb-5">
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
                    <div class="card px-4 py-4">
                        <!-- Header -->
                        <h3>Listing Details for {{ form.title }}</h3>
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
                                for="short_description"
                            >
                                Short Description
                                <strong class="text-danger"> *</strong>
                                <p class="text-grey text-xs mt-2">
                                    Write a brief overview that describes your
                                    item's finest feature. Shoppers will see
                                    your short description first, so make it
                                    count!
                                    <br />
                                    Maximum <storng>500</storng> characters
                                </p>
                            </label>

                            <div class="col-md-9">
                                <textarea
                                    id="short_description"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    name="short_description"
                                    rows="3"
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
                                <p class="text-grey text-xs mt-2">
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
                                    placeholder="Material"
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
                                        >Yes</label
                                    >
                                </div>
                                <HasError :form="form" field="has_variations" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="">
                                Add new Variations
                                <strong class="text-danger"> *</strong>
                            </label>
                            <div class="col-md-5">
                                <button class="btn" type="button">Add</button>
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
                            <button type="submit" class="btn btn-primary">
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                        </div>
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
                <div class="modal-content bg-secondary">
                    <div class="modal-header bg-neutral">
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
        sellers: [],
        product: "",
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
        }),
    }),

    computed: {
        isDisabled() {
            return this.form.has_inventory == 1 ? false : true;
        },
    },

    methods: {
        check(event) {
            event.target.value = true;
        },
        subcategoryModal(mode) {
            this[mode] = true;
            switch (true) {
                case this.occasionMode:
                    this.occasions == "" ? this.loadOccasions() : "";
                    break;
                case this.recipientMode:
                    this.recipients == "" ? this.loadRecipients() : "";
                    break;
            }
            $("#addRecord").modal("show");
        },
        closeModal() {
            this.occasionMode = false;
            this.recipientMode = false;
            $("#addRecord").modal("hide");
        },
        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
        },
        loadCategories() {
            axios
                .get("/api/admin/categories")
                .then(({ data }) => (this.categories = data.data))
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

        loadProduct() {
            axios
                .get("/api/admin/products/" + this.$route.params.productId)
                .then(({ data }) => {
                    this.form.fill(data);
                    this.loadPivotVariables();
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadPivotVariables() {
            this.form.product_occasion = [];
            this.form.product_recipient = [];
            this.form.product_shipping = [];
            this.form.occasions.forEach((value) => {
                this.form.product_occasion.push(value.id);
            });
            this.form.recipients.forEach((value) => {
                this.form.product_recipient.push(value.id);
            });
            this.form.shippings.forEach((value) => {
                this.form.product_shipping.push(value.id);
            });
        },

        updateProduct() {
            if (this.form.has_inventory == 0) {
                this.form.quantity == "";
            }
            this.form
                .put("/api/admin/products/" + this.form.id)
                .then(() => {
                    this.$router.push("/admin/products");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadProduct();
        this.loadProductStates();
        this.loadSellers();
        this.loadShippings();
        this.loadCategories();
    },
};
</script>
