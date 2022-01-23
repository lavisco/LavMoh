<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
                <!-- Form start -->
                <div class="input-form">
                    <!-- Photo -->
                    <div class="card px-4 pt-4 pb-0">
                        <!-- Header -->
                        <h4 class="mb-4">Product Variations</h4>
                        <p>
                            Edit available options like color or size. Buyers
                            will choose from these during checkout.
                        </p>
                    </div>
                    <div
                        class="card px-4 pb-4 my-4"
                        v-for="(item, i) in variations"
                    >
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                            "
                        >
                            <h5 class="mb-4">Variation {{ i + 1 }}</h5>
                            <a
                                class="btn btn-light btn-sm"
                                href=""
                                @click.prevent="
                                    deleteProductVariations(
                                        form.variation_id[i]
                                    )
                                "
                            >
                                Delete
                            </a>
                        </div>

                        <div class="form-group row mb-md-1">
                            <div class="col-md-6">
                                <label
                                    class="col-form-label"
                                    for="variation_type"
                                    >Type
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <input
                                    id="variation_type"
                                    v-model="form.variation_type[i]"
                                    type="text"
                                    name="variation_type"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Type"
                                />
                                <HasError
                                    :form="form"
                                    :field="`variation_type.${i}`"
                                />
                            </div>
                            <div class="col-md-6">
                                <label
                                    class="col-form-label"
                                    for="variation_type_option"
                                    >Type Option
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <input
                                    id="variation_type_option"
                                    v-model="form.variation_type_option[i]"
                                    type="text"
                                    name="variation_type_option"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Option"
                                />
                                <HasError
                                    :form="form"
                                    :field="`variation_type_option.${i}`"
                                />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <div class="col-md-12">
                                <label
                                    class="col-form-label"
                                    for="variation_description"
                                    >Description
                                </label>
                                <textarea
                                    id="variation_description"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    name="variation_description"
                                    rows="3"
                                    cols="50"
                                    v-model="form.variation_description[i]"
                                >
                                </textarea>
                                <HasError
                                    :form="form"
                                    :field="`variation_description.${i}`"
                                />
                            </div>
                        </div>
                        <div class="form-group row mb-md-1">
                            <div class="col-md-4">
                                <label
                                    class="col-form-label"
                                    for="variation_sku"
                                    >SKU
                                </label>
                                <input
                                    id="variation_sku"
                                    v-model="form.variation_sku[i]"
                                    type="text"
                                    name="variation_sku"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="SKU"
                                />
                                <HasError
                                    :form="form"
                                    :field="`variation_sku.${i}`"
                                />
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="col-form-label"
                                    for="variation_price"
                                    >Price
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <input
                                    id="variation_price"
                                    v-model="form.variation_price[i]"
                                    type="text"
                                    name="variation_price"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Price"
                                />
                                <HasError
                                    :form="form"
                                    :field="`variation_price.${i}`"
                                />
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="col-form-label"
                                    for="variation_quantity"
                                    >Quantity
                                    <strong class="text-danger"> *</strong>
                                </label>
                                <input
                                    id="variation_quantity"
                                    v-model="form.variation_quantity[i]"
                                    type="number"
                                    name="variation_quantity"
                                    class="
                                        form-control form-control-alternative
                                    "
                                    placeholder="Qty"
                                />
                                <HasError
                                    :form="form"
                                    :field="`variation_quantity.${i}`"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card px-4 pb-4 mb-4">
                        <div class="input-form text-right">
                            <button
                                type="button"
                                class="btn btn-secondary mr-3"
                                @click.prevent="cancel()"
                            >
                                <i
                                    class="fas fa-times mr-2"
                                    aria-hidden="true"
                                ></i>
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="btn"
                                @click.prevent="updateProductVariations()"
                            >
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                        </div>
                    </div>
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
        variations: {},
        form: new Form({
            variation_id: [],
            variation_type: [],
            variation_type_option: [],
            variation_sku: [],
            variation_description: [],
            variation_price: [],
            variation_quantity: [],
        }),
    }),

    methods: {
        cancel() {
            this.$router.push("/seller/products");
        },

        loadProductVariations() {
            axios
                .get(
                    "/api/seller/product_variations/" +
                        this.$route.params.productId
                )
                .then(({ data }) => {
                    this.variations = data;
                    this.variations.forEach((value, index) => {
                        this.$set(this.form.variation_id, index, value.id);
                        this.$set(this.form.variation_type, index, value.type);
                        this.$set(
                            this.form.variation_type_option,
                            index,
                            value.type_option
                        );
                        this.$set(this.form.variation_sku, index, value.sku);
                        this.$set(
                            this.form.variation_description,
                            index,
                            value.description
                        );
                        this.$set(
                            this.form.variation_price,
                            index,
                            value.price
                        );
                        this.$set(
                            this.form.variation_quantity,
                            index,
                            value.quantity
                        );
                    });
                })
                .catch((error) => console.log(error));
        },

        updateProductVariations() {
            this.form
                .put(
                    "/api/seller/product_variations/" +
                        this.$route.params.productId
                )
                .then(() => {
                    this.$router.push("/seller/products");
                })
                .catch((error) => console.log(error));
        },
        deleteProductVariations(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/seller/product_variations/" + id)
                    .then(() => {
                        //Fire.$emit("reloadRecords");
                        console.log("success");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadProductVariations();
        Fire.$on("reloadRecords", () => {
            this.loadProductVariations();
        });
    },
};
</script>
