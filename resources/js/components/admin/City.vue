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
                                        <th scope="col">Postcode</th>
                                        <th scope="col">Latitude</th>
                                        <th scope="col">Longitude</th>
                                        <th scope="col">District</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="city in cities">
                                        <th>{{ city.name }}</th>
                                        <td>{{ city.postcode }}</td>
                                        <td>{{ city.latitude }}</td>
                                        <td>{{ city.longitude }}</td>
                                        <td>{{ city.district.name }}</td>
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
                                                            editModal(city)
                                                        "
                                                    >
                                                        Edit
                                                    </a>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteCity(
                                                                city.id
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
                            Update the City
                        </h4>
                        <h4
                            v-show="!editMode"
                            class="modal-title text-uppercase"
                            id="addRecordLabel"
                        >
                            Add New City
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
                            editMode ? updateCity() : createCity()
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
                                    for="has_area"
                                    >Is this city split into areas?
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
                                            id="yes"
                                            name="has_area"
                                            class="custom-control-input"
                                            v-model="form.has_area"
                                            value="1"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="yes"
                                            >Yes</label
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
                                            id="no"
                                            name="has_area"
                                            class="custom-control-input"
                                            v-model="form.has_area"
                                            value="0"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="no"
                                            >No</label
                                        >
                                    </div>
                                    <HasError :form="form" field="has_area" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="postcode"
                                    >Postcode
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="postcode"
                                        v-model="form.postcode"
                                        type="text"
                                        name="postcode"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="postcode"
                                    />
                                    <HasError :form="form" field="postcode" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="latitude"
                                    >Latitude
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="latitude"
                                        v-model="form.latitude"
                                        type="text"
                                        name="latitude"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="latitude"
                                    />
                                    <HasError :form="form" field="latitude" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="longitude"
                                    >Longitude
                                </label>

                                <div class="col-md-9">
                                    <input
                                        id="longitude"
                                        v-model="form.longitude"
                                        type="text"
                                        name="longitude"
                                        class="
                                            form-control
                                            form-control-alternative
                                        "
                                        placeholder="longitude"
                                    />
                                    <HasError :form="form" field="longitude" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label"
                                    for="district_id"
                                    >District
                                    <strong class="text-danger"> *</strong>
                                </label>

                                <div class="col-md-9">
                                    <select
                                        class="
                                            custom-select
                                            form-control
                                            form-control-alternative
                                        "
                                        name="district_id"
                                        id="district_id"
                                        v-model="form.district_id"
                                    >
                                        <option
                                            value=""
                                            disabled
                                            selected
                                            hidden
                                        >
                                            Select District
                                        </option>
                                        <option
                                            v-for="district in districts"
                                            :value="district.id"
                                        >
                                            {{ district.name }}
                                        </option>
                                    </select>
                                    <HasError :form="form" field="district_id" />
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
        cities: [],
        districts: [],
        searchText: null,
        form: new Form({
            id: "",
            has_area: "",
            name: "",
            postcode: "",
            latitude: "",
            longitude: "",
            district_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadCities();
        },
    },

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            this.loadDistricts();
            $("#addRecord").modal("show");
        },

        editModal(city) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.loadDistricts();
            $("#addRecord").modal("show");
            this.form.fill(city);
        },
        loadCities() {
            axios
                .get("/api/admin/cities", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.cities = data.data;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        loadDistricts() {
            axios
                .get("/api/admin/districts")
                .then(({ data }) => {
                    this.districts = data.data;
                })
                .catch((error) => console.log(error));
        },
        createCity() {
            this.form
                .post("/api/admin/cities")
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteCity(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/cities/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateCity() {
            this.form
                .put("/api/admin/cities/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadCities();
        Fire.$on("reloadRecords", () => {
            this.loadCities();
        });
    },
};
</script>
