<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="buyerprofile in buyerprofiles">
                                        <th scope="row">
                                            {{ buyerprofile.first_name }}
                                            {{ buyerprofile.last_name }}
                                        </th>
                                        <td>{{ buyerprofile.phone }}</td>
                                        <td>
                                            {{ buyerprofile.address }} <br />
                                            <span
                                                v-show="
                                                    buyerprofile.apt_no != null
                                                "
                                            >
                                                Apt no:
                                                {{ buyerprofile.apt_no }},
                                            </span>
                                            {{ buyerprofile.zipcode }}
                                            {{ buyerprofile.state }}
                                        </td>
                                        <td>{{ buyerprofile.city }}</td>
                                        <td>{{ buyerprofile.country }}</td>
                                        <td>{{ buyerprofile.user.email }}</td>
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
                                                                buyerprofile
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteBuyerprofile(
                                                                buyerprofile.id
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
                            Update the Buyer Profile
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Buyer Profile
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
                            editMode
                                ? updateBuyerprofile()
                                : createBuyerprofile()
                        "
                    >
                        <div class="modal-body input-form-compact">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="user_id"
                                    >Buyer
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="user_id"
                                        id="user_id"
                                        v-model="form.user_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Buyer
                                        </option>
                                        <option
                                            v-for="buyer in buyers"
                                            :value="buyer.id"
                                        >
                                            {{ buyer.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="user_id" />
                                </div>
                            </div>
                            <hr class="mb-0" />
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="first_name"
                                        >First Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        name="first_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="First Name"
                                    />
                                    <HasError :form="form" field="first_name" />
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="col-form-label"
                                        for="last_name"
                                        >Last Name
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        name="last_name"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Last Name"
                                    />
                                    <HasError :form="form" field="last_name" />
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="phone"
                                        >Phone
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="phone"
                                        v-model="form.phone"
                                        type="text"
                                        name="phone"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Phone"
                                    />
                                    <HasError :form="form" field="phone" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label" for="address"
                                        >Address
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <textarea
                                        id="address"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        name="address"
                                        rows="3"
                                        cols="50"
                                        v-model="form.address"
                                    >
                                    </textarea>
                                    <HasError :form="form" field="address" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="apt_no"
                                        >Apt No.
                                    </label>
                                    <input
                                        id="apt_no"
                                        v-model="form.apt_no"
                                        type="text"
                                        name="apt_no"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Apt no."
                                    />
                                    <HasError :form="form" field="apt_no" />
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="zipcode"
                                        >Zip Code
                                    </label>
                                    <input
                                        id="zipcode"
                                        v-model="form.zipcode"
                                        type="text"
                                        name="zipcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Zip code"
                                    />
                                    <HasError :form="form" field="zipcode" />
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="state"
                                        >State
                                    </label>
                                    <input
                                        id="state"
                                        v-model="form.state"
                                        type="text"
                                        name="state"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="State"
                                    />
                                    <HasError :form="form" field="state" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="city"
                                        >City
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="city"
                                        v-model="form.city"
                                        type="text"
                                        name="city"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="City"
                                    />
                                    <HasError :form="form" field="city" />
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="country"
                                        >Country
                                        <strong class="text-danger"> *</strong>
                                    </label>
                                    <input
                                        id="country"
                                        v-model="form.country"
                                        type="text"
                                        name="country"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Country"
                                    />
                                    <HasError :form="form" field="country" />
                                </div>
                            </div>

                            <!-- Billing -->
                            <h4 class="text-gray mt-4">Billing</h4>
                            <hr class="mt-0 mb-2" />

                            <div class="custom-control custom-checkbox">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="customCheck1"
                                    v-model="billingMode"
                                />
                                <label
                                    class="custom-control-label"
                                    for="customCheck1"
                                    >Billing Address same as above</label
                                >
                            </div>

                            <div
                                class="input-form-compact"
                                id="billingSection"
                                v-show="!billingMode"
                            >
                                <hr class="my-2" />
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label
                                            class="col-form-label"
                                            for="billing_address"
                                            >Address
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>
                                        <textarea
                                            id="billing_address"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            name="billing_address"
                                            rows="3"
                                            cols="50"
                                            v-model="form.billing_address"
                                        >
                                        </textarea>
                                        <HasError
                                            :form="form"
                                            field="billing_address"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="billing_apt_no"
                                            >Apt No.
                                        </label>
                                        <input
                                            id="billing_apt_no"
                                            v-model="form.billing_apt_no"
                                            type="text"
                                            name="billing_apt_no"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Apt no."
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_apt_no"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="billing_zipcode"
                                            >Zip Code
                                        </label>
                                        <input
                                            id="billing_zipcode"
                                            v-model="form.billing_zipcode"
                                            type="text"
                                            name="billing_zipcode"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Zip code"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_zipcode"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <label
                                            class="col-form-label"
                                            for="billing_state"
                                            >State
                                        </label>
                                        <input
                                            id="billing_state"
                                            v-model="form.billing_state"
                                            type="text"
                                            name="billing_state"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="State"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_state"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_city"
                                            >City
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>
                                        <input
                                            id="billing_city"
                                            v-model="form.billing_city"
                                            type="text"
                                            name="billing_city"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="City"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_city"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="col-form-label"
                                            for="billing_country"
                                            >Country
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>
                                        <input
                                            id="billing_country"
                                            v-model="form.billing_country"
                                            type="text"
                                            name="billing_country"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Country"
                                        />
                                        <HasError
                                            :form="form"
                                            field="billing_country"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Billing end -->
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
        billingMode: false,
        buyerprofiles: [],
        buyers: [],
        searchText: null,
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            phone: "",
            country: "",
            address: "",
            apt_no: "",
            zipcode: "",
            city: "",
            state: "",
            billing_country: "",
            billing_address: "",
            billing_apt_no: "",
            billing_zipcode: "",
            billing_city: "",
            billing_state: "",
            user_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadBuyerprofiles();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadBuyers();
            $("#addRecord").modal("show");
        },

        editModal(buyerprofile) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadBuyers();
            $("#addRecord").modal("show");
            this.form.fill(buyerprofile);
        },

        loadBuyerprofiles() {
            axios
                .get("/api/admin/buyerprofiles", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.buyerprofiles = data.data))
                .catch((error) => console.log(error));
        },

        loadBuyers() {
            axios
                .get("/api/admin/users/buyer")
                .then(({ data }) => (this.buyers = data))
                .catch((error) => console.log(error));
        },

        createBuyerprofile() {
            if ((this.billingMode = true)) {
                this.form.billing_country = this.form.country;
                this.form.billing_address = this.form.address;
                this.form.billing_apt_no = this.form.apt_no;
                this.form.billing_zipcode = this.form.zipcode;
                this.form.billing_city = this.form.city;
                this.form.billing_state = this.form.state;
            }
            this.form
                .post("/api/admin/buyerprofiles")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteBuyerprofile(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/buyerprofiles/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateBuyerprofile() {
            this.form
                .put("/api/admin/buyerprofiles/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadBuyerprofiles();
        Fire.$on("reloadRecords", () => {
            this.loadBuyerprofiles();
        });
    },
};
</script>
