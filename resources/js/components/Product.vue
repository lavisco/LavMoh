<template>
    <div class="container-fluid mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">
                    <router-link to="/lavisco/products"> Products </router-link>
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
                            class="swiper gallery-top"
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
                <div class="col-md-6">
                    <div class="row">
                        <h3 class="text-left col-9">{{ product.title }}</h3>
                        <div class="col-3 text-right">
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 45 45"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M40.5615 12.4632C39.9725 11.0993 39.1231 9.86331 38.061 8.82449C36.9981 7.78258 35.745 6.95458 34.3696 6.38553C32.9435 5.79312 31.4139 5.48988 29.8696 5.49344C27.7031 5.49344 25.5894 6.0867 23.7524 7.20731C23.313 7.47537 22.8955 7.76981 22.5 8.09061C22.1045 7.76981 21.687 7.47537 21.2476 7.20731C19.4106 6.0867 17.2969 5.49344 15.1304 5.49344C13.5703 5.49344 12.0586 5.79227 10.6304 6.38553C9.25049 6.95682 8.00684 7.7786 6.93896 8.82449C5.87547 9.86214 5.02593 11.0984 4.43848 12.4632C3.82764 13.8826 3.51562 15.3899 3.51562 16.9412C3.51562 18.4046 3.81445 19.9295 4.40771 21.4807C4.9043 22.7771 5.61621 24.1219 6.52588 25.4798C7.96729 27.6287 9.94922 29.8699 12.4102 32.1419C16.4883 35.908 20.5269 38.5096 20.6982 38.615L21.7397 39.283C22.2012 39.5774 22.7944 39.5774 23.2559 39.283L24.2974 38.615C24.4688 38.5052 28.5029 35.908 32.5854 32.1419C35.0464 29.8699 37.0283 27.6287 38.4697 25.4798C39.3794 24.1219 40.0957 22.7771 40.5879 21.4807C41.1812 19.9295 41.48 18.4046 41.48 16.9412C41.4844 15.3899 41.1724 13.8826 40.5615 12.4632ZM22.5 35.8069C22.5 35.8069 6.85547 25.783 6.85547 16.9412C6.85547 12.4632 10.5601 8.83328 15.1304 8.83328C18.3428 8.83328 21.1289 10.6263 22.5 13.2454C23.8711 10.6263 26.6572 8.83328 29.8696 8.83328C34.4399 8.83328 38.1445 12.4632 38.1445 16.9412C38.1445 25.783 22.5 35.8069 22.5 35.8069Z"
                                    fill="#333333"
                                />
                            </svg>
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 45 45"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M5.625 22.5C5.625 25.6012 8.14875 28.125 11.25 28.125C12.7387 28.125 14.085 27.5344 15.0919 26.5875L26.325 33.0075C26.2913 33.2512 26.25 33.495 26.25 33.75C26.25 36.8512 28.7738 39.375 31.875 39.375C34.9762 39.375 37.5 36.8512 37.5 33.75C37.5 30.6488 34.9762 28.125 31.875 28.125C30.3862 28.125 29.04 28.7156 28.0331 29.6625L16.8 23.2444C16.8337 22.9988 16.875 22.755 16.875 22.5C16.875 22.245 16.8337 22.0012 16.8 21.7556L28.0331 15.3375C29.04 16.2844 30.3862 16.875 31.875 16.875C34.9762 16.875 37.5 14.3512 37.5 11.25C37.5 8.14875 34.9762 5.625 31.875 5.625C28.7738 5.625 26.25 8.14875 26.25 11.25C26.25 11.505 26.2913 11.7487 26.325 11.9944L15.0919 18.4125C14.055 17.4275 12.6801 16.8773 11.25 16.875C8.14875 16.875 5.625 19.3988 5.625 22.5Z"
                                    fill="black"
                                />
                            </svg>
                        </div>
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
                        <div class="d-flex align-items-center">
                            <div class="rating mr-2">
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                            </div>
                            <h4 class="mb-0">4.2</h4>
                        </div>
                    </div>
                    <div
                        class="mt-4"
                        v-show="variations"
                        v-for="variation in variations"
                    >
                        <h6>{{ variation[0].type }}</h6>

                        <select class="custom-select website-select col-md-6">
                            <option value="" disabled selected hidden>
                                Select Option
                            </option>
                            <option v-for="option in variation">
                                {{ option.type_option }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <h6>Price</h6>
                        <h3 class="price">LKR {{ product.base_price }}</h3>
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
                            <div>
                                <span
                                    class="badge bg-green white"
                                    v-for="material in product.materials"
                                    >{{ material.name }}
                                </span>
                            </div>
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
                                <p>Q: Question</p>
                                <p>A: Answer</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <hr />
                        <h6>Meet your Seller</h6>
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
                                            name: 'sellers/seller',
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

// import style (>= Swiper 6.x)
//import "swiper/swiper-bundle.css";

// import style (<= Swiper 5.x)
import "swiper/css/swiper.css";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    directives: {
        swiper: directive,
    },

    data: () => ({
        product: [],
        variations: [],
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
    }),

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
            this.product = response.data.product;
            this.variations = response.data.variations;
            this.loading = false;
        },
        loadProduct() {
            axios
                .get("/api/products/" + this.$route.params.productId)
                .then((response) => {
                    this.product = response.data.product;
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
