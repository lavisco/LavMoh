<template>
    <div class="seller-onboard">
        <div class="container-fluid seller-hero px-0">
            <div class="seller-hero-img" v-bind:style="{ 'background-image': 'url(' + siteInfo.banner + ')' }"></div>
            <div class="seller-hero-box container">
                <h1 class="mb-4">
                    Join with us if you are a cake baker, fresh flower farmer, a gift hamper business or even a party supplier.
                </h1>
                <p>
                    <ul>
                        <li>We are building one of a kind marketplace for you to sell you products and services to customers in srilanka. Expose your business to expats living abroad and get access to unique tools built specifically for people like you to manage your customers.</li>
                        <li>Create your own store, manage your orders and access to many more tools to grow your business.</li>
                    </ul>
                </p>
                <div class="seller-join">
                    <p>JOIN as a SELLER</p>
                    <router-link to="/seller_register">
                        <button>Lets open my shop</button>
                    </router-link>
                </div>
            </div>
        </div>

        <section class="section-seller">
            <div class="container">
                <h1>Simple, transparent, convenient</h1>
                <div class="d-flex flex-md-row flex-column align-items-center justify-content-center section-seller-ribbon gap">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fas fa-check-double mr-2"></i>
                        No monthly fees
                    </div>
                    <div>
                        <i class="fas fa-check-double mr-2"></i>
                        No listing fees
                    </div>
                    <div>
                        <i class="fas fa-check-double mr-2"></i>
                        Weekly Payout
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center mb-5">
                        <img :src="siteInfo.icon_1" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">5-10 % Transaction fee + Bank online payment processing Fee</h4>
                            <p>No hidden fees. You only pay for lavisco if you sell through the platform. Depending on product category the commision rate will be 5-10% plus a flat 2.5% bank fee charged to process online payments.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center mb-5">
                        <img :src="siteInfo.icon_2" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Weekly payouts</h4>
                            <p>Lavisco will be processing weekly payouts to reimburse your earnings into your nominated bank accounts</p>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center">
                        <img :src="siteInfo.icon_3" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Delivery charges</h4>
                            <p>You can set your own delivery charge for your delivery. In future we will be joining forces with renowed delivery companies to bring special rates for you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-seller-1">
            <div class="container">
                <h1>Your Own Storefront</h1>
                <div class="d-flex flex-md-row flex-column align-items-center justify-content-center section-seller-ribbon gap">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fas fa-check-double mr-2"></i>
                        It's like having your own website
                    </div>
                    <div>
                        <i class="fas fa-check-double mr-2"></i>
                        List anything easily
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center mb-5">
                        <img :src="siteInfo.icon_4" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Manage Products</h4>
                            <p>List new products, edit product listings and setup product customization for your customers as your wish.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center mb-5">
                        <img :src="siteInfo.icon_5" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Manage Customers</h4>
                            <p>Talk in real time to customers and answer thier questions or help them select a gift to purchase through lavisco.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center">
                        <img :src="siteInfo.icon_6" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Manage Orders</h4>
                            <p>View your current orders, plan your future orders and many more features to help you manage your business more efficiently. We have automated your admin work so you can focus on accepting more orders and keep growing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-seller-2">
            <div class="container">
                <h1>Help when you need it</h1>
                <div class="d-flex flex-md-row flex-column align-items-center justify-content-center section-seller-ribbon gap">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fas fa-check-double mr-2"></i>
                        We help your customers too
                    </div>
                    <div>
                        <i class="fas fa-check-double mr-2"></i>
                        Fastest response
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center mb-5">
                        <img :src="siteInfo.icon_7" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Talk to us</h4>
                            <p>We are always willing to help you to scale your business up. Talk to us to improve lavisco or for any advice.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column align-items-md-start align-items-center">
                        <img :src="siteInfo.icon_8" class="section-seller-details-img" />
                        <div>
                            <h4 class="mb-3">Customer Support</h4>
                            <p>Lavisco customer care team are always ready to help customers. Our dedicated customer support team will help in order related inquires, delivery inquires and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-pale-grey">
            <div class="container">
                <h1 class="dark-purple">Seller Stories</h1>
                <div class="container">
                    <div class="d-flex flex-md-row flex-column align-items-top">
                        <img :src="siteInfo.review_1" class="mr-md-5 section-seller-stories-img mb-4 mb-md-0" />
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="2.5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 15 15"><g transform="rotate(180 7.5 7.5)"><path fill="#a29bc4" fill-rule="evenodd" d="M9.425 3.441c.631-.204 1.359-.2 1.954.105c1.374.706 1.969 2.526 1.416 4.454c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 8 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473a1.8 1.8 0 0 1-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679Zm-6 0c.631-.204 1.359-.2 1.954.105C6.753 4.252 7.348 6.072 6.795 8c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 2 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473c-.353.386-.814.61-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679Z" clip-rule="evenodd"/></g></svg>

                            <p class="my-3">
                            Its a great pleasure working with Lavisco. It had helped me increase my sales, given me opportunities to work on new structures and helped me expand my customer base too. Glad to say I'm finally able to deliver my products beyond Kandy city limits. It had been a good experience in many aspects.
                            </p>

                            <div class="text-right">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="2.5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 15 15"><path fill="#a29bc4" fill-rule="evenodd" d="M9.425 3.441c.631-.204 1.359-.2 1.954.105c1.374.706 1.969 2.526 1.416 4.454c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 8 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473a1.8 1.8 0 0 1-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679Zm-6 0c.631-.204 1.359-.2 1.954.105C6.753 4.252 7.348 6.072 6.795 8c-.248.865-.685 1.705-1.609 2.552c-.924.848-2.206 1.348-2.8 1.348A.38.38 0 0 1 2 11.525c0-.207.176-.375.386-.375c.679 0 1.286-.37 2.005-.914c.55-.417.98-.95 1.217-1.414c.455-.888.47-2.14-.265-2.473c-.353.386-.814.61-1.366.61c-1.2 0-1.907-.965-1.876-1.839c.029-.835.56-1.43 1.324-1.679Z" clip-rule="evenodd"/></svg>
                            </div>
                            

                            <h4 class="mt-4 text-right">By Rimaza Niyas</h4>
                            <h5 class="mt-2 text-right">Owner of Bake Lounge</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <h1>Ready to Start Selling?</h1>
                <div class="text-center">
                    <router-link to="/seller_register">
                        <button>Lets open my shop</button>
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data: () => ({
        siteInfo: [],
        keyValue: "seller_onboard_banner",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/sitetexts/seller_pictures")
                .then(({data}) => {
                    this.siteInfo = data;
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadData();
    },
};
</script>
