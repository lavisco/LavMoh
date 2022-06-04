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
                                        <th scope="col">Category</th>
                                        <th scope="col">Group</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sub_category in sub_categories">
                                        <th>{{ sub_category.name }}</th>
                                        <td>
                                            {{ sub_category.category.name }}
                                        </td>
                                        <td>{{ sub_category.groupName }}</td>
                                        <td>
                                            <span
                                                v-if="sub_category.status == 1"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-success
                                                "
                                            >
                                                Active
                                            </span>
                                            <span
                                                v-else-if="
                                                    sub_category.status == 0
                                                "
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-danger
                                                "
                                            >
                                                Inactive
                                            </span>
                                        </td>
                                        <td>{{ sub_category.slug }}</td>
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
                                                                sub_category
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteSubCategory(
                                                                sub_category.id
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
                            Update the Sub-Category
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Sub-Category
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
                            editMode ? updateSubCategory() : createSubCategory()
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
                                    for="groupName"
                                >
                                    Group Name
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="groupName"
                                        v-model="form.groupName"
                                        type="text"
                                        name="groupName"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="groupName" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="status"
                                >
                                    Status
                                    <strong class="text-danger"> *</strong>
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
                                            >Active</label
                                        >
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
                                            >Inactive</label
                                        >
                                    </div>
                                    <HasError :form="form" field="status" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="category_id"
                                    >Category
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="category_id"
                                        id="category_id"
                                        v-model="form.category_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Category
                                        </option>
                                        <option
                                            v-for="category in categories"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <HasError
                                        :form="form"
                                        field="category_id"
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

export default {
    components: {
        HasError,
        AlertError,
    },
    data: () => ({
        editMode: false,
        loading: true,
        sub_categories: [],
        categories: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            groupName: "",
            status: "",
            category_id: "",
        }),
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
            this.loadCategories();
            $("#addRecord").modal("show");
        },

        editModal(sub_category) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadCategories();
            $("#addRecord").modal("show");
            this.form.fill(sub_category);
        },
        loadSubCategories() {
            axios
                .get("/api/admin/sub_categories", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.sub_categories = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        loadCategories() {
            axios
                .get("/api/admin/categories")
                .then(({ data }) => {
                    this.categories = data.data;
                })
                .catch((error) => console.log(error));
        },
        createSubCategory() {
            this.form
                .post("/api/admin/sub_categories")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteSubCategory(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/sub_categories/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateSubCategory() {
            this.form
                .put("/api/admin/sub_categories/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadSubCategories();
        Fire.$on("reloadRecords", () => {
            this.loadSubCategories();
        });
    },
};
</script>
