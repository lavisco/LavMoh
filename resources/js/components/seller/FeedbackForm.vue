<template>
    <div>
        <!-- Body -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Form start -->
                        <form class="input-form" @submit.prevent="updateShop()">
                            <div class="input-form-compact">

                                <div class="card dashboard-info-card mt-4">
                                    <h4 class="mb-3">Want to give your feedback about this page?</h4>
                                    <hr class="mt-0" />
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
                                            >Help us improve further
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
                                            Feel free to share whatever you find relevant
                                        </p>
                                        <HasError :form="form" field="about" />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="
                                    d-flex
                                    justify-content-center
                                    align-items-center
                                    mt-5
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
import moment from "moment";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        moment: moment,
        submitButtonText: "Submit",
        submitButtonDisabled: false,
        same_address: false,

        revenue: "",
        orders: "",
        orderCount: "",
        products: "",
        productCount: "",
        sellerShop: "",
        user: "",
        has_shop: "",
        shop_active: "",
        url: "",
        billingMode: false,

        //form parts
        part1: true,
        part2: false,
        part3: false,
        part4: false,
        failed: false,

        shippings: [],
        cities: [],
        form: new Form({
            id: "",
            //shop
            shop_name: "",
            banner: "",
            about: "",
            shop_city: "",
            shop_address: "",
            shop_zipcode: "",
            //seller profile
            first_name: "",
            last_name: "",
            phone: "",
            email: "",
            city: "",
            address: "",
            zipcode: "",
            billing_address: "",
            deposit_account: "",
            deposit_name: "",
            deposit_bank: "",
            deposit_bank_branch: "",
            deposit_account_status: "",
            shop_shipping: [],
        }),
    }),

    methods: {
        toggleForm(formpart) {
            this.part1 = false;
            this.part2 = false;
            this.part3 = false;
            this.part4 = false;
            this[formpart] = true;
        },

        loadData() {
            axios
                .get("/api/seller/dashboard")
                .then(({ data }) => {
                    this.user = data.user;
                    this.form.first_name = this.user.name
                        .trim()
                        .split(/\s+/)[0];
                    this.form.last_name = this.user.name.trim().split(/\s+/)[1];
                    this.form.email = this.user.email;
                    this.form.phone = this.user.phone;

                    this.has_shop = data.hasShop;
                    this.shop_active = data.shopActive;
                    if (this.has_shop === false) {
                        $("#addRecord").modal("show");
                        this.loadCities();
                        this.loadShippings();
                    }
                    this.revenue = data.revenue;
                    this.orders = data.orders.data;
                    this.orderCount = data.orderCount;
                    this.products = data.products.data;
                    this.productCount = data.productCount;
                    this.sellerShop = data.sellerShop;
                })
                .catch((error) => console.log(error));
        },

        //shop setup

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

        loadShippings() {
            axios
                .get("/api/seller/shop/shippings")
                .then((response) => {
                    this.shippings = response.data.shippings;
                })
                .catch((error) => console.log(error));
        },

        loadCities() {
            axios
                .get("/api/seller/locations/cities")
                .then(({ data }) => (this.cities = data))
                .catch((error) => console.log(error));
        },

        createSellerprofile() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            //autofill if address is the same
            if (this.same_address === true) {
                this.form.shop_address = this.form.address;
                this.form.shop_city = this.form.city;
                this.form.shop_zipcode = this.form.zipcode;
            }

            this.form
                .post("/api/seller/user/shop_setup")
                .then(() => {
                    this.submitButtonDisabled = false;
                    $("#addRecord").modal("hide");
                    $("#success-modal").modal("show");
                    this.sendStoreActiveApplicationMail();
                })
                .catch((error) => {
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    this.failed = true;
                });
        },

        logout() {
            axios
                .post("/logout")
                .then((response) => {
                    window.location.replace("/merchant/login");
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        sendStoreActiveApplicationMail() {
            axios
                .get("/api/email/store_active_application")
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
