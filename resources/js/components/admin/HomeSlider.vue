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
                                        <th scope="col">Banner</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Order</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="homeslider in homesliders">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container"
                                                :src="homeslider.path"
                                            />
                                        </td>
                                        <th>{{ homeslider.name }}</th>
                                        <td>{{ homeslider.description }}</td>
                                        <td>{{ homeslider.order }}</td>
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
                                                                homeslider
                                                            )
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteHomeslider(
                                                                homeslider.id
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
                            Update the Homeslider
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Homeslider
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
                            editMode ? updateHomeslider() : createHomeslider()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="name"
                                    >Slider Header
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
                                    for="order"
                                    >Slide Order Number
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-3">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="order"
                                        id="order"
                                        v-model="form.order"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select number
                                        </option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                    </select>
                                    <HasError :form="form" field="order" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="link"
                                    >Button Link
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="link"
                                        v-model="form.link"
                                        type="text"
                                        name="link"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Link"
                                    />
                                    <HasError :form="form" field="link" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="link_text"
                                    >Button Link Text
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="link_text"
                                        v-model="form.link_text"
                                        type="text"
                                        name="link_text"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Link text"
                                    />
                                    <HasError :form="form" field="link_text" />
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
                                    for="banner"
                                    >Upload banner
                                </label>

                                <div class="col-md-9">
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelected"
                                        ref="fileInput"
                                        name="banner"
                                    />

                                    <button
                                        class="image-upload-box"
                                        @click.prevent="$refs.fileInput.click()"
                                    >
                                        <i
                                            v-show="!this.form.banner"
                                            class="fas fa-plus"
                                        ></i>
                                        <i
                                            v-show="this.form.banner"
                                            class="fas fa-check"
                                        ></i>
                                    </button>
                                    <p class="image-upload-filename mt-2">
                                        {{
                                            this.form.banner
                                                ? this.form.photoName
                                                : `Choose file`
                                        }}
                                    </p>
                                    <HasError :form="form" field="banner" />
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
        homesliders: [],
        searchText: null,
        form: new Form({
            id: "",
            order: "",
            name: "",
            description: "",
            link: "",
            link_text: "",
            banner: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            Fire.$emit("reloadRecords");
        },
    },

    methods: {
        fileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.banner = reader.result;
                this.form.photoName = e.target.files[0].name;
            };
            reader.readAsDataURL(file);
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(homeslider) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(homeslider);
            this.form.photoName = this.form.banner;
        },

        loadHomesliders() {
            axios
                .get("/api/admin/homesliders", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.homesliders = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        createHomeslider() {
            this.form
                .post("/api/admin/homesliders")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteHomeslider(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/homesliders/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateHomeslider() {
            this.form
                .put("/api/admin/homesliders/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadHomesliders();
        Fire.$on("reloadRecords", () => {
            this.loadHomesliders();
        });
    },
};
</script>
