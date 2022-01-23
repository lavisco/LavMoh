<template>
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col">
                <!-- Form start -->
                <form
                    class="input-form"
                    @submit.prevent="updateProductImages()"
                >
                    <!-- Photo -->
                    <div class="card px-4 py-4 my-4">
                        <!-- Header -->
                        <h4 class="mb-4">Product Photos</h4>
                        <p class="text-grey text-sm mb-4 mt-0">
                            Add atleast 3 photos showcasing your product. The
                            Primary photo is the first image customers see in
                            the product page.
                        </p>

                        <div class="form-group row">
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <div
                                        class="mr-md-3"
                                        v-for="(image, index) in images"
                                    >
                                        <div>
                                            <input
                                                type="file"
                                                style="display: none"
                                                @change.prevent="
                                                    fileSelected(
                                                        $event,
                                                        `image${index}`
                                                    )
                                                "
                                                ref="fileInput"
                                                name="product_image_path"
                                            />

                                            <button
                                                class="image-upload-box"
                                                :class="{
                                                    'image-upload-box-primary':
                                                        image.primary_image ==
                                                        '1',
                                                }"
                                                @click.prevent="
                                                    $refs.fileInput[
                                                        index
                                                    ].click()
                                                "
                                            >
                                                <img
                                                    width="150px"
                                                    height="150px"
                                                    class="banner-container"
                                                    :src="
                                                        form.path[index]
                                                            ? form.path[index]
                                                            : '/images/lavisco/img-bg.jpg'
                                                    "
                                                />
                                            </button>

                                            <p
                                                class="
                                                    image-upload-filename
                                                    mt-2
                                                "
                                            >
                                                {{ form.title[index] }}
                                            </p>
                                            <HasError
                                                :form="form"
                                                field="product_image_path"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-form text-right">
                            <button
                                type="button"
                                class="btn btn-secondary mr-3"
                                @click="cancel()"
                            >
                                <i
                                    class="fas fa-times mr-2"
                                    aria-hidden="true"
                                ></i>
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i
                                    class="fas fa-save mr-2"
                                    aria-hidden="true"
                                ></i>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
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
        images: {},
        form: new Form({
            id: [],
            image_path: [],
            path: [],
            title: [],
            primary_image: [],
        }),
    }),

    methods: {
        cancel() {
            this.$router.push("/seller/products");
        },

        fileSelected(e, imagenum) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                if (imagenum == "image0") {
                    this.$set(this.form.image_path, 0, reader.result);
                    this.$set(this.form.title, 0, e.target.files[0].name);
                    this.$set(this.form.primary_image, 0, 1);
                    this.$set(
                        this.form.path,
                        0,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image1") {
                    this.$set(this.form.image_path, 1, reader.result);
                    this.$set(this.form.title, 1, e.target.files[0].name);
                    this.$set(this.form.primary_image, 1, 0);
                    this.$set(
                        this.form.path,
                        1,
                        URL.createObjectURL(e.target.files[0])
                    );
                } else if (imagenum == "image2") {
                    this.$set(this.form.image_path, 2, reader.result);
                    this.$set(this.form.title, 2, e.target.files[0].name);
                    this.$set(this.form.primary_image, 2, 0);
                    this.$set(
                        this.form.path,
                        2,
                        URL.createObjectURL(e.target.files[0])
                    );
                }
            };
            reader.readAsDataURL(file);
        },
        loadProductImages() {
            axios
                .get("/api/seller/product_images/", {
                    params: { productId: this.$route.params.productId },
                })
                .then(({ data }) => {
                    this.images = data;
                    this.images.forEach((value, index) => {
                        this.form.id.push(value.id);
                        this.form.image_path.push(value.image_path);
                        this.form.primary_image.push(value.primary_image);
                        this.form.path.push(value.path);
                        this.form.title.push(value.title);
                    });
                })
                .catch((error) => console.log(error));
        },

        updateProductImages() {
            this.form
                .put(
                    "/api/seller/product_images/" + this.$route.params.productId
                )
                .then(() => {
                    this.$router.push("/seller/products");
                })
                .catch((error) => console.log(error));
        },
    },
    mounted() {
        this.loadProductImages();
    },
};
</script>
