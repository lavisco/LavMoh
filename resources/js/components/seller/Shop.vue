<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mb-5">
            <div
                v-if="loading"
                class="my-5 d-flex align-items-center justify-content-center"
            >
                <img src="/images/lavisco/loading.gif" />
            </div>

            <div v-else>
                <form class="dashboard-shop" @submit.prevent="updateShop()">
                    <div class="col-left d-flex align-items-center flex-column">
                        <div class="mb-3 small-img-upload-box">
                            <img v-if="url" :src="url" class="display-banner" />
                            <img
                                v-if="!url"
                                :src="shop.path"
                                class="display-banner"
                            />
                            <button
                                @click.prevent="$refs.fileInput.click()"
                                class="img-upload-btn"
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
                            name="banner"
                        />
                        <p class="text-xs my-0">
                            Logo must be square & under 2MB.
                        </p>
                    </div>
                    <div class="col-right">
                        <div class="large-img-upload-box mb-3">
                            <img v-if="url_big" :src="url_big" class="display-banner" />
                            <img
                                v-if="!url_big"
                                :src="shop.bigpath"
                                class="display-banner"
                            />
                            <button
                                @click.prevent="$refs.fileInputBig.click()"
                                class="img-upload-btn"
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
                            @change.prevent="fileSelectedBig"
                            ref="fileInputBig"
                            name="bannerbig"
                        />
                        <p class="text-xs mt-0">
                            Banner image must be under 2MB. Recommended
                            resolution is 1920 x 1080px.
                        </p>
                        <div class="py-0">
                            <div class="shop-banner">
                                <h1>{{ shop.name }}</h1>
                                <h5>{{ shop.city }}, {{ shop.district }}</h5>
                                <p>{{ shop.about }}</p>
                            </div>
                        </div>
                        <div class="pt-0">
                            <!-- Form start -->
                            <div class="input-form input-form-compact">
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Store Details</h4>
                                    <div class="form-group">
                                        <label class="col-form-label" for="name"
                                            >Store Name
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>
                                        <input
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            name="name"
                                            class="
                                                form-control
                                                form-control-alternative
                                            "
                                            placeholder="Store Name"
                                        />
                                        <HasError :form="form" field="name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="url"
                                            >URL
                                        </label>

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
                                            disabled
                                        />
                                        <HasError :form="form" field="url" />
                                    </div>
                                    <div class="form-group">
                                        <label
                                            class="col-form-label"
                                            for="about"
                                            >About
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>

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
                                        <p class="text-xs mt-2 mb-0">
                                            Maximum 500 characters. Tell buyers
                                            more about your store, for example
                                            your store history, goals, and what
                                            kind of products you sell, this will
                                            entice buyers and establish a sense
                                            of trust.
                                        </p>
                                        <HasError :form="form" field="about" />
                                    </div>
                                </div>

                                <!-- Shipping -->
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">
                                        Available Shipping Options
                                    </h4>
                                    <div class="form-group">
                                        <label class="col-form-label" for="">
                                            Shipping types
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                            <p class="text-grey text-xs mt-2">
                                                Select the shipping options you
                                                provide.
                                            </p>
                                        </label>
                                        <div
                                            class="
                                                table-responsive
                                                form-table
                                                mt-md-2
                                            "
                                        >
                                            <table
                                                class="
                                                    table
                                                    align-items-center
                                                    table-hover
                                                "
                                            >
                                                <thead>
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="tiny-col"
                                                        ></th>
                                                        <th scope="col">
                                                            Type Details
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="shipping in shippings"
                                                        :key="shipping.id"
                                                    >
                                                        <th scope="row">
                                                            <input
                                                                type="checkbox"
                                                                name="shop_shipping"
                                                                v-model="
                                                                    form.shop_shipping
                                                                "
                                                                :value="
                                                                    shipping.id
                                                                "
                                                            />
                                                        </th>
                                                        <td>
                                                            {{ shipping.type }}
                                                            <br />
                                                            <div
                                                                class="text-xxs"
                                                            >
                                                                Price
                                                            </div>
                                                            LKR
                                                            {{ shipping.price }}
                                                            <div
                                                                class="text-xxs"
                                                            >
                                                                Delivery Time
                                                            </div>
                                                            {{
                                                                shipping.delivery_time
                                                            }}
                                                            day
                                                            <br />
                                                            <div
                                                                class="text-xxs"
                                                                v-if="
                                                                    shipping.locations
                                                                "
                                                            >
                                                                Locations
                                                            </div>
                                                            {{
                                                                shipping.locations
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Your Address</h4>
                                    <p class="mb-4 note">
                                        Please make sure you add the most recent
                                        address.
                                    </p>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="province"
                                                >Province
                                                <strong class="text-danger">
                                                    *</strong
                                                >
                                            </label>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                id="province"
                                                v-model="form.province"
                                                name="province"
                                                @change.prevent="
                                                    loadDistricts()
                                                "
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    hidden
                                                >
                                                    Select Province
                                                </option>
                                                <option
                                                    v-for="province in provinces"
                                                    :value="province.name"
                                                >
                                                    {{ province.name }}
                                                </option>
                                            </select>
                                            <HasError
                                                :form="form"
                                                field="province"
                                            />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="district"
                                                >District
                                                <strong class="text-danger">
                                                    *</strong
                                                >
                                            </label>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                id="district"
                                                v-model="form.district"
                                                name="district"
                                                @change.prevent="loadCities()"
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
                                                    :value="district.name"
                                                >
                                                    {{ district.name }}
                                                </option>
                                            </select>
                                            <HasError
                                                :form="form"
                                                field="district"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="city"
                                                >City
                                                <strong class="text-danger">
                                                    *</strong
                                                >
                                            </label>
                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                id="city"
                                                v-model="form.city"
                                                name="city"
                                                @change.prevent="loadAreas()"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    hidden
                                                >
                                                    Select City
                                                </option>
                                                <option
                                                    v-for="city in cities"
                                                    :value="city.name"
                                                >
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                            <HasError
                                                :form="form"
                                                field="city"
                                            />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="zipcode"
                                                >Zip Code
                                            </label>
                                            <input
                                                id="zipcode"
                                                v-model="form.zipcode"
                                                type="text"
                                                name="zipcode"
                                                class="
                                                    form-control
                                                    form-control-alternative
                                                "
                                                placeholder="Zip code"
                                            />
                                            <HasError
                                                :form="form"
                                                field="zipcode"
                                            />
                                        </div>
                                    </div>
                                    <div class="row" v-show="areas[0] != null">
                                        <div class="form-group col-md-6">
                                            <label
                                                class="col-form-label"
                                                for="area"
                                                >Area
                                            </label>

                                            <select
                                                class="
                                                    custom-select
                                                    form-control
                                                    form-control-alternative
                                                "
                                                id="area"
                                                v-model="form.area"
                                                name="area"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    hidden
                                                >
                                                    Select Area
                                                </option>
                                                <option
                                                    v-for="area in areas"
                                                    :value="area.name"
                                                >
                                                    {{ area.name }}
                                                </option>
                                            </select>
                                            <HasError
                                                :form="form"
                                                field="area"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label
                                                class="col-form-label"
                                                for="address"
                                                >Address
                                                <strong class="text-danger">
                                                    *
                                                </strong>
                                            </label>
                                            <input
                                                id="address"
                                                v-model="form.address"
                                                type="text"
                                                name="address"
                                                class="form-control"
                                                placeholder="Address"
                                            />
                                            <HasError
                                                :form="form"
                                                field="address"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="
                                    d-flex
                                    justify-content-end
                                    align-items-center
                                    mt-5
                                "
                            >
                                <button type="submit">
                                    <i
                                        class="fas fa-pen-nib mr-2"
                                        aria-hidden="true"
                                    ></i>
                                    Update
                                </button>
                            </div>

                            <!-- Form end -->
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Update Successful"
            msg="Your store details have been updated. It will now display on the website."
            gotoRoute="noroute"
        />
        <fail-modal
            id="fail-modal"
            msgTitle="Update Failed"
            msg="There are errors in your form input. Please double check."
        />
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
        url_big: "",
        //location data
        provinces: [],
        districts: [],
        cities: [],
        areas: [],
        shippings: [],
        loading: true,
        form: new Form({
            id: "",
            name: "",
            banner: "",
            banner_big: "",
            url: "",
            about: "",
            province: "",
            district: "",
            city: "",
            area: "",
            address: "",
            zipcode: "",
            shop_shipping: [],
            shippings: [],
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

        fileSelectedBig(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file["size"] > limit) {
                alert("File size has crossed maximum limit, which is 2mb!");
                return false;
            }
            reader.onloadend = (file) => {
                this.form.banner_big = reader.result;
                this.form.photoNameBig = e.target.files[0].name;
                this.url_big = URL.createObjectURL(e.target.files[0]);
            };
            reader.readAsDataURL(file);
        },

        loadShop() {
            axios
                .get("/api/seller/shop")
                .then(({ data }) => {
                    this.shop = data;
                    this.form.fill(this.shop);
                    this.loadShippings();
                    this.loadProvinces();
                    this.loadDistricts();
                    this.loadCities();
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },

        loadShippings() {
            axios
                .get("/api/seller/shop/shippings")
                .then((response) => {
                    this.shippings = response.data.shippings;

                    this.form.shop_shipping = [];
                    if (this.form.shippings != null) {
                        this.form.shippings.forEach((value) => {
                            this.form.shop_shipping.push(value.id);
                        });
                    }
                })
                .catch((error) => console.log(error));
        },

        loadProvinces() {
            axios
                .get("/api/locations/provinces")
                .then(({ data }) => (this.provinces = data))
                .catch((error) => console.log(error));
        },
        loadDistricts() {
            axios
                .get("/api/locations/districts/" + this.form.province)
                .then(({ data }) => (this.districts = data))
                .catch((error) => console.log(error));
        },
        loadCities() {
            axios
                .get("/api/locations/cities/" + this.form.district)
                .then(({ data }) => (this.cities = data))
                .catch((error) => console.log(error));
        },

        loadAreas() {
            axios
                .get("/api/locations/areas/" + this.form.city)
                .then(({ data }) => (this.areas = data))
                .catch((error) => console.log(error));
        },

        updateShop() {
            this.form
                .put("/api/seller/shop/" + this.form.id)
                .then(() => {
                    this.loadShop();
                    $("#success-modal").modal("show");
                })
                .catch((error) => {
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },
    },

    mounted() {
        this.loadShop();
    },
};
</script>
