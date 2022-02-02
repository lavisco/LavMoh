<template>
    <div>
        <div class="header bg-primary pb-8 pt-4">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5
                                                class="
                                                    card-title
                                                    text-uppercase text-muted
                                                    mb-0
                                                "
                                            >
                                                Traffic
                                            </h5>
                                            <span
                                                class="h2 font-weight-bold mb-0"
                                                >{{ analytics.visitors }}</span
                                            >
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="
                                                    icon icon-shape
                                                    bg-danger
                                                    text-white
                                                    rounded-circle
                                                    shadow
                                                "
                                            >
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2"
                                            ><i class="fa fa-arrow-up"></i>
                                            3.48%</span
                                        >
                                        <span class="text-nowrap"
                                            >Since last month</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5
                                                class="
                                                    card-title
                                                    text-uppercase text-muted
                                                    mb-0
                                                "
                                            >
                                                Most Visited Page
                                            </h5>
                                            <span
                                                class="h2 font-weight-bold mb-0"
                                                >{{
                                                    analytics.mostVisitedPages
                                                }}</span
                                            >
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="
                                                    icon icon-shape
                                                    bg-warning
                                                    text-white
                                                    rounded-circle
                                                    shadow
                                                "
                                            >
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2"
                                            ><i class="fas fa-arrow-down"></i>
                                            3.48%</span
                                        >
                                        <span class="text-nowrap"
                                            >Since last week</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5
                                                class="
                                                    card-title
                                                    text-uppercase text-muted
                                                    mb-0
                                                "
                                            >
                                                Monthly Visitors
                                            </h5>
                                            <span
                                                class="h2 font-weight-bold mb-0"
                                                >{{
                                                    analytics.visitorsMonthly
                                                }}</span
                                            >
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="
                                                    icon icon-shape
                                                    bg-yellow
                                                    text-white
                                                    rounded-circle
                                                    shadow
                                                "
                                            >
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-warning mr-2"
                                            ><i class="fas fa-arrow-down"></i>
                                            1.10%</span
                                        >
                                        <span class="text-nowrap"
                                            >Since yesterday</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5
                                                class="
                                                    card-title
                                                    text-uppercase text-muted
                                                    mb-0
                                                "
                                            >
                                                User Types
                                            </h5>
                                            <span
                                                class="h2 font-weight-bold mb-0"
                                                >{{ analytics.userType }}</span
                                            >
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="
                                                    icon icon-shape
                                                    bg-info
                                                    text-white
                                                    rounded-circle
                                                    shadow
                                                "
                                            >
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2"
                                            ><i class="fas fa-arrow-up"></i>
                                            12%</span
                                        >
                                        <span class="text-nowrap"
                                            >Since last month</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7 mb-5">
            <div class="row"></div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        analytics: "",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/admin/analytics")
                .then(({ data }) => {
                    this.analytics = data;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
