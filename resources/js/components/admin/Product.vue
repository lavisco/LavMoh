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
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th class="table-col-lg">Title</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th class="table-col-sm">State</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products">
                                        <td>
                                            <img
                                                width="150px"
                                                height="150px"
                                                class="banner-container"
                                                :src="
                                                    product.product_image
                                                        ? product.product_image
                                                              .path
                                                        : '/images/lavisco/img-bg.jpg'
                                                "
                                            />
                                        </td>
                                        <th>
                                            {{ product.id }}
                                        </th>
                                        <td class="table-col-lg">
                                            {{ product.sku }} <br />
                                            {{ product.title }}
                                        </td>
                                        <td>{{ product.quantity }}</td>
                                        <td>{{ product.base_price }}</td>
                                        <td>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                name="product_state_id"
                                                id="product_state_id"
                                                v-model="
                                                    product.product_state_id
                                                "
                                                @change.prevent="
                                                    setCurrentState(
                                                        product.id,
                                                        $event
                                                    )
                                                "
                                            >
                                                <option
                                                    v-for="productState in productStates"
                                                    :value="productState.id"
                                                >
                                                    {{ productState.state }}
                                                </option>
                                            </select>
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
                                                    <router-link
                                                        class="dropdown-item"
                                                        :to="{
                                                            name: 'admin/products/listing/edit',
                                                            params: {
                                                                productId:
                                                                    product.id,
                                                            },
                                                        }"
                                                        >Edit Details
                                                    </router-link>
                                                    <router-link
                                                        class="dropdown-item"
                                                        :to="{
                                                            name: 'admin/products/listing/image/edit',
                                                            params: {
                                                                productId:
                                                                    product.id,
                                                            },
                                                        }"
                                                        >Edit Images
                                                    </router-link>
                                                    <router-link
                                                        class="dropdown-item"
                                                        :to="{
                                                            name: 'admin/products/listing/variation/edit',
                                                            params: {
                                                                productId:
                                                                    product.id,
                                                            },
                                                        }"
                                                        >Edit Variation
                                                    </router-link>
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        @click.prevent="
                                                            deleteProduct(
                                                                product.id
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
        products: [],
        productStates: [],
        searchText: null,
        productimage: "",
        form: new Form({
            id: "",
            sku: "",
            title: "",
            description: "",
            length: "",
            width: "",
            height: "",
            dimensions_unit: "",
            weight: "",
            weight_unit: "",
            base_price: "",
            production_time: "",
            cut_off_time: "",
            processing_time: "",
            has_custom_text: "",
            has_custom_image: "",
            has_variations: "",
            has_inventory: "",
            quantity: "",
            product_state_id: "",
            category_id: "",
            user_id: "",
        }),
    }),

    watch: {
        searchText(after, before) {
            this.loadProducts();
        },
    },

    methods: {
        newModal() {
            this.$router.push("/admin/products/listing");
        },

        loadProducts() {
            axios
                .get("/api/admin/products", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => (this.products = data.data))
                .catch((error) => console.log(error));
        },

        loadProductStates() {
            axios
                .get("/api/admin/productstates")
                .then(({ data }) => (this.productStates = data))
                .catch((error) => console.log(error));
        },

        setCurrentState(product, event) {
            this.form.product_state_id = event.target.value;
            this.form
                .put("/api/admin/products/updateState/" + product)
                .then(() => {
                    Fire.$emit("reloadRecords");
                })
                .catch((error) => console.log(error));
        },

        deleteProduct(id) {
            if (confirm("Are you sure you want to delete?")) {
                axios
                    .delete("/api/admin/products/" + id)
                    .then(() => {
                        Fire.$emit("reloadRecords");
                    })
                    .catch((error) => console.log(error));
            }
        },
    },
    mounted() {
        this.loadProducts();
        this.loadProductStates();
        Fire.$on("reloadRecords", () => {
            this.loadProducts();
        });
    },
};
</script>
