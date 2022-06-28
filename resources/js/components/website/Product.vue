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
                                <img :src="product_image.path" />
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

                    <div class="row">
                        <h3 class="text-left col-12 mt-md-0 mt-3">
                            {{ product.title }}
                        </h3>
                    </div>
                    <p class="mb-1">{{ product.user.shop.name }}</p>
                    <!-- tags -->
                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                        "
                    >
                        <div>
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

                    <!-- price -->
                    <div class="mt-3">
                        <h3 class="price">
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
                        <h6 class="text-danger mt-4" v-show="formErrors">
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
                            placeholder="Custom message"
                            maxlength="25"
                        />
                    </div>

                    <!-- buttons -->
                    <div class="mt-4">
                        <div class="d-md-flex">
                            <router-link
                                class="w-100"
                                :to="{
                                    name: 'custom_product_inquiry',
                                    params: {
                                        productId: product.id,
                                    },
                                }"
                                v-if="custom"
                            >
                                <button
                                    class="
                                        checkout-btn
                                        btn-full
                                        checkout-btn-cart
                                        mt-2 mt-md-0
                                        col-md-8
                                    "
                                    type="button"
                                >
                                    Inquire
                                </button>
                            </router-link>
                            <button
                                v-if="!custom"
                                class="
                                    checkout-btn
                                    btn-full
                                    checkout-btn-cart
                                    mt-2 mt-md-0
                                    col-md-8
                                "
                                type="submit"
                                @click.prevent="addProductToCart(product)"
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
                            <h5 class="mb-0">Ingredients</h5>
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
                                        alt=""
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
                                                },
                                            }"
                                        >
                                            <button
                                                class="btn-secondary btn-sm"
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
    </div>
</template>

<script>
export default {
    data: () => ({
        product: [],
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
        },
        formErrors: null,
    }),

    beforeRouteEnter: function (to, from, next) {
        let uri = "/api/products/" + to.params.productId;
        axios
            .get(uri)
            .then((response) => {
                next((vm) => {
                    vm.setData(response);
                });
            })
            .catch((error) => console.log(error));
    },

    beforeRouteUpdate: function (to, from, next) {
        let uri = "/api/products/" + to.params.productId;
        axios
            .get(uri)
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
    },

    methods: {
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

        setData(response) {
            this.product = response.data;
            if (this.product.sub_categories.length > 0) {
                this.customCategory();
            }
            this.loading = false;

            for (let key in this.product.product_images) {
                this.sliderImgList.push(this.product.product_images[key].path);
            }
        },

        addProductToCart(product) {
            let activeVariation = [];

            this.product.variations.forEach((vari, index) => {
                if (vari.product_state_id == 1) {
                    this.$set(activeVariation, index, vari);
                }
            });

            if (this.product.has_variations === 1) {
                if (
                    this.form.selected_variations.length ===
                    activeVariation.length
                ) {
                    this.$store.dispatch("addProductToCart", {
                        product: product,
                        form: this.form,
                    });
                    this.formErrors = null;
                } else {
                    this.formErrors =
                        "Please select an option in all the variations above to add product to cart";
                }
            } else {
                this.$store.dispatch("addProductToCart", {
                    product: product,
                    form: this.form,
                });
            }

            //pass multiple parameters to vuex action using destructuring
        },
    },
    mounted() {},
};
</script>
