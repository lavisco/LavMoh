<template>
    <div class="container my-5">
        <div class="col">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="pink text-left mb-4">Main Links</h3>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/seller_onboard">Sell on Lavisco</a></li>
                        <li><a href="/products">All products</a></li>
                        <li><a href="/categories">Browse by Nature</a></li>
                        <li><a href="/recipients">Browse by Recipient</a></li>
                        <li><a href="/occasions">Browse by Occasion</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="pink text-left mb-4">Sub Links</h3>
                    <h4><a class="grey mb-3" href="/categories">Browse by Nature</a></h4>
                    <ul>
                        <li v-for="category in categories" :key="category.id">
                            <router-link
                                :to="{
                                    name: 'categories/category',
                                    params: {
                                        categoryId: category.id,
                                    },
                                }"
                            >
                                {{ category.name }}
                            </router-link>
                        </li>
                    </ul>
                    <h4>
                        <a class="grey mb-3" href="/recipients"> Browse by Recipient</a>
                    </h4>
                    <ul>
                        <li v-for="recipient in recipients" :key="recipient.id">
                            <router-link
                                :to="{
                                    name: 'recipients/recipient',
                                    params: {
                                        recipientId: recipient.id,
                                    },
                                }"
                            >
                                {{ recipient.name }}
                            </router-link>
                        </li>
                    </ul>
                    <h4>
                        <a class="grey mb-3" href="/occasions">Browse by Occasion</a>
                    </h4>
                    <ul>
                        <li v-for="occasion in occasions" :key="occasion.id">
                            <router-link
                                :to="{
                                    name: 'occasions/occasion',
                                    params: {
                                        occasionId: occasion.id,
                                    },
                                }"
                            >
                                {{ occasion.name }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="pink text-left mb-4">Footer Links</h3>
                    <ul>
                        <li><a href="/seller_all"> Partner Vendors </a></li>
                        <li>
                            <a href="/terms_and_conditions">
                                Terms & Conditions
                            </a>
                        </li>
                        <li><a href="/privacy_policy">Privacy</a></li>
                        <li><a href="/delivery_policy"> Delivery </a></li>
                        <li><a href="/cookie_policy">Cookie</a></li>
                        <li><a href="/payment_policy">Payment</a></li>
                        <li>
                            <a href="/returns_refunds_policy">
                                Return & Refunds
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        recipients: [],
        categories: [],
        occasions: [],
    }),

    methods: {
        loadData() {
            axios
                .get("/api/home")
                .then((response) => {
                    this.recipients = response.data.recipients;
                    this.categories = response.data.categories;
                    this.occasions = response.data.occasions;
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
