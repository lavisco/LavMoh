<template>
    <div class="container-fluid mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">
                    <router-link to="/products"> Products </router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ product.title }}
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
                <div class="col-md-6">
                    <!-- Swiper -->
                    <div class="thumb-example">
                        <!-- swiper1 -->
                        <swiper
                            class="swiper gallery-top product-swiper"
                            :options="swiperOptionTop"
                            ref="swiperTop"
                        >
                            <swiper-slide
                                class="slide-1"
                                v-for="product_image in product.product_images"
                                :key="product_image.id"
                                ><img :src="product_image.path"
                            /></swiper-slide>
                            <div
                                class="swiper-button-next swiper-button-black"
                                slot="button-next"
                            ></div>
                            <div
                                class="swiper-button-prev swiper-button-black"
                                slot="button-prev"
                            ></div>
                        </swiper>
                        <!-- swiper2 Thumbs -->
                        <swiper
                            class="swiper gallery-thumbs"
                            :options="swiperOptionThumbs"
                            ref="swiperThumbs"
                        >
                            <swiper-slide
                                class="slide-1"
                                v-for="product_image in product.product_images"
                                :key="product_image.id"
                            >
                                <img :src="product_image.path" />
                            </swiper-slide>
                        </swiper>
                    </div>
                    <!-- Swiper end -->
                </div>
                <div class="col-md-6 input-form">
                    <div class="row">
                        <h3 class="text-left col-12">{{ product.title }}</h3>
                    </div>
                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                            pt-2
                        "
                    >
                        <div>
                            <span
                                class="badge badge-pill badge-success bg-green"
                                v-show="product.quantity > 0"
                                >In Stock</span
                            >
                            <span
                                class="badge badge-pill badge-success bg-orange"
                                v-show="product.has_inventory == 0"
                                >Made to Order</span
                            >
                        </div>
                    </div>
                    <div
                        class="mt-4"
                        v-show="variations"
                        v-for="(variation, index) in variations"
                        :key="variation.id"
                    >
                        <h6>{{ variation[0].type }}</h6>

                        <select
                            class="custom-select col-md-6"
                            @change="recordVariationDetails($event, variation)"
                        >
                            <option value="" disabled selected hidden>
                                Select {{ variation[0].type }}
                            </option>
                            <option v-for="(option, i) in variation" :key="option.id" :value="i">
                                {{ option.type_option }}
                                + {{ option.price }} lkr
                            </option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <h6>Price</h6>
                        <h3 class="price">LKR {{ product.base_price }}</h3>
                    </div>
                    <div class="mt-4">
                        <h6>About this item</h6>
                        <p>{{ product.short_description }}</p>
                    </div>
                    <div class="mt-4" v-show="product.has_custom_text == 1">
                        <h6>Custom message</h6>

                        <input
                            id="custom_text"
                            v-model="form.custom_text"
                            type="text"
                            name="custom_text"
                            class="form-control form-control-alternative"
                            placeholder="Custom message"
                        />
                    </div>
                    <div class="mt-4">
                        <h6>Checkout</h6>
                        <div class="d-md-flex">
                            <button
                                class="checkout-btn btn-full col-md-6 mr-md-2"
                            >
                                Quick Buy
                            </button>
                            <button
                                class="
                                    checkout-btn
                                    btn-full
                                    checkout-btn-cart
                                    mt-2 mt-md-0
                                    col-md-6
                                "
                                @click.prevent="addProductToCart(product)"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <hr />
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                            "
                        >
                            <h6 class="mb-0">Description</h6>
                            <a
                                data-toggle="collapse"
                                href="#collapseDesc"
                                role="button"
                                aria-expanded="false"
                                aria-controls="collapseDesc"
                            >
                                <svg
                                    width="45"
                                    height="45"
                                    viewBox="0 0 45 45"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        x="33"
                                        y="24"
                                        width="20"
                                        height="4.07299"
                                        transform="rotate(-180 33 24)"
                                        fill="#333333"
                                    />
                                </svg>
                            </a>
                        </div>
                        <div class="collapse" id="collapseDesc">
                            <p class="mb-2">
                                {{ product.description }}
                            </p>
                            <p class="mb-2">
                                {{ product.material }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <hr />
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                            "
                        >
                            <h6 class="mb-0">F.A.Q</h6>
                            <a
                                data-toggle="collapse"
                                href="#collapseFAQ"
                                role="button"
                                aria-expanded="false"
                                aria-controls="collapseFAQ"
                            >
                                <svg
                                    width="45"
                                    height="45"
                                    viewBox="0 0 45 45"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        x="33"
                                        y="24"
                                        width="20"
                                        height="4.07299"
                                        transform="rotate(-180 33 24)"
                                        fill="#333333"
                                    />
                                </svg>
                            </a>
                        </div>

                        <div class="collapse" id="collapseFAQ">
                            <div class="card faq-card">
                                <p>How is the pricing calculated?</p>
                                <p>
                                    The price of a product consists of its base
                                    price + variation price
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <hr />
                        <h6 class="mt-4">Meet your Seller</h6>
                        <div class="d-flex">
                            <img
                                src="/images/lavisco/img-bg.jpg"
                                class="product-seller-img mr-md-4"
                                alt=""
                            />
                            <div>
                                <h4>{{ product.user.shop.name }}</h4>
                                <p>
                                    {{ product.user.shop.about }}
                                </p>
                                <button class="btn-secondary">
                                    <router-link
                                        :to="{
                                            name: 'seller_shop',
                                            params: {
                                                shopId: product.user.shop.id,
                                            },
                                        }"
                                    >
                                        View Seller
                                    </router-link>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

