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
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Symbol</th>
                                        <th scope="col">Format</th>
                                        <th scope="col">Exchange Rate</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="currency in currencies">
                                        <th>{{ currency.name }}</th>
                                        <td>{{ currency.code }}</td>
                                        <td>{{ currency.symbol }}</td>
                                        <td>{{ currency.format }}</td>
                                        <td>{{ currency.exchange_rate }}</td>
                                        <td>
                                            <span
                                                v-if="currency.status == 1"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-success
                                                "
                                            >
                                                Active
                                            </span>
                                            <span
                                                v-else-if="currency.status == 0"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-danger
                                                "
                                            >
                                                Inactive
                                            </span>
                                        </td>
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
                                                            editModal(currency)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteCurrency(
                                                                currency.id
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

                        <!-- Pagination Start -->

                        <pagination
                            v-if="pagination.last_page > 1"
                            :pagination="pagination"
                            :offset="5"
                            @paginate="loadCurrencies()"
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
                <div class="modal-content bg-secondary">
                    <!-- Modal Header -->
                    <div class="modal-header bg-neutral">
                        <h4
                            v-show="editMode"
                            class="modal-title"
                            id="addRecordLabel"
                        >
                            Update the Currency
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Currency
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
                            editMode ? updateCurrency() : createCurrency()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Name
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        name="name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Name"
                                    />
                                    <HasError :form="form" field="name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="code"
                                    >Code
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="code"
                                        v-model="form.code"
                                        type="text"
                                        name="code"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="code" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="symbol"
                                    >Symbol
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="symbol"
                                        v-model="form.symbol"
                                        type="text"
                                        name="symbol"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="symbol" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="format"
                                    >Format
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="format"
                                        v-model="form.format"
                                        type="text"
                                        name="format"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="format" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="exchange_rate"
                                    >Exchange rate
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="exchange_rate"
                                        v-model="form.exchange_rate"
                                        type="text"
                                        name="exchange_rate"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError
                                        :form="form"
                                        field="exchange_rate"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="status"
                                    >Status
                                </label>

                                <div class="col-md-9">
                                    <div
                                        class="
                                            custom-control
                                            custom-radio
                                            custom-control-inline
                                        "
                                    >
                                        <input
                                            type="radio"
                                            id="status1"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="1"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="status1"
                                            >Active
                                        </label>
                                    </div>
                                    <div
                                        class="
                                            custom-control
                                            custom-radio
                                            custom-control-inline
                                        "
                                    >
                                        <input
                                            type="radio"
                                            id="status2"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="0"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="status2"
                                            >Inactive
                                        </label>
                                    </div>
                                    <HasError :form="form" field="status" />
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

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        editMode: false,
        loading: true,
        currencies: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            code: "",
            symbol: "",
            format: "",
            exchange_rate: "",
            status: "",
        }),
        pagination: { current_page: 1 },
    }),

    watch: {
        searchText(after, before) {
            Fire.$emit("reloadRecords");
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(currency) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(currency);
        },
        loadCurrencies() {
            axios
                .get(
                    "/api/admin/currencies?page=" +
                        this.pagination.current_page,
                    {
                        params: { searchText: this.searchText },
                    }
                )
                .then(({ data }) => {
                    this.currencies = data.data;
                    this.pagination.last_page = data.last_page;
                    this.pagination.current_page = data.current_page;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        createCurrency() {
            this.form
                .post("/api/admin/currencies")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteCurrency(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/currencies/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateCurrency() {
            this.form
                .put("/api/admin/currencies/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadCurrencies();
        Fire.$on("reloadRecords", () => {
            this.pagination.current_page = 1;
            this.loadCurrencies();
        });
    },
};
</script>
