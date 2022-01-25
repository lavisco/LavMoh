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
                                        <th scope="col">Banner</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">About</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="shop in shops">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container"
                                                :src="shop.path"
                                            />
                                            
                                        </td>
                                        <th>{{ shop.name }}</th>
                                        <td>{{ shop.url }}</td>
                                        <td>{{ shop.about }}</td>
                                        <td>{{ shop.user.name }}</td>
                                        <td>
                                            <span
                                                v-html="shopRating(shop.rating)"
                                            ></span>
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
                                                            editModal(shop)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteShop(shop.id)
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
                            Update the Shop
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New Shop
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
                        @submit.prevent="editMode ? updateShop() : createShop()"
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
                                <label class="col-md-3 col-form-label" for="url"
                                    >URL
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="url"
                                        v-model="form.url"
                                        type="text"
                                        name="url"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="url"
                                    />
                                    <HasError :form="form" field="url" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="about"
                                    >About
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <textarea
                                        id="about"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        name="about"
                                        rows="3"
                                        cols="50"
                                        v-model="form.about"
                                    >
                                    </textarea>
                                    <HasError :form="form" field="about" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="rating"
                                    >Rating
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="rating"
                                        id="rating"
                                        v-model="form.rating"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Null
                                        </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <HasError :form="form" field="rating" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="user_id"
                                    >Seller
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
                                            Select Seller
                                        </option>
                                        <option
                                            v-for="seller in sellers"
                                            :value="seller.id"
                                        >
                                            {{ seller.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="user_id" />
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
        shops: [],
        sellers: [],
        searchText: null,
        form: new Form({
            id: "",
            name: "",
            banner: "",
            url: "",
            about: "",
            rating: "",
            user_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadShops();
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

        shopRating(rating) {
            var result = "";
            if (rating < 1) {
                return (result = "No rating");
            } else {
                for (var j = 1; j <= rating; j++) {
                    result += `<i class="fas fa-star text-yellow"></i>`;
                }
                for (var j = 5; j > rating; j--) {
                    result += `<i class="fas fa-star text-lighter"></i>`;
                }
                return result;
            }
        },

        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadSellers();
            $("#addRecord").modal("show");
        },

        editModal(shop) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadSellers();
            $("#addRecord").modal("show");
            this.form.fill(shop);
        },

        loadShops() {
            axios
                .get("/api/admin/shops", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.shops = data.data))
                .catch((error) => console.log(error));
        },

        loadSellers() {
            axios
                .get("/api/admin/users/seller")
                .then(({ data }) => (this.sellers = data))
                .catch((error) => console.log(error));
        },

        createShop() {
            this.form
                .post("/api/admin/shops")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteShop(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/shops/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateShop() {
            this.form
                .put("/api/admin/shops/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadShops();
        Fire.$on("reloadRecords", () => {
            this.loadShops();
        });
    },
};
</script>