// import style (>= Swiper 6.x)
//import "swiper/swiper-bundle.css";

// import style (<= Swiper 5.x)
import "swiper/css/swiper.css";

export default {
    components: {
        HasError,
        AlertError,
        Swiper,
        SwiperSlide,
    },
    directives: {
        swiper: directive,
    },

    data: () => ({
        product: [],
        loading: true,
        swiperOptionTop: {
            loop: true,
            loopedSlides: 3, // looped slides should be the same
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        },
        swiperOptionThumbs: {
            loop: true,
            loopedSlides: 3, // looped slides should be the same
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: "auto",
            touchRatio: 0.2,
            slideToClickedSlide: true,
        },
        form: new Form({
            id: "",
            custom_text: "",
            variation_type_option: [null, null, null],
            selected_variations: [
                {
                    variation_type_option: "",
                    variation_price: "",
                },
                {
                    variation_type_option: "",
                    variation_price: "",
                },
                {
                    variation_type_option: "",
                    variation_price: "",
                },
            ],
        }),
    }),

    computed: {
        variations() {
            return _.groupBy(
                this.product.product_variations,
                (variation) => variation.type
            );
        },
    },

    beforeRouteEnter: function (to, from, next) {
        let uri = "/api/products/" + to.params.productId;

        axios.get(uri).then((response) => {
            next((vm) => {
                vm.setData(response);
            });
        });
    },

    beforeRouteUpdate: function (to, from, next) {
        let uri = "/api/products/" + to.params.productId;
        axios.get(uri).then((response) => {
            this.setData(response);
            next();
        });
    },

    methods: {
        setData(response) {
            this.product = response.data;
            this.loading = false;
        },

        recordVariationDetails(event, variation) {
            //console.log(option);
            let index = event.target.value;
            console.log(variation[index].type_option);
            console.log(variation[index].price);

            this.$set( this.form.selected_variations[index], 'variation_type_option', variation[index].type_option);

            //this.form.selected_variations[index].variation_type_option = variation[index].type_option;
            this.form.selected_variations[index].variation_price = variation[index].price;
        },

        loadProduct() {
            axios
                .get("/api/products/" + this.$route.params.productId)
                .then((response) => {
                    this.product = response.data.product;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        addProductToCart(product) {
            this.$store.dispatch("addProductToCart", product);
        },
    },
    mounted() {
        this.$nextTick(() => {
            const swiperTop = this.$refs.swiperTop.$swiper;
            const swiperThumbs = this.$refs.swiperThumbs.$swiper;
            swiperTop.controller.control = swiperThumbs;
            swiperThumbs.controller.control = swiperTop;
        });
    },
};
</script>
