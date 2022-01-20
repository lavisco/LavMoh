<template>
    <div>
        <!-- Body -->
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Form start -->
                        <form class="input-form" @submit.prevent="updateShop()">
                            <div class="">
                                <h4 class="mb-4">Shop Information</h4>
                                <img
                                    width="100%"
                                    height="150px"
                                    class="mb-4 display-banner"
                                    v-show="shop.path"
                                    :src="
                                        shop.path
                                            ? shop.path
                                            : '/images/lavisco/img-bg.jpg'
                                    "
                                />
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
                                        for="url"
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
                                        <span
                                            v-html="shopRating(shop.rating)"
                                        ></span>
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
                                            @click.prevent="
                                                $refs.fileInput.click()
                                            "
                                        >
                                            <img
                                                v-if="url"
                                                :src="url"
                                                class="banner-container"
                                            />
                                            <img
                                                v-if="!url"
                                                :src="shop.path"
                                                class="banner-container"
                                            />
                                        </button>
                                        <p class="image-upload-filename mt-2">
                                            {{
                                                form.photoName
                                                    ? form.photoName
                                                    : `Change image`
                                            }}
                                        </p>
                                        <HasError :form="form" field="banner" />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="
                                    d-flex
                                    justify-content-center
                                    align-items-center
                                    mt-4
                                "
                            >
                                <button type="submit" class="btn">
                                    <i
                                        class="fas fa-pen-nib mr-2"
                                        aria-hidden="true"
                                    ></i>
                                    Update
                                </button>
                            </div>
                        </form>
                        <!-- Form end -->
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
        shop: {},
        url: "",
        form: new Form({
            id: "",
            name: "",
            banner: "",
            url: "",
            about: "",
            rating: "",
        }),
    }),

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
                this.url = URL.createObjectURL(e.target.files[0]);
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

        loadShop() {
            axios
                .get("/api/seller/shop")
                .then(({ data }) => {
                    this.shop = data;
                    this.form.fill(this.shop);
                })
                .catch((error) => console.log(error));
        },

        updateShop() {
            this.form
                .put("/api/seller/shop/" + this.form.id)
                .then(() => {
                    this.loadShop();
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadShop();
    },
};
</script>
