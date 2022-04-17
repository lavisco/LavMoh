<template>
    <div>
        <div class="hero">
            <!-- Swiper -->
            <swiper
                class="swiper gallery-top"
                :options="swiperOptionTop"
                ref="swiperTop"
            >
                <swiper-slide
                    class="slide-1"
                    v-for="homeslider in homesliders"
                    :key="homeslider.id"
                >
                    <img
                        :src="
                            homeslider.path
                                ? homeslider.path
                                : '/images/lavisco/img-bg.jpg'
                        "
                    />
                    <div class="slide-content">
                        <h1 class="title mb-3">{{ homeslider.name }}</h1>
                        <h1 class="sub-title mb-5">
                            {{ homeslider.description }}
                        </h1>
                        <a :href="homeslider.link">
                            <button>{{ homeslider.link_text }}</button>
                        </a>
                    </div>
                </swiper-slide>
                <div
                    class="swiper-button-next swiper-button-black"
                    slot="button-next"
                ></div>
                <div
                    class="swiper-button-prev swiper-button-black"
                    slot="button-prev"
                ></div>
                <div class="swiper-pagination" slot="pagination"></div>
            </swiper>
            <!-- Swiper end -->
        </div>
        <div class="container-fluid">
            <section class="section-best-seller">
                <h1>Our Best Selling Products</h1>
                <swiper
                    class="swiper swiper-index-product"
                    :options="swiperOption"
                >
                    <swiper-slide v-for="product in products" :key="product.id">
                        <div class="card item-card">
                            <div class="card-img">
                                <img
                                    :src="
                                        product.product_image
                                            ? product.product_image.path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                    :class="{
                                        'img-cover': !product.product_image,
                                    }"
                                />
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <router-link
                                        :to="{
                                            name: 'products/product',
                                            params: {
                                                productId: product.id,
                                            },
                                        }"
                                    >
                                        {{ product.title }}
                                    </router-link>
                                </div>
                                <div class="card-secondary-text white">
                                    {{ product.user.shop.name }}
                                </div>
                                <div
                                    class="
                                        d-flex
                                        align-items-end
                                        justify-content-between
                                        mt-3
                                    "
                                >
                                    <div class="card-title card-price">
                                        {{ product.base_price }}
                                    </div>
                                    <div class="text-right">
                                        <div
                                            class="
                                                card-secondary-text
                                                white
                                                text-right
                                            "
                                        >
                                            {{ product.category.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </swiper-slide>
                    <div
                        class="swiper-pagination product-pagination"
                        slot="pagination"
                    ></div>
                </swiper>
                <div class="d-flex justify-content-center mt-5">
                    <a href="/products" class="view-more-link"
                        >View More
                        <svg
                            width="70"
                            height="24"
                            viewBox="0 0 90 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="ml-3"
                        >
                            <path
                                d="M2 10.5C1.17157 10.5 0.5 11.1716 0.5 12C0.5 12.8284 1.17157 13.5 2 13.5L2 10.5ZM89.0607 13.0607C89.6464 12.4749 89.6464 11.5251 89.0607 10.9393L79.5147 1.39341C78.9289 0.807618 77.9792 0.807618 77.3934 1.3934C76.8076 1.97919 76.8076 2.92894 77.3934 3.51473L85.8787 12L77.3934 20.4853C76.8076 21.0711 76.8076 22.0208 77.3934 22.6066C77.9792 23.1924 78.9289 23.1924 79.5147 22.6066L89.0607 13.0607ZM2 13.5L88 13.5L88 10.5L2 10.5L2 13.5Z"
                                fill="#333333"
                            />
                        </svg>
                    </a>
                </div>
            </section>
            <section class="section-special">
                <h1>Gifts and Crafts for Every Occasion & Recipient</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div
                            class="
                                card
                                item-card item-card-occasion
                                mb-md-0 mb-5
                            "
                        >
                            <div class="card-img">
                                <div class="card-img-text-container">
                                    <div class="card-img-text">
                                        <a href="/occasions">
                                            Order by Occasion
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-button-container"
                                v-if="occasions[0]"
                            >
                                <a href="" v-for="(n, index) in 10">
                                    <router-link
                                        :to="{
                                            name: 'occasions/occasion',
                                            params: {
                                                occasionId: occasions[index].id,
                                            },
                                        }"
                                    >
                                        <button class="bg-black">
                                            {{ occasions[index].name }}
                                        </button>
                                    </router-link>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card item-card item-card-recipient">
                            <div class="card-img">
                                <div class="card-img-text-container">
                                    <div class="card-img-text">
                                        <a href="/recipients">
                                            Order by Recipient
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-button-container"
                                v-if="recipients[0]"
                            >
                                <a href="" v-for="(n, index) in 10">
                                    <router-link
                                        :to="{
                                            name: 'recipients/recipient',
                                            params: {
                                                recipientId:
                                                    recipients[index].id,
                                            },
                                        }"
                                    >
                                        <button class="bg-black">
                                            {{ recipients[index].name }}
                                        </button>
                                    </router-link>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-category"></section>
            <section class="section-social-slider">
                <h1>Share the Fun</h1>
                <h2 class="grey">Use #Luvit #Lavisco to be Featured</h2>
            </section>
            <section class="section-instruction">
                <h1>How Lavisco Works</h1>
                <div class="row">
                    <div class="col-md-3 mb-md-0 mb-5">
                        <div class="card instruction-card instruction-card-1">
                            <h1>1</h1>
                            <img :src="icon_cake" />
                            <p>
                                Browse through our wide range of products for
                                any occasion and pick your choice.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-5">
                        <div class="card instruction-card instruction-card-2">
                            <h1>2</h1>
                            <img :src="icon_surprise" />
                            <div>
                                <p>
                                    Get creative and add a personal touch to
                                    your products by choosing custom options.
                                </p>
                                <span class="text-sm"
                                    >Skip this step if you don't want to
                                    personalise</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-5">
                        <div class="card instruction-card instruction-card-3">
                            <h1>3</h1>
                            <img :src="icon_money" />
                            <p>
                                Choose from one of the many easy payment options
                                & finalize your order!
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card instruction-card instruction-card-4">
                            <h1>4</h1>
                            <img :src="icon_delivery" />
                            <p>
                                Sit back & relax!!! <br />
                                We will deliver your order right to your door
                                step with no hassle.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-shortcuts row">
                <div class="col-md-6 shortcut-left py-4 px-md-5">
                    <h1 class="mb-3">Start selling on Lavisco</h1>
                    <h4 class="mb-5">
                        Join a one of a kind marketplace and get an edge over
                        your competitors.
                    </h4>
                    <router-link to="/seller_onboard">
                        <button class="bg-orange">Become a Seller</button>
                    </router-link>
                </div>
                <div class="col-md-6 shortcut-right py-4 px-md-5">
                    <h1 class="mb-3">Create an account today!</h1>
                    <h4 class="mb-5">
                        Sign up with Lavisco today to unlock exclusive drops and
                        discounts!
                    </h4>
                    <a href="/register">
                        <button class="bg-green">Sign up</button>
                    </a>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
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
        products: [],
        occasions: [],
        recipients: [],
        categories: [],
        homesliders: [],
        icon_cake: "",
        icon_delivery: "",
        icon_money: "",
        icon_surprise: "",
        swiperOption: {
            slidesPerView: 5,
            spaceBetween: 20,
            pagination: {
                el: ".product-pagination",
                clickable: true,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
        },
        swiperOptionTop: {
            loop: true,
            loopedSlides: 3, // looped slides should be the same
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        },
    }),

    methods: {
        loadData() {
            axios
                .get("/api/home")
                .then((response) => {
                    this.products = response.data.products;
                    this.occasions = response.data.occasions;
                    this.recipients = response.data.recipients;
                    this.categories = response.data.categories;
                    this.homesliders = response.data.homesliders;
                    this.icon_cake = response.data.icon_cake;
                    this.icon_delivery = response.data.icon_delivery;
                    this.icon_money = response.data.icon_money;
                    this.icon_surprise = response.data.icon_surprise;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadData();
        Fire.$on("reloadRecords", () => {
            this.loadData();
        });
    },
};
</script>
