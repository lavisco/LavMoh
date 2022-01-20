<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="material in materials">
                                        <th>{{ material.name }}</th>
                                        <td>{{ material.description }}</td>
                                        <td>
                                            <span
                                                v-if="material.status == 1"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-success
                                                "
                                            >
                                                Active
                                            </span>
                                            <span
                                                v-else-if="material.status == 0"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-secondary
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
                                                            editModal(material)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteMaterial(
                                                                material.id
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
                            Update the Material
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Material
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
                            editMode ? updateMaterial() : createMaterial()
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
                                    for="description"
                                    >Description
                                </label>

                                <div class="col-md-9">
                                    <textarea
                                        id="description"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        name="description"
                                        rows="3"
                                        cols="50"
                                        v-model="form.description"
                                    >
                                    </textarea>
                                    <HasError
                                        :form="form"
                                        field="description"
                                    />
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
                                            id="active"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="1"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="active"
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
                                            id="inactive"
                                            name="status"
                                            class="custom-control-input"
                                            v-model="form.status"
                                            value="0"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="inactive"
                                            >Inactive</label
                                        >
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
        materials: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            description: "",
            status: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadMaterials();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(material) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(material);
        },
        loadMaterials() {
            axios
                .get("/api/admin/materials", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.materials = data.data))
                .catch((error) => console.log(error));
        },
        createMaterial() {
            this.form
                .post("/api/admin/materials")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteMaterial(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/materials/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateMaterial() {
            this.form
                .put("/api/admin/materials/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadMaterials();
        Fire.$on("reloadRecords", () => {
            this.loadMaterials();
        });
    },
};
</script>
