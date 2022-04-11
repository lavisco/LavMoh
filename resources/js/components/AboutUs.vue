<template>
        <div class="seller-onboard">
        <div class="container-fluid seller-hero px-0">
            <div class="seller-hero-img" v-bind:style="{ 'background-image': 'url(' + siteInfo.banner + ')' }"></div>
            <div class="seller-hero-box container">
                <h1 class="mb-4">
                    Lavisco.lk, the online marketplace to buy & sell cakes, unique gifts and more
                </h1>
                <p>
                    <ul>
                        <li>We are building one of a kind marketplace for entrepreneurs to sell their products and services to customers in Srilanka.</li>
                        <li>Enabling sellers to expose their business to expats living abroad and get access to unique tools built specifically to manage orders & customers.</li>
                    </ul>
                </p>
                <div class="seller-join">
                    <p>Browse Products</p>
                    <router-link to="/products">
                        <button>View Products</button>
                    </router-link>
                </div>
            </div>
        </div>

        <section class="bg-pale-grey">
            <div class="container">
                <h1 class="dark-purple">Our story</h1>
                <div class="container">
                    <div class="d-flex flex-md-row flex-column align-items-top">
                        <img src="" class="mr-md-5 section-seller-stories-img mb-4 mb-md-0" />
                        <div>
                            <p>
                                Our story goes back to 2018 when we started offering customized product services to schools and corporate clients. We had 0 employees nor any office. The whole operation was done using just one mobile phone and a computer. But slowly we bootstrapped the company and kept growing until in 2019 we bought a printer and a mug printing machine and started offering mug printing services through Facebook and Instagram. In the same year we also opened out first office in Kandy, Sri Lanka.  A mere 320 Sq space which also doubled up as our manufacturing facility. At this point our we had increased our product offerings from 1 product to 50+ products ranging from personal care to high end gift items.
                            </p>
                            <p>
                                When Covid hit in 2020 we knew early on that we needed to pivot. Because up until this point our customers were schools, colleges and corporate companies. After covid, most of these companies were closed and social gatherings were restricted thus, like many other companies we were out of business almost overnight. But, luckily at this point we were already drafting a new business model to expand Lavisco beyond our spectrum of services. 
                            </p>
                            <p>
                                So, we went straight back to work to build our very own eCommerce platform with our very own tech. We did our testing, took customers reviews, criticism, suggestions and trialed our processes for 6 months in 2020 amid all the lock-downs. 
                            </p>
                            <p>
                                Through this trialing process we learned a lot. But most importantly we learnt the importance of helping small entrepreneurs, mumtrepreneurs and a lot of people who were laid off during Covid the chance to monetize their talents and take up their passion into a real paying job. Out of the many groups we identified the group that had most impact and had the least opportunities were home based bakers. There was a real gap in the market to build a eCommerce platform that worked in local areas rather than nationally.
                            </p>
                            <p>
                                At the end of the day, today we have successfully launched <a href="https://lavisco.lk">lavisco.lk</a>, our very own eCommerce platform which allows anyone to sell their hand made products, bakes,clothing , collectibles and all types of gift items to customers locally, nationally and even internationally. We believe this will change the way we buy online and have a real social impact on small entrepreneurs. 
                            </p>
                            <p>Looking back as a company we've come a long way and we promise to deliver and build a socially responsible and sustainable company going forward.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <h1>Ready to Start Selling?</h1>
                <div class="text-center">
                    <router-link to="/seller_onboard">
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
    }),

    methods: {
        loadData() {
            axios
                .get("/api/sitetexts/about_pictures")
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
