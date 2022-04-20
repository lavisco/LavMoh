<template>
    <div class="container-fluid search-result">
        <section class="section-best-seller mt-5 mb-5">
            <div class="d-flex flex-wrap justify-content-center card-container">
                <div
                    v-for="product in resultsProduct"
                    :key="product.id"
                    class="product-list"
                >
                    <div class="card item-card-2">
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
                        <div class="px-3">
                            <div class="card-title-2">
                                <router-link
                                    class="card-title-2"
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
                            <div class="card-price">
                                {{ product.base_price }}
                            </div>
                            <div class="card-secondary-text">
                                {{ product.category.name }}
                            </div>
                            <div class="card-secondary-text">
                                Made by {{ product.user.shop.name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-for="shop in resultsShop"
                    :key="shop.id"
                    class="product-list"
                >
                    <div class="card item-card-2">
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
                                <router-link
                                    class="card-title-2"
                                    :to="{
                                        name: 'seller_shop',
                                        params: {
                                            shopId: shop.id,
                                        },
                                    }"
                                >
                                    {{ shop.name }}
                                </router-link>
                            </div>
                            <div class="card-secondary-text">
                                {{ shop.about }}
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-for="occasion in resultsOccasion"
                    :key="occasion.id"
                    class="product-list"
                >
                    <div class="card item-card-2">
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
                                <router-link
                                    class="card-title-2"
                                    :to="{
                                        name: 'occasions/occasion',
                                        params: {
                                            occasionId: occasion.id,
                                        },
                                    }"
                                >
                                    {{ occasion.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-for="recipient in resultsRecipient"
                    :key="recipient.id"
                    class="product-list"
                >
                    <div class="card item-card-2">
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
                                <router-link
                                    class="card-title-2"
                                    :to="{
                                        name: 'recipients/recipient',
                                        params: {
                                            recipientId: recipient.id,
                                        },
                                    }"
                                >
                                    {{ recipient.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-for="category in resultsCategory"
                    :key="category.id"
                    class="product-list"
                >
                    <div class="card item-card-2">
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
                                <router-link
                                    class="card-title-2"
                                    :to="{
                                        name: 'categories/category',
                                        params: {
                                            categoryId: category.id,
                                        },
                                    }"
                                >
                                    {{ category.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
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
};
</script>
