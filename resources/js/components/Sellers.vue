<template>
    <div class="container-fluid">
        <div class="hero">
            <h1 class="title text-center">Browse All Sellers</h1>
            <h1 class="sub-title mb-5 text-center">
                From cakes to bags, our Sellers offer everything you are looking
                for!
            </h1>
        </div>

        <section class="section-best-seller mb-5">
            <div class="d-flex card-container">
                <div class="card seller-card d-flex" v-for="seller in sellerprofiles">
                    <div class="d-flex">
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="product-seller-img mr-md-4"
                            alt=""
                        />
                        <div>
                            <h3 class="text-left">{{ seller.shop.name }}</h3>
                            <h6>is selling Cakes</h6>
                            <p>
                                {{ seller.shop.description }}
                            </p>
                        </div>
                        <a href="">
                            <svg
                                width="34"
                                height="34"
                                viewBox="0 0 45 45"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M5.625 22.5C5.625 25.6012 8.14875 28.125 11.25 28.125C12.7387 28.125 14.085 27.5344 15.0919 26.5875L26.325 33.0075C26.2913 33.2512 26.25 33.495 26.25 33.75C26.25 36.8512 28.7738 39.375 31.875 39.375C34.9762 39.375 37.5 36.8512 37.5 33.75C37.5 30.6488 34.9762 28.125 31.875 28.125C30.3862 28.125 29.04 28.7156 28.0331 29.6625L16.8 23.2444C16.8337 22.9988 16.875 22.755 16.875 22.5C16.875 22.245 16.8337 22.0012 16.8 21.7556L28.0331 15.3375C29.04 16.2844 30.3862 16.875 31.875 16.875C34.9762 16.875 37.5 14.3512 37.5 11.25C37.5 8.14875 34.9762 5.625 31.875 5.625C28.7738 5.625 26.25 8.14875 26.25 11.25C26.25 11.505 26.2913 11.7487 26.325 11.9944L15.0919 18.4125C14.055 17.4275 12.6801 16.8773 11.25 16.875C8.14875 16.875 5.625 19.3988 5.625 22.5Z"
                                    fill="black"
                                />
                            </svg>
                        </a>
                    </div>
                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                        "
                    >
                        <h6>Top selling products</h6>
                        <div class="d-flex align-items-center">
                            <div class="rating mr-2 mb-3">
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="22"
                                    viewBox="0 0 24 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 0L14.6942 8.2918H23.4127L16.3593 13.4164L19.0534 21.7082L12 16.5836L4.94658 21.7082L7.64074 13.4164L0.587322 8.2918H9.30583L12 0Z"
                                        fill="#C4C4C4"
                                    />
                                </svg>
                            </div>
                            <h6>4.2 from ### orders</h6>
                        </div>
                    </div>
                    <div class="d-flex gap align-items-center">
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="topseller-product-img mr-md-4"
                            alt=""
                        />
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="topseller-product-img mr-md-4"
                            alt=""
                        />
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="topseller-product-img mr-md-4"
                            alt=""
                        />
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="topseller-product-img mr-md-4"
                            alt=""
                        />
                        <img
                            src="/images/lavisco/img-bg.jpg"
                            class="topseller-product-img mr-md-4"
                            alt=""
                        />
                    </div>
                    <button
                        class="checkout-btn btn-full checkout-btn-cart mt-2"
                    >
                        View Seller
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <router-link
                    class="view-more-link"
                    //  to="{
                    //     name: 'sellerprofiles/seller',
                    //     params: {
                    //         sellerId: seller.id,
                    //     },
                    // }"
                >
                    View More
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
                            fill="black"
                        />
                    </svg>
                </router-link>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data: () => ({
        sellerprofiles: [],
        searchText: null,
    }),

    watch: {
        searchText(after, before) {
            this.loadSellerProfiles();
        },
    },

    methods: {
        loadSellerProfiles() {
            axios
                .get("/api/sellerprofiles")
                .then(({ data }) => (this.sellerprofiles = data.data))
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadSellerProfiles();
        Fire.$on("reloadRecords", () => {
            this.loadSellerProfiles();
        });
    },
};
</script>
