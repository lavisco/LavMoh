<template>
    <div class="container-fluid mb-5 product-page">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">
                    <router-link to="/products"> Products </router-link>
                </li>
            </ol>
        </nav>
        <div
            v-if="loading"
            class="my-5 d-flex align-items-center justify-content-center"
        >
            <img src="/images/lavisco/loading.gif" />
        </div>
        <div v-else class="col">
            <div class="row">
                <div class="col-md-7">
                    <!-- Swiper -->
                    <div class="slider-container">
                        <div class="thumbnail-container">
                            <div
                                class="thumbnail"
                                v-for="(
                                    product_image, index
                                ) in product.product_images"
                                :key="product_image.id"
                                @click.prevent="setSliderImg(index)"
                            >
                                <img
                                    :src="product_image.path"
                                    alt="product image"
                                />
                            </div>
                        </div>
                        <div class="img-container">
                            <transition-group
                                tag="div"
                                class="img-container"
                                name="slide-fade"
                            >
                                <div
                                    v-for="number in [currentImg]"
                                    :key="number"
                                    class="img-slide"
                                >
                                    <img
                                        :src="
                                            sliderImgList[
                                                Math.abs(currentImg) %
                                                    sliderImgList.length
                                            ]
                                        "
                                        alt="product image"
                                    />
                                </div>
                            </transition-group>
                            <div class="slider-arrow-container">
                                <div
                                    class="slider-arrow"
                                    id="button-prev"
                                    @click.prevent="prevSliderImg()"
                                    :class="{
                                        'slider-arrow-inactive':
                                            currentImg == 0,
                                    }"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true"
                                        role="img"
                                        width="24"
                                        height="24"
                                        preserveAspectRatio="xMidYMid meet"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="#4e4e4e"
                                            d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 9V8l-4 4l4 4v-3h4v-2h-4z"
                                        />
                                    </svg>
                                </div>
                                <div
                                    class="slider-arrow"
                                    id="button-next"
                                    @click.prevent="nextSliderImg()"
                                    :class="{
                                        'slider-arrow-inactive':
                                            currentImg ==
                                            sliderImgList.length - 1,
                                    }"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true"
                                        role="img"
                                        width="24"
                                        height="24"
                                        preserveAspectRatio="xMidYMid meet"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="#4e4e4e"
                                            d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 9H8v2h4v3l4-4l-4-4v3z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Swiper end -->
                </div>
                <div class="col-md-5 input-form">
                    <!-- title -->

                    <p class="mt-md-0 mt-4 mb-0">
                        {{ product.user.shop.name }}
                    </p>

                    <h3 class="text-left mb-2">
                        {{ product.title }}
                    </h3>

                    <!-- price & tags -->
                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-between
                            my-0
                        "
                    >
                        <!-- price -->
                        <h3 class="price mb-0">
                            {{ currency.symbol }}
                            {{
                                (total_price * currency.exchange_rate).toFixed(
                                    2
                                )
                            }}
                            <span
                                v-if="
                                    product.has_variations == 1 &&
                                    form.selected_variations.length !=
                                        product.variations.length
                                "
                                >+</span
                            >
                        </h3>

                        <!-- tags -->
                        <div class="d-flex align-items-center">
                            <span
                                class="badge badge-pill badge-tag"
                                v-show="product.quantity > 0"
                                >In Stock</span
                            >
                            <span
                                class="badge badge-pill badge-tag"
                                v-show="product.has_inventory == 0"
                                >Made to Order</span
                            >
                        </div>
                    </div>

                    <!-- not available tag -->
                    <div
                        class="mt-4 info-location-box"
                        v-if="availability == false"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true"
                            role="img"
                            width="20"
                            height="20"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 24 24"
                            class="mr-2"
                        >
                            <circle cx="12" cy="9.5" r="1.5" fill="#333" />
                            <path
                                fill="#4e4e4e"
                                d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 3.5-3.5A3.5 3.5 0 0 1 12 13Z"
                            />
                        </svg>
                        <div>
                            This item is not available in
                            <strong>
                                {{ locationActive }}
                            </strong>
                        </div>
                    </div>

                    <!-- short description -->
                    <div class="mt-4">
                        <h6>About this item</h6>
                        <p class="mb-0">{{ product.short_description }}</p>
                    </div>

                    <!-- variation -->
                    <div v-if="product.has_variations == 1">
                        <div
                            class="mt-4"
                            v-for="(variation, index) in product.variations"
                            v-show="variation.product_state_id == 1"
                        >
                            <h6>
                                {{ variation.name }}
                                <i
                                    class="fas fa-info-circle mx-2"
                                    @click.prevent="
                                        displayInfoBox(
                                            `info-box-custom-${index}`
                                        )
                                    "
                                    v-if="variation.description"
                                ></i>
                                <div
                                    :id="`info-box-custom-${index}`"
                                    class="info-msg-box badge badge-pill"
                                >
                                    {{ variation.description }}
                                </div>
                            </h6>

                            <select
                                class="custom-select col-lg-8"
                                :class="{
                                    'border-warning': formErrors != null,
                                }"
                                name="selected_variations"
                                id="selected_variations"
                                v-model="form.selected_variations[index]"
                                @change="formErrors = null"
                            >
                                <option value="" disabled selected hidden>
                                    Select
                                </option>
                                <option
                                    v-for="(
                                        option, i
                                    ) in variation.variation_options"
                                    :key="option.id"
                                    :value="option"
                                >
                                    {{ option.name }}
                                </option>
                            </select>
                            <span
                                class="addon-price"
                                v-if="form.selected_variations[index]"
                            >
                                +
                                {{ currency.symbol }}
                                {{
                                    (
                                        form.selected_variations[index].price *
                                        currency.exchange_rate
                                    ).toFixed(2)
                                }}
                            </span>
                        </div>
                        <h6 class="text-danger mt-3" v-show="formErrors">
                            {{ formErrors }}
                        </h6>
                    </div>

                    <!-- custom msg -->
                    <div class="mt-4" v-show="product.has_custom_text == 1">
                        <h6>
                            Custom message
                            <i
                                class="fas fa-info-circle mx-2"
                                @click.prevent="
                                    displayInfoBox(`info-box-custom`)
                                "
                            ></i>
                            <div
                                id="info-box-custom"
                                class="info-msg-box badge badge-pill"
                            >
                                Max 25 characters only
                            </div>
                        </h6>

                        <input
                            id="custom_text"
                            v-model="form.custom_text"
                            type="text"
                            name="custom_text"
                            class="
                                form-control form-control-alternative
                                col-lg-8
                            "
                            placeholder="Wish Happy Birthday or Congrats ..."
                            maxlength="25"
                        />
                    </div>

                    <!-- quantity -->
                    <div class="mt-4" v-if="availability != false">
                        <h6>Quantity</h6>
                        <div class="product-card-counter">
                            <div
                                class="counter-minus"
                                @click.prevent="
                                    form.quantity > 0 ? form.quantity-- : ''
                                "
                            >
                                -
                            </div>
                            <div class="counter-num">
                                {{ form.quantity }}
                            </div>
                            <div
                                class="counter-plus"
                                @click.prevent="form.quantity++"
                            >
                                +
                            </div>
                        </div>
                        <h6 class="text-danger mt-3" v-show="formQtyError">
                            {{ formQtyError }}
                        </h6>
                    </div>

                    <!-- buttons -->
                    <div class="mt-4">
                        <div class="d-md-flex" v-if="availability != false">
                            <button
                                class="
                                    checkout-btn
                                    btn-full
                                    mt-2 mt-md-0
                                    col-md-8
                                "
                                type="submit"
                                @click.prevent="addProductToCart(product)"
                                 name="add to cart"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div>

                    <!-- ingredients -->
                    <div class="mt-4">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                product-detail-header
                                mb-3
                            "
                            data-toggle="collapse"
                            href="#collapseMaterial"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseMaterial"
                        >
                            <h5 class="mb-0">Ingredients/ Materials</h5>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                role="img"
                                width="23"
                                height="26"
                                preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill="#333"
                                    d="m5 6l5 5l5-5l2 1l-7 7l-7-7z"
                                />
                            </svg>
                        </div>
                        <div class="collapse" id="collapseMaterial">
                            <div class="card product-detail-card">
                                <p>
                                    {{ product.material }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="mt-4">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                product-detail-header
                                mb-3
                            "
                            data-toggle="collapse"
                            href="#collapseDesc"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseDesc"
                        >
                            <h5 class="mb-0">Description</h5>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                role="img"
                                width="23"
                                height="26"
                                preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill="#333"
                                    d="m5 6l5 5l5-5l2 1l-7 7l-7-7z"
                                />
                            </svg>
                        </div>
                        <div class="collapse" id="collapseDesc">
                            <div class="card product-detail-card">
                                <p>
                                    {{ product.description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- faq -->
                    <div class="mt-4">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                product-detail-header
                                mb-3
                            "
                            data-toggle="collapse"
                            href="#collapseFAQ"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseFAQ"
                        >
                            <h5 class="mb-0">F.A.Q</h5>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                role="img"
                                width="23"
                                height="26"
                                preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill="#333"
                                    d="m5 6l5 5l5-5l2 1l-7 7l-7-7z"
                                />
                            </svg>
                        </div>

                        <div class="collapse" id="collapseFAQ">
                            <div class="card product-detail-card">
                                <p>How is the pricing calculated?</p>
                                <p class="mt-2">
                                    The price of a product consists of its base
                                    price (the price at the top) + price of all
                                    selected variations
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- seller -->
                    <div class="mt-4">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                product-detail-header
                                mb-3
                            "
                            data-toggle="collapse"
                            href="#collapseSeller"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseSeller"
                        >
                            <h5 class="mb-0">Meet your Seller</h5>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true"
                                role="img"
                                width="23"
                                height="26"
                                preserveAspectRatio="xMidYMid meet"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill="#333"
                                    d="m5 6l5 5l5-5l2 1l-7 7l-7-7z"
                                />
                            </svg>
                        </div>

                        <div class="collapse" id="collapseSeller">
                            <div class="card product-detail-card">
                                <div class="d-flex">
                                    <img
                                        :src="
                                            product.user.shop.path
                                                ? product.user.shop.path
                                                : '/images/lavisco/img-bg.jpg'
                                        "
                                        class="product-seller-img mr-md-4 mr-3"
                                        :alt="product.user.shop.name"
                                    />
                                    <div>
                                        <h5 class="mb-2">
                                            {{ product.user.shop.name }}
                                        </h5>
                                        <p class="small-para mb-2">
                                            {{ product.user.shop.about }}
                                        </p>
                                        <router-link
                                            :to="{
                                                name: 'shop',
                                                params: {
                                                    shopId: product.user.shop
                                                        .id,
                                                    slug: product.user.shop
                                                        .slug,
                                                    location: locationActive,
                                                },
                                            }"
                                        >
                                            <button
                                                class="btn-secondary btn-sm"
                                                 name="View Seller"
                                            >
                                                View Seller
                                            </button>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addedToCartPopup"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="locationPopupLabel">
                            Item added to cart
                        </h4>
                        <a
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <svg
                                width="28"
                                height="28"
                                viewBox="0 0 34 34"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="34"
                                    height="34"
                                    rx="17"
                                    fill="#333333"
                                />
                                <g clip-path="url(#clip0_355_858)">
                                    <path
                                        d="M21.5803 10.9735L23.0266 12.4199C23.2275 12.6208 23.328 12.8618 23.328 13.1431C23.328 13.4243 23.2275 13.6653 23.0266 13.8662L19.8929 17L23.0266 20.1338C23.2275 20.3347 23.328 20.5757 23.328 20.8569C23.328 21.1382 23.2275 21.3792 23.0266 21.5801L21.5803 23.0265C21.3794 23.2274 21.1383 23.3278 20.8571 23.3278C20.5759 23.3278 20.3348 23.2274 20.1339 23.0265L17.0002 19.8927L13.8664 23.0265C13.6655 23.2274 13.4244 23.3278 13.1432 23.3278C12.862 23.3278 12.6209 23.2274 12.42 23.0265L10.9737 21.5801C10.7728 21.3792 10.6724 21.1382 10.6724 20.8569C10.6724 20.5757 10.7728 20.3347 10.9737 20.1338L14.1074 17L10.9737 13.8662C10.7728 13.6653 10.6724 13.4243 10.6724 13.1431C10.6724 12.8618 10.7728 12.6208 10.9737 12.4199L12.42 10.9735C12.6209 10.7726 12.862 10.6722 13.1432 10.6722C13.4244 10.6722 13.6655 10.7726 13.8664 10.9735L17.0002 14.1073L20.1339 10.9735C20.3348 10.7726 20.5759 10.6722 20.8571 10.6722C21.1383 10.6722 21.3794 10.7726 21.5803 10.9735Z"
                                        fill="#f7f7f7"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_355_858">
                                        <rect
                                            width="15"
                                            height="15"
                                            fill="#333333"
                                            transform="translate(9.5 9.5)"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center flex-row">
                            <img
                                class="banner-container-xs mr-2"
                                :src="
                                    product.product_image
                                        ? product.product_image.path
                                        : '/images/lavisco/img-bg.jpg'
                                "
                                :alt="product.title"
                            />
                            <div>
                                {{ product.title }}
                                <h5 class="text-left mb-0">
                                    {{ form.total_price }}
                                </h5>
                                <span class="text-sm">
                                    Quantity: {{ form.quantity }}
                                </span>
                            </div>
                        </div>
                        <div
                            class="
                                d-flex
                                justify-content-center
                                align-items-center
                                flex-column flex-md-row
                                mt-4
                            "
                        >
                            <button
                                type="button"
                                class="
                                    btn-secondary btn-full
                                    mr-md-2
                                    mb-md-0 mb-2
                                "
                                data-dismiss="modal"
                                 name="Keep shopping"
                            >
                                Keep shopping
                            </button>
                            <button
                                type="button"
                                @click.prevent="goToCart()"
                                class="btn-full"
                                 name="go to cart"
                            >
                                Go to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        product: [],
        availability: "not-applicable",
        custom: false,
        loading: true,
        sliderImgList: [],
        currentImg: 0,
        show: true,
        form: {
            id: "",
            custom_text: "",
            selected_variations: [],
            total_price: "",
            quantity: 0,
        },
        formErrors: null,
        formQtyError: null,
    }),

    beforeRouteEnter: function (to, from, next) {
        axios
            .get(
                "/api/products/" +
                    to.params.productId +
                    "/" +
                    to.params.location
            )
            .then((response) => {
                next((vm) => {
                    vm.setData(response);
                });
            })
            .catch((error) => console.log(error));
    },

    beforeRouteUpdate: function (to, from, next) {
        axios
            .get(
                "/api/products/" +
                    to.params.productId +
                    "/" +
                    to.params.location
            )
            .then((response) => {
                this.setData(response);
                next();
            })
            .catch((error) => console.log(error));
    },

    watch: {
        total_price(after, before) {
            this.form.total_price = this.total_price;
        },
        locationActive(after, before) {
            this.$router.push({
                name: "products/product",
                params: {
                    productId: this.product.id,
                    slug: this.product.slug,
                    location: this.locationActive,
                },
            });
        },
    },

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
        total_price() {
            let var1price = this.form.selected_variations[0]
                ? this.form.selected_variations[0].price
                : 0;
            let var2price = this.form.selected_variations[1]
                ? this.form.selected_variations[1].price
                : 0;
            let var3price = this.form.selected_variations[2]
                ? this.form.selected_variations[2].price
                : 0;

            return (
                parseFloat(this.product.base_price) +
                parseFloat(var1price) +
                parseFloat(var2price) +
                parseFloat(var3price)
            ).toFixed(2);
        },
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    methods: {
        setData(response) {
            this.product = response.data.product;

            if (this.product.category_id == "1") {
                this.availability = response.data.availability;
            }

            //for products in category- custom
            // if (this.product.sub_categories.length > 0) {
            //     this.customCategory();
            // }
            this.loading = false;

            for (let key in this.product.product_images) {
                this.sliderImgList.push(this.product.product_images[key].path);
            }
        },

        /*
         *   Product Image Slider
         */

        setSliderImg(index) {
            this.currentImg = index;
        },

        nextSliderImg() {
            if (this.currentImg < this.sliderImgList.length - 1) {
                this.currentImg += 1;
            }
        },

        prevSliderImg() {
            if (this.currentImg > 0) {
                this.currentImg -= 1;
            }
        },

        /*
         *   Other
         */

        goToCart() {
            window.location.replace("/cart");
        },

        customCategory() {
            if (this.product.sub_categories[0].name == "Custom") {
                this.custom = true;
            } else {
                this.custom = false;
            }
        },

        displayInfoBox(name) {
            if (document.getElementById(name).style.display == "inline-block") {
                document.getElementById(name).style.display = "none";
            } else {
                document.getElementById(name).style.display = "inline-block";
            }
        },

        addProductToCart(product) {
            let activeVariation = [];

            this.product.variations.forEach((vari, index) => {
                if (vari.product_state_id == 1) {
                    this.$set(activeVariation, index, vari);
                }
            });

            if (this.form.quantity > 0) {
                if (this.product.has_variations === 1) {
                    if (
                        this.form.selected_variations.length ===
                        activeVariation.length
                    ) {
                        this.$store.dispatch("addProductToCart", {
                            product: product,
                            form: this.form,
                        });
                        $("#addedToCartPopup").modal("show");
                        this.formErrors = null;
                        this.formQtyError = null;
                    } else {
                        this.formErrors =
                            "Please select an option in all the variations above to add product to cart";
                    }
                } else {
                    this.$store.dispatch("addProductToCart", {
                        product: product,
                        form: this.form,
                    });
                    $("#addedToCartPopup").modal("show");
                    this.formErrors = null;
                    this.formQtyError = null;
                }
            } else {
                this.formQtyError = "Please select quantity";
            }

            //pass multiple parameters to vuex action using destructuring
        },

        increaseProductQuantity(product) {
            this.$store.dispatch("increaseProductQuantity", product);
        },

        decreaseProductQuantity(product) {
            this.$store.dispatch("decreaseProductQuantity", product);
        },
    },
    mounted() {},
};
</script>
