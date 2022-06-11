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
                        <h1 class="text-left mb-4">Gift Box Builder</h1>
                        <h5 class="text-left mb-5">
                            Select from your favourite Lavisco items to create
                            your perfect box. 100% fresh, delicious, and perfect
                            for every occasion.
                        </h5>
                        <div
                            class="
                                d-flex
                                flex-wrap
                                justify-content-center
                                card-container
                                product-list
                            "
                        >
                            <div class="item-card-2">
                                <div class="card-img card-img-2">
                                    <img src="/images/lavisco/img-bg.jpg" />
                                </div>
                                <div
                                    class="
                                        px-2 px-md-3
                                        pb-3
                                        d-flex
                                        flex-column
                                        align-items-center
                                    "
                                >
                                    <div class="card-title-2 text-center">
                                        Vegan Caramel Biscuit Cupcake
                                    </div>
                                    <div class="card-price">Rs 240</div>
                                    <div class="product-card-counter mt-2">
                                        <div class="counter-minus">-</div>
                                        <div class="counter-num">2</div>
                                        <div class="counter-plus">+</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-card-2">
                                <div class="card-img card-img-2">
                                    <img src="/images/lavisco/img-bg.jpg" />
                                </div>
                                <div
                                    class="
                                        px-2 px-md-3
                                        pb-3
                                        d-flex
                                        flex-column
                                        align-items-center
                                    "
                                >
                                    <div class="card-title-2 text-center">
                                        Gluten Free Red Velvet Regular
                                    </div>
                                    <div class="card-price">Rs 360</div>
                                    <div class="product-card-counter mt-2">
                                        <div class="counter-minus">-</div>
                                        <div class="counter-num">2</div>
                                        <div class="counter-plus">+</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-card-2">
                                <div class="card-img card-img-2">
                                    <img src="/images/lavisco/img-bg.jpg" />
                                </div>
                                <div
                                    class="
                                        px-2 px-md-3
                                        pb-3
                                        d-flex
                                        flex-column
                                        align-items-center
                                    "
                                >
                                    <div class="card-title-2 text-center">
                                        Mini choco pie
                                    </div>
                                    <div class="card-price">Rs 180</div>
                                    <div class="product-card-counter mt-2">
                                        <div class="counter-minus">-</div>
                                        <div class="counter-num">2</div>
                                        <div class="counter-plus">+</div>
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
                            John's Bday Cupcake Box
                        </h3>
                    </div>
                    <h6 class="mb-1">John's Bakery</h6>

                    <!-- price -->
                    <div class="mt-3">
                        <h3 class="price">LKR 20000</h3>
                    </div>

                    <!-- short description -->
                    <div class="mt-4">
                        <h6>About this item</h6>
                        <p class="mb-0">
                            Select from your cupcake favourite flavours to
                            create your perfect box. 100% fresh, delicious, and
                            perfect for every occasion.
                        </p>
                    </div>

                    <!-- choices -->
                    <div class="mt-4">
                        <h6>Your choices</h6>
                        <div class="giftbox-product-card-sm">
                            <div class="giftbox-product-card-body">
                                <img src="/images/lavisco/img-bg.jpg" />
                                <div class="card-title-2">
                                    Vegan Caramel Biscuit Cupcake
                                </div>
                            </div>
                            <div class="product-card-counter">
                                <div class="counter-minus">-</div>
                                <div class="counter-num">2</div>
                                <div class="counter-plus">+</div>
                            </div>
                        </div>
                        <div class="giftbox-product-card-sm mt-2">
                            <div class="giftbox-product-card-body">
                                <img src="/images/lavisco/img-bg.jpg" />
                                <div class="card-title-2">
                                    Gluten Free Red Velvet Regular
                                </div>
                            </div>
                            <div class="product-card-counter">
                                <div class="counter-minus">-</div>
                                <div class="counter-num">2</div>
                                <div class="counter-plus">+</div>
                            </div>
                        </div>
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
                                @click.prevent="addProductToCart()"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        submitButtonText: "Submit Request",
        submitButtonDisabled: false,
        loading: false,
        form: new Form({
            id: "",
        }),
    }),

    methods: {
        displayInfoBox(name) {
            if (document.getElementById(name).style.display == "inline-block") {
                document.getElementById(name).style.display = "none";
            } else {
                document.getElementById(name).style.display = "inline-block";
            }
        },
        addProductToCart() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;
            this.form
                .post("/api/seller/custom_product")
                .then(() => {
                    this.submitButtonText = "Submitted";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                })
                .catch((error) => {
                    this.submitButtonText = "Submit Request";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },
    },

    mounted() {},
};
</script>
