<template>
    <div class="col-md-12">
        <div class="card">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="">
                    Add a Variation
                </label>
                <div class="col-md-4">
                    <select
                        class="
                            custom-select
                            form-control form-control-alternative
                        "
                        name="variation_id"
                        id="variation_id"
                        v-model="form.variation_id"
                        @change.prevent="loadOptions"
                    >
                        <option value="" disabled selected hidden>
                            Choose Variation Type
                        </option>
                        <option
                            v-for="variation in variations"
                            :value="variation.id"
                        >
                            {{ variation.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row" v-show="optionMode">
                <label class="col-md-3 col-form-label" for="">
                    Select Variation Options
                    <p class="text-grey text-xs mt-2">
                        Select all the options you offer.
                    </p>
                </label>
                <div class="col-md-9">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="option in options">
                                        <th scope="row">
                                            <input
                                                type="checkbox"
                                                name="product_variation_option"
                                                v-model="
                                                    form.product_variation_option
                                                "
                                                :value="option.id"
                                            />
                                        </th>
                                        <td>{{ option.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn" type="button">Save & Continue</button>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center table-hover">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Variation Type</th>
                            <th scope="col">Option</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
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
        variations: [],
        options: [],
        optionMode: false,
        form: new Form({
            id: "",
            product_variation_option: [],
            variation_id: "",
        }),
    }),

    methods: {
        newModal() {
            this.editMode = false;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
        },

        editModal(variation) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            $("#addRecord").modal("show");
            this.form.fill(variation);
        },
        loadVariations() {
            axios
                .get("/api/admin/variations")
                .then(({ data }) => (this.variations = data.data))
                .catch((error) => console.log(error));
        },
        loadOptions() {
            this.optionMode = true;
            axios
                .get("/api/admin/variations/options", {
                    params: { variation_id: this.form.variation_id },
                })
                .then(({ data }) => (this.options = data))
                .catch((error) => console.log(error));
        },

        createVariation() {
            this.form
                .post("/api/admin/product_variations")
                .then(() => {})
                .catch((error) => console.log(error));
        },

        deleteVariation(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/product_variations/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },

        updateVariation() {
            this.form
                .put("/api/admin/product_variations/" + this.form.id)
                .then(() => {
                    $("#addRecord").modal("hide");
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadVariations();
        Fire.$on("reloadRecords", () => {
            this.loadVariations();
        });
    },
};
</script>
