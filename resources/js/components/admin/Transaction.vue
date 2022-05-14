<template>
    <div>
        <!-- Body -->
        <div class="container-fluid">
            <div
                v-if="loading"
                class="d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card pb-3 pb-md-1">
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
                            <div class="col-lg-8 col-3 text-right">
                                <button
                                    type="button"
                                    class="btn btn-primary mobile-add-btn"
                                >
                                    Request Withdrawal
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
                                        <th scope="col">Code</th>
                                        <th scope="col">Order Code</th>
                                        <th scope="col" class="table-col-sm">
                                            Total Amount
                                        </th>
                                        <th class="table-col-sm">
                                            Bank Charge
                                        </th>
                                        <th class="table-col-sm">
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
                                    <tr v-for="transaction in transactions">
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
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                "
                                                name="status"
                                                id="status"
                                                v-model="transaction.status"
                                                @change.prevent="
                                                    setCurrentState(
                                                        transaction.id,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option
                                                    v-for="transactionState in transactionStates"
                                                    :value="transactionState.id"
                                                >
                                                    {{ transactionState.state }}
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <div class="d-flex">
                                                <a
                                                    class="btn btn-sm"
                                                    href="#"
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
                                v-for="transaction in transactions"
                            >
                                <div
                                    class="
                                        d-flex
                                        flex-row
                                        justify-content-between
                                        mb-4
                                    "
                                >
                                    <div class="mr-3">
                                        <div class="mobile-card-title mb-3">
                                            {{ transaction.code }}
                                        </div>
                                        <select
                                            class="
                                                custom-select
                                                form-control
                                                mobile-btn-sm
                                            "
                                            name="status"
                                            id="status"
                                            v-model="transaction.status"
                                            @change.prevent="
                                                setCurrentState(
                                                    transaction.id,
                                                    $event
                                                )
                                            "
                                        >
                                            <option
                                                v-for="transactionState in transactionStates"
                                                :value="transactionState.id"
                                            >
                                                {{ transactionState.state }}
                                            </option>
                                        </select>
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
                                                    newModal(transaction)
                                                "
                                            >
                                                View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="mobile-card-sub-title">
                                        Title
                                    </div>
                                    <div class="mobile-card-body">
                                        {{ transaction.title }}
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
                                            Quantity
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.quantity }}
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
                                    <div>
                                        <div class="mobile-card-sub-title">
                                            Base Price
                                        </div>
                                        <div class="mobile-card-body">
                                            {{ transaction.base_price }}
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
            v-if="current_transaction"
        >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
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
        transactions: [],
        transactionStates: [],
        current_transaction: "",
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            status: "",
            request_withdrawal_date: "",
        }),
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        newModal(transaction) {
            this.current_transaction = transaction;
            $("#addRecord").modal("show");
        },

        loadTransactions() {
            axios
                .get("/api/admin/transactions", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.transactions = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadTransactionStates() {
            axios
                .get("/api/admin/transaction_states")
                .then(({ data }) => (this.transactionStates = data))
                .catch((error) => console.log(error));
        },

        setCurrentState(transaction, event) {
            if (
                confirm("Are you sure you want to change transaction status?")
            ) {
                this.form.status = event.target.value;
                this.form.request_withdrawal_date =
                    moment().format("DD/MM/YYYY");
                this.form
                    .put("/api/admin/transactions/" + transaction)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadTransactions();
        this.loadTransactionStates();
        Fire.$on("reloadRecords", () => {
            this.loadTransactions();
        });
    },
};
</script>
