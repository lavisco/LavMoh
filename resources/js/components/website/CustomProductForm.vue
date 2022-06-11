<template>
    <div class="container-fluid shipping">
        <h1>Custom Cake Request</h1>
        <h5 class="mb-5">
            Fill out the form to request a customized product from the seller.
        </h5>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="sendCustomRequest()">
                <div class="input-form-compact">
                    <!-- Contact Info -->
                    <div class="cart-items-card">
                        <h3 class="text-left">Your Contact Details</h3>
                        <hr />
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="first_name"
                                    >First Name
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="first_name"
                                    v-model="form.first_name"
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                />
                                <HasError :form="form" field="first_name" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="last_name"
                                    >Last Name
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="last_name"
                                    v-model="form.last_name"
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                />
                                <HasError :form="form" field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="email"
                                    >Email
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                />
                                <HasError :form="form" field="email" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="phone"
                                    >Phone
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                />
                                <HasError :form="form" field="phone" />
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="cart-items-card mt-5">
                        <h3 class="text-left">Delivery Address</h3>
                        <p class="mb-0 note">
                            You want the product to be delivered to this
                            location.
                        </p>
                        <hr />

                        <div class="form-group">
                            <label class="col-form-label" for="delivery_address"
                                >Address
                                <strong class="text-danger"> * </strong>
                            </label>
                            <input
                                id="delivery_address"
                                v-model="form.delivery_address"
                                type="text"
                                name="delivery_address"
                                class="form-control"
                            />
                            <HasError :form="form" field="delivery_address" />
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label
                                    class="col-form-label"
                                    for="delivery_city"
                                    >City
                                </label>
                                <input
                                    id="delivery_city"
                                    v-model="form.delivery_city"
                                    type="text"
                                    name="delivery_city"
                                    class="form-control"
                                />
                                <HasError :form="form" field="delivery_city" />
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    class="col-form-label"
                                    for="delivery_district"
                                    >District
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="delivery_district"
                                    v-model="form.delivery_district"
                                    type="text"
                                    name="delivery_district"
                                    class="form-control"
                                />
                                <HasError
                                    :form="form"
                                    field="delivery_district"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Cake details -->
                    <div class="cart-items-card mt-5">
                        <h3 class="text-left">Cake Details</h3>
                        <hr />

                        <div class="mb-3 large-img-upload-box">
                            <label class="col-form-label" for="event_date"
                                >Upload Product Image
                                <strong class="text-danger"> * </strong>
                            </label>
                            <img v-if="url" :src="url" class="display-banner" />
                            <img
                                v-if="!url"
                                src="/images/lavisco/img-bg.jpg"
                                class="display-banner"
                            />
                            <button
                                @click.prevent="$refs.fileInput.click()"
                                class="img-upload-btn bg-pink"
                                title="Upload Image"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true"
                                    role="img"
                                    width="1em"
                                    height="1em"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 24 24"
                                    title="Upload Image"
                                >
                                    <path
                                        fill="white"
                                        d="M21 6.25A3.25 3.25 0 0 0 17.75 3H6.25A3.25 3.25 0 0 0 3 6.25v12.283c0 1.303 1.57 1.962 2.5 1.048l4.03-3.96a.634.634 0 0 0 .02-.021l1.925-1.885l.083-.071a.75.75 0 0 1 .966.07l2.08 2.037l1.06-1.06l-2.09-2.048l-.129-.116a2.25 2.25 0 0 0-3.02.116l-4.452 4.36h.01L4.5 18.46V6.25c0-.966.784-1.75 1.75-1.75h11.5c.967 0 1.75.784 1.75 1.75v4.982c.48-.19.994-.263 1.5-.22V6.25Zm-3.496 2.502a2.252 2.252 0 1 0-4.505 0a2.252 2.252 0 0 0 4.505 0Zm-3.005 0a.752.752 0 1 1 1.505 0a.752.752 0 0 1-1.505 0Zm-1.302 9.82l5.902-5.902a2.285 2.285 0 1 1 3.233 3.232l-5.903 5.902a2.684 2.684 0 0 1-1.247.707l-1.83.457a.985.985 0 0 1-.15.027c-.59.204-2.979.574-3.827-.088c-.574-.448-.46-1.334-.218-1.818c.04-.078-.02-.18-.105-.166c-.66.103-1.243.45-1.827.799c-.783.468-1.57.936-2.549.815c-.979-.122-1.468-.726-1.71-1.255c-.099-.216.18-.401.388-.287c.469.255 1.106.496 1.631.38c.375-.084.904-.458 1.496-.877c1.066-.753 2.337-1.653 3.292-1.268c.84.337 1.46 1.15 1.03 2.113c-.052.118 0 .264.127.293c.423.097.778.066 1.133-.105l.428-1.712c.118-.472.362-.903.706-1.247Z"
                                    />
                                </svg>
                            </button>
                        </div>
                        <input
                            type="file"
                            style="display: none"
                            @change.prevent="fileSelected"
                            ref="fileInput"
                            name="image_path"
                        />
                        <p class="text-xs mt-0">
                            Product image must be under 2MB.
                        </p>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="event_date"
                                    >Event Date
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="event_date"
                                    v-model="form.event_date"
                                    type="date"
                                    name="event_date"
                                    class="form-control"
                                    :max="dateTo"
                                    :min="dateFrom"
                                />
                                <HasError :form="form" field="event_date" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="type"
                                    >Cake type
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    id="type"
                                    v-model="form.type"
                                    name="type"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Type
                                    </option>
                                    <option value="chocolate">Chocolate</option>
                                    <option value="vanilla">Vanilla</option>
                                    <option value="other">Other</option>
                                </select>
                                <HasError :form="form" field="type" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="size"
                                    >Cake size
                                </label>
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    id="size"
                                    v-model="form.size"
                                    name="size"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Size
                                    </option>
                                    <option value="1kg">1 kg</option>
                                    <option value="2kg">2 kg</option>
                                    <option value="3kg">3 kg</option>
                                    <option value="4kg">4 kg</option>
                                    <option value="5kg">5 kg</option>
                                    <option value="5+kg">5+ kg</option>
                                </select>
                                <HasError :form="form" field="size" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="tiers"
                                    >Cake tiers
                                </label>
                                <select
                                    class="
                                        custom-select
                                        form-control form-control-alternative
                                    "
                                    id="tiers"
                                    v-model="form.tiers"
                                    name="tiers"
                                >
                                    <option value="" disabled selected hidden>
                                        Select Tier
                                    </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="4+">4+</option>
                                </select>
                                <HasError :form="form" field="tiers" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="description"
                                >Description
                                <strong class="text-danger"> * </strong>
                            </label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                type="text"
                                name="description"
                                class="form-control"
                                cols="5"
                                rows="5"
                            />
                            <HasError :form="form" field="description" />
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-5">
                    <button type="submit" :disabled="submitButtonDisabled">
                        {{ submitButtonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        submitButtonText: "Submit Request",
        submitButtonDisabled: false,
        url: "",
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
            delivery_address: "",
            delivery_city: "",
            delivery_district: "",
            event_date: "",
            type: "",
            size: "",
            tiers: "",
            description: "",
            image_path: "",
            photoName: "",
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
                this.form.image_path = reader.result;
                this.form.photoName = e.target.files[0].name;
                this.url = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
        },

        sendCustomRequest() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;
            this.form
                .post("/api/seller/custom_product")
                .then(() => {
                    this.submitButtonText = "Submitted";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                })
                .catch((error) => {
                    this.submitButtonText = "Submit Request";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },
    },

    mounted() {},
};
</script>
