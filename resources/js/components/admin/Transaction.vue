<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>
            <div v-else class="row">
                <div class="col">
                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">
                                            Withdraw Request Date
                                        </th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Amount Payable</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="transaction in transactions">
                                        <th>{{ transaction.code }}</th>
                                        <td>
                                            {{
                                                transaction.request_withdrawal_date
                                                    ? transaction.request_withdrawal_date
                                                    : "not requested"
                                            }}
                                        </td>
                                        <td>{{ transaction.user.name }}</td>
                                        <td>{{ transaction.order.code }}</td>
                                        <td>
                                            {{ transaction.payable_amount }}
                                        </td>
                                        <td>{{ transaction.status }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a
                                                    class="
                                                        btn btn-sm btn-icon-only
                                                        text-primary
                                                    "
                                                    href="#"
                                                    role="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i
                                                        class="
                                                            fas
                                                            fa-ellipsis-v
                                                        "
                                                    ></i>
                                                </a>
                                                <div
                                                    class="
                                                        dropdown-menu
                                                        dropdown-menu-right
                                                        dropdown-menu-arrow
                                                    "
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editModal(
                                                                transaction
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteTransaction(
                                                                transaction.id
                                                            )
                                                        "
                                                    >
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table end -->
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
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Transaction
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Transaction
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

                    <form
                        class="input-form"
                        @submit.prevent="
                            editMode ? updateTransaction() : createTransaction()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row" v-show="editMode">
                                <label class="col-md-3 col-form-label">
                                    Code
                                </label>

                                <div class="col-md-9">
                                    <div>{{ form.code }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    User
                                </label>

                                <div class="col-md-9">
                                    <div>{{ form.user.name }}</div>
                                    <div v-show="!editMode">
                                        <input
                                            id="user_id"
                                            v-model="form.user_id"
                                            type="text"
                                            name="user_id"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                        />
                                        <HasError
                                            :form="form"
                                            field="user_id"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" v-show="editMode">
                                <label class="col-md-3 col-form-label">
                                    Shop
                                </label>

                                <div class="col-md-9" v-if="form.user.shop">
                                    <div>{{ form.user.shop.name }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Order
                                </label>

                                <div class="col-md-9">
                                    <div>{{ form.order.code }}</div>
                                    <div v-show="!editMode">
                                        <input
                                            id="order_id"
                                            v-model="form.order_id"
                                            type="text"
                                            name="order_id"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                        />
                                        <HasError
                                            :form="form"
                                            field="order_id"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="status"
                                    >Status
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="status"
                                        id="status"
                                        v-model="form.status"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Status
                                        </option>
                                        <option
                                            v-for="transactionState in transactionStates"
                                            :value="transactionState.state"
                                        >
                                            {{ transactionState.state }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="status" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="total_amount"
                                    >Total amount
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="total_amount"
                                        v-model="form.total_amount"
                                        type="text"
                                        name="total_amount"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="total_amount"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="bank_charge"
                                    >Bank charge
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="bank_charge"
                                        v-model="form.bank_charge"
                                        type="text"
                                        name="bank_charge"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="bank_charge"
                                    />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="platform_charge"
                                    >Platform charge
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="platform_charge"
                                        v-model="form.platform_charge"
                                        type="text"
                                        name="platform_charge"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="platform_charge"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="shop_discount"
                                    >Shop discount
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="shop_discount"
                                        v-model="form.shop_discount"
                                        type="text"
                                        name="shop_discount"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="shop_discount"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="payable_amount"
                                    >Amount payable
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="payable_amount"
                                        v-model="form.payable_amount"
                                        type="text"
                                        name="payable_amount"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="payable_amount"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="cleared_by"
                                    >Payment cleared by
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="cleared_by"
                                        v-model="form.cleared_by"
                                        type="text"
                                        name="cleared_by"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="cleared_by" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="payment_mode"
                                    >Payment mode
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="payment_mode"
                                        id="payment_mode"
                                        v-model="form.payment_mode"
                                    >
                                        <option value="cash">Cash</option>
                                        <option value="cash">Cheque</option>
                                        <option value="cash">
                                            Digital Payment
                                        </option>
                                        <option value="cash">
                                            Bank Transfer
                                        </option>
                                    </select>
                                    <HasError
                                        :form="form"
                                        field="payment_mode"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="clearance_date"
                                    >Clearance date
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="clearance_date"
                                        v-model="form.clearance_date"
                                        type="date"
                                        name="clearance_date"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="clearance_date"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="request_withdrawal_date"
                                    >Request withdrawal date
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="request_withdrawal_date"
                                        v-model="form.request_withdrawal_date"
                                        type="date"
                                        name="request_withdrawal_date"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="request_withdrawal_date"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button
                                v-show="editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-pen-nib mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                            <button
                                v-show="!editMode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Create
                            </button>
                        </div>
                    </form>

                    <!-- Form end -->
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
        editMode: false,
        transactions: [],
        transactionStates: [],
        searchText: null,
        loading: true,
        form: new Form({
            id: "",
            code: "",
            status: "",
            total_amount: "",
            bank_charge: "",
            platform_charge: "",
            shop_discount: "",
            payable_amount: "",
            cleared_by: "",
            payment_mode: "",
            clearance_date: "",
            request_withdrawal_date: "",
            order_id: "",
            user_id: "",
            order: "",
            user: "",
        }),
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            Fire.$emit("reloadRecords");
        }, 600),
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(transaction) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(transaction);
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

        createTransaction() {
            this.form
                .post("/api/admin/transactions")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteTransaction(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/transactions/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateTransaction() {
            this.form
                .put("/api/admin/transactions/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
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
