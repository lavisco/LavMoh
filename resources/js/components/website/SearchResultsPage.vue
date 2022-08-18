<template>
    <div class="container-fluid search-result">
        <div class="sort-section">
            <select
                class="custom-select form-control form-control-alternative"
                id="filter"
                name="filter"
                @change.prevent="setResult($event)"
            >
                <option value="" disabled selected hidden>Filter</option>
                <option value="all">All</option>
                <option value="products">Products</option>
                <option value="shops">Shops</option>
                <option value="categories">Categories</option>
                <option value="occasions">Occasions</option>
                <option value="recipients">Recipients</option>
            </select>
        </div>
        <section class="section-best-seller mt-4 mb-5">
            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-center
                    card-container
                    product-list
                "
            >
                <router-link
                    v-show="resultsProductMode"
                    v-for="product in resultsProduct"
                    :key="`p${product.id}`"
                    class="card item-card-2"
                    :to="{
                        name: 'products/product',
                        params: {
                            productId: product.id,
                            slug: product.slug,
                        },
                    }"
                >
                    <div class="card-tag bg-l-blue">Product</div>
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                product.product_image
                                    ? product.product_image.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                            :alt="product.title"
                        />
                    </div>
                    <div class="px-md-3">
                        <div class="card-price">
                            {{ currency.symbol }}
                            {{ product.base_price * currency.exchange_rate }}
                            <span v-show="product.has_variations == 1">+</span>
                        </div>
                        <div class="card-title-2">
                            {{ product.title }}
                        </div>
                        <div class="card-secondary-text">
                            {{
                                product.user.shop ? product.user.shop.name : ""
                            }}
                        </div>
                    </div>
                </router-link>
                <router-link
                    v-show="resultsShopMode"
                    v-for="shop in resultsShop"
                    :key="`s${shop.id}`"
                    class="card item-card-2"
                    :to="{
                        name: 'shop',
                        params: {
                            shopId: shop.id,
                            slug: shop.slug,
                        },
                    }"
                >
                    <div class="card-tag bg-orange">Store</div>
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                shop.path
                                    ? shop.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                            :alt="shop.name"
                        />
                    </div>
                    <div class="px-3">
                        <div class="card-title-2">
                            {{ shop.name }}
                        </div>
                        <div class="card-secondary-text">
                            {{ shop.about }}
                        </div>
                    </div>
                </router-link>
                <router-link
                    v-show="resultsOccasionMode"
                    v-for="occasion in resultsOccasion"
                    :key="`o${occasion.id}`"
                    class="card item-card-2"
                    :to="{
                        name: 'occasions/occasion',
                        params: {
                            occasionId: occasion.id,
                            slug: occasion.slug,
                        },
                    }"
                >
                    <div class="card-tag bg-orange">Occasion</div>
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                occasion.path
                                    ? occasion.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                            :alt="occasion.name"
                        />
                    </div>
                    <div class="px-3">
                        <div class="card-title-2">
                            {{ occasion.name }}
                        </div>
                    </div>
                </router-link>
                <router-link
                    v-show="resultsRecipientMode"
                    v-for="recipient in resultsRecipient"
                    :key="`r${recipient.id}`"
                    class="card item-card-2"
                    :to="{
                        name: 'recipients/recipient',
                        params: {
                            recipientId: recipient.id,
                            slug: recipient.slug,
                        },
                    }"
                >
                    <div class="card-tag bg-green">Recipient</div>
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                recipient.path
                                    ? recipient.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                            :alt="recipient.name"
                        />
                    </div>
                    <div class="px-3">
                        <div class="card-title-2">
                            {{ recipient.name }}
                        </div>
                    </div>
                </router-link>
                <router-link
                    v-show="resultsCategoryMode"
                    v-for="category in resultsCategory"
                    :key="`c${category.id}`"
                    class="card item-card-2"
                    :to="{
                        name: 'categories/category',
                        params: {
                            categoryId: category.id,
                            slug: category.slug,
                        },
                    }"
                >
                    <div class="card-tag bg-pink">Category</div>
                    <div class="card-img card-img-2">
                        <img
                            :src="
                                category.path
                                    ? category.path
                                    : '/images/lavisco/img-bg.jpg'
                            "
                            :alt="category.name"
                        />
                    </div>
                    <div class="px-3">
                        <div class="card-title-2">
                            {{ category.name }}
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="" class="view-more-link">View More</a>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: [
        "resultsProduct",
        "resultsOccasion",
        "resultsRecipient",
        "resultsCategory",
        "resultsShop",
    ],

    data: () => ({
        resultsProductMode: true,
        resultsOccasionMode: true,
        resultsRecipientMode: true,
        resultsCategoryMode: true,
        resultsShopMode: true,
    }),

    computed: {
        currency() {
            return this.$store.getters.selectedCurrency;
        },
    },

    methods: {
        setResult(event) {
            this.resultsProductMode = false;
            this.resultsOccasionMode = false;
            this.resultsRecipientMode = false;
            this.resultsCategoryMode = false;
            this.resultsShopMode = false;

            switch (event.target.value) {
                case "all":
                    this.resultsProductMode = true;
                    this.resultsShopMode = true;
                    this.resultsCategoryMode = true;
                    this.resultsOccasionMode = true;
                    this.resultsRecipientMode = true;
                    break;
                case "products":
                    this.resultsProductMode = true;
                    break;
                case "shops":
                    this.resultsShopMode = true;
                    break;
                case "categories":
                    this.resultsCategoryMode = true;
                    break;
                case "occasions":
                    this.resultsOccasionMode = true;
                    break;
                case "recipients":
                    this.resultsRecipientMode = true;
                    break;
            }
        },

        fetchResults() {
            axios
                .get("/api/searchIndex/" + this.$route.params.searchText)
                .then((response) => {
                    this.resultsProduct = response.data.products;
                    this.resultsOccasion = response.data.occasions;
                    this.resultsRecipient = response.data.recipients;
                    this.resultsCategory = response.data.categories;
                    this.resultsShop = response.data.shops;
                })
                .catch((error) => console.log(error));
        },
    },

    async created() {
        // first check if prop exist
        //if (this.post) return (this.form = this.post);

        //check the parameter ?searchText exist
        if (this.$route.params.searchText) return this.fetchResults();
    },
};
</script>
