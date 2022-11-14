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
                            location: locationActive,
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
                    <div class="card-body">
                        <div class="card-title">
                            {{ product.title }}
                        </div>
                        <div
                            class="
                                d-flex
                                flex-row
                                justify-content-between
                                align-items-end
                            "
                        >
                            <div class="card-body-text">
                                <div class="card-price mb-md-1">
                                    {{ currency.symbol }}
                                    {{
                                        product.base_price *
                                        currency.exchange_rate
                                    }}
                                    <span v-show="product.has_variations == 1">
                                        +
                                    </span>
                                </div>
                                <div class="card-secondary-text">
                                    {{
                                        product.user.shop
                                            ? product.user.shop.name
                                            : ""
                                    }}
                                </div>
                            </div>
                            <button class="bag-sm" type="button" name="add to cart">
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
                            location: locationActive,
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
                            location: locationActive,
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
                            location: locationActive,
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
                            location: locationActive,
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
        locationActive() {
            return this.$store.getters.selectedLocation;
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
