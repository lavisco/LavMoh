<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-5 mb-5">
            <div class="col">
                <div class="row d-flex justify-content-center gap">
                    <div class="card dashboard-card">
                        <h4 class="mb-3">
                            {{
                                buyerprofile.first_name +
                                " " +
                                buyerprofile.last_name
                            }}
                        </h4>
                        <p class="mb-2">{{ buyerprofile.phone }}</p>
                        <p class="mb-2">{{ buyerprofile.address }}</p>
                        <p class="mb-2">{{ buyerprofile.country }}</p>
                    </div>
                    <div class="card dashboard-card">
                        <h4 class="mb-3">Your Orders</h4>
                        <p class="mb-2">Orders placed this week</p>
                        <h2></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        buyerprofile: {},
    }),

    methods: {
        loadBuyerprofile() {
            axios
                .get("/api/buyer/buyerprofile")
                .then(({ data }) => {
                    this.buyerprofile = data;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadBuyerprofile();
    },
};
</script>
