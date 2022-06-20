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
                        <router-link :to="homeslider.link">
                            <button>{{ homeslider.link_text }}</button>
                        </router-link>
                    </div>
                </swiper-slide>
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
                        <router-link
                            :to="{
                                name: 'products/product',
                                params: {
                                    productId: product.id,
                                    slug: product.slug,
                                },
                            }"
                            class="card item-card"
                        >
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
                                    {{ product.title }}
                                </div>
                                <div class="card-price">
                                    {{ currency.symbol }}
                                    {{
                                        product.base_price *
                                        currency.exchange_rate
                                    }}
                                </div>

                                <div
                                    class="
                                        d-flex
                                        align-items-end
                                        justify-content-between
                                        mt-2
                                    "
                                >
                                    <div class="card-secondary-text white">
                                        {{ product.user.shop.name }}
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
                        </router-link>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev">
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
                                fill="#666"
                                d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 9V8l-4 4l4 4v-3h4v-2h-4z"
                            />
                        </svg>
                    </div>
                    <div class="swiper-button-next" slot="button-next">
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
                                fill="#666"
                                d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 9H8v2h4v3l4-4l-4-4v3z"
                            />
                        </svg>
                    </div>
                </swiper>
                <div class="d-flex justify-content-center mt-4">
                    <router-link class="view-more-link" to="/products">
                        View More
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
                                fill="#666"
                                d="M12 11V8l4 4l-4 4v-3H8v-2h4zm0-9c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8s-8 3.58-8 8s3.58 8 8 8z"
                            />
                        </svg>
                    </router-link>
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
                            v-bind:style="{
                                'background-image': 'url(' + img_occasion + ')',
                            }"
                        >
                            <div class="card-img-text">
                                <router-link to="/occasions">
                                    Order by Occasion
                                </router-link>
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
                                                slug: occasions[index].slug,
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
                        <div
                            class="card item-card item-card-recipient"
                            v-bind:style="{
                                'background-image':
                                    'url(' + img_recipient + ')',
                            }"
                        >
                            <div class="card-img-text">
                                <router-link to="/recipients">
                                    Order by Recipient
                                </router-link>
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
                                                slug: recipients[index].slug,
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

            <section class="section-category">
                <h1>Find the perfect gift for your Loved ones</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="gallery">
                            <router-link
                                :to="{
                                    name: 'categories/category',
                                    params: {
                                        categoryId: category.id,
                                        slug: category.slug,
                                    },
                                }"
                                class="gallery-item"
                                :class="`gallery-item--${index + 1}`"
                                v-for="(category, index) in categories"
                                :key="category.id"
                            >
                                <img
                                    :src="category.path ? category.path : ''"
                                    class="gallery-img"
                                    alt="Image 1"
                                />
                                <div class="card-img-text">
                                    {{ category.name }}
                                </div>
                            </router-link>
                        </div>
                        <div
                            class="
                                mt-4
                                d-flex
                                align-items-center
                                justify-content-center
                            "
                        >
                            <router-link
                                class="view-more-link"
                                to="/categories"
                            >
                                Browse All
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
                                        fill="#666"
                                        d="M12 11V8l4 4l-4 4v-3H8v-2h4zm0-9c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12S6.48 2 12 2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8s-8 3.58-8 8s3.58 8 8 8z"
                                    />
                                </svg>
                            </router-link>
                        </div>
                    </div>
                </div>
            </section>

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
        img_occasion: "",
        img_recipient: "",
        swiperOption: {
            slidesPerView: 5,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
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
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 4600,
                disableOnInteraction: false,
            },
        },
    }),

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

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
                    this.img_occasion = response.data.img_occasion;
                    this.img_recipient = response.data.img_recipient;
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
