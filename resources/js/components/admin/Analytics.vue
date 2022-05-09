<template>
    <div>
        <div class="container-fluid mt-5 mb-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="text-white mb-0">
                                        Seller Statistics
                                    </h2>
                                </div>
                            </div>
                        </div>
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
                                        <th scope="col">User name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Total products</th>
                                        <th scope="col">Registered at</th>
                                        <th scope="col">Profile created</th>
                                        <th scope="col">Shop created</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr v-for="seller in analytics.sellers">
                                        <th scope="row">
                                            {{ seller.name }}
                                        </th>
                                        <td>{{ seller.email }}</td>
                                        <td>{{ seller.products_count }}</td>
                                        <td>
                                            {{
                                                moment(
                                                    seller.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                seller.seller_profile
                                                    ? moment(
                                                          seller.seller_profile
                                                              .created_at
                                                      ).format("DD-MM-YYYY")
                                                    : "not created"
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                seller.shop
                                                    ? moment(
                                                          seller.shop.created_at
                                                      ).format("DD-MM-YYYY")
                                                    : "not created"
                                            }}
                                        </td>
                                        <td class="text-right">
                                            <a
                                                class="
                                                    btn btn-sm btn-icon-only
                                                    text-primary
                                                "
                                                href="#"
                                                @click.prevent="
                                                    viewModal(seller)
                                                "
                                            >
                                                <i
                                                    class="fas fa-ellipsis-v"
                                                ></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="mb-0">Buyer Statistics</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">User name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registered at</th>
                                        <th scope="col">
                                            Latest account update
                                        </th>
                                        <th scope="col">Profile created</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr v-for="buyer in analytics.buyers">
                                        <th scope="row">
                                            {{ buyer.name }}
                                        </th>
                                        <td>{{ buyer.email }}</td>
                                        <td>
                                            {{
                                                moment(buyer.created_at).format(
                                                    "DD-MM-YYYY"
                                                )
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                moment(buyer.updated_at).format(
                                                    "DD-MM-YYYY"
                                                )
                                            }}
                                        </td>
                                        <td>
                                            {{
                                                buyer.buyer_profile
                                                    ? moment(
                                                          buyer.buyer_profile
                                                              .created_at
                                                      ).format("DD-MM-YYYY")
                                                    : "not created"
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="text-white mb-0">
                                        Monthly Visitors
                                    </h2>
                                </div>
                            </div>
                        </div>
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
        <div class="container-fluid mb-5">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="addRecord"
            tabindex="-1"
            aria-labelledby="addRecordLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-secondary">
                    <!-- Modal Header -->
                    <div class="modal-header bg-neutral">
                        <h4
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Seller Statistics
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- Form start -->

                    <div class="input-form">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 my-auto"> Name </label>
                                <div class="col-md-9">
                                    {{ seller.name }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto"> Email </label>
                                <div class="col-md-9">
                                    {{ seller.email }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto">
                                    Total Products
                                </label>
                                <div class="col-md-9">
                                    {{ seller.products_count }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto">
                                    Registration date
                                </label>
                                <div class="col-md-9">
                                    {{
                                        moment(seller.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto">
                                    Latest Account update
                                </label>
                                <div class="col-md-9">
                                    {{
                                        moment(seller.updated_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto">
                                    Profile creation date
                                </label>
                                <div class="col-md-9">
                                    {{
                                        seller.seller_profile
                                            ? moment(
                                                  seller.seller_profile
                                                      .created_at
                                              ).format("DD-MM-YYYY")
                                            : "not created"
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 my-auto">
                                    Shop creation date
                                </label>
                                <div class="col-md-9">
                                    {{
                                        seller.shop
                                            ? moment(
                                                  seller.shop.created_at
                                              ).format("DD-MM-YYYY")
                                            : "not created"
                                    }}
                                </div>
                            </div>
                            <div
                                class="form-group row"
                                v-show="seller.seller_profile"
                            >
                                <label class="col-md-3 my-auto">
                                    Latest Profile update
                                </label>
                                <div class="col-md-9">
                                    {{
                                        seller.seller_profile
                                            ? moment(
                                                  seller.seller_profile
                                                      .updated_at
                                              ).format("DD-MM-YYYY")
                                            : "not created"
                                    }}
                                </div>
                            </div>
                            <div class="form-group row" v-show="seller.shop">
                                <label class="col-md-3 my-auto">
                                    Latest Shop update
                                </label>
                                <div class="col-md-9">
                                    {{
                                        seller.shop
                                            ? moment(
                                                  seller.shop.updated_at
                                              ).format("DD-MM-YYYY")
                                            : "not created"
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form end -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    data: () => ({
        moment: moment,
        analytics: "",
        seller: {},
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

        viewModal(seller) {
            this.seller = seller;
            $("#addRecord").modal("show");
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
