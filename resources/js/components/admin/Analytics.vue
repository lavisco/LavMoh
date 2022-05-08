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
            <div class="row">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6
                                        class="
                                            text-uppercase text-light
                                            ls-1
                                            mb-1
                                        "
                                    >
                                        Overview
                                    </h6>
                                    <h2 class="text-white mb-0">
                                        Monthly Visitors
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="
                                        table
                                        align-items-center
                                        table-dark table-flush
                                    "
                                >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Page Title</th>
                                            <th scope="col">Visitors</th>
                                            <th scope="col">Page Views</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr
                                            v-for="visitor in analytics.visitorsMonthly"
                                        >
                                            <th scope="row">
                                                {{ visitor.pageTitle }}
                                            </th>
                                            <td>{{ visitor.visitors }}</td>
                                            <td>{{ visitor.pageViews }}</td>
                                            <td>{{ visitor.date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
