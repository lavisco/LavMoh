<template>
    <div>
        <!-- Header -->
        <table-header @callNewModal="newModal" v-model="searchText" />

        <!-- Body -->
        <div class="container-fluid mt--6 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date joined</th>
                                        <th scope="col">Role</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users">
                                        <th scope="row">
                                            <div
                                                class="media align-items-center"
                                            >
                                                <img
                                                    class="
                                                        avatar
                                                        rounded-circle
                                                        mr-3
                                                    "
                                                    :src="user.path"
                                                />
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">
                                                        {{ user.name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>{{ user.email }}</td>
                                        <td>
                                            <span
                                                v-if="user.status == 1"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-success
                                                "
                                                >Active
                                            </span>
                                            <span
                                                v-else-if="user.status == 0"
                                                class="
                                                    badge
                                                    badge-pill
                                                    badge-secondary
                                                "
                                            >
                                                Inactive
                                            </span>
                                        </td>
                                        <td>{{ user.created_at }}</td>
                                        <td>{{ user.role.name }}</td>
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
                                                            editModal(user)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            editPasswordModal(
                                                                user
                                                            )
                                                        "
                                                    >
                                                        Edit Password
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteUser(user.id)
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
                        <!-- Card Footer -->
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a
                                            class="page-link"
                                            href="#"
                                            tabindex="-1"
                                        >
                                            <i class="fas fa-angle-left"></i>
                                            <span class="sr-only"
                                                >Previous</span
                                            >
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"
                                            >2
                                            <span class="sr-only"
                                                >(current)</span
                                            ></a
                                        >
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fas fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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
                            Update the User
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New User
                        </h4>
                        <h4
                            v-show="editPasswordModal"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Update User Password
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

                    <!-- Form password Reset start -->

                    <form
                        v-if="editPasswordModal"
                        class="input-form"
                        @submit.prevent="updateUserPassword()"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="email"
                                    >Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Email"
                                        disabled
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="password"
                                    >Password
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        name="password"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="password" />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button type="submit" class="btn btn-primary">
                                <i
                                    class="fas fa-pen-nib mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update Password
                            </button>
                        </div>
                    </form>

                    <!-- Form Password Reset end -->

                    <!-- Form start -->

                    <form
                        v-else
                        class="input-form"
                        @submit.prevent="editMode ? updateUser() : createUser()"
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
                                    for="email"
                                    >Email
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        name="email"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="Email"
                                    />
                                    <HasError :form="form" field="email" />
                                </div>
                            </div>
                            <div v-show="!editMode" class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="password"
                                    >Password
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        name="password"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                    />
                                    <HasError :form="form" field="password" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="role_id"
                                    >Role
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="role_id"
                                        id="role_id"
                                        v-model="form.role_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select Role
                                        </option>
                                        <option
                                            v-for="role in roles"
                                            :value="role.id"
                                        >
                                            {{ role.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="role_id" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="avatar"
                                    >Upload avatar
                                </label>

                                <div class="col-md-9">
                                    <input
                                        type="file"
                                        style="display: none"
                                        @change.prevent="fileSelected"
                                        ref="fileInput"
                                        name="avatar"
                                    />

                                    <button
                                        class="image-upload-box"
                                        @click.prevent="$refs.fileInput.click()"
                                    >
                                        <i
                                            v-show="!this.form.avatar"
                                            class="fas fa-plus"
                                        ></i>
                                        <i
                                            v-show="this.form.avatar"
                                            class="fas fa-check"
                                        ></i>
                                    </button>
                                    <p class="image-upload-filename mt-2">
                                        {{
                                            this.form.avatar
                                                ? this.form.photoName
                                                : `Choose file`
                                        }}
                                    </p>
                                    <HasError :form="form" field="avatar" />
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
        passwordMode: false,
        users: [],
        roles: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            email: "",
            password: "",
            role_id: "",
            avatar: "",
            status: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadUsers();
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
                this.form.avatar = reader.result;
                this.form.photoName = e.target.files[0].name;
            };
            reader.readAsDataURL(file);
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadRoles();
            $("#addRecord").modal("show");
        },
        editModal(user) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadRoles();
            $("#addRecord").modal("show");
            this.form.fill(user);
        },
        editPasswordModal(user) {
            this.passwordMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(user);
        },
        loadUsers() {
            axios
                .get("/api/admin/users", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.users = data.data))
                .catch((error) => console.log(error));
        },
        loadRoles() {
            axios
                .get("/api/admin/roles")
                .then(({ data }) => (this.roles = data))
                .catch((error) => console.log(error));
        },
        createUser() {
            this.form
                .post("/api/admin/users")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteUser(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/users/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateUser() {
            this.form
                .put("/api/admin/users/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        updateUserPassword() {
            this.form
                .put("/api/admin/users/password_reset/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadUsers();
        this.loadRoles();
        Fire.$on("reloadRecords", () => {
            this.loadUsers();
        });
    },
};
</script>
