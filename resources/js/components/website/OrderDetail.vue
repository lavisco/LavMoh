<template>
    <div class="container-fluid shipping">
        <h1 class="text-left mb-4">Your order of Rs. {{ order.total }}</h1>
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="cart-items-card">
                    <h4 class="text-left header mb-0">
                        Order Summary of {{ order.code }}
                    </h4>
                    <div class="row-content">
                        <div class="row my-4">
                            <div class="col-6">
                                <h6>Total</h6>
                                <div>Rs. {{ order.total }}</div>
                                <a
                                    class="dashboard-link-sm mt-2"
                                    data-toggle="collapse"
                                    href="#collapsePrice"
                                    role="button"
                                >
                                    More
                                </a>
                                <div class="collapse mt-2" id="collapsePrice">
                                    <div class="my-2">
                                        Subtotal: Rs. {{ order.subtotal }}
                                    </div>
                                    <div class="my-2">
                                        Tax: Rs. {{ order.tax }}
                                    </div>
                                    <div class="my-2">
                                        Shipping: Rs.
                                        {{ order.shipping_price }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Date placed</h6>
                                <div>
                                    {{ order.created_at }}
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <h6>Store</h6>
                                <div class="d-flex flex-row align-items-center">
                                    <img
                                        class="cart-shop-banner mr-2"
                                        :src="
                                            order.shop.path
                                                ? order.shop.path
                                                : '/images/lavisco/img-bg.jpg'
                                        "
                                    />
                                    {{ order.shop.name }}
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <h6>Contact Details</h6>
                                <div>
                                    {{ order.first_name }}
                                    {{ order.last_name }} <br />
                                    {{ order.email }} <br />
                                    {{ order.phone }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <h6>Shipping Address</h6>
                                <div>
                                    {{ order.address_line_one }}
                                    {{ order.address_line_two }},
                                    {{ order.zipcode }}, {{ order.city }}
                                    <br />
                                    {{ order.district }}, {{ order.state }}
                                    <br />
                                    {{ order.country }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <h6>Shipping Option</h6>
                                <div>
                                    {{ order.shipping.type }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="cart-items-card">
                    <h4 class="text-left header mb-0">Order Items</h4>
                    <div class="row-content mt-4">
                        <div
                            class="row mb-4"
                            v-for="order_product in order.order_products"
                        >
                            <div class="col-md-8 d-flex flex-row">
                                <img
                                    class="banner-container-xs mr-3"
                                    :src="
                                        order_product.product.product_image.path
                                            ? order_product.product
                                                  .product_image.path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                />
                                <div>
                                    <h6 class="text-left">
                                        {{ order_product.product.title }}
                                    </h6>

                                    <div
                                        class="darkgrey text-xs"
                                        v-for="variation in order_product.order_product_variations"
                                    >
                                        {{ variation.variation_option.name }}
                                    </div>
                                </div>
                            </div>
                            <hr class="hide-content w-100" />
                            <div class="col-md-1 col-6">
                                {{ order_product.quantity }}
                            </div>
                            <div class="col-md-3 col-6">
                                <h6 class="text-right mb-1">
                                    Rs. {{ order_product.total }}
                                </h6>
                                <div class="darkgrey text-xs text-right">
                                    each Rs.
                                    {{
                                        order_product.total /
                                        order_product.quantity
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4
                        class="
                            bottom
                            d-flex
                            flex-row
                            justify-content-between
                            mb-0
                        "
                    >
                        <span class="darkgrey"> Total </span>
                        Rs. {{ order.total }}
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        order: [],
        loading: true,
    }),

    methods: {
        loadData() {
            axios
                .get("/api/orders/" + this.$route.params.orderCode)
                .then(({ data }) => {
                    this.order = data;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadData();
    },
};
</script>
