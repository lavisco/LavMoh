<template>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item">
                            <router-link to="/seller/giftboxes">
                                Giftboxes
                            </router-link>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Giftbox
                        </li>
                    </ol>
                </nav>

                <!-- Form start -->
                <form class="input-form" @submit.prevent="updateProduct()">
                    <!-- Listing -->
                    <div class="card dashboard-info-card">
                        <!-- Header -->
                        <h4 class="mb-3">Edit Giftbox {{ form.code }}</h4>
                        <hr class="mt-0" />
                        <p class="mb-3 mb-md-4 note">
                            Setup a giftbox using your best products for the
                            customers. Write a brief description about your
                            item.
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
                        <div class="form-group row mb-md-1">
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
                    </div>

                    <!-- Products -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Current Products in Giftbox</h4>
                        <hr class="mt-0" />
                        <p class="mb-1 note">
                            These products are already available in this
                            giftbox. You can remove them, or increase & decrease
                            their quantity.
                        </p>
                        <p class="mb-3 mb-md-4 note">
                            The <strong>minimum price</strong> of this giftbox
                            is calculated based on the minimum quantity of the
                            selected products.
                        </p>

                        <div class="highlight-box mb-3 mb-md-4">
                            Minimum Price is LKR {{ form.base_price }}
                        </div>

                        <div class="table-responsive form-table">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="smwidth">
                                            Quantity
                                        </th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Base Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in form.new_giftbox_products"
                                        :key="product.id"
                                    >
                                        <td>
                                            <div class="product-card-counter">
                                                <div
                                                    class="counter-minus"
                                                    @click.prevent="
                                                        decrementProductQtyInBox(
                                                            product
                                                        )
                                                    "
                                                >
                                                    -
                                                </div>
                                                <div class="counter-num">
                                                    {{ product.quantity }}
                                                </div>
                                                <div
                                                    class="counter-plus"
                                                    @click.prevent="
                                                        incrementProductQtyInBox(
                                                            product
                                                        )
                                                    "
                                                >
                                                    +
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ product.code }}
                                        </td>
                                        <td>
                                            {{ product.title }}
                                        </td>
                                        <td>
                                            {{ product.base_price }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- New Products -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Select New Products</h4>
                        <hr class="mt-0" />
                        <p class="mb-3 mb-md-4 note">
                            Here are all the products you can add to your
                            giftbox. Select any new ones you wish to add. Only
                            products <strong>without variations</strong> can be
                            added to a giftbox.
                        </p>

                        <div class="table-responsive form-table">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="smwidth">
                                            Quantity
                                        </th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Base Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in products"
                                        :key="product.id"
                                    >
                                        <td>
                                            <div class="product-card-counter">
                                                <div
                                                    class="counter-minus"
                                                    @click.prevent="
                                                        decrementProductQtyInBox(
                                                            product
                                                        )
                                                    "
                                                >
                                                    -
                                                </div>
                                                <div class="counter-num">
                                                    {{
                                                        displayProductQtyInBox(
                                                            product
                                                        )
                                                    }}
                                                </div>
                                                <div
                                                    class="counter-plus"
                                                    @click.prevent="
                                                        incrementProductQtyInBox(
                                                            product
                                                        )
                                                    "
                                                >
                                                    +
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ product.code }}</td>
                                        <td>{{ product.title }}</td>
                                        <td>{{ product.base_price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Photo -->
                    <div class="card dashboard-info-card mt-4">
                        <!-- Header -->
                        <h4 class="mb-3">Product Photos</h4>
                        <hr class="mt-0" />
                        <p class="mb-3 mb-md-4 note">
                            Add a photo showing what your giftbox looks like.
                            This is the first image customers see on the
                            website.
                        </p>

                        <div class="form-group row">
                            <div class="col">
                                <div class="img-full">
                                    <div>
                                        <input
                                            type="file"
                                            style="display: none"
                                            @change.prevent="
                                                fileSelected($event)
                                            "
                                            ref="fileInput"
                                            name="product_image_path"
                                        />

                                        <button
                                            class="image-upload-box"
                                            @click.prevent="
                                                $refs.fileInput.click()
                                            "
                                        >
                                            <img
                                                v-if="url"
                                                :src="url"
                                                class="banner-container"
                                            />
                                            <img
                                                v-if="!url"
                                                :src="form.product_image.path"
                                                class="banner-container"
                                            />
                                            <svg
                                                v-else
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
                                            field="image_path"
                                        />

                                        <p class="image-upload-filename my-0">
                                            {{
                                                form.photoName
                                                    ? form.photoName
                                                    : form.product_image.title
                                            }}
                                        </p>
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
            gotoRoute="/seller/giftboxes"
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
        occasions: [],
        recipients: [],
        occasionName: [],
        recipientName: [],
        products: [],
        giftbox_products: [],
        url: "",

        form: new Form({
            id: "",
            code: "",
            sku: "",
            title: "",
            short_description: "",
            base_price: 0,
            processing_time: "",
            has_custom_text: "",
            image_path: "",
            photoName: "",

            //existing product image
            product_image: "",

            //pivot table arrays
            product_occasion: [],
            product_recipient: [],

            //existing products in giftbox
            giftbox_products: [],

            //new products in giftbox
            new_giftbox_products: [],
        }),
    }),

    computed: {},

    methods: {
        /*
         * products available in giftbox methods
         */

        findProductInBox(productId) {
            return this.form.new_giftbox_products.find(
                (item) => item.id === productId
            );
        },
        incrementProductQtyInBox(product) {
            const BoxItem = this.findProductInBox(product.id);
            if (!BoxItem) {
                //if product doesn't exist in box, push to box
                this.form.new_giftbox_products.push({
                    id: product.id,
                    code: product.code,
                    title: product.title,
                    base_price: product.base_price,
                    quantity: 1,
                });
            } else {
                BoxItem.quantity++;
            }
            this.giftboxMinPrice();
        },
        decrementProductQtyInBox(product) {
            const BoxItem = this.findProductInBox(product.id);

            if (BoxItem) {
                if (BoxItem.quantity === 1) {
                    this.form.new_giftbox_products.splice(
                        this.form.new_giftbox_products.indexOf(BoxItem),
                        1
                    );
                } else {
                    BoxItem.quantity--;
                }
                this.giftboxMinPrice();
            }
        },
        displayProductQtyInBox(product) {
            const BoxItem = this.findProductInBox(product.id);
            if (!BoxItem) {
                return 0;
            }
            return BoxItem.quantity;
        },
        giftboxMinPrice() {
            this.form.base_price = 0;
            this.form.new_giftbox_products.map((product) => {
                this.form.base_price += parseFloat(product.base_price);
            });
        },
        giftboxMaxPrice() {
            this.form.base_price = 0;
            this.form.new_giftbox_products.map((product) => {
                this.form.base_price +=
                    parseFloat(product.base_price) * product.quantity;
            });
        },

        subcategoryModal(mode) {
            this[mode] = true;
            $("#addRecord").modal("show");
        },

        /*
         * Image
         */

        fileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }

            reader.onloadend = (file) => {
                this.form.image_path = reader.result;
                this.form.photoName = e.target.files[0].name;
                this.url = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
        },

        /*
         * Form Functions
         */

        cancel() {
            this.$router.push("/seller/giftboxes");
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

        closeModal() {
            this.occasionMode = false;
            this.recipientMode = false;
            $("#addRecord").modal("hide");
        },

        loadDetails() {
            axios
                .get("/api/seller/giftboxes/details")
                .then((response) => {
                    this.occasions = response.data.occasions;
                    this.recipients = response.data.recipients;
                    this.products = response.data.products;
                })
                .catch((error) => console.log(error));
        },

        loadProduct() {
            axios
                .get("/api/seller/giftboxes/" + this.$route.params.productId)
                .then(({ data }) => {
                    //this.form.fill(data);
                    Object.keys(data).forEach((key) => {
                        this.form[key] = data[key];
                    });

                    //push existing products in giftbox into the new array new_giftbox_products
                    Object.keys(this.form.giftbox_products).forEach((key) => {
                        this.form.new_giftbox_products.push({
                            id: this.form.giftbox_products[key].product_id,
                            base_price:
                                this.form.giftbox_products[key].child_product
                                    .base_price,
                            code: this.form.giftbox_products[key].child_product
                                .code,
                            title: this.form.giftbox_products[key].child_product
                                .title,
                            quantity: this.form.giftbox_products[key].quantity,
                        });
                    });
                })
                .then(() => {
                    this.loadDetails();
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        updateProduct() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.form
                .put("/api/seller/giftboxes/" + this.form.id)
                .then(() => {
                    this.submitButtonText = "Saved";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                    //this.sendProductListingConfirmedMail();
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
        this.loadProduct();
    },
};
</script>
