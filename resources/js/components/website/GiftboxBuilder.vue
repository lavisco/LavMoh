<template>
    <div class="container-fluid mb-5">
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
                <div class="col-md-7 pr-md-5 mb-4 mb-md-0">
                    <div class="giftbox-card">
                        <h2 class="text-left">Gift Box Builder</h2>
                        <p class="mb-5">
                            Select from your favourite Lavisco items to create
                            your perfect box. 100% fresh, delicious, and perfect
                            for every occasion.
                        </p>
                        <div
                            class="
                                d-flex
                                flex-wrap
                                justify-content-center
                                card-container
                                product-list
                            "
                        >
                            <div
                                class="item-card-2"
                                v-for="item in product.giftbox_products"
                                :key="item.id"
                            >
                                <div class="card-img card-img-2">
                                    <img
                                        :src="
                                            item.child_product
                                                ? item.child_product
                                                      .product_image.path
                                                : '/images/lavisco/img-bg.jpg'
                                        "
                                    />
                                </div>
                                <div
                                    class="
                                        px-md-3
                                        pb-3
                                        d-flex
                                        flex-column
                                        align-items-center
                                    "
                                >
                                    <div class="card-title-2 text-center">
                                        {{ item.child_product.title }}
                                    </div>
                                    <div class="card-price">
                                        {{
                                            `${currency.symbol} ${item.child_product.base_price}`
                                        }}
                                    </div>
                                    <div class="product-card-counter mt-2">
                                        <div
                                            class="counter-minus"
                                            @click.prevent="
                                                decrementProductQtyInBox(
                                                    item.child_product
                                                )
                                            "
                                        >
                                            -
                                        </div>
                                        <div class="counter-num">
                                            {{
                                                displayProductQtyInBox(
                                                    item.child_product
                                                )
                                            }}
                                        </div>
                                        <div
                                            class="counter-plus"
                                            @click.prevent="
                                                incrementProductQtyInBox(
                                                    item.child_product,
                                                    item.quantity
                                                )
                                            "
                                        >
                                            +
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 input-form">
                    <!-- title -->
                    <div class="row">
                        <h3 class="text-left col-12 mt-md-0 mt-3 mb-1">
                            {{ product.title }}
                        </h3>
                    </div>
                    <h6 class="mb-1">{{ product.user.shop.name }}</h6>

                    <!-- price -->
                    <div class="mt-3">
                        <h3 class="price">
                            {{ currency.symbol }}
                            {{
                                (total_price * currency.exchange_rate).toFixed(
                                    2
                                )
                            }}
                        </h3>
                    </div>

                    <!-- short description -->
                    <div class="mt-4">
                        <h6>About this item</h6>
                        <p class="mb-0">
                            {{ product.short_description }}
                        </p>
                    </div>

                    <!-- choices -->
                    <div class="mt-4">
                        <h6>Your choices</h6>
                        <div
                            class="giftbox-product-card-sm mb-1"
                            v-for="product in form.giftbox_product"
                        >
                            <div class="giftbox-product-card-body">
                                <img
                                    :src="
                                        product.path
                                            ? product.path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                />
                                <div class="card-title-2">
                                    {{ product.title }}
                                </div>
                            </div>
                            <div class="product-card-counter">
                                <div
                                    class="counter-minus"
                                    @click.prevent="
                                        decrementProductQtyInBox(product)
                                    "
                                >
                                    -
                                </div>
                                <div class="counter-num">
                                    {{ displayProductQtyInBox(product) }}
                                </div>
                                <div
                                    class="counter-plus"
                                    @click.prevent="
                                        incrementProductQtyInBox(
                                            product,
                                            product.maxQuantity
                                        )
                                    "
                                >
                                    +
                                </div>
                            </div>
                        </div>
                        <h6 class="text-danger mt-1" v-show="formErrors">
                            {{ formErrors }}
                        </h6>
                    </div>

                    <!-- custom msg -->
                    <div class="mt-4">
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
                            <button
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
                                    The price of a giftbox is calculated based
                                    on the base price of the products you have
                                    selected, multiplied by their respective
                                    quantity.
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
        loading: true,
        product: [],
        form: {
            id: "",
            custom_text: "",
            total_price: "",
            giftbox_product: [],
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
            let sum = 0;
            this.form.giftbox_product.map((product) => {
                sum += parseFloat(product.base_price) * product.quantity;
            });
            return sum.toFixed(2);
        },
    },

    methods: {
        /*
         * products available in giftbox methods
         */

        findProductInBox(productId) {
            return this.form.giftbox_product.find(
                (item) => item.id === productId
            );
        },
        incrementProductQtyInBox(product, maxQty) {
            const BoxItem = this.findProductInBox(product.id);
            if (!BoxItem) {
                //if product doesn't exist in box, push to box
                this.form.giftbox_product.push({
                    id: product.id,
                    title: product.title,
                    path: product.product_image.path,
                    base_price: product.base_price,
                    quantity: 1,
                    maxQuantity: maxQty,
                });
            } else {
                BoxItem.maxQuantity == BoxItem.quantity
                    ? ""
                    : BoxItem.quantity++;
            }
        },
        decrementProductQtyInBox(product) {
            const BoxItem = this.findProductInBox(product.id);

            if (BoxItem) {
                if (BoxItem.quantity === 1) {
                    this.form.giftbox_product.splice(
                        this.form.giftbox_product.indexOf(BoxItem),
                        1
                    );
                } else {
                    BoxItem.quantity--;
                }
            }
        },
        displayProductQtyInBox(product) {
            const BoxItem = this.findProductInBox(product.id);
            if (!BoxItem) {
                return 0;
            }
            return BoxItem.quantity;
        },

        /*
         * other methods
         */

        displayInfoBox(name) {
            if (document.getElementById(name).style.display == "inline-block") {
                document.getElementById(name).style.display = "none";
            } else {
                document.getElementById(name).style.display = "inline-block";
            }
        },

        setData(response) {
            this.product = response.data;
            this.loading = false;
        },

        addProductToCart(product) {
            if (this.form.giftbox_product.length === 0) {
                this.formErrors = "Please add products to your giftbox";
            } else {
                this.$store.dispatch("addGiftboxToCart", {
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
