<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card pb-3 pb-md-1 pt-0">
                        <div class="row align-items-center">
                            <div
                                class="
                                    col-lg-4 col-9
                                    input-form
                                    input-group
                                    input-group-alternative
                                    search-input
                                    mb-0 mb-md-0
                                "
                            >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Search"
                                    type="text"
                                    v-model="searchText"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- Table start -->
                        <div
                            class="
                                table-responsive
                                dashboard-table
                                vertical-scroll
                                hide-content-sm
                            "
                        >
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col" class="table-col-lg">
                                            Product
                                        </th>
                                        <th class="table-col-sm">Delivery Date</th>
                                        <th class="table-col-sm">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="inquiry in inquiries">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container-sm"
                                                :src="inquiry.path"
                                            />
                                        </td>
                                        <td>
                                            {{
                                                inquiry.first_name +
                                                " " +
                                                inquiry.last_name
                                            }}<br />
                                            {{ inquiry.email }}<br />
                                            {{ inquiry.phone }}<br />
                                            {{ inquiry.city }}, 
                                            {{ inquiry.district }},
                                            {{ inquiry.state }},
                                            {{ inquiry.country }}
                                        </td>
                                        <td>
                                            {{ inquiry.short_description }}
                                        </td>
                                        <td>
                                            {{
                                                moment(
                                                    inquiry.delivery_date
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                "
                                                name="status"
                                                id="status"
                                                v-model="inquiry.status"
                                            >
                                                <option value="pending">
                                                    Pending
                                                </option>
                                                <option value="conditional">
                                                    Conditional
                                                </option>
                                                <option value="reject">
                                                    Reject
                                                </option>
                                                <option value="accept">
                                                    Accept
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <div class="d-flex">
                                                <a
                                                    class="btn btn-sm"
                                                    href="#"
                                                    @click.prevent="
                                                        newModal(inquiry)
                                                    "
                                                >
                                                    View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table end -->

                        <!-- Mobile View start -->
                        <div class="hide-content">
                            <div
                                class="card dashboard-info-card mb-4 pb-3"
                                v-for="inquiry in inquiries"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-4
                                    "
                                >
                                    <div class="d-flex flex-row mr-3">
                                        <img
                                            width="150px"
                                            height="150px"
                                            class="
                                                mobile-card-banner-container
                                                banner-container-xs
                                                mr-3
                                            "
                                            :src="inquiry.path"
                                        />
                                        <div>
                                            <div class="mobile-card-title mb-3">
                                                {{
                                                    inquiry.first_name +
                                                    " " +
                                                    inquiry.last_name
                                                }}
                                            </div>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    mobile-btn-sm
                                                "
                                                name="status"
                                                id="status"
                                                v-model="inquiry.status"
                                            >
                                                <option value="pending">
                                                    Pending
                                                </option>
                                                <option value="conditional">
                                                    Conditional
                                                </option>
                                                <option value="reject">
                                                    Reject
                                                </option>
                                                <option value="accept">
                                                    Accept
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mobile-card-dropdown">
                                        <button
                                            type="button"
                                            class="btn btn-sm mobile-btn-sm"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                aria-hidden="true"
                                                role="img"
                                                width="23px"
                                                height="23px"
                                                preserveAspectRatio="xMidYMid meet"
                                                viewBox="0 0 16 16"
                                            >
                                                <g
                                                    fill="none"
                                                    stroke="#976aff"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                >
                                                    <circle
                                                        cx="8"
                                                        cy="2.5"
                                                        r=".75"
                                                    />
                                                    <circle
                                                        cx="8"
                                                        cy="8"
                                                        r=".75"
                                                    />
                                                    <circle
                                                        cx="8"
                                                        cy="13.5"
                                                        r=".75"
                                                    />
                                                </g>
                                            </svg>
                                        </button>
                                        <div
                                            class="
                                                dropdown-menu
                                                dropdown-menu-right
                                            "
                                        >
                                            <button
                                                class="
                                                    dropdown-item
                                                    mobile-dropdown-item
                                                "
                                                type="button"
                                                @click.prevent="
                                                    newModal(inquiry)
                                                "
                                            >
                                                View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="mobile-card-sub-title">
                                        Contact Customer
                                    </div>
                                    <div class="mobile-card-body">
                                        {{ inquiry.email }}<br />
                                        {{ inquiry.phone }}<br />
                                        {{ inquiry.city }},
                                        {{ inquiry.district }},
                                        {{ inquiry.state }},
                                        {{ inquiry.country }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="mobile-card-sub-title">
                                        Customisation Details
                                    </div>
                                    <div class="mobile-card-body">
                                        {{ inquiry.short_description }}
                                    </div>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        align-items-center
                                        justify-content-between
                                    "
                                >
                                    <div class="mr-3">
                                        <div class="mobile-card-sub-title">
                                            Delivery Date
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    inquiry.delivery_date
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Date
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    inquiry.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile View end -->
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
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            Request from
                            {{ form.first_name + " " + form.last_name }}
                        </h4>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle white"
                                aria-hidden="true"
                            ></i>
                        </button>
                    </div>

                    <!-- Form start -->
                    <div class="modal-body modal-view">
                        <div class="card dashboard-info-card">
                            <!-- Header -->
                            <h4 class="mb-3">Image provided by customer</h4>
                            <hr class="mt-0" />
                            <div class="d-flex flex-row flex-wrap gap">
                                <div class="image-upload-box">
                                    <img
                                        class="
                                            banner-container
                                            seller-banner-container
                                        "
                                        :src="form.path"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Customisation Details</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Delivery Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(form.delivery_date).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Short Description
                                </div>
                                <div class="col-md-9">
                                    {{ form.short_description }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Description
                                </div>
                                <div class="col-md-9">
                                    {{ form.description }}
                                </div>
                            </div>
                        </div>
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Customer Details</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Name</div>
                                <div class="col-md-9">
                                    {{ form.first_name }}
                                    {{ form.last_name }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Contact</div>
                                <div class="col-md-9">
                                    {{ form.email }} <br />
                                    {{ form.phone }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Address</div>
                                <div class="col-md-9">
                                    {{ form.address }}
                                    <br />
                                    {{ form.city }}, {{ form.district }},
                                    {{ form.state }},
                                    {{ form.country }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-black">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <i
                                class="fas fa-times-circle mr-2"
                                aria-hidden="true"
                            ></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";
import _ from "lodash";
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        moment: moment,
        inquiries: [],
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
            address: "",
            city: "",
            district: "",
            state: "",
            delivery_date: "",
            size: "",
            tiers: "",
            description: "",
            short_description: "",
            image_path: "",
            path: "",
        }),
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        newModal(inquiry) {
            $("#addRecord").modal("show");
            this.form.fill(inquiry);
        },

        loadProducts() {
            axios
                .get("/api/seller/custom_product_inquiries", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.inquiries = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        setCurrentState(inquiry, event) {
            if (confirm("Are you sure you want to change inquiry status?")) {
                this.form.product_state_id = event.target.value;
                this.form
                    .put("/api/seller/inquiries/updateState/" + inquiry)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadProducts();
        Fire.$on("reloadRecords", () => {
            this.loadProducts();
        });
    },
};
</script>
