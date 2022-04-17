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
                    <div id="accordion">
                        <div class="card mb-3">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button
                                        class="btn btn-link collapsed"
                                        data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="false"
                                        aria-controls="collapseOne"
                                    >
                                        Naming conventions
                                    </button>
                                </h5>
                            </div>

                            <div
                                id="collapseOne"
                                class="collapse"
                                aria-labelledby="headingOne"
                                data-parent="#accordion"
                            >
                                <div class="card-body">
                                    <ol>
                                        <li>
                                            Each word in the key / key name
                                            must be seperated by an underscore
                                            _
                                        </li>
                                        <li>
                                            Key name for text content - Add
                                            '_text' at the end of name
                                        </li>
                                        <li>
                                            Key name for image content - Add
                                            '_image' at the end of name
                                        </li>
                                        <li>
                                            Key name for multiple text/ image content
                                            - Add serial number e.g. '_1', '_2',
                                            at the end of name
                                        </li>
                                        <li>
                                            For more information refer to the
                                            Lavisco naming guide or contact
                                            admin
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <!-- Table start -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Key</th>
                                        <th scope="col">Value</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sitetext in sitetexts">
                                        <th>{{ sitetext.key }}</th>
                                        <td>{{ sitetext.content }}</td>
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
                                                            editModal(sitetext)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteSitetext(
                                                                sitetext.id
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
                            Update the Sitetext
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Sitetext
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
                            editMode ? updateSitetext() : createSitetext()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="key"
                                    >Key
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="key"
                                        v-model="form.key"
                                        type="text"
                                        name="key"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Key"
                                    />
                                    <HasError :form="form" field="key" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="contentType"
                                    >Content Type
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
                                            id="contentType1"
                                            name="contentType"
                                            class="custom-control-input"
                                            v-model="form.contentType"
                                            value="text"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="contentType1"
                                            >Text
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
                                            id="contentType2"
                                            name="contentType"
                                            class="custom-control-input"
                                            v-model="form.contentType"
                                            value="image"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="contentType2"
                                            >Image
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="form-group row"
                                v-show="form.contentType"
                            >
                                <label
                                    class="col-md-3 col-form-label"
                                    for="content"
                                    >Content
                                </label>

                                <div class="col-md-9">
                                    <div v-if="form.contentType == 'text'">
                                        <textarea
                                            id="content"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            name="content"
                                            rows="3"
                                            cols="50"
                                            v-model="form.content"
                                        >
                                        </textarea>
                                    </div>

                                    <div v-if="form.contentType == 'image'">
                                        <input
                                            type="file"
                                            style="display: none"
                                            @change.prevent="fileSelected"
                                            ref="fileInput"
                                            name="content"
                                        />

                                        <button
                                            class="image-upload-box"
                                            @click.prevent="
                                                $refs.fileInput.click()
                                            "
                                        >
                                            <i
                                                v-show="!this.content"
                                                class="fas fa-plus"
                                            ></i>
                                            <i
                                                v-show="this.content"
                                                class="fas fa-check"
                                            ></i>
                                        </button>
                                        <p class="image-upload-filename mt-2">
                                            {{
                                                this.form.content
                                                    ? this.form.photoName
                                                    : `Choose file`
                                            }}
                                        </p>
                                    </div>

                                    <HasError :form="form" field="content" />
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
        sitetexts: [],
        searchText: null,
        form: new Form({
            id: "",
            key: "",
            content: "",
            contentType: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadSitetexts();
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
                this.form.content = reader.result;
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

        editModal(sitetext) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(sitetext);
            this.form.photoName = this.form.content;
        },
        loadSitetexts() {
            axios
                .get("/api/admin/sitetexts", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.sitetexts = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        createSitetext() {
            this.form
                .post("/api/admin/sitetexts")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteSitetext(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/sitetexts/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateSitetext() {
            this.form
                .put("/api/admin/sitetexts/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadSitetexts();
        Fire.$on("reloadRecords", () => {
            this.loadSitetexts();
        });
    },
};
</script>
