<template>
    <div>
        <div class="container-fluid">
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
                                <button class="btn-sm-black">
                                    {{ homeslider.link_text }}
                                </button>
                            </router-link>
                        </div>
                    </swiper-slide>
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
                <!-- Swiper end -->
            </div>
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
                                    location: locationActive,
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
                                <div class="card-body-text">
                                    <div class="card-title">
                                        {{ product.title }}
                                    </div>
                                    <div class="card-price">
                                        {{ currency.symbol }}
                                        {{
                                            product.base_price *
                                            currency.exchange_rate
                                        }}
                                        <span
                                            v-show="product.has_variations == 1"
                                        >
                                            +
                                        </span>
                                    </div>
                                </div>
                                <button class="bag-sm" type="button">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="29"
                                        height="29"
                                        preserveAspectRatio="xMidYMid meet"
                                        viewBox="0 0 1024 1024"
                                    >
                                        <path
                                            fill="white"
                                            d="M832 312H696v-16c0-101.6-82.4-184-184-184s-184 82.4-184 184v16H192c-17.7 0-32 14.3-32 32v536c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V344c0-17.7-14.3-32-32-32zm-432-16c0-61.9 50.1-112 112-112s112 50.1 112 112v16H400v-16zm392 544H232V384h96v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h224v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h96v456z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </router-link>
                    </swiper-slide>
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

            <section
                class="section-occasion-recipient"
                v-bind:style="{
                    'background-image': 'url(' + img_occasion + ')',
                }"
            >
                <div class="col-md-6 px-0 d-flex flex-column">
                    <h1>Gifts and Crafts for any Occasion</h1>
                    <h5 class="mb-4 mb-md-5">
                        Our collection contains a wide array of gifts suitable
                        for any major occasion.
                    </h5>
                    <div class="card-button-container" v-if="occasions[0]">
                        <a
                            href=""
                            v-for="occasion in occasions"
                            :key="occasion.id"
                        >
                            <router-link
                                :to="{
                                    name: 'occasions/occasion',
                                    params: {
                                        occasionId: occasion.id,
                                        slug: occasion.slug,
                                        location: locationActive,
                                    },
                                }"
                            >
                                <button>
                                    {{ occasion.name }}
                                </button>
                            </router-link>
                        </a>
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-end align-self-end">
                    <router-link class="view-more-link" to="/occasions">
                        <button class="btn-sm-black">Browse All</button>
                    </router-link>
                </div>
            </section>

            <section
                class="section-occasion-recipient bg-purple"
                v-bind:style="{
                    'background-image': 'url(' + img_recipient + ')',
                }"
            >
                <div class="col-md-6 px-0 d-flex flex-column">
                    <h1>Gifts for any Recipient</h1>
                    <h5 class="mb-4 mb-md-5">
                        You’ll surely find a gift on Lavisco that’s perfect for
                        your friend, family or anyone else.
                    </h5>
                    <div class="card-button-container" v-if="recipients[0]">
                        <router-link
                            v-for="recipient in recipients"
                            :key="recipient.id"
                            :to="{
                                name: 'recipients/recipient',
                                params: {
                                    recipientId: recipient.id,
                                    slug: recipient.slug,
                                    location: locationActive,
                                },
                            }"
                        >
                            <button>
                                {{ recipient.name }}
                            </button>
                        </router-link>
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-end align-self-end">
                    <router-link class="view-more-link" to="/recipients">
                        <button class="btn-sm-black">Browse All</button>
                    </router-link>
                </div>
            </section>

            <section class="section-category">
                <h1>Find the perfect gift for your Loved ones</h1>
                <div class="row flex-wrap">
                    <div
                        class="col-md-3 pb-4"
                        v-for="(category, index) in categories"
                        :key="category.id"
                    >
                        <router-link
                            :to="{
                                name: 'categories/category',
                                params: {
                                    categoryId: category.id,
                                    slug: category.slug,
                                    location: locationActive,
                                },
                            }"
                            class="gallery-item"
                        >
                            <img
                                :src="category.path ? category.path : ''"
                                class="gallery-img"
                                alt="Image 1"
                            />
                            <h3 class="white">
                                {{ category.name }}
                            </h3>
                            <div class="w-100 d-flex justify-content-end">
                                <button class="btn-sm-black">Browse</button>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div
                    class="
                        mt-4
                        d-flex
                        align-items-center
                        justify-content-center
                    "
                >
                    <router-link class="view-more-link" to="/categories">
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
            </section>

            <section
                class="
                    section-occasion-recipient section-instruction
                    align-items-start
                "
                v-bind:style="{
                    'background-image': 'url(' + img_instruction + ')',
                }"
            >
                <div class="col-md-5 px-0 d-flex flex-column">
                    <h1>How Lavisco Works</h1>
                    <h5 class="mb-4 mb-md-5">As easy as 1, 2, 3.</h5>
                </div>
                <div class="col-md-7 px-0 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="instruction-num">1</div>
                        <h4>
                            Browse through our wide range of products for any
                            occasion and pick your choice.
                        </h4>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="instruction-num">2</div>
                        <h4>
                            Get creative and add a personal touch to your
                            products by choosing custom options.
                        </h4>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="instruction-num">3</div>
                        <h4>
                            Choose from one of the many easy payment options &
                            finalize your order!
                        </h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="instruction-num">
                            <svg
                                width="37"
                                height="38"
                                viewBox="0 0 37 38"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_678_1405)">
                                    <path
                                        d="M34.0794 1.7165C33.4273 1.3536 32.7099 1.12282 31.9685 1.03736C31.2271 0.95189 30.4761 1.01342 29.7584 1.21842C29.0408 1.42342 28.3706 1.76787 27.7862 2.23208C27.2018 2.69629 26.7146 3.27114 26.3526 3.92378L15.8048 22.9057L9.76818 16.8691C9.24408 16.3265 8.61716 15.8937 7.92399 15.5959C7.23082 15.2981 6.48529 15.1414 5.7309 15.1348C4.97651 15.1283 4.22837 15.272 3.53013 15.5577C2.83189 15.8434 2.19754 16.2653 1.66409 16.7987C1.13063 17.3322 0.708763 17.9665 0.423091 18.6647C0.137419 19.363 -0.00633329 20.1111 0.000222145 20.8655C0.00677758 21.6199 0.16351 22.3654 0.461273 23.0586C0.759036 23.7518 1.19187 24.3787 1.73451 24.9028L13.0976 36.2659C14.1714 37.3425 15.6202 37.9334 17.1144 37.9334L17.9013 37.8766C18.7721 37.7547 19.6028 37.4325 20.3279 36.9351C21.053 36.4377 21.6528 35.7788 22.08 35.0102L36.2839 9.44338C36.6465 8.79128 36.8771 8.07415 36.9626 7.33292C37.0481 6.59169 36.9867 5.84088 36.782 5.12336C36.5773 4.40585 36.2333 3.73568 35.7696 3.15113C35.3059 2.56658 34.7315 2.07909 34.0794 1.7165Z"
                                        fill="white"
                                        fill-opacity="0.5"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_678_1405">
                                        <rect
                                            width="37"
                                            height="37"
                                            fill="white"
                                            transform="translate(0 0.5)"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <h4>
                            Sit back & relax! We will deliver your order right
                            to your door step with no hassle.
                        </h4>
                    </div>
                </div>
            </section>

            <section class="section-shortcuts">
                <div class="shortcut-card">
                    <h1>Become a Seller on Lavisco</h1>
                    <h5 class="mb-4">
                        Join a one of a kind marketplace and get an edge over
                        your competitors.
                    </h5>
                    <router-link to="/sell_on_lavisco">
                        <button class="btn-sm-black">Become a Seller</button>
                    </router-link>
                </div>

                <div class="shortcut-card">
                    <h1>Start buying today</h1>
                    <h5 class="mb-4">
                        Sign up with Lavisco as a buyer to unlock exclusive
                        drops and discounts!
                    </h5>
                    <a href="/register">
                        <button class="btn-sm-black">Sign up</button>
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
        img_instruction: "",
        swiperOption: {
            slidesPerView: 5,
            spaceBetween: 20,
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
            autoplay: {
                delay: 4600,
                disableOnInteraction: false,
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
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 2,
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
        locationActive() {
            return this.$store.getters.selectedLocation;
        },
    },

    watch: {
        locationActive(after, before) {
            Fire.$emit("reloadRecords");
        },
    },

    methods: {
        loadData() {
            axios
                .get("/api/home", {
                    params: { location: this.locationActive },
                })
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
                    this.img_instruction = response.data.img_instruction;
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
