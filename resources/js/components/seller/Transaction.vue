<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mb-5">
            <div
                v-if="loading"
                class="d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card pb-3 pb-md-1 pt-0">
                        <div
                            class="
                                row
                                align-items-center
                                justify-content-center
                            "
                        >
                            <div
                                class="
                                    col-lg-4
                                    input-form
                                    input-group
                                    input-group-alternative
                                    search-input
                                    mb-3 mb-md-0
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
                            <div class="col-lg-8 text-md-right">
                                <button
                                    type="button"
                                    class="btn btn-primary mobile-add-btn btn-md-full"
                                    @click.prevent="requestWithdrawal"
                                >
                                    Request
                                    {{ form.transaction_ids.length }}
                                    Withdrawal
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card" v-if="transactions.length > 0">
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
                                        <th scope="col">Transaction Code</th>
                                        <th scope="col">Order Code</th>
                                        <th scope="col" class="table-col-sm">
                                            Total Amount
                                        </th>
                                        <th>
                                            Bank Charge
                                        </th>
                                        <th>
                                            Lavisco Commission
                                        </th>
                                        <th class="table-col-sm">
                                            Amount Payable
                                        </th>
                                        <th class="table-col-sm">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            transaction, index
                                        ) in transactions"
                                    >
                                        <td>{{ transaction.code }}</td>
                                        <td>{{ transaction.order.code }}</td>
                                        <td>{{ transaction.total_amount }}</td>
                                        <td>{{ transaction.bank_charge }}</td>
                                        <td>
                                            {{ transaction.platform_charge }}
                                        </td>
                                        <td>
                                            {{ transaction.payable_amount }}
                                        </td>
                                        <td>
                                            <span
                                                class="
                                                    badge badge-pill
                                                    bg-red
                                                    white
                                                    text-sm
                                                "
                                            >
                                                {{ transaction.status }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="d-flex">
                                                <a
                                                    class="btn btn-sm mr-3"
                                                    @click.prevent="
                                                        setRequestedTransactions(
                                                            transaction,
                                                            index
                                                        )
                                                    "
                                                    v-show="
                                                        disableWithdrawBtn(
                                                            transaction
                                                        )
                                                    "
                                                >
                                                    Withdraw
                                                </a>
                                                <a
                                                    class="btn btn-sm"
                                                    @click.prevent="
                                                        newModal(transaction)
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
                                v-for="(transaction, index) in transactions"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-2
                                    "
                                >
                                    <div class="mr-3 mb-3">
                                        <div class="mobile-card-title mb-1">
                                            {{ transaction.code }}
                                        </div>
                                        <span
                                            class="
                                                badge badge-pill
                                                bg-red
                                                white
                                                text-xxs
                                            "
                                        >
                                            {{ transaction.status }}
                                        </span>
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
                                                    stroke="#df4e6b"
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
                                                    newModal(transaction)
                                                "
                                            >
                                                View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mb-3"
                                    v-show="disableWithdrawBtn(transaction)"
                                >
                                    <div class="mobile-card-sub-title">
                                        Update Status
                                    </div>
                                    <button
                                        class="btn btn-sm mobile-btn-sm"
                                        type="button"
                                        @click.prevent="
                                            setRequestedTransactions(
                                                transaction,
                                                index
                                            )
                                        "
                                    >
                                        Withdraw
                                    </button>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-3
                                    "
                                >
                                    <div class="mr-2">
                                        <div class="mobile-card-sub-title">
                                            Order
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.order.code }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Amount Payable
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.payable_amount }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Total
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.total_amount }}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                    "
                                >
                                    <div class="mr-3">
                                        <div class="mobile-card-sub-title">
                                            Lavisco fee
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.platform_charge }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Bank fee
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.bank_charge }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Date
                                        </div>
                                        <div class="mobile-card-body">
                                            {{
                                                moment(
                                                    transaction.created_at
                                                ).format("DD-MM-YYYY")
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile View end -->

                        <!-- Pagination Start -->

                        <pagination
                            v-if="pagination.last_page > 1"
                            :pagination="pagination"
                            :offset="5"
                            @paginate="loadTransactions()"
                        ></pagination>

                        <!-- Pagination end -->
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
                <div class="modal-content" v-if="current_transaction_mode">
                    <!-- Modal Header -->
                    <div class="modal-header bg-black">
                        <h4
                            class="modal-title white text-uppercase mb-0"
                            id="addRecordLabel"
                        >
                            {{ current_transaction.code }}
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
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Details</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ current_transaction.code }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Status</div>
                                <div class="col-md-9">
                                    {{ current_transaction.status }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Date created
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_transaction.created_at
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Payable Amount
                                </div>
                                <div class="col-md-9">
                                    LKR {{ current_transaction.payable_amount }}
                                    <div class="darkgrey">
                                        Total:
                                        {{ current_transaction.total_amount }} -
                                    </div>
                                    <div class="darkgrey">
                                        Bank Charge:
                                        {{ current_transaction.bank_charge }} -
                                    </div>
                                    <div class="darkgrey">
                                        Lavisco Commission:
                                        {{
                                            current_transaction.platform_charge
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-if="
                                    current_transaction.request_withdrawal_date
                                "
                            >
                                <div class="col-md-3 modal-label">
                                    Withdrawal Request Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_transaction.request_withdrawal_date
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-show="current_transaction.payment_mode"
                            >
                                <div class="col-md-3 modal-label">
                                    Payment Mode
                                </div>
                                <div class="col-md-9">
                                    {{ current_transaction.payment_mode }}
                                </div>
                            </div>
                            <div
                                class="row mb-3"
                                v-if="current_transaction.clearance_date"
                            >
                                <div class="col-md-3 modal-label">
                                    Clearance Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_transaction.clearance_date
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="card dashboard-info-card mt-4">
                            <!-- Header -->
                            <h4 class="mb-3">Order</h4>
                            <hr class="mt-0" />
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Code</div>
                                <div class="col-md-9">
                                    {{ current_transaction.order.code }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">Customer</div>
                                <div class="col-md-9">
                                    {{
                                        current_transaction.order.first_name +
                                        " " +
                                        current_transaction.order.last_name
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Customer Contact
                                </div>
                                <div class="col-md-9">
                                    {{ current_transaction.order.email }} <br />
                                    {{ current_transaction.order.phone }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Order placed on
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_transaction.order.created_at
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Delivery Date
                                </div>
                                <div class="col-md-9">
                                    {{
                                        moment(
                                            current_transaction.order
                                                .delivery_date
                                        ).format("DD-MM-YYYY")
                                    }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 modal-label">
                                    Order Status
                                </div>
                                <div class="col-md-9">
                                    {{ current_transaction.order.status }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-black">
                        <button
                            type="button"
                            class="btn"
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
        transactions: [],
        current_transaction: "",
        current_transaction_mode: false,
        disable_withdraw_btn: false,
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            transaction_ids: [],
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        newModal(transaction) {
            this.current_transaction = transaction;
            this.current_transaction_mode = true;
            $("#addRecord").modal("show");
        },

        loadTransactions() {
            axios
                .get("/api/seller/transactions?page=" +
                        this.pagination.current_page, {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.transactions = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        disableWithdrawBtn(transaction) {
            return (
                !this.form.transaction_ids.includes(transaction.id) &&
                !moment(
                    moment(transaction.request_withdrawal_date).format(
                        "YYYY-MM-DD"
                    )
                ).isSame(moment().format("YYYY-MM-DD"))
            );
        },

        setRequestedTransactions(transaction, index) {
            if (confirm("Withdraw this order's payment?")) {
                this.form.transaction_ids.indexOf(transaction.id) === -1
                    ? this.$set(
                          this.form.transaction_ids,
                          index,
                          transaction.id
                      )
                    : console.log("This item already exists");
            }
        },

        requestWithdrawal() {
            if (confirm("Are you sure you want to withdraw payment?")) {
                this.form
                    .post("/api/seller/transactions")
                    .then(() => {
                        this.form.transaction_ids = [];
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadTransactions();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadTransactions();
        });
    },
};
</script>
